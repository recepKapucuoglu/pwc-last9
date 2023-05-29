<?php
require_once("inc.php");
require __DIR__ . "/otp_function.php";
$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$tebrik_mesaj = '<div class="alert alert-success"><strong>Bilgilendirme!</strong> Doğrulama kodunuz telefon numaranıza yeniden gönderilmiştir.</div>';
if (isset($_COOKIE['verifySent']) && $_COOKIE['verifySent'] == true) {
    echo '<div class="alert alert-danger"><strong>Uyarı!</strong> 5 dakikada bir yeniden doğrulama kodu alabilirsiniz.</div>';
    exit();
}
// kullanıcının oturum açıp açmadığını kontrol edelim
if ($_SESSION['dashboardUser'] && $_SESSION['dashboardUser']!="uyeol_step1" && $_SESSION['dashboardUser']!="uyeol_step2") {
    // yeni bir tane tek kullanımlık şifre oluştur.
    $uuid = crc16($_SESSION['dashboardUser'] . time() . mt_rand(9999, 999999));
    // kullanıcı verilerini çek
    $db->where('email', $_SESSION['dashboardUser']);
    $user = $db->getOne('web_user');
    $user_name = $user["fullname"];
    $user_mail = $user["email"];
    $user_phone = $user["phone"];
    // kullanıcı verilerini güncelle
    $data = array('activation_code' => $uuid);
    $db->where('email', $_SESSION['dashboardUser']);
    $id = $db->update('web_user', $data);

    // eğer aktivasyon kodu update edildiyse
    if ($id) {
        // mail at
        $getdata = http_build_query(
            array(
                'adsoyad' => $user_name,
                'code' => $uuid
            )
        );

        $opts = array(
            'http' =>
            array(
                'method' => 'POST',
                'content' => $getdata
            )
        );
        //phone gonderimi
        $telefon = preg_replace("/[^0-9]/", "", $user_phone);
        $xml_data = "<MainmsgBody>
    <Command>0</Command>
    <PlatformID>1</PlatformID>
    <ChannelCode>581</ChannelCode>
    <UserName>pwcbss</UserName>
    <PassWord>Dty1HF4t</PassWord>
    <Mesgbody>Sayin $user_name, $uuid dogrulama kodu ile giris yapabilirsiniz.</Mesgbody>
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
            setcookie("verifySent", true, time() + (60 * 3), "/");
            $data = array("expression_time" => $db->now(), "activation_code" => $uuid);
            $db->where("email", $user_mail);
            $db->where("phone", $user_phone);
            $idLogon = $db->update('web_user', $data);
            if ($idLogon)
                echo $tebrik_mesaj;
        } else {
            echo $hata_mesaj . " - Sms Gönderilemedi.";
        }
        // cURL'ü kapat
        curl_close($ch);
    } else {
        echo $hata_mesaj;
    }
}
else if ($_SESSION['dashboardUser']=="uyeol_step1"){
     // yeni bir tane tek kullanımlık şifre oluştur.
     $uuid = crc16($_SESSION['dashboardUserPhone'] . time() . mt_rand(9999, 999999));
     // kullanıcı verilerini çek
     $db->where('phone', $_SESSION['dashboardUserPhone']);
     $user = $db->getOne('web_user');
     $user_name = $user["fullname"];
    //  $user_mail = $user["email"];
     $user_phone = $user["phone"];
     // kullanıcı verilerini güncelle
     $data = array('activation_code' => $uuid);
     $db->where('phone', $_SESSION['dashboardUserPhone']);
     $id = $db->update('web_user', $data);
 
     // eğer aktivasyon kodu update edildiyse
     if ($id) {
         // mail at
         $getdata = http_build_query(
             array(
                 'adsoyad' => $user_name,
                 'code' => $uuid
             )
         );
 
         $opts = array(
             'http' =>
             array(
                 'method' => 'POST',
                 'content' => $getdata
             )
         );
         //phone gonderimi
         $telefon = preg_replace("/[^0-9]/", "", $user_phone);
         $xml_data = "<MainmsgBody>
     <Command>0</Command>
     <PlatformID>1</PlatformID>
     <ChannelCode>581</ChannelCode>
     <UserName>pwcbss</UserName>
     <PassWord>Dty1HF4t</PassWord>
     <Mesgbody>Sayin $user_name, $uuid dogrulama kodu ile giris yapabilirsiniz.</Mesgbody>
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
             setcookie("verifySent", true, time() + (60 * 3), "/");
             $data = array("expression_time" => $db->now(), "activation_code" => $uuid);
            //  $db->where("email", $user_mail);
             $db->where("phone", $user_phone);
             $idLogon = $db->update('web_user', $data);
             if ($idLogon)
                 echo $tebrik_mesaj;
         } else {
             echo $hata_mesaj . " - Sms Gönderilemedi.";
         }
         // cURL'ü kapat
         curl_close($ch);
     } else {
         echo $hata_mesaj;
     }
} 
else {
    header("Location: https://www.okul.pwc.com.tr/");
}