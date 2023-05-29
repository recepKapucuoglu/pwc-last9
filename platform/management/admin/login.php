<?php
include_once('../config/database.php');

$submitted_username = '';
$alert_message = '';

if (!empty($_POST)) {
	$login_ok = false;
	
	// Get user by username
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT id, name, username, password, salt, email FROM users WHERE username = ? AND role = 1 AND state = 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($_POST['username']));
	$row = $q->fetch(PDO::FETCH_ASSOC);
	
	Database::disconnect();
	
	// Check password
	if ($row) { 
		$check_password = hash('sha256', $_POST['password'] . $row['salt']); 
		for ($round = 0; $round < 65536; $round++) { 
			$check_password = hash('sha256', $check_password . $row['salt']); 
		} 

		if ($check_password === $row['password']) { 
			$login_ok = true; 
		} 
	} 
         
	if ($login_ok) { // If the user logged in successfully
		// Unset password and salt
		unset($row['salt']);
		unset($row['password']);
		 
		// Store user info in session
		$_SESSION['user'] = $row;
		$_SESSION['login_time'] = time();
		 
		// Redirect the user to the index page. 
		ob_end_clean();
		header("Location: timetable/list.php");
		EXIT;
	} else { // Login failed
		// Alert message
		$alert_message = '<div class="alert alert-block alert-danger">Login Failed. Please try again.</div>';
		 
		// Keep the username in login form
		$submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
	} 
}     
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
				<section class="panel login">
					<header class="panel-heading">
						Log In
					</header>
					<div class="panel-body">
						<?php echo $alert_message; ?>
						
						<form method="post" action="index.php" role="form">
							<div class="form-group">
								<input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo $submitted_username; ?>" required />
							</div>
							
							<div class="form-group">
								<input type="password" name="password" class="form-control" id="password" placeholder="Password" required />
							</div>
							
							<button type="submit" class="btn btn-info"><i class="fa fa-lock"></i> Login</button>
						</form>
					</div>
				</section>
            </div>
        </div>
    </div>
</body>