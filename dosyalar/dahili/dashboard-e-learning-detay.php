<?php 
// include('dosyalar/dahili/header.php');
// $siparis_id= $_POST['siparis_id'] ."SSSS";
// echo $siparis_id;
// if($_POST['siparis_id'])
var_dump($_POST['siparis_id2']);
// $db->where('siparis_id',$siparis_id);
// $res=$db->getOne('education_order_form_list');
// $edu_cal_id=$res['edu_cal_id'];
// echo $edu_cal_id;
die();
// $egitimlerim = $db->getValue('web_education_order_list', "count(id)");
if ($_SESSION['dashboardUser'] && $edu_cal_id ) 
{?>
	<section class="ortakisim">
        <div class="rbt-breadcrumb-default rbt-breadcrumb-style-3">
            <div class="breadcrumb-inner">
                <img src="dosyalar/images/e-learning-bg.png" />
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="content text-start">
                            <h2 class="title">The Complete Histudy 2023: From Zero to Expert!</h2>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rbt-course-details-area ptb--60">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-8">
                        <div class="course-details-content">
                            <div class="rbt-course-feature-box overview-wrapper rbt-shadow-box mt--30 has-show-more active" id="overview">
                                <div class="rbt-course-feature-inner has-show-more-inner-content">
                                    <div class="section-title">
                                        <h4 class="rbt-title-style-3">What you'll learn</h4>
                                    </div>
                                    <p>Are you new to PHP or need a refresher? Then this course will help you get
                                        all the fundamentals of Procedural PHP, Object Oriented PHP, MYSQLi and
                                        ending the course by building a CMS system similar to WordPress, Joomla or
                                        Drupal. Knowing PHP has allowed me to make enough money to stay home and
                                        make courses like this one for students all over the world. </p>

                                        <section>
                                            <div class="schema-faq">
                                                <div class="schema-faq-section aktif">
                                                    <strong class="schema-faq-question"><i class="fas fa-graduation-cap"></i> Eğitim İçeriği</strong>
                                                    <div class="schema-faq-answer" style="display: block;">
                                                        <ul>
                                                            <li>Konaklama Vergisinin Kapsamı</li>
                                                            <li>Konaklama Vergisine Tabi İşlemler</li>
                                                            <li>Konaklama Vergisine Tabi Olmayan İşlemler</li>
                                                            <li>Geceleme Hizmetinin Kapsamı</li>
                                                            <li>Konaklama Vergisinde Vergiyi Doğuran Olay</li>
                                                            <li>Verginin Mükellefi</li>
                                                            <li>Konaklama Vergisi Matrahı</li>
                                                            <li>Konaklama Vergisinde Oran</li>
                                                            <li>Konaklama Vergisinin Belgelerde Gösterilmesi</li>
                                                            <li>Vergilendirme İşlemleri</li>
                                                            <li>Tarih İşlemleri</li>
                                                            <li>Verginin Ödenmesi</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-sidebar sticky-top rbt-shadow-box course-sidebar-top rbt-gradient-border">
                            <div class="inner">
                                <!-- Start Viedo Wrapper  -->
                                <a class="video-popup-with-text video-popup-wrapper text-center popup-video sidebar-video-hidden mb--15" href="https://www.youtube.com/watch?v=nA1Aqp0sPQo" style="display: block;">
                                    <div class="video-content">
                                        <img class="w-100 rbt-radius" src="dosyalar/images/e-learning.jpg" alt="Video Images">
                                        <div class="position-to-top">
                                            <span class="rbt-btn rounded-player-2 with-animation" id="signals">
                                                <span class="play-icon"></span>
                                                    <span class="signal s1"></span>
                                                    <span class="signal s2"></span>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <!-- End Viedo Wrapper  -->
                                <div class="content-item-content">
                                  
                                    <div class="add-to-card-button mt--15">
                                        <a class="rbt-btn btn-gradient icon-hover w-100 d-block text-center" href="#">
                                            <span class="btn-text">Eğitime Devam Et</span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
<?php } else {

echo "<script language=\"JavaScript\">location.href=\"/login.php\";</script>";

}	include('dosyalar/dahili/footer.php');?>
<script>$('body').addClass('dashboard');</script>