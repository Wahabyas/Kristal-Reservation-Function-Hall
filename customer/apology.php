<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apology Letter</title>
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

$name=null;
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
      <p><strong>Date:</strong> <?= $row['currents_dates'] ?></p>
      <p><strong>To:</strong> Mr./Ms <?php
      $ids = $row['Customer_id'];
      $conn = new class_model();
        $custo = $conn->fetchAll_customer($ids);
       foreach ( $custo as $riw){
        echo $riw['Fullname'];
        $name =$riw['Fullname'];
       ?><br>
      Konoha<br>
    




      <p><strong>Subject:</strong> Apology for Booking Conflict on Requested Reservation Date</p>

      <p>Dear Mr. <?=  $name?>,</p>

      <p>We hope this letter finds you in good health and high spirits.</p>

      <p>We regret to inform you that the date you have selected for the reservation of the Krystal Function Hall on <strong><?= $row['date'] ?></strong> has unfortunately already been reserved for another event. We fully understand how important this event is for you and your team, and we deeply apologize for any inconvenience this scheduling conflict may have caused.</p>

      <p>We assure you that your interest in booking our facilities through the <strong>FUNCTION HALL RESERVATION AND BILLING SYSTEM</strong> is highly valued, and we are committed to providing you with the best possible service. As such, we would like to offer you alternative dates that may suit your schedule. Our team is more than happy to assist you in finding a suitable date that meets your needs.</p>

      <p>If you wish to discuss alternative dates or have any further inquiries, please feel free to contact us at <strong>functionhall@gmail.com</strong> or call us at <strong>09352736485</strong>. We are here to assist you in any way we can.</p>

      <p>Once again, we sincerely apologize for any inconvenience caused by this situation, and we appreciate your understanding and cooperation. We look forward to assisting you with your rescheduled event.</p>

      <p>Respectfully yours,</p>

      <div class="signature">
        <p><strong>Prof. Jalipha P. Ampog</strong><br>
        Function Hall Coordinator<br>
        Krystal Function Hall<br>
        <strong>FUNCTION HALL RESERVATION AND BILLING SYSTEM</strong></p>
      </div>
    </div>
<?php } ?>
    <div class="footer">
      <p>&copy; 2025 Krystal Function Hall. All Rights Reserved.</p>
    </div>
  </div>

  <div class="no-print">
    <button onclick="window.print()">🖨️ Print Letter</button>
  </div>
  <?php } ?>

</body>
</html>
