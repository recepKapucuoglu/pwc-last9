<?php include('dosyalar/dahili/header-dashboard.php');?>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php include('dosyalar/dahili/dashboard-menu.php');?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<section class="dashboard-detay">
						<div class="sectionbaslik">Hesap Bilgilerim</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="dbkutu">
									<div class="dbkutuicerik">
										<form action="#" class="form">
											<div class="profilresmi">
												<img src="dosyalar/images/profil.jpg" alt="" />
											</div>
											<div class="row">
												<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
													<div class="label-div">
														<input type="text" name="adsoyad" onkeyup="this.setAttribute('value', this.value);" value="Okan Lalik"/>
														<label for="adsoyad">Ad Soyad</label>
													</div>
													<div class="label-div">
														<input type="text" name="meslek" onkeyup="this.setAttribute('value', this.value);" value="Back End Developer"/>
														<label for="meslek">Meslek</label>
													</div>
													<div class="label-div">
														<input type="text" name="adres" onkeyup="this.setAttribute('value', this.value);" value="Esenevler Mh. Ebabil Sk. No.45 D.25 Ümraniye Ümraniye, İstanbul, Türkiye"/>
														<label for="adres">Adres</label>
													</div>
													<div class="label-div">
														<input type="email" name="email" onkeyup="this.setAttribute('value', this.value);" value="okanlalik@okanlalik.com"/>
														<label for="email">E-Posta</label>
													</div>
													<div class="label-div">
														<input type="tel" name="telefon" onkeyup="this.setAttribute('value', this.value);" value="0(555) 555 55 55"/>
														<label for="telefon">Telefon</label>
													</div>
													<div class="label-div">
														<input type="password" name="sifre" onkeyup="this.setAttribute('value', this.value);" value="" />
														<label for="sifre">Mevcut Şifre</label>
													</div>
													<div class="label-div">
														<input type="password" name="yenisifre" onkeyup="this.setAttribute('value', this.value);" value="" />
														<label for="yenisifre">Yeni Şifre</label>
													</div>
													<div class="label-div">
														<input type="password" name="yenisifre2" onkeyup="this.setAttribute('value', this.value);" value="" />
														<label for="yenisifre2">Yeni Şifre Tekrar</label>
													</div>
													<div class="label-div">
														<span>
															<input class="magic-checkbox" type="checkbox" id="check1" name="check1"/>
															<label for="check1">Yeni açılan eğitimler için haberdar olmak istiyorum.</label>
														</span>
													</div>
												</div>
											</div>
											<input type="submit" class="buton renk2" value="Kaydet"/>
										</form>
									</div>
								</div>
							</div>
						</div>
						
					</section>
				</div>
			</div>
		</div>
	</section>
<?php include('dosyalar/dahili/footer.php');?>