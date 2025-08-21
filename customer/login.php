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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>FUNCTION HALL RESERVATION AND BILLING SYSTEM</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<style>
	/* Alert box base styles */
.alert {
    padding: 15px;
    border-radius: 5px;
    margin-top: 20px;
    font-size: 1rem;
    transition: opacity 0.3s ease;
    width: 100%;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Danger alert (error) */
.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-danger .alert-icon {
    margin-right: 10px;
    font-size: 1.2rem;
}

.alert-danger .alert-message {
    font-weight: 600;
}

/* Success alert (success) */
.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-success .alert-icon {
    margin-right: 10px;
    font-size: 1.2rem;
}

.alert-success .alert-message {
    font-weight: 600;
}

/* Close Button for the alerts */
.alert .close {
    color: inherit;
    font-size: 1.5rem;
    opacity: 0.5;
    padding: 0.5rem;
}

.alert .close:hover {
    opacity: 1;
}

</style>
<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back, Client!</h1>
							<p class="lead">
                            FUNCTION HALL RESERVATION AND BILLING SYSTEM
							</p>
						</div>
						
						<div class="card">
							<div class="card-body">
								<!--  -->
						<div class="form-group" id="alert-msg"> </div>
							<!--  -->
								<div class="m-sm-4">
									<div class="text-center">
										<img src="img/avatars/20250426_1521_image (1).png" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<form method="post" name="login_form">
										
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="Text" alt="username" name="username" placeholder="Enter your Username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" alt="password" name="password" placeholder="Enter your password" />
										
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
											<button type="submit" id="btn-login" class="btn btn-lg btn-primary">Sign in</button>
											<p class="mt-3">
        Don't have an account? 
        <a style='text-decoration:none;' href="../static/sign_up.php" class="btn btn-link">Sign Up</a>
    </p>
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
    
	<script type="text/javascript">
       
        jQuery(function() {
            $('form[name="login_form"]').on('submit', function(e) {
                e.preventDefault();

                var u_username = $(this).find('input[name="username"]').val();
                var p_password = $(this).find('input[name="password"]').val();

                if (u_username === '' && p_password === '') {
                    $('#alert-msg').html('<div class="alert alert-danger"> Required Username and Password!</div>');
                } else {
                    $.ajax({
                            type: 'POST',
                            url: 'controllers/login_process.php',
                            data: {
                                username: u_username,
                                password: p_password
                            },
                            beforeSend: function() {
                                $('#alert-msg').html('');
                            }
                        })
                        .done(function(t) {
                            if (t == 0) {
                                $('#alert-msg').html('<div class="alert alert-danger">Incorrect username or password!</div>');
                            } else {
								$('#alert-msg').html('<div class="alert alert-success">Welcome Client</div>');
                                $("#btn-login").html(' &nbsp; Signing In ...');
                                setTimeout(' window.location.href = "dashboard.php"; ',2000);
                            }
                        });
                }
            });
        });
    </script>
    <script>
	
	document.addEventListener("DOMContentLoaded", function () {
		const checkbox = document.querySelector('input[name="remember-me"]');
		const passwordInput = document.querySelector('input[name="password"]');

		checkbox.addEventListener('change', function () {
			if (this.checked) {
				passwordInput.type = "text";
			} else {
				passwordInput.type = "password";
			}
		});
	});
</script>
</body>

</html>