<?php include('dosyalar/dahili/header.php');
$code = valueClear($_GET['code']);
$db->where('activation_code', $code);
$total = $db->getValue ('web_user', "count(id)");

if($total>0) {
?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">HESAP DOĞRULAMA</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Hesap Doğrulama</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
	<form action="#" class="sepetform">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="sepet-div">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<center>
									<?php
									$db->where('activation_code', $code);
									$results = $db->get('web_user');
									foreach ($results as $value) {
										$fullname=$value['fullname'];
										$email=$value['email'];
										$redirect_after_verify = empty($value["redirect_after_verify"]) ? "https://www.okul.pwc.com.tr/" : base64_decode($value["redirect_after_verify"]);
									}
									
									$data = Array ('status' => 1, 'activation_code' => '');
									$db->where ('activation_code', $code);
									$id = $db->update ('web_user', $data);
									if ($id) {
										
										$getdata = http_build_query(
											array('adsoyad' => $fullname)
										);
										
										$opts = array('http' =>
										 array(
											'method'  => 'POST',
											'content' => $getdata
										)
										);

										$context  = stream_context_create($opts);

										$body = file_get_contents('http://www.socialthinks.com/website/pwc/dosyalar/dahili/template/tamamlandi.php?', false, $context);
										
										require_once("dosyalar/dahili/libs/class.phpmailer.php");
										require("dosyalar/dahili/libs/class.smtp.php");
										require("dosyalar/dahili/libs/class.pop3.php");
										
										// Mail Gönderme 
										$mail = new PHPMailer;
							
										$mail->IsSMTP();
										$mail->Host = "10.9.18.5";

										// used only when SMTP requires authentication  
										//$mail->SMTPAuth = true;
										$mail->Username = 'egitim@pwc.com.tr';
										$mail->Password = '';
										$mail->SMTPAuth = false;
										$mail->SMTPAutoTLS = false; 
										$mail->Port = 25; 
									
										$mail->CharSet = 'utf-8'; 
										$mail->setFrom('egitim@pwc.com.tr', 'Business School');
										
										$mail->AddAddress($email);
										// Name is optional
										$mail->addReplyTo('egitim@pwc.com.tr', 'Business School');		   
										$mail->setLanguage('tr', '/language');
										
										// Set email format to HTML
										$mail->Subject = 'Business School - Üyeliğiniz Tamamlandı';
										$mail->msgHTML($body);
										if($mail->send()){
											
											
										
									?>
									<i class="far fa-check-circle"></i>
									<h3><b>Sayın "<?php echo $fullname;?>"</b></h3>
									<h3><strong>Hesabınız başarıyla doğrulanmıştır.</strong></h3>
									<h3><br/><strong>Yönlendiriliyorsunuz...</strong></h3>
									    <script>
										     setTimeout(function(){
            window.location.href = '<?php echo $redirect_after_verify; ?>';
         }, 5000);
										
    </script>
										<?php } } else header("Location: https://www.okul.pwc.com.tr/dashboard.php"); ?>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	</section>
<?php 
} else
		header("Location: https://www.okul.pwc.com.tr/dashboard.php");
include('dosyalar/dahili/footer.php');
?>