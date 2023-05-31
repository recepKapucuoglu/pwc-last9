<?php include('dosyalar/dahili/header.php');
if ($_SESSION['dashboardUser']){?>
	<section class="ortakisim">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
					<?php include('dosyalar/dahili/dashboard-menu.php');?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9" style="
    margin-bottom: 50px">
					<section class="dashboard-detay favorilerim-sayfasi">
						<div class="sectionbaslik">Favoriler</div>
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
							<div class="listeler">
								<?php
								$db->where('user_id', $_SESSION['dashboardUserId']);
							$favorilerim = $db->getValue('web_favorite_list', "count(id)");
							
							if($favorilerim<1){
								echo "<div class=\"alert alert-danger\">Favorilere eklenen eğitim bulunmamaktadır.</div>";
							} else {
									$db->where('user_id', $_SESSION['dashboardUserId']);
									
									$resultsCalender = $db->get('web_favorite_list');
									foreach ($resultsCalender as $valueCalender) { 
								?>
								<div class="col-sm-12 col-md-4" style="margin-bottom:25px">
									<!-- <a href='<?php echo $valueCalender['seo_url']; ?>'> -->
									<a>

										<div class='square' style="height:400px">
										<img  class='favorireset' id='<?php echo $valueCalender['seo_url']; ?>' src="dosyalar/images/heart.png" style="cursor:pointer; position:absolute; right:10%; top:3%; width:25px; height:auto; filter:invert(52%) sepia(44%) saturate(43%) hue-rotate(352deg) brightness(10%) contrast(67%); z-index: 99999;" alt="Favorilerden Çıkar!"/>
											<a href="<?php echo $valueCalender['seo_url']; ?>"><img src="<?php echo $site_url.$valueCalender['resim']; ?>"/></a>
											<div class='square-body'>
													<div id="<?php echo $valueCalender['id']; ?>" class="favorireset aktif hint--left hint--rounded" aria-label="Favorilerimiden Çıkar!"></div>
												
													<div class='h1'><a style="font-size:20px;line-height: 23px;" href="<?php echo $valueCalender['seo_url']; ?>"><?php echo $valueCalender['baslik']; ?></a></div>
													
											
												<div>
													<a style="position:absolute; bottom:5%" href='<?php echo $valueCalender['seo_url']; ?>'class='button'>Eğitime Git</a>
												</div>
											</div>
										</div>
									</a>
								</div>
								
							<?php } } ?>
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
<script>$('body').addClass('dashboard');
$(".favorireset").click(function () {
    var seo_url =$(this).attr('id');
    console.log(seo_url);
    $.ajax({
        type: 'POST',
        url: 'dosyalar/dahili/education_unlike.php',
		data: {
			seo_url: seo_url
		
		},
        dataType: 'json',
        success: function (cevap) {
            if (cevap.status == 'ok') {
                window.location.href = "https://www.okul.pwc.com.tr/dashboard-favorilerim.php";

            }
            else {
                growl(cevap.msg, 'error', 'Hata !');
            }
        }
    });

});
</script>