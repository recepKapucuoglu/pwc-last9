<?php include('dosyalar/dahili/header.php');
if ($_SESSION['dashboardUser']){

	?>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php include('dosyalar/dahili/dashboard-menu.php');?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">			
					<section class="dashboard-detay">
						<div class="sectionbaslik">Dashboard</div>
						 <?php
						$db->where('email', $_SESSION['dashboardUser']);
						$results = $db->get('web_user');
						foreach ($results as $value) {
							$dashboardUserStatus=$value['status'];
							$dashboardUserMailStatus=$value['mail_status'];
						}
						if($dashboardUserMailStatus<>1) echo "<div id='bildirim' class='bildirim'><div class=\"alert alert-danger\">Mail adresiniz doğrulanmamıştır. <b>Doğrulama işlemleri için <a href=\"javascript:;\" onclick=\"return dogrulama_send();\">tıklayınız.</a></b></div></div>";
					?> 
						<?php 
						$shouldChange = shouldChangePassword($_SESSION['dashboardUser']);
							if($shouldChange[0]) 
							{
								$shouldChange[1] = $shouldChange[1]->format('d-m-Y H:i:s');
								echo '<div class="col-12 alert alert-danger">Şifrenizi en son ' . $shouldChange[1] . ' tarihinde güncellediniz, lütfen güvenliğiniz için <a href="dashboard-hesabim.php">şifrenizi yenileyin.</a></div>';
							}
							$dateToday = date("Y-m-d");
							$db->where('durum', 1);
							$db->where('egitim_tarih',$dateToday,'>=');
							$yaklasanEgitimler = $db->getValue ('education_calender_list', "count(id)");
							
							
							$db->where('user_id',$_SESSION['dashboardUserId']);
							$favoriTotal = $db->getValue ('web_user_favorite', "count(id)");
							
							
							$db->where('user_id',$_SESSION['dashboardUserId']);
							$egitimlerimTotal = $db->getValue ('education_order_form', "count(id)");
		
							
						?>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div class="dbkutu hesapozeti turuncu">
									<a href="dashboard-egitimlerim.php">
										<i class="icon egitim-icon-2"></i>
										<span>Eğitimlerim</span>
									</a>

									<b><?php echo $egitimlerimTotal; ?></b>
								</div>
							</div>
							<!--<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<div class="dbkutu hesapozeti">
									<a href="dashboard-videolarim.php">
										<span>Videolarım <b>12</b></span>
										<i class="icon video-icon-2"></i>
									</a>
								</div>
							</div>-->
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div class="dbkutu hesapozeti kirmizi">
									<a href="dashboard-favorilerim.php">
										<i class="icon favori-icon-2"></i>
										<span>Favorilerim </span>
									</a>
									<b><?php echo $favoriTotal; ?></b>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div class="dbkutu hesapozeti gri">
									<a href="https://www.okul.pwc.com.tr/egitimlerimiz">
										<i class="icon yaklasan-egitim-icon"></i>
										<span>Güncel Eğitimler </span>
									</a>
									<b><?php echo $yaklasanEgitimler; ?></b>
								</div>
							</div>
						</div>
						<?php if($dashboardUserStatus==1) { ?>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="baslik" style="font-size: 16px; font-weight: 700; margin-bottom: 20px; position: relative;">Yaklaşan Eğitimler</div>
								<div class="row">
									<?php 
										$db->where('user_id', $_SESSION['dashboardUserId']);
										$egitimlerim = $db->getValue('web_education_order_list', "count(id)");
										
										if($egitimlerim<1){
											echo "<div class=\"alert alert-danger\">Kayıt yaptırılmış eğitim bulunmamaktadır.</div>";
										} else {
										echo "<div class=\"dbkutuicerik \"><div class=\"listeler kucukresim\">";
										$db->where('user_id', $_SESSION['dashboardUserId']);
										$resultsCalender = $db->get('web_education_order_list');
										foreach ($resultsCalender as $valueCalender) { 
										
										if($type_id != '3'){ //elearning olmayanları getir
?>
									<div class="col-md-4" style="margin-bottom:20px">
										<a style="color:#2d2d2d" href="<?php echo $valueCalender['edu_cal_seo_url']; ?>">
											<div class='square' style="height:450px">
												<img src='<?php echo $site_url.$valueCalender['resim']; ?>' class='mask'>
												<div class='square-body' >
													<div class='h1'>
														<h4 style="margin-bottom:15px">
															<?php echo $valueCalender['baslik']; ?>
														</h4>
													</div>
													<table style="font-size:12px;">
														<tr>
															<td width="110"><b>Kayıt Tarihi :</b></td>
															<td><?php echo date2Human($valueCalender['kayit_tarihi']); ?></td>
														</tr>
														<tr>
															<td><b>Kayıt Numarası :</b></td>
															<td><?php echo $valueCalender['siparis_id']; ?></td>
														</tr>
														<tr>
															<td><b>Toplam Tutar :</b></td>
															<td><?php echo number_format($valueCalender['tutar'], 2, ',', '.'); ?> TL</td>
														</tr>
														<tr>
															<td><b>Toplam Katılımcı :</b></td>
															<td><?php echo $valueCalender['katilimci_sayisi']; ?></td>
														</tr>
													</table>
													<div style="position:absolute; bottom:5%; left:10%">
														<a href='<?php echo $valueCalender['edu_cal_seo_url']; ?>' class='button'>Eğitime Git</a>
													</div>
												</div>
											</div>
										</a>
									</div>
									<?php }} echo "</div></div>"; } ?>
								</div>
							</div>
						</div>
						<?php } ?>
						
						
					</section>
				</div>
			</div>
			
		</div>
	</section>
	<section id="onecikanegitimler">
		<?php include('dosyalar/dahili/onecikanegitimler.php'); ?>
	</section>
<?php } else {

echo "<script language=\"JavaScript\">location.href=\"/uyelik\";</script>";

}	include('dosyalar/dahili/footer.php');?>
<script>$('body').addClass('dashboard');</script>