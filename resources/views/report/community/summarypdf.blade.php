<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body{
            font-family: "Promt"
        }
    </style>
</head>

<body>

    <h5>เกณฑ์มาตรฐานการบริหารจัดการแหล่งท่องเที่ยวโดยชุมชน</h5>

    <table>
        <tbody>
            <tr class="text-center">
                <td colspan="6">

                </td>
            </tr>
            <tr class="text-center">
                <td colspan="6">
                    <h5>องค์การบริหารการพัฒนาพื้นที่พิเศษเพื่อการท่องเที่ยวอย่างยั่งยืน (อพท.)</h5>
                </td>
            </tr>
            <tr>
                <td colspan="6"><strong>ชื่อชุมชน</strong> {{session()->get('community_name')}}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>ตำบล</strong></td>
                <td colspan="2"><strong>อำเภอ</strong></td>
                <td colspan="2"><strong>จังหวัด</strong></td>
            </tr>
            <tr>
                <td colspan="3"><strong>เขตพื้นที่องค์กรปกครองส่วนท้องถิ่น (อบต./เทศบาล)</strong></td>
                <td colspan="3"><strong>ในเขตพื้นที่พิเศษ</strong></td>
            </tr>
            <tr>
                <td colspan="6"><strong>คณะผู้ตรวจประเมิน</strong></td>
            </tr>
            <tr>
                @foreach ($user_evaluate as $key => $item)
                <td>{{($key + 1).'. '.$item->full_name}}</td>
                @endforeach
            </tr>
            <tr>
                <td colspan="6"><strong>เจ้าหน้าที่อพท.</strong></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td colspan="6"><strong>วันที่ตรวจประเมิน</strong> {{$date_thai}}</td>
            </tr>
            <tr>
                <td colspan="6"><strong>ครั้งที่ได้รับการตรวจประเมิน</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>