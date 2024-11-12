<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        @font-face {
            font-family: 'sarabun';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'sarabun';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'sarabun';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'sarabun';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: 'sarabun', sans-serif;
            font-size: 16px;
            margin-left: 80px;
            margin-right: 20px;
            line-height: 8px;
        }

        h3 {
            text-align: center;
            margin-top: 0;
        }

        .right {
            text-align: right;
        }

        .underline {
            text-decoration: underline;
            display: inline-block;
            width: auto;
        }

        .content-section {
            margin-bottom: 20px;
        }

        .content-section p {
            line-height: 2;
            margin: 0;
        }

        .signature-section {
            margin-top: 30px;
        }

        .signature-line {
            display: inline-block;
            width: 300px;
            border-bottom: 1px solid #000;
            margin-top: 20px;
        }

        .note {
            margin-top: 50px;
        }

        .note p {
            margin: 5px 0;
        }

        .officer-note {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .officer-note-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 12px;
        }

        .dotted-line {
            border-bottom: 1px dotted #000;
            width: 100%;
            height: 20px;
            margin-bottom: 5px;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
        }

        .column {
            width: 48%;
        }

        .column p {
            margin: 10px 0;
        }

        span.fullname {
            border-bottom: 1px dashed;
            padding-left: 20px;
            padding-right: 100px;
            color: blue;
        }

        span.fullname_2 {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }

        span.age {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }

        span.occupation {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 100px;
            color: blue;
        }

        span.house_no {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }

        span.village_no {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 20px;
            color: blue;
        }

        span.alley {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 40px;
            color: blue;
        }

        span.road {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }

        span.sub_district {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 20px;
            color: blue;
        }

        span.district {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }

        span.province {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 80px;
            color: blue;
        }

        span.phone {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 150px;
            color: blue;
        }

        span.submission {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 100px;
            color: blue;
            overflow-wrap: break-word;
        }

        span.document_count {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }

        span.location {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 20px;
            color: blue;
        }

        span.day {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 5px;
            color: blue;
        }

        span.month {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 5px;
            color: blue;
        }

        span.year {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 5px;
            color: blue;
        }

        span.submission_name {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 5px;
            color: blue;
        }

    </style>
    <title>PDF Report</title>
</head>
<body>

    @php
    use Carbon\Carbon;

    // กำหนดวันในรูปแบบ Carbon เพื่อดึงค่า
    $date = Carbon::parse($form->date);

    // แปลงปีพุทธศักราช
    $thaiYear = $date->year + 543;

    // แปลงเดือนเป็นชื่อภาษาไทย
    $thaiMonths = [
    1 => 'มกราคม',
    2 => 'กุมภาพันธ์',
    3 => 'มีนาคม',
    4 => 'เมษายน',
    5 => 'พฤษภาคม',
    6 => 'มิถุนายน',
    7 => 'กรกฎาคม',
    8 => 'สิงหาคม',
    9 => 'กันยายน',
    10 => 'ตุลาคม',
    11 => 'พฤศจิกายน',
    12 => 'ธันวาคม'
    ];

    // กำหนดชื่อเดือน
    $thaiMonth = $thaiMonths[$date->month];
    $thaiDay = $date->day;
    @endphp

    <div class="container">
        <h3>คำร้องทั่วไป</h3>

        <p class="right">เขียนที่ องค์การบริหารส่วนตำบลทับพริก</p>
        <p class="right">วันที่<span class="day">{{ $thaiDay }}</span>เดือน<span class="month">{{ $thaiMonth }}</span>ปี<span class="year">{{ $thaiYear }}</span></p>

        <p style="margin-left: 55px; margin-top:30px;">ข้าพเจ้า <span class="fullname">{{ $form->guest_salutation }}{{ $form->guest_name }}</span> อายุ <span class="age">{{ $form->guest_age }}</span>ปี อยู่บ้านเลขที่<span class="house_no">{{ $form->guest_house_number	 }}</span></p>
        <p>หมู่ที่<span class="village_no">{{ $form->guest_village }}</span>ตำบล<span class="sub_district">{{ $form->guest_subdistrict }}</span>อำเภอ<span class="district">{{ $form->guest_district }}</span>จังหวัด<span class="province">{{ $form->guest_province }}</span></p>
        <p>ขอยื่นคำร้องต่อองค์การบริหารส่วนตำบลทับพริก ดังนี้</p>

        <p style="margin-left: 55px;">ด้วยข้าพเจ้ามีความประสงค์<span class="submission">{{ $form->request_details }}</span></p>
        <p>ทั้ง ข้าพเจ้ายอมรับปฏิบัติตามระเบียบแบบแผนของทางราชการทุกประการ</p>
        <p style="margin-left: 55px;">เอกสารที่แนบคำร้องมีดังนี้</p>
        <p style="margin-left: 55px;">
            <input type="checkbox" {{ in_array('document1', explode(',', $form->attached_file_types)) ? 'checked' : '' }} disabled>
            สำเนาทะเบียนบ้าน
            <br>
            <input type="checkbox" {{ in_array('document2', explode(',', $form->attached_file_types)) ? 'checked' : '' }} disabled>
            สำเนาบัตรประชาชน
            <br>
            <input type="checkbox" {{ in_array('document3', explode(',', $form->attached_file_types)) ? 'checked' : '' }} disabled>
            คำร้องขอ <span class="province">{{$form->document3_additional_info}}</span>
            <br>
            <input type="checkbox" {{ in_array('document4', explode(',', $form->attached_file_types)) ? 'checked' : '' }} disabled>
            อื่นๆ <span class="province">{{$form->document4_additional_info}}</span>
            <br>
            <br>
            ฉะนั้น จึงเรียนมาได้โปรดพิจารณา
        </p>

        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <!-- คอลัมน์ซ้าย -->
                <td style="width: 50%; vertical-align: top;">

                </td>

                <!-- คอลัมน์ขวา -->
                <td style="width: 50%; vertical-align: top; text-align: center;">
                    <p>ลงชื่อ <span class="fullname_2">{{ $form->guest_name }}</span>ผู้ยื่นคำร้อง</p>
                    <p>( <span class="fullname_2">{{ $form->guest_salutation }}{{ $form->guest_name }}</span> )</p>
                </td>
            </tr>
        </table>

        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <!-- คอลัมน์ซ้าย -->
                <td style="width: 50%; vertical-align: top; border-top: 2px solid black; padding-top: 10px;">
                    <div class="content">
                        <p>เรียน ผู้อำนวยการกองคลัง </p>
                        <p>......................................................................................</p>
                        <p>......................................................................................</p><br>
                        <p>ลงชื่อ......................................................เจ้าหน้าที่ผู้รับคำร้อง</p>
                        <p>(....................................................................)</p>
                        <p>ตำแหน่ง...................................................................</p>
                    </div>
                    {{-- <div class="signature">
                            <p style="margin-left: 80px;">(นายชัยยัน ศรีกะชา)</p>
                            <p style="margin-left: 85px;">หัวหน้าสำนักปลัด</p>
                        </div> --}}
                </td>

                <!-- คอลัมน์ขวา -->
                <td style="width: 50%; vertical-align: top; border-top: 2px solid black; padding-top: 10px;">
                    <div class="content" style="margin-left: 25px;">
                        <p>เรียน ปลัดกองค์การบริหารส่วนตำบลทับพริก</p>
                        <p>......................................................................................</p>
                        <p>......................................................................................</p><br>
                        <div style="text-align: center;">
                            <p>ลงชื่อ......................................................</p>
                            <p>(....................................................................)</p>
                            <p>ตำแหน่ง...................................................................</p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <p>ความเห็นปลัดกองค์การบริหารส่วนตำบลทับพริก</p>
        <p>....................................................................................................................................................................................................................................................</p>
        <p>....................................................................................................................................................................................................................................................</p>

        <br>

        <div style="text-align: center;">
            <p>(นางภัทรวดี ธนะโรจชูเดช)</p>
            <p>ปลัดกองค์การบริหารส่วนตำบลทับพริก</p>
        </div>

        <p>คำสั่งนายกองค์การบริหารส่วนตำบลทับพริก</p>
        <p><input type="checkbox">อนุมัติ <input type="checkbox" style="margin-left: 30px;">ไม่อนุมัติ </p>
        <p>....................................................................................................................................................................................................................................................</p>
        <p>....................................................................................................................................................................................................................................................</p>

    </div>

</body>


</html>
