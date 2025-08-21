<?php
require '../model/class_model.php';
require '../model/config/connection2.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $fullname = $_POST['fullname'] ?? '';
    $Lastname = $_POST['Lastname'] ?? '';
    $Affiliation = $_POST['Affiliation'] ?? '';
    $Phone = $_POST['phoneNo'] ?? '';
    $email = $_POST['email'] ?? '';
    $Username = $_POST['usernames'] ?? '';
    $password = $_POST['password'] ?? '';
     $Middle = $_POST['middle'] ?? '';
    $Gender = $_POST['Gender'] ?? '';
    $status = 1;
    $connfsh = new class_model();
    $Search = $connfsh->searchfnameCustomer($Username);
    if($Search){
        echo "<div class=' alert-danger'>Username has already exist!</div>";
        exit; 
    }
    if (empty($fullname)  || empty($Phone) || empty($email) || empty($Username) || empty($password) ) {
        echo "<div class='alert alert-danger'>Please fill in all required fields!</div>";
        exit;
    }


    $sql = "INSERT INTO customer (	Fullname ,Lastname,Affiliation, `Phone No`, Email,`middle`,gender, Username, 	`Password`, `Status`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssssi", $fullname, $Lastname, $Affiliation  , $Phone, $email, $Middle, $Gender, $Username, $password, $status);

        if ($stmt->execute()) {
            echo "<div class='alert-successs'>please procced to login!</div><script> setTimeout(function() {  location.href = '../../Kristal%20Function%20hall/customer/login.php';
 }, 3000); </script>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Database error: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>
