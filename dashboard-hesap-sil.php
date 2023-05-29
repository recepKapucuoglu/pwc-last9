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
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<?php
								$silinen_email = $_SESSION['dashboardUser']."_pwc";
								$data = Array (
									'email' 			=> $silinen_email,
									'status' 	=> 0
								);
							
								$db->where('email', $_SESSION['dashboardUser']);
								$id = $db->update ('web_user', $data);
								if ($id) {
								 
									echo "<div class=\"alert alert-danger\">Hesabınız silinmiştir. Hesabınızdan çıkış yapılıyor.</div><script language=\"JavaScript\">
									  function Git() {
										 location.href=\"logout.php\";
									  }
									  setTimeout(\"Git()\",4000);
								  </script>";
								}
								?>
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