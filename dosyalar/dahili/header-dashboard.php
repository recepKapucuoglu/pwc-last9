<?php 
include('functions.php');
$egitimler = egitimler_db();
?>
<!DOCTYPE HTML>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<title>PwC Bussiness School</title>
	<meta name="theme-color" content="#0f4200" />
	<meta name="msapplication-navbutton-color" content="#0f4200">
	<meta name="apple-mobile-web-app-status-bar-style" content="#0f4200">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="dosyalar/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="dosyalar/css/style.css?v=10042019">
	<link type="text/css" rel="stylesheet" href="dosyalar/moduller/owl.carousel/assets/owl.carousel.min.css">
	<link type="text/css" rel="stylesheet" href="dosyalar/moduller/owl.carousel/assets/owl.theme.default.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=latin-ext" rel="stylesheet" />
	<script src="dosyalar/js/jquery.js"></script>	
	<link rel="icon" type="image/png" href="dosyalar/images/favicon.png">
</head>
<body class="dashboard">
<header>
	<div class="logobar">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="logo">
						<div class="dashboard_menuac"><i class="fas fa-bars"></i></div>
						<a href="dashboard.php">
							<img src="dosyalar/images/logo-pwc-1.png" alt="" />
						</a>
					</div>
					<div class="logosag">
						<div class="bildiriler" data-sayi="1">
							<span></span>
							<div class="bildirilist" style="display:none;">
								<ul>
									<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
								</ul>
							</div>
						</div>
						<div class="profilres">
							<a href="dashboard-profilim.php">
								<img src="dosyalar/images/profil.jpg" alt="" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="nav">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul>
						<li>
							<a href="#">EĞİTİMLERİMİZ</a>
							<ul>
								<li><a href="#">Danışmanlık</a></li>
								<li><a href="#">Vergi</a></li>
								<li><a href="#">Hukuk</a></li>
								<li><a href="#">İnsan Kaynakları</a></li>
								<li><a href="#">Arşiv</a></li>
								<li><a href="#">Risk / Süreç / Teknoloji</a></li>
								<li><a href="#">Gümrük</a></li>
								<li><a href="#">Platform</a></li>
								<li><a href="#">Online Eğitim</a></li>
								<li><a href="#">Finans / Muhasebe / Denetim</a></li>
								<li><a href="#">Executive on Board </a></li>
							</ul>
						</li>
						<li><a href="#">PWC PLATFORM</a></li>
						<li><a href="#">EXECUTIVE ON BOARD</a></li>
						<li><a href="#">İLETİŞİM</a></li>
						<li><a href="#">HAKKIMIZDA</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>
<main>