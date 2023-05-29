<?php

require __DIR__ . '/dosyalar/dahili/header.php';
require __DIR__ . '/dosyalar/dahili/otp_function.php';


// Session yoksa doğrulamasına izin verme
if ($_SESSION['dashboardUser']) {
  
    // veritabanından aktif olup olmadığını öğreniyoruz
    $db->where('email', $_SESSION['dashboardUser']);
    $results = $db->getOne('web_user');
    // kullanıcının zaten aktif olup olmadığını öğrenelim.
    $isActive = $results["status"];
    // kullanıcının isim ve mail bilgilerini çekelim
    $user_name = $results["fullname"];
    $user_mail = $results["email"];
    $user_phone=$results["phone"];


    $secure_mail = $_SESSION["dashboardUser"];
    ?>
    <section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
        <div class="basliklar">
            <div class="baslik">HESAP DOĞRULAMA</div>
            <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
                    <meta itemprop="position" content="1"/>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="#"><span itemprop="name">Hesap Doğrulama</span></a>
                    <meta itemprop="position" content="2"/>
                </li>
            </ol>
        </div>
    </section>  
    <section class="ortakisim">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="sepet-div"> 
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <center>
                                    <div class="bildirim"></div>
                                    <form method="post" class="girisform" id="verify_user_otp_mail" onsubmit="javascript: void(0);">
                                        <div class="baslik">
                                        <b> Mail Doğrulama</b>
                                        </div>
                                        <p>Lütfen, <b><?php echo $secure_mail; ?></b> adresine yollanan şifreyi giriniz.<br />
										<small>E-posta adresinizi yanlış girdiyseniz, <a href="hatali-mail.php" onclick="return confirm('Emin misiniz?')">bu linke tıklayınız.</a></small>
										</p>
                                        <input type="hidden" name="redirect_url" id="redirect_url"
                                               value="turquality-ve-ihracat-tesvikleri-webcast-18022021-1400">
                                        <div class="label-div2">
                                            <label for="pass">Şifre*</label>
                                            <input type="text" name="otp" value="" id="pass" required="">
                                        </div>
                                        <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                                                                     onclick="return verify_user_otp_mail();"><span>Doğrula</span></a>
                                        </div>
                                        <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                                                                     onclick="return verify_user_otp_resend_mail();"><span>Tekrar şifre iste</span></a>
                                        </div>
                                 
                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
} else {
    header("Location: https://www.okul.pwc.com.tr/");
}
require __DIR__ . '/dosyalar/dahili/footer.php';