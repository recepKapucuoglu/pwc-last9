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
					<div class="signFormList">
					</div>
					<form id="sign_form" method="post" class="girisform" onsubmit="return sign_send();">
						<div class="baslik">
							<b>Kaydol</b>
							<span>Hesabınız mevcut ise <a href="login.php">Giriş Yap</a></span>
						</div>
						<div class="label-div2">
							<label for="adsoyad">Ad Soyad*</label>
							<input type="text" name="adsoyad" value="" id="adsoyad" required />
						</div>
						<div class="label-div2">
							<label for="adsoyad">Unvan*</label>
							<input type="text" name="unvan" id="unvan" value="" required/>
						</div>
						<div class="label-div2">
							<label for="email">E-Posta*</label>
							<input type="email" name="email" value="" id="email" required />
						</div>
						<div class="label-div2">
							<label for="telefon">Telefon*</label>
							<input type="tel" name="telefon" value="" id="telefon" required />
						</div>
						<div class="label-div2">
							<label for="adsoyad">Firma/Okul*</label>
							<input type="text" name="firma" id="firma" value=""  required/>
						</div>
						<div class="label-div2">
							<label for="sifre">Şifre*</label>
							<input type="password" name="sifre" id="sifre" value="" required />
						</div>
						<div class="label-div2">
							<label for="sifre2">Şifre Tekrar*</label>
							<input type="password" name="sifre2" id="sifre2" value="" required />
						</div>
						
						<div class="label-div2 temizle">
							<span class="checkbox-div">
								<input class="magic-checkbox" type="checkbox" id="notfication" name="notfication" value="1"/>
								<label for="notfication">Yeni açılan eğitimler için haberdar olmak istiyorum.</label>
							</span>
						</div>
						<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return sign_send();"><span>Kaydol</span></a></div>
						
					</form>
				</div>
			</div>
		</div>
	</section>
<?php include('dosyalar/dahili/footer.php');?>