<?php
// Check session login
if (empty($_SESSION['user'])) {
	// If not login, redirect to the index page
	header('Location: ' . $relative_path . 'index.php');
	EXIT;
} else {
	if (isset($_SESSION['login_time'])){
		$login_session_duration = 900; // 15 minutes
		$current_time = time();
		if (((time() - $_SESSION['login_time']) > $login_session_duration)) { // Timeover
			// Unset session
			unset($_SESSION['user']);
			unset($_SESSION['login_time']);
				 
			// Redirect to the index page 
			header('Location: ' . $relative_path . 'index.php');
			EXIT;
		} else {
			$_SESSION['login_time'] = time();
		}
	}
}

?>

<header class="header">
	<a href="<?php echo $relative_path; ?>index.php" class="logo"><i class="fa fa-calendar" aria-hidden="true"></i> <span>Tiva Timetable</span></a>
		
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class="user user-menu">
					<a target="_blank" href="<?php echo $relative_url; ?>index.php">
						<i class="fa fa-home" style="font-size:16px;"></i>
						<span>Visit Site</span>
					</a>
				</li>
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-user"></i>
						<span><?php echo isset($_SESSION['user']) ? $_SESSION['user']['name'] : ''; ?> <i class="caret"></i></span>
					</a>
					
					<ul class="dropdown-menu dropdown-custom dropdown-menu-right">
						<li class="dropdown-header text-center">Account</li>
						<li>
							<a href="<?php echo isset($_SESSION['user']) ? $relative_path . 'user/edit.php?id=' . $_SESSION['user']['id'] : ''; ?>">
								<i class="fa fa-user fa-fw pull-right"></i> Profile
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="<?php echo $relative_path . 'logout.php'; ?>"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>