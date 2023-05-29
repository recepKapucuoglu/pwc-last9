<?php
require_once("inc.php");
if ($_SESSION['dashboardUser']) {
    $_SESSION['dashboardUserStatus']=0;
    // user tarafından gönderilen telefon numarası [name="telefon"]
    $telefon = valueClear($_POST["telefon"]);
    $db->where('phone', $telefon);
    $total = $db->getValue('web_user', "count(id)");
    if ($total < 1 ) { //girilen telefon numarası  eskisiyle aynı değilse
        //telefon numarasını güncelleyelim
        $data = array('phone' => $telefon, 'last_login_date' => $db->now(),'status'=>0,'sms_update_remaining'=>0);
        $db->where('email', $_SESSION['dashboardUser']);
        $update = $db->update('web_user', $data);
        if ($update) {
            $_SESSION['dashboardUserPhone'] = $telefon;
            echo '<div class="alert alert-success"><strong>TEBRİKLER!</strong>. Telefon numaranız başarıyla güncellenmiştir.Güncellediğiniz telefon numaranız ile giriş yapabilirsiniz.Yönlendiriliyorsunuz...</div> <script> setTimeout(function(){
            window.location.href = "https://www.okul.pwc.com.tr/uyelik-dogrulama.php";
         }, 4000);</script>';
        } else {
            echo '<div class="alert alert-danger">Telefon numaranız kaydedilemiştir Lütfen tekrar deneyiniz</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Sistemde böyle bir telefon numarası bulunmaktadır.Lütfen geçerli bir telefon numarası giriniz.</div>';
    }
} else {
    header("Location: https://www.okul.pwc.com.tr/");
}