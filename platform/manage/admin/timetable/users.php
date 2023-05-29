<?php
session_start();

include_once('controllers/timetable_controller.php');

// Variables
$relative_url = '../../';
$relative_path = '../';
$page = 'timetable';

// Get controller
$timetable = new TimetableController();
?>

<!DOCTYPE html>
<html>
<!-- Header -->
<?php include $relative_path . 'header.php'; ?>
<style type="text/css">
	.buttons-html5 {
		background-color: #db536a;
    color: #fff;
    /* border-radius: 5px; */
    border-color: #db536a;
    /* box-shadow: none;
	}
	table.dataTable thead td {
		padding: 10px 8px !important;
    	border-bottom: 1px solid #111;
	}
</style>
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
<body>
	<!-- Navbar -->
				
	<div class="container-fluid">
		<!-- Sidebar -->
		
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<section class="panel">
							<header class="panel-heading"><i class="fa fa-folder-open"></i> Katılımcı Listesi</header>
							<div class="panel-body">
							<?php $timetable->displayJoinList(); ?>
							</div>
						</section>
					</div>
				</div>
			</section>
			
			<!-- Footer -->
			<script type="text/javascript">
				$(document).ready( function () {
    				$('#table_id').DataTable( {
        dom: 'Bfrtip',
		ordering: false,
        buttons: [
            {
                extend: 'excel',
                title: '21. Çözüm Ortaklığı Platformu Katılımcı Raporu',
				text: 'Excel Export'
            },
        ]
    } );
				} );
			</script>
	</div>
</body>
</html>