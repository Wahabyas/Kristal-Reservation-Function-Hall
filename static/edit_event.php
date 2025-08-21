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

<body>
	<div class="wrapper">

		<!--  -->
		<?php include('includes/sidebar.php'); ?>

	<!--  -->

		<div class="main">
		<?php include('includes/header.php'); ?>
		<?php 
             require_once 'model/config/connection2.php'; 

                    
                    $GET_id = intval($_GET['event']);
                    $folder_name = $_GET['event-name'];
                    $Duration = $_GET['event-Duration'];
                    $sql = "SELECT * FROM `events` WHERE `id`= ? AND `events` = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("is", $GET_id, $folder_name);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                   ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Approve Payment (In Peso &#8369;)</h1>

					<div class="row">
                    <div id="message"></div>

						<div class="col-12">
							<div class="card">
							<form name="event_form" method="POST">
								<div class="card-header">
									<h5 class="card-title mb-0">Amount (&#8369;)</h5>
								</div>
							
								<div class="card-body">
								<select name="Amount" id="event" class="form-select ms-auto" required>
    <?php if($Duration== 'After Noon' || $Duration== 'Morning'  ){ ?>
        <option value="10000">&#8369; 10,000</option>
    <?php }elseif($Duration== 'Whole Day'){ ?>
        <option value="20000">&#8369; 20,000</option>
    <?php } ?>
    <option value="specify">Specify Amount</option>
</select>
<input 
    type="number" 
    name="manual_amount" 
    id="manual_amount" 
    class="form-control mt-2" 
    placeholder="Enter amount" 
    style="display:none;" 
    min="1"
/>
<input hidden type="Number" name="event_id" class="form-control" placeholder="<?= $row['id'];  ?> " value="<?= $row['id'];  ?>">
									
								</div>
								
							
								<div class="card-body">
								<button type="submit" class="btn btn-info btn-fill pull-right">Approve</button>
								</div>
								</form>

							</div>
						</div>
					</div>

					
						<?php
					
					
					} ?>
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="js/jquery.min.js"></script>
	<script>
$(document).ready(function() {
    $('select[name="Amount"]').on('change', function() {
        if ($(this).val() === 'specify') {
            $('#manual_amount').show().attr('required', true);
        } else {
            $('#manual_amount').hide().val('').removeAttr('required');
        }
    });

    $('form[name="event_form"]').on('submit', function(e){
        e.preventDefault();

        var a = $(this).find('select[name="Amount"]').val();
        var b = $(this).find('input[name="event_id"]').val();
        var manual = $(this).find('input[name="manual_amount"]').val();

        if ((a === '' && b === '') || (a === 'specify' && manual === '')) {
            $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
        } else {
            $.ajax({
                url: 'controllers/edit_event.php',
                method: 'post',
                data: {
                    Amount: a === 'specify' ? manual : a,
                    event_id: b
                },
                success: function(response) {
                    $("#message").html(response);
                },
                error: function(response) {
                    console.log("Failed");
                }
            });
        }
    });
});
	</script>

</body>

</html>