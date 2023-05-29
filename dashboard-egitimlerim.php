<?php include('dosyalar/dahili/header.php');
if ($_SESSION['dashboardUser']){?>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php include('dosyalar/dahili/dashboard-menu.php');?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					
				
				
					<section class="dashboard-detay egitimlerim-sayfasi">
						<div class="sectionbaslik">Satın Alınan Eğitimler</div>
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
						<?php 
							$db->where('user_id', $_SESSION['dashboardUserId']);
							$egitimlerim = $db->getValue('web_education_order_list', "count(id)");
							
							if($egitimlerim<1){
								echo "<div class=\"alert alert-danger\">Kayıt yaptırılmış eğitim bulunmamaktadır.</div>";
							} else {
								echo "<div class=\"row\">
							<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">";
							$db->where('user_id', $_SESSION['dashboardUserId']);
							$resultsCalender = $db->get('web_education_order_list');
							foreach ($resultsCalender as $valueCalender) { 
						?>
						
							
								<table class="tablesepet">
									<thead>
										<th>Kayıt Tarihi: <?php echo date2Human($valueCalender['kayit_tarihi']); ?></th>
										<th>Kayıt Numarası: <?php echo $valueCalender['siparis_id']; ?></th>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="urunkutusu">
													<div class="resim"><img src="<?php echo $site_url.$valueCalender['resim']; ?>" alt="" /></div>
													<div class="adi"><?php echo $valueCalender['baslik']; ?></div>
												</div>
											</td>
											<td>
												<div class="fiyat">
													<strong>Ödenen Tutar</strong>
													<b><?php echo number_format($valueCalender['tutar'], 2, ',', '.'); ?> TL</b>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<table>
													<thead>
														<th>No</th>
														<th>Ad Soyad*</th>
														<th>Telefon*</th>
														<th>E-Posta*</th>
													</thead>
													<tbody>
														<?php 
														$i=0;
														$db->where('order_id', $valueCalender['order_id']);
														$results = $db->get('education_order_person');
														foreach ($results as $value) {
															$i++;
														?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo $value['adsoyad']; ?></td>
															<td><?php echo $value['telefon']; ?></td>
															<td><?php echo $value['email']; ?></td>
														</tr>
														<?php } ?>
														
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
								
							<?php } echo "</div></div>"; } ?>
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