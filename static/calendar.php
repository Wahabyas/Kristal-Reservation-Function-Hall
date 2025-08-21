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

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Calendar</strong> Scheduling</h1>

					
					

					<div class="row">
					
						<!-- Modal Structure -->
<div id="event-modal" class="modal" style="display:none;">
    <div style="border-radius: 9px;" class="modal-content">
        <span class="close-btn">&times;</span>
        <h5 style="margin-bottom:30px;" id="modal-title"><p class="text-success">Mark Event for.</p> </h5> 
        <form id="event-form">
            <input type="hidden" name="date" id="modal-date">
            <label for="event">Event Name:</label>
            <div class="card-body">
									<input type="text" id="event" name="event" required  class="form-control" placeholder="Input">
								</div><br><br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>

						<div class="col-8 col-md-8 col-xxl-8 d-flex order-1 order-xxl-1 mx-auto">
    <div class="card flex-fill">
        <div class="card-header">
            <h5 class="card-title mb-0">Calendar</h5>
        </div>
        <div class="card-body d-flex">
            <div class="align-self-center w-100">
                <div class="chart">
                    <div id="datetimepicker-dashboard"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Container for the form -->
<div id="form-container"></div>

<!-- Container for the success message -->
<div id="response-container"></div>

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
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
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

   
    function createForm(selectedDate) {
        var localDate = new Date(selectedDate);
        var dateString = localDate.getFullYear() + "-" 
                        + ("0" + (localDate.getMonth() + 1)).slice(-2) + "-" 
                        + ("0" + localDate.getDate()).slice(-2);  

    
        document.getElementById("modal-title").innerText = `Mark Event for ${dateString}`;
        document.getElementById("modal-date").value = dateString;

    
        document.getElementById("event-modal").style.display = "block";
    }

    
    document.getElementById("event-form").addEventListener("submit", function(e) {
        e.preventDefault(); 

        var formData = new FormData(this);
       
        fetch("controllers/save-event.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Event saved successfully!");
              
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


    document.querySelector(".close-btn").addEventListener("click", function() {
        document.getElementById("event-modal").style.display = "none";
    });

 
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

    function createForm(selectedDate) {
        var localDate = new Date(selectedDate);
        var dateString = localDate.getFullYear() + "-" 
                        + ("0" + (localDate.getMonth() + 1)).slice(-2) + "-" 
                        + ("0" + localDate.getDate()).slice(-2);

        document.getElementById("modal-title").innerText = `Mark Event for ${dateString}`;
        document.getElementById("modal-date").value = dateString;
        document.getElementById("event-modal").style.display = "block";
    }
});

</script>


</body>

</html>