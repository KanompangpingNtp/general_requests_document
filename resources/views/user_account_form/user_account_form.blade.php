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
    <h3>กรอกข้อมูลฟอร์ม</h3><br>
    <form action="{{ route('FormCreate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-md-3">
            <label for="date">วันเดือนปี</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <br>
        <div class="form-group col-md-4">
            <label for="subject">เรื่อง</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <br>

        <div class="row">
            <div class="col-md-2">
                <label for="guest_salutation" class="form-label">คำนำหน้า<span class="text-danger">*</span></label>
                <select class="form-select" id="guest_salutation" name="guest_salutation">
                    <option value="" selected disabled>เลือกคำนำหน้า</option>
                    <option value="นาย" {{ old('guest_salutation', $user->userDetail->salutation ?? '') == 'นาย' ? 'selected' : '' }}>นาย</option>
                    <option value="นาง" {{ old('guest_salutation', $user->userDetail->salutation ?? '') == 'นาง' ? 'selected' : '' }}>นาง</option>
                    <option value="นางสาว" {{ old('guest_salutation', $user->userDetail->salutation ?? '') == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="guest_name" class="form-label">ชื่อ - สกุล<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="guest_name" name="guest_name" placeholder="ชื่อ - นามสกุล" value="{{ old('fullname', $user->name ?? '') }}" required>
            </div>
            <div class="col-md-1">
                <label for="guest_age" class="form-label">อายุ<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="guest_age" name="guest_age" placeholder="โปรดระบุ" value="{{ old('guest_age', $user->userDetail->age ?? '') }}" required>
            </div>
            <div class="col-md-3">
                <label for="guest_phone" class="form-label">เบอร์มือถือ</label>
                <input type="text" class="form-control" id="guest_phone" name="guest_phone" value="{{ old('guest_age', $user->userDetail->phone ?? '') }}" required>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-3">
                <label for="guest_house_number" class="form-label">บ้านเลขที่</label>
                <input type="text" class="form-control" id="guest_house_number" name="guest_house_number" value="{{ old('guest_age', $user->userDetail->house_number ?? '') }}" required>
            </div>
            <div class="col-md-2">
                <label for="guest_village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="guest_village" name="guest_village" value="{{ old('guest_age', $user->userDetail->village ?? '') }}" required>
            </div>
            <div class="col-md-3">
                <label for="guest_subdistrict" class="form-label">ตำบล</label>
                <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict" value="{{ old('guest_age', $user->userDetail->subdistrict ?? '') }}" required>
            </div>
            <div class="col-md-3">
                <label for="guest_district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="guest_district" name="guest_district" value="{{ old('guest_age', $user->userDetail->district ?? '') }}" required>
            </div>
            <div class="col-md-3">
                <label for="guest_province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="guest_province" name="guest_province" value="{{ old('guest_age', $user->userDetail->province ?? '') }}" required>
            </div>
        </div>

        <br>

        <div class="form-group col-md-6">
            <label for="request_details" class="form-label">มีความประสงค์</label>
            <textarea class="form-control" id="request_details" name="request_details" rows="3" required></textarea>
        </div>

        <br>

        <div class="form-group col-md-6">
            <label>เอกสารแนบเพิ่มเติม</label>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="attached_file_types[]" value="document1" id="document1">
                <label class="form-check-label" for="document1">สำเนาทะเบียนบ้าน</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="attached_file_types[]" value="document2" id="document2">
                <label class="form-check-label" for="document2">สำเนาบัตรประชาชน</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="attached_file_types[]" value="document3" id="document3">
                <label class="form-check-label" for="document3">คำร้องขอ</label>
                <!-- ช่องกรอกข้อมูลเพิ่มเติม -->
                <input type="text" class="form-control mt-2" name="document3_additional_info" id="document3_info" placeholder="กรุณากรอกข้อมูลเพิ่มเติม" style="display:none;">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="attached_file_types[]" value="document4" id="document4">
                <label class="form-check-label" for="document4">อื่นๆ</label>
                <!-- ช่องกรอกข้อมูลเพิ่มเติม -->
                <input type="text" class="form-control mt-2" name="document4_additional_info" id="document4_info" placeholder="กรุณากรอกข้อมูลเพิ่มเติม" style="display:none;">
            </div>
        </div>
        <br>
        <div class="form-group col-md-5" id="attachments-container">
            <label for="attachments">แนบไฟล์ (ภาพหรือเอกสาร) <button type="button" class="btn btn-primary btn-sm mb-1" id="add-file">เพิ่มไฟล์</button></label>
            <div id="attachments">
                <input type="file" class="form-control mb-3" name="attachments[]" multiple>
            </div>
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
