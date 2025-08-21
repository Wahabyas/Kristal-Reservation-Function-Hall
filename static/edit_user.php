<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />
	<title>Blank Page | AdminKit Demo</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<style>
	

	.alert-danger {
		background-color: #f8d7da;
		border-color: #f5c6cb;
		color: #721c24;
		border: 1px solid #f5c6cb;
		padding: 10px;
		border-radius: 5px;
	}

	.alert-success {
		background-color: #d4edda;
		border-color: #c3e6cb;
		color: #155724;
		border: 1px solid #c3e6cb;
		padding: 10px;
		border-radius: 5px;

	}
</style>
<body>
	<div class="wrapper">

	
		<?php include('includes/sidebar.php'); ?>

	

		<div class="main">
		<?php include('includes/header.php'); ?>
		
<?php 
   require_once 'model/config/connection2.php'; 

                    
                    $GET_id = intval($_GET['user_id']);
                    $User_name = strval($_GET['User-name']);
                    $sql = "SELECT * FROM `user` WHERE `User_id`= ? AND `Username` = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("is", $GET_id, $User_name);
                    $stmt->execute();
                    $result = $stmt->get_result();
				

                    while ($row = $result->fetch_assoc()) {
?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Edit User</h1>

					<div class="row">
                    <div id="message"></div>
						<div class="col-12">
							<div class="card">
							<form name="event_form" method="POST">
								<div class="card-header">
									<h5 class="card-title mb-0">Edit User</h5>
								</div>
								<div class="m-sm-4">

								<div class="row">
									<div class="mb-3 col-4">
										<input type="number" name='Id' value='<?= $row['User_id'] ?>' hidden>
											<label class="form-label" >First Name</label>
											<input class="form-control form-control-lg" type="text" name="Fullname" value='<?= $row['Fullname'] ?>' placeholder="Enter your First name" />
										</div>
										<div class="mb-3 col-4">
											<label class="form-label" >Middle Name</label>
											<input class="form-control form-control-lg" type="text" name="Middle" value='<?= $row['middle'] ?>' placeholder="Enter your Middle name" required/>
										</div>
										<div class="mb-3 col-4">
											<label class="form-label" >Last Name</label>
											<input class="form-control form-control-lg" type="text" name="Lastname" value='<?= $row['Last'] ?>' placeholder="Enter your Last name" />
										</div>
									<div class="mb-3 col-6">
											<label class="form-label">Gender</label>

											<select name="Gender" class="form-control form-control-lg form-select mb-3" required>
          <option value='<?= $row['Gender']?>'><?= $row['Gender']?></option>
          <option value='Male'>Male</option>
          <option value='Female'>Female</option>
        
        </select>
										</div>
										<div class="mb-3 col-6">
											<label class="form-label">Phone No</label>
											<input class="form-control form-control-lg" type="text" name="phoneNo" pattern="[0-9]{11}" maxlength="11" value='<?= $row['Phone'] ?>' title="Enter a valid 11-digit phone number" required />
										</div>
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" value='<?= $row['Email'] ?>' placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="usernames" value='<?= $row['Username'] ?>' placeholder="Enter Username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" />
										</div>
										<div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input class="form-control form-control-lg" type="password" name="password1" placeholder="Enter password" />
										</div>
										<div>
											<label class="form-check">
            <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" >
            <span class="form-check-label">
              Show Password
            </span>
          </label>
										</div>
										</div>
							
								<div class="card-body">
								<button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
								</div>
								</form>
							</div>
							
						</div>
						
					</div>

					
						
				</div>
			</main>

			<?php } ?>
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script>
	
	document.addEventListener("DOMContentLoaded", function () {
		const checkbox = document.querySelector('input[name="remember-me"]');
		const passwordInput = document.querySelector('input[name="password"]');
		const passwordInput1 = document.querySelector('input[name="password1"]');

		checkbox.addEventListener('change', function () {
			if (this.checked) {
				passwordInput.type = "text";
				passwordInput1.type = "text";
			} else {
				passwordInput.type = "password";
				passwordInput1.type = "password";
			}
		});
	});
	</script>
	<script>
		
		
$(document).ready(function() {
   let formToSubmit = null;

   $('form[name="event_form"]').on('submit', function(e){
      e.preventDefault();
      formToSubmit = $(this);

      // Show the modal
      $('#editConfirmModal').modal('show');
   });

   // Handle Yes button
   $('#editYesBtn').on('click', function() {
      $('#editConfirmModal').modal('hide');
      if(formToSubmit) {
         // Now do the validation and AJAX as before
         var a = formToSubmit.find('input[name="Fullname"]').val();
         var b = formToSubmit.find('input[name="Lastname"]').val();
         var c = formToSubmit.find('input[name="phoneNo"]').val();
         var d = formToSubmit.find('input[name="email"]').val();
         var e = formToSubmit.find('input[name="usernames"]').val();
         var f = formToSubmit.find('input[name="password"]').val();
         var g = formToSubmit.find('input[name="password1"]').val();
         var h = formToSubmit.find('input[name="Id"]').val();
         var i = formToSubmit.find('input[name="Middle"]').val();
         var j = formToSubmit.find('select[name="Gender"]').val();


         if(f == g ){
             if (a === '' &&  b ==='' || f === '' && g ===''){
                  $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
                }else{
                $.ajax({
                    url: 'controllers/edit_user.php',
                    method: 'post',
                    data: {
                        Fullname: a,
                        Lastname: b,
                        phoneNo: c,
                        email: d,
                        usernames: e,
                        password: f,
                        Middle: i,
                        Gender: j,
                        Id: h
                    },
                    success: function(response) {
                      $("#message").html(response);
                      },
                      error: function(response) {
                        console.log("Failed");
                      }
                  });
                }
            }else{
         $('#message').html('<div class="alert alert-danger"> confirm you password.</div>');
        }
      }
   });

   // Handle No button (just hide the modal, nothing else needed)
   $('#editCancelBtn').on('click', function() {
      $('#editConfirmModal').modal('hide');
   });
});
	</script>


<div class="modal fade" id="editConfirmModal" tabindex="-1" aria-labelledby="editConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editConfirmModalLabel">Confirm Edit</h5>
      </div>
      <div class="modal-body">
        Are you sure you want to edit this staff?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="editCancelBtn" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="editYesBtn">Yes</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>