<?php
require_once("inc.php");
$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$tebrik_mesaj = '<div class="alert alert-success"><strong>Tebrikler!</strong> Kaydınız doğrulanmıştır, yönlendiriliyorsunuz.</div>';
// kullanıcının oturum açıp açmadığını kontrol edelim
if ($_SESSION['dashboardUser']) {
    
    
    // user tarafından gönderilen tek kullanımlık şifre [name="otp"]
    $actual = valueClear($_POST["otp"]);
    // veritabanında gerçek otp değerini çekiyoruz
    $db->where('email', $_SESSION['dashboardUser']);
    $results = $db->getOne('web_user');
    $expected = $results["activation_code_mail"];
    // Kullanıcı login olduktan sonra en son kaldığı yere yönlendiriyoruz.
    $redirect_after_verify = base64_decode($results["redirect_after_verify"]);
    // eğer boşsa ya da null ise
    if (is_null($redirect_after_verify) || empty($redirect_after_verify)) {
        $redirect_after_verify = "https://www.okul.pwc.com.tr";
    }
    // eğer bilgiler eşleşmiyorsa
    if (($actual != $expected) || ($actual == "")) {
        echo '<div class="alert alert-danger"><strong>Uyarı!</strong> 
                Girdiğiniz doğrulama kodu yanlış, lütfen tekrar deneyiniz.</div>';
    }
    // // else if ($actual == "" ) {
    // //     echo '<div class="alert alert-danger"><strong>Uyarı!</strong> 
    // //             Girdiğiniz doğrulama kodu yanlış, lütfen tekrar deneyiniz.</div>';
    // // }
    else {
        $db->where('email',$_SESSION['dashboardUser']);
        $db->where('expression_time >= NOW() - INTERVAL 3 MINUTE');
        $results = $db->get('web_user');
        foreach ($results as $row) {
            $isActive = $row['expression_time'];
        }
        if($isActive!=null || $isActive!=""){ //kod geçerliyse
        
        // Kullanıcının doğrulandığını veritabanına işliyoruz...
        $data = array('mail_status' => 1, 'activation_code_mail' => '');
        // Hangi kullanıcı olduğunu belirtiyoruz.
        $db->where('email', $_SESSION['dashboardUser']);
        // Kullanıcıyı güncelliyoruz.
        $id = $db->update('web_user', $data);
        // Başarılı olduysa
        if ($id) {
            echo $tebrik_mesaj;
            
            $_SESSION['dashboardStep3MailEkranı']=0; 

            // Kullanıcının son kaldığı yeri alıyoruz
            echo "<script language='JavaScript'>location.href='dashboard.php';</script>";
        } else {
            echo $hata_mesaj;
        }
    }
    else {
        echo '<div class="alert alert-danger"><strong>Uyarı!</strong> 
                Girdiğiniz doğrulama kodunun geçerlilik süresi dolmuştur, lütfen tekrar kod alınız.</div>';
    }
}
} else {
    header("Location: https://www.okul.pwc.com.tr/");
}