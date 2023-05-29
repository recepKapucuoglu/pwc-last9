<?php
ini_set("session.cookie_httponly", "True");
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header("Set-Cookie: key=value; path=/; HttpOnly; SameSite=Lax");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<title>21. Çözüm Ortaklığı Platformu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<meta name="description" content="PwC 21. Çözüm Ortaklığı Platformu">
 	<meta name="keywords" content="PwC, çözüm, ortaklığı, platformu">
	<meta name="author" content="21. Çözüm Ortaklığı Platformu">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/x-icon.png">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/lightcase.css">
	<link rel="stylesheet" type="text/css" href="assets/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?v=1.10.13">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<!-- mobile-nav section start here -->
	<div class="mobile-menu">
		<nav class="mobile-header primary-menu d-lg-none">
			<div class="header-logo">
				<a href="https://www.okul.pwc.com.tr" class="logo"><img src="assets/images/logo/01.png" alt="logo"></a>
			</div>
			<div class="header-bar" id="open-button">
	            <span></span>
	            <span></span>
	            <span></span>
	        </div>
		</nav>
		<div class="menu-wrap">
			<div class="morph-shape" id="morph-shape" data-morph-open="M-1,0h101c0,0,0-1,0,395c0,404,0,405,0,405H-1V0z">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100 800" preserveAspectRatio="none">
					<path d="M-1,0h101c0,0-97.833,153.603-97.833,396.167C2.167,627.579,100,800,100,800H-1V0z"/>
				</svg>
			</div>
			<nav class="menu">
				<div class="mobile-menu-area d-lg-none">
			        <div class="mobile-menu-area-inner" id="scrollbar">
		                <div class="header-bar m-menu-bar">
		                    <a href="https://www.okul.pwc.com.tr" class="logo"><img src="assets/images/logo/01.png" alt="logo"></a>
		                    <div class="close-button" id="close-button"></div>
		                </div>
			            <ul class="m-menu">
			                <li><a href="#platform-hakkinda">Platform Hakkında</a></li>
							<li><a href="#workshop-program">Etkinlik Programı</a></li>
							<li><a href="#workshopProg">Workshop Programları</a></li>
							<li><a href="#tbt">Geçmişten Günümüze Platform</a></li>
			            </ul>
		                <ul class="social-link-list d-flex flex-wrap">
		                    <li><a href="#" class="facebook"><i class=" fab fa-facebook-f"></i></a></li>
		                    <li><a href="#" class="twitter-sm"><i class="fab fa-twitter"></i></a></li>
		                    <li><a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
		                    <li><a href="#" class="google"><i class="fab fa-google-plus-g"></i></a></li>
		                </ul>
			        </div>
			    </div>
			</nav>
		</div>
	</div>
	<!-- mobile-nav section ending here -->

	<!-- header section start here -->
	<div class="header-section d-none d-lg-block">
		<div class="header-bottom">
			<nav class="primary-menu sticky-nav nav-down pwc-header">
				<div class="container container-1310">
					<div class="menu-area">
						<div class="row no-gutters justify-content-between align-items-center">
							<a href="https://www.okul.pwc.com.tr" class="logo">
								<img src="assets/images/logo/logo-white.svg" alt="logo" width="80px" height="auto" class="white-logo">
								<img src="assets/images/logo/01.png" alt="logo" width="80px" height="auto" class="dark-logo" style="display:none">
							</a>
							<div class="right d-flex align-items-center">
								<ul class="main-menu d-flex align-items-center">
									<li><a href="#platform-hakkinda">Platform Hakkında</a></li>
									<li><a href="#workshop-program">Etkinlik Programı</a></li>
									<li><a href="#workshopProg">Workshop Programları</a></li>
									<li><a href="#tbt">Geçmişten Günümüze Platform</a></li>
								</ul>
								<a href="#register-form" class="reg-head d-none d-xl-block brandingBtn d-none">Kayıt Ol</a>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</div>
	<!-- header section ending here -->
	
    <!-- banner start-->
    <section class="hero-area banner-6" style="background:#1f1f1f">
	  <img src="/images/banner/banner-right.jpg" style="position:absolute; right:0; top:0;">
         <div class="banner-item">
            <div class="container">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="banner-content-wrap">
					 	<h2 class="sub-title1" style="color:#e0301e">Fırtınalı Dünyada Yeni Denklem</h2>
                        <h2 class="banner-title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="700ms">
							21. Çözüm Ortaklığı Platformu
                        </h2>
						<h2 class="sub-title">#PwCplatform</h2>
                        <div class="banner-info wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="500ms">
                        	<div class="icon">
							<img src="images/shap/Shape-1.png" alt="">
						    </div>      
							<h2 class="sub-title" style="margin-bottom:0px">Swissôtel The Bosphorus, İstanbul</h2>
                        </div>
                        <!-- Countdown end -->
                        <div class="ts-count-down">
							<div>
								<p id="dateTimer" style="color:white; font-size: 25px; margin:0"></p>
							</div>
                            <div id="countdown">
								<ul>
								<li>
									<span id="days"></span>
									<div class="smalltext">days</div>
								</li>
								<li>
									<span id="hours"></span>
									<div class="smalltext">Hours</div>
								</li>
								<li>
									<span id="minutes"></span>
									<div class="smalltext">Minutes</div>
								</li>
								<li>
									<span id="seconds"></span>
									<div class="smalltext">Seconds</div>
								</li>
								</ul>
							</div>
                        </div>
                        <div class="banner-btn wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="800ms">
                                <a href="#" class="pwc-button">Kayıt Ol</a>
                                <a href="#" class="btn btn-ticket"> <i class="fa fa-plus-circle" style="color:#e0301e" aria-hidden="true"></i> ADD TO CALENDAR</a>
                        </div>

                     </div>
                     <!-- Banner content wrap end -->
                  </div><!-- col end-->
               </div><!-- row end-->
            </div>
            <!-- Container end -->
         </div>
    </section>
    <!-- banner end-->

    <!-- newevent section start here --> 
    <section class="newevent-section padding-tb" id="platform-hakkinda">
		<div class="container container-1310">
			<div class="section-wrapper">
				<div class="row rowify">
					<div class="col-lg-6 col-12">
						<div class="newevent-left">
							<div class="newevent-thumb wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
								<img src="assets/images/newevent/gorsel-content.jpg" alt="newevent">
							</div>
							<div class="newevent-time wow fadeInDown brandingBtn d-none" data-wow-duration="1s" data-wow-delay=".3s">
		                        <ul id="countdown" class="countdown count-down" data-date="December 21, 2021 09:00:00">
						            <li><span class="count-number days">17</span>
						                <p>Gün</p>
						            </li>

						            <li><span class="count-number hours">05</span>
						                <p>Saat</p>
						            </li>

						            <li><span class="count-number minutes">32</span>
						                <p>Dakika</p>
						            </li>

						            <li><span class="count-number seconds">29</span>
						                <p>Saniye</p>
						            </li>
						        </ul>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="newevent-right">
							<div class="acive-content wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
								<h2>21. Çözüm Ortaklığı Platformu</h2>
								<p>20. Çözüm Ortaklığı Platformu'nda, PwC Türkiye ve Strategy& olarak GSG Hukuk iş birliğiyle COVID-19 pandemisinden sonra iyileşme sürecini güven, sürdürülebilirlik, insan ve teknoloji üzerinden mali ve ekonomik gündeme dair son gelişmelerle birlikte gün boyu farklı webcast oturumlarıyla ele alındı.</p>

								<ul class="newevent-right-list d-none">
									<li>
										<div class="newevent-icon"><i class="fas fa-map-marker-alt"></i></div>
										<div class="newevent-addres">Online</div>
									</li>
									<li>
										<div class="newevent-icon"><i class="far fa-calendar-alt"></i></div>
										<div class="newevent-addres">21 Aralık 2021 09:00 - 15:15</div>
									</li>
									<li>
										<div class="newevent-icon"><i class="fas fa-lira-sign"></i></div>
										<div class="newevent-addres">Ücretsiz</div>
									</li>
								</ul>
								<!-- <a href="#register-form" class="btn-defult brandingBtn d-none">Kayıt Ol</a> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <!-- newevent section ending here -->

	<!-- sponsor section start here -->
	<div class="sponsor-section style-2 bg-ash">
        <div class="container container-1310">
        	<div class="section-wrapper">
        		<div class="sponsor-slider wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
        			<div class="row justify-content-between">
                        <div class="col-3">
                        	<div class="sponsor-thumb">
                        		<img src="assets/images/logo/pwc-logo.png" alt="PwC">
                        	</div>
                        </div>
                        <div class="col-3">
                        	<div class="sponsor-thumb">
                        		<img src="assets/images/logo/business-school-logo.png" alt="Business School">
                        	</div>
                        </div>
                        <div class="col-3">
                        	<div class="sponsor-thumb">
                        		<img src="assets/images/logo/gsg-logo.png" alt="GsG Hukuk">
                        	</div>
                        </div>
                        <div class="col-3">
                        	<div class="sponsor-thumb">
                        		<img src="assets/images/logo/strategyand-logo.png" alt="sponsor">
                        	</div>
                        </div>
                    </div>
        		</div>
        	</div>
        </div>
    </div>
	<!-- sponsor section ending here -->

    <!--  business-timeline section start here -->
    <section class="business-timeline style-1 padding-tb d-none" id="workshop-program">
    	<div class="container container-1310">
    		<div class="section-wrapper">
				<div class="section-header wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s">
					<h2>Etkinlik Programı</h2>
					<span>Etkinlik programımızı aşağıda görebilirsiniz.</span>
				</div>
    			<div class="timeline-item">
	    			<p class="time d-none"><span class="brandingBtn">1. Oturum</span></p>
	    			<div id="first_session"></div>
	    		</div>
    		</div>
    	</div>
    </section>
	<!--  business-timeline section ending here -->

	<!-- ts schedule start-->
	<section class="ts-schedule">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
					<div class="section-header wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s">
					<h2>Etkinlik Programı</h2>
					<span class="d-none">Aşağıda bulunan workshoplarımızdan katılmak istediğiniz programı seçebilir ve çıkarabilirsiniz.</span>
				</div>
				<div class="section-wrapper">
					<div id="master" class="row">
					</div>	
				</div>
                </div><!-- col end-->

            </div><!-- row end-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content schedule-tabs schedule-tabs-item">
                    <div role="tabpanel" class="tab-pane active" id="date1">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-left">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-07.png" alt="">
                                <span class="schedule-slot-time">09.00 - 09.45</span>
                                <h3 class="schedule-slot-title">Workshop Programları</h3>
                              	<!--  
								<h4 class="schedule-slot-name">@ Henrikon Rebecca</h4>
                                <p>
                                    How you transform your business technolog consumer habits industry dynamics change
                                    Find out from those leading the charge How you
                                </p> 
								-->
                                </div>
                            </div>
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-right">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-01.png" alt="">
                                <span class="schedule-slot-time">08.00 - 09.00</span>
                                <h3 class="schedule-slot-title">Kayıt & Kahvaltı</h3>
                              	<!--  
								<h4 class="schedule-slot-name">@ Johnsson Agaton</h4>
                                <p>
                                    How you transform your business technolog consumer habits industry dynamics change
                                    Find out from those leading the charge How you
                                </p> 
								-->
                                </div>
                            </div>
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-left">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-07.png" alt="">
                                <span class="schedule-slot-time">10.00 - 10.45</span>
                                <h3 class="schedule-slot-title">Workshop Programları</h3>
                                </div>
                            </div>
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-right">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-03.png" alt="">
                                <span class="schedule-slot-time">09:45 - 10.00</span>
                                <h3 class="schedule-slot-title">Kahve Arası</h3>
                                </div>
                            </div>
							<!-- col end-->
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-left">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-04.png" alt="">
                                <span class="schedule-slot-time">11.00 - 11.15</span>
                                <h3 class="schedule-slot-title">Açılış Konuşması</h3>
                                <h4 class="schedule-slot-name">Cenk Ulu, PwC Türkiye Kıdemli Ortağı</h4>
                                </div>
                            </div>
							<!-- col end-->
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-right">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-03.png" alt="">
                                <span class="schedule-slot-time">10:45 - 11.00</span>
                                <h3 class="schedule-slot-title">Kahve Arası</h3>
                                </div>
                            </div>
							<!-- col end-->
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-left">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-08.png" alt="">
                                <span class="schedule-slot-time">13.00 - 14.00</span>
                                <h3 class="schedule-slot-title">Öğle Yemeği</h3>
                                </div>
                            </div>
							<!-- col end-->
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-right">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-05.png" alt="">
                                <span class="schedule-slot-time">11.15 - 12.45</span>
                                <h3 class="schedule-slot-title">1. Oturum: Yeni denklemi fırtınada çözmek</h3>
									<p class="schedule-slot-desc">
                                    <strong>Moderatör:</strong><br>
									- Lorem ipsum dolor sit amet consectetur adipisicing.<br>
									<strong>Konuşmacılar:</strong><br>
									- Lorem ipsum dolor sit amet.
									- Lorem ipsum dolor sit amet.
									- Lorem ipsum dolor sit amet.
									- Lorem ipsum dolor sit amet.
                                </p>
                                </div>
                            </div>
							<!-- col end-->
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-left">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-03.png" alt="">
                                <span class="schedule-slot-time">15.15 - 15.30</span>
                                <h3 class="schedule-slot-title">Kahve Arası</h3>
                                </div>
                            </div>
							<!-- col end-->
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-right">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-04.png" alt="">
                                <span class="schedule-slot-time">14.00- 15.15</span>
                                <h3 class="schedule-slot-title">Vergi Oturumu</h3>
								<p class="schedule-slot-desc">
                                    <strong>Moderatör:</strong><br>
									- Lorem ipsum dolor sit amet consectetur adipisicing.<br>
									<strong>Konuşmacılar:</strong><br>
									- Lorem ipsum dolor sit amet.
									- Lorem ipsum dolor sit amet.
									- Lorem ipsum dolor sit amet.
									- Lorem ipsum dolor sit amet.
                                </p>
                                </div>
                            </div>
							<!-- col end-->
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-left">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-07.png" alt="">
                                <span class="schedule-slot-time">16.30 - 17.15</span>
                                <h3 class="schedule-slot-title">Workshop Programları</h3>
                                </div>
                            </div>
							<!-- col end-->
							<!-- col end-->
                            <div class="col-lg-6">
                                <div class="schedule-listing-item schedule-right">
                                <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-04.png" alt="">
                                <span class="schedule-slot-time">15.30 - 16.30</span>
                                <h3 class="schedule-slot-title">Yönetici Deneyimleri: Bugünkü deneyiminizle neyi farklı yapardınız</h3>
								<p class="schedule-slot-desc">
                                    <strong>Moderatör:</strong><br>
									- Lorem ipsum dolor sit amet consectetur adipisicing.<br>
									<strong>Konuşmacılar:</strong><br>
									- Lorem ipsum dolor sit amet.
									- Lorem ipsum dolor sit amet.
									- Lorem ipsum dolor sit amet.
									- Lorem ipsum dolor sit amet.
                                </p>    
							</div>
                            </div>
							<!-- col end-->
                        </div>
					<!-- row end-->
                    </div><!-- tab pane end-->
                    </div>
                </div>
            </div>
        </div><!-- container end-->
    </section>
    <!-- ts schedule end-->

	  <!-- ts funfact start-->
	  <section class="ts-funfact" style="background-image: url(./images/funfact_bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ts-single-funfact">
                    <h3 class="funfact-num"><span class="counterUp" data-counter="43">10000+</span></h3>
                    <h4 class="funfact-title">Katılımcı</h4>
                    </div>
                </div><!-- col end-->
                <div class="col-lg-3 col-md-6">
                    <div class="ts-single-funfact">
                    <h3 class="funfact-num"><span class="counterUp" data-counter="62">700</span>+</h3>
                    <h4 class="funfact-title">Konuşmacı</h4>
                    </div>
                </div><!-- col end-->
                <div class="col-lg-3 col-md-6">
                    <div class="ts-single-funfact">
                    <h3 class="funfact-num"><span class="counterUp" data-counter="28">400</span>+</h3>
                    <h4 class="funfact-title">Workshop</h4>
                    </div>
                </div><!-- col end-->
                <div class="col-lg-3 col-md-6">
                    <div class="ts-single-funfact">
                    <h3 class="funfact-num"><span class="counterUp" data-counter="950">950</span>+</h3>
                    <h4 class="funfact-title">Event
                        Participants</h4>
                    </div>
                </div><!-- col end-->
            </div><!-- row end-->
        </div><!-- container end-->
    </section>
    <!-- ts funfact end-->

	<section class="event-schedulex style-3 padding-tb" style="background-color: #f2f2f2 !important;" id="workshopProg">
		<div class="container container-1310">
			<div class="section-header wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s">
				<h2>Ana Oturumlar ve Workshop Programları</h2>
				<span class="d-none">Aşağıda bulunan workshoplarımızdan katılmak istediğiniz programı seçebilir ve çıkarabilirsiniz.</span>
			</div>
			<div class="section-wrapper">
				<div id="master" class="row">
				</div>	
			</div>
		</div>
	</section>	

	<!-- event schedule section start here -->
	<section class="event-schedule style-1 padding-tb" style="background: url('assets/images/background/workshop-bg-1.jpg')" id="workshop-schedule">
		<div class="container container-1310">
			<div class="section-wrapper">
				<div class="tab row no-gutters padding-tb pt-0">
					<div class="col-lg-4 col-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s" data-bgcolor="#A2DED0" data-bg="assets/images/background/workshop-bg-1.jpg">
						<div class="mlr-2">
				  			<button class="tablinks tablinks1 active" onclick="openTab(event, '1st-Day')">09:00-09:45</button>
				  		</div>
				  	</div>
					<div class="col-lg-4 col-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s" data-bgcolor="#DCC6E0" data-bg="assets/images/background/workshop-bg-2.jpg">
						<div class="mlr-2">
					  		<button class="tablinks tablinks2" onclick="openTab(event, '2nd-Day')">11:30-12:15</button>
					  	</div>
					 </div>
					<div class="col-lg-4 col-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".6s" data-bgcolor="#FDE3A7" data-bg="assets/images/background/workshop-bg-3.jpg">
						<div class="mlr-2">
				  			<button class="tablinks tablinks3" onclick="openTab(event, '3rd-Day')">12:45-13:30</button>
				  		</div>
				  	</div>
				</div>
				<div id="1st-Day" class="tabcontent active">
				  	<div class="schedule-tabs wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                   		<div class="schedule-table table-responsive">
                   			<h2>09:00 - 09:45 Workshop Programları</h2>
                      		<table>
                         		<thead>
                            		<tr>
                                       <th class="session" style="width: 40%;">Workshop Adı</th>
                                       <th class="spekers" style="width: 60%;">Konuşmacılar</th>
                            		</tr>
                         		</thead>
                         		<tbody id="first_schedule">
                                
                             	</tbody>
                      		</table>
                   		</div>
                  	</div>
				</div>

				<div id="2nd-Day" class="tabcontent">
				  	<div class="schedule-tabs wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                   		<div class="schedule-table table-responsive">
                   			<h2>11:30 - 12:15 Workshop Programları</h2>
                      		<table>
                         		<thead>
                            		<tr>
                                       <th class="session" style="width: 40%;">Workshop Adı</th>
                                       <th class="spekers" style="width: 60%;">Konuşmacılar</th>
                            		</tr>
                         		</thead>
                         		<tbody id="second_schedule">

                             	</tbody>
                      		</table>
                   		</div>
                  	</div>
				</div>

				<div id="3rd-Day" class="tabcontent">
				  	<div class="schedule-tabs">
                   		<div class="schedule-table table-responsive">
                   			<h2>12:45 - 13:30 Workshop Programları</h2>
                      		<table>
                         		<thead>
                            		<tr>
                                       <th class="session" style="width: 40%;">Workshop Adı</th>
                                       <th class="spekers" style="width: 60%;">Konuşmacılar</th>
                            		</tr>
                         		</thead>
                         		<tbody id="third_schedule">
            
                             	</tbody>
                      		</table>
                   		</div>
                  	</div>
				</div>	
			</div>
		</div>
	</section>	
	<!-- event schedule section ending here -->

	<!-- contact section -->
    <section class="contact-section padding-tb bg-ash d-none" id="register-form">
        <div class="container container-1310">
            <div id="response-head" class="section-header wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s">
                <h2>Kayıt Formu</h2>
                <span>Aşağıdaki formu doldurarak kaydınızı tamamlayabilirsiniz.</span><br />
				<span>Herhangi bir sorunuz olması durumunda bize <a href="mailto:egitim@pwc.com.tr">egitim@pwc.com.tr</a> mail adresinden ulaşabilirsiniz.</span>
            </div>
			<div id="form-message"></div>
            <div id="register-form-d" class="section-wrapper row">
            	<div class="col-lg-8">
	                <form action="./include/send_form.php" id="contact-form" method="POST">
	                    <div class="contact d-flex flex-wrap">
	                        <div class="contact-item">
	                            <div class="contact-item-inner">
                                    <input type="text" placeholder="Ad Soyad *"  id="name" name="adsoyad" required class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
                                    <input type="text" placeholder="Firma *"  id="company" name="firma_adi" required class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">
                                    <input type="email" placeholder="Şirket e-mail *" id="email" name="email" required class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
	                            </div> 
	                        </div>
							<div class="contact-item">
								<div class="contact-item-inner">
									<input type="text" placeholder="Unvan *"  id="degree" name="unvan" required class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
									<input type="tel" placeholder="Telefon"  id="phone" name="telefon" class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
									<input type="tel" placeholder="Cep Telefonu *"  id="cellphone" name="gsm" required class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
								</div>
							</div>
							<input type="hidden" name="selectedVideos" id="selectedVideos">
						
							<div class="col-md-12">
								<div class="form-check" style="padding-left: 1.25rem;">
							  <input type="checkbox" class="form-check-input" id="isalumni" name="alumni">
							  <label class="form-check-label" for="exampleCheck1" style="padding-left: 0rem;">Eski PwC çalışanıyım.</label>
							  <div class="form-row"> 
							    <div class="col"><input type="tel" style="display: none;" placeholder="İşe giriş yılınız" id="enter_year" name="enter_year" class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s"></div> 
							    <div class="col"><input type="tel" style="display: none;" placeholder="İşten ayrılma yılınız" id="leave_year" name="leave_year" class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s"></div>
							  </div>
							  <div id="eskicalisan"></div>
								</div>
						  	</div>

							<div class="col-md-12" id="aydinlatmaText">
								<label class="form-check-label" style="padding-left: 1.25rem;" for="aydinlatma">
									<input type="checkbox" class="form-check-input" id="aydinlatma" name="aydinlatma">
									<a class="brandingColor" data-target="#acikriza" data-toggle="modal"
									style="text-decoration:underline !important; cursor: pointer;">Açık Rıza Metni'ni</a> onaylıyorum.</label>
							</div>
							<div class="aydinlatma" style="padding-left: 1.25rem;">
							<p style="font-size:11px; float:left; text-align:left">Kişisel verileriniz, 
							<a class="brandingColor" data-target="#aydinlatmametni" data-toggle="modal" style="text-decoration:underline !important; cursor: pointer">
								Aydınlatma Metni</a> kapsamında işlenmektedir.</p>
							</div>
	                    </div>
						<div class="submit-btn wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
	                        <button class="brandingBtn" type="submit" value="Submit-Messege" name="submit">Kayıt Ol</button>
	                    </div>
					</form>
	            </div>
	            <div class="col-lg-4">
            		<div class="am">
						<div class="schedule-title wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
							<h6 class="brandingColor">Seçtiğiniz<span> Workshoplar</span></h6>
						</div>
						<ul class="schedule-content" id="registered_items">
						</ul>
					</div>
					<div id="no-selected-item" class="event-item wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay=".1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s;">
						<div class="d-flex align-items-center">
							<div class="event-icon">
							<i class="fas fa-exclamation-circle fa-4x"></i>
							</div>
							<div class="event-content">
								<h6>Henüz workshop seçmediniz.</h6>
								<p>Lütfen <a href="#workshopProg">workshop</a> seçiniz.</p>
							</div>
						</div>
					</div>
            	</div>

	
				</div>
            </div>
    </section>
    <!-- end contact section -->

	<!-- gallery section start here -->
	<section class="gallery-section style-1 padding-tb" id="tbt">
        <div class="container container-1310">
            <div class="section-header row align-items-center justify-content-center justify-content-xl-start">
            	<div class="col-xl-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s">
                	<p>Geçmişten Günümüze</p>
                    <h2>Platform</h2>
                </div>
				
                <div class="col-xl-6">
                    <div id="filters" class="button-group">
                        <button class="button is-checked wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s" data-filter="*"><i class="far fa-star"></i><span>Tüm</span>Galeri</button>
                        <button class="button wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s" data-filter=".metal"><i class="fas fa-image"></i><span>Resim</span>Galeri</button>
                        <button class="button wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".6s" data-filter=".transition"><i class="fab fa-youtube"></i><span>Video</span>Galeri</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-wrapper">
            <div class="grid  wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
				<div class="element-item  metal" data-category="post-transition">
                  	<div class="element-item-inner">
                  		<a href="assets/images/gallery/333.png" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                    	<a href="assets/images/gallery/333.png" data-rel="lightcase">
							<img src="assets/images/gallery/333.png" alt="gallery">
						</a> 
                 	</div>
              	</div>
              	<div class="element-item  metal" data-category="post-transition">
                  	<div class="element-item-inner">
                  		<a href="assets/images/fotograflar/1.jpg" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                    	<a href="assets/images/fotograflar/1.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/1.jpg" alt="gallery"></a> 
                 	</div>
              	</div>

              	<div class="element-item transition" data-category="post-transition">
                  	<div class="element-item-inner">
                  		<a href="https://www.youtube.com/embed/GsXkAz8MLGI" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-play"></i>
                   		</a>
                    	<a href="assets/images/gallery/2.jpg" data-rel="lightcase"><img src="assets/images/gallery/2.jpg" alt="gallery"></a>
                 	</div>
              	</div>

              	<div class="element-item metal" data-category="transition">
                  	<div class="element-item-inner">
                  		<a href="assets/images/fotograflar/2.jpg" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                  		<a href="assets/images/fotograflar/2.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/2.jpg" alt="gallery"></a>
                 	</div>
              	</div>


              	<div class="element-item metal" data-category="alkali">
                  	<div class="element-item-inner">
                  		<a href="assets/images/fotograflar/3.jpg" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                   		<a href="assets/images/fotograflar/3.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/3.jpg" alt="gallery"></a>
                 	</div>
              	</div>

              	<div class="element-item alkali" data-category="alkali">
                  	<div class="element-item-inner">
                  		<a href="assets/images/fotograflar/4.jpg" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                   		<a href="assets/images/fotograflar/4.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/4.jpg" alt="gallery"></a>
                 	</div>
              	</div>

              	<div class="element-item alkali metal" data-category="alkali">
                  	<div class="element-item-inner">
                  		<a href="assets/images/fotograflar/5.jpg" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                		<a href="assets/images/fotograflar/5.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/5.jpg" alt="gallery"></a> 
                 	</div>
              	</div>

              	<div class="element-item alkali metal" data-category="alkali">
                  	<div class="element-item-inner">
                  		<a href="assets/images/fotograflar/6.jpg" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                  		<a href="assets/images/fotograflar/6.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/6.jpg" alt="gallery"></a>
                 	</div>
              	</div>

              	<div class="element-item alkali metal" data-category="transition">
                  	<div class="element-item-inner">
                  		<a href="assets/images/fotograflar/7.jpg" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                  		<a href="assets/images/fotograflar/7.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/7.jpg" alt="gallery"></a>
                 	</div>
              	</div>

              	<div class="element-item alkali metal" data-category="transition">
                  	<div class="element-item-inner">
                  		<a href="assets/images/fotograflar/8.jpg" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                  		<a href="assets/images/fotograflar/8.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/8.jpg" alt="gallery"></a>
                 	</div>
              	</div>

              	<div class="element-item alkali metal" data-category="transition">
                  	<div class="element-item-inner">
                  		<a href="assets/images/fotograflar/9.jpg" data-rel="lightcase" class="cata-icon">
                        	<i class="fas fa-expand-arrows-alt"></i>
                   		</a>
                  		<a href="assets/images/fotograflar/9.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/9.jpg" alt="gallery"></a>
                 	</div>
              	</div>

				  <div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/10.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/10.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/10.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/11.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/11.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/11.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/12.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/12.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/12.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/13.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/13.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/13.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/14.png" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/14.png" data-rel="lightcase"><img src="assets/images/fotograflar/14.png" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/15.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/15.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/15.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/16.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/16.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/16.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/17.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/17.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/17.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/18.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/18.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/18.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/19.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/19.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/19.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/22.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/22.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/22.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/21.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/21.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/21.jpg" alt="gallery"></a>
				   </div>
				</div>

				<div class="element-item alkali metal" data-category="transition">
					<div class="element-item-inner">
						<a href="assets/images/fotograflar/24.jpg" data-rel="lightcase" class="cata-icon">
						  <i class="fas fa-expand-arrows-alt"></i>
						 </a>
						<a href="assets/images/fotograflar/24.jpg" data-rel="lightcase"><img src="assets/images/fotograflar/24.jpg" alt="gallery"></a>
				   </div>
				</div>



            </div>
        </div>
    </section>
	<!-- gallery section ending here -->	

    <!-- footer section start here -->
    <section class="footer-section">
    	<div class="top"><a href="#" class="scrollToTop"><i class="fas fa-angle-up"></i></a></div>
	    <div class="footer-bottom bg-ash">
	    	<div class="container container-1310">
	    		<div class="row justify-content-lg-between justify-content-center align-items-center">
	    			<div class="copyright wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">
	    				<p>© <span id="year"></span> PwC. All rights reserved. PwC refers to the PwC network and/or one or more of its
							member firms, each of which is a separate legal entity.
						<br>
						Please see
						<a href="https://www.pwc.com/structure" target="_blank">www.pwc.com/structure</a>
						for further details.
						</p>
	    			</div>
	    			<div class="footer-social">
	    				<ul class="social-media d-flex flex-wrap mb-0">
	    					<li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".5s"><a href="https://www.facebook.com/PwCTurkey" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
	    					<li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s"><a href="https://www.linkedin.com/in/pwc-turkey-business-school-a93208124/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
	    					<li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s"><a href="https://twitter.com/PwC_Turkey" target="_blank"><i class="fab fa-twitter"></i></a></li>
	    					<li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".2s"><a href="https://www.instagram.com/pwc_turkey/" target="_blank"><i class="fab fa-instagram"></i></a></li>
	    				</ul>
	    			</div>
	    		</div>
	    	</div>
	    </div>
    </section>
    <!-- footer section ending here -->
	<!-- Legal modals -->
	<div id="acikriza" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">KİŞİSEL VERİLERİN İŞLENMESİNE İLİŞKİN AÇIK RIZA</h4>
                </div>
                <div class="modal-body">
                    <p>PwC Türkiye Aydınlatma Metnini incelediğimi ve PwC Türkiye ile paylaştığım tüm kişisel verilerimin
doğru, güncel ve tam olduğunu beyan ve taahhüt ediyor ve işbu formdaki iletişim bilgilerimin PwC Türkiye
tarafından tarafıma bülten ve bilgilendirmesi amacıyla işlenmesine, onay veriyorum.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="brandingBtn" data-dismiss="modal" style="padding: 0.5rem 1rem;">Kapat</button>
                </div>
            </div>

        </div>
    </div>
	<!-- Legal modals -->
		<!-- Legal modals -->
		<div id="aydinlatmametni" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 800px !important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">KİŞİSEL VERİLERİN İŞLENMESİNE İLİŞKİN AYDINLATMA METNİ</h4>
                </div>
                <div class="modal-body">
				<p>D&uuml;nya &ccedil;apında, teknoloji merkezli, bireysel ve bağımsız ortaklıklardan ve şirketlerden oluşan bir ağ olan PricewaterhouseCoopers&#39;ın (&quot;<strong>PwC</strong>&quot;) bir &uuml;yesi olarak PwC T&uuml;rkiye şirketleri&nbsp;(&ldquo;<strong>PwC T&uuml;rkiye</strong>&rdquo;) olarak 6698 sayılı Kişisel Verilerin Korunması Kanunu (&ldquo;<strong>KVKK</strong>&rdquo;) kapsamında KVKK&rsquo;nın 10&rsquo;uncu maddesinden doğan aydınlatma y&uuml;k&uuml;ml&uuml;l&uuml;ğ&uuml;m&uuml;z&uuml; yerine getirmek &uuml;zere kişisel verilerinizin işlenmesine ilişkin aşağıdaki a&ccedil;ıklamalarımız bilginize sunulmaktadır.</p>

<p><strong>Kişisel Verilerinizin İşlenmesinin Kapsamı, Amacı ve Hukuki Sebebi</strong></p>

<p>Kişisel verilerinizi KVKK&rsquo;nın 5&rsquo;inci maddesinde sayılan işleme şartları kapsamında aşağıda detaylıca a&ccedil;ıklandığı &uuml;zere işlemekteyiz:</p>

<ul>
	<li><strong>20. &Ccedil;&ouml;z&uuml;m Ortaklığı Platformu&rsquo;na katılımınızın sağlanabilmesi ve katılım bedeli alınabilmesi</strong></li>
</ul>

<p>Bu ama&ccedil; ile kayıt formu &uuml;zerinden toplanan ad-soyad, unvan, firma, e-posta adresi ve fatura bilgileri verileriniz KVKK m. 5/2 (c) bir s&ouml;zleşmenin kurulması veya ifasıyla doğrudan doğruya ilgili olması kaydıyla, s&ouml;zleşmenin taraflarına ait kişisel verilerin işlenmesinin gerekli olması ve KVKK m. 5/2 (f) ilgili kişinin temel hak ve &ouml;zg&uuml;rl&uuml;klerine zarar vermemek kaydıyla, veri sorumlusunun meşru menfaatleri i&ccedil;in veri işlenmesinin zorunlu olması hukuki sebeplerine dayanarak işlenecektir.</p>

<ul>
	<li><strong>B&uuml;lten g&ouml;nderimi ve bilgilendirme,</strong></li>
</ul>

<p>Bu ama&ccedil; ile doldurmuş olduğunuz form &uuml;zerinden toplanan ad-soyad, unvan, firma ve e-posta bilgileriniz a&ccedil;ık rızanız kapsamında işlenecektir.</p>

<ul>
	<li><strong>İşlem g&uuml;venliğinin sağlanması, </strong></li>
</ul>

<p>Bu ama&ccedil; ile internet sitemiz &uuml;zerinden toplanan işlem g&uuml;venliği bilgileriniz (log kayıtlarınız) KVKK madde 5/2-a kanunlarda a&ccedil;ık&ccedil;a &ouml;ng&ouml;r&uuml;lmesi şartı kapsamında işlenmektedir.</p>

<p><strong>Kişisel Verilerin Aktarılması </strong></p>

<p>Kişisel verileriniz, yukarıda belirtilen ama&ccedil;ların ger&ccedil;ekleştirilebilmesi i&ccedil;in gerektiği &ouml;l&ccedil;&uuml;de ve bu ama&ccedil;larla sınırlı olmak kaydıyla KVKK&rsquo;nın 8 ve 9&rsquo;uncu maddelerine uygun olarak;</p>

<ul>
	<li>Toplu mail g&ouml;nderimi i&ccedil;in &ccedil;alışılan hizmet sağlayıcılar,</li>
</ul>

<ul>
	<li>Gerekmesi halinde hak ve menfaatlerimizin korunması i&ccedil;in avukatlar ve danışmanlar,</li>
</ul>

<p>ile veri g&uuml;venliğiniz sağlanarak ve gerekli tedbirler PwC T&uuml;rkiye tarafından alınarak, paylaşılabilecek olup https://www.okul.pwc.com.tr&nbsp;websitesi aracılığıyla ve merkezi T&uuml;rkiye&rsquo;de bulunan bilgi teknolojileri hizmet sağlayıcılarımızın sistemleri &uuml;zerinden işlenecektir.</p>

<p><strong>KVKK&rsquo;nın 11. Maddesi Uyarınca Haklarınız ve İrtibat Bilgilerimiz </strong><br />
KVKK madde 11 uyarınca, PwC T&uuml;rkiye&rsquo;ye başvurarak;</p>

<ol style="list-style-type:lower-alpha;">
	<li>Kişisel verilerinizin işlenip işlenmediğini &ouml;ğrenme,</li>
	<li>İşlenmişse buna ilişkin bilgi talep etme,</li>
	<li>Kişisel verilerinizin işlenme amacını ve bunların amacına uygun kullanılıp kullanılmadığını &ouml;ğrenme,</li>
	<li>Yurt i&ccedil;inde veya yurt dışında kişisel verilerin aktarıldığı &uuml;&ccedil;&uuml;nc&uuml; kişileri bilme</li>
	<li>Kişisel verilerin eksik veya yanlış işlenmiş olması halinde bunların d&uuml;zeltilmesini isteme,</li>
	<li>Kanunun 7. maddesinde &ouml;ng&ouml;r&uuml;len şartlar &ccedil;er&ccedil;evesinde kişisel verilerinizin silinmesini veya yok edilmesini isteme,</li>
	<li>(e) ve (f) bentleri uyarınca yapılan işlemlerin, kişisel verilerin aktarıldığı &uuml;&ccedil;&uuml;nc&uuml; kişilere bildirilmesini istemesi;</li>
	<li>İşlenen kişisel verilerinizin m&uuml;nhasıran otomatik sistemler ile analiz edilmesi sureti ile aleyhinize bir sonucun ortaya &ccedil;ıkmasına itiraz etme,</li>
	<li>Kişisel verilerin kanuna aykırı olarak işlenmesi sebebiyle zarara uğramanız h&acirc;linde zararınızın giderilmesini talep etme,</li>
</ol>

<p>haklarınızı kullanabilirsiniz.</p>

<p>Yukarıda belirtilen hakların kullanımı ile ilgili taleplerinizi &ldquo;https://www.pwc.com.tr/tr/hakkimizda/kisisel-verilerin-korunmasi.html&rdquo; linkinde bulunan Başvuru Formu aracılığı ile yazılı olarak veya elektronik ortamda <a href="mailto:pwc.turkiye@hs03.kep.tr" target="_blank"><strong>pwc.turkiye@hs03.kep.tr</strong></a> adresine veya 5070 sayılı Elektronik İmza Kanununda tanımlı olan g&uuml;venli elektronik imzalı olarak ya da mobil imza ya da ilgili kişi tarafından veri sorumlusuna daha &ouml;nce bildirilen ve veri sorumlusunun sisteminde kayıtlı bulunan e-posta adresini kullanmak suretiyle tr.dpo@tr.pwc.com adresine konu kısmında &lsquo;&lsquo;Kişisel Veri Bilgi Edinme Talebi&rsquo;&rsquo; ifadesi ile iletmeniz gerekmektedir.</p>

<p><strong>Veri Sorumlusu: PwC T&uuml;rkiye</strong></p>

<p>İletişim Adresi: S&uuml;leyman Seba Cad. BJK Plaza No:48 B Blok, Kat 9 Akaretler 34357 Beşiktaş/İstanbul</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="brandingBtn" data-dismiss="modal" style="padding: 0.5rem 1rem;">Kapat</button>
                </div>
            </div>

        </div>
    </div>
	<!-- Legal modals -->

  	<script src="assets/js/jquery.js"></script>
    <script src="assets/js/snap.svg-min.js"></script>
    <script src="assets/js/classie.js"></script>
    <script src="assets/js/main3.js"></script>
  	<script src="assets/js/bootstrap.min.js"></script>
  	<script src="assets/js/fontawesome.min.js"></script>
  	<script src="assets/js/jquery.counterup.min.js"></script>
	<script src='assets/js/jquery.easing.js'></script> 
  	<script src="assets/js/parallax.min.js"></script>
  	<script src="assets/js/swiper.min.js"></script>
  	<script src="assets/js/lightcase.js"></script>
	<script src="assets/js/jquery.jCounter.js"></script>
  	<script src="assets/js/jquery.countdown.min.js"></script>
  	<script src="assets/js/jQuery.scrollSpeed.js"></script>
  	<script src="assets/js/jquery.jticker.min.js"></script>
  	<script src="assets/js/waypoints.min.js"></script>
  	<script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/data.js?v=1.9.85"></script>
    <script src="assets/js/functions.js?v=1.1"></script>
  	<script src="assets/js/wow.min.js"></script>
	<script src="assets/js/main.js"></script>
    <script src="assets/js/theia-sticky-sidebar.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="assets/js/jquery.inputmask.js"></script>
	<script type="text/javascript">
		Inputmask({
		"mask" : "9999999999",
		"placeholder": "5xxxxxxxxx",
		}).mask("#cellphone");
	</script>
    <script>
	    $(window).scroll(function() {
	    	var theta = $(window).scrollTop() / 300 % Math.PI;
	    	$('#leftgear').css({ transform: 'rotate(' + theta + 'rad)' });
	    });
		document.getElementById('year').innerHTML = new Date().getFullYear();
		
		
		fetchData('first_schedule', '09:00');
		fetchData('second_schedule', '11:30');
		fetchData('third_schedule', '12:45');
		fetchWorkshop('first_session', '09:00');
		fetchMasterData('master');
	</script>
	<script type="text/javascript">
		document.getElementById('isalumni').addEventListener('click', () => {
			if (document.getElementById('isalumni').checked) {
				$('#leave_year').show();
				$('#enter_year').show();
			} else {
				document.getElementById('eskicalisan').innerHTML = ``;
				$('#leave_year').hide();
				$('#enter_year').hide();
			}
		})
	</script>
	<script>
		window.addEventListener('scroll', function(){
		const header = document.querySelector('.pwc-header');
		const darkLogo = document.querySelector('.dark-logo');
		const whiteLogo = document.querySelector('.white-logo');

        const scrollTop = window.scrollY;
        scrollTop >= 250 ? header.classList.add('is-sticky') : header.classList.remove('is-sticky');
		scrollTop >= 250 ? darkLogo.style.display = "block" : darkLogo.style.display = "none";
		scrollTop >= 250 ? whiteLogo.style.display = "none" : whiteLogo.style.display = "block";
		})
	</script>
	<script>
		(function () {
		const second = 1000,
				minute = second * 60,
				hour = minute * 60,
				day = hour * 24;

		//I'm adding this section so I don't have to keep updating this pen every year :-)
		//remove this if you don't need it
		let today = new Date(),
			dd = String(today.getDate()).padStart(2, "0"),
			mm = String(today.getMonth() + 1).padStart(2, "0"),
			yyyy = today.getFullYear(),
			nextYear = yyyy + 1,
			dayMonth = "09/30/",
			birthday = dayMonth + yyyy;
		
		today = mm + "/" + dd + "/" + yyyy;
		if (today > birthday) {
			birthday = dayMonth + nextYear;
		}
		//end
		
		const countDown = new Date(birthday).getTime(),
			x = setInterval(function() {    

				const now = new Date().getTime(),
					distance = countDown - now;

				document.getElementById("days").innerText = Math.floor(distance / (day)),
				document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
				document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
				document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

				//do something later when date is reached
				if (distance < 0) {
				document.getElementById("headline").innerText = "It's my birthday!";
				document.getElementById("countdown").style.display = "none";
				document.getElementById("content").style.display = "block";
				clearInterval(x);
				}
				//seconds
			}, 0)
		}());
	</script>
	
	
</body>
</html>