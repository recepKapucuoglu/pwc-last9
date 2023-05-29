<?php include('dosyalar/dahili/header.php');
include('dosyalar/dahili/elearning_connect.php');


$db->where('elearning_detail_path',$_GET['path']);
$isHaving = $db->getValue('web_education_order_list', "count(id)");
if ($_SESSION['dashboardUser'] && $isHaving  ){?>
	<?php
	$db->where('elearning_detail_path',$_GET['path']);
	$sonuc=$db->getOne('web_education_order_list');
	$db->where('order_id',$sonuc['order_id']);
	$edu_cal_id=$db->getOne('education_order_person_list');
	$email=$edu_cal_id['email'];
	$db->where('id',$edu_cal_id['edu_cal_id']);
	$education=$db->getOne('education_calender_list');
		$aciklama=$education['edu_aciklama'];
		$egitim_adi=$education['egitim_adi'];
        $resim=$education['resim'];
		$kisa_aciklama=$education['kisa_aciklama'];
	?>
    
	<section class="ortakisim">
        
        <div class="rbt-course-details-area ptb--60">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-8">
                        <div class="course-details-content">
                            <div class="rbt-course-feature-box overview-wrapper mt--30 has-show-more active" id="overview">
                                <div class="rbt-course-feature-inner has-show-more-inner-content">
                                    <div class="section-title">
                                    <h1 style="font-size:30px"><?php echo $egitim_adi; ?></h1>
                                    </div>
                                    <p><?php 	echo  t_decode($aciklama); ?> </p>
                                    <section>
                                        <div class="schema-faq">
                                            <div class="schema-faq-section aktif">
                                                <strong class="schema-faq-question"><i class="fas fa-graduation-cap"></i> Eğitim İçeriği</strong>
                                                <div class="schema-faq-answer" style="">
                                                    <?php echo t_decode($aciklama); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="schema-faq">
                                            <div class="schema-faq-section aktif">
                                                <strong class="schema-faq-question"><i class="fas fa-users"></i> Kimler Katılmalı?</strong>
                                                <div class="schema-faq-answer" style="">
                                                    <?php echo $aciklama; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="schema-faq">
                                            <div class="schema-faq-section aktif">
                                                <strong class="schema-faq-question"><i class="fas fa-user-plus"></i> Neden Katılmalı?</strong>
                                                <div class="schema-faq-answer" style="">
                                                    <?php echo $aciklama; ?>
                                                </div>
                                            </div>
                                        </div> -->
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <a class="video-popup-with-text video-popup-wrapper text-center popup-video sidebar-video-hidden mb--15" href="elearning_redirect.php"  target="_blank" style="display: block;">
                            <div class="course-sidebar">
                                <!-- Start Viedo Wrapper  -->
                                <input type="hidden" class="data-post" value="<?php echo $email;?>"  >
                                <img class="dashboard-elearning_image" src="<?php echo $resim; ?>" alt="Video Images">
                                <div class="signal-container">
                                    
                                    <span class="rbt-btn rounded-player-2 with-animation" id="signals">
                                            <span class="play-icon"></span>
                                            <span class="signal s1"></span>
                                            <span class="signal s2"></span>
                                    </span>
                                    
                                </div>
                            </div>
                        </a>
                        <div class="dashboard-elearning_button">
                            <a>
                                Eğitime Git
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
	<script>
// 	$('.video-popup-with-text').click(function(e) {
//       e.preventDefault();

//   var email = $(".data-post").val();

//   // Send the AJAX request with the email as data
//   $.ajax({
//     type: 'POST',
//     url: 'elearning_redirect.php',
//     data: {
//       email: email
//     },
//     success: function(response) {
//       // Handle the response from the server
//       console.log(response);
//     },
//     error: function(xhr, status, error) {
//       // Handle the error
//       console.error(error);
//     }
//   });
// });
	</script>
<?php } else {

echo "<script language=\"JavaScript\">location.href=\"/login.php\";</script>";

}	include('dosyalar/dahili/footer.php');?>
<script>$('body').addClass('dashboard');</script>