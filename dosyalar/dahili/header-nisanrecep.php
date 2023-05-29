<?php
header_remove('x-powered-by');
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include('inc.php');
?>
<!DOCTYPE HTML>
<html lang="tr">

<head>
	<?php
	$actual_link = "https://" . $_SERVER['HTTP_HOST'];

	if ($_SERVER['REQUEST_URI'] <> "/" and $_SERVER['REQUEST_URI'] <> "/index.php") {
		$sayfa_url = rtrim($_SERVER['REQUEST_URI'], "/");
		$page_url = explode("/", $sayfa_url);

		$page_url = end($page_url);

		$page_url = t_decode($page_url);

		$db->where('cal_seo_url', $page_url);
		$results = $db->get('education_canonical_url');
		foreach ($results as $value) {
			$page_url = $value['edu_seo_url'];
		}


		$actual_link = $actual_link . '/' . $page_url;
	}

	?>
	<meta charset="utf-8">
	<title>
		<?php echo $site_title; ?>
	</title>
	<meta name="description" content="<?php echo $site_description; ?>">
	<meta name="keywords" content="<?php echo $site_keywords; ?>">
	<meta name="author" content="SocialThinks" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="<?php echo $site_title; ?>">
	<meta property="og:description" content="<?php echo $site_description; ?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo $actual_link; ?>">
	<meta property="og:site_name" content="PwC Bussiness School">
	<meta property="og:image" content="https://www.okul.pwc.com.tr/dosyalar/images/logo-pwc-1.png">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="<?php echo $actual_link; ?>">
	<meta name="twitter:title" content="<?php echo $site_title; ?>">
	<meta name="twitter:description" content="<?php echo $site_description; ?>">
	<meta name="twitter:site" content="PwC Bussiness School">
	<meta name="twitter:image" content="https://www.okul.pwc.com.tr/dosyalar/images/logo-pwc-1.png">
	<meta itemprop="name" content="<?php echo $site_title; ?>">
	<meta itemprop="description" content="<?php echo $site_description; ?>">
	<meta itemprop="image" content="https://www.okul.pwc.com.tr/dosyalar/images/logo-pwc-1.png">
	<meta itemprop="author" content="SocialThinks">
	<?php if ($_GET['s'] or $_GET['arama']) { ?>
		<meta NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<?php } ?>
	<meta name="theme-color" content="#0f4200" />
	<meta name="msapplication-navbutton-color" content="#0f4200">
	<meta name="apple-mobile-web-app-status-bar-style" content="#0f4200">
	<meta name="viewport"
		content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/css/style.css?v=201212315">
	<link type="text/css" rel="stylesheet"
		href="<?php echo $site_url; ?>dosyalar/css/growl.css?v=<?php echo md5_file(sprintf("%s/dosyalar/css/growl.css", $site_url)); ?>">
	<link type="text/css" rel="stylesheet"
		href="<?php echo $site_url; ?>dosyalar/moduller/owl.carousel/assets/owl.carousel.min.css">
	<link type="text/css" rel="stylesheet"
		href="<?php echo $site_url; ?>dosyalar/moduller/owl.carousel/assets/owl.theme.default.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=latin-ext"
		rel="stylesheet" />
	<script src="<?php echo $site_url; ?>dosyalar/js/jquery.js"></script>
	<link rel="icon" type="image/png" href="<?php echo $site_url; ?>dosyalar/images/favicon.png">
	<base href="<?php echo $site_url; ?>">
	<link rel="canonical" href="<?php echo $actual_link; ?>" />
	<!-- Google Tag Manager -->
	<script>(function (w, d, s, l, i) {
			w[l] = w[l] || []; w[l].push({
				'gtm.start':
					new Date().getTime(), event: 'gtm.js'
			}); var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
					'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-TJ6SWQ9');</script>
	<!-- End Google Tag Manager -->

	<!-- SEO Config -->
	<?php if ($url_rewrite == "iletisim.php") { ?>
		<script type="application/ld+json">
									{
									  "@context": "https://schema.org",
									  "@type": "Corporation",
									  "address": {
													"@type": "PostalAddress",
													"streetAddress": "Vişnezade Mahallesi, Süleyman Seba Cad. BJK Plaza No:48 B Blok, 34357 Akaretler / Beşiktaş / İstanbul",
													"addressCountry":"Türkiye",
													"addressLocality": "Beşiktaş",
													"addressRegion": "İstanbul",
													"postalCode": "34357"
												},
									  "name": "PwC",
									  "alternateName": "PwC Business School",
									  "url": "https://www.okul.pwc.com.tr/",
									  "logo": "https://www.okul.pwc.com.tr/dosyalar/images/logo-pwc-1.png", 
									  "contactPoint": [{
										"@type": "ContactPoint",
										"telephone": "0212 376 59 80",
										"contactType": "customer service",
										"contactOption": "TollFree",
										"areaServed": "TR",
										"availableLanguage": "Turkish"
									  },{
										"@type": "ContactPoint",
										"telephone": "0212 376 59 80",
										"contactType": "sales",
										"contactOption": "TollFree",
										"areaServed": "TR",
										"availableLanguage": "Turkish"
									  },]
									}
									</script>


	<?php } elseif ($url_rewrite == "index.php") { ?>
		<script type="application/ld+json">
							{
									"@context": "https://schema.org",
									"@type": "Organization",
									"name": "PwC",
									"alternatename":"PwC Business School",
									"legalName":"PwC Yönetim Danışmanlığı A.Ş.", 
									"description":"PwC Business School olarak, uzmanlık alanımız olan “Bağımsız Denetim ve Danışmanlık”, “Vergi Danışmanlığı”, “İnsan Kaynakları Danışmanlığı”, “Kurumsal Performans İyileştirme Hizmetleri”, “Global Risk Yönetimi”, “Kurumsal Finans ve Mali Danışmanlık”, “ “Gümrük ve Dış Ticaret Danışmanlığı”,  “Bilgi Teknolojileri& Dijitalleşme konularında eğitimler gerçekleştirmekteyiz. Eğitimler; genel katılıma açık ve şirkete özel olarak organize edilmektedir. Genel katılıma açık eğitimlerimiz önceden belirlenmiş ve ilan edilmiş tarihlerde İstanbul, İzmir ve Ankara’da gerçekleştirilmektedir. Eğitimlerimize konusuna göre 10 kişiden 300 kişiye kadar katılım olabilmektedir. Katılımcılar Türkiye’de faaliyet gösteren birçok yerli ve yabancı firmaların üst düzey yöneticileri ve çalışanlarından oluşmaktadır.",  
										"logo": {
										"@type": "ImageObject",
										"url": "https://www.okul.pwc.com.tr/dosyalar/images/logo-pwc-1.png",
										"height": "76", 
										"width": "250"
										},
									"address": {
									"@type": "PostalAddress",
									"streetAddress": "Vişnezade Mahallesi, Süleyman Seba Cad. BJK Plaza No:48 B Blok, 34357 Akaretler / Beşiktaş / İstanbul",
									"addressLocality": "Beşiktaş",
									"addressRegion": "İstanbul",
									"postalCode": "34357"
									},
									"email": "egitim@tr.pwc.com",
									"telePhone": "0212 376 59 80",
									"areaServed":"TR",
									"url": "https://www.okul.pwc.com.tr/",
									"founder":"", 
									"foundingDate":"1993", 
									"foundingLocation":"İstanbul" 
									}
									 </script>

	<?php } elseif ($url_rewrite == "egitimlerimiz-detay-1.php" or $url_rewrite == "egitimlerimiz-detay.php") {
		$db->where('edu_seo_url', $page_url);
		$results = $db->get('education_canonical_url');
		foreach ($results as $value) {
			$seo_baslik = $value['baslik'];
			$seo_kisa_aciklama = $value['kisa_aciklama'];
		}
		?>
		<script type="application/ld+json">
								{
								  "@context": "https://schema.org",
								  "@type": "Course",
								  "name": <?php echo "\"" . $seo_baslik . "\""; ?>,  
								  "description": <?php echo "\"" . $seo_kisa_aciklama . "\""; ?>, 
								  "provider": {
									"@type": "Organization",
									"name": "PwC Business School",
									"sameAs": "https://www.okul.pwc.com.tr/"
								  }
								}
								</script>
	<?php } ?>
</head>

<body>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TJ6SWQ9" height="0" width="0"
			style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<header class="active">
		<div class="logobar">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="logo">
							<a href="https://www.okul.pwc.com.tr/">
								<img src="<?php echo $site_url; ?>dosyalar/images/logo-pwc-2.png" alt="PwC Logo" />
							</a>
						</div>
						<div class="logosag">
							<!--<a href="dosyalar/dahili/girisform.php" class="login simple-ajax-popup-align-top">Giriş Yap/Kaydol</a>-->
							<?php if ($_SESSION['dashboardUser']) { ?>

								<a href="dashboard.php" class="login hint--left hint--rounded"
									aria-label="Hesabımı Görüntüle">
									<?php echo $_SESSION['dashboardUserName']; ?>
								</a>

							<?php } else { ?>
								<a href="/uyelik" class="login">Giriş Yap/Kaydol</a>
							<?php } ?>
							<div class="aramaac"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="mobilbar" style="display:none;">
				<div class="mobil_menuac"><i class="fas fa-bars"></i></div>
				<?php if ($_SESSION['dashboardUser']) { ?>
					<a href="/dashboard.php" class="login"><i class="fas fa-user"></i> Hesabımı Görüntüle</a>
				<?php } else { ?>
					<a href="/uyelik" class="login"><i class="fas fa-user"></i> Giriş Yap/Kaydol</a>
				<?php } ?>
				<!--<a href="login.php" class="login"><i class="fas fa-user"></i> Giriş Yap/Kaydol</a>-->
				<div class="aramaac"><i class="fas fa-search"></i></div>
			</div>
			<div class="arama_popup" style="display:none;">
				<div class="arama_kapat"></div>
				<form action="egitimlerimiz.php" method="GET">
					<input type="text" name="arama" id="popup_arama" placeholder="Eğitim Arama" />
					<button></button>
				</form>
			</div>
		</div>
		<nav class="nav">

			<div class="container">
				<ul>
					<li>
						<a style="padding-left:0px !important" id="egitimProgramlari">Eğitim Programları
							<img src="dosyalar/images/arrow-down.png" class="filter-white" />
						</a>
						<div class="altmenu" id="altmenu">
							<img src="dosyalar/images/back.png" class="back-icon" id="backIcon" />
							<div class="container">
								<div class="row">
									<ul class="main-altmenu" id="mainAltmenu">
										<li>
											<a class="main-altmenu__title" id="another_filter">Genel Katılıma Açık Eğitimler
												<img src="dosyalar/images/arrow-right.png" class="filter-white" />
											</a>
											<ul class="sub-altmenu">
												<?php $results = $db->get('categories');
												foreach ($results as $categories) {
													?>
													<li class="sub-list" id="<?php echo $categories['baslik'] ?>">
														<span>
															<?php echo $categories['baslik'] ?>
														</span>
													</li>
												<?php } ?>
											</ul>
											<ul class="child-altmenu" id="childAltmenu">
											</ul>
										</li>
										<li>
											<a class="main-altmenu__title">
												<span>Yönetici Eğitimleri</span>
												<img src="dosyalar/images/arrow-right.png" class="filter-white" />
											</a>
											<ul class="sub-altmenu col-md-3">
												<li>
													<a>
														<span>Next in Business</span>
														<img src="dosyalar/images/arrow-right.svg"
															class="filter-white-sub" />
													</a>
												</li>
											</ul>
										</li>
										<li>
											<a class="main-altmenu__title" id="elearning_filter"><span>E-Learning</span>
												<img src="dosyalar/images/arrow-right.png" class="filter-white" />
											</a>
											<ul class="sub-altmenu col-md-3">
												<?php $results = $db->get('categories');
												foreach ($results as $categories) {
													?>
													<li class="sub-list" id="<?php echo $categories['baslik'] ?>">
														<span>
															<?php echo $categories['baslik'] ?>
														</span>
													</li>
												<?php } ?>
											</ul>
											<ul class="child-altmenu" id="childAltmenu">

											</ul>
										</li>

										<li>
											<a class="main-altmenu__title">
												<span>Şirketlere / Kurumlara Özel Eğitimler</span>
												<img src="dosyalar/images/arrow-right.png" class="filter-white" />
											</a>
										</li>
										<li>
											<a class="main-altmenu__title">
												<span>Platform / Zirve</span>
												<img src="dosyalar/images/arrow-right.png" class="filter-white" />
											</a>
											<ul class="sub-altmenu col-md-3">
												<li>
													<a>
														<span>21. Çözüm Ortaklığı Platformu</span>
														<img src="dosyalar/images/arrow-right.svg"
															class="filter-white-sub" />
													</a>
												</li>
											</ul>
										</li>
									</ul>

								</div>
							</div>
						</div>
					</li>
					<li><a href="/egitim-takvimi">Eğitim Takvimi</a></li>
					<li><a href="/hakkimizda">Hakkımızda</a></li>
					<li><a href="/sss">Sıkça Sorulan Sorular</a></li>
					<li><a href="/blog">Blog</a></li>
					<li><a href="/iletisim">İletişim</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<main>

		<script>
			var type_id;
			$("#elearning_filter").click(function () {
				 type_id = $(this).attr('id');

			});
			$("#another_filter").click(function () {
				 type_id = $(this).attr('id');

			});
			$(".sub-list").click(function () {
				var category_id = $(this).attr('id');
				console.log(category_id);
				console.log(type_id);

				$.ajax({
					url: "/header_filter_first.php",
					type: "POST",
					data: { category_id: category_id , type_id:type_id },
					success: function (cevap) {
						$('.child-altmenu').html(cevap);
					}
				});
			});
		</script>