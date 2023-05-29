<?php include('dosyalar/dahili/header.php');
// require __DIR__ . '/dosyalar/dahili/otp_function.php';

if ($_SESSION['dashboardUser']) { ?>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php include('dosyalar/dahili/dashboard-menu.php'); ?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<section class="dashboard-detay favorilerim-sayfasi">
						<div class="sectionbaslik">E-Learning Eğitimlerim</div>
						
						<?php
						$db->where('email', $_SESSION['dashboardUser']);
						$results = $db->get('web_user');
						foreach ($results as $value) {
							$dashboardUserMailStatus = $value['mail_status'];
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
									<?php
									$db->where('user_id', $_SESSION['dashboardUserId']);
									$egitimlerim = $db->getValue('web_education_order_list', "count(id)");

									if ($egitimlerim < 1) { ?>
										 <div style="
   												 padding: 10px 40px 0px 20px;
    											font-size: 0.9rem;
    											font-weight: 300;">
												<p>  Satın alınan E-Learning eğitimlerinizi bu sayfadan görüntüleyebilirsiniz.</p>
												<p>	Satın alınan E-Learning eğitimleriniz ödeme onayının ardından 2 iş günü içerisinde hesabınıza tanımlanacaktır.</p>
												</div>
										<!-- echo "<div class=\"alert alert-danger\">Kayıt yaptırılmış eğitim bulunmamaktadır.</div>"; -->
								<?php	} else {
										echo "<div class=\"dbkutuicerik\"><div class=\"listeler kucukresim\">";
										$db->where('user_id', $_SESSION['dashboardUserId']);
										$db->where('elearning_user_code', null, 'IS NOT');
										$db->where('odenen_tutar', null, 'IS NOT');
										$resultsCalender = $db->get('web_education_order_list');
										if (count($resultsCalender)>0){
											foreach ($resultsCalender as $valueCalender) {
												//ödenmiş siparişin user codunu alalım
												$_SESSION['dashboardUserElearningCode'] = $valueCalender['elearning_user_code'];
												?>
												<!-- <input type="hidden" id="siparis_id"  value="<?php echo $valueCalender['siparis_id']; ?>"> -->
												<div class="col-md-4 e-learning-card_space">

												<a href="dashboard-e-learning-detay.php?path=<?php echo $valueCalender['elearning_detail_path'] ?>">														<div class='square' style="height:350px">
															<img src="<?php echo $valueCalender['resim']; ?>" alt="">
															<div class='square-body'>
																<div class='h1'>
																	<a href="dashboard-e-learning-detay.php?path=<?php echo $valueCalender['elearning_detail_path'] ?>"
																		class="elearningDetayGit">
																		<h4 class="elearningDetayGit">
																			<?php echo $valueCalender['baslik']; ?>
																		</h4>
																	</a>
																</div>
																<!-- 
												<div class="progress-bar">
													<div class="progress" style="width: 0%;"></div>
												</div>
												<div class="progress-content"></div>
												-->

																<div style="margin-top:15px">
																	<a href="dashboard-e-learning-detay.php?path=<?php echo $valueCalender['elearning_detail_path'] ?>"
																		class='button'>Eğitime Git</a>
																</div>
															</div>
														</div>
													</a>
												</div>
											<?php }}
											else {?>
											<div style="
   												 padding: 10px 40px 0px 20px;
    											font-size: 0.9rem;
    											font-weight: 300;">
												<p>  Satın alınan E-Learning eğitimlerinizi bu sayfadan görüntüleyebilirsiniz.</p>
												<p>	Satın alınan E-Learning eğitimleriniz ödeme onayının ardından 2 iş günü içerisinde hesabınıza tanımlanacaktır.</p>
												</div>
											<?php }
									}
									?>
								</div>
							</div>
						<?php } ?>
					</section>
				</div>
			</div>
		</div>
	</section>


	<script>
	//   $('.elearningDetayGit').click(function(e) {
	//     // e.preventDefault();

	//     // Get the order_id and user_id from the data attributes of the link
	//     var siparis_id = $('#siparis_id').val();
	//     // Send the AJAX request with the order_id and user_id as data
	//     $.ajax({
	//       type:"POST",
	//       url:"dashboard-e-learning-detay.php",
	//       data:{
	//         yyy:siparis_id,
	//       },
	//       success: function(response) {
	//         // Handle the response from the server
	// 		window.location.href = "dashboard-e-learning-detay.php";
	// 		console.log(siparis_id);
	// 	},
	//       error: function(xhr, status, error) {
	//         // Handle the error
	//         console.error(error);
	//       }
	//     });
	//   });

	</script>

<?php } else {

	echo "<script language=\"JavaScript\">location.href=\"/login.php\";</script>";

}
include('dosyalar/dahili/footer.php'); ?>
<script>$('body').addClass('dashboard');</script>