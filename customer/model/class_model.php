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
			$stmt = $this->conn->prepare("SELECT * FROM `customer` WHERE `Username` = ? AND `Password` = ? AND `Status` = 1") or die($this->conn->error);
			$stmt->bind_param("ss", $username, $password);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$valid = $result->num_rows;
				$fetch = $result->fetch_array();
				if ($fetch){
				return array(
					'Customer_id'=> htmlentities($fetch['Customer_id']),
					'count'=>$valid
				);
			}else{
				return array(
					'Customer_id'=> null,
					'count'=> 0
				);
			}
			}
			}
		
 
		public function student_account($student_id){
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_student` WHERE `student_id` = ?") or die($this->conn->error);
		    $stmt->bind_param("i", $student_id);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				return array(
					'first_name'=> $fetch['first_name'],
					'last_name'=>$fetch['last_name'],
					'Section'=>$fetch['Section']
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
			$stmt = $this->conn->prepare("SELECT * FROM `customer` WHERE `Customer_id` = ?") or die($this->conn->error);
			$stmt->bind_param("i", $user_id);
			
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
		
				return array(
					'Customer_id ' => $fetch['Customer_id'],
					'Fullname' => $fetch['Fullname'], // Removed extra space
					'Affiliation' => $fetch['Affiliation'], // Corrected the key name
					'Phone No' => $fetch['Phone No'],
					'Email' => $fetch['Email'],
					'Username' => $fetch['Username'],
					'Password' => $fetch['Password'],
					'Status' => $fetch['Status']
					
				);
			}
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



	    public function fetchAll_document($student_id){ 
            $sql = "SELECT * FROM  tbl_document WHERE `student_id` = ?";
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
		 

		


		  

		  public function fetchAll_prob($student_name){ 
            $sql = "SELECT * FROM problem WHERE `Stdname` = ?";
				$stmt = $this->conn->prepare($sql);
			    $stmt->bind_param("s", $student_name); 
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


			public function count_NOofmybooking($my_id){ 
				$sql = "SELECT COUNT(id) as count_Booking FROM events WHERE `Customer_id` = ?";
					$stmt = $this->conn->prepare($sql); 
					$stmt->bind_param('i' ,$my_id );
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

		public function Count_totaltrans($my_id) {
			$sql = "SELECT * FROM events WHERE `Status` = 'Approved' AND `Customer_id` = ? ";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param('i', $my_id);
			if ($stmt->execute()) {
				$result = $stmt->get_result(); 
				$data = $result->fetch_all(MYSQLI_ASSOC); 
				$this->conn->close();
				return $data; 
			} else {
				return false;
			}
		}

		public function fetchAll_MyBooking($my_id) {
			$sql = "SELECT 
						e.*, 
						c.Fullname AS customer_name, 
						u.Fullname AS user_name 
					FROM events e
					LEFT JOIN customer c ON e.Customer_id = c.Customer_id
					LEFT JOIN user u ON e.User_id = u.User_id
					WHERE   e.Customer_id = ?
					ORDER BY e.sort Desc";
		
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param('i', $my_id);
			$stmt->execute();
			$result = $stmt->get_result();
			
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
		
			return $data;
		}
		public function fetchAll_history($my_id){ 
            $sql = "SELECT * FROM History WHERE `Cid` = ? ";
				$stmt = $this->conn->prepare($sql);
				$stmt ->bind_param('s',$my_id);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function disapprove_events($Declined, $event_id ,$user_ida) {
			// Step 1: Fetch original event data
			$stmt = $this->conn->prepare("SELECT events, Amount, date, Customer_id, User_id FROM events WHERE id = ?");
			$stmt->bind_param("i", $event_id);
			$stmt->execute();
			$stmt->bind_result($Ename, $Amount, $Date, $Cid, $user_id);
			
			if (!$stmt->fetch()) {
				$stmt->close();
				return false; // Event not found
			}
			$stmt->close();
		
			$Approved = $Declined; // Optional: can set to 'Declined' or any value passed
		
			// Step 2: Insert into history table
			$stmt_insert = $this->conn->prepare("INSERT INTO `history` (`Event_name`, `Event_status`, `Amount`, `Event_date`, `Cid`, `U_id`) VALUES (?, ?, ?, ?, ?, ?)");
			$stmt_insert->bind_param("ssissi", $Ename, $Approved, $Amount, $Date, $Cid, $user_ida);
			if (!$stmt_insert->execute()) {
				$stmt_insert->close();
				return false;
			}
			$stmt_insert->close();
		
			// Step 3: Update the original event status and sort
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