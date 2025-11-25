<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sertifikat DOMPDF</title>

<style>
    @page {
        margin: 0;
        size: A4 landscape;
    }

    body {
        margin: 0;
        padding: 0;
        background: #000;
        font-family: 'Times New Roman', serif;
        color: #fff;
    }

    /* Ukuran fix A4 landscape */
    .container {
        width: 1123px;
        height: 794px;
        position: relative;
        overflow: hidden;
        border: 4px solid gold;
        box-sizing: border-box;
    }

    /* HEADER */
    h1 {
        margin-top: 60px;
        text-align: center;
        font-size: 60px;
        color: gold;
    }

    h2 {
        text-align: center;
        font-size: 32px;
        color: gold;
        margin-top: -10px;
    }

    .label {
        text-align: center;
        margin-top: 15px;
        font-size: 20px;
        letter-spacing: 2px;
    }

    .name {
        text-align: center;
        margin-top: 10px;
        font-size: 50px;
        font-weight: bold;
    }

    .course {
        margin-top: 5px;
        text-align: center;
        font-size: 26px;
    }

    /* GARIS PEMBATAS */
    .line {
        width: 300px;
        height: 3px;
        background: gold;
        margin: 10px auto 20px auto;
    }

    /* SIGNATURE ROW — sejajar horizontal */
    table.sign-row {
        width: 100%;
        margin-top: 40px;
        text-align:center;
    }

    /* DATE */
    .date {
        position: absolute;
        bottom: 130px;
        width: 100%;
        text-align: center;
        font-size: 18px;
    }
</style>

</head>
<body>

<div class="container">

    <h1>SERTIFIKAT</h1>
    <h2>OF ACHIEVEMENT</h2>

    <div class="label">THIS IS TO CERTIFY THAT</div>

    <div class="name">{{ $userName }}</div>

    <div class="line"></div>

    <div class="course">
        has successfully completed the course<br>
        <b>{{ $courseName }}</b>
    </div>

    <table class="sign-row">
        <tr>

            <td style="width:33%; vertical-align:top;">
                <img src="admin.png" style="width:150px; margin-bottom:5px;">
                <div>Administrator</div>
            </td>

            <td style="width:34%; vertical-align:top;">
                <img src="mendali.png" style="width:95px;">
            </td>

            <td style="width:33%; vertical-align:top;">
                <img src="guru.png" style="width:150px; margin-bottom:5px;">
                <div>Instructor</div>
            </td>

        </tr>
    </table>

    <!-- DATE — dijamin tampil -->
    <div class="date">
        {{ $date }}
    </div>

</div>

</body>
</html>
