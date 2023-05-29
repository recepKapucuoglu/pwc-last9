<?php include('dosyalar/dahili/header.php');?>
 <?php
	
 ?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">ŞİFREMİ UNUTTUM</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Şifremi Unuttum</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="passwordFormList">
					</div>
					<form id="password_form" method="post" class="girisform" onsubmit="return password_reset_send();">
						<div class="baslik">
							<b>Şifremi Unuttum</b>
							<span>Hesabınız mevcut ise <a href="/uyelik">Giriş Yap</a></span>
						</div>
						
						<div class="label-div2">
							<label for="email">Mail/Telefon*</label>
							<input type="email" name="email" value="" id="email" required />
						</div>
						
						 <!-- <div class="label-div2">
								<label for="telefon">Telefon/Mail*</label>
								<input type="tel" name="telefon" value="" id="telefon" required />
							</div> -->
						<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return password_reset_send();"><span>Şifremi Sıfırla</span></a></div>
						
					</form>
				</div>
			</div>
		</div>
	</section>
<?php include('dosyalar/dahili/footer.php');?>