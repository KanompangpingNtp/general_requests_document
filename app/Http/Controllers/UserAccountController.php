<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FormAttachment;
use Illuminate\Support\Facades\Storage;
use App\Models\Reply;

class UserAccountController extends Controller
{
    //
    public function userAccountFormsIndex()
    {
        $user = User::with('userDetail')->find(Auth::id());

        return view('user_account_form.user_account_form', compact('user'));
    }

    public function userRecordForm()
    {
        $forms = Form::with(['user', 'replies', 'attachments'])
            ->where('user_id', Auth::id())
            ->get();

        // ส่งข้อมูลไปยัง view
        return view('users_account_record.users_account_record', compact('forms'));
    }


    public function exportUserPDF($id)
    {
        $form = Form::find($id); // ดึงข้อมูลฟอร์มพร้อมกับรายการที่ยืม

        // สร้าง instance ของ DomPDF ผ่าน facade Pdf
        $pdf = Pdf::loadView('admin_export_pdf.admin_export_pdf', compact('form'))
                ->setPaper('A4', 'portrait');

        // ส่งไฟล์ PDF ไปยังเบราว์เซอร์
        return $pdf->stream('แบบคำขอร้องทั่วไป' . $form->id . '.pdf');
    }

    public function userShowFormEdit($id)
    {
        $form = Form::with('attachments')->findOrFail($id); // ดึงข้อมูลฟอร์มพร้อมไฟล์แนบ

        return view('users_account_edit_form.users_account_edit_form', compact('form')); // ส่งข้อมูลไปยัง view
    }

    public function updateUserForm(Request $request, $id)
    {
        // Validation
        $request->validate([
            'date' => 'required|date',
            'subject' => 'required|string|max:255',
            'guest_salutation' => 'required|string',
            'guest_name' => 'required|string|max:255',
            'guest_age' => 'required|integer',
            'guest_phone' => 'required|string|max:20',
            'guest_house_number' => 'required|string|max:20',
            'guest_village' => 'required|string|max:50',
            'guest_subdistrict' => 'required|string|max:50',
            'guest_district' => 'required|string|max:50',
            'guest_province' => 'required|string|max:50',
            'request_details' => 'required|string',
            'attached_file_types' => 'required|array|min:1',
            'attached_file_types.*' => 'in:document1,document2,document3,document4',
            'document3_additional_info' => 'nullable|string|max:255',
            'document4_additional_info' => 'nullable|string|max:255',
        ]);

        $form = Form::findOrFail($id);

        $form->update([
            'date' => $request->date,
            'subject' => $request->subject,
            'request_details' => $request->request_details,
            'guest_salutation' => $request->guest_salutation,
            'guest_name' => $request->guest_name,
            'guest_age' => $request->guest_age,
            'guest_phone' => $request->guest_phone,
            'guest_house_number' => $request->guest_house_number,
            'guest_village' => $request->guest_village,
            'guest_subdistrict' => $request->guest_subdistrict,
            'guest_district' => $request->guest_district,
            'guest_province' => $request->guest_province,
            'attached_file_types' => implode(',', $request->attached_file_types),
            'document3_additional_info' => $request->document3_additional_info ?? null,
            'document4_additional_info' => $request->document4_additional_info ?? null,
        ]);

        if ($request->hasFile('attachments')) {
            $oldAttachments = FormAttachment::where('form_id', $form->id)->get();

            foreach ($oldAttachments as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
                $attachment->delete();
            }

            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('attachments', $filename, 'public');

                FormAttachment::create([
                    'form_id' => $form->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกอัปเดตเรียบร้อยแล้ว!');
    }

    public function userReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // dd($request);
        // dd(auth()->id());

        Reply::create([
            'form_id' => $formId,
            'user_id' => auth()->id(),
            'reply_text' => $request->message,
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }
}
