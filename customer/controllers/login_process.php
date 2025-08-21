<?php
   
    require '../model/class_model.php';

   
    if (isset($_POST['username']) && isset($_POST['password'])) {
      
        $conn = new class_model();

      
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        
        $get_student = $conn->login_student($username, $password);

     
        if ($get_student['count'] > 0) {
            session_start();  
            
            // Store user_id in the session
            $_SESSION['Customer_id'] = $get_student['Customer_id'];

           
            echo 1;
        } else {
           
            echo 0;
        }
    } else {
     
        echo "Error: Username or Password not set.";
    }
?>
