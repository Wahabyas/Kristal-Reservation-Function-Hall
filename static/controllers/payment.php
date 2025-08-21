<?php
session_start();
require_once "../model/class_model.php";

$_SESSION['user_id'];

if (isset($_POST)) {
    $conn = new class_model(); 
    
    $Amount = intval(trim($_POST['Amount']));  
    $Amountwhere = intval(trim($_POST['Amountwhere']));  
    $event_id = intval(trim($_POST['event_id']));  
    $Date = trim($_POST['Date']);
    $Approved = "Approved";
    $user_id = $_SESSION['user_id'];
    $Ename = $_POST['Ename'];
    $Cid = $_POST['Cid'];
    $Dur = $_POST['Dur'];


    if ($Amount < $Amountwhere) {
        echo '<div class="alert alert-danger">Insufficient money!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
        exit;
    }

 $conn = new class_model(); 
 $dissapprove = "Declined";
    $disable = $conn->decline_allsimilar( $Dur, $Date, $event_id);


    $course = $conn->pay_events($Approved, $Amount, $user_id, $event_id);
   
    
    $Hitsory = $conn->Add_History($Ename, $Approved,$Amount, $Date, $Cid,$user_id);
   
   


    if ($course == TRUE) {
        echo '<div class="alert alert-success">The Record Has Been Paid Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Edit Event Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
    }
}
?>
