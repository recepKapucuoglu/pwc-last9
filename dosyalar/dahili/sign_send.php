<?php
require_once("inc.php");

require __DIR__ . "/otp_function.php";
$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$tebrik_mesaj = '<div class="alert alert-success"><strong>Teşekkürler!</strong> Üyeliğiniz başarıyla gerçekleşmiştir. E-posta adrsine gönderilen doğrulama kodunu onaylayınız. <a href="/uyelik">Sisteme Giriş Yapmak için tıklayınız.</a> </div><script>document.getElementById("sign_form").reset();</script>';

if ($_POST['adsoyad']) {
    $_SESSION['dashboardUserStatus'] = 0; //login durumu 0
    $incoming_url = valueClear($_POST['incoming_url']);
    $adsoyad = valueClear($_POST['adsoyad']);
    $email = valueClear($_POST['email']);
    $redirect_url = valueClear($_POST['redirect_url']);
    $telefonNumber = valueClear($_POST['telefon']);
    // Sadece numaraları filtrele  -uygun format
    $telefon = preg_replace("/[^0-9]/", "", $telefonNumber);
    //
    $sifre = valueClear($_POST['sifre']);
    $sifre2 = valueClear($_POST['sifre2']);
    $firma = valueClear($_POST['firma']);
    $unvan = valueClear($_POST['unvan']);
    $notification = valueClear($_POST['notification']);
    $redirect_after_verify = (isset($_POST["redirect_url_after_verify"])) ? valueClear($_POST["redirect_url_after_verify"]) : "https://www.okul.pwc.com.tr";
    $redirect_after_verify = base64_encode($redirect_after_verify);
    if ($sifre <> $sifre2) {
        echo '<div class="alert alert-danger">Girmiş olduğunuz şifreler birbirleriyle eşleşmiyor. </div>';
        die();
    } else {
        if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $sifre)) {
            $db->where('email', $email);
            $total = $db->getValue('web_user', "count(id)");
            $db->where('phone', $telefonNumber);
            $total2 = $db->getValue('web_user', "count(id)");
            if ($total > 0 || $total2 > 0) {
                echo '<div class="alert alert-danger">Girmiş olduğunuz bilgiler ile sistemde kayıtlı kullanıcı bulunmaktadır. Şifrenizi unuttuysanız, <a href="/sifremi-unuttum" class="sifreunuttum" style="font-weight:bold;">Tıklayınız</a>. </div>';
                die();
            } else {
                // Onay Kodu Oluşturuyoruz.
                $onayKodu = crc16($email . $sifre . time());

                $onayKoduMail = crc16($email . bin2hex(openssl_random_pseudo_bytes(5)) . time());
                ;

                $data = array(
                    'id' => NULL,
                    'fullname' => $adsoyad,
                    'email' => $email,
                    'password' => webPasswordHash($sifre),
                    'company' => $firma,
                    'title' => $unvan,
                    'activation_code' => $onayKodu,
                    'activation_code_mail' => $onayKoduMail,
                    'status' => 0,
                    'mail_status' => 0,
                    'phone' => $telefonNumber,
                    'notification' => $notification,
                    "redirect_after_verify" => $redirect_after_verify,
                    'created_date' => $db->now()
                );
                $id = $db->insert('web_user', $data);
                if ($id) {
                    $sph_id = savePasswordHistory($email, $sifre);
                    $getdata = http_build_query(
                        array('adsoyad' => $adsoyad, 'code' => $onayKoduMail)
                    );

                    $opts = array(
                        'http' =>
                        array(
                            'method' => 'POST',
                            'content' => $getdata
                        )
                    );

                    $context = stream_context_create($opts);

                    $body = file_get_contents('http://www.okul.pwc.com.tr/dosyalar/dahili/template/uyelik_dogrulama.php?', false, $context);
                    if ($incoming_url == "login-redirect") {
                        require_once("libs/class.phpmailer.php");
                        require("libs/class.smtp.php");
                        require("libs/class.pop3.php");

                        // Mail Gönderme
                        $mail = new PHPMailer;
                        $mail->IsSMTP();
                        //bireysel
                        $mail->Host = "smtp.gmail.com";
                        $mail->Username = "rkapucuoglu@socialthinks.com";
                        $mail->Password = 'Recep8990.';
                        $mail->SMTPAuth = true;
                        $mail->Port = 587;
                        //prod
                        // // used only when SMTP requires authentication
                        // //$mail->SMTPAuth = true;
                        // $mail->Host = "10.9.18.5";
                        // $mail->Username = 'egitim@pwc.com.tr';
                        // $mail->Password = '';
                        // $mail->SMTPAuth = false;
                        // $mail->SMTPAutoTLS = false;
                        // $mail->Port = 25;

                        $mail->CharSet = 'utf-8';
                        $mail->setFrom('egitim@pwc.com.tr', 'Business School');

                        $mail->AddAddress($email);
                        // Name is optional
                        $mail->addReplyTo('egitim@pwc.com.tr', 'Business School');
                        $mail->setLanguage('tr', '/language');

                        // Set email format to HTML
                        $mail->Subject = 'Business School - Hesabınızı Doğrulayın';
                        $mail->msgHTML($body);
                        if ($mail->send()) {

                        } else {
                            echo $hata_mesaj . " - Mail Gönderilemedi.";

                        }
                    }

                    //SMS GÖNDERME EKRANI
                    $xml_data = "<MainmsgBody>
                    <Command>0</Command>
                    <PlatformID>1</PlatformID>
                    <ChannelCode>581</ChannelCode>
                    <UserName>pwcbss</UserName>
                    <PassWord>Dty1HF4t</PassWord>
                    <Mesgbody>Sayin $adsoyad, $onayKodu dogrulama kodu ile giris yapabilirsiniz.</Mesgbody>
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
                        $_SESSION['dashboardUser'] = $email;
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
                        $random = (time());
                        $dogrula = "https://www.okul.pwc.com.tr/uyelik-dogrulama.php?otp=$random";
                        if ($idLogon)
                            echo "<script language='JavaScript'>location.href='$dogrula'</script>";
                        else {
                            echo $hata_mesaj;
                        }
                    } else {
                        echo $hata_mesaj . " - Sms Gönderilemedi.";
                    }
                    // cURL'ü kapat
                    curl_close($ch);
                } else
                    echo $hata_mesaj;
            }

        } else {
            echo '<div class="alert alert-danger">• Şifreniz en az 8 karakter uzunluğunda olmalı, <br/>• Büyük/küçük harf, rakam veya özel karakter içermelidir.</div>';
            die();
        }
    }
} else {
    echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>';
}