<?php
// crc16 sms token oluşturur.
// integer değer döndürür
require __DIR__ . "/otp_function.php";
require __DIR__ . "/inc.php";
require __DIR__ . "/libs/class.phpmailer.php";
require __DIR__ . "/libs/class.smtp.php";
require __DIR__ . "/libs/class.pop3.php";
$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$gonderildi_mesaj = '<div class="alert alert-success"><strong>Bilgilendirme!</strong> Doğrulama kodu email adresine tekrar gönderilmiştir.</div>';
if(isset($_COOKIE['verifySent']) && $_COOKIE['verifySent'] == true)
{
    echo '<div class="alert alert-danger"><strong>Uyarı!</strong> 5 dakikada bir yeniden doğrulama kodu alabilirsiniz.</div>';
    exit();
}
if (isset($_SESSION["sms_mail"])) {
    $sms_token = (string)crc16(uniqid(mt_rand(), true) . time());
    $getdata = http_build_query(
        array('code' => $sms_token)
    );
    $opts = array('http' =>
        array(
            'method' => 'POST',
            'content' => $getdata
        )
    );

    $context = stream_context_create($opts);

    $body = file_get_contents('https://www.okul.pwc.com.tr/dosyalar/dahili/template/maildogrulama.php?', false, $context);

    // Mail Gönderme
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
    $mail->setFrom('egitim@pwc.com.tr', 'Business School');

    $mail->AddAddress($_SESSION["sms_mail"]);
    // Name is optional
    $mail->addReplyTo('egitim@pwc.com.tr', 'Business School');
    $mail->setLanguage('tr', '/language');

    // Set email format to HTML
    $mail->Subject = 'Business School - Mail Adresinizi Doğrulayın';
    $mail->msgHTML($body);
    if ($mail->send()) {
        $_SESSION["sms_token"] = $sms_token;
        setcookie("verifySent", true, time() + (60 * 3), "/");
		echo $gonderildi_mesaj;
    }
} else {
    echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>';
}
