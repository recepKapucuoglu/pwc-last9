<?php
session_start();
if(isset($_SESSION["isim"])){
    header("Location: https://www.okul.pwc.com.tr/platform/giris/calendar.php");
}
$_SESSION["index_url"] = $_SERVER['REQUEST_URI'];
?>
<html lang="en"><head>
    <!-- Basic Page Needs ================================================== -->
    <meta charset="utf-8">

    <!-- Mobile Specific Metas ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Site Title -->
    <title>20. Çözüm Ortaklığı Platformu | PwC Türkiye</title>

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
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/giris/main.css?v=1.1">
    <!-- Responsive styles-->
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/css/responsive.css?v=191120192311">
    <link rel="stylesheet" href="https://www.okul.pwc.com.tr/platform/modul/check/bower_components/iCheck/skins/flat/_all.css">
    <link rel="canonical" href="https://www.okul.pwc.com.tr/platform/">
    <link rel="icon" type="image/png" href="https://www.okul.pwc.com.tr/dosyalar/images/favicon.png">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="body-inner">

    <header id="header" class="header header-transparent nav-border">
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
                            <a target="_blank" href="https://www.okul.pwc.com.tr/platform">WORKSHOP PROGRAMLARI</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div><!-- container end-->
    </header>
    <section class="ts-pricing gradient" style="background-image: url(https://www.okul.pwc.com.tr/platform/images/bg-2021.jpg);">
        <div class="container" style="margin-top: 10rem !important; margin-bottom: 10rem !important;">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title white">
                        <span style="
    text-transform: none;
">PwC 20. Çözüm Ortaklığı Platformu</span>Giriş Ekranı</h2>
                    <?php
                    if($_SESSION["error"]){
                        echo '<div class="col-6 offset-md-3 alert alert-warning mb-5">
<strong>Uyarı!</strong> Giriş bilgileriniz yanlış, lütfen kontrol ediniz. </div>';
                    }
                    ?>
                    <div class="formMessage"></div>
                    <form id="contact-form" class="contact-form" action="login_control.php" method="post">
                        <div class="error-container"></div>
                        <div class="row justify-content-center" style="
    margin-top: -2rem;
">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input class="form-control form-control-name" placeholder="Etkinliğe kayıt olduğunuz mail adresi" name="name" id="f-name" type="text" required="">
                                </div>
                            </div>




                        </div>

                        <div class="text-center"><br>
                            <button class="btn" type="submit"> GİRİŞ YAP</button><br />
                        </div>
                    </form>
                </div><!-- section title end-->
            </div><!-- col end-->
            <!-- row end-->

        </div><!-- container end-->

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
                            <li>
                                <a target="_blank" href="https://www.okul.pwc.com.tr/platform">WORKSHOP PROGRAMLARI</a>
                            </li>
    
                        </ul>
                    </div><!-- footer menu end-->
                    <div class="copyright-text text-center">
                        <p>© 2021 PwC. All rights reserved. PwC refers to the PwC network and/or one or more of its member firms, each of which is a separate legal entity.<br>Please see <a href="www.pwc.com/structure" target="_blank">www.pwc.com/structure</a> for further details. </p>
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
    <script src="https://www.okul.pwc.com.tr/platform/js/main.js?v=20112019122812"></script>
    <!--<script type="text/javascript" src="modul/check/bower_components/iCheck/icheck.min.js"></script> -->
    <script type="text/javascript" src="https://www.okul.pwc.com.tr/platform/modul/check/js/custom.js"></script>
    <script>
        function send_form(){
            var query=$('#contact-form').serialize();
            $.ajax({type:'POST',url:'login_control.php',data:query,success:function(cevap)
                {$('.formMessage').html(cevap);}}).done(function(){$("html, body").animate({scrollTop:$('#kayit-formu').offset().top},800);});}
    </script>
</div>
<!-- Body inner end -->


</body></html>