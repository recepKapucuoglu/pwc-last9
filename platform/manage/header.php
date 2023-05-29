<?php 
function GetIP(){ 
	if(getenv("HTTP_CLIENT_IP")) { 
	$ip = getenv("HTTP_CLIENT_IP"); 
	} elseif(getenv("HTTP_X_FORWARDED_FOR")) { 
	$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	if (strstr($ip, ',')) { 
	$tmp = explode (',', $ip); 
	$ip = trim($tmp[0]); 
	} 
	} else { 
	$ip = getenv("REMOTE_ADDR"); 
	} 
	return $ip; 
} 
	$ipler = array('213.74.59.98','213.74.20.182','85.96.88.60','82.222.18.170','91.93.169.116','88.235.30.53','176.40.255.250','localhost');
	$kimlik = GetIP();
	$giris_ip = 0;
	foreach($ipler as $ban){
		if($ban == $kimlik){
			$giris_ip = 1;
		}
	}
	if($giris_ip <> 1){
		header('Location: https://www.okul.pwc.com.tr/');exit();
	}
	?>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Tiva Timetable</title>
    
	<!------------ Assets for Tiva Timetable ------------->
	<!-- Timetable Font -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css' />

	<!-- Timetable CSS Files -->
	<link rel="stylesheet" href="<?php echo $relative_url; ?>assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo $relative_url; ?>assets/css/timetable.css?v=1.0.4">

	<!-- Timetable JS Files -->
	<script src="<?php echo $relative_url; ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo $relative_url; ?>assets/js/jquery.magnific-popup.js"></script>
	<script src="<?php echo $relative_url; ?>assets/js/timetable.js?v=1.10.16"></script>
	<script src="<?php echo $relative_url; ?>assets/js/datatable.js?v=1.6"></script>
	<!--------------------------------------------------->

	<!-------------- CSS Files for example -------------->
	<link rel="stylesheet" href="<?php echo $relative_url; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $relative_url; ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $relative_url; ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo $relative_url; ?>assets/css/datatable.css">
</head>