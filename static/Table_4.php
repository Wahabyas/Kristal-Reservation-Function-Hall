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
        All In Payment Process of 
        <strong>FUNCTION HALL RESERVATION AND BILLING SYSTEM</strong>
    </h1>

    <?php
    $conn = new class_model();
    $booking = $conn->fetchAll_BookingPayable();
    ?>

    <div class="row">
	
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
		
            <div class="card flex-fill">
			<div id="message"></div>		
					<div class="card-body">
  <div class="row">
    <div class="col-lg-6">
      <div class="input-group">
        <input name="search" type="text" class="form-control" placeholder="Search">
        <span class="input-group-text"><i data-feather="search"></i></span>
      </div>
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

                            <th >Date of Booking</th>
                            <th>Date Booked</th>
                            <th >Duration</th>
                            <th >Amount</th>
                            <th>Status</th>
                            <th class="d-none d-md-table-cell">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($booking)) {
                            foreach ($booking as $row) { ?>
                                <tr>
                                    <?php 
                                   $Cdate = date('Y-m-d');
                                   $expDate = date('Y-m-d', strtotime($row['Expdate']));
                               
                            
                                  if ($Cdate >= $expDate){
                                    
                                   ?>
							    <td><?= htmlspecialchars($row['code']) ?></td>

                                    <td><?= htmlspecialchars($row['events']) ?></td>
                                    <td >
                                        <?= isset($row['customer_name']) ? htmlspecialchars($row['customer_name']) : "(Admin)";  ?>
                                    </td>
									<td >
                                        <?= isset($row['user_name']) ? htmlspecialchars($row['user_name']) : "N/A";  ?>
                                    </td>
									<td >
                                        <?= isset($row['currents_dates']) ? htmlspecialchars($row['currents_dates']) : 'N/A' ?>
                                    </td>
                                    <td >
                                        <?= htmlspecialchars($row['date']) ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Duration']?>
                                    </td>
									<td >
                                        <?= htmlspecialchars($row['Amount']) ?>
                                    </td>
                                    <td>
                                      
                                            <?php if($row['Status']== "Payable"){ ?>
												<span style="background-color:orange " class="badge bg-Orange">
												Expired
												</span>
											<?php } ?>
                                    </td>
                               
                                </tr>
                        <?php }else{ ?>
                                <td><?= htmlspecialchars($row['code']) ?></td>

                                    <td><?= htmlspecialchars($row['events']) ?></td>
                                    <td >
                                        <?= isset($row['customer_name']) ? htmlspecialchars($row['customer_name']) : "(Admin)";  ?>
                                    </td>
									<td >
                                        <?= isset($row['user_name']) ? htmlspecialchars($row['user_name']) : "N/A";  ?>
                                    </td>
									<td >
                                        <?= isset($row['currents_dates']) ? htmlspecialchars($row['currents_dates']) : 'N/A' ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($row['date']) ?>
                                    </td>
                                     <td>
                                        <?php echo $row['Duration']?>
                                    </td>
									<td >
                                        <?= htmlspecialchars($row['Amount']) ?>
                                    </td>
                                    <td>
                                      
                                            <?php if($row['Status']== "Payable"){ ?>
												<span class="badge bg-primary">
												Payable
												</span>
											<?php } ?>
                                    </td>
                                    <td  style="margin-right:200px">
                                    <div style="display: flex;  align-items: center;">
									<a style="padding:0;" href="payment.php?event=<?= $row['id']; ?>&event-name=<?php echo $row['events']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" title="Pay Event">
									<i style="color:green;" class="align-middle me-2" data-feather="dollar-sign"></i> <span class="align-middle"></span>
												</a> 
                                               
                                                <a href="javascript:;" data-id="<?= $row['id']; ?>" class="text-secondary font-weight-bold text-xs cancel " data-toggle="tooltip" title="Disapprove event">
												<i class="align-middle me-2" data-feather="slash"></i>
												</a>
                                            </div>
                                    </td>
                                   
                                </tr>

                     <?php   } }
                        } else { ?>
                            <tr>
                                <td colspan="11" class="text-center">No booking records found.</td>
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
    <script src="js/jquery.min.js"></script>

    <script>
    $(document).ready(function() {

        load_data();

        var count = 1;

        function load_data() {
            $(document).on('click', '.disapprove', function() {

                var id = $(this).attr("data-id");
               
                if (confirm("Are you sure want to Disapprove this Booking?")) {
                    $.ajax({
                        url: 'controllers/Expired.php',

                        method: "POST",
                        data: {
                            event_id: id
                        },
                      success: function(response) {

                          $("#message").html(response);
                          },
                          error: function(response) {
                            console.log("Failed");
                          }
                    })
                }
            });
        }

    });
</script>
    <script src="js/jquery.min.js"></script>

    <script>
    $(document).ready(function() {

        load_data();

        var count = 1;

        function load_data() {
            $(document).on('click', '.cancel', function() {

                var id = $(this).attr("data-id");
            
                if (confirm("Are you sure want to Disapprove this Booking?")) {
                    $.ajax({
                        url: 'controllers/cancel.php',

                        method: "POST",
                        data: {
                            event_id: id
                        },
                    success: function(response) {

                        $("#message").html(response);
                        },
                        error: function(response) {
                            console.log("Failed");
                        }
                    })
                }
            });
        }

    });
    </script>
	<script src="js/app.js"></script>

	


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

</body>

</html>