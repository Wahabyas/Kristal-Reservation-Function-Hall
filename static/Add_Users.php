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

		<!--  -->
		<?php include('includes/sidebar.php'); ?>

	<!--  -->

		<div class="main">
		<?php include('includes/header.php'); ?>
		

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Add Staff</h1>

					<div class="row">
                    <div id="message"></div>
						<div class="col-12">
							<div class="card">
							<form name="event_form" method="POST">
							<div class="m-sm-4">

								<div class="row">
									<div class="mb-3 col-4">
											<label class="form-label" >First Name</label>
											
											<input class="form-control form-control-lg" type="text" name="Fullname" placeholder="Enter your First name" required/>
										</div>
										<div class="mb-3 col-4">
											<label class="form-label" >Middle Name</label>
											<input class="form-control form-control-lg" type="text" name="Middle" placeholder="Enter your Middle name" required/>
										</div>
										<div class="mb-3 col-4">
											<label class="form-label" >Last Name</label>
											<input class="form-control form-control-lg" type="text" name="Lastname" placeholder="Enter your Last name" required/>
										</div>
										

											<div class="mb-3 col-6">
											<label class="form-label">Gender</label>

											<select name="Gender" class="form-control form-control-lg form-select mb-3" required>
          <option value=''>Gender</option>
          <option value='Male'>Male</option>
          <option value='Female'>Female</option>
        
        </select>
										</div>

										<div class="mb-3 col-6">
											<label class="form-label">Phone No</label>
											<input class="form-control form-control-lg" type="text" name="phoneNo" pattern="[0-9]{11}" maxlength="11" title="Enter a valid 11-digit phone number" required />
										</div>
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" required/>
										</div>
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="usernames" placeholder="Enter Username" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password"required />
										</div>
										<div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input class="form-control form-control-lg" type="password" name="password1" placeholder="Enter password" required/>
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
								<button type="submit" class="btn btn-info btn-fill pull-right">Add Staff</button>
								</div>
								</form>

							</div>
						</div>
					</div>

					
						
				</div>
			</main>

			
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="js/jquery.min.js"></script>
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
	<script src="js/jquery.min.js"></script>

	<script>

$(document).ready(function() {
   $('form[name="event_form"]').on('submit', function(e){
      e.preventDefault();





      var a = $(this).find('input[name="Fullname"]').val();
      var b = $(this).find('input[name="Lastname"]').val();
      var c = $(this).find('input[name="phoneNo"]').val();
      var d = $(this).find('input[name="email"]').val();
      var e = $(this).find('input[name="usernames"]').val();
      var f = $(this).find('input[name="password"]').val();
      var g = $(this).find('input[name="password1"]').val();
      var h = $(this).find('input[name="Middle"]').val();
      var i = $(this).find('select[name="Gender"]').val();
    
if(confirm('Are you sure do you want to add this Staff' )){
	
}else{
	exit;
}
   
if(f == g){

     if (a === '' &&  b ===''){
          $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
        }else{
        $.ajax({
            url: 'controllers/Add_staff.php',
            method: 'post',
            data: {
				Fullname: a,
				Lastname: b,
				phoneNo: c,
				email: d,
				usernames: e,
				password: f,
				Middle: h,
				Gender: i
            

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
     });




    });

	</script>

</body>

</html>