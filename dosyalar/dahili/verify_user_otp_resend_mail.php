<?php
require_once("inc.php");
require __DIR__ . "/otp_function.php";
$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$tebrik_mesaj = '<div class="alert alert-success"><strong>Bilgilendirme!</strong> Doğrulama kodunuz e-mail adresinize numaranıza yeniden gönderilmiştir.</div>';
if(isset($_COOKIE['verifySent']) && $_COOKIE['verifySent'] == true)
{ 
    echo '<div class="alert alert-danger"><strong>Uyarı!</strong> 5 dakikada bir yeniden doğrulama kodu alabilirsiniz.</div>';
	exit();
}    
// kullanıcının oturum açıp açmadığını kontrol edelim
if ($_SESSION['dashboardUser']) {
    // yeni bir tane tek kullanımlık şifre oluştur.
    $uuid = crc16($_SESSION['dashboardUser'] .bin2hex(openssl_random_pseudo_bytes(5)). time());;
    // kullanıcı verilerini çek
    $db->where('email', $_SESSION['dashboardUser']);
    $user = $db->getOne('web_user');
    $user_name = $user["fullname"];
    $user_mail = $user["email"];
    $user_phone=$user["phone"];

    // kullanıcı verilerini güncelle
    $data = array('activation_code_mail' => $uuid);
    $db->where('email', $_SESSION['dashboardUser']);
    $id = $db->update('web_user', $data);

    // eğer aktivasyon kodu update edildiyse
    if($id){
        // mail at
        $getdata = http_build_query(
            array(
			'adsoyad' => $user_name, 
			'code' => $uuid
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

        require_once("libs/class.phpmailer.php");
        require("libs/class.smtp.php");
        require("libs/class.pop3.php");

        // Mail Gönderme
        $mail = new PHPMailer;
        $mail->IsSMTP();
        //Bireysel
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "rkapucuoglu@socialthinks.com";
        $mail->Password = 'Recep8990.';
        $mail->SMTPAuth = true;
        $mail->Port = 587;

        //Prod
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
        $mail->Subject = 'Business School - Hesabınızı Doğrulayın';
        $mail->msgHTML($body);
        if($mail->send()){
            $db->where("email",$_SESSION['dashboardUser']);          
           $update= $db->update('web_user',['expression_time' => $db->now()]);  
            if($update){
			setcookie("verifySent", true, time() + (60 * 3), "/");
            echo $tebrik_mesaj;}
        } else {
            echo $hata_mesaj . $mail->ErrorInfo;
        }
     //   phone gonderimi

        
    } else {
        echo $hata_mesaj;
    }
} else {
    header("Location: https://www.okul.pwc.com.tr/");
}