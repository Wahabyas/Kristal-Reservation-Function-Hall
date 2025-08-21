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

.flatpickr-day.marked-green {
       background:rgb(134, 11, 11) !important;
    color: #fff !important;
   
}
</style>
<body>
	<div class="wrapper"> 
		<!--  -->
		<?php include('includes/sidebar.php'); ?>
<!--  -->
		<div class="main">
		<?php include('includes/header.php'); 
		$Id=$_SESSION['user_id'];
    
		?>
		
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Make a <strong>Reservation </strong></h1>

					
					

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

			<select class="form-select mb-3" id="event" name="event" required>
    <option value="" disabled selected>Select an event</option>
    <option value="Wedding">Wedding</option>
    <option value="Birthday">Birthday</option>
    <option value="Ramadhan Eid">Ramadhan Eid</option>
    <option value="custom">Other (Specify)</option>
</select>



<input type="text" id="custom-event" name="custom-event" class="form-control mt-2" placeholder="Specify your event" style="display: none;">


									<input hidden  type="text" id="Customer_id" name="Customer_id"   class="form-control" placeholder="Input" value="<?=$Id?>">

								</div>
                                <label for="event">Duration:</label>
                                <div class="card-body">
                                <select class="form-select mb-3" id="duration" name="duration" required>
    <option value="" disabled selected>Select Time Duration</option>
    <option value="Morning">Morning</option>
    <option value="After Noon">After Noon</option>
    <option value="Whole Day">Whole Day</option>
   
</select>
</div>

                                <br><br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>

						<div class="col-12 col-md-8 col-xxl-3 d-flex order-1 order-xxl-1 mx-auto
						">
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
					
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>


	
	
	


	<script>
   document.addEventListener("DOMContentLoaded", function() {

    var date = new Date(); // Use today's date
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

        if (formData.get("event") === "custom") {
    const customEventValue = document.getElementById("custom-event").value;
    formData.set("event", customEventValue);
}
      
        fetch("controllers/save-event.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Event saved successfully!");
				location.reload();

             
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
        var date = new Date(); 
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
            disable: markedDates,
              onDayCreate: function(dObj, dStr, fp, dayElem) {
                // Format date as YYYY-MM-DD
                var date = dayElem.dateObj;
                var y = date.getFullYear();
                var m = ("0" + (date.getMonth() + 1)).slice(-2);
                var d = ("0" + date.getDate()).slice(-2);
                var formatted = y + "-" + m + "-" + d;
                if (markedDates.includes(formatted)) {
                    dayElem.classList.add("marked-green");
                }
            },
        });
    }







    function createForm(selectedDate) {
    var localDate = new Date(selectedDate);
    var dateString = localDate.getFullYear() + "-" 
                    + ("0" + (localDate.getMonth() + 1)).slice(-2) + "-" 
                    + ("0" + localDate.getDate()).slice(-2);  

    // Get today's date at midnight
    var today = new Date();
    today.setHours(0,0,0,0);
    localDate.setHours(0,0,0,0);

    if (localDate <= today) {
         
     
         
        return;
    }

    document.getElementById("modal-title").innerText = `Mark Event for ${dateString}`;
    document.getElementById("modal-date").value = dateString;

    const durationSelect = document.getElementById("duration");

    for (let option of durationSelect.options) {
        option.hidden = false;
    }

    fetch("controllers/check-duration.php?date=" + dateString)
        .then(response => response.json())
        .then(data => {
            const durations = data.durations;

            if (durations.includes("Morning")) {
                for (let option of durationSelect.options) {
                    if (option.value === "Morning" || option.value === "Whole Day") {
                        option.hidden = true;
                    }
                }
            }

            if (durations.includes("After Noon")) {
                for (let option of durationSelect.options) {
                    if (option.value === "After Noon" || option.value === "Whole Day") {
                        option.hidden = true;
                    }
                }
            }
        })
        .catch(error => {
            console.error("Error fetching duration info:", error);
        });

    document.getElementById("event-modal").style.display = "block";
}

});



document.getElementById("event").addEventListener("change", function() {
    const selected = this.value;
    const customInput = document.getElementById("custom-event");

    if (selected === "custom") {
        customInput.style.display = "block";
        customInput.required = true;
    } else {
        customInput.style.display = "none";
        customInput.required = false;
    }
});

</script>




</body>

</html>