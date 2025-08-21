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

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>FUNCTION HALL RESERVATION AND BILLING SYSTEM</title>

	<link href="css/app.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<style>/* Modal styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0); /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
    padding-top: 60px;
	
}

.modal-content {
	border-radius: 3px;
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
}

.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-btn:hover,
.close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>
<body>
	<div class="wrapper"> 
		<!--  -->
		<?php include('includes/sidebar.php'); ?>
<!--  -->
		<div class="main">
		<?php include('includes/header.php'); ?>
			
		<?php $year = date('Y');
		 $year = date('Y');
		 $month = date('n');
		
		$howmanybookingthismonth = 0;
		$hownmanyAccepted = 0;
		$hownmanyDeclined = 0;
		$hownmanypending = 0;
				$conn = new class_model();
			$month1 = 1;
			$month2 = 2;
			$month3 = 3;
			$month4 = 4;
			$month5 = 5;
			$month6 = 6;
			$month7 = 7;
			$month8 = 8;
			$month9 = 9;
			$month10 = 10;
			$month11 = 11;
			$month12 = 12;

			$totalsum1=0;
			$totalsum2=0;
			$totalsum3=0;
			$totalsum4=0;
			$totalsum5=0;
			$totalsum6=0;
			$totalsum7=0;
			$totalsum8=0;
			$totalsum9=0;
			$totalsum10=0;
			$totalsum11=0;
			$totalsum12=0;
			$totalsum=0;


			
				
				$currentsales1 = $conn->getMonthlyData1($year, $month1);
				$currentsales2 = $conn->getMonthlyData2($year, $month2);
				$currentsales3 = $conn->getMonthlyData3($year, $month3);
				$currentsales4 = $conn->getMonthlyData4($year, $month4);
				$currentsales5 = $conn->getMonthlyData5($year, $month5);
				$currentsales6 = $conn->getMonthlyData6($year, $month6);
				$currentsales7 = $conn->getMonthlyData7($year, $month7);
				$currentsales8 = $conn->getMonthlyData8($year, $month8);
				$currentsales9 = $conn->getMonthlyData9($year, $month9);
				$currentsales10 = $conn->getMonthlyData10($year, $month10);
				$currentsales11 = $conn->getMonthlyData11($year, $month11);
				$currentsales12 = $conn->getMonthlyData12($year, $month12);
				$currentsales = $conn->getMonthlyData($year, $month);
				$currentsalesSpeial = $conn->getMonthlyDataspecial($year, $month);

				$Acceted=  $conn-> getMonthlyDataAccepted( $year, $month);
				$Declined=  $conn->getMonthlyDataDeclined( $year, $month);
				$Pending=  $conn->getMonthlyDataPending( $year, $month);

				foreach($currentsales1 as $row){
					$totalsum1+= $row['Amount'];
				 }
				foreach($currentsales2 as $row){
					$totalsum2+= $row['Amount'];
				 }foreach($currentsales3 as $row){
					$totalsum3+= $row['Amount'];
				 }

				 foreach($currentsales4 as $row){
					$totalsum4 +=$row['Amount'];
				 }
				 foreach($currentsales5 as $row){
					$totalsum5+= $row['Amount'];
				 }
				 foreach($currentsales6 as $row){
					$totalsum6+= $row['Amount'];
				 }
				 foreach($currentsales7 as $row){
					$totalsum7+= $row['Amount'];
				 }
				 foreach($currentsales8 as $row){
					$totalsum8+= $row['Amount'];
				 }
				 foreach($currentsales9 as $row){
					$totalsum9+= $row['Amount'];
				 }
				 foreach($currentsales10 as $row){
					$totalsum10 +=$row['Amount'];
				 }
				 foreach($currentsales11 as $row){
					$totalsum11+= $row['Amount'];
				 }
				 foreach($currentsales12 as $row){
					$totalsum12+= $row['Amount'];
				 }
				 foreach($currentsales as $row){
					$totalsum+= $row['Amount'];
					
				 }
				 foreach($currentsalesSpeial as $row){
					
					$howmanybookingthismonth++;
				 }
				foreach($Acceted as $row){
					$hownmanyAccepted++;
				}
				 
				 foreach($Declined as $row){
				
					$hownmanyDeclined++;
				 }
				 foreach($Pending as $row){
				
					$hownmanypending++;
				 }
				
				
				 

				?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard with in the Month (<?=$month = date('F');	?>) </h1>

					<div class="row">
						<div class="col-xl-13 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Booked This month</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="truck"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$howmanybookingthismonth?></h1>
												<div class="mb-0">
													
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Declined</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$hownmanyDeclined?></h1>
												<div class="mb-0">
													
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Earnings</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="dollar-sign"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">	&#8369; <?php echo $totalsum ?></h1>
												<div class="mb-0">
													
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Accepted</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="check-circle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$hownmanyAccepted?></h1>
												<div class="mb-0">
													
													
												</div>
											</div>
										</div>
									
										
										
									</div>
									
									
								</div>
							
							</div>
							
						</div>			
						<div class="col-xl-12 col-xxl-9 d-flex ">
						<div class="w-100 col-sm-6">

<!-- yoee --><div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Pending</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="check-circle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?=$hownmanypending?></h1>
												<div class="mb-0">
													
												</div>
												</div>
											</div>
										</div>



						</div>	
						<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Recent Movement</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
							
						</div>
							
						</div>
					</div>
					

					

					

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong> FUNCTION HALL RESERVATION AND BILLING SYSTEM </strong></a> 
							</p>
						</div>
				
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales (₱)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							<?php echo $totalsum1?>,
							<?php echo $totalsum2?>,
							<?php echo $totalsum3?>,
							<?php echo $totalsum4?>,
							<?php echo $totalsum5?>,
							<?php echo $totalsum6?>,
							<?php echo $totalsum7?>,
							<?php echo $totalsum8?>,
							<?php echo $totalsum9?>,
							<?php echo $totalsum10?>,
							<?php echo $totalsum11?>,
							<?php echo $totalsum12?>
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Chrome", "Firefox", "IE"],
					datasets: [{
						data: [4306, 3801, 1689],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
	</script>


	<script>
   document.addEventListener("DOMContentLoaded", function() {
    // Initialize flatpickr
    var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
    var year = date.getUTCFullYear();
    var month = ("0" + (date.getUTCMonth() + 1)).slice(-2);
    var day = ("0" + date.getUTCDate()).slice(-2);
    var defaultDate = year + "-" + month + "-" + day;

    var calendar = document.getElementById("datetimepicker-dashboard");
    var flatpickrInstance = flatpickr(calendar, {
        inline: true,
        prevArrow: "<span title='Previous month'>&laquo;</span>",
        nextArrow: "<span title='Next month'>&raquo;</span>",
        defaultDate: defaultDate,
        onChange: function(selectedDates) {
            createForm(selectedDates[0]);
        }
    });

    // Function to create and show the form in the modal
    function createForm(selectedDate) {
        var localDate = new Date(selectedDate);
        var dateString = localDate.getFullYear() + "-" 
                        + ("0" + (localDate.getMonth() + 1)).slice(-2) + "-" 
                        + ("0" + localDate.getDate()).slice(-2);  // Format it as YYYY-MM-DD

        // Update modal title and hidden input for the selected date
        document.getElementById("modal-title").innerText = `Mark Event for ${dateString}`;
        document.getElementById("modal-date").value = dateString;

        // Show the modal
        document.getElementById("event-modal").style.display = "block";
    }

    // Handle form submission
    document.getElementById("event-form").addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent form from submitting normally

        var formData = new FormData(this);
        
        // AJAX request to store data in the backend
        fetch("controllers/save-event.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Event saved successfully!");
                // Close the modal
                document.getElementById("event-modal").style.display = "none";
            } else {
                alert("Error saving event.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred.");
        });
    });

    // Close the modal when the user clicks the close button
    document.querySelector(".close-btn").addEventListener("click", function() {
        document.getElementById("event-modal").style.display = "none";
    });

    // Close the modal if the user clicks anywhere outside the modal
    window.onclick = function(event) {
        if (event.target === document.getElementById("event-modal")) {
            document.getElementById("event-modal").style.display = "none";
        }
    };
});

document.addEventListener("DOMContentLoaded", function() {
    var markedDates = []; 

    
    fetch("controllers/get-marked-dates.php")
        .then(response => response.json())
        .then(data => {
            markedDates = data.dates; 
            initFlatpickr(); 
        })
        .catch(error => {
            console.error("Error fetching marked dates:", error);
        });

    // Initialize flatpickr after getting marked dates
    function initFlatpickr() {
        var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
        var year = date.getUTCFullYear();
        var month = ("0" + (date.getUTCMonth() + 1)).slice(-2);
        var day = ("0" + date.getUTCDate()).slice(-2);
        var defaultDate = year + "-" + month + "-" + day;

        var calendar = document.getElementById("datetimepicker-dashboard");
        var flatpickrInstance = flatpickr(calendar, {
            inline: true,
            prevArrow: "<span title='Previous month'>&laquo;</span>",
            nextArrow: "<span title='Next month'>&raquo;</span>",
            defaultDate: defaultDate,
            onChange: function(selectedDates) {
                createForm(selectedDates[0]);
            },
            disable: markedDates
        });
    }

    // Function to create and show the form in the modal (same as before)
    function createForm(selectedDate) {
        var localDate = new Date(selectedDate);
        var dateString = localDate.getFullYear() + "-" 
                        + ("0" + (localDate.getMonth() + 1)).slice(-2) + "-" 
                        + ("0" + localDate.getDate()).slice(-2);  // Format it as YYYY-MM-DD

        document.getElementById("modal-title").innerText = `Mark Event for ${dateString}`;
        document.getElementById("modal-date").value = dateString;
        document.getElementById("event-modal").style.display = "block";
    }
});

</script>


</body>

</html>