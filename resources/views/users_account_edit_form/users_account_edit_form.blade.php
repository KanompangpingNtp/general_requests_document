@extends('layout.users_account_layout')
@section('account_layout')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif


<div class="container">
    <a href="{{ route('userRecordForm')}}">กลับหน้าเดิม</a><br><br>
    <h2 class="text-center">แก้ไขฟอร์ม</h2><br>
    <form action="{{ route('updateUserForm', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="form_id" value="{{ $form->id }}">

        <div class="row col-md-3">
            <label for="date">วันเดือนปี</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $form->date }}" required>
        </div>
        <br>
        <div class="row col-md-4">
            <label for="subject">เรื่อง</label>
            <input type="text" class="form-control" id="subject" name="subject" value="{{ $form->subject }}" required>
        </div>
        <br>

        <div class="row">
            <div class="col-md-2">
                <label for="guest_salutation" class="form-label">คำนำหน้า<span class="text-danger">*</span></label>
                <select class="form-select" id="guest_salutation" name="guest_salutation">
                    <option value="" disabled {{ is_null($form->guest_salutation) ? 'selected' : '' }}>เลือกคำนำหน้า</option>
                    <option value="นาย" {{ $form->guest_salutation === 'นาย' ? 'selected' : '' }}>นาย</option>
                    <option value="นาง" {{ $form->guest_salutation === 'นาง' ? 'selected' : '' }}>นาง</option>
                    <option value="นางสาว" {{ $form->guest_salutation === 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="guest_name">ชื่อ</label>
                <input type="text" class="form-control" id="guest_name" name="guest_name" value="{{ $form->guest_name }}" required>
            </div>
            <div class="col-md-2">
                <label for="guest_age">อายุ</label>
                <input type="number" class="form-control" id="guest_age" name="guest_age" value="{{ $form->guest_age }}" required>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="form-group col-md-3">
                <label for="guest_phone">อยู่บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_phone" name="guest_phone" value="{{ $form->guest_phone }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="guest_house_number">บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_house_number" name="guest_house_number" value="{{ $form->guest_house_number }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="guest_village">หมู่ที่</label>
                <input type="text" class="form-control" id="guest_village" name="guest_village" value="{{ $form->guest_village }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="guest_subdistrict">ตำบล</label>
                <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict" value="{{ $form->guest_subdistrict }}" required>
            </div>
            <div class="form-group col-md-3 mt-3">
                <label for="guest_district">อำเภอ</label>
                <input type="text" class="form-control" id="guest_district" name="guest_district" value="{{ $form->guest_district }}" required>
            </div>
            <div class="form-group col-md-3 mt-3">
                <label for="guest_province">จังหวัด</label>
                <input type="text" class="form-control" id="guest_province" name="guest_province" value="{{ $form->guest_province }}" required>
            </div>
        </div>

        <br>

        <div class="row col-md-6">
            <label for="request_details">มีความประสงค์</label>
            <textarea class="form-control" id="request_details" name="request_details" rows="3" required>{{ $form->request_details }}</textarea>
        </div>
        <br>
        <div class="form-group col-md-6">
            <label>เอกสารแนบเพิ่มเติม</label>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="attached_file_types[]" value="document1" id="document1" {{ in_array('document1', is_array($form->attached_file_types) ? $form->attached_file_types : explode(',', $form->attached_file_types ?? '')) ? 'checked' : '' }}>
                <label class="form-check-label" for="document1">สำเนาทะเบียนบ้าน</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="attached_file_types[]" value="document2" id="document2" {{ in_array('document2', is_array($form->attached_file_types) ? $form->attached_file_types : explode(',', $form->attached_file_types ?? '')) ? 'checked' : '' }}>
                <label class="form-check-label" for="document2">สำเนาบัตรประชาชน</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="attached_file_types[]" value="document3" id="document3" {{ in_array('document3', is_array($form->attached_file_types) ? $form->attached_file_types : explode(',', $form->attached_file_types ?? '')) ? 'checked' : '' }}>
                <label class="form-check-label" for="document3">คำร้องขอ</label>
                <!-- ช่องกรอกข้อมูลเพิ่มเติม -->
                <input type="text" class="form-control mt-2" name="document3_additional_info" id="document3_info" placeholder="กรุณากรอกข้อมูลเพิ่มเติม" style="{{ in_array('document3', is_array($form->attached_file_types) ? $form->attached_file_types : explode(',', $form->attached_file_types ?? '')) ? 'display:block;' : 'display:none;' }}" value="{{ old('document3_additional_info', $form->document3_additional_info) }}">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="attached_file_types[]" value="document4" id="document4" {{ in_array('document4', is_array($form->attached_file_types) ? $form->attached_file_types : explode(',', $form->attached_file_types ?? '')) ? 'checked' : '' }}>
                <label class="form-check-label" for="document4">อื่นๆ</label>
                <!-- ช่องกรอกข้อมูลเพิ่มเติม -->
                <input type="text" class="form-control mt-2" name="document4_additional_info" id="document4_info" placeholder="กรุณากรอกข้อมูลเพิ่มเติม" style="{{ in_array('document4', is_array($form->attached_file_types) ? $form->attached_file_types : explode(',', $form->attached_file_types ?? '')) ? 'display:block;' : 'display:none;' }}" value="{{ old('document4_additional_info', $form->document4_additional_info) }}">
            </div>
        </div>
        <br>

        <div class="mb-3 col-md-5">
            <label for="attachments" class="form-label">เลือกไฟล์</label>
            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
        </div>
        <div class="mb-3 col-md-8">
            <label>ไฟล์ที่แนบไว้แล้ว:</label>
            @foreach ($form->attachments as $attachment)
            <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">{{ basename($attachment->file_path) }}</a>
            @endforeach
        </div>

        <br>

        <button type="submit" class="btn btn-primary">ส่งฟอร์ม</button>
    </form>
</div>

<script>
    document.getElementById('add-file').addEventListener('click', function() {
        var attachmentsContainer = document.getElementById('attachments');
        var currentFiles = attachmentsContainer.getElementsByTagName('input').length;

        // จำกัดจำนวนไฟล์สูงสุดเป็น 4
        if (currentFiles < 4) {
            var newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'attachments[]';
            newInput.classList.add('form-control', 'mb-3'); // เพิ่มคลาส mb-4 ที่นี่

            // เพิ่ม input ใหม่ไปที่ container
            attachmentsContainer.appendChild(newInput);
        } else {
            alert('คุณสามารถเพิ่มไฟล์ได้สูงสุด 4 ไฟล์เท่านั้น');
        }
    });

</script>

<script>
    document.getElementById('document3').addEventListener('change', function() {
        const input = document.getElementById('document3_info');
        if (this.checked) {
            input.style.display = 'block';
        } else {
            input.style.display = 'none';
            input.value = '';
        }
    });

    document.getElementById('document4').addEventListener('change', function() {
        const input = document.getElementById('document4_info');
        if (this.checked) {
            input.style.display = 'block';
        } else {
            input.style.display = 'none';
            input.value = '';
        }
    });

</script>

@endsection
