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
		$password = $_POST['password'];  
		$Middle = $_POST['Middle'];  
		$Gender = $_POST['Gender'];  
	
	
		
		$checkusename = $conn->searchfname($usernames);

		if($checkusename == TRUE){
			echo '<div class="alert alert-danger">Username has already exist!</div><script> setTimeout(function() {  window.history.go(-0); }, 120000); </script>';
		}else{
			$course = $conn->Add_staff($Fullname, $Lastname,$phoneNo,$email,$Gender,$Middle,$usernames,$password);
		if($course == TRUE){
		    echo '<div class="alert badge bg-success">Staff has been Added Successfully Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 3000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Edit Event Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 3000); </script>';
		}
	}
	}
?>
