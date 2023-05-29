<?php 
include('dosyalar/dahili/header.php');
$redirect_url = "https://www.okul.pwc.com.tr/katilimcilar/" . valueClear($_GET['redirect-url']);
$mail = $_SESSION["sms_mail"];
if($_SESSION["sms_token"]) {
?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">MAIL DOĞRULAMA</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Mail Doğrulama</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="sepet-div">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<center>
								<div class="bildirim"></div>
										<form method="post" class="girisform" id="tek_dogrulama" onsubmit="return tek_kullanimlik_dogrulama();">
											<div class="baslik">
												<b>Mail Doğrulama</b>
											</div>
											<p>Lütfen, <b><?php echo $mail; ?></b> adresine yollanan şifreyi giriniz.</p>
											<input type="hidden" name="redirect_url" id="redirect_url" value="turquality-ve-ihracat-tesvikleri-webcast-18022021-1400">
											<div class="label-div2">
												<label for="pass">Şifre*</label>
												<input type="text" name="pass" value="" id="pass" required="">
											</div>
											<input type="hidden" name="redirect" value="<?php echo base64_encode($redirect_url); ?>" />
											<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return tek_kullanimlik_dogrulama();"><span>Doğrula</span></a></div>
											<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return without_resend();"><span>Tekrar Şifre İste</span></a></div>
										</form>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php 

} else
		header("Location: https://www.okul.pwc.com.tr/");
include('dosyalar/dahili/footer.php');
?>

