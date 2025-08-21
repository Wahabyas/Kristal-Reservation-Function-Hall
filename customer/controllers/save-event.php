<?php
require '../model/config/connection2.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];  
    $event = $_POST['event'];  
    $duration = $_POST['duration'];  

   
    $sql_max = "SELECT MAX(sort) AS sort FROM events";
    $result = $conn->query($sql_max);
    $row = $result ? $result->fetch_assoc() : ['sort' => 0];
    $next_delete_value = $row['sort'] + 1; 

    $Customer_id = (int)$_POST['Customer_id'];

    function generateInvoiceCode() {
        $prefix = "INV";
        $year = date("Y"); 
        $randomNumber = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
    
        return "$prefix-$year-$randomNumber";
    }
    $invoiceCode = generateInvoiceCode();
    $stmt = $conn->prepare("INSERT INTO events (date, events, code ,Duration,sort, Customer_id ) VALUES (?,?, ?,?,?,?)");
    $stmt->bind_param("sssssi", $date, $event , $invoiceCode ,$duration,$next_delete_value, $Customer_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "date" => $date]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
