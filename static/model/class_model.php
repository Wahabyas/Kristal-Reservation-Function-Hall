<?php

	require 'config/connection.php';

	class class_model{

		public $host = db_host;
		public $user = db_user;
		public $pass = db_pass;
		public $dbname = db_name;
		public $conn;
		public $error;
 
		public function __construct(){
			$this->connect();
		}
 
		private function connect(){
			$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if(!$this->conn){
				$this->error = "Fatal Error: Can't connect to database".$this->conn->connect_error;
				return false;
			}
		}
		
		public function login_student($username, $password){
			$stmt = $this->conn->prepare("SELECT * FROM `user` WHERE `Username` = ? AND `Password` = ? AND `Status` = 1") or die($this->conn->error);
			$stmt->bind_param("ss", $username, $password);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$valid = $result->num_rows;
				$fetch = $result->fetch_array();
				if ($fetch){
				return array(
					'user_id'=> htmlentities($fetch['User_id']),
					'count'=>$valid
				);
			}else{
				return array(
					'user_id'=> null,
					'count'=> 0
				);
			}
			}
			}
		
 
	

		public function user_account($User_id){
			$stmt = $this->conn->prepare("SELECT * FROM `user` WHERE `User_id` = ?") or die($this->conn->error);
		    $stmt->bind_param("i", $User_id);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				return array(
					'Fullname'=> $fetch['Fullname'],
					'Username'=>$fetch['Username'],
					'role'=>$fetch['role']
					
				);
			}	
		}
		

		public function getLastRequestTimestamp($student_id) {
			try {
				// Prepare and execute the database query
				$query = "SELECT creation FROM tbl_documentrequest WHERE student_id = ? ORDER BY creation DESC LIMIT 1";
				$stmt = $this->conn->prepare($query);
				if (!$stmt) {
					throw new Exception($this->conn->error);
				}
				
				$stmt->bind_param("i", $student_id);
				if (!$stmt->execute()) {
					throw new Exception("Query execution failed");
				}
				
				$result = $stmt->get_result();
				
				// Fetch the result
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					// Return the last request timestamp
					return $row['creation'];
				} else {
					// Return null if no record is found
					return null;
				}
			} catch (Exception $e) {
				// Handle exceptions
				echo "Error: " . $e->getMessage();
				return null;
			}
		}
		
		
	
		
		public function student_profile($student_id){
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_student` WHERE `student_id` = ?") or die($this->conn->error);
		    $stmt->bind_param("i", $student_id);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				return array(
					'student_id'=>$fetch['student_id'],
					'studentID_no'=>$fetch['studentID_no'],
					'first_name'=> $fetch['first_name'],
					'middle_name'=>$fetch['middle_name'],
					'last_name'=>$fetch['last_name'],
					'course'=>$fetch['course'],
					'Section'=>$fetch['Section'],
					'gender'=>$fetch['gender'],
					'year_level'=>$fetch['year_level'],
					'email_address'=>$fetch['email_address'],
					'complete_address'=>$fetch['complete_address'],
					'mobile_number'=>$fetch['mobile_number'],
					'username'=>$fetch['username'],
					'password'=>$fetch['password'],
					'account_status'=>$fetch['account_status'],
					'date_created'=>$fetch['date_created']
					
				);
			}	
		}
		public function get_attendance_by_student($student_id) {
			$stmt = $this->conn->prepare("
				SELECT 
					a.attendance_id,
					a.student_id,
					s.studentID_no,
					s.first_name,
					s.last_name,
					d.Date,
					a.status
				FROM tbl_attendance AS a
				JOIN tbl_student AS s ON a.student_id = s.student_id
				JOIN tbl_date AS d ON a.Date_id = d.Date_id
				WHERE a.student_id = ?
			") or die($this->conn->error);
		
			$stmt->bind_param("i", $student_id);
		
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$attendance_data = [];
		
				while ($fetch = $result->fetch_array()) {
					$attendance_data[] = array(
						'attendance_id' => $fetch['attendance_id'],
						'student_id' => $fetch['student_id'],
						'studentID_no' => $fetch['studentID_no'],
						'first_name' => $fetch['first_name'],
						'last_name' => $fetch['last_name'],
						'Date' => $fetch['Date'],
						'status' => $fetch['status']
					);
				}
		
				return $attendance_data;
			} else {
				return null;
			}
		}
		
		
		public function user_profile($user_id) {
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_usermanagement` WHERE `user_id` = ?") or die($this->conn->error);
			$stmt->bind_param("i", $user_id);
			
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
		
				return array(
					'user_id' => $fetch['user_id'],
					'complete_name' => $fetch['complete_name'], // Removed extra space
					'designation' => $fetch['designation'], // Corrected the key name
					'email_address' => $fetch['email_address'],
					'phone_number' => $fetch['phone_number'],
					'username' => $fetch['username'],
					'password' => $fetch['password'],
					'status' => $fetch['status'],
					'role' => $fetch['role']
				);
			}
		}
		
	public function add_document($document_name, $RECORD_EXAMINER, $document_description, $image_size, $student_id){
    $stmt = $this->conn->prepare("INSERT INTO `tbl_document` (`document_name`,`EXAMINER`, `document_description`, `image_size`, `student_id`) VALUES (?, ?, ?, ?, ?)") or die($this->conn->error);
    $stmt->bind_param("sssis", $document_name, $RECORD_EXAMINER, $document_description, $image_size, $student_id);
    if($stmt->execute()){
        $stmt->close();
        $this->conn->close();
        return true;
    }
}

public function insertStudentAnswers($student_id,$student_teacher , $student_section, $Academicyear, $answers) {
    // Prepare the SQL statement
    $sql = "INSERT INTO `answers` (`Student_id`,`to_teacher`, `Student_section`, `ACADMIC_YEAR` , `answer`) VALUES (?, ?, ?, ? ,?)";
    
    // Prepare the statement
    $stmt = $this->conn->prepare($sql);
    
    if (!$stmt) {
        // Handle the error, don't just output it
        die('Error in preparing the SQL statement: ' . $this->conn->error);
    }

    // Iterate over the answers array and bind parameters
    foreach ($answers as $answer) {
        // Bind parameters
        $stmt->bind_param("sssss", $student_id,$student_teacher , $student_section, $Academicyear, $answer);
        
        // Execute the statement
        if (!$stmt->execute()) {
            // Handle the error, don't just output it
            die('Error in executing the SQL statement: ' . $stmt->error);
        }
    }
    
    // Close the statement and connection
    $stmt->close();
    $this->conn->close();
    
    return true;
}


public function fetchAll_Booking() {
    $sql = "SELECT 
                e.*, 
                c.Fullname AS customer_name, 
                u.Fullname AS user_name 
            FROM events e
            LEFT JOIN customer c ON e.Customer_id = c.Customer_id
            LEFT JOIN user u ON e.User_id = u.User_id
            WHERE e.Status IS Null 
            ORDER BY e.sort DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

public function delete_event($event_id){
	$sql = "DELETE FROM events WHERE id = ?";
	 $stmt = $this->conn->prepare($sql);
	$stmt->bind_param("i", $event_id);
	if($stmt->execute()){
		$stmt->close();
		$this->conn->close();
		return true;
	}
}

public function delete_user($event_id){
	$sql = "DELETE FROM user WHERE User_id  = ?";
	 $stmt = $this->conn->prepare($sql);
	$stmt->bind_param("i", $event_id);
	if($stmt->execute()){
		$stmt->close();
		$this->conn->close();
		return true;
	}
}
public function activate_user($event_id){
	$sql = "UPDATE  customer SET `Status` = 0 WHERE Customer_id  = ?";
	 $stmt = $this->conn->prepare($sql);
	$stmt->bind_param("i", $event_id);
	if($stmt->execute()){
		$stmt->close();
		$this->conn->close();
		return true;
	}
}
public function activate_user1($event_id){
	$sql = "UPDATE  user SET `Status` = 0 WHERE User_id  = ?";
	 $stmt = $this->conn->prepare($sql);
	$stmt->bind_param("i", $event_id);
	if($stmt->execute()){
		$stmt->close();
		$this->conn->close();
		return true;
	}
}

public function deactivate_user($event_id){
	$sql = "UPDATE  customer SET `Status` = 1 WHERE Customer_id  = ?";
	 $stmt = $this->conn->prepare($sql);
	$stmt->bind_param("i", $event_id);
	if($stmt->execute()){
		$stmt->close();
		$this->conn->close();
		return true;
	}
}
public function deactivate_user1($event_id){
	$sql = "UPDATE  user SET `Status` = 1 WHERE User_id  = ?";
	 $stmt = $this->conn->prepare($sql);
	$stmt->bind_param("i", $event_id);
	if($stmt->execute()){
		$stmt->close();
		$this->conn->close();
		return true;
	}
}

public function fetchAll_BookingApproved() {
    $sql = "SELECT 
                e.*, 
                c.Fullname AS customer_name, 
                u.Fullname AS user_name 
            FROM events e
            LEFT JOIN customer c ON e.Customer_id = c.Customer_id
            LEFT JOIN user u ON e.User_id = u.User_id
            WHERE   e.Status = 'Approved'
            ORDER BY e.sort DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

public function fetchAll_MyBooking($my_id) {
	$sql = "SELECT 
				e.*, 
				c.Fullname AS customer_name, 
				u.Fullname AS user_name 
			FROM events e
			LEFT JOIN customer c ON e.Customer_id = c.Customer_id
			LEFT JOIN user u ON e.User_id = u.User_id
			WHERE   e.Customer_id is null
			ORDER BY e.id Desc";

	$stmt = $this->conn->prepare($sql);

	$stmt->execute();
	$result = $stmt->get_result();
	
	$data = array();
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}

	return $data;
}
public function getMonthlyData1( $year, $month1) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND  `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month1);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData2( $year, $month2) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month2);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData3( $year, $month3) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month3);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData4( $year, $month4) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month4);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}

public function getMonthlyData5( $year, $month5) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month5);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData6( $year, $month6) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month6);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData7( $year, $month7) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month7);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData8( $year, $month8) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month8);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData9( $year, $month9) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month9);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData10( $year, $month10) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month10);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData11( $year, $month11) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month11);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData12( $year, $month12) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month12);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyData( $year, $month) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved' ";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyDataspecial($year, $month) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ?  ";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}

public function getMonthlyDataAccepted( $year, $month) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Approved'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyDataDeclined( $year, $month) {
   
    $sql = "SELECT * FROM events WHERE  YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND `Status` = 'Declined'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}
public function getMonthlyDataPending($year, $month) {
    $sql = "SELECT * FROM events WHERE YEAR(currents_dates) = ? AND MONTH(currents_dates) = ? AND (Status = '' OR Status IS NULL)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}


public function fetchAll_BookingDeclined() {
    $sql = "SELECT 
                e.*, 
                c.Fullname AS customer_name, 
                u.Fullname AS user_name 
            FROM events e
            LEFT JOIN customer c ON e.Customer_id = c.Customer_id
            LEFT JOIN user u ON e.User_id = u.User_id
            WHERE   e.Status = 'Declined' OR e.Status = 'Expired'  OR e.Status = 'cancel'
            ORDER BY e.id DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

public function fetchAll_BookingPayable() {
    $sql = "SELECT 
                e.*, 
                c.Fullname AS customer_name, 
                u.Fullname AS user_name 
            FROM events e
            LEFT JOIN customer c ON e.Customer_id = c.Customer_id
            LEFT JOIN user u ON e.User_id = u.User_id
            WHERE   e.Status = 'Payable'
            ORDER BY e.sort DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}



public function disapprove_events($Declined, $event_id ,$user_ida) {
    $stmt = $this->conn->prepare("SELECT events, Amount, date, Customer_id, User_id FROM events WHERE id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->bind_result($Ename, $Amount, $Date, $Cid, $user_id);
    
    if (!$stmt->fetch()) {
        $stmt->close();
        return false; 
    }
    $stmt->close();

    $Approved = $Declined;

    $stmt_insert = $this->conn->prepare("INSERT INTO `history` (`Event_name`, `Event_status`, `Amount`, `Event_date`, `Cid`, `U_id`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("ssissi", $Ename, $Approved, $Amount, $Date, $Cid, $user_ida);
    if (!$stmt_insert->execute()) {
        $stmt_insert->close();
        return false;
    }
    $stmt_insert->close();


    $sql_max = "SELECT MAX(sort) AS sort FROM events";
    $result = $this->conn->query($sql_max);
    $row = $result->fetch_assoc();
    $next_delete_value = $row['sort'] + 1;

    $stmt_update = $this->conn->prepare("UPDATE `events` SET `Status` = ?, `sort` = ? WHERE id = ?");
    $stmt_update->bind_param("sii", $Declined, $next_delete_value, $event_id);

    if ($stmt_update->execute()) {
        $stmt_update->close();
        return true;
    } else {
        $stmt_update->close();
        return false;
    }
}


public function edit_events($Approved, $Amount,$user_id,$dates, $event_id) {

	$sql_max = "SELECT MAX(sort) AS sort FROM events";
	 $result = $this->conn->query($sql_max);
	  $row = $result->fetch_assoc();
	   $next_delete_value = $row['sort'] + 1;
	   
    $sql = "UPDATE `events` SET `Status` = ?, `Amount` = ?, `User_id` = ?, `sort` = ?, `Expdate` = ?  WHERE id = ?";
    $stmt = $this->conn->prepare($sql);

   
    $stmt->bind_param("siiisi", $Approved, $Amount,$user_id,$next_delete_value,$dates, $event_id);

    if ($stmt->execute()) {
        $stmt->close();
        $this->conn->close();
        return true;
    } else {
        $stmt->close();
        $this->conn->close();
        return false;
    }
}
public function pay_events($Approved, $Amount,$user_id, $event_id) {
	$sql_max = "SELECT MAX(sort) AS sort FROM events";
	 $result = $this->conn->query($sql_max); $row = $result->fetch_assoc();
	  $next_delete_value = $row['sort'] + 1;
    $sql = "UPDATE `events` SET `Status` = ?, `MoC` = ?,`sort` = ?, `User_id` = ?  WHERE id = ?";
    $stmt = $this->conn->prepare($sql);

   
    $stmt->bind_param("siiii", $Approved, $Amount,$next_delete_value ,$user_id, $event_id);

    if ($stmt->execute()) {
        $stmt->close();
        
        return true;
    } else {
        $stmt->close();
        $this->conn->close();
        return false;
    }
}


public function decline_allsimilar($Dur, $Date, $event_id) {
  if ($Dur == 'Whole Day'){
    if (!$this->conn) {
        return false; 
    }

    $sql = "UPDATE `events` SET `Status` = 'Declined' WHERE `date` = ?  AND  id != ?  AND (`Status` != 'Approved' OR `Status` IS NULL)";
    $stmt = $this->conn->prepare($sql);
    

    if (!$stmt) {
        
        error_log("Failed to prepare statement: " . $this->conn->error);
        return false;
    }


    $stmt->bind_param("si",  $Date, $event_id);

  
    $success = $stmt->execute();

 
    return $success;
}elseif($Dur == 'After Noon' || $Dur == 'Morning'){
	    if (!$this->conn) {
        return false; 
    }

    $sql = "UPDATE `events` SET `Status` = 'Declined' WHERE `date` = ? AND  Duration = ? or Duration = 'Whole Day' AND  id != ?  AND (`Status` != 'Approved' OR `Status` IS NULL )";
    $stmt = $this->conn->prepare($sql);
    

    if (!$stmt) {
        
        error_log("Failed to prepare statement: " . $this->conn->error);
        return false;
    }


    $stmt->bind_param("ssi",  $Date,$Dur , $event_id);

  
    $success = $stmt->execute();

 
    return $success;
}
}







		  public function fetchAll_Client(){ 
            $sql = "SELECT * FROM customer ";
				$stmt = $this->conn->prepare($sql);
			
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function fetchAll_history(){ 
            $sql = "SELECT * FROM History order by H_id desc";
				$stmt = $this->conn->prepare($sql);
			
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }
		  public function fetchAll_admin(){ 
            $sql = "SELECT * FROM user ";
				$stmt = $this->conn->prepare($sql);
			
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }
		
		  

		  public function fetchAll_customer($ids){ 
            $sql = "SELECT * FROM customer WHERE `Customer_id` = ?";
				$stmt = $this->conn->prepare($sql);
			    $stmt->bind_param("i", $ids); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }
		  public function fetchAll_Us($Uids){ 
            $sql = "SELECT * FROM user WHERE `User_id` = ?";
				$stmt = $this->conn->prepare($sql);
			    $stmt->bind_param("i", $Uids); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function fetchrepeatedans($STDLRN,$teacherupdate,$academicyear){ 
            $sql = "SELECT * FROM answers WHERE `Student_id` = ? AND `to_teacher` = ? AND `ACADMIC_YEAR` = ?";
				$stmt = $this->conn->prepare($sql);
			    $stmt->bind_param("sss",$STDLRN,$teacherupdate,$academicyear); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		

		  public function fetchAll_Announcement(){ 
            $sql = "SELECT * FROM announcement";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }
		  public function fetchAll_Question(){ 
            $sql = "SELECT * FROM questions";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function fetchAll_ACADEMICYEAR(){ 
            $sql = "SELECT * FROM tbl_academicyear";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }


        public function edit_document($document_name, $document_decription, $image_size, $student_id, $document_id){

			$sql="SELECT document_name FROM tbl_document WHERE document_id = ?";
				$stmt2=$this->conn->prepare($sql);
				$stmt2->bind_param("i", $document_id);
				$stmt2->execute();
				$result2=$stmt2->get_result();
				$row=$result2->fetch_assoc();
				$imagepath='../../student/'.$row['document_name'];
				unlink($imagepath);

			$sql = "UPDATE `tbl_document` SET  `document_name` = ?, `document_decription` = ?, `image_size` = ?,  `student_id` = ? WHERE document_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssi", $document_name, $document_decription, $image_size, $student_id, $document_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_document($document_id){


			$sql="SELECT document_name FROM tbl_document WHERE document_id = ?";
				$stmt2=$this->conn->prepare($sql);
				$stmt2->bind_param("i", $document_id);
				$stmt2->execute();
				$result2=$stmt2->get_result();
				$row=$result2->fetch_assoc();
				$imagepath='../../student/'.$row['document_name'];
				unlink($imagepath);

				$sql = "DELETE FROM tbl_document WHERE document_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $document_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

		public function fetchAll_documentrequest($student_id){ 
            $sql = "SELECT * FROM  tbl_documentrequest WHERE `student_id` = ?";
				$stmt = $this->conn->prepare($sql);
			    $stmt->bind_param("i", $student_id); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

	    public function fetchAll_payment($student_id){ 
            $sql = "SELECT *,CONCAT(tbl_student.first_name, ', ' ,tbl_student.middle_name, ' ' ,tbl_student.last_name) as student_name FROM  tbl_payment INNER JOIN tbl_student ON tbl_student.student_id =  tbl_payment.student_id  WHERE tbl_payment.student_id = ?";
				$stmt = $this->conn->prepare($sql);
			    $stmt->bind_param("i", $student_id); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		public function edit_payment($document_controlno, $total_amount, $amount_paid, $date_ofpayment, $proof_ofpayment, $status, $payment_id){
			$sql = "UPDATE `tbl_payment` SET  `document_controlno` = ?, `total_amount` = ?, `amount_paid` = ?, `date_ofpayment` = ?, `proof_ofpayment` = ?, `status` = ?  WHERE payment_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssssi", $document_controlno, $total_amount, $amount_paid, $date_ofpayment, $proof_ofpayment, $status, $payment_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		public function edit_staff($Fullname, $Lastname,$phoneNo,$email,$Gender,$Middle, $usernames, $password, $Id){
			$sql = "UPDATE `user` SET  `Fullname` = ?, `Last` = ?, `Phone` = ?, `Email` = ?,`Gender` = ?,`middle` = ?, `Username` = ?, `Password` = ?  WHERE User_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssssssi",$Fullname, $Lastname,$phoneNo,$email,$Gender,$Middle, $usernames, $password, $Id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_payment($payment_id){
				$sql = "DELETE FROM tbl_payment WHERE payment_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i",$payment_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

			public function searchfname($usernames){
				$sql="SELECT Username FROM user WHERE Username = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("s",$usernames);
					if($stmt->execute()){
				$result = $stmt->get_result();
	$valid = $result->num_rows;
				$fetch = $result->fetch_array();
					if($fetch){
					$stmt->close();
				
					return true;
					}else{
						$stmt->close();
				
					return false;
					}
				}
			}

				public function searchfnameCustomer($Usernames){
				$sql="SELECT Username FROM customer WHERE Username = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("s",$Usernames);
					if($stmt->execute()){
				$result = $stmt->get_result();
	$valid = $result->num_rows;
				$fetch = $result->fetch_array();
					if($fetch){
					$stmt->close();
				
					return true;
					}else{
						$stmt->close();
				
					return false;
					}
				}
			}

	    public function count_numberofstudents(){ 
            $sql = "SELECT COUNT(student_id) as count_students FROM tbl_student";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }
		

	    public function count_numberoftotalrequest(){ 
            $sql = "SELECT COUNT(request_id) as count_request FROM tbl_documentrequest";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }


		  

		 public function count_numberoftotalreceived($student_id){ 
            $sql = "SELECT COUNT(request_id) as count_received FROM tbl_documentrequest WHERE student_id = ? AND status = 'Received'";
				$stmt = $this->conn->prepare($sql); 
				$stmt->bind_param("i", $student_id);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }
		  public function fetchAll_documentz(){
			$sql = "SELECT * FROM `doc-name`";
			$stmt = $this->conn->prepare($sql);
		
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$data = array();
		
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
		

				$stmt->close();
				return $data;
			} else {
				echo "Error: " . $stmt->error;
				return false;
			}
		}


		public function fetchAll_clubmember(){ 
            $sql = "SELECT * FROM  clubmembers";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		

		  public function fetchAll_Pays(){ 
            $sql = "SELECT * FROM  tbl_payment";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function fetchAll_schedule(){ 
            $sql = "SELECT * FROM schedule";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		

		  public function fetchALL_Grade($userid) {
			$sql = "SELECT * FROM grades WHERE student_lrn = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("s", $userid);
			if ($stmt->execute()) {
				
				$result = $stmt->get_result(); 
				$data = $result->fetch_all(MYSQLI_ASSOC); 
				$this->conn->close();
				return $data; 
			} else {
				return false;
			}
		}

		public function Active() {
			$sql = "SELECT * FROM tbl_academicyear WHERE Modess = 'Active'";
			$stmt = $this->conn->prepare($sql);
			if ($stmt->execute()) {
				$result = $stmt->get_result(); 
				$data = $result->fetch_all(MYSQLI_ASSOC); 
				$this->conn->close();
				return $data; 
			} else {
				return false;
			}
		}

		public function fetchALLSechedulefor_eval($section) {
			$sql = "SELECT * FROM schedule WHERE Section = ? ";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("s", $section);
			if ($stmt->execute()) {
				
				$result = $stmt->get_result(); 
				$data = $result->fetch_all(MYSQLI_ASSOC); 
				$this->conn->close();
				return $data; 
			} else {
				return false;
			}
		}


		
		public function fetchAll_user(){ 
            $sql = "SELECT * FROM  tbl_usermanagement";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		



		  public function change_password($password, $student_id){
			$sql = "UPDATE `tbl_student` SET  `password` = ? WHERE student_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("si", $password, $student_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}


		public function add_request($course, $control_no, $studentID_no, $document_name, $no_ofcopies, $Price, $date_request, $received, $student_id)
		{
			$stmt = $this->conn->prepare("INSERT INTO `tbl_documentrequest` (`course`, `control_no`, `studentID_no`, `document_name`, `no_ofcopies`, `Price`, `date_request`, `status`, `student_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		
			if (!$stmt) {
				// Handle the error, don't just output it
				die('Error in preparing the SQL statement: ' . $this->conn->error);
			}
		
			$stmt->bind_param("ssssssssi", $course, $control_no, $studentID_no, $document_name, $no_ofcopies, $Price, $date_request, $received, $student_id);
		
			if (!$stmt->execute()) {
				// Handle the error, don't just output it
				die('Error in executing the SQL statement: ' . $stmt->error);
			}
		
			$stmt->close();
			$this->conn->close();
			return true;
		}
		




		public function add_myrequest($control_no, $studentID_no, $document_name,$No_copies,$Price, $date_releasing, $ref_number, $proof_ofpayment, $student_id, $Verified){
	       $stmt = $this->conn->prepare("INSERT INTO `tbl_payment` (`control_no`, `studentID_no`, `document_name`,`no_ofcopies`,`Price`, `date_releasing`, `ref_number`, `proof_ofpayment`, `student_id`,`status`) VALUES(?, ?, ?, ?, ?, ?, ?, ?,?,?)") or die($this->conn->error);
			$stmt->bind_param("ssssssiiis", $control_no, $studentID_no, $document_name,$No_copies,$Price, $date_releasing, $ref_number, $proof_ofpayment, $student_id, $Verified);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		public function Add_staff($Fullname, $Lastname,$phoneNo,$email,$Gender,$Middle,$usernames,$password){
			$stmt = $this->conn->prepare("INSERT INTO `user` (`Fullname`, `Last`, `Phone`,`Email`,`Gender`,`middle`,`Username`,`Password`,`role`,`Status`) VALUES(?, ?,?,?, ?,?,?,?,'Staff',1)") or die($this->conn->error);
			 $stmt->bind_param("ssssssss", $Fullname, $Lastname,$phoneNo,$email,$Gender,$Middle,$usernames,$password);
			 if($stmt->execute()){
				 $stmt->close();
				
				 return true;
			 }
		 }
		 public function Add_History($Ename, $Approved,$Amount, $Date, $Cid,$user_id){
			$stmt = $this->conn->prepare("INSERT INTO `history` (`Event_name`, `Event_status`,`Amount`, `Event_date`, `Cid`,`U_id`) VALUES(?, ?, ?,?,?,?)") or die($this->conn->error);
			 $stmt->bind_param("ssssss", $Ename, $Approved,$Amount, $Date, $Cid,$user_id);
			 if($stmt->execute()){
				 $stmt->close();
				 $this->conn->close();
				 return true;
			 }
		 }

		public function edit_request($control_no, $studentID_no, $document_name, $no_ofcopies, $date_request, $request_id){
			$sql = "UPDATE `tbl_documentrequest` SET `control_no` = ?, `studentID_no` = ?, `document_name` = ?, `no_ofcopies` = ?, `date_request` = ? WHERE request_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssi", $control_no, $studentID_no, $document_name, $no_ofcopies, $date_request, $request_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_request($request_id){
				$sql = "DELETE FROM tbl_documentrequest WHERE request_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i",$request_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}
			public function StdIdandfiles($userid){
				$student_id = $_SESSION['student_id'];
				$conn = new class_model();
				$user = $conn->student_profile($student_id);
				$userid = $user['studentID_no'];
				return $userid;	
				}
			
			
				public function files($id){
					$stmt = $this->conn->prepare("SELECT * FROM `files` WHERE `id` = ?") or die($this->conn->error);
					$stmt->bind_param("i", $id);
					if($stmt->execute()){
						$result = $stmt->get_result();
						$fetch = $result->fetch_assoc();  // Change 'fetch_array()' to 'fetch_assoc()'
						$stmt->close();  // Close the statement
						return array(
							'DocuNumber' =>$fetch['DocuNumber'],
							'id'	     =>$fetch['id'],
							'filename'	 =>$fetch['filename'],
							'filesize'	 =>$fetch['filesize'],
							'filetype'	 =>$fetch['filetype'],
							'upload_date'=>$fetch['upload_date']
						);
					} else {
						return null;  // Return null or handle the error appropriately
					}
				}
				
			
			
			
			
			
			}
?>