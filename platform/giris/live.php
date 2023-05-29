<?php
require "sesion_check.php";
header("Location: https://www.okul.pwc.com.tr/platform/giris/calendar.php");
?>
<?php
include_once('../manage/config/database.php');
function retrieveData($day)
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM timetables WHERE day='$day'";
    $db_timetables = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    Database::disconnect();
    return $db_timetables;
}

?>
<html lang="en"><head>
    <!-- Basic Page Needs ================================================== -->
    <meta charset="utf-8">

    <!-- Mobile Specific Metas ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Site Title -->
    <title>20. Çözüm Ortaklığı Platformu | Canlı Yayın | PwC Türkiye</title>

    <!-- CSS
         ================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/font-awesome.min.css">
    <!-- Animation -->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/animate.css">
    <!-- magnific -->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/magnific-popup.css">
    <!-- carousel -->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/owl.carousel.min.css">
    <!-- isotop -->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/isotop.css">
    <!-- ico fonts -->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/xsIcon.css">
    <!-- Template styles-->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/style.css?v=1911201943212">
    <!-- Responsive styles-->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/responsive.css?v=191120192311">
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/modul/check/bower_components/iCheck/skins/flat/_all.css">
    <link rel="canonical" href="https://www.okul.pwc.com.tr/platform/">
    <link rel="icon" type="image/png" href="https://www.okul.pwc.com.tr/dosyalar/images/favicon.png">
	  <meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0">

    <style>
        .Blink {
        animation: blinker 1.5s cubic-bezier(.5, 0, 1, 1) infinite alternate;
        }
        @keyframes blinker {
        from { opacity: 1; }
        to { opacity: 0; }
        }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="body-inner">

    <header id="header" class="header header-transparent nav-border" style="background: rgba(45, 45, 45, 1)">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- logo-->
                <a class="navbar-brand" href="https://www.okul.pwc.com.tr/platform">
                    <img src="https://www.okul.pwc.com.tr/platform/images/logo.png" alt="PwC Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a href="live.php">CANLI YAYIN</a>
                        </li>
                        <li class="nav-item">
                            <a href="calendar.php">ETKİNLİK TAKVİMİ</a>
                        </li>
                        <li class="nav-item">
                            <a href="help.php">DESTEK</a>
                        </li>
                        <?php if(isset($_SESSION["isim"])){echo "<li class=\"nav-item\" style=\"color: #ffb600;margin-top: 1.65rem;margin-left: 4rem;font-weight: 800;\">Hoşgeldiniz, {$_SESSION["isim"]}</li>";} ?>
                    </ul>
                </div>
            </nav>
        </div><!-- container end-->
    </header>
    <section class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title">
                    <span>Etkinlik Programı</span>
                    CANLI YAYIN
                </h2>
            </div><!-- col end-->

        </div><!-- row end-->
        <div class="tab-content schedule-tabs schedule-tabs-item">
            <div role="tabpanel" class="tab-pane active" id="date1">
                <div class="row justify-content-center">
                <div class="alert alert-warning" role="alert">
            Canlı yayınımız henüz başlamamıştır.
        </div>
                    <div class="col-md-6 col-xs-12 d-none">
                        <div class="col-lg-12 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms" style="visibility: visible; animation-duration: 1.5s; animation-delay: 400ms; animation-name: fadeInUp;">
                            <div class="post">
                                <div class="post-media post-image" style="width: 100%">
                                    <img src="https://www.okul.pwc.com.tr/platform/manage/admin/timetable/images/cum4.jpg"
                                         class="img-fluid" alt="" style="border-radius: 0; box-shadow: none;">
                                </div>
                                <div class="post-body">
                                    <div class="post-meta">
                                        <div class="post-meta-date" style="font-weight: 900; font-size: 1rem;">CANLI <i class="fa fa-circle text-danger Blink"></i></div>
                                    </div>
                                    <div class="entry-header">
									
										<!-- başlık -->
                                        <h2 class="entry-title" style="font-size: 20px;line-height: 1.6rem;">
											Pandemi Döneminde Dönüşen Tüketici Davranışları : Cesur Yeni Tüketiciler
										</h2>
                                        
                                    </div><!-- header end -->
                                    <div class="post-footer" style="min-height: 40px;">
									
									<!-- konuşmacılar -->
		<p><b>Etkin Çiftçi</b> - Deneyim Danışmanlığı Hizmetleri Lideri <br><b>Seçil Turan</b> - Deneyim Danışmanlığı Hizmetleri, Müdür <br>
</p>

                                        
										<br>
                                        
										<!-- oturum linki -->
										<a target="_blank" href="https://event.webcasts.com/starthere.jsp?ei=1415949&tp_key=206e99a5d5" class="btn" id="ts_contact_submit">Oturuma Katıl</a>
                                   
 								    </div>

                                </div><!-- post-body end -->
                            </div><!-- post end-->
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 d-none">
                        <div class="col-lg-12 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms" style="visibility: visible; animation-duration: 1.5s; animation-delay: 400ms; animation-name: fadeInUp;">
                            <div class="post">
                                <div class="post-media post-image" style="width: 100%">
                                    <img src="https://www.okul.pwc.com.tr/platform/manage/admin/timetable/images/cum5.jpg"
                                         class="img-fluid" alt="" style="border-radius: 0; box-shadow: none;">
                                </div>
                                <div class="post-body">
                                    <div class="post-meta">
                                        <div class="post-meta-date" style="font-weight: 900; font-size: 1rem;">CANLI <i class="fa fa-circle text-danger Blink"></i></div>
                                    </div>
                                    <div class="entry-header">
                                        <h2 class="entry-title" style="font-size: 20px; line-height: 1.6rem;">
										Çalışma Mevzuatındaki Güncel Gelişmeler ve COVID-19 Etkileri</h2>
                                       
                                    </div><!-- header end -->
                                    <div class="post-footer" style="
            min-height: 40px;
        ">
                                     <p><b>Rıza Eroğlu</b> - İş ve Sosyal Güvenlik Hizmetleri, Kıdemli Danışman <br><b>Çağıl Şahin</b> - Vergi ve Hukuk Hizmetleri, Direktör <br>
</p>
                                            <br>
                                        <a target="_blank" href="https://pwc-emeamc.webex.com/pwc-emeamc/onstage/g.php?MTID=e6256b433469cc5cc91249a5f7de10584" class="btn" id="ts_contact_submit">Oturuma Katıl</a>
                                    </div>

                                </div><!-- post-body end -->
                            </div><!-- post end-->
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="date3">
			 <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content schedule-tabs">
                <?php
$tabs = ["monday", "tuesday", "wednesday", "thursday", "friday"];
$friday = retrieveData("friday");
foreach($friday as $day){

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
    if($day["id"] == 54){
        $split_text_panel = explode("-", $day["name"]);
        $launch = substr($split_text_panel[0], 11);
        $panel = substr($split_text_panel[1], 8);
        $day["name"] = "<span style='color: #d04a02;'>$launch</span> <br />
                                <span style='color: #d04a02;'>&#8220;$panel&#8220;</span>";
    } else if($day["id"] == 59){
        $day["name"] = "<span style='color: #d04a02;'>{$day["name"]}</span>";
    }
    echo "                           <div class=\"schedule-listing\" id=\"s{$day['id']}\">
<div class=\"schedule-slot-time\" style=\"align-items: center;display: flex;justify-content: center;text-align: center; {$backgroundColorlast}\">
<span>{$day['start_time']} - {$day['end_time']}</span>
</div>
<div class=\"schedule-slot-info\" style=\"min-height: 200px\">
<img class=\"schedule-slot-speakers\" src=\"https://www.okul.pwc.com.tr/platform/manage/admin/timetable/images/{$day['image']}\" alt=\"\">
<div class=\"schedule-slot-info-content desktop-margin\">
<a href=\"#popup_workshop\" onclick=\"return workshop('{$day['id']}');\" class=\"view-speaker ts-image-popup\" data-effect=\"mfp-zoom-in\">
<h3 class=\"schedule-slot-title\">{$day['name']}</h3></a>
{$who_text}
</div>
<!--Info content end -->
</div><!-- Slot info end -->
</div>";
}
?>

				</div>
				</div>
				</div>
			</div>
        </div>
    </section>
    <section class="ts-footer" id="iletisim">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 d-none">
                    <div class="ts-map">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe src="https://maps.google.com/maps?q=swiss%20otel&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe>
                            </div>

                        </div>
                    </div>
                </div>


            </div><!-- col end-->
        </div><!-- container end-->
    </section>


    <footer class="ts-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="footer-menu text-center mb-10">
                        <ul>
                            <li></li>
                            <li><a href="live.php">Canlı Yayın</a></li>
                            <li><a href="calendar.php">Etkinlik Takvimi</a></li>
                            <li><a href="help.php">Destek</a></li>
                        </ul>
                    </div><!-- footer menu end-->
                    <div class="copyright-text text-center">
                        <p>© 2021 PwC. All rights reserved. PwC refers to the PwC network and/or one or more of its member firms, each of which is a separate legal entity.<br>Please see <a href="www.pwc.com/structure" target="_blank">www.pwc.com/structure</a> for further details. </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- popup start-->
    <div id="popup_workshop" class="container ts-speaker-popup mfp-hide">
        <div class="row">
        <div class="alert alert-warning" role="alert">
            Canlı yayınımız henüz başlamamıştır
        </div>
        </div><!-- row end-->
    </div><!-- popup end-->

</div>


    <!-- Javascript Files
          ================================================== -->
    <!-- initialize jQuery Library -->
    <script src="https://www.okul.pwc.com.tr/platform/js/jquery.js"></script>

    <script src="https://www.okul.pwc.com.tr/platform/js/popper.min.js"></script>
    <!-- Bootstrap jQuery -->
    <script src="https://www.okul.pwc.com.tr/platform/js/bootstrap.min.js"></script>
    <!-- Counter -->
    <script src="https://www.okul.pwc.com.tr/platform/js/jquery.appear.min.js"></script>
    <!-- Countdown -->
    <script src="https://www.okul.pwc.com.tr/platform/js/jquery.jCounter.js"></script>
    <!-- magnific-popup -->
    <script src="https://www.okul.pwc.com.tr/platform/js/jquery.magnific-popup.min.js"></script>
    <!-- carousel -->
    <script src="https://www.okul.pwc.com.tr/platform/js/owl.carousel.min.js"></script>
    <!-- Waypoints -->
    <script src="https://www.okul.pwc.com.tr/platform/js/wow.min.js"></script>
    <!-- isotop -->
    <script src="https://www.okul.pwc.com.tr/platform/js/isotope.pkgd.min.js"></script>

    <!-- Template custom -->
    <script src="main.js?v=1.2"></script>
    <!--<script type="text/javascript" src="modul/check/bower_components/iCheck/icheck.min.js"></script> -->
    <script type="text/javascript" src="https://www.okul.pwc.com.tr/platform/modul/check/js/custom.js"></script>

<!-- Body inner end -->

</body>
</html>