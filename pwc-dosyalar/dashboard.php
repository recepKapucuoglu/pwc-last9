<?php include('dosyalar/dahili/header-dashboard.php');?>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php include('dosyalar/dahili/dashboard-menu.php');?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<section class="dashboard-detay">
						<div class="sectionbaslik">Dashboard</div>
						<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<div class="dbkutu hesapozeti">
									<a href="dashboard-egitimlerim.php">
										<span>Eğitimlerim <b>45</b></span>
										<i class="icon egitim-icon-2"></i>
									</a>
								</div>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<div class="dbkutu hesapozeti">
									<a href="dashboard-videolarim.php">
										<span>Videolarım <b>12</b></span>
										<i class="icon video-icon-2"></i>
									</a>
								</div>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<div class="dbkutu hesapozeti">
									<a href="dashboard-favorilerim.php">
										<span>Favorilerim <b>12</b></span>
										<i class="icon favori-icon-2"></i>
									</a>
								</div>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<div class="dbkutu hesapozeti">
									<a href="#">
										<span>Yaklaşan Eğitimler <b>19</b></span>
										<i class="icon yaklasan-egitim-icon"></i>
									</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="dbkutu">
									<div class="baslik">Hesap Bilgileri <a href="dashboard-hesabim.php"><i class="icon kalem-icon"></i></a></div>
									<div class="dbkutuicerik scrollbar-rail">
										<div class="profil">
											<img src="dosyalar/images/profil.jpg" alt="" />
											<p><b style="font-size:18px;">Okan Lalik |</b> Back End Developer</p>
											<br />
											<p>Esenevler Mh. Ebabil Sk. No.45 D.25 Ümraniye Ümraniye, İstanbul,  Türkiye</p>
											<p>okanlalik@okanlalik.com</p>
											<p>+90(555) 555 55 55</p>
											<p><a href="dashboard-hesabim.php">Şifremi Değiştir</a></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="dbkutu">
									<div class="baslik">Favorilerim</div>
									<div class="dbkutuicerik scrollbar-rail">
										<div class="listeler kucukresim">
											<?php for($i=0;$i<10;$i++){ ?>
											<?php include('dosyalar/dahili/egitimkutu-tip2.php');?>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="dbkutu">
									<div class="baslik">Eğitimlerim</div>
									<div class="dbkutuicerik scrollbar-rail">
										<div class="listeler">
											<?php for($i=0;$i<10;$i++){ ?>
											<?php include('dosyalar/dahili/egitimkutu-tip2.php');?>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<section id="onecikanegitimler">
							<div class="dbkutu">
								<div class="baslik">Önerilen Eğitimler</div>
								<div class="dbkutuicerik">
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
											<div class="egitimkutu-tip1 aktif" style="background:url(dosyalar/images/egitim-1.jpg);">
												<a href="#">
													<time>09.05.2019</time>
													<div class="basliklar">
														<span>Gümrük</span>
														<h4>Eğitimin Adı 1</h4>
													</div>
												</a>
											</div>
										</div>
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
											<div class="egitimkutu-tip1" style="background:url(dosyalar/images/egitim-2.jpg);">
												<a href="#">
													<time>17.05.2019</time>
													<div class="basliklar">
														<span>Arşiv</span>
														<h4>Eğitimin Adı 2</h4>
													</div>
												</a>
											</div>
										</div>
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
											<div class="egitimkutu-tip1" style="background:url(dosyalar/images/egitim-3.jpg);">
												<a href="#">
													<time>25.05.2019</time>
													<div class="basliklar">
														<span>Danışmanlık</span>
														<h4>Eğitimin Adı 3</h4>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</section>
				</div>
			</div>
		</div>
	</section>
<?php include('dosyalar/dahili/footer.php');?>