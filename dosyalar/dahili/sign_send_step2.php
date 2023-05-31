<?php
    error_reporting(E_ALL);
require_once("inc.php");

require __DIR__ . "/otp_function.php";
$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$tebrik_mesaj = '<div class="alert alert-success"><strong>Teşekkürler!</strong> Üyeliğiniz başarıyla gerçekleşmiştir. E-posta adrsine gönderilen doğrulama kodunu onaylayınız. <a href="/uyelik">Sisteme Giriş Yapmak için tıklayınız.</a> </div><script>document.getElementById("sign_form").reset();</script>';

if ($_POST['email']) {
    $_SESSION['dashboardTamamlanmısUye']=0;
    $_SESSION['dashboardUserStatus'] = 1; //login durumu 0
    $incoming_url = valueClear($_POST['incoming_url']);
    // $adsoyad = valueClear($_POST['adsoyad']);
    $email = valueClear($_POST['email']);
    $redirect_url = valueClear($_POST['redirect_url']);
    // $telefonNumber = valueClear($_POST['telefon']);
    $telefonNumber = $_SESSION['dashboardUserPhone'];
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
         
            if ($total > 0 ) {
                echo '<div class="alert alert-danger">Girmiş olduğunuz bilgiler ile sistemde kayıtlı kullanıcı bulunmaktadır. Şifrenizi unuttuysanız, <a href="/sifremi-unuttum" class="sifreunuttum" style="font-weight:bold;">Tıklayınız</a>. </div>';
                die();
            } else {
                $data = array(
                    'email' => $email,
                    'password' => webPasswordHash($sifre),
                    'company' => $firma,
                    'title' => $unvan,
                    'status' => 1,
                    'mail_status' => 0,
                    'phone' => $telefonNumber,
                    'notification' => $notification,
                    "redirect_after_verify" => $redirect_after_verify,
                    'last_login_date' => $db->now()
                );
                $db->where('phone', $telefonNumber);
                $id = $db->update('web_user', $data);
                if ($id) {
                    $sph_id = savePasswordHistory($email, $sifre);

                        $_SESSION['dashboardUserStatus']=1;
                        $_SESSION['dashboardTamamlanmısUye']=1;
                        $_SESSION['dashboardStep3MailEkranı']=1; 

                        // $_SESSION['dashboardUser'] = $email;
                        $db->where('phone', $telefonNumber);
                        $results = $db->get('web_user');
                        foreach ($results as $value) {
                            $_SESSION['dashboardUserName'] = $value['fullname'];
                            $_SESSION['dashboardUserId'] = $value['id'];
                            $_SESSION['dashboardUserPhone'] = $value['phone'];
                            $_SESSION['dashboardUser'] = $value['email'];
                            $_SESSION['dashboardUserStatus']=$value['status'];
                        }
                        $dataLogon = array('last_login_date' => $db->now(), 'expression_time' => $db->now());
                        $db->where('phone', $telefonNumber);
                        $idLogon = $db->update('web_user', $dataLogon);
                        $random = (time());
                        $dogrula = "https://www.okul.pwc.com.tr/mail_uyelik_dogrulama_step3.php";

                        if ($idLogon)
                            echo "<script language='JavaScript'>location.href='$dogrula'</script>";
                        else {
                            echo $hata_mesaj;
                        }                  
                } else
                    echo $hata_mesaj;
            }

        } else {
            echo '<div class="alert alert-danger">• Şifreniz en az 10 karakter uzunluğunda olmalı, <br/>• Büyük/küçük harf, rakam veya özel karakter içermelidir.</div>';
            die();
        }
    }
} else {
    echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>';
}

