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

    <h1 class="h3 mb-3">
        All Approved Requests of 
        <strong>FUNCTION HALL RESERVATION AND BILLING SYSTEM</strong>
    </h1>

    <?php
    $conn = new class_model();
    $booking = $conn->fetchAll_BookingApproved();
    ?>

    <div class="row">
	
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
		
            <div class="card flex-fill">
			<div id="message"></div>
			<div class="card-body">
  <div class="row">
    <div class="col-lg-6">
      <div class="input-group mb-3">
        <input name="search" type="text" class="form-control" placeholder="Search">
        <span class="input-group-text"><i data-feather="search"></i></span>
      </div>
    </div>
    <div class="col-lg-3">
      <select id="sortDate" class="form-select ms-auto">
        <option selected disabled>Date booked Sorter</option>
        <option value="increment">Increment</option>
        <option value="decrement">Decrement</option>
      </select>
    </div>
  </div>
</div>


                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>Code No.</th>
                                <th>Name of Event</th>
                                <th>Name of Client</th>
                                <th>Name of Officer</th>
                                <th>Name of Officer</th>
                                <th>Date of Booking</th>
                                <th>Date Booked</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($booking)) {
                                foreach ($booking as $row) { ?>
                                    <tr>
                  
                    <td><?= htmlspecialchars($row['code']) ?></td>
                    <td><?= htmlspecialchars($row['events']) ?></td>
                    <td>
                        <?= isset($row['customer_name']) ? htmlspecialchars($row['customer_name']) : "(Admin)";  ?>
                    </td>
                    <td>
                        <?= isset($row['user_name']) ? htmlspecialchars($row['user_name']) : "N/A";  ?>
                    </td>
                    <td>
                        <?=$row['Duration'] ?>
                    </td>
                    <td>
                        <?= isset($row['currents_dates']) ? htmlspecialchars($row['currents_dates']) : 'N/A' ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($row['date']) ?>
                    </td>
                    <td>
                        <?php if($row['Status']== "Approved"){ ?>
                            <span class="badge bg-success">Approved</span>
                        <?php }elseif($row['Status']== "Declined"){ ?>
                            <span class="badge bg-danger">Declined</span>
                        <?php }else{ ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="receipt.php?event=<?= $row['id']; ?>&event-name=<?php echo $row['events']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" title="Invoice">
                            <i class="align-middle me-2" data-feather="file-text"></i> <span class="align-middle"></span>
                        </a>
                    </td>
                </tr>
                            <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="10" class="text-center">No booking records found.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Add this script to ensure Feather icons render properly -->
<script>
    feather.replace();
</script>


<script src="js/jquery.min.js"></script>

   




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
<script>
$(document).ready(function(){
  $("input[name='search']").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});
</script>
<script>
document.getElementById('sortDate').addEventListener('change', function () {
    const order = this.value;
    const tableBody = document.querySelector('table tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    // Remove placeholder row if present
    const filteredRows = rows.filter(row => row.querySelector('td[colspan]') === null);

    filteredRows.sort((a, b) => {
        const dateA = new Date(a.children[6].textContent.trim());
        const dateB = new Date(b.children[6].textContent.trim());
        
        return order === 'increment' ? dateA - dateB : dateB - dateA;
    });

    // Clear and append rows
    tableBody.innerHTML = '';
    filteredRows.forEach(row => tableBody.appendChild(row));
});
</script>

</body>

</html>