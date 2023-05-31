</main>
<footer>
	<section class="bizitakipet">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<b>Bizi takip edin</b>
					<ul class="takipet">
						<li><a href="https://www.facebook.com/PwCTurkiye" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="https://twitter.com/PwC_Turkiye" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="https://www.instagram.com/pwc_turkiye" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li><a href="https://www.linkedin.com/in/pwc-t%C3%BCrkiye-business-school-a93208124" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
						<li><a href="https://www.youtube.com/user/PwCTurkey" target="_blank"><i class="fab fa-youtube"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section class="altmenuler">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<div class="bilesen">
						<div class="baslik">İletişim</div>
						<div class="bilesenic">
							<ul>
								<li>Premier kampüs Ofis Adres: Gürsel, İmrahor Cd. No: 29, B Blok 6.kat 34400 Kâğıthane/İstanbul</li>
								<li><a href="tel:+90 (212) 376 59 80">0 (212) 376 59 80</a></li>
								<li><a href="mailto:egitim@tr.pwc.com">egitim@tr.pwc.com</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<div class="bilesen">
						<div class="baslik">Eğitimlerimiz</div>
						<div class="bilesenic">
							<ul class="bol2">
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
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<div class="bilesen">
						<div class="baslik">Kolay Erişim</div>
						<div class="bilesenic">
							<ul class="bol2" style="-webkit-column-count: 2;">	
								<li><a href="">Eğitim Takvimi</a></li>
								<li><a href="">Hakkımızda</a></li>
								<li><a href="">Sıkça Sorulan Sorular</a></li>
								<li><a href="">Blog</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="altlogobar">
		<div class="container">
			<div class="row">
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul>
						<li><a href="https://www.pwc.com.tr/tr/hakkimizda/kisisel-verilerin-korunmasi.html" target="_blank">Kişisel Verilerin Korunması ve Veri Gizlilik Bildirimi</a></li>
						<li><a href="yasal-uyari">Yasal Uyarı</a></li>
						<li><a href="site-sahibi">Site Sahibi</a></li>
						<li><a href="iletisim">Bize Ulaşın</a></li>
					</ul>
				</div>
				<!--
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<ul class="sosyalmedya">
						<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#"><i class="fab fa-instagram"></i></a></li>
						<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
					</ul>
				</div>
				-->
			</div>
		</div>
	</section>
	<section class="copyright">
		<div class="container">
			<div class="row">
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul>
						<li>
							<p>© <?php echo date("Y"); ?> PwC. All rights reserved. PwC refers to the PwC network and/or one or more of its member firms, each of which is a separate legal entity. Please see <a href="https://www.pwc.com/gx/en/about/corporate-governance/network-structure.html" style="color:#fff" target="_blank">www.pwc.com/structure</a> for further details.</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
</footer>

<div style="display:none;">
<nav id="mobil-menu">
	<ul>
		<li>
			<a href="egitimlerimiz">Eğitim Programları</a>
			<ul>
				<li>
					<a>Genel Katılıma Açık Eğitimler</a>
					<ul>
						<li><a href="/danismanlik-egitimleri">Danışmanlık Eğitimleri</a></li>
						<li><a href="/vergi-egitimleri">Vergi Eğitimleri</a><</li>
						<li><a href="/hukuk-egitimleri">Hukuk Eğitimleri</a><</li>
						<li><a href="/insan-kaynaklari-gelisimi-egitimleri">İnsan Kaynakları Gelişimi Eğitimleri</a><</li>
						<li><a href="/arsiv-egitimleri">Arşiv</a><</li>
						<li><a href="/ticari-anlasmazlik-cozumleri-ve-suistimal-incelemeleri-egitimleri">Ticari Anlaşmazlık Çözümleri ve Suistimal İncelemeleri Eğitimleri</a><</li>
						<li><a href="/gumruk-dis-ticaret-egitimleri">Gümrük / Dış Ticaret Eğitimleri</a></li>
						<li><a href="/platform-egitimleri">Platform</a><</li>
						<li><a href="/online-egitimler">Online Eğitim</a><</li>
						<li><a href="/vergi-muhasebe-egitimleri">Vergi / Muhasebe Eğitimleri</a><</li>
						<li><a href="/digitallesme-egitimleri">Dijitalleşme Eğitimleri</a><</li>
						<li><a href="/muhasebe-finans-egitimleri">Muhasebe/Finans Eğitimleri</a><</li>
						<li><a href="/sosyal-guvenlik-egitimleri">Sosyal Güvenlik Eğitimleri</a><</li>
						<li><a href="/bilgi-teknolojileri-egitimleri">Bilgi Teknolojileri Eğitimleri</a><</li>
						<li><a href="/vergi-teknolojileri-egitimleri">Vergi Teknolojileri Eğitimleri</a><</li>
						<li><a href="/risk-yonetimi-egitimleri">Risk Yönetimi Eğitimleri</a><</li>
					</ul>
				</li>
				<li>
					<a>Yönetici Eğitimleri</a>
					<ul>
						<li><a href="/next-in-business">Next in Business</a></li>
					</ul>
				</li>
				<li>
					<a>E-Learning</a>
					<ul>
						<li><a href="/e-learning">E-Learning</a></li>
						<li><a href="/hukuk-egitimleri">Hukuk Eğitimleri</a></li>
						<li><a href="/online-egitimler">Online Eğitim</a></li>
						<li><a href="/sosyal-guvenlik-egitimleri">Sosyal Güvenlik Eğitimleri</a></li>
						<li><a href="/muhasebe-finans-egitimleri">Muhasebe/Finans Eğitimleri</a></li>
						<li><a href="/platform">Platform</a></li>
					</ul>
				</li>
				<li>
					<a href="/bilgi-al.php">Şirketlere / Kurumlara Özel Eğitimler</a>
				</li>
				<li>
					<a>Platform / Zirve</a>
					<ul>
						<li><a href="/platform">21. Çözüm Ortaklığı Platformu</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href="/egitim-takvimi" target="_blank">Eğitim Takvimi</a></li>
		<li><a href="/hakkimizda" target="_blank">Hakkımızda</a></li>
		<li><a href="/sss">Sıkça Sorulan Sorular</a></li>
		<li><a href="/iletisim">İletişim</a></li>
	</ul>
</nav>
<nav id="dashboard-mobil-menu">
	<ul>
		<li><a href="dashboard.php">Dashboard</a></li>
		<li><a href="dashboard-profilim.php">Profil Bilgileri</a></li>
		<li><a href="dashboard-hesabim.php">Hesap Ayarları</a></li>
		<li><a href="dashboard-favorilerim.php">Favorilerim</a></li>
		<li><a href="dashboard-egitimlerim.php">Eğitimlerim</a></li>
		<li><a href="dashboard-videolarim.php">Videolarım</a></li>
		<li><a href="#cikis-yap">Çıkış Yap</a></li>
	</ul>
</nav>
</div>

</body>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="<?php echo $site_url; ?>dosyalar/moduller/owl.carousel/owl.carousel.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/moduller/animate.css/animate.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/moduller/hc-offcanvas-nav-master/dist/hc-offcanvas-nav.css">
<script src="<?php echo $site_url; ?>dosyalar/moduller/hc-offcanvas-nav-master/dist/hc-offcanvas-nav.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/moduller/scrollbar/jquery.scrollbar.css">
<script src="<?php echo $site_url; ?>dosyalar/moduller/scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?php echo $site_url; ?>dosyalar/moduller/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="<?php echo $site_url; ?>dosyalar/moduller/Magnific-Popup-master/scripts.js"></script>
<link rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/moduller/Magnific-Popup-master/dist/magnific-popup.css">
<script type="text/javascript" src="<?php echo $site_url; ?>dosyalar/moduller/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
<link rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/moduller/magic-check-master/css/magic-check.min.css">
<link rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/moduller/select2-develop/dist/css/select2.min.css">
<script src="<?php echo $site_url; ?>dosyalar/moduller/select2-develop/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo $site_url; ?>dosyalar/moduller/hint.css-2.5.0/hint.min.css" media="all">
<script src="<?php echo $site_url; ?>dosyalar/moduller/waypoints/waypoints.js"></script>
<script src="<?php echo $site_url; ?>dosyalar/moduller/jquery.countdown-2.2.0/jquery.countdown.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('.countdown').each(function(i){
			var thisEl = $(this);
			var sontarih = $(this).attr('data-enddate');
			$(this).countdown(sontarih, function(event) {
				$(this).html(event.strftime('<div><b>Gün</b><span>%D</span></div><div><b>Saat</b><span>%H</span></div><div><b>Dakika</b><span>%M</span></div><div><b>Saniye</b><span>%S</span></div>'));
			});
		});
	});
</script>
<script src="<?php echo $site_url; ?>dosyalar/js/jquery.growl.js"></script>
<script src="<?php echo $site_url; ?>dosyalar/js/functions.js?v=22102021"></script>
<script src="<?php echo $site_url; ?>dosyalar/js/app.js?v=124124124124123"></script>

</body>
</html>