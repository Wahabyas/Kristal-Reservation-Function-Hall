<?php

session_start();
  require_once "../model/class_model.php";;
	if(ISSET($_POST)){
		$conn = new class_model();
		$event_id = trim($_POST['event_id']);
		$Declined = "cancel";
		$user_ida= $_SESSION['user_id'];
		
		$course = $conn->disapprove_events($Declined,$event_id,$user_ida);
		if($course == TRUE){
		    echo '<div class="alert badge bg-danger">Declined event Successfully!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Declined Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

