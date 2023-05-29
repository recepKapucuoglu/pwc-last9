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
						<div class="sectionbaslik">Profil Bilgilerim</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="dbkutu">
									<div class="baslik">Hesap Bilgileri <a href="dashboard-hesabim.php"><i class="icon kalem-icon"></i></a></div>
									<div class="dbkutuicerik">
										<div class="profil">
											<?php
											$db->where('email', $_SESSION['dashboardUser']);
											$results = $db->get('web_user');
											foreach ($results as $value) {
												$fullName = $value['fullname'];
												$title = $value['title'];
												$company = $value['company'];
												$address = $value['address'];
												$email = $value['email'];
												$phone = $value['phone'];
											}
											?>
											<img src="dosyalar/images/default-user.png" alt="" />
											<p><b style="font-size:18px;"><?php echo $fullName; ?> |</b> <?php echo $title; ?></p>
											<br />
											<p><?php echo $company; ?></p>
											<p><?php echo $address; ?></p>
											<p><?php echo $email; ?></p>
											<p><?php echo $phone; ?></p>
											<p><a href="dashboard-hesabim.php">Şifremi Değiştir</a></p>
										</div>
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