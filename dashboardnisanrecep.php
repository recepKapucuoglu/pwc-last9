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
								<div class="dbkutu hesapozeti">
									<a href="dashboard-egitimlerim.php">
										<span>Eğitimlerim <b><?php echo $egitimlerimTotal; ?></b></span>
										<i class="icon egitim-icon-2"></i>
									</a>
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
								<div class="dbkutu hesapozeti">
									<a href="dashboard-favorilerim.php">
										<span>Favorilerim <b><?php echo $favoriTotal; ?></b></span>
										<i class="icon favori-icon-2"></i>
									</a>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div class="dbkutu hesapozeti">
									<a href="https://www.okul.pwc.com.tr/egitimlerimiz">
										<span>Güncel Eğitimler <b><?php echo $yaklasanEgitimler; ?></b></span>
										<i class="icon yaklasan-egitim-icon"></i>
									</a>
								</div>
							</div>
						</div>
						<?php if($dashboardUserStatus==1) { ?>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="dbkutu">
									<div class="baslik">Yaklaşan Eğitimler</div>
									<?php 
										$db->where('user_id', $_SESSION['dashboardUserId']);
										$egitimlerim = $db->getValue('web_education_order_list', "count(id)");
										
										if($egitimlerim<1){
											echo "<div class=\"alert alert-danger\">Kayıt yaptırılmış eğitim bulunmamaktadır.</div>";
										} else {
											echo "<div class=\"dbkutuicerik scrollbar-rail\"><div class=\"listeler kucukresim\">";
										$db->where('user_id', $_SESSION['dashboardUserId']);
										$resultsCalender = $db->get('web_education_order_list');
										foreach ($resultsCalender as $valueCalender) { 
									?>
									<div class="egitimkutu-tip2" style="min-height:auto; border: 0px; border-bottom: 1px solid #dedede">
												<figure>
													<a href="<?php echo $valueCalender['seo_url']; ?>"><img src="<?php echo $site_url.$valueCalender['resim']; ?>"/></a>
												</figure>
												<div class="basliklar">
													
													<a href="<?php echo $valueCalender['seo_url']; ?>">
														<h4><?php echo $valueCalender['baslik']; ?></h4>
														<p><?php echo $valueCalender['kisa_aciklama']; ?></p>
														<p>

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
														</p>
													</a>
												</div>
											</div>
									
									<?php } echo "</div></div>"; } ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="dbkutu">
									<div class="baslik">Favorilerim</div>
									<?php 
										$db->where('user_id', $_SESSION['dashboardUserId']);
										$favorilerim = $db->getValue('web_favorite_list', "count(id)");
										
										if($favorilerim<1){
											echo "<div class=\"alert alert-danger\">Favorilere eklenen eğitim bulunmamaktadır.</div>";
										} else {
											echo "<div class=\"dbkutuicerik scrollbar-rail\"><div class=\"listeler kucukresim\">";
										$db->where('user_id', $_SESSION['dashboardUserId']);
										$resultsCalender = $db->get('web_favorite_list');
										foreach ($resultsCalender as $valueCalender) { 
									?>
									<div class="egitimkutu-tip2" style="min-height:auto; border: 0px; border-bottom: 1px solid #dedede">
												<figure>
													<a href="<?php echo $valueCalender['seo_url']; ?>"><img src="<?php echo $site_url.$valueCalender['resim']; ?>"/></a>
												</figure>
												<div class="basliklar">
													
													<a href="<?php echo $valueCalender['seo_url']; ?>">
														<h4><?php echo $valueCalender['baslik']; ?></h4>
														<p><?php echo $valueCalender['kisa_aciklama']; ?></p>
														
													</a>
												</div>
											</div>
									
									<?php } echo "</div></div>"; } ?>
									
									
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