<?php include('dosyalar/dahili/header.php');
$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/",$page_url);
$page_url = end($page_url);
$page_url = t_decode($page_url);
$db->where('seo_url', $page_url);
$results = $db->get('url_list');
foreach ($results as $value) {
	$source=$value['source'];
}
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$redirect_url_after_verify = basename($actual_link);
$redirect_url_after_verify = sprintf("https://www.okul.pwc.com.tr/katilimcilar/%s", $redirect_url_after_verify);

if($source=="education-calender"){

	$db->where('seo_url', $page_url);
	$results = $db->get('education_calender_list');
	foreach ($results as $value) {
		$edu_cal_id=$value['id'];
		$redirect_url=$value['seo_url'];
	}
}

if($edu_cal_id==""){
	
	// Eğitim yoksa ve giriş yapılmış ise dashboard yönlendiriyoruz.
	if ($_SESSION['dashboardUser']){
		header("Location: https://www.okul.pwc.com.tr/dashboard.php");
		exit;
	} else {
		$login_status = "login";
	}
} else {
	if ($_SESSION['dashboardUser']){
		header("Location: https://www.okul.pwc.com.tr/katilimcilar/".$page_url);
		exit;
	} else {
		$login_status = "login-redirect";
	}
}

// yönlenecek sayfa

$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/", $page_url);
$page_url = end($page_url);
if (strpos($page_url, '?') !== false) {

	$page_url = explode("?", $page_url);
	$page_url = $page_url[0];
}
$page_url = t_decode($page_url);
if($page_url!='uyelik'){
	$last_page_url =$page_url;
}
?>
<style>
#signFormDiv{
  display:none;
}
#withoutDiv{
  display:none;
}
</style>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">ÜYE İŞLEMLERİ</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Üye İşlemleri</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
					<form class="girisform" style="background-color: #f7f7f7;padding: 30px;border: 1px solid #ccc;border-radius: 5px;">
						<input class="magic-radio signLogin" type="radio" name="loginType"  id="login" checked />
						<label for="login" style="float: left;">Giriş Yap</label><br/><br/>
						<input class="magic-radio signLogin" type="radio"  name="loginType" id="sign"  />
						<label for="sign" style="float: left;">Üye Ol</label><br/>
						<!-- <?php if($login_status=="login-redirect") { ?>
							<br/><input class="magic-radio signLogin" type="radio"  name="loginType" id="without"  />
							<label for="without" style="float: left;">Üye Olmadan Devam Et</label><br/>
						<?php } ?> -->
					</form>
					
					<div id="loginFormDiv">
						<?php include('dosyalar/dahili/girisform.php');?>
					</div>
					
					<div id="signFormDiv">
					<form id="sign_form_step1" method="post" class="girisform" onsubmit="return sign_send_step1();">
							<div class="signFormList" style="text-align:left">
							</div>
							<div class="baslik">
								<b>Üye Ol</b>
							</div>
							<!-- <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo $redirect_url; ?>" /> -->
							<input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo $last_page_url; ?>" />

							<div class="label-div2">
								<label for="adsoyad">Ad Soyad*</label>
								<input type="text" name="adsoyad" value="" id="adsoyad" required />
							</div>
						
							<div class="label-div2">
								<label for="telefon">Telefon*</label>
								<input type="tel" name="telefon" value="" id="telefon" required />
							</div>
							<input type="hidden" name="redirect_url_after_verify" value="<?php echo $redirect_url_after_verify; ?>" />
							
							
							
							<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return sign_send_step1();"><span>Kod Gönder</span></a></div>							
						</form>
						<!-- <form id="sign_form" method="post" class="girisform" onsubmit="return sign_send();">
							<div class="signFormList" style="text-align:left">
							</div>
							<div class="baslik">
								<b>Üye Ol</b>
							</div>
							<input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo $redirect_url; ?>" />
							<div class="label-div2">
								<label for="adsoyad">Ad Soyad*</label>
								<input type="text" name="adsoyad" value="" id="adsoyad" required />
							</div>
							<div class="label-div2">
								<label for="Unvan">Unvan</label>
								<input type="text" name="unvan" id="unvan" value="" />
							</div>
							<div class="label-div2">
								<label for="Firma">Firma Adı</label>
								<input type="text" name="firma" id="firma" value="" />
							</div>
							<div class="label-div2">
								<label for="telefon">Telefon*</label>
								<input type="tel" name="telefon" value="" id="telefon" required />
							</div>
							<input type="hidden" name="redirect_url_after_verify" value="<?php echo $redirect_url_after_verify; ?>" />
							<div class="label-div2">
								<label for="email">E-Posta*</label>
								<input type="email" name="email" value="" id="email" required />
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
									<input class="magic-checkbox" type="checkbox" id="sozlesme" name="sozlesme" required/>
									<label for="sozlesme" style="font-size:13px; float:left"><a href="uyelik-sozlesmesi" target="_blank" style="text-decoration:underline !important">Üyelik Sözleşmesi'ni</a> okudum, onaylıyorum.</label>
								</span>
								<span class="checkbox-div">
									<input class="magic-checkbox" type="checkbox" id="aydinlatma" name="aydinlatma" required/>
									<label for="aydinlatma" style="font-size:13px; float:left"><a href="aydinlatma-metni" target="_blank" style="text-decoration:underline !important">Aydınlatma Metni'ni</a> okudum,anladım ve <a href="acik-riza-metni" target="_blank" style="text-decoration:underline !important">Açık Rıza Metni'ni</a> onaylıyorum.</label>
								</span>
							</div>
							<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return sign_send();"><span>Üyeliğimi Oluştur</span></a></div>
							<p style='font-size:11px; float:left; text-align:left'>Kişisel verileriniz, <a href="aydinlatma-metni" target="_blank" style="text-decoration:underline !important">Aydınlatma Metni</a> kapsamında işlenmektedir. Üyeliğimi oluştur butonuna basarak <a href="uyelik-sozlesmesi" target="_blank" style="text-decoration:underline !important">Üyelik Sözleşmesi</a>’ni, <a href="acik-riza-metni" target="_blank" style="text-decoration:underline !important">Açık Rıza Metni</a>’ni, <a href="https://www.pwc.com.tr/tr/hakkimizda/kisisel-verilerin-korunmasi.html" target="_blank" style="text-decoration:underline !important">Gizlilik ve Çerez Politikası</a>’nı okuduğunuzu ve kabul ettiğinizi onaylıyorsunuz.  </p>
							
						</form> -->
					</div>					
					<!-- <div id="withoutDiv">
						<div class="withoutFormList" style="text-align:left">
						</div>
						
						<form id="without_form" method="post" class="girisform" onsubmit="return without_send();">
							<div class="baslik">
								<b>Üye Olmadan Devam Et	</b>
							</div>
							<input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo $redirect_url; ?>" />
							<div class="label-div2">
								<label for="email">E-Posta*</label>
								<input type="email" name="without_email" value="" id="without_email" required />
							</div>
							<div class="label-div2 temizle">
								
								<span class="checkbox-div">
									<input class="magic-checkbox" type="checkbox" id="aydinlatma_without" name="aydinlatma_without" required/>
									<label for="aydinlatma_without" style="font-size:13px; float:left"><a href="aydinlatma-metni" target="_blank" style="text-decoration:underline !important">Aydınlatma Metni'ni</a> okudum,anladım ve <a href="acik-riza-metni" target="_blank" style="text-decoration:underline !important">Açık Rıza Metni'ni</a> onaylıyorum.</label>
								</span>
							</div>
							<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return without_send();"><span>Devam Et</span></a></div>
						</form>
					</div> -->
				</div>
			</div>
		</div>
	</section>
<?php 
include('dosyalar/dahili/footer.php');
?>
<script>
$(document).ready(function () {
 $(".signLogin").click(function () {
            if ($(this).attr('id') == "sign") {
                $('#signFormDiv').show();
                $('#loginFormDiv').hide();
                $('#withoutDiv').hide();
            } else if ($(this).attr('id') == "login") {
                $('#signFormDiv').hide();
                $('#loginFormDiv').show();
                $('#withoutDiv').hide();
            } else {
                $('#signFormDiv').hide();
                $('#loginFormDiv').hide();
                $('#withoutDiv').show();
            }
        });

});
</script>