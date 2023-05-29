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
	$ipler = array('213.74.59.98','213.74.20.182','85.96.88.60','82.222.18.170','91.93.169.116','88.235.30.53','176.40.255.250');
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
    <meta charset="UTF-8">
    <title>PwC Platform | Yönetim Paneli</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Tiva Timetable">
    <meta name="keywords" content="Admin, Tiva Timetable">
    
	<!-- CSS -->
    <link href="<?php echo $relative_url; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $relative_url; ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $relative_url; ?>assets/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $relative_url; ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $relative_url; ?>assets/css/datatable.css?v=1.0" rel="stylesheet" type="text/css" />
	
	<!-- jQuery -->
	<script src="<?php echo $relative_url; ?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $relative_url; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo $relative_url; ?>assets/js/bootstrap-filestyle.min.js"></script>
	<script src="<?php echo $relative_url; ?>assets/js/moment.min.js"></script>
	<script src="<?php echo $relative_url; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo $relative_url; ?>assets/js/admin.js" type="text/javascript"></script>
	<script src="<?php echo $relative_url; ?>assets/js/datatable.js?v=1.5"></script>
	<script src="<?php echo $relative_url; ?>assets/js/buttons.js?v=1.5"></script>
	<script src="<?php echo $relative_url; ?>assets/js/zip.js?v=1.5"></script>
	<script src="<?php echo $relative_url; ?>assets/js/pdf.js?v=1.5"></script>
	<script src="<?php echo $relative_url; ?>assets/js/vfs.js?v=1.5"></script>
	<script src="<?php echo $relative_url; ?>assets/js/hb.js?v=1.5"></script>
	<script src="<?php echo $relative_url; ?>assets/js/print.js?v=1.5"></script>
</head>