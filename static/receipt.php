<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Official Receipt</title>
  <style>
    @page {
      size: A4 portrait;
      margin: 30mm 25mm 30mm 25mm;
    }

    body {
      font-family: 'Times New Roman', Times, serif;
      margin: 0;
      padding: 0;
      background: #fff;
    }

    .invoice-box {
      width: 100%;
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #000;
      box-sizing: border-box;
    }

    h2, h3 {
      text-align: center;
      margin: 0;
    }

    h3 {
      font-weight: normal;
      font-size: 16px;
      margin-bottom: 20px;
    }

    .section {
      margin-top: 25px;
      line-height: 1.7;
      font-size: 14px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      font-size: 14px;
    }

    th, td {
      border: 1px solid #000;
      padding: 10px;
    }

    th {
      background-color: #f0f0f0;
    }

    .text-right {
      text-align: right;
    }

    .text-center {
      text-align: center;
    }

    .signature {
      margin-top: 50px;
      display: flex;
      justify-content: space-between;
      font-size: 14px;
    }

    .signature div {
      width: 45%;
      text-align: center;
    }

    .note {
      text-align: center;
      font-size: 12px;
      margin-top: 40px;
    }

    .no-print {
      text-align: center;
      margin-top: 20px;
    }

    @media print {
      .no-print {
        display: none;
      }

      .invoice-box {
        border: none;
      }
    }
  </style>
</head>
 <?php 
session_start();
require 'model/class_model.php';

$Smoney = 0;
$Cmoney = 0;
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
<body>
  <div class="invoice-box">
    <h2>Krystal Function Hall</h2>
    <h3>FUNCTION HALL RESERVATION AND BILLING SYSTEM</h3>
    <hr>

    <div class="section">
      <strong>Official Receipt No:</strong> <?= $row['code'] ?><br>
      <strong>Date Issued:</strong> <?= $row['currents_dates'] ?><br>
      <strong>Payment Status:</strong> <em>Fully Paid</em>
    </div>

    <div class="section">
      <strong>Received From:</strong><br>
      Mr./Ms. <?php
      $ids = $row['Customer_id'];
      $conn = new class_model();
        $custo = $conn->fetchAll_customer($ids);
       foreach ( $custo as $riw){
        echo $riw['Fullname'];
     
     ?><br>
      Affiliation: <?= $riw['Affiliation'] ?><br>
      Contact Number: <?= $riw['Phone No'] ?><br>
      Email Address: <?= $riw['Email'] ?>
    </div>
<?php } ?>
    <div class="section">
      <strong>Reservation Details:</strong><br>
      Reserved Venue: Krystal Function Hall<br>
      Reservation Date: <?= $row['date'] ?><br>
      Event Purpose: <?= $row['events'] ?>
    </div>

    <div class="section">
      <strong>Billing Summary:</strong>
      <table>
        <thead>
          <tr>
            <th>Description of Charges</th>
            <th class="text-center">Quantity</th>
            <th class="text-right">Unit Cost (₱)</th>
            <th class="text-right">Amount (₱)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Venue Reservation Fee</td>
            <td class="text-center">1</td>
            <?php  $Smoney=$row['Amount'] ?>
            <td class="text-right"><?php echo $row['Amount'] ?>.00</td>
            <td class="text-right"><?php echo $row['Amount'] ?>.00</td>
          </tr>
          <tr>
            <td>Client money</td>
            <td class="text-center">1</td>
            <?php $Cmoney= $row['MoC'] ?>
            <td class="text-right"><?php echo $row['MoC'] ?>.00</td>
            <td class="text-right"><?php echo $row['MoC'] ?>.00</td>
          </tr>
        </tbody>
        <tfoot>
         <?php  $total= $Cmoney - $Smoney; ?>
        
          <tr>
            <th colspan="3" class="text-right">Total Amount of Change</th>
            <th class="text-right"><strong><?= $total ?>.00</strong></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="signature">
      <div>
        ___________________________<br>
        <strong>Authorized Officer</strong><br>
        Date: ____________
      </div>
      <div>
        ___________________________<br>
        <strong>Client's Signature</strong><br>
        Date: ____________
      </div>
    </div>

    <div class="note">
      This document serves as an official proof of transaction.<br>
      Printed copies are valid even without signature if generated directly from the Function Hall Reservation and Billing System.
    </div>
  </div>
<?php } ?>
  <div class="no-print">
    <button onclick="window.print()">🖨️ Print Receipt</button>
  </div>
</body>
</html>
