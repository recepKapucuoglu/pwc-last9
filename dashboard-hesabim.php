<?php include('dosyalar/dahili/header.php');
if ($_SESSION['dashboardUser']){?>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php include('dosyalar/dahili/dashboard-menu.php');?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<section class="dashboard-detay">
						<div class="sectionbaslik">Hesap Bilgilerim</div>
									<?php
						$db->where('email', $_SESSION['dashboardUser']);
						$results = $db->get('web_user');
						// echo '<p>Bilgilerinizi güncellemek için <a href="mailto:egitim@pwc.com.tr" target="_blank">egitim@pwc.com.tr</a> adresine mail atabilirsiniz.</p>';
						foreach ($results as $value) {
							$dashboardUserMailStatus=$value['mail_status'];
						}
						if($dashboardUserMailStatus<>1) echo "<div id='bildirim' class='bildirim'><div class=\"alert alert-danger\">Hesabınızı aktif etmek için e-mail adresinizi doğrulamanız gerekmektedir. <b>Doğrulama kodu  göndermek için <a href=\"javascript:;\" onclick=\"return dogrulama_send();\">tıklayınız.</a></b></div></div>";
					?>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="dbkutu">
									<div class="dbkutuicerik">
										<?php
											$db->where('email', $_SESSION['dashboardUser']);
											$results = $db->get('web_user');
											foreach ($results as $value) {
												$id= $value['id'];
												$fullName = $value['fullname'];
												$title = $value['title'];
												$company = $value['company'];
												$address = $value['address'];
												$email = $value['email'];
												$phone = $value['phone'];
												$notification = $value['notification'];
												$dashboardUserStatus = $value['status'];
												$dashboardUserMailStatus=$value['mail_status'];
											}
											$is_phone_verified = ($dashboardUserStatus<>1) ? "<span style='color:red'>(Doğrulanmamış)</span>" : "<span style='color:green'>(Doğrulanmış)</span>";
											$is_mail_verified = ($dashboardUserMailStatus<>1) ? "<span style='color:red'>(Doğrulanmamış)</span>" : "<span style='color:green'>(Doğrulanmış)</span>";

											?>
											<div class="profilFormList">
										</div>
										<form id="profil_form" method="post" class="form" onsubmit="return profil_send();">
											<!--<div class="profilresmi">
												<img src="dosyalar/images/default-user.png" alt="" />
											</div>-->
											<input  class="effect-19" readonly type="hidden" name="id" id="id" onkeyup="this.setAttribute('value', this.value);" value="<?php echo $id; ?>"/>

											<div class="row">
												<div class="col-sm-12 col-md-6 input-effect">
													<div style="display:flex; flex-direction:column">
														<label for="adsoyad">Ad Soyad</label>
														<div style="position:relative">
															<input class="effect-19" readonly type="text" name="adsoyad" id="adsoyad" onkeyup="this.setAttribute('value', this.value);" value="<?php echo $fullName; ?>"/>
															<span class="focus-border">
															<i></i>
															</span>
														</div>	
													</div>
												</div>
												<div class="col-sm-12 col-md-6 input-effect">
													<div style="display:flex; flex-direction:column">
														<label for="meslek">Unvan</label>
														<div style="position:relative">
															<input class="effect-19" type="text" name="unvan" id="unvan" onkeyup="this.setAttribute('value', this.value);" value="<?php echo $title; ?>"/>
															<span class="focus-border">
															<i></i>
															</span>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-md-6 input-effect">
													<div style="display:flex; flex-direction:column">
														<label for="meslek">Firma</label>
														<div style="position:relative">
															<input class="effect-19" type="text" name="firma" id="firma" onkeyup="this.setAttribute('value', this.value);" value="<?php echo $company; ?>"/>
															<span class="focus-border">
															<i></i>
															</span>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-md-6 input-effect">
													<div style="display:flex; flex-direction:column">
														<label for="adres">Adres</label>
														<div style="position:relative">
															<input class="effect-19" type="text" name="adres" id="adres"  onkeyup="this.setAttribute('value', this.value);" value="<?php echo $addres; ?>"/>
															<span class="focus-border">
															<i></i>
															</span>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-md-6 input-effect">
													<div style="display:flex; flex-direction:column">
														<label for="email">E-Posta<?php echo $is_mail_verified; ?> </label>
														<div style="position:relative">
															<input class="effect-19" type="email" name="email" id="email" onkeyup="this.setAttribute('value', this.value);" value="<?php echo $email; ?>"/>
															<span class="focus-border">
															<i></i>
															</span>	
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-md-6 input-effect">
													<div style="display:flex; flex-direction:column">
														<label for="telefon">Telefon <?php echo $is_phone_verified; ?></label>
														<div style="position:relative">
															<input class="effect-19" type="tel" name="telefon" id="telefon" value="<?php echo $phone; ?>"/>
															<span class="focus-border">
															<i></i>
															</span>
														</div>
													</div>
												</div>
												<div class="col-sm-12 input-effect">
													<div style="display:flex; flex-direction:column">
														<label for="mevcutsifre">Mevcut Şifre</label>
														<div style="position:relative">
															<input class="effect-19" type="password" name="mevcutsifre" id="mevcutsifre" onkeyup="this.setAttribute('value', this.value);" value="" />
															<span class="focus-border">
															<i></i>
															</span>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-md-6 input-effect">
													<div style="display:flex; flex-direction:column">
														<label for="sifre">Yeni Şifre</label>
														<div style="position:relative">
															<input class="effect-19" type="password" name="sifre" id="sifre" onkeyup="this.setAttribute('value', this.value);" value="" />
															<span class="focus-border">
															<i></i>
															</span>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-md-6 input-effect">
													<div style="display:flex; flex-direction:column">
														<label for="sifre2">Yeni Şifre Tekrar</label>
														<div style="position:relative">
															<input class="effect-19" type="password" name="sifre2" id="sifre2" onkeyup="this.setAttribute('value', this.value);" value="" />
															<span class="focus-border">
															<i></i>
															</span>
														</div>
													</div>
												</div>
												<div class="col-sm-12 input-effect">
													<span>
														<input class="magic-checkbox" type="checkbox" id="check1" name="notification" value="1" <?php if($notification==1) echo "checked"; ?>/>
														<!-- <label for="check1">Yeni açılan eğitimler için haberdar olmak istiyorum.</label> -->
													</span>
												</div>
											</div>
											<div class="bilgial buton renk2 button13"><a href="javascript:;" onclick="return profil_send();"><span style="color:#2d2d2d">Kaydet</span></a></div>
										</form>
										
									</div>
									<br/>
										<div style="padding-bottom: 35px;"><a style="float:right; color:red;" onclick="return confirm('Hesabınızı silmek istediğinize emin misiniz?')" class="mb-1 mt-1 mr-1 btn" href="dashboard-hesap-sil.php">
											Üyeliğimi İptal Et ve Hesabımı Sil
										</a>
										</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</section>
<?php } else {

echo "<script language=\"JavaScript\">location.href=\"/login.php\";</script>";

}	include('dosyalar/dahili/footer.php');?>
<script>$('body').addClass('dashboard');</script>