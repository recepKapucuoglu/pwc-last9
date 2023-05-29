<?php

require_once("inc.php");

require __DIR__ . "/otp_function.php";
$hata_mesaj = '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu! Lütfen tekrar deneyiniz.</div>';
$tebrik_mesaj = '<div class="alert alert-success"><strong>Teşekkürler!</strong> Üyeliğiniz başarıyla gerçekleşmiştir. Telefon numaranıza gönderilen doğrulama kodunu onaylayınız. <a href="/uyelik">Sisteme Giriş Yapmak için tıklayınız.</a> </div><script>document.getElementById("sign_form").reset();</script>';

if ($_POST['adsoyad']) {
    $_SESSION['dashboardUserStatus'] = 0; //login durumu 0
    $adsoyad = valueClear($_POST['adsoyad']);
    $telefonNumber = valueClear($_POST['telefon']);
    $redirect_url = valueClear($_POST['redirect_url']);
    $last_page_url = valueClear($_POST['last_page_url']);
    $redirect_after_verify = (isset($_POST["redirect_url_after_verify"])) ? valueClear($_POST["redirect_url_after_verify"]) : "https://www.okul.pwc.com.tr";
    $redirect_after_verify = base64_encode($redirect_after_verify);
    
    // Sadece numaraları filtrele  -sms için uygun format
    $telefon = preg_replace("/[^0-9]/", "", $telefonNumber);

            $db->where('phone', $telefonNumber);
            $total = $db->getValue('web_user', "count(id)");
            if ($total > 0) {
                echo '<div class="alert alert-danger">Girmiş olduğunuz bilgiler ile sistemde kayıtlı kullanıcı bulunmaktadır. Şifrenizi unuttuysanız, <a href="/sifremi-unuttum" class="sifreunuttum" style="font-weight:bold;">Tıklayınız</a>. </div>';
                die();
            } else {
                // Onay Kodu Oluşturuyoruz.
                $onayKodu = crc16($telefonNumber . $sifre . time());
                $data = array(
                    'id' => NULL,
                    'fullname' => $adsoyad,
                    'activation_code' => $onayKodu,
                    'activation_code_mail'=>"",
                    'status' => 0,
                    'mail_status' => 0,
                    'phone' => $telefonNumber,
                    'notification' => "",
                    "redirect_after_verify" => $redirect_after_verify,
                    'created_date' => $db->now()
                );
                $id = $db->insert('web_user', $data);
                if ($id) {
                      

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
                        $_SESSION['dashboardUserPhone'] = $telefonNumber; 
                        $db->where('phone', $_SESSION['dashboardUserPhone']);
                        $results = $db->get('web_user');
                        foreach ($results as $value) {
                            $_SESSION['dashboardUserName'] = $value['fullname'];
                            $_SESSION['dashboardUserId'] = $value['id'];
                            $_SESSION['dashboardUserPhone'] = $value['phone'];
                        }
                        $_SESSION['dashboardUser'] = "uyeol_step1"; 
                        $dataLogon = array('last_login_date' => $db->now(), 'expression_time' => $db->now() ,'last_page_url' => $last_page_url);
                        $db->where('phone', $_SESSION['dashboardUserPhone']);
                        $idLogon = $db->update('web_user', $dataLogon );
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
    echo '<div class="alert alert-danger"><strong>Uyarı!</strong> Bir hata oluştu. Lütfen tüm bilgileri eksiksiz doldurunuz.</div>';
}