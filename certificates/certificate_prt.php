<?php
require_once "../component/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Certificate of Completion - Technova Training Institute</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Alex+Brush&display=swap');

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 40px;
      background: #e9e4da;
      font-family: 'Cormorant Garamond', serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .certificate {
      position: relative;
      width: 1100px;
      aspect-ratio: 10693400 / 7556500;
      background: #fffdf9;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
    }

    /* Bottom-left teal/gold diagonal ribbon */
    .ribbon {
      position: absolute;
      left: -2%;
      bottom: -4%;
      width: 60%;
      transform: scaleX(-1);
      z-index: 1;
      pointer-events: none;
    }

    /* Top-right teal/gold diagonal ribbon (mirrored) */
    .ribbon-top {
      position: absolute;
      right: -2%;
      top: -4%;
      width: 60%;
      transform: rotate(180deg) scaleX(-1);
      z-index: 1;
      pointer-events: none;
    }

    /* Gold corner ornament, top-left */
    .corner-tl {
      position: absolute;
      top: 28px;
      left: 28px;
      width: 130px;
      z-index: 3;
    }

    /* Gold corner ornament, bottom-right (rotated 180) */
    .corner-br {
      position: absolute;
      bottom: 28px;
      right: 28px;
      width: 130px;
      transform: rotate(180deg);
      z-index: 3;
    }

    .content {
      position: relative;
      z-index: 2;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 70px 100px 50px;
    }

    .logo {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 6px;
    }

    .logo img {
      width: 34px;
      height: auto;
    }

    .logo-text {
      font-size: 15px;
      letter-spacing: 2px;
      color: #15443E;
      font-weight: 600;
      text-transform: uppercase;
    }

    .title {
      font-size: 68px;
      letter-spacing: 10px;
      color: #15443E;
      font-weight: 600;
      margin: 4px 0 0;
      line-height: 1;
    }

    .subtitle {
      font-size: 20px;
      letter-spacing: 10px;
      color: #C9992F;
      font-weight: 500;
      margin: 6px 0 22px;
    }

    .presented-to {
      font-size: 14px;
      letter-spacing: 3px;
      color: #6b6b6b;
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    .student-name {
      font-family: 'Alex Brush', cursive;
      font-size: 58px;
      color: #15443E;
      margin: 4px 0 10px;
      line-height: 1;
    }

    .description {
      font-size: 17px;
      color: #4d4d4d;
      max-width: 560px;
      margin: 0 auto 22px;
      line-height: 1.5;
    }

    .fields {
      font-size: 14px;
      color: #333;
      margin-bottom: 4px;
    }

    .fields .blank {
      border-bottom: 1px solid #999;
      padding: 0 4px;
    }

    .fields-row {
      display: flex;
      gap: 24px;
      justify-content: center;
      margin-bottom: 28px;
      font-size: 14px;
      color: #333;
    }

    .footer {
      display: flex;
      align-items: flex-end;
      justify-content: center;
      gap: 100px;
      margin-top: 10px;
    }

    .footer-block {
      text-align: center;
      min-width: 200px;
    }

    .qr-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-width: 120px;
    }

    .qr-box .qr-label {
      margin-top: 8px;
      font-size: 11px;
      letter-spacing: 1.5px;
      color: #15443E;
      text-transform: uppercase;
      font-weight: 600;
    }

    .signature-img {
      height: 55px;
      margin-bottom: 2px;
    }

    .footer-line {
      border-top: 1.5px solid #15443E;
      padding-top: 6px;
      font-size: 13px;
      letter-spacing: 2px;
      color: #15443E;
      text-transform: uppercase;
      font-weight: 600;
    }

    .footer-sub {
      font-size: 12px;
      letter-spacing: 1px;
      color: #888;
      margin-top: 2px;
    }

    @media print {
      body {
        background: #fff;
        padding: 0;
      }

      .certificate {
        box-shadow: none;
      }
    }
  </style>
</head>

<body>
  <?php

  $certificate_id = $_GET['id'] ?? 0;
  $sql = "SELECT 
            certificates.certificate_no,
            certificates.issue_date,
            certificates.status,
            trainees.full_name,
            trainees.phone,
            trainees.dob,
            courses.course_name,
            batches.batch_name
        FROM certificates
        JOIN trainees 
            ON certificates.trainee_id = trainees.id
        JOIN courses 
            ON certificates.course_id = courses.id
        JOIN batches 
            ON certificates.batch_id = batches.id
        WHERE certificates.certificate_id = '$certificate_id'
        AND certificates.deleted_at IS NULL";

  $data = $crud->common_query($sql);
  if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array(
      'danger',
      'Error',
      'Certificate not found.'
    );
    header("Location: " . $base_url . "Certificates/index.php");
    exit;
  } else {
    $certificate = $data['data'][0];
    $issue_date = !empty($certificate->issue_date)
      ? date('d M, Y', strtotime($certificate->issue_date))
      : 'N/A';
    $completion_date = !empty($certificate->issue_date)
      ? date('d M, Y', strtotime($certificate->issue_date))
      : 'N/A';
  }
  ?>

  <div class="certificate">
    <div class="content">
      <div class="logo">
        <span class="logo-text">Technova Training Institute</span>
      </div>

      <h1 class="title">CERTIFICATE</h1>
      <div class="subtitle">OF COMPLETION</div>

      <div class="presented-to">This certificate is proudly presented to</div>
      <div class="student-name">
        <?= htmlspecialchars($certificate->full_name); ?>
      </div>

      <div class="description">
        This certificate is awarded to
        <strong><?= htmlspecialchars($certificate->full_name); ?></strong>
        in recognition of successful completion of the
        <strong><?= htmlspecialchars($certificate->course_name); ?></strong>
        training program.
      </div>

      <div class="fields-row">
        <div>Certificate No: <span class="blank"><?= htmlspecialchars($certificate->certificate_no); ?></span></div>
        <div>Issue Date: <span class="blank"><?= htmlspecialchars($issue_date); ?></span></div>
      </div>

      <div class="fields-row">
        <div>Program: <span class="blank"><?= htmlspecialchars($certificate->course_name); ?></span></div>
        <div>Batch: <span class="blank"><?= htmlspecialchars($certificate->batch_name); ?></span></div>
      </div>

      <div class="footer">
        <div class="footer-block">
          <div class="footer-line">DIRECTOR</div>
          <div class="footer-sub">Technova Training Institute</div>
        </div>

        <div class="qr-box">
          <div id="certificate-qr"></div>
          <div class="qr-label">Verify</div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script>
    const certificateUrl = "http://localhost/technova_training_institute/certificates/certificate.php?id=<?= (int) $certificate_id; ?>";
    new QRCode(document.getElementById("certificate-qr"), {
      text: certificateUrl,
      width: 96,
      height: 96,
      colorDark: "#15443E",
      colorLight: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H
    });

    window.addEventListener('load', (event) => {
      window.print();
      window.location.href = '<?= $base_url; ?>certificates/list.php'
    });
  </script>

</body>

</html>