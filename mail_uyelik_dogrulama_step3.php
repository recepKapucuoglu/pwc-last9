<?php

require __DIR__ . '/dosyalar/dahili/header.php';
require __DIR__ . '/dosyalar/dahili/libs/class.phpmailer.php';
require __DIR__ . '/dosyalar/dahili/libs/class.smtp.php';
require __DIR__ . '/dosyalar/dahili/libs/class.pop3.php';
require __DIR__ . '/dosyalar/dahili/otp_function.php';


// mail ekranını sessionundaysa izin ver
    if ($_SESSION['dashboardStep3MailEkranı'] == 1){
        $db->where('phone',$_SESSION['dashboardUserPhone']);
        $res=$db->getOne('web_user');
        $mail_status=$res['mail_status'];
        if($mail_status == 1){
            header("Location: https://www.okul.pwc.com.tr/");
            exit();
        }
    
    // veritabanından aktif olup olmadığını öğreniyoruz
    $db->where('email', $_SESSION['dashboardUser']);
    $results = $db->getOne('web_user');
    // kullanıcının zaten aktif olup olmadığını öğrenelim.
    $isActive = $results["status"];
    // kullanıcının isim ve mail bilgilerini çekelim
    $user_name = $results["fullname"];
    $user_mail = $results["email"];
    $user_phone = $results["phone"];
    $mail_status=$results["mail_status"]; 
    $activation_code_mail=$results["activation_code_mail"]; 
    $secure_mail = $_SESSION["dashboardUser"];
    //mail gönder
    if(!$mail_status && !$activation_code_mail){ //daha önce mail gitmemişse ve maili aktif edilmemişse
	// Mail Gönderme 
    $onayKodu = crc16($user_mail . bin2hex(openssl_random_pseudo_bytes(5)) . time());

    $getdata = http_build_query(
        array(
        'adsoyad' => $user_name, 
        'code' => $onayKodu
        )
    );

    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'content' => $getdata
        )
    );
    //mail gönderimi
    $context  = stream_context_create($opts);

    $body = file_get_contents('http://www.okul.pwc.com.tr/dosyalar/dahili/template/uyelik_dogrulama.php?', false, $context);

    $mail = new PHPMailer;
    $mail->IsSMTP();

    //bireysel
    $mail->Host = "smtp.gmail.com";
    $mail->Username = 'rkapucuoglu@socialthinks.com';
    $mail->Password = 'Recep8990.';
    $mail->SMTPAuth = true;
    $mail->Port = 587;

    // prod
    
    // $mail->Host = "10.9.18.5";
    // $mail->Username = 'egitim@pwc.com.tr';
    // $mail->Password = '';
    // $mail->SMTPAuth = false;
    // $mail->SMTPAutoTLS = false;
    // $mail->Port = 25;

    $mail->CharSet = 'utf-8';
    $mail->setFrom('egitim@pwc.com.tr', 'Business School');

    $mail->AddAddress($user_mail);
    // Name is optional
    $mail->addReplyTo('egitim@pwc.com.tr', 'Business School');
    $mail->setLanguage('tr', '/language');

    // Set email format to HTML
    $mail->Subject = 'Business School - Şifrenizi Sıfırlayın';
    $mail->msgHTML($body);

    if ($mail->send()) {
        $data = array('expression_time' => $db->now() , 'activation_code_mail' =>$onayKodu);
        $db->where('email', $user_mail);
        $updateExp = $db->update('web_user', $data);
        echo $tebrik_mesaj;
    } else {
        echo $hata_mesaj . " - Mail Gönderilemedi.";

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
                                    <div class="bildirim">
                                        
                                    </div>
                                    <form method="post" class="girisform" id="verify_user_otp_mail"
                                        onsubmit="javascript: void(0);">
                                        <div class="baslik">
								<b>Hoş Geldin <strong style="color:red"><?php echo $user_name ?></strong> </b>
                            </div>
                          
                                        <p>Lütfen, <b>
                                                <?php echo $secure_mail; ?>
                                            </b> adresine yollanan şifreyi giriniz.<br />
                                            <small>Tekrar şifre almak için , <a style="cursor:pointer;"
                                                    onclick="return verify_user_otp_resend_mail();">bu linke
                                                    tıklayınız.</a></small>
                                        </p>
                                        <input type="hidden" name="redirect_url" id="redirect_url"
                                            value="turquality-ve-ihracat-tesvikleri-webcast-18022021-1400">
                                        <div class="label-div2">
                                            <label for="pass">Şifre*</label>
                                            <input type="text" name="otp" value="" id="pass" required="">
                                        </div>
                                        <a href="/mail_uyelik_dogrulama_adımı_atla.php" style="color: red;
text-decoration: underline!important;
font-size: medium;
font-weight: bold;
padding-right: 5px; color:red">Bu adımı atla</a>
                                        <div class="bilgial buton renk2 button13"><a href="javascript:;"
                                                onclick="return verify_user_otp_mail();"><span>Doğrula</span></a>
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