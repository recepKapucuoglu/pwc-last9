<?php include('dosyalar/dahili/header.php');?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">KAYDOL</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Kaydol</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<form action="#" class="girisform">
						<div class="baslik">
							<b>Kaydol</b>
							<span>Hesabınız mevcut ise <a href="login.php">Giriş Yap</a></span>
						</div>
						<div class="label-div2">
							<label for="adsoyad">Ad Soyad*</label>
							<input type="text" name="adsoyad" value="" />
						</div>
						<div class="label-div2">
							<label for="email">E-Posta*</label>
							<input type="email" name="email" value="" />
						</div>
						<div class="label-div2">
							<label for="telefon">Telefon*</label>
							<input type="tel" name="telefon" value="" />
						</div>
						<div class="label-div2">
							<label for="adsoyad">Firma Adı</label>
							<input type="text" name="firma" value="" />
						</div>
						<div class="label-div2">
							<label for="sifre">Şifre*</label>
							<input type="password" name="sifre" value="" />
						</div>
						<div class="label-div2">
							<label for="sifre2">Şifre Tekrar*</label>
							<input type="password" name="sifre2" value="" />
						</div>
						
						<div class="label-div2 temizle">
							<span class="checkbox-div">
								<input class="magic-checkbox" type="checkbox" id="rememberme" name="rememberme"/>
								<label for="rememberme">Beni Hatırla</label>
							</span>
						</div>
						
						<input type="submit" value="Kaydol"/>
					</form>
				</div>
			</div>
		</div>
	</section>
<?php include('dosyalar/dahili/footer.php');?>