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
    $expected = $results["activation_code"];

    // Kullanıcı login olduktan sonra en son kaldığı yere yönlendiriyoruz.
    $redirect_after_verify = base64_decode($results["redirect_after_verify"]);
    // eğer boşsa ya da null ise
    if (is_null($redirect_after_verify) || empty($redirect_after_verify)) {
        $redirect_after_verify = "https://www.okul.pwc.com.tr";
    }
    // eğer bilgiler eşleşmiyorsa
    if ($actual != $expected) {
        echo '<div class="alert alert-danger"><strong>Uyarı!</strong> 
                Girdiğiniz doğrulama kodu yanlış, lütfen tekrar deneyiniz.</div>';
    } else {
        // Kullanıcının doğrulandığını veritabanına işliyoruz...
        $data = array('status' => 1, 'activation_code' => '');
        // Hangi kullanıcı olduğunu belirtiyoruz.
        $db->where('email', $_SESSION['dashboardUser']);
        // Kullanıcıyı güncelliyoruz.
        $id = $db->update('web_user', $data);
        // Başarılı olduysa
        if ($id) {
            echo $tebrik_mesaj;
            // Kullanıcının son kaldığı yeri alıyoruz
            echo "<script language='JavaScript'>location.href='$redirect_after_verify';</script>";
        } else {
            echo $hata_mesaj;
        }
    }
} else {
    header("Location: https://www.okul.pwc.com.tr/");
}