<?php
include_once('manage/config/database.php');
function retrieveData($day){
    $pdo = Database::connect();
    $sql = "SELECT * FROM timetables WHERE day='$day'";
    $db_timetables  = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    Database::disconnect();
    return $db_timetables;
}
function strip_tags_content($text, $tags = '', $invert = FALSE) {

    preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
    $tags = array_unique($tags[1]);

    if(is_array($tags) AND count($tags) > 0) {
        if($invert == FALSE) {
            return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
        }
        else {
            return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
        }
    }
    elseif($invert == FALSE) {
        return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
    }
    return $text;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs ================================================== -->
    <meta charset="utf-8">

    <!-- Mobile Specific Metas ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Site Title -->
    <title>19. Çözüm Ortaklığı Platformu | PwC Türkiye</title>

    <!-- CSS
         ================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Animation -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- magnific -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- isotop -->
    <link rel="stylesheet" href="css/isotop.css">
    <!-- ico fonts -->
    <link rel="stylesheet" href="css/xsIcon.css">
    <!-- Template styles-->
    <link rel="stylesheet" href="css/style.css?v=1911201943212">
    <!-- Responsive styles-->
    <link rel="stylesheet" href="css/responsive.css?v=191120192311">
    <link rel="stylesheet" href="modul/check/bower_components/iCheck/skins/flat/_all.css">
    <link rel="canonical" href="https://www.okul.pwc.com.tr/platform/"/>
    <link rel="icon" type="image/png" href="https://www.okul.pwc.com.tr/dosyalar/images/favicon.png">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        #ck-button {
            margin:4px;
            background-color:#eb8c00;
            border-radius:4px;
            color: white;
            font-weight: 700;
            overflow:auto;
            float:right;
			display: none;
        }

        #ck-button label {
            float:right;
            width:4.0em;
        }

        #ck-button label span {
            text-align:center;
            padding:5px 9px;
            display:block;
        }

        #ck-button label input {
            position:absolute;
            top:-20px;
        }
        .text_add:after{
            content: "Listeme ekle";
        }
        #ck-button input:checked + .text_add {
            background-color:#e0301e;
            color:#fff;
        }

        #ck-button input:checked + .text_add:after{
            content: "Listemden çıkar";
        }
    </style>

</head>

<body>
<div class="body-inner">
    <!-- Header start -->
    <header id="header" class="header header-transparent nav-border">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- logo-->
                <a class="navbar-brand" href="https://www.okul.pwc.com.tr">
                    <img src="images/logo.png" alt="PwC Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a href="" class="hakkinda">PLATFORM HAKKINDA</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="workshop">WORKSHOP PROGRAMLARI</a>
                        </li>
                        <li class="header-ticket nav-item d-none">
                            <a class="ticket-btn btn kayit-formu"> Kayıt Ol
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div><!-- container end-->
    </header>
    <!--/ Header end -->

    <!-- banner start-->
    <section class="main-slider owl-carousel">
        <div class="banner-item overlay" style="background-image:url(./images/background-2020.jpg); min-height: 1050px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-11 mx-auto">
                        <div class="banner-content-wrap text-center">
                            <img class="title-shap-img" src="images/shap/title-white.png" alt="">
                            <p class="banner-info">21 – 25 Aralık 2020</p>
                            <h1 class="banner-title">19. Çözüm Ortaklığı Platformu</h1>

                            <p class="banner-desc">
                                19. Çözüm Ortaklığı Platformu'nda, her yıl olduğu gibi bu yıl da, mali ve ekonomik gündeme dair son gelişmeleri bir hafta boyunca güncel konuların işlendiği online seminer ve workshop’larla ele aldık.
                            </p>
                            <!-- Countdown end -->
                            <!-- <div class="banner-btn">
                                <a class="btn kayit-formu">KAYIT OL</a>
                             </div>-->

                        </div>
                        <!-- Banner content wrap end -->
                    </div><!-- col end-->

                </div><!-- row end-->
            </div>
            <!-- Container end -->
        </div><!-- banner item end-->



    </section>
    <!-- banner end-->

    <!--count down start-->
    <!-- <section class="ts-count-down">
        <div class="container">
           <div class="row">
              <div class="col-lg-10 mx-auto">
                 <div class="countdown gradient clearfix">
                    <div class="counter-item">
                       <span class="days">00</span>
                       <div class="smalltext">GÜN</div>
                       <b>:</b>
                    </div>
                    <div class="counter-item">
                       <span class="hours">00</span>
                       <div class="smalltext">SAAT</div>
                       <b>:</b>
                    </div>
                    <div class="counter-item">
                       <span class="minutes">00</span>
                       <div class="smalltext">DAKİKA</div>
                       <b>:</b>
                    </div>
                    <div class="counter-item">
                       <span class="seconds">00</span>
                       <div class="smalltext">SANİYE</div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>-->
    <!--count down end-->


    <!-- ts experience start-->
    <section id="hakkinda" class="ts-experiences">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-6 no-padding align-self-center">
                    <div class="ts-exp-wrap" style="min-height: 535px;">
                        <div class="ts-exp-content">
                            <h2 class="column-title">
                                19. Çözüm Ortaklığı Platformu
                            </h2>
                            <p>PwC Türkiye ve Strategy& olarak GSG Hukuk iş birliğiyle 19. Çözüm Ortaklığı Platformu'nu
                                bu yıl <b>"19 Sonrası... Geleceği Yeniden Keşfetmek"</b> teması ile 21-25 Aralık 2020
                                tarihlerinde gerçekleştirdik.</p>
                            <p>
                                Etkinliğimizi bu sene salgın nedeniyle alınan önlemler ve kısıtlamalar sebebiyle 21-25
                                Aralık tarihlerinde çoklu webcast oturumları şeklinde gerçekleştirdik. COVID-19
                                sürecinin etkilediği mali ve ekonomik gündeme dair son
                                gelişmeler farklı yönleri ile ele aldık.
                            </p>
                        </div>
                    </div>

                </div><!-- col end-->
                <div class="col-lg-6 no-padding">
                    <div class="exp-img" style="background-image:url(./images/tema-2020-rev2.jpg)">
                    </div>
                </div><!-- col end-->
            </div><!-- row end-->
        </div><!-- container fluid end-->
    </section>
    <!-- ts experience end-->




    <section class="ts-schedule d-none" id="program">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title">
                        Etkinlik Programı
                    </h2>
                </div><!-- col end-->

            </div><!-- row end-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content schedule-tabs schedule-tabs-item">
                        <div role="tabpanel" class="tab-pane active" id="date1">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="schedule-listing-item schedule-left">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-02.png" alt="">
                                        <span class="schedule-slot-time">09:00 - 09:45</span>
                                        <h3 class="schedule-slot-title">Workshop Programları</h3>
                                    </div>
                                </div><!-- col end-->
                                <div class="col-lg-6 order-first">
                                    <div class="schedule-listing-item schedule-right">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-01.png" alt="">
                                        <span class="schedule-slot-time">08:00 - 09:00</span>
                                        <h3 class="schedule-slot-title">Kayıt ve Kahvaltı</h3>
                                    </div>
                                </div><!-- col end-->
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="schedule-listing-item schedule-left">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-04.png" alt="">
                                        <span class="schedule-slot-time">10:00 - 10:20</span>
                                        <h3 class="schedule-slot-title">Açılış Konuşması</h3>
                                        <h4 class="schedule-slot-name">Halûk Yalçın, PwC Türkiye Başkanı</h4>
                                    </div>
                                </div><!-- col end-->
                                <div class="col-lg-6 order-first">
                                    <div class="schedule-listing-item schedule-right">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-03.png" alt="">
                                        <span class="schedule-slot-time">09:45 - 10:00</span>
                                        <h3 class="schedule-slot-title">Kahve Arası</h3>
                                    </div>
                                </div><!-- col end-->
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="schedule-listing-item schedule-left schedule-left-long">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-06.png" alt="">
                                        <span class="schedule-slot-time">11:30 - 12:00</span>
                                        <h3 class="schedule-slot-title">Kahve Arası</h3>
                                    </div>
                                </div><!-- col end-->
                                <div class="col-lg-6 order-first">
                                    <div class="schedule-listing-item schedule-right">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-05.png" alt="">
                                        <span class="schedule-slot-time">10:20 - 11:30</span>
                                        <h3 class="schedule-slot-title">1. Oturum: Farklı yönleri ile Yeni Dünyamız</h3>
                                        <p class="schedule-slot-desc">
                                            <strong>Moderatör:</strong><br/>
                                            - Ersun Bayraktaroğlu, PwC Türkiye, Vergi Hizmetleri Şirket Ortağı<br/>
                                            <strong>Konuşmacılar:</strong><br/>
                                            - Prof. Dr. Ümit Özlale, Özyeğin Üniversitesi, İşletme Fakültesi Ekonomi Bölüm Başkanı<br/>
                                            - Ahmet Karslı, Papara, Kurucu ve Yönetim Kurulu Başkanı<br/>
                                            - Özlem Sarıoğlu, Sparkus, Profesyonel Koç<br/>
                                            - Oktay Aktolun, PwC Türkiye, Teknoloji ve Dijital Hizmetler Lideri
                                        </p>
                                    </div>
                                </div><!-- col end-->
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="schedule-listing-item schedule-left">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-08.png" alt="">
                                        <span class="schedule-slot-time">12:30 - 14:00</span>
                                        <h3 class="schedule-slot-title">Öğle Yemeği</h3>
                                    </div>
                                </div><!-- col end-->
                                <div class="col-lg-6 order-first">
                                    <div class="schedule-listing-item schedule-right">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-07.png" alt="">
                                        <span class="schedule-slot-time">12:00 - 12:45</span>
                                        <h3 class="schedule-slot-title">Workshop Programları</h3>
                                    </div>
                                </div><!-- col end-->
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="schedule-listing-item schedule-left schedule-left-long2">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-10.png" alt="">
                                        <span class="schedule-slot-time">15:30 - 15:45</span>
                                        <h3 class="schedule-slot-title">Kahve Arası</h3>
                                    </div>
                                </div><!-- col end-->
                                <div class="col-lg-6 order-first">
                                    <div class="schedule-listing-item schedule-right">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-09.png" alt="">
                                        <span class="schedule-slot-time">14:00 - 15:30</span>
                                        <h3 class="schedule-slot-title">Vergi Oturumu: Vergi Uygulamalarında 2020 ve Sonrası</h3>

                                        <p class="schedule-slot-desc">
                                            <strong>Moderatör:</strong><br/>
                                            - Ezgi Türkmen, PwC Türkiye, Vergi ve Gümrük Uyuşmazlıkları Şirket Ortağı<br/>
                                            <strong>Yeni Vergiler (Yeni Yasa) </strong><br/>
                                            - Cem Aracı, PwC Türkiye, Dolaylı Vergi Hizmetleri Şirket Ortağı <br/>
                                            - Ersun Bayraktaroğlu, PwC Türkiye, Vergi Hizmetleri Şirket Ortağı <br/>
                                            - Bilgütay Yaşar, PwC Türkiye, Vergi Hizmetleri Şirket Ortağı<br/>
                                            <strong>Yeni Gelişmeler </strong><br/>
                                            - Recep Bıyık, PwC Türkiye, Mevzuat Eğitim ve Araştırma Başkanı <br/>
                                            - Cenk Ulu, PwC Türkiye, Dolaylı Vergi Hizmetleri Şirket Ortağı <br/>
                                            - Özlem Güç Alioğlu, PwC Türkiye, Vergi Hizmetleri Şirket Ortağı <br/>
                                            - Burcu Canpolat, PwC Türkiye, Vergi Hizmetleri Şirket Ortağı<br/>
                                            <strong>Hep Yeni Kalanlar </strong><br/>
                                            - Zeki Gündüz, PwC Türkiye, Vergi Hizmetleri Lideri

                                        </p>
                                    </div>
                                </div><!-- col end-->
                            </div>
                            <div class="row">
                                <div class="col-lg-6">

                                </div><!-- col end-->
                                <div class="col-lg-6 order-first">
                                    <div class="schedule-listing-item schedule-right">
                                        <img class="schedule-slot-speakers" src="images/icon/PWC_IKON-11.png" alt="">
                                        <span class="schedule-slot-time">15:45 - 16:30</span>
                                        <h3 class="schedule-slot-title">Workshop Programları</h3>

                                    </div>
                                </div><!-- col end-->

                            </div><!-- row end-->
                        </div><!-- tab pane end-->
                    </div>
                </div>
            </div>
        </div><!-- container end-->
    </section>

    <!-- ts funfact start-->
    <section class="ts-funfact d-none" style="background-image: url(./images/counter-2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="ts-single-funfact">
                        <h3 class="funfact-num"><span class="counterUp" data-counter="10000">10000</span>+</h3>
                        <h4 class="funfact-title">Katılımcı</h4>
                    </div>
                </div><!-- col end-->
                <div class="col-lg-4 col-md-6">
                    <div class="ts-single-funfact">
                        <h3 class="funfact-num"><span class="counterUp" data-counter="700">700</span>+</h3>
                        <h4 class="funfact-title">Konuşmacı</h4>
                    </div>
                </div><!-- col end-->
                <div class="col-lg-4 col-md-6">
                    <div class="ts-single-funfact">
                        <h3 class="funfact-num"><span class="counterUp" data-counter="400">400</span>+</h3>
                        <h4 class="funfact-title">Workshop</h4>
                    </div>
                </div><!-- col end-->
            </div><!-- row end-->
        </div><!-- container end-->
    </section>
    <!-- ts funfact end-->

    <!-- ts experience start-->
    <section class="ts-schedule" id="workshop">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title section-title-yellow">
                        Ana Oturumlar ve Workshop Programı
                    </h2>

                    <div class="text-center d-none">
                        <h4 class="title-normal" style="color:#e0301e">
                            Tüm oturumlarımızın programını aşağıda gün gün görebilir, katılmak istediğiniz workshopları seçebilirsiniz.<br><br> Seçimlerinizi yaptıktan sonra aşağıdaki formu doldurarak kaydınızı tamamlayabilirsiniz.

                            <br/><br/>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Aynı saat aralığında olan workshoplardan bir tanesini seçebilirsiniz.
                            <br/><br/></h4>
                    </div>


					<div class="row d-none">
               <div class="col-lg-6 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms" style="visibility: visible; animation-duration: 1.5s; animation-delay: 400ms; animation-name: fadeInUp;">
                  <div class="post">
                     <div class="post-media post-image" style="width: 100%">
                        <a href="#popup_workshop"><img src="https://www.okul.pwc.com.tr/platform/manage/admin/timetable/images/id-59.jpg" class="img-fluid" alt=""
						style="border-radius: 0; box-shadow: none;"></a>
                     </div>

                     <div class="post-body">
                        <div class="post-meta">


                           <div class="post-meta-date">23 Aralık 2020 | Çarşamba <br> Ana oturum</div>
                        </div>
                        <div class="entry-header">

<h2 class="entry-title" style="
    font-size: 20px;
    line-height: 1.6rem;
">
                              <a class="view-speaker ts-image-popup" href="#popup_workshop" onclick="return workshop('54');">Geleceği Yeniden Keşfetmek</a>
                           </h2><h2 class="entry-title" style="
    font-size: 20px;
    line-height: 1.4rem;
">
                              <a class="view-speaker ts-image-popup" href="#popup_workshop" onclick="return workshop('54');">"Öngörülemeyen gelecekte birlikte yol almak"</a>
                           </h2>


                        </div><!-- header end -->



                        <div class="post-footer" style="
    min-height: 40px;
">


<div id="ck-button" class="c54 d-none" style="
    float: none;
">
   <label style="margin-bottom: 0; display: contents;">
      <input data-id="54" id="i54" data-title="Ana oturum: Geleceği yeniden keşfetmek - ''Öngörülemeyen gelecekte birlikte yol almak''" data-day="wednesday" data-start="10:30" data-end="12:30" onclick="addBasket(this.getAttribute('data-id'), this.getAttribute('data-title'), this.getAttribute('data-start'),
     this.getAttribute('data-end'), this.getAttribute('data-day'), this.checked)" type="checkbox" value="0" style="display: none;"><span class="text_add"></span>
   </label>
</div>
                        </div>

                     </div><!-- post-body end -->
                  </div><!-- post end-->
               </div><!-- col end-->
               <div class="col-lg-6 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1.5s; animation-delay: 500ms; animation-name: fadeInUp;">
                  <div class="post">
                     <div class="post-media post-image" style="width: 100%">
                        <a href="#popup_workshop"><img src="https://www.okul.pwc.com.tr/platform/manage/admin/timetable/images/id-54.jpg" class="img-fluid" alt=""
						style="box-shadow: none; border-radius: 0;"></a>
                     </div>

                     <div class="post-body">
                        <div class="post-meta">


                           <div class="post-meta-date">24 Aralık 2020 | Perşembe <br> Vergi Oturumu</div>
                        </div>
                        <div class="entry-header">

<h2 class="entry-title" style="
    font-size: 20px;
    line-height: 1.6rem;
">
                              <a class="view-speaker ts-image-popup" href="#popup_workshop" onclick="return workshop('59');">Vergide Bildiklerimiz, Bildiğimizi Düşündüklerimiz
</a>
                           </h2><h2 class="entry-title" style="
    font-size: 20px;
    line-height: 1.4rem;
">
                              <a href="#">&nbsp;
</a>
                           </h2>
                        </div><!-- header end -->



                        <div class="post-footer" style="
    min-height: 40px;
">


    <div id="ck-button" class="c59 d-none" style="
    float: none;
">



   <label style="margin-bottom: 0; display: contents;">
      <input data-id="59" id="i59" data-title="Vergi oturumu: Vergide Bildiklerimiz, Bildiğimizi Düşündüklerimiz" data-day="thursday" data-start="10:30" data-end="12:30" onclick="addBasket(this.getAttribute('data-id'), this.getAttribute('data-title'), this.getAttribute('data-start'),
     this.getAttribute('data-end'), this.getAttribute('data-day'), this.checked)" type="checkbox" value="0" style="display: none;"><span class="text_add"></span>
   </label>
</div>
                        </div>

                     </div><!-- post-body end -->
                  </div><!-- post end-->
               </div><!-- col end-->
               <!-- col end-->
            </div>

                    <div class="ts-schedule-nav">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="active" title="Programı Göster" href="#0" role="tab" data-toggle="tab" style="padding: 15px 20px !important">
                                    <h3>Pazartesi</h3>
                                    <span class="text-capitalize">21 Aralık 2020</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="#1" title="Programı Göster" role="tab" data-toggle="tab" style="padding: 15px 20px !important">
                                    <h3>Salı</h3>
                                    <span class="text-capitalize">22 Aralık 2020</span>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="#2" title="Programı Göster" role="tab" data-toggle="tab" style="padding: 15px 20px !important">
                                    <h3>Çarşamba</h3>
                                    <span class="text-capitalize">23 Aralık 2020</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="#3" title="Programı Göster" role="tab" data-toggle="tab" style="padding: 15px 20px !important">
                                    <h3>Perşembe</h3>
                                    <span class="text-capitalize">24 Aralık 2020</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="#4" title="Programı Göster" role="tab" data-toggle="tab" style="padding: 15px 20px !important">
                                    <h3>Cuma</h3>
                                    <span class="text-capitalize">25 Aralık 2020</span>
                                </a>
                            </li>

                        </ul>
                        <!-- Tab panes -->
                    </div>
                </div><!-- col end-->

            </div><!-- row end-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content schedule-tabs">

                        <?php
                        $tabs = ["monday", "tuesday", "wednesday", "thursday", "friday"];
                        foreach($tabs as $i => $tab){
                            if($i == 0){ printf('<div role="tabpanel" class="tab-pane active" id="%d">', $i); }
                            else{ printf('<div role="tabpanel" class="tab-pane" id="%d">', $i); }
                            $monday = retrieveData($tab);
                            foreach($monday as $day){

                                if($day["who"] != NULL || !empty($day["who"])){
                                    $who = explode("#", trim($day["who"]));
                                    $who_text = "<p>";
                                    foreach($who as $i => $w){
                                        $w = explode("-", $w);
                                        $present = trim($w[0]);
                                        $topic = trim($w[1]);
                                        $who_text .= "<b>$present</b> - $topic <br />";
                                    }
                                } else {
                                    $who_text = "";
                                }
                                $backgroundColorlast = "";
                                if(in_array($day["id"], [1,5,40,44,45,49,50,54,58,62,63,67])){
                                    $backgroundColorlast = "background-color:#ffb600;";
                                } else if(in_array($day["id"], [2,41,42,46,51,52,55,56,59,64,68,69])){
                                    $backgroundColorlast = "background-color:#eb8c00;";
                                } else {
                                    $backgroundColorlast = "background-color:#d04a02;";
                                }
								//if(in_array($day["id"], [54, 59])){ $cdnone="d-none"; } else {$cdnone = "";}
                                $day['datatitle'] = $day["name"];
                                if($day["id"] == 54){
                                    $split_text_panel = explode("-", $day["name"]);
                                    $launch = $split_text_panel[0];
                                    $panel = $split_text_panel[1];
                                    $day["name"] = "<span style='color: #d04a02;'>$launch</span> <p></p>
                                    <span style='color: #d04a02;'>$panel</span>";
                                } else if($day["id"] == 59){
                                    $day["name"] = "<span style='color: #d04a02;'>{$day["name"]}</span>";
                                }
                                $button = "<div id=\"ck-button\" class=\"c{$day['id']}\">
   <label style=\"margin-bottom: 0; display: contents;\">
      <input data-id=\"{$day['id']}\" id=\"i{$day['id']}\" data-title=\"{$day['datatitle']}\" data-day=\"{$tab}\" data-start=\"{$day['start_time']}\" data-end=\"{$day['end_time']}\"
     onclick=\"addBasket(this.getAttribute('data-id'), this.getAttribute('data-title'), this.getAttribute('data-start'),
     this.getAttribute('data-end'), this.getAttribute('data-day'), this.checked)\" type=\"checkbox\" value=\"0\"
     style=\"display: none;\"><span class=\"text_add\"></span>
   </label>
</div>";
$d_none = "";
if($day["id"] == 5){
	$d_none = "display: none;";
}
$buttons = sprintf('<div class="mt-3">
    <a href="%s" class="btn btn-kayitol" style="font-size: 14px;line-height: 35px;height: 35px;padding: 0 13px;background-color: #eb8c00;width: 150px;%s" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp; SUNUMU İNDİR</a>
    <a href="%s" class="btn btn-kayitol ml-3" style="font-size: 14px;line-height: 35px;height: 35px;padding: 0 13px;width: 150px;%s" target="_blank"><i class="fa fa-youtube-play"></i>&nbsp;SUNUMU İZLE</a>
</div>', $day["pdf"], $d_none, $day["video"], $d_none);
                                echo "                           <div class=\"schedule-listing\" id=\"s{$day['id']}\">
<div class=\"schedule-slot-time\" style=\"align-items: center;display: flex;justify-content: center;text-align: center; {$backgroundColorlast}\">
<span>{$day['start_time']} - {$day['end_time']}</span>
</div>
<div class=\"schedule-slot-info\">
<img class=\"schedule-slot-speakers\" src=\"https://www.okul.pwc.com.tr/platform/manage/admin/timetable/images/{$day['image']}\" alt=\"\">
<div class=\"schedule-slot-info-content desktop-margin\">
<a href=\"#popup_workshop\" onclick=\"return workshop('{$day['id']}');\" class=\"view-speaker ts-image-popup\" data-effect=\"mfp-zoom-in\">
<h3 class=\"schedule-slot-title\">{$day['name']}</h3></a>
{$who_text}
{$buttons}
</div>
<!--Info content end -->
</div><!-- Slot info end -->
</div>";
                            }
                            echo "</div>";
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div><!-- container end-->
    </section>
    <!-- ts experience end-->


    <!-- ts-book-seat start-->
    <section class="ts-book-seat d-none" style="background-image: url(images/video-bg_2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 align-self-center">
                    <br/><br/>
                    <div class="about-video">

                        <a href="https://www.youtube.com/watch?v=swf6p162fvM" class="video-btn ts-video-popup"><i class="icon icon-play"></i></a>

                    </div><!-- entro video end-->
                    <br/><br/>
                </div><!-- col end-->


            </div><!-- row end-->
        </div><!-- container end-->
    </section>
    <!-- book seat  end-->



    <section class="ts-contact-form ts-map-direction d-none" id="kayit-formu">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title section-title-red text-center" style="margin-bottom:45px;">
                        Kayıt Formu
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="formMessage"></div>

                    <form id="contact-form" class="contact-form" method="post"  onsubmit="return send_form();">
                        <div class="row">
                            <div class="katilimci_satirlari col-md-12 col-lg-12">
                                <div class="katilimci_satir">
                                    <div class="text-center">
                                        <h3 class="title-normal">Katılımcı Bilgileri</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <!-- Birden fazla katılımcı için buton -->
                                            <div class="row d-none">
                                                <div class="col-md-9">
                                                    <p style="margin-top:24px; font-size:16px">*1'den fazla katılımcı için önce yandaki butondan katılımcı sayısını belirtiniz.</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="adetsec" data-toggle="tooltip" title="Tek seferde Max. 15 katılımcı ekleyebilirsiniz.">
                                                        <span class="minus">-</span>
                                                        <input type="number" max="15" class="adet" name="adet" id="adet" value="1" onkeyup="this.setAttribute('value', this.value);"/>
                                                        <span class="plus">+</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control form-control-name" placeholder="Ad Soyad *" name="adsoyad" id="adsoyad" type="text" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control form-control-name" placeholder="Unvan *" name="unvan" id="unvan" type="text" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control form-control-name" placeholder="Firma *" name="firma_adi" id="firma_adi" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control form-control-name" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Telefon" maxlength="11" name="telefon" id="telefon" type="text">
                                                    </div>
                                                </div>
                                                <input type="hidden" id="selectedVideos" name="selectedVideos" value="not">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control form-control-email" placeholder="Şirket e-mail *" name="email" id="email" type="email" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="Cep Telefonu *" maxlength="11" id="gsm" name="gsm" required="">
                                                    </div>
                                                </div>

<div class="col-md-12">
      <div class="form-check" style="
    padding-left: 1.25rem;
">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="alumni">
    <label class="form-check-label" for="exampleCheck1" style="
    padding-left: 0rem;
">Eski PwC çalışanıyım.</label>
  </div>

                                                    </div>

                                                <div class="col-md-12">
                                                    <div class="form-check" style="padding-left: 1.25rem">
                                                        <input type="checkbox" class="form-check-input" name="aydinlatma">
                                                        <label class="form-check-label" for="aydinlatma" style="
    padding-left: 0 !important;
"><a href="https://www.okul.pwc.com.tr/aydinlatma-metni" target="_blank" style="text-decoration:underline !important">Aydınlatma Metni'ni</a> okudum,anladım ve <a href="acik-riza-metni" target="_blank" style="text-decoration:underline !important">Açık Rıza Metni'ni</a> onaylıyorum.</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-center">

                                                    <p style='font-size:11px; float:left; text-align:left'>Kişisel verileriniz, <a href="https://www.okul.pwc.com.tr/aydinlatma-metni" target="_blank" style="text-decoration:underline !important">Aydınlatma Metni</a> kapsamında işlenmektedir. Kayıt ol butonuna basarak <a href="https://www.okul.pwc.com.tr/acik-riza-metni" target="_blank" style="text-decoration:underline !important">Açık Rıza Metni</a>’ni ve <a href="https://www.pwc.com.tr/tr/hakkimizda/kisisel-verilerin-korunmasi.html" target="_blank" style="text-decoration:underline !important">Gizlilik ve Çerez Politikası</a>’nı okuduğunuzu ve kabul ettiğinizi onaylıyorsunuz.  </p>

                                                    <a href="javascript:;" onclick="return send_form();" class="btn btn-kayitol" id="submit">Kayıt Ol</a>

                                                </div>
                                                <div class="col-md-8 d-none">

                                                    <div class="cevaplar" style="padding-top:18px">
                                                        <label for="alumnisSoru" style="padding-right:20px; padding-bottom:20px">Eski PwC Çalışanı</label>
                                                        <input type="radio" name="alumni" value="1" id="alumnisEvet" />
                                                        <label for="alumnisEvet" style="padding-right:20px; padding-bottom:20px">Evet</label>

                                                        <input style="padding-left:20px;" type="radio" name="alumni" id="alumnisHayir" value="2"  />
                                                        <label for="alumnisHayir">Hayır</label>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="ayrilma" style="display:none">
                                                        <input class="form-control form-control-name" placeholder="Ayrılma Yılınız *" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" name="alumni_yil" id="alumni_yil" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="ts-map-tabs">
                                                <ul class="nav" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" href="#workshop_1_form" role="tab" data-toggle="tab">Pazartesi</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#workshop_2_form" role="tab" data-toggle="tab">Salı</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#workshop_3_form" role="tab" data-toggle="tab">Çarsamba</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#workshop_4_form" role="tab" data-toggle="tab">Perşembe</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#workshop_5_form" role="tab" data-toggle="tab">Cuma</a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content direction-tabs">
                                                    <div role="tabpanel" class="tab-pane active" id="workshop_1_form">
                                                        <div class="direction-tabs-content">
                                                            <p class="derecttion-vanue">
                                                            <div id="monday"></div>
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="workshop_2_form">
                                                        <div class="direction-tabs-content">
                                                            <p class="derecttion-vanue">
                                                            <div id="tuesday"></div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="workshop_3_form">
                                                        <div class="direction-tabs-content">
                                                            <p class="derecttion-vanue">
                                                            <div id="wednesday"></div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="workshop_4_form">
                                                        <div class="direction-tabs-content">
                                                            <p class="derecttion-vanue">
                                                            <div id="thursday"></div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="workshop_5_form">
                                                        <div class="direction-tabs-content">
                                                            <p class="derecttion-vanue">
                                                            <div id="friday"></div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 col-lg-12 d-none">
                                <hr>
                                <div class="text-center">
                                    <h3 class="title-normal">Fatura Bilgileri</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="cevaplar">

                                                <input type="radio" name="fatura-turu" value="2" checked id="kurumsalCheck" />
                                                <label for="kurumsalCheck" style="padding-right:20px; padding-bottom:20px">Kurumsal</label>

                                                <input style="padding-left:20px;" type="radio" name="fatura-turu" id="bireyselCheck" value="1"  />
                                                <label for="bireyselCheck">Bireysel</label>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="bireysel" style="display:none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control form-control-name" placeholder="Fatura Ad Soyad *" name="fatura_adsoyad" id="fatura_adsoyad" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control form-control-name" placeholder="T.C Kimlik No. *" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="11" name="tc_no" id="tc_no" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="kurumsal">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control form-control-name" placeholder="Firma Unvanı *" name="firma_unvani" id="firma_unvani" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input class="form-control form-control-name" placeholder="Vergi Dairesi *" name="vergi_dairesi" id="vergi_dairesi" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input class="form-control form-control-name" placeholder="Vergi Numarası *" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" name="vergi_no" id="vergi_no" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="form-control form-control-name" placeholder="Adres *" id="adres" name="adres" type="text" required="">
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div style="padding:20px; background-color:#f2f2f27a;">
                                    <div class="text-center">
                                        <h3 class="title-normal">Ödeme Bilgileri</h3>
                                    </div>
                                    <p style="color:#2d2d2d">18 Aralık 2019 tarihinde düzenleyeceğimiz&nbsp;<strong>"18. Çözüm Ortaklığı Platformu"</strong>na katılım bedeli<strong> 1 kişi için 350 TL + KDV (KDV Dahil 413 TL)'dir</strong>.<br/> Tüm katılımcılarımız için katılım ücreti standarttır. Katılım ücretini etkinlik gününe kadar aşağıda belirttiğimiz hesap bilgilerine 18. ÇOP açıklamasıyla havale ya da eft yoluyla gerçekleştirmenizi, ödeme dekontunu <a href="mailto:egitim@tr.pwc.com">egitim@tr.pwc.com</a> adresine göndermenizi rica ederiz. Faturalar, etkinlikten sonra tarafınıza iletilecektir. <br/>(PO ile çalışıyor iseniz aynı mail adresinden bizlere bilgi verebilirsiniz.)</p>
                                    <p style="color:#2d2d2d">Son 2 gün yapılan iptaller kabul edilmeyecek, ancak katılımcı değişikliği yapılabilecektir.</p>
                                    <p style="color:#2d2d2d"><u>Not:</u> Platform katılım ücreti ile yarattığınız değerli katkılar, sevgili çocuklarımızın eğitimine destek olmak üzere AÇEV'e bağış olarak iletilmektedir.</p>
                                    <p style="color:#2d2d2d">
                                        <strong style="color:#d93954"><em><u>Ödeme Bilgilerimiz</u></em></strong><br/>
                                        Garanti Bankası<br />
                                        PwC Yönetim Danışmanlığı A.Ş Hesabı<br />
                                        <u>Şube</u>: Taksim Ticari , Şube Kodu: 1610<br />
                                        <u>Hesap No</u>: 6299168<br/>
                                        <u>IBAN No</u>: TR30 0006 2001 6100 0006 2991 68
                                    </p>
                                </div>
                                <br/>
                                <p style="font-size:10px; line-height:14px; text-align:left">Aşağıda yer alan "Gönder" butonunu tıklayarak, PwC Türkiye <a href="https://www.pwc.com.tr/kisisel-verilerin-korunmasi-ve-veri-gizlilik-bildirimi" target="_blank">Kişisel Verilerin Korunması ve Veri Gizlilik Bildirimini</a> incelediğimi ve PwC Türkiye ile paylaştığım tüm kişisel verilerimin doğru, güncel ve tam olduğunu beyan ve taahhüt ediyor ve işbu formdaki kişisel verilerimin PwC Türkiye tarafından işlenmesine ve aktarılmasına rıza gösteriyorum. Fikrinizi değiştirir ve bizden bilgi almak isterseniz, <a href="https://www.pwc.com.tr/global/forms/contactUsNew.html?parentPagePath=/content/pwc/tr/tr" target="_blank">Bize Ulaşın</a> sayfamızdan e-posta yollayabilirsiniz.  </p>
                                <p style="font-size:10px; line-height:14px; text-align:left">PwC Türkiye adına etkinlik esnasında çekilen/yapılan video ve fotoğraflar da dahil olmak üzere kişisel verilerimin 6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVKK”) uyarınca, sadece aşağıda açıklandığı çerçevede işlenecek, kaydedilecek, saklanacak, güncellenecek ve 3. kişilerle paylaşılabilecek olduğunu kabul ediyorum. KVKK’da belirtilen haklarımı biliyorum ve kişisel verilerimin PwC Türkiye tarafından aşağıda belirtilen amaçlar dâhilinde işlenmesine ve aktarılmasına rıza gösteriyorum  </p>

                                <div class="text-center">
                                    <a href="javascript:;" onclick="return form_gonder();" class="btn btn-kayitol" id="submit">Kayıt Ol</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="speaker-shap">
            <img class="shap1" src="images/shap/Direction_memphis3.png" alt="">
            <img class="shap2" src="images/shap/Direction_memphis2.png" alt="">
            <img class="shap4" src="images/shap/Direction_memphis1.png" alt="">
        </div>
    </section>

<div class="container text-center"><a href="https://onlinebagis.tev.org.tr/BursFonu?link=2110" target="_blank"><img src="./images/bagis.png" style="
    width: 100%;
    height: auto;
    margin-top: 5rem;
	margin-bottom: 5rem;
"></a></div>

    <!-- ts map direction start-->
    <section class="ts-footer" id="iletisim">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 d-none">
                    <div class="ts-map">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe src="https://maps.google.com/maps?q=swiss%20otel&t=&z=15&ie=UTF8&iwloc=&output=embed"></iframe>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center">


                    <div class="ts-map-tabs">

                        <!-- Tab panes -->
                        <div class="tab-content direction-tabs">
                            <div role="tabpanel" class="tab-pane active" id="profile">
                                <div class="direction-tabs-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="contact-info-box">
                                                <h3 class="text-white">Bilgi için;</h3>
                                                <p><strong class="text-white">Telefon:</strong> <a href="tel:02123765980">0212 376 5980</a>  </p>
                                                <p><strong class="text-white">E-mail: </strong> <a href="mailto:egitim@tr.pwc.com">egitim@tr.pwc.com</a></p>
                                            </div>
                                        </div>
                                    </div><!-- row end-->
                                </div><!-- direction tabs end-->
                            </div><!-- tab pane end-->


                        </div>

                    </div><!-- map tabs end-->

                </div><!-- col end-->
            </div><!-- col end-->
        </div><!-- container end-->
    </section>
    <!-- ts map direction end-->


    <!-- popup start-->
    <div id="popup_workshop" class="container ts-speaker-popup mfp-hide">
        <div class="row">
            <div class="col-lg-6">
                <div class="ts-speaker-popup-img">
                    <img class="company-logo" src="images/workshop/1_detay.jpg" alt="">
                </div>
            </div><!-- col end-->
            <div class="col-lg-6">
                <div class="ts-speaker-popup-content">
                    <h3 class="ts-title">KDV'de Son Dönem Değişiklikleri ve Beklenen Gelişmeler</h3>
                    <span class="speakder-designation">
               <b>Cenk Ulu</b> - Dolaylı Vergiler Hizmetleri, Şirket Ortağı<br/>
               <b>Ömer Bilir</b> - Dolaylı Vergiler Hizmetleri, Direktör
              </span>
                    <h4>Kimler Katılmalı</h4>
                    <p>
                        Operasyonel süreç akışlarını etkin bir şekilde yönetmeyi, güvenilir bir finansal ve yönetim raporlama ortamı oluşturmayı, büyümeyi destekleyen bir SAP alt yapısı ve süreç akışları oluşturmayı hedefleyen Mali İşler ve Bilgi Teknolojileri Yöneticileri
                    </p>
                    <h4>Katılımcıları Neler Bekliyor?</h4>
                    <p>
                        Birçok SAP dönüşüm projesi bütçe, zamanlama, kalite ve fayda yönetimi bakış açıları ile beklentileri karşılayamamaktadır, SAP dönüşüm projelerinden çıkarttığımız dersleri ve tecrübe edilmiş PwC metodolojisi ve yaklaşımlarını tartışacağımız çalıştayda sizleri de aramızda görmek isteriz.
                    </p>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="speaker-session-info">
                                <span>09:00 - 09:45</span>
                                <p>Neuchatel Salonu</p>
                            </div>
                        </div>
                    </div>
                </div><!-- ts-speaker-popup-content end-->
            </div><!-- col end-->
        </div><!-- row end-->
    </div><!-- popup end-->



    <!-- ts footer area start-->
    <footer class="ts-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="footer-menu text-center mb-10">
                        <ul>
                            <li></li>
                            <li><a href="" class="hakkinda">Platform Hakkında</a></li>
                            <li><a href="" class="workshop">Workshop Programları</a></li>
                            <li><a href="" class="kayit-formu">Kayıt Ol</a></li>
                        </ul>
                    </div><!-- footer menu end-->
                    <div class="copyright-text text-center">
                        <p>© 2020 PwC. All rights reserved. PwC refers to the PwC network and/or one or more of its member firms, each of which is a separate legal entity.<br/>Please see <a href="www.pwc.com/structure" target="_blank">www.pwc.com/structure</a> for further details. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="BackTo d-none" style="background: #e0301e;width: 175px;/* border-radius: 0; */height: 42px;right: -5px;border-radius: 7px;">
            <a aria-hidden="true" style="color: #fff;text-align: center;padding: 4px;font-size: 15px;justify-content: center;align-items: center;">Kaydınızı Tamamlayın</a>
        </div>
    </footer>

    <!-- ts footer area end-->




    <!-- Javascript Files
          ================================================== -->
    <!-- initialize jQuery Library -->
    <script src="js/jquery.js"></script>

    <script src="js/popper.min.js"></script>
    <!-- Bootstrap jQuery -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Counter -->
    <script src="js/jquery.appear.min.js"></script>
    <!-- Countdown -->
    <script src="js/jquery.jCounter.js"></script>
    <!-- magnific-popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- carousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Waypoints -->
    <script src="js/wow.min.js"></script>
    <!-- isotop -->
    <script src="js/isotope.pkgd.min.js"></script>

    <!-- Template custom -->
    <script src="js/main.js?v=20112019122812"></script>
    <!--<script type="text/javascript" src="modul/check/bower_components/iCheck/icheck.min.js"></script> -->
    <script type="text/javascript" src="modul/check/js/custom.js"></script>
    <script type="text/javascript">
// ajax form
function send_form(){
var query=$('#contact-form').serialize();
$.ajax({type:'POST',url:'dosyalar/dahili/send_form.php',data:query,success:function(cevap)
{$('.formMessage').html(cevap);}}).done(function(){$("html, body").animate({scrollTop:$('#kayit-formu').offset().top},800);});}
      $(function () {
        $('.popup-modal').magnificPopup({
          type: 'inline',
          preloader: false,
          focus: '#username',
          modal: true
        });
        $(document).on('click', '.popup-modal-dismiss', function (e) {
          e.preventDefault();
          $.magnificPopup.close();
        });
      });
      </script>
</div>
<!-- Body inner end -->
</body>

</html>