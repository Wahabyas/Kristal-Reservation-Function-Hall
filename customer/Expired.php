<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apology Letter - Expired Request</title>
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      border: 1px solid black;
      background-color: white;
    }

    .header {
      text-align: center;
    }

    .header h2 {
      margin: 0;
      font-size: 22px;
    }

    .header h3 {
      margin: 5px 0;
      font-size: 16px;
    }

    .content {
      margin-top: 40px;
      line-height: 1.6;
    }

    .content p {
      font-size: 16px;
    }

    .footer {
      margin-top: 60px;
      text-align: center;
      font-size: 14px;
    }

    .signature {
      margin-top: 60px;
    }

    .signature p {
      font-size: 16px;
      font-weight: bold;
    }

    .signature p span {
      font-size: 14px;
      font-weight: normal;
    }

    .no-print {
      text-align: center;
      margin-top: 30px;
    }

    .no-print button {
      border: 1px solid black;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }

    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>
<body>
<?php 
session_start();
require 'model/class_model.php';

$name = null;
$conn = new class_model();

require_once 'model/config/connection2.php'; 

$GET_id = intval($_GET['event']);
$folder_name = $_GET['event-name'];
$sql = "SELECT * FROM `events` WHERE `id`= ? AND `events` = ?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("is", $GET_id, $folder_name);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
?>

<div class="container">
  <div class="header">
    <h2>FUNCTION HALL RESERVATION AND BILLING SYSTEM</h2>
    <h3>Office of Krystal Function Hall</h3>
    <p>Marawi City, Lanao del Sur</p>
  </div>

  <div class="content">
    <p><strong>Date:</strong> <?= date('Y-m-d') ?></p>
    <p><strong>To:</strong> Mr./Ms 
    <?php
      $ids = $row['Customer_id'];
      $conn = new class_model();
      $custo = $conn->fetchAll_customer($ids);
      foreach ($custo as $riw){
        echo $riw['Fullname'];
        $name = $riw['Fullname'];
      }
    ?><br><br>

    <p><strong>Subject:</strong> Apology for Expired Booking Request</p>

    <p>Dear Mr./Ms <?= $name ?>,</p>

    <p>We hope this message finds you well.</p>

    <p>We regret to inform you that your request to reserve the Krystal Function Hall for the date <strong><?= $row['date'] ?></strong> has unfortunately expired due to the passing of the request deadline without confirmation or necessary action.</p>

    <p>As much as we value your interest in our venue, our policy requires timely confirmation to secure your reservation. Without this, we are unable to hold the date indefinitely, and as such, it has been released back into our available slots.</p>

    <p>We understand how important this reservation may have been to you, and we sincerely apologize for any inconvenience this may have caused. We would be more than happy to help you select another available date that suits your schedule.</p>

    <p>Please feel free to reach out to us at <strong>functionhall@gmail.com</strong> or call <strong>09352736485</strong> so we may assist you further.</p>

    <p>We thank you for your understanding and look forward to serving you in the future.</p>

    <p>Respectfully yours,</p>

    <div class="signature">
      <p><strong>Prof. Jalipha P. Ampog</strong><br>
      Function Hall Coordinator<br>
      Krystal Function Hall<br>
      <strong>FUNCTION HALL RESERVATION AND BILLING SYSTEM</strong></p>
    </div>
  </div>

  <div class="footer">
    <p>&copy; 2025 Krystal Function Hall. All Rights Reserved.</p>
  </div>
</div>

<div class="no-print">
  <button onclick="window.print()">🖨️ Print Letter</button>
  <button onclick="window.history.back()">🔙 Go Back</button>
</div>
<?php } ?>
</body>
</html>
