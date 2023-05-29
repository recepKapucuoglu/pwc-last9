<?php
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: https://www.okul.pwc.com.tr/platform/giris/help.php");
    exit;
}
session_start();
$safePost = array(
    "name" => FILTER_SANITIZE_STRING,
    "email" => FILTER_SANITIZE_STRING,
    "subject" => FILTER_SANITIZE_STRING,
    "message" => FILTER_SANITIZE_STRING,
    "tel" => FILTER_SANITIZE_STRING,
);
$safePost = filter_input_array(INPUT_POST, $safePost);
$safePost = array_map('trim', $safePost);
$name = $safePost["name"];
$email = $safePost["email"];
$subject = $safePost["subject"];
$message = $safePost["message"];
$tel = $safePost["tel"];
# unique key
$string = $email . time();
$unique = hash('crc32', $string);


$mailTitle = "PwC 19. Çözüm Ortaklığı Platformu | Destek Formu | $unique";
$body="<html>
					<head>
				  <title>Destek Formu</title>
				  <body>\n";
$body.="<table rules='all' style='border-color: #666; font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#333;' cellpadding='10'>
				<thead><tr><td colspan='2'><b>KİŞİSEL BİLGİLER</b></td></tr></thead>";
$body.="<tr><td width='150'><b>Ad Soyad :</b></td><td>".$name."</td></tr>";
$body.="<tr><td width='150'><b>Email :</b></td><td>".$email."</td></tr>";
$body.="<tr><td width='150'><b>Telefon Numarası :</b></td><td>".$tel."</td></tr>";
$body.="<tr><td width='150'><b>Sorun Başlığı :</b></td><td>".$subject."</td></tr>";
$body.="<tr><td width='150'><b>Mesaj :</b></td><td>".$message."</td></tr></table><br/>";

$body.="</body></head></html>";

ini_set("display_errors",1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once("libs/class.phpmailer.php");
require("libs/class.smtp.php");
require("libs/class.pop3.php");
$mail = new PHPMailer;

$mail->IsSMTP();
$mail->Host = "10.9.18.5";

// used only when SMTP requires authentication
//$mail->SMTPAuth = true;
$mail->Username = 'egitim@pwc.com.tr';
$mail->Password = '';
$mail->SMTPAuth = false;
$mail->SMTPAutoTLS = false;
$mail->Port = 25;

$mail->CharSet = 'utf-8';
$mail->setFrom('egitim@pwc.com.tr', 'PwC Türkiye');
$mail->AddAddress("tr_platformdestek@pwc.com");
//$mail->AddAddress("hyildirim@socialthinks.com");
//$mail->AddAddress("serdar.mangaoglu@pwc.com");
// Name is optional
$mail->setLanguage('tr', '/language');

// Set email format to HTML
$mail->Subject = $mailTitle;
$mail->msgHTML($body);
$message_success = '';
if($mail->send()){
    $message_success = sprintf('
<center> <i class="fa fa-check-circle" style="color: #ffb600; font-size: 100px; margin-bottom: 10px;"></i>
<h3><b>Destek Talebiniz Alınmıştır - Referans numaranız: %s</b></h3>
<h3><br><strong>Destek talebiniz tarafımıza ulaşmıştır, en kısa sürede sizinle iletişime geçeceğiz.</strong></h3> </center>',
        $unique);
} else {
    $message_success = '
<center> <i class="fa fa-times" style="color: #ffb600; font-size: 100px; margin-bottom: 10px;"></i>
<h3><b>Destek talebiniz alınamadı</b></h3>
<h3><br><strong>Teknik bir hata oluştu lütfen tekrar deneyiniz</strong></h3> </center>';
}
?>
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
    <link rel="stylesheet"
          href="https://www.okul.pwc.com.tr/platform/modul/check/bower_components/iCheck/skins/flat/_all.css">
    <link rel="canonical" href="https://www.okul.pwc.com.tr/platform/">
    <link rel="icon" type="image/png" href="https://www.okul.pwc.com.tr/dosyalar/images/favicon.png">
    <style>
        .Blink {
            animation: blinker 1.5s cubic-bezier(.5, 0, 1, 1) infinite alternate;
        }

        @keyframes blinker {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
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
					<?php
						if(isset($_SESSION["isim"])){
                        echo '<li class="nav-item">
                            <a href="live.php">CANLI YAYIN VE GÜNÜN PROGRAMI</a>
                        </li>
                        <li class="nav-item">
                            <a href="calendar.php">ETKİNLİK TAKVİMİ</a>
                        </li>
                         <li class="nav-item">
                            <a href="help.php">DESTEK</a>
                        </li>'; } else {
							echo '<li class="nav-item">
                            <a href="index.php">GİRİŞ YAP</a>
                        </li>';
						}?>
						<?php if(isset($_SESSION["isim"])){echo "<li class=\"nav-item\" style=\"color: #ffb600;margin-top: 1.65rem;margin-left: 4rem;font-weight: 800;\">Hoşgeldiniz, {$_SESSION["isim"]}</li>";} ?>

                    </ul>
                </div>
            </nav>
        </div><!-- container end-->
    </header>
    <section class="ts-faq-sec mt-5">
        <div class="container" style="margin-top: 11rem; margin-bottom: 11rem;">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <?php echo $message_success; ?>
                </div><!-- col end-->

            </div><!-- row end-->
        </div><!-- .container end -->
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
                            <li><a href="live.php">Canlı Yayın ve Günün Programı</a></li>
                            <li><a href="calendar.php">Etkinlik Programı</a></li>
                            <li><a href="help.php">Destek</a></li>
                        </ul>
                    </div><!-- footer menu end-->
                    <div class="copyright-text text-center">
                        <p>© 2020 PwC. All rights reserved. PwC refers to the PwC network and/or one or more of its member firms, each of which is a separate legal entity.<br>Please see <a href="www.pwc.com/structure" target="_blank">www.pwc.com/structure</a> for further details. </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Javascript Files
          ================================================== -->
    <!-- initialize jQuery Library -->
    <script src="https://www.okul.pwc.com.tr/platform/js/jquery.js"></script>

    <script src="https://www.okul.pwc.com.tr/platform/js/popper.min.js"></script>
    <!-- Bootstrap jQuery -->
    <script src="https://waww.okul.pwc.com.tr/platform/js/bootstrap.min.js"></script>
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
    <script src="main.js"></script>
    <!--<script type="text/javascript" src="modul/check/bower_components/iCheck/icheck.min.js"></script> -->
    <script type="text/javascript" src="https://www.okul.pwc.com.tr/platform/modul/check/js/custom.js"></script>
</div>
<!-- Body inner end -->


</body>
</html>