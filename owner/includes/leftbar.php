
<?php
$id = $_SESSION['userid'];
?>
	
	<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
			
				<li class="ts-label">For Owner Use</li>
				<li><a href="dashboard.php?id=<?php echo $id;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			
					<!-- <li><a href="#"><i class="fa fa-files-o"></i> Equipment Management</a> -->
					<ul>
					<!-- <li><a href="create-brand.php">Add Equipment Management</a></li> -->
					<!--<li><a href="manage-brands.php">Manage Brand</a></li>-->
					</ul>
					</li>

<li><a href="#"><i class="fa fa-truck"></i> Equipment Management</a>
					<ul>
						<li><a href="post-eq.php?id=<?php echo $id;?>">Add Equipment</a></li>
						<li><a href="manage-eq.php?id=<?php echo $id;?>">Manage Equipment</a></li>
					</ul>
				</li>

<li><a href="#"><i class="fa fa-sitemap"></i> Bookings</a>
					<ul>
						<li><a href="new-bookings.php?id=<?php echo $id;?>">New</a></li>
						<li><a href="confirmed-bookings.php?id=<?php echo $id;?>">Accepted</a></li>
						<li><a href="canceled-bookings.php?id=<?php echo $id;?>">Rejected</a></li>
					</ul>
				</li>

		

				<!-- <li><a href="testimonials.php"><i class="fa fa-table"></i> Manage Testimonials</a></li> -->
				<!-- <li><a href="manage-conactusquery.php"><i class="fa fa-desktop"></i> Manage Conatctus Query</a></li> -->
				<!-- <li><a href="reg-users.php"><i class="fa fa-users"></i> Reg Users</a></li> -->
			<!-- <li><a href="manage-pages.php"><i class="fa fa-files-o"></i> Manage Pages</a></li> -->
			<!-- <li><a href="update-contactinfo.php"><i class="fa fa-files-o"></i> Update Contact Info</a></li> -->

			<!-- <li><a href="manage-subscribers.php"><i class="fa fa-table"></i> Manage Subscribers</a></li> -->

			</ul>
		</nav>