<?php include('dosyalar/dahili/header.php');
$db->where('email', $_SESSION['dashboardUser']);
$db->where('phone', $_SESSION['dashboardUserPhone']);
$control = $db->getOne('web_user');
$code = valueClear($_GET['code']);
$db->where('reset_code', $code);
$db->where('expression_time >= NOW() - INTERVAL 4 MINUTE');
$results = $db->get('web_user');
foreach ($results as $value) {
	$isActive = $value['expression_time'];
}
if (($isActive != null || $isActive != "") && ($control['phone'] == null || $control['phone'] == '')) { //kullanıcının code süresi dolmamıs ve login olmayan bir kullanıcı ise
	?>

	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">ŞİFRE SIFIRLAMA</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Şifre Sıfırlama</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php
					?>
					<div class="passwordFormList">
					</div>
					<form id="password_form" method="post" class="girisform" onsubmit="return password_change_send();">
						<div class="baslik">
							<b>Şifre Güncelleme</b>
						</div>
						<input type="hidden" name="reset_code" id="reset_code" value="<?php echo $code; ?>" />
						<div class="label-div2">
							<label for="sifre">Yeni Şifre*</label>
							<input type="password" name="sifre" id="sifre" value="" required />
						</div>
						<div class="label-div2">
							<label for="sifre2">Şifre Tekrar*</label>
							<input type="password" name="sifre2" id="sifre2" value="" required />
						</div>

						<div>
							<small>Sıfırlama işlemi için kullandığınız linkin geçerlilik süresi <strong> 4
									dakikadır.</strong></small>
						</div>
						<hr>
						<div class="bilgial buton renk2 button13"><a href="javascript:;"
								onclick="return password_change_send();"><span>Şifremi Güncelle</span></a></div>

					</form>

				</div>
			</div>
		</div>
	</section>
<?php } else if (($isActive == null || $isActive == "") && ($control['phone'] == null || $control['phone'] == '')) { //code süresi dolmus , kullanıcı login degilse.

	?>
		<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
			<div class="basliklar">
				<div class="baslik">ŞİFRE SIFIRLAMA</div>
				<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
						<meta itemprop="position" content="1" />
					</li>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="#"><span itemprop="name">Şifre Sıfırlama</span></a>
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
					<?php echo "<div class=\"alert alert-danger\"><strong>Geçersiz Link!</strong> Gönderilen doğrulama linkinin süresi dolmuştur.Şifremi unuttum alanından tekrar doğrulama linki alabilirsiniz.</div>";
					?>
					</div>
				</div>
			</div>
		</section>
<?php } else //  kullanıcı login ise 
{
	header("Location: https://www.okul.pwc.com.tr/dashboard.php");

}
include('dosyalar/dahili/footer.php');