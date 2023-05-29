<aside class="left-side sidebar-offcanvas">
	<section class="sidebar">
		<!-- User -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo $relative_url; ?>images/temp/user.png" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>Hello, <?php echo isset($_SESSION['user']) ? $_SESSION['user']['name'] : ''; ?></p>
			</div>
		</div>
	
		<!-- Menu -->
		<ul class="sidebar-menu">
			<li <?php echo $page == 'timetable' ? 'class="active"' : ''; ?>>
				<a href="<?php echo $relative_path; ?>timetable/list.php">
					<i class="fa fa-calendar"></i> <span>Timetables</span>
				</a>
			</li>
			<li <?php echo $page == 'user' ? 'class="active"' : ''; ?>>
				<a href="<?php echo $relative_path; ?>user/list.php">
					<i class="fa fa-user"></i> <span>Users</span>
				</a>
			</li>
		</ul>
	</section>
</aside>