

<nav id="sidebar" class="sidebar js-sidebar">

	<?php session_start();
	require 'model/class_model.php';

	?>  
	<?php if(!$_SESSION['user_id']){
					 unset($_SESSION['user_id']); 
					 session_unset(); 
					 session_destroy();
					 header('Location: includes/logout.php');
					
				}
				
				
				
				$consh = new class_model();
				$User_id= $_SESSION['user_id'];
				$userinfo = $consh-> user_account($User_id);
				?>
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">
										<i class="align-middle " data-feather="book-open"></i> 
									 FUNCTION HALL RESERVATION AND BILLING SYSTEM    </span>
        </a>

<?php  $current_page = basename($_SERVER['PHP_SELF']);?>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="<?php echo $sidebar_class = ($current_page == 'dashboard.php') ? "sidebar-item active" : "sidebar-item"; ?>">
						<a class="sidebar-link" href="dashboard.php">
              <i class="text-success" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>
					<li class="<?php echo $sidebar_class = ($current_page == 'calendar1.php') ? "sidebar-item active" : "sidebar-item"; ?>">

				<a class="sidebar-link" href="calendar1.php">
					<i class="text-primary" data-feather="calendar"></i> <span class="align-middle">Calendar</span>
				</a>
			</li>
			<li   class="<?php echo $sidebar_class = ($current_page == 'table.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="table.php">
              <i  class="text-success" data-feather="map"></i> <span class="align-middle">Booking</span>
            </a>
					</li>
					
					
					
					<li  class="<?php echo $sidebar_class = ($current_page == 'Table_2.php') ? "sidebar-item active" : "sidebar-item"; ?>">
						<a class="sidebar-link" href="Table_2.php">
              <i class="text-primary" data-feather="user-check"></i> <span class="align-middle">Approved</span>
            </a>
					</li>

					<li  class="<?php echo $sidebar_class = ($current_page == 'Table_3.php') ? "sidebar-item active" : "sidebar-item"; ?>">
						<a class="sidebar-link" href="Table_3.php">
              <i style="color: EB3939;" data-feather="user-x"></i> <span class="align-middle">Rejected or Expired</span>
            </a>
					</li>
					<li  class="<?php echo $sidebar_class = ($current_page == 'Table_4.php') ? "sidebar-item active" : "sidebar-item"; ?>">
						<a class="sidebar-link" href="Table_4.php">
              <i class="text-warning" data-feather="user-minus"></i> <span class="align-middle">In Payment Process</span>
            </a>
					</li>
					<?php if($userinfo['role'] != 'Staff'){ ?>
					<li  class="<?php echo $sidebar_class = ($current_page == 'Users1.php') ? "sidebar-item active" : "sidebar-item"; ?>">
						<a class="sidebar-link" href="Users1.php">
						<i class="text-warning" data-feather="alert-circle"></i>
						<span class="align-middle">Admin Table</span>
            </a>
					</li>
						<li  class="<?php echo $sidebar_class = ($current_page == 'My_request.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="My_request.php">
						<i class="align-middle me-2 text-warning" data-feather="clipboard"></i> 
						<span class="align-middle">My Table Requests</span>
            </a>
					</li>
					<?php 
					}else{}
					?>
					<?php if($userinfo['role']== "Admin"){ ?>
					<li  class="<?php echo $sidebar_class = ($current_page == 'Users.php') ? "sidebar-item active" : "sidebar-item"; ?>">
						<a class="sidebar-link" href="Users.php">
              <i class="align-middle" style="color:orange;" data-feather="users"></i> <span class="align-middle">Client Table</span>
            </a>
					</li>
					<?php }else{} ?>
					<li hidden  class="<?php echo $sidebar_class = ($current_page == 'pages-profile.php') ? "sidebar-item active" : "sidebar-item"; ?>">
						<a class="sidebar-link" href="pages-profile.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
					</li>

					<li hidden  class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-in.php">
              <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
            </a>
					</li>

					<li hidden  class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-up.php">
              <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
            </a>
					</li>

					
					<li  hidden class="<?php echo $sidebar_class = ($current_page == 'pages-blank.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="pages-blank.php">
              <i hidden class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
            </a>
					</li>

					<li hidden  class="sidebar-header">
						Tools & Components
					</li>

					<li hidden  class="<?php echo $sidebar_class = ($current_page == 'ui-buttons.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="ui-buttons.php">
              <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
            </a>
					</li>

					<li 	hidden  class="<?php echo $sidebar_class = ($current_page == 'ui-forms.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="ui-forms.php">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
            </a>
					</li>

					<li  hidden class="<?php echo $sidebar_class = ($current_page == 'ui-cards.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="ui-cards.php">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
            </a>
					</li>

					<li  hidden class="<?php echo $sidebar_class = ($current_page == 'ui-typography.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="ui-typography.php">
              <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
            </a>
					</li>

					<li  hidden  class="<?php echo $sidebar_class = ($current_page == 'icons-feather.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="icons-feather.php">
              <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
            </a>
					</li>

					<li hidden  class="sidebar-header">
						Plugins & Addons
					</li>

					<li hidden  class="<?php echo $sidebar_class = ($current_page == 'charts-chartjs.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="charts-chartjs.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
            </a>
					</li>

					<li  hidden  class="<?php echo $sidebar_class = ($current_page == 'maps-google.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="maps-google.php">
              <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
            </a>
					</li>

					
					
					<li  class="<?php echo $sidebar_class = ($current_page == 'History.php') ? "sidebar-item active" : "sidebar-item"; ?>">

						<a class="sidebar-link" href="History.php">
						<i  class="text-warning" data-feather="repeat"></i> 
						<span class="align-middle">History</span>
            </a>
					</li>
					
				</ul>

			
			</div>
		</nav>