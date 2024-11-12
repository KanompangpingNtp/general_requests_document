<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\FormAttachment;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    //
    public function userFormsIndex()
    {
        return view('users_form.users_form');
    }

    public function FormCreate(Request $request)
    {
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
            'attached_file_types' => 'required|array|min:1', // Ensure at least one checkbox is selected
            'attached_file_types.*' => 'in:document1,document2,document3,document4',
            'document3_additional_info' => 'nullable|string|max:255',
            'document4_additional_info' => 'nullable|string|max:255',
        ]);

        // Create new form entry
        $form = Form::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'subject' => $request->subject,
            'request_details' => $request->request_details,
            'status' => 1,
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

        // dd($form);

           if ($request->hasFile('attachments')) {
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

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งเรียบร้อยแล้ว!');
    }

}
