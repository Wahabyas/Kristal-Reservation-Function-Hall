<?php
session_start();
  require_once "../model/class_model.php";

   $_SESSION['user_id'];
	if(ISSET($_POST)){
		$conn = new class_model();
		$Fullname = $_POST['Fullname'];  
		$Lastname = $_POST['Lastname'];  
		$phoneNo = $_POST['phoneNo'];  
		$email = $_POST['email'];  
		$usernames = $_POST['usernames'];  

		$Middle = $_POST['Middle'];  
		$Gender = $_POST['Gender'];  

		$password = $_POST['password'];  
		$Id = $_POST['Id'];  
		

	
		 
	
		$course = $conn->edit_staff($Fullname, $Lastname,$phoneNo,$email,$Gender,$Middle, $usernames, $password, $Id);




		if($course == TRUE){
		    echo '<div class="alert badge bg-success">Update Success!</div><script> setTimeout(function() {  window.history.go(-1); }, 2000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Edit Event Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>
