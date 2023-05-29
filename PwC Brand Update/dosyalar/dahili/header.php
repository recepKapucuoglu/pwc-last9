<?php 
include('inc.php');
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
	<link rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/css/style.css?v=06012020">
	<link type="text/css" rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/moduller/owl.carousel/assets/owl.carousel.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/moduller/owl.carousel/assets/owl.theme.default.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=latin-ext" rel="stylesheet" />
	<script src="<?php echo $site_url; ?>dosyalar/js/jquery.js"></script>	
	<link rel="icon" type="image/png" href="<?php echo $site_url; ?>dosyalar/images/favicon.png">
	<base href="<?php echo $site_url; ?>">
</head>
<body>
<header class="active">
	<div class="logobar">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="logo">
						<a href="index.php">
							<img src="<?php echo $site_url; ?>dosyalar/images/logo-pwc-1.png" alt="" />
						</a>
					</div>
					<div class="logosag">
						<!--<a href="dosyalar/dahili/girisform.php" class="login simple-ajax-popup-align-top">Giriş Yap/Kaydol</a>-->
						<span class="aramaactext">Eğitim Arama</span>
						<div class="aramaac"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="mobilbar" style="display:none;">
			<div class="mobil_menuac"><i class="fas fa-bars"></i></div>
			<!--<a href="login.php" class="login"><i class="fas fa-user"></i> Giriş Yap/Kaydol</a>-->
			<div class="aramaac"><i class="fas fa-search"></i></div>
		</div>
		<div class="arama_popup" style="display:none;">
			<div class="arama_kapat"></div>
			<form action="egitimlerimiz.php" method="GET">
				<input type="text" name="s" id="popup_arama" placeholder="Eğitim Arama"/>
				<button></button>
			</form>
		</div>
	</div>
	<nav class="nav">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul>
						<li>
							<a href="egitimlerimiz">Eğitimlerimiz</a>
							<div class="altmenu">
								<ul>
									<li><a href="egitimlerimiz">Tüm Eğitimlerimiz</a></li>
									<?php
										$i=0;
										$db->where('durum', 1);
										$db->orderBy("sira","asc");
										$results = $db->get('categories');
										foreach ($results as $value) {
											$i++;
									?>
									<li><a href="<?php echo $value['seo_url']; ?>"><?php echo $value['baslik']; ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</li>
						<li><a href="/platform/">PwC Platform</a></li>
						<li><a href="https://www.pwc.com.tr/executive-on-board" target="_blank">Executive On Board</a></li>
						<li><a href="iletisim">İletişim</a></li>
						<li><a href="hakkimizda">Hakkımızda</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>
<main>