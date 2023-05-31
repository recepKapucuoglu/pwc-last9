<?php
require __DIR__ . '/dosyalar/dahili/header.php';
require __DIR__ . '/dosyalar/dahili/otp_function.php';
//kullanıcı daha önce kayıt olma girişiminde bulunmuşmu bulunduysa bilgilerini alıp o ekrana bağlayalım
$db->where('phone', $_SESSION['dashboardUserPhone']); //kayıt olmayı telefonla başlatacagı için
$uye = $db->getOne('web_user');
$uye_phone = $uye['phone'];

if (!$_SESSION['dashboardUser'] && $uye_phone) { // kullanıcı şifre sıfırlama işleminden gelmiş ve üye bilgilerini doldurmamişsa
    $db->where('phone', $_SESSION['dashboardUserPhone']);
    $results = $db->getOne('web_user');
    $_SESSION['dashboardUser'] = "uyeol_step1";
}
// Session yoksa doğrulamasına izin verme 
// kullanıcı giriş yap tan geliyorsa 
if (
    $_SESSION['dashboardUser'] != "uyeol_step1"
    &&
    $_SESSION['dashboardUser'] != "uyeol_step2"
    &&
    $_SESSION['dashboardUserStatus'] != 1
    &&
    (isset($_SESSION['dashboardUser']) || isset($_SESSION['dashboardUserPhone']))
) {

    // veritabanından aktif olup olmadığını öğreniyoruz
    $db->where('email', $_SESSION['dashboardUser']);
    $results = $db->getOne('web_user');
    // kullanıcının isim ve mail bilgilerini çekelim
    $user_name = $results["fullname"];
    $user_mail = $results["email"];
    $user_phone = $results["phone"];
    $mail_status = $results["mail_status"];
    $activation_code = $results['activation_code'];
    // zaten aktifse burada ne işi var?
    if ($_SESSION['dashboardUserStatus'] == 1) {
        header("Location: https://www.okul.pwc.com.tr/");
        exit();
    }
    //kullanıcıya hiç code gönderilmemişse ve bu sayfada ise code gönder
    if ($_SESSION['dashboardUserStatus'] != 1 && $activation_code == '') {
        $onayKodu = crc16($email . bin2hex(openssl_random_pseudo_bytes(5)) . time());
        if (!$user_mail) {
            $db->where('phone', $_SESSION['dashboardUserPhone']);
        } else {
            $db->where('email', $_SESSION['dashboardUser']);

        }
        $dbCode = $db->update('web_user', array('activation_code' => $onayKodu));
        if ($dbCode) {
            if (!$user_mail) {
                $db->where('phone', $_SESSION['dashboardUserPhone']);
            } else {
                $db->where('email', $_SESSION['dashboardUser']);

            }
            $results = $db->get('web_user');

            $telefon = preg_replace("/[^0-9]/", "", $user_phone);
            //
            $xml_data = "<MainmsgBody>
                    <Command>0</Command>
                    <PlatformID>1</PlatformID>
                    <ChannelCode>581</ChannelCode>
                    <UserName>pwcbss</UserName>
                    <PassWord>Dty1HF4t</PassWord>
                    <Mesgbody>Sayin $user_name, $onayKodu dogrulama kodu ile giris yapabilirsiniz.</Mesgbody>
                    <Numbers>$telefon</Numbers>
                    <Type>1</Type>
                    <Concat>1</Concat>
                    <Originator>PWC TURKIYE</Originator>
                    <SDate></SDate>
                   </MainmsgBody>";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://processor.smsorigin.com/xml/process.aspx');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            //dönen değer ID
            if (strpos($response, "ID") !== false) {
                $_SESSION['dashboardUser'] = $user_mail;
                $db->where('email', $_SESSION['dashboardUser']);
                $results = $db->get('web_user');
                foreach ($results as $value) {
                    $_SESSION['dashboardUserName'] = $value['fullname'];
                    $_SESSION['dashboardUserId'] = $value['id'];
                    $_SESSION['dashboardUserPhone'] = $value['phone'];
                }
                $dataLogon = array('last_login_date' => $db->now(), 'expression_time' => $db->now());
                $db->where('email', $_SESSION['dashboardUser']);
                $idLogon = $db->update('web_user', $dataLogon);
            }
            // cURL'ü kapat
            curl_close($ch);
        }
    }
    ?>

    <section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
        <div class="basliklar">
            <div class="baslik">HESAP DOĞRULAMA</div>
            <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
                    <meta itemprop="position" content="1" />
                </li>
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="#"><span itemprop="name">Hesap Doğrulama</span></a>
                    <meta itemprop="position" content="2" />
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
                                    <form method="post" class="girisform" id="verify_user_otp"
                                        onsubmit="javascript: void(0);">
                                        <div class="baslik">
                                            <b>SMS Doğrulama</b>
                                        </div>
                                        <p>Lütfen, <b>

                                                <?php
                                                $telefon = preg_replace("/[^0-9]/", "", $user_phone);
                                                $filterPhone = substr($telefon, -4);
                                                echo "*******" . $filterPhone;

                                                ; ?>
                                            </b> numaralı telefona yollanan şifreyi giriniz.<br />
                                            <small>İşlemleri iptal etmek istiyorsanız, <a href="hatali-mail.php"
                                                    onclick="return confirm('Emin misiniz?')">bu linke
                                                    tıklayınız.</a></small>

                                        </p>
                                        <input type="hidden" name="redirect_url" id="redirect_url"
                                            value="turquality-ve-ihracat-tesvikleri-webcast-18022021-1400">

                                        <div class="label-div2">
                                            <label for="pass">Şifre*</label>
                                            <input type="text" name="otp" value="" id="pass" required="">
                                            <small>Doğrulama kodunuzun geçerlilik süresi 2 dakikadır.</small>

                                        </div>

                                        <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                                onclick="return verify_user_otp();"><span>Doğrula</span></a>
                                        </div>
                                        <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                                onclick="return verify_user_otp_resend();"><span>Tekrar şifre iste</span>
                                            </a>
                                        </div>

                                        <hr>
                                        <?php $db->where('email', $_SESSION['dashboardUser']);
                                        $result = $db->getOne('web_user');
                                        if ($result['sms_update_remaining'] == 1) {

                                            ?>
                                            <small>Sevgili
                                                <?php echo $_SESSION['dashboardUserName'] ?>,kayıtlı telefon numaranızı
                                                değiştirmek istiyorsanız <a href="javascript:;"
                                                    onclick="verify_user_otp_hide_form();"><strong> bu linke
                                                        tıklayınız.</strong></a>

                                            </small>
                                        <?php } else {

                                            ?>
                                            <small>Üyelik girişi ile ilgili problem yaşıyorsanız<a
                                                    href="mailto:egitim@tr.pwc.com?Subject=Telefon numaramı güncellemek istiyorum "><strong>
                                                        tıklayınız.</strong></a></small>
                                        <?php } ?>
                                        <div>

                                        </div>
                                    </form>
                                    <!-- TELEFON NUMARASI GÜNCELLEME EKRANI -->
                                    <form method="post" class="girisform" id="login_phone_update_screen"
                                        onsubmit="javascript: void(0);">
                                        <div class="baslik">
                                            <b>Telefon Numarası Güncelle</b>
                                        </div>
                                        <p>Lütfen, <b>
                                                <?php
                                                $telefon = preg_replace("/[^0-9]/", "", $user_phone);
                                                $filterPhone = substr($telefon, -4);
                                                ; ?>
                                            </b>güncellemek istediğiniz telefon numaranızı giriniz.<br />
                                            <small>İşlemleri iptal etmek istiyorsanız, <a href="hatali-mail.php"
                                                    onclick="return confirm('Emin misiniz?')">bu linke
                                                    tıklayınız.</a></small>

                                        </p>


                                        <div class="label-div2">
                                            <label for="telefon">Telefon*</label>
                                            <input type="tel" name="telefon" value="" id="telefon" required />
                                        </div>

                                        <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                                onclick="return login_phone_update_screen();"><span>Güncelle</span></a>
                                        </div>
                                    </form>
                                    <!-- TELEFON NUMARASI GÜNCELLEME EKRANI -BİTİŞ -->
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#login_phone_update_screen').hide();
                $("#verify_user_otp").show();

            });
            //tıklandıgında açtık
            function verify_user_otp_hide_form() {
                $("#verify_user_otp").hide();
                $("#login_phone_update_screen").show();
            }
        </script>
    </section>

    <?php
}
// kullanıcı üye oldan geliyorsa
else if ($_SESSION['dashboardUser'] == "uyeol_step1") {

    // $_SESSION['dashboardUser'] değeri telefon numarası ile üye oldan geliyorsa , veya loginden geliyorsa.
    // veritabanından aktif olup olmadığını öğreniyoruz

    $db->where('phone', $_SESSION['dashboardUserPhone']);
    $results = $db->getOne('web_user');


    // kullanıcının isim ve mail bilgilerini çekelim
    $user_name = $results["fullname"];
    $user_mail = $results["email"];
    $user_phone = $results["phone"];
    $mail_status = $results["mail_status"];
    $activation_code = $results['activation_code'];
    // zaten aktifse burada ne işi var?
    if ($_SESSION['dashboardUserStatus'] == 1) {
        header("Location: https://www.okul.pwc.com.tr/");
        exit();
    }

    //kullanıcıya hiç code gönderilmemişse ve bu sayfada ise code gönder
    if ($_SESSION['dashboardUserStatus'] != 1 && $activation_code == '') {
        $onayKodu = crc16($email . bin2hex(openssl_random_pseudo_bytes(5)) . time());
        $db->where('phone', $_SESSION['dashboardUserPhone']);
        $dbCode = $db->update('web_user', array('activation_code' => $onayKodu));
        if ($dbCode) {
            $db->where('phone', $_SESSION['dashboardUserPhone']);
            $results = $db->get('web_user');

            $telefon = preg_replace("/[^0-9]/", "", $user_phone);
            //
            $xml_data = "<MainmsgBody>
                    <Command>0</Command>
                    <PlatformID>1</PlatformID>
                    <ChannelCode>581</ChannelCode>
                    <UserName>pwcbss</UserName>
                    <PassWord>Dty1HF4t</PassWord>
                    <Mesgbody>Sayin $user_name, $onayKodu dogrulama kodu ile giris yapabilirsiniz.</Mesgbody>
                    <Numbers>$telefon</Numbers>
                    <Type>1</Type>
                    <Concat>1</Concat>
                    <Originator>PWC TURKIYE</Originator>
                    <SDate></SDate>
                   </MainmsgBody>";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://processor.smsorigin.com/xml/process.aspx');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            //dönen değer ID
            if (strpos($response, "ID") !== false) {
                $db->where('phone', $_SESSION['dashboardUserPhone']);
                $results = $db->get('web_user');
                foreach ($results as $value) {
                    $_SESSION['dashboardUserName'] = $value['fullname'];
                    $_SESSION['dashboardUserId'] = $value['id'];
                    $_SESSION['dashboardUserPhone'] = $value['phone'];
                }
                $dataLogon = array('last_login_date' => $db->now(), 'expression_time' => $db->now());
                $db->where('phone', $_SESSION['dashboardUserPhone']);
                $idLogon = $db->update('web_user', $dataLogon);
            }
            // cURL'ü kapat
            curl_close($ch);
        }
    }
    ?>
        <section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
            <div class="basliklar">
                <div class="baslik">HESAP DOĞRULAMA</div>
                <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="#"><span itemprop="name">Hesap Doğrulama</span></a>
                        <meta itemprop="position" content="2" />
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
                                        <form method="post" class="girisform" id="verify_user_otp"
                                            onsubmit="javascript: void(0);">
                                            <div class="baslik">
                                                <b>SMS Doğrulama</b>
                                            </div>
                                            <p>Lütfen, <b>
                                                    <?php
                                                    $telefon = preg_replace("/[^0-9]/", "", $user_phone);
                                                    $filterPhone = substr($telefon, -4);
                                                    echo "*******" . $filterPhone;

                                                    ; ?>
                                                </b> numaralı telefona yollanan şifreyi giriniz.<br />
                                                <small>İşlemleri iptal etmek istiyorsanız, <a href="hatali-mail.php"
                                                        onclick="return confirm('Emin misiniz?')">bu linke
                                                        tıklayınız.</a></small>

                                            </p>
                                            <input type="hidden" name="redirect_url" id="redirect_url"
                                                value="turquality-ve-ihracat-tesvikleri-webcast-18022021-1400">

                                            <div class="label-div2">
                                                <label for="pass">Şifre*</label>
                                                <input type="text" name="otp" value="" id="pass" required="">
                                                <small>Doğrulama kodunuzun geçerlilik süresi 2 dakikadır.</small>
                                            </div>

                                            <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                                    onclick="return verify_user_otp();"><span>Doğrula</span></a>

                                            </div>
                                            <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                                    onclick="return verify_user_otp_resend();"><span>Tekrar şifre iste</span>
                                                </a>
                                            </div>

                                            <hr>
                                            <!-- <small>Sistemimizde kayıtlı telefon numaranızı değiştirmek istiyorsanız <a
                                                href="javascript:;" onclick="verify_user_otp_hide_form();"><strong> bu linke
                                                    tıklayınız.</strong></a></small>
                                                    <small>Sistemimizde kayıtlı telefon numaranızı değiştirmek istiyorsanız<a
                                                href="mailto:egitim@tr.pwc.com?Subject=Telefon numaramı güncellemek istiyorum " onclick="verify_user_otp_hide_form();"><strong> bu linke
                                                    tıklayınız.</strong></a></small> -->
                                            <div>

                                            </div>
                                        </form>
                                        <!-- TELEFON NUMARASI GÜNCELLEME EKRANI -->
                                        <!-- <form method="post" class="girisform" id="login_phone_update_screen"
                                        onsubmit="javascript: void(0);">
                                        <div class="baslik">
                                            <b>Telefon Numarası Güncelle</b>
                                        </div>
                                        <p>Lütfen, <b>
                                                <?php
                                                $telefon = preg_replace("/[^0-9]/", "", $user_phone);
                                                $filterPhone = substr($telefon, -4);
                                                ; ?>
                                            </b>güncellemek istediğiniz telefon numaranızı giriniz.<br />
                                            <small>İşlemleri iptal etmek istiyorsanız, <a href="hatali-mail.php"
                                                    onclick="return confirm('Emin misiniz?')">bu linke
                                                    tıklayınız.</a></small>

                                        </p>
                                      

                                        <div class="label-div2">
                                            <label for="telefon">Telefon*</label>
                                            <input type="tel" name="telefon" value="" id="telefon" required />
                                        </div>

                                        <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                                onclick="return login_phone_update_screen();"><span>Güncelle</span></a>
                                        </div>
                                    </form> -->
                                        <!-- TELEFON NUMARASI GÜNCELLEME EKRANI -BİTİŞ -->
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
} else if (($_SESSION['dashboardUser'] == "uyeol_step2" && $_SESSION['dashboardTamamlanmısUye'] == 0)) {
    $db->where('phone', $_SESSION['dashboardUserPhone']);
    $result = $db->getOne('web_user');
    $fullname = $result['fullname'];
    $phone = $result['phone'];
    ?>
            <section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
                <div class="basliklar">
                    <div class="baslik">ÜYE İŞLEMLERİ</div>
                    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="#"><span itemprop="name">Anasayfa</span></a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="#"><span itemprop="name">Üye İşlemleri</span></a>
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </div>
            </section>
            <section class="ortakisim">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div id="signFormDiv">
                                <form id="sign_form_step2" method="post" class="girisform" onsubmit="return sign_send_step2();">
                                    <div class="signFormList" style="text-align:left">
                                    </div>
                                    <div class="baslik">
                                        <b>Hoş Geldin <strong style="color:red">
                                        <?php echo $fullname ?>
                                            </strong> </b>
                                    </div>
                                    <input type="hidden" name="redirect_url" id="redirect_url"
                                        value="<?php echo $redirect_url; ?>" />
                                    <!-- <div class="label-div2">
                                <label for="adsoyad">Ad Soyad*</label>
                                <input type="text" name="adsoyad" value=<?php echo $fullname ?> id="adsoyad" required />
                            </div> -->
                                    <div class="label-div2">
                                        <label for="Unvan">Unvan*</label>
                                        <input type="text" name="unvan" id="unvan" value="" />
                                    </div>
                                    <div class="label-div2">
                                        <label for="Firma">Firma Adı*</label>
                                        <input type="text" name="firma" id="firma" value="" />
                                    </div>
                                    <!-- <div class="label-div2">
                                <label for="telefon">Telefon*</label>
                                <input type="tel" name="telefon" value=<?php echo $phone ?> id="telefon" required />
                            </div> -->
                                    <input type="hidden" name="redirect_url_after_verify"
                                        value="<?php echo $redirect_url_after_verify; ?>" />
                                    <div class="label-div2">
                                        <label for="email">E-Posta*</label>
                                        <input type="email" name="email" value="" id="email" required />
                                    </div>
                                    <div class="label-div2">
                                        <label for="sifre">Şifre*</label>
                                        <input type="password" name="sifre" id="sifre" value="" required />
                                    </div>
                                    <div class="label-div2">
                                        <label for="sifre2">Şifre Tekrar*</label>
                                        <input type="password" name="sifre2" id="sifre2" value="" required />
                                    </div>

                                    <div class="label-div2 temizle" style="display: flex; flex-direction: column;">
                                        <span class="checkbox-div">
                                            <input class="magic-checkbox" type="checkbox" id="pwc_calisaniyim" name="pwc_calisaniyim" required />
                                            <label for="pwc_calisaniyim" style="font-size:13px; float:left">
                                            <a 
                                             style="text-decoration:underline !important">Eski PwC Çalışanıyım</a> 
                                            </label>
                                        </span>
                                        <span class="checkbox-div">
                                            <input class="magic-checkbox" type="checkbox" id="sozlesme" name="sozlesme" required />
                                            <label for="sozlesme" style="font-size:13px; float:left"><a href="uyelik-sozlesmesi"
                                                    target="_blank" style="text-decoration:underline !important">Üyelik
                                                    Sözleşmesi'ni</a> okudum, onaylıyorum.</label>
                                        </span>

                                        <span class="checkbox-div">
                                            <input class="magic-checkbox" type="checkbox" id="aydinlatma" name="aydinlatma"
                                                required />
                                            <label for="aydinlatma" style="font-size:13px; float:left"><a href="aydinlatma-metni"
                                                    target="_blank" style="text-decoration:underline !important">Aydınlatma
                                                    Metni'ni</a> okudum,anladım ve <a href="acik-riza-metni" target="_blank"
                                                    style="text-decoration:underline !important">Açık Rıza Metni'ni</a>
                                                onaylıyorum.</label>
                                        </span>
                                    </div>
                                    <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                            onclick="return sign_send_step2();"><span>Üyeliğimi Oluştur</span></a></div>
                                    <p style='font-size:11px; float:left; text-align:left'>Kişisel verileriniz, <a
                                            href="aydinlatma-metni" target="_blank"
                                            style="text-decoration:underline !important">Aydınlatma Metni</a> kapsamında
                                        işlenmektedir. Üyeliğimi oluştur butonuna basarak <a href="uyelik-sozlesmesi"
                                            target="_blank" style="text-decoration:underline !important">Üyelik Sözleşmesi</a>’ni,
                                        <a href="acik-riza-metni" target="_blank" style="text-decoration:underline !important">Açık
                                            Rıza Metni</a>’ni, <a
                                            href="https://www.pwc.com.tr/tr/hakkimizda/kisisel-verilerin-korunmasi.html"
                                            target="_blank" style="text-decoration:underline !important">Gizlilik ve Çerez
                                            Politikası</a>’nı okuduğunuzu ve kabul ettiğinizi onaylıyorsunuz.
                                    </p>

                                </form>
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