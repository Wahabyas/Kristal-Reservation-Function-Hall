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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>FUNCTION HALL RESERVATION AND BILLING SYSTEM</title>

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

	.alert-successs {
		background-color:rgb(138, 198, 152);
		border-color: #c3e6cb;
		color:rgb(19, 94, 0);
		border: 1px solid #c3e6cb;
		padding: 10px;
		border-radius: 5px;

	}
</style>
<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Get started</h1>
							<p class="lead">
								Start creating Client account.
							</p>
						</div>

						<div class="card">
						

							<div class="card-body">
							<div class="" id="message"></div>
								<div class="m-sm-4">
									<form id="signupForm" method="POST" enctype="multipart/form-data">
										<div class="mb-3">
											<label class="form-label" >First Name</label>
											<input class="form-control form-control-lg" type="text" name="fullname" placeholder="Enter your Firstt name" />
										</div>
											<div class="mb-3">
											<label class="form-label" >Middle Name</label>
											<input class="form-control form-control-lg" type="text" name="middle" placeholder="Enter your Middle name" />
										</div>
										<div class="mb-3">
											<label class="form-label" >Last Name</label>
											<input class="form-control form-control-lg" type="text" name="Lastname" placeholder="Enter your Last name" />
										</div>
									<div class="mb-3 ">
											<label class="form-label">Gender</label>

											<select name="Gender" class="form-control form-control-lg form-select mb-3" required>
          <option value=''>Gender</option>
          <option value='Male'>Male</option>
          <option value='Female'>Female</option>
        
        </select>
										</div>
										<div class="mb-3">
											<label class="form-label">Phone No</label>
											<input class="form-control form-control-lg" type="text" name="phoneNo" pattern="[0-9]{11}" maxlength="11" title="Enter a valid 11-digit phone number" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="usernames" placeholder="Enter Username" />
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
										<div class="text-center mt-3">
										<button type="submit" class="btn btn-lg btn-primary">Sign up</button>
</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

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
	<script>




$('#signupForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

		var fullname = $('input[name="fullname"]').val();
		var Lastname = $('input[name="Lastname"]').val();
        var Affiliation = 'none';
        var phoneNo = $('input[name="phoneNo"]').val();
        var email = $('input[name="email"]').val();
        var usernames = $('input[name="usernames"]').val();
        var password = $('input[name="password"]').val();
        var password1 = $('input[name="password1"]').val();
       var Middle = $(this).find('input[name="middle"]').val();
      var Gender = $(this).find('select[name="Gender"]').val();

     
        
if(password == password1){
   
        var formData = new FormData(this); 

        $.ajax({
            url: 'controllers/add_user.php',
            method: 'POST',
            data: formData, 
            contentType: false,
            processData: false,
            success: function(response) {
                $("#message").html('<div class="alert alert-success">' + response + '</div>');
            },
            error: function(xhr, status, error) {
                console.log("Submission failed: " + error);
                $('#message').html('<div class="alert alert-danger">Submission failed. Please try again.</div>');
            }
        });

}else{
	 $('#message').html('<div class="alert alert-danger"> confirm you password.</div>');
}

    });



   </script>


</body>

</html>