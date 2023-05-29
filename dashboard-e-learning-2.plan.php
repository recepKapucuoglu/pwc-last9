<?php include('dosyalar/dahili/header.php');
if ($_SESSION['dashboardUser']){?>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php include('dosyalar/dahili/dashboard-menu.php');?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<section class="dashboard-detay favorilerim-sayfasi">
						<div class="sectionbaslik">E-Learning</div>
						<div class="e-learning-box">
							<div>
								<p>1</p>
								<p>Deneme</p>
							</div>
							<div>
								<p>12</p>
								<p>Deneme</p>
							</div>
							<div>
								<p>1123</p>
								<p>Deneme</p>
							</div>
							<div>
								<p>0</p>
								<p>Deneme</p>
							</div>
						</div>
						<?php
							$db->where('email', $_SESSION['dashboardUser']);
							$results = $db->get('web_user');
							foreach ($results as $value) {
								$dashboardUserMailStatus=$value['mail_status'];
							}
							// if($dashboardUserMailStatus<>1) { 
							// 	echo "<div class=\"alert alert-danger\">Hesabınız ile ilgili detaylara ulaşabilmek için e-mail adresinizi doğrulamanız gerekmektedir.</div>";
							// } 
							// else 
							{
						?>
						<!--<div class="alert alert-danger">Favorilere eklenen eğitim bulunmamaktadır.</div>-->
						<div class="dbkutuicerik">
                            <div class="row">
                                <div class="col-md-4 e-learning-card_space">
                                    <div class="e-learning-card_container">
                                        <div class="e-learning-card_inner">
                                            <div class="e-learning-card_image">
                                                <img src="dosyalar/images/egitim-2.jpg" alt="">
                                                <div class="e-learning-card_play">
                                                 
                                                </div>
                                            </div>
                                            <div class="e-learning-card_content">
                                                <h3>Eğitim Adı Deneme Eğitim Adı Deneme Eğitim Adı Deneme Eğitim Adı Deneme</h3>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress" style="width: 0%;"></div>
                                            </div>
											<div class="progress-content"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					<?php } ?>
					</section>
				</div>
			</div>
		</div>
	</section>
<?php } else {

echo "<script language=\"JavaScript\">location.href=\"/login.php\";</script>";

}	include('dosyalar/dahili/footer.php');?>
<script>$('body').addClass('dashboard');</script>