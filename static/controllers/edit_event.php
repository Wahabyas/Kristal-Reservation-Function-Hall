<?php
session_start();
  require_once "../model/class_model.php";

   $_SESSION['user_id'];
	if(ISSET($_POST)){
		$conn = new class_model();
		$Amount = intval(trim($_POST['Amount']));  
		$event_id = intval(trim($_POST['event_id']));  
		$Approved = "Payable";
		$user_id=$_SESSION['user_id'];
		$date = new DateTime(); 
		$date->modify('+1 days');
		$dates=$date->format('Y-m-d'); 
		$course = $conn->edit_events($Approved, $Amount,$user_id,$dates, $event_id);




		if($course == TRUE){
		    echo '<div class="alert badge bg-success">Price has been Established Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Edit Event Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>
