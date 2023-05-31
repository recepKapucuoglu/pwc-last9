<?php
require_once("inc.php");
//PHONE İÇİN GELEN KODUN DOGRULUNU KONTROL EDELİM
$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$tebrik_mesaj = '<div class="alert alert-success"><strong>Tebrikler!</strong> Kaydınız doğrulanmıştır, yönlendiriliyorsunuz.</div>';

// kullanıcının oturum açıp açmadığını kontrol edelim
//kullanıcı giriş yaptan gelmişse
if ($_SESSION['dashboardUser'] && $_SESSION['dashboardUser']!="uyeol_step1" && $_SESSION['dashboardUser']!="uyeol_step2") {
    //kullanıcının dogrulama kodu geçerlimi kontrol edelim.
    $db->where('email',$_SESSION['dashboardUser']);
	$db->where('expression_time >= NOW() - INTERVAL 2 MINUTE');
	$results = $db->get('web_user');
    // Kullanıcı login olduktan sonra en son kaldığı yere yönlendiriyoruz.
	foreach ($results as $row) {
		$isActive = $row['expression_time'];
        $last_page_url=$row['last_page_url'];
	}
    // eğer boşsa ya da null ise
    if (is_null($last_page_url) || empty($last_page_url)) {
        $last_page_url ="https://www.okul.pwc.com.tr/";
    }
    if($isActive!=null || $isActive!=""){ //kod geçerliyse
    // user tarafından gönderilen tek kullanımlık şifre [name="otp"]
    $actual = valueClear($_POST["otp"]);
    // veritabanında gerçek otp değerini çekiyoruz
    $db->where('email', $_SESSION['dashboardUser']);
    $results = $db->getOne('web_user');
    $expected = $results["activation_code"];
  
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
            $_SESSION['dashboardUserStatus']=1; //oturumu aktif ettik
             echo $tebrik_mesaj;
             // Kullanıcının son kaldığı yeri alıyoruz
            echo "<script> setTimeout(function(){
                window.location.href =`$last_page_url`;
             }, 100);</script>";
         

        } else {
            echo $hata_mesaj;
        }
    }
} 
else //kod geçersizse  
{
    echo '<div class="alert alert-danger">Doğrulama kodunun süresi dolmuştur. Lütfen Tekrar şifre iste butonundan yeni şifre isteyiniz.</div>';

}
} else if ($_SESSION['dashboardUser']=="uyeol_step1" || $_SESSION['dashboardTamamlanmısUye'] = 0){
        //kullanıcının dogrulama kodu geçerlimi kontrol edelim.
        $db->where('phone',$_SESSION['dashboardUserPhone']);
        $db->where('expression_time >= NOW() - INTERVAL 2 MINUTE');
        $results = $db->get('web_user');
        foreach ($results as $row) {
            $isActive = $row['expression_time'];
        }
        if($isActive!=null || $isActive!=""){ //kod geçerliyse
        // user tarafından gönderilen tek kullanımlık şifre [name="otp"]
        $actual = valueClear($_POST["otp"]);
        // veritabanında gerçek otp değerini çekiyoruz
        $db->where('phone', $_SESSION['dashboardUserPhone']);
        $results = $db->getOne('web_user');
        $expected = $results["activation_code"];
        // Kullanıcı login olduktan sonra en son kaldığı yere yönlendiriyoruz.
        $redirect_after_verify = base64_decode($results["redirect_after_verify"]);
        // eğer boşsa ya da null ise
        if (is_null($redirect_after_verify) || empty($redirect_after_verify)) {
            $redirect_after_verify ="https://www.okul.pwc.com.tr/dashboard.php";
        }
        // eğer bilgiler eşleşmiyorsa
        if ($actual != $expected) {
            echo '<div class="alert alert-danger"><strong>Uyarı!</strong> 
                    Girdiğiniz doğrulama kodu yanlış, lütfen tekrar deneyiniz.</div>';
        } else {
            // Kullanıcının doğrulandığını veritabanına işliyoruz...
            $_SESSION['dashboardUserStatus']=1; //oturumu aktif ettik
            $data = array('status' => 1, 'activation_code' => '');
            // Hangi kullanıcı olduğunu belirtiyoruz.
            $db->where('phone', $_SESSION['dashboardUserPhone']);
            // Kullanıcıyı güncelliyoruz.
            $id = $db->update('web_user', $data);
            // Başarılı olduysa
            if ($id) {
                $db->where('phone', $_SESSION['dashboardUserPhone']);
                $res=$db->getOne('web_user');
                $_SESSION['dashboardUserStatus']= $res['status']; //oturumu aktif ettik
                $_SESSION['dashboardUser']="uyeol_step2"; //2. adıma geçebilir aktif ettik
                $_SESSION['dashboardTamamlanmısUye'] = 0; //uye bilgileri doldurulmadıgı için 0

                 echo $tebrik_mesaj;
                 // Kullanıcının son kaldığı yeri alıyoruz
                echo "<script> setTimeout(function(){
                    window.location.href =`https://www.okul.pwc.com.tr/uyelik-dogrulama.php`;
                 }, 4000);</script>";
    
            } else {
                echo $hata_mesaj;
            }
        }
    } 
    else //kod geçersizse  
    {
        echo '<div class="alert alert-danger">Doğrulama kodunun süresi dolmuştur. Lütfen Tekrar şifre iste butonundan yeni şifre isteyiniz.</div>';
    
    }
}
else {
    header("Location: https://www.okul.pwc.com.tr/");
}