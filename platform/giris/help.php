<?php
session_start();
?>
<html lang="en">
<head>
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
                        echo '
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-9 text-center">
                    <h2 class="section-title">
                        Destek Talebi
                    </h2>
                    <div class="sidebar-widgets">
                        <div class="widget asq-form">
                            <form action="contact.php" method="POST" class="ts-form">
                                <input required type="text" class="form-control" name="name"
                                       placeholder="Adınız Soyadınız"
                                       value="<?php echo isset($_SESSION["isim"]) ? $_SESSION["isim"] : "" ?>" id="ts_contact_name">
                                <input required type="email" class="form-control" name="email"
                                       placeholder="Email Adresiniz"
                                       value="<?php echo isset($_SESSION["mail"]) ? $_SESSION["mail"] : "" ?>"
                                       id="ts_contact_email">
								<input required type="text" class="form-control" name="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       placeholder="Telefon Numaranız" maxlength="11"
									   value="<?php echo isset($_SESSION["tel"]) ? $_SESSION["tel"] : "" ?>"
                                       id="ts_contact_email">
                                <input required type="text" class="form-control" name="subject"
                                       placeholder="Sorun Başlığı"
                                       id="ts_contact_email">
                                <textarea required name="message" placeholder="Karşılaştığınız sorunun detayı"
                                          id="x_contact_massage"
                                          class="form-control message-box" cols="30" rows="10"></textarea>
                                <div class="ts-btn-wraper">
                                    <input type="submit" class="btn" id="ts_contact_submit"
                                           value="TALEP OLUŞTUR">
                                </div>
                            </form>
                        </div>
                    </div>
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
                            <li><a href="calendar.php">Etkinlik Programı</a></li>
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