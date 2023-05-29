<?php
// crc16 sms token oluşturur.
// integer değer döndürür
function crc16($data)
 {
   $crc = 0xFFFF;
   for ($i = 0; $i < strlen($data); $i++)
   {
     $x = (($crc >> 8) ^ ord($data[$i])) & 0xFF;
     $x ^= $x >> 4;
     $crc = (($crc << 8) ^ ($x << 12) ^ ($x << 5) ^ $x) & 0xFFFF;
   }
   return $crc;
 }
	require_once("inc.php");

	$hata_mesaj =  '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';

	if($_POST['without_email']) {
        $without_email = valueClear($_POST['without_email']);
        $redirect_url = valueClear($_POST['redirect_url']);
        $db->where('email', $without_email);
        $total = $db->getValue('web_user', "count(id)");
        if ($total > 0) {
            echo '<div class="alert alert-danger">Girmiş olduğunuz bilgiler ile sistemde kayıtlı kullanıcı bulunmaktadır. Şifrenizi unuttuysanız, <a href="/sifremi-unuttum" class="sifreunuttum" style="font-weight:bold;">Tıklayınız</a>. </div>';
            die();
        } else {
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

            require_once("libs/class.phpmailer.php");
            require("libs/class.smtp.php");
            require("libs/class.pop3.php");

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

            $mail->AddAddress($without_email);
            // Name is optional
            $mail->addReplyTo('egitim@pwc.com.tr', 'Business School');
            $mail->setLanguage('tr', '/language');

            // Set email format to HTML
            $mail->Subject = 'Business School - Mail Adresinizi Doğrulayın';
            $mail->msgHTML($body);
            if ($mail->send()) {
                //$_SESSION['withoutEmail']=$without_email;
                $_SESSION["sms_token"] = $sms_token;
                $_SESSION["sms_mail"] = $without_email;
                if ($redirect_url <> ""){
                    echo "<script language=\"JavaScript\">location.href=\"/mail-dogrulama.php?redirect-url=/" . $redirect_url . "\";</script>";
				}
                else {
                    echo "<script language=\"JavaScript\">location.href=\"/\";</script>";
				}
            }

        }
    }else {
		echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>';
	}
