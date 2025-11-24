<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            width: 297mm;
            height: 210mm;
            margin: 0;
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        /* Decorative elements */
        .bg-pattern {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255, 255, 255, .1) 35px, rgba(255, 255, 255, .1) 70px);
        }

        .circle-deco {
            position: absolute;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .circle-1 {
            width: 400px;
            height: 400px;
            top: -200px;
            right: -200px;
        }

        .circle-2 {
            width: 300px;
            height: 300px;
            bottom: -150px;
            left: -150px;
        }

        .certificate-container {
            position: relative;
            width: 90%;
            height: 90%;
            margin: 5% auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        /* Header gradient bar */
        .header-bar {
            height: 8px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }

        /* Content wrapper */
        .content {
            padding: 60px 80px;
            position: relative;
            height: calc(100% - 8px);
        }

        /* Corner decorations */
        .corner-deco {
            position: absolute;
            width: 80px;
            height: 80px;
            border: 3px solid #667eea;
        }

        .corner-tl {
            top: 40px;
            left: 40px;
            border-right: none;
            border-bottom: none;
        }

        .corner-tr {
            top: 40px;
            right: 40px;
            border-left: none;
            border-bottom: none;
        }

        .corner-bl {
            bottom: 40px;
            left: 40px;
            border-right: none;
            border-top: none;
        }

        .corner-br {
            bottom: 40px;
            right: 40px;
            border-left: none;
            border-top: none;
        }

        /* Badge/Logo area */
        .badge {
            text-align: center;
            margin-bottom: 35px;
        }

        .badge-circle {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .badge-icon {
            font-size: 48px;
            color: white;
        }

        /* Title section */
        .cert-title {
            text-align: center;
            margin-bottom: 2px;
        }

        .cert-title h1 {
            font-family: 'Playfair Display', serif;
            font-size: 52px;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 2px;
            margin-bottom: 2px;
        }

        .cert-subtitle {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 300;
        }

        /* Divider */
        .divider {
            width: 120px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #667eea, transparent);
            margin: 5px auto;
        }

        /* Name section */
        .recipient {
            text-align: center;
            margin: 10px 0;
        }

        .label {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 2cmpx;
        }

        .name {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .underline {
            width: 400px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, transparent);
            margin: 0 auto;
        }

        /* Course section */
        .course-section {
            text-align: center;
            margin: 2px 0;
        }

        .course-intro {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            color: #666;
            margin-bottom: 2px;
        }

        .course-title {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            padding: 15px 40px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-radius: 10px;
            display: inline-block;
        }

        /* Footer section */
        .footer-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 10px;
            padding: 0 50px;
        }

        .signature-box {
            text-align: center;
            flex: 1;
        }

        .signature-line {
            width: 200px;
            height: 2px;
            background: #ddd;
            margin: 0 auto 10px auto;
        }

        .signature-name {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .signature-role {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: #888;
        }

        .date-section {
            text-align: center;
            margin-top: 2px;
        }

        .date-text {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: #888;
        }

        /* Accent dots */
        .accent-dot {
            width: 8px;
            height: 8px;
            background: #667eea;
            border-radius: 50%;
            display: inline-block;
            margin: 0 5px;
        }
    </style>
</head>

<body>
    <div class="bg-pattern"></div>
    <div class="circle-deco circle-1"></div>
    <div class="circle-deco circle-2"></div>

    <div class="certificate-container">
        <div class="header-bar"></div>

        <div class="content">
            <!-- Corner decorations -->
            <div class="corner-deco corner-tl"></div>
            <div class="corner-deco corner-tr"></div>
            <div class="corner-deco corner-bl"></div>
            <div class="corner-deco corner-br"></div>

            <!-- Badge -->
            <div class="badge">
                <div class="badge-circle">
                    <span class="badge-icon">★</span>
                </div>
            </div>

            <!-- Title -->
            <div class="cert-title">
                <h1>CERTIFICATE</h1>
                <p class="cert-subtitle">of achievement</p>
            </div>

            <div class="divider"></div>

            <!-- Recipient -->
            <div class="recipient">
                <p class="label">This is to certify that</p>
                <div class="name">{{ $userName }}</div>
                <div class="underline"></div>
            </div>

            <!-- Course -->
            <div class="course-section">
                <p class="course-intro">has successfully completed the course</p>
                <div class="course-title">{{ $courseName }}</div>
            </div>

            <!-- Date -->
            <div class="date-section">
                <span class="accent-dot"></span>
                <span class="date-text">Issued on {{ $date }}</span>
                <span class="accent-dot"></span>
            </div>

            <!-- Signatures -->
            <div class="footer-section">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-name">Admin Kursus</div>
                    <div class="signature-role">Course Administrator</div>
                </div>

                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-name">{{ $courseName }}</div>
                    <div class="signature-role">Course Instructor</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>