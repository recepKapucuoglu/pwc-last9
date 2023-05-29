<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$test = false;
require_once("libs/class.phpmailer.php");
require("libs/class.smtp.php");
require("libs/class.pop3.php");
require("./_function.php");
$programs = implode(', ', $_POST["program"]);
//Fatura Bilgileri
$fatura_turu = valueClear($_POST['fatura-turu']);
$fatura_adsoyad = valueClear($_POST['fatura_adsoyad']);
$tc_no = valueClear($_POST['tc_no']);
$firma_unvani = valueClear($_POST['firma_unvani']);
$vergi_dairesi = valueClear($_POST['vergi_dairesi']);
$vergi_no = valueClear($_POST['vergi_no']);
$adres = valueClear($_POST['adres']);


if($fatura_turu==1){
   $fatura_tipi = "Bireysel";
   $vergi_no = $tc_no;
   $firma_unvani = $fatura_adsoyad;
} else{
   $fatura_tipi = "Kurumsal";
}

$mailTemplate = <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN""http://www.w3.org/TR/REC-html40/loose.dtd"><html><head>
   <!--[if (gte mso 9)|(IE)]>
   <xml>
      <o:OfficeDocumentSettings>
         <o:AllowPNG/>
         <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
   </xml>
   <![endif]-->
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Kaydınız Tamamlandı | PwC</title>

   <!-- Google Fonts Link -->
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">


   <style type="text/css">
      /*------ Reset Style ------ */
      *{-webkit-text-size-adjust:none;-webkit-text-resize:100%;text-resize:100%;}
      table{border-spacing: 0;}
      h1, h2, h3, h4, h5, h6{display:block; Margin:0; padding:0;}
      img, a img{border:0; height:auto; outline:none; text-decoration:none;}
      body, #bodyTable, #bodyCell{height:100%; margin:0; padding:0; width:100%;}
     
      /*------ Client-Specific Style ------ */
      @-ms-viewport{width:device-width;}
      table{mso-table-lspace:0pt; mso-table-rspace:0pt;}
      p, a, li, td, blockquote{mso-line-height-rule:exactly;}
      p, a, li, td, body, table, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
      #outlook a{padding:0;}
      .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
      .ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td,img{line-height:100%;}

      /*------ Google Font Style ------ */
      [style*="Open Sans"] {font-family: "Open Sans", Helvetica, Arial, sans-serif !important;}
      [style*="Lora"] {font-family: "Lora", Georgia, Times, serif !important;}

      /*------ General Style ------ */
      .wrapperTable{width:100%; max-width:600px; Margin:0 auto;}

      /*------ Column Layout Style ------ */
      .oneColumn {text-align:center; font-size:0;}
     
      /*------ Images Style ------ */
      .logo img{ width:100px; height:auto; }
      .imgPost img{ width:600px; height:auto; }
      .sponsorImg img{ width:600px; height:auto; }
   </style>

   <style type="text/css">
      /*------ Media Width 480 to 640 ------ */
      @media screen and (min-width: 480px) and (max-width: 640px) {
         td[class="imgPost"] img{ width:100% !important;}
         td[class="sponsorImg"] img{ width:100% !important; }
      }
   </style>

   <style type="text/css">
      /*------ Media Width 480 ------ */
      @media screen and (max-width:480px) {
         table[class="wrapperTable"]{width:100% !important; }
         td[class="title"] h2{font-size:26px !important;line-height:34px !important;}
         td[class="imgPost"] img{ width:100% !important;}
         td[class="sponsorImg"] img{ width:100% !important; }
      }
   </style>

</head>

<body style="background-color:#EEEEEE;">
<center>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#EEEEEE;" id="bodyTable">
   <tbody><tr>
      <td align="center" valign="top" style="padding-right:10px;padding-left:10px;" id="bodyCell">
      <!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" style="width:600px;" width="600"><tr><td align="center" valign="top"><![endif]-->

      <!-- Email Pre-Header Open // -->
      <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperTable">
         <tbody><tr>
            <td align="center" valign="top">
               <!-- Content Table Open// -->
               <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                     <td valign="middle" style="padding-top: 10px; padding-right: 20px;" class="preHeader">
                        <!-- Email View in Browser // -->
                       
                     </td>
                  </tr>
               </tbody></table>
               <!-- Content Table Close// -->
            </td>
         </tr>
      </tbody></table>
      <!-- Email Pre-Header Close // -->

      <!-- Email Header Open // -->
      <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperTable">
         <tbody><tr>
            <td align="center" valign="top">
               <!-- Content Table Open// -->
               <table border="0" cellpadding="0" cellspacing="0" width="100%" class="logoTable" style="">
                  <tbody><tr>
                     <td align="center" valign="middle" style="padding-top:40px;padding-bottom:40px">
                        <!-- Logo and Link  // -->

                     </td>
                  </tr>
               </tbody></table>
               <!-- Content Table Close// -->
            </td>
         </tr>
      </tbody></table>
      <!-- Email Header Close // -->

      <!-- Email Body Open // -->
      <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperTable">
         <tbody><tr>
            <td align="center" valign="top">
               <!-- Card Table Open // -->
               <table border="0" cellpadding="0" cellspacing="0" style="background-color: rgb(255, 255, 255); border: 1px solid rgb(222, 222, 222);" width="100%" class="oneColumn">
                  <tbody><tr>
                     <td align="center" valign="top" style="padding-bottom: 40px;" class="imgPost">
                        <!-- Hero Image  // -->
                        <a href="#" target="_blank" style="text-decoration:none;" class="">
                           <img src="https://www.okul.pwc.com.tr/next-business/dosyalar/next-in-business/mailing-gorsel.png" width="600" alt="" border="0" style="width:100%; max-width:600px; height:auto; display:block;" class="">
                        </a>
                     </td>
                  </tr>

                  <tr>
                     <td align="center" valign="top" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;" class="title">
                        <!-- Main Title Text // -->
                        <h1 class="bigTitle" style="color:#313131; font-family:"Open Sans", Helvetica, Arial, sans-serif; font-size:26px; font-weight:600; font-style:normal; letter-spacing:normal; line-height:34px; text-align:center; padding:0; margin:0;">
                           Sn. {$_POST["adsoyad"]}
                        </h1>
                     <p>
                     <b>{$programs}</b> için gerçekleştirdiğiniz kayıt tarafımıza ulaşmıştır. İlginize teşekkür ederiz.
                     Eğitim detayları, ödemeyi gerçekleştireceğiniz tarih ve ödeme bilgileri, kayıt sayfasında belirtmiş olduğunuz e-mail adresinize iletilecektir. Ödemeler havale ya da eft yoluyla gerçekleştirilmektedir.
                     Eğitim programı başlamadan 10 gün öncesine kadar yapılan iptaller kabul edilecek olup, daha sonraki günlerde yapılacak iptaller için ise ancak katılımcı değişikliği yapılacaktır.
                     </p>
                     </td>
                  </tr>

                  <tr>
                     <td align="center" valign="top" style="padding-bottom:20px;">
                        <!-- Divider // -->
                        <table align="center" border="0" width="50" cellpadding="0" cellspacing="0" class="divider">
                           <tbody><tr>
                              <td align="center" style="border-bottom:2px solid #dc6900;font-size:0;line-height:0;">&nbsp;</td>
                           </tr>
                        </tbody></table>
                     </td>
                  </tr>
                     <tr>
                     <td align="center" valign="top" style="margin-top: -30px !important; padding-bottom: 20px; padding-left: 20px; padding-right: 20px;" class="title">
                        <!-- Main Title Text // -->
                        <h2 class="bigTitle" style="color: #e0301e; font-family:"Open Sans", Helvetica, Arial, sans-serif; font-size:20px; font-weight:600; font-style:normal; letter-spacing:normal; line-height:34px; text-align:center; padding:0; margin:0;">
                           Katılımcı Bilgileri

                        </h2>
                     </td>
                  </tr>
                  <tr>
                     <td align="center" valign="top" style="padding-bottom:20px;">
                        <!-- Divider // -->
                        <table align="center" border="0" width="50" cellpadding="0" cellspacing="0" class="divider">
                           <tbody><tr>
                              <td align="center" style="border-bottom:2px solid #dc6900;font-size:0;line-height:0;">&nbsp;</td>
                           </tr>
                        </tbody></table>
                     </td>
                  </tr>        
                     
            <tr>
                     <td align="center" valign="top" style="padding-bottom: 40px; padding-left: 20px; padding-right: 20px;" class="btn-card">
                        <!-- Button Table // -->
                        <table class="tg" width="100%" style="width:100%">
<tr>
    <th class="tg-6ec3"><span style="font-weight:bold">Ad Soyad</span></th>
    <th class="tg-6ec3"><span style="font-weight:bold">Telefon</span></th>
    <th class="tg-6ec3"><span style="font-weight:bold">E-posta</span></th>
    <th class="tg-6ec3"><span style="font-weight:bold">Şirket</span></th>
    <th class="tg-6ec3"><span style="font-weight:bold">Ünvan</span></th>
  </tr>
  <tr>
    <td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal; text-align: center;">{$_POST["adsoyad"]}</span><br><br></td>
    <td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal" text-align: center;>{$_POST["gsm"]}</span></td>
    <td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal" text-align: center;>{$_POST["email"]}</span><br><br></td>
    <td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal" text-align: center;>{$_POST["firma_adi"]}</span><br><br></td>
    <td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal" text-align: center;>{$_POST["unvan"]}</span><br><br></td>
  </tr>
</table>  
      </td>
</tr>
                     
EOT;

if($fatura_tipi == "Kurumsal") {
   $mailTemplate .= <<<EOT
   <tr>
   <td align="center" valign="top" style="margin-top: -30px !important; padding-bottom: 20px; padding-left: 20px; padding-right: 20px;" class="title">
      <!-- Main Title Text // -->
      <h2 class="bigTitle" style="color: #e0301e; font-family:"Open Sans", Helvetica, Arial, sans-serif; font-size:20px; font-weight:600; font-style:normal; letter-spacing:normal; line-height:34px; text-align:center; padding:0; margin:0;">
         Fatura Bilgileri
      </h2>
   </td>
</tr>
   <tr>
   <td align="center" valign="top" style="padding-bottom: 40px; padding-left: 20px; padding-right: 20px;" class="btn-card">
      <!-- Button Table // -->
      <table class="tg" width="100%" style="width:100%">
<tr>
<th class="tg-6ec3"><span style="font-weight:bold">Firma Ünvanı</span></th>
<th class="tg-6ec3"><span style="font-weight:bold">Vergi Dairesi</span></th>
<th class="tg-6ec3"><span style="font-weight:bold">Vergi Numarası</span></th>
<th class="tg-6ec3"><span style="font-weight:bold">Adres</span></th>
</tr>
<tr>
<td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal; text-align: center;">{$firma_unvani}</span><br><br></td>
<td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal" text-align: center;>{$vergi_dairesi}</span></td>
<td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal" text-align: center;>{$vergi_no}</span><br><br></td>
<td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal" text-align: center;>{$adres}</span><br><br></td>
</tr>
</table>  
</td>
</tr>
EOT;
} else {
   $mailTemplate .= <<<EOT
   <tr>
   <td align="center" valign="top" style="margin-top: -30px !important; padding-bottom: 20px; padding-left: 20px; padding-right: 20px;" class="title">
      <!-- Main Title Text // -->
      <h2 class="bigTitle" style="color: #e0301e; font-family:"Open Sans", Helvetica, Arial, sans-serif; font-size:20px; font-weight:600; font-style:normal; letter-spacing:normal; line-height:34px; text-align:center; padding:0; margin:0;">
         Fatura Bilgileri
      </h2>
   </td>
</tr>
   <tr>
   <td align="center" valign="top" style="padding-bottom: 40px; padding-left: 20px; padding-right: 20px;" class="btn-card">
      <!-- Button Table // -->
      <table class="tg" width="100%" style="width:100%">
<tr>
<th class="tg-6ec3"><span style="font-weight:bold">Fatura Ad Soyad</span></th>
<th class="tg-6ec3"><span style="font-weight:bold">TC Kimlik No</span></th>
<th class="tg-6ec3"><span style="font-weight:bold">Adres</span></th>
</tr>
<tr>
<td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal; text-align: center;">{$fatura_adsoyad}</span><br><br></td>
<td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal" text-align: center;>{$tc_no}</span></td>
<td class="tg-nrix" style="padding:10px;vertical-align: baseline;text-align: center;"><span style="font-weight:400;font-style:normal" text-align: center;>{$adres}</span><br><br></td>
</tr>
</table>  
</td>
</tr>
EOT;
}

date_default_timezone_set('Europe/Istanbul');

// Aydınlatma metni
$aydinlatma_metni = "onaylanmadı";

// error checker
$form_empty = false;

// Zaman sabiti
$dateNow = date('Y-m-d H:i:s', time());

// Database static class
class Database
{
    private static $dbName = 'platform' ;
    private static $dbHost = '10.9.18.4' ;
    private static $dbUsername = 'business_school';
    private static $dbUserPassword = '2KCkYMmm%;f!';

    private static $cont  = null;

    public function __construct() {
        exit('Init function is not allowed');
    }

    public static function connect() {
        // One connection through whole application
        if ( null == self::$cont ) {
            try {
                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
                self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$cont->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}
$pdo = Database::connect();

function errorMessage($msg){
    return "<br /> * $msg <br />";
}
// Sanitize input
$safePost = array(
    "adsoyad" => FILTER_SANITIZE_STRING,
    "unvan" => FILTER_SANITIZE_STRING,
    "firma_adi" => FILTER_SANITIZE_STRING,
    "telefon" => FILTER_SANITIZE_STRING,
    "email" => FILTER_SANITIZE_STRING,
    "gsm" => FILTER_SANITIZE_STRING,
);
$safePost = filter_input_array(INPUT_POST, $safePost);
$safePost = array_map('trim', $safePost);

// Build error message
$message_error = '<div class="alert alert-danger"><strong>Uyarı!</strong> Kaydınız tamamlanamadı.';
$message_success = '
<center> <i class="fa fa-check-circle" style="color: #ffb600; font-size: 100px; margin-bottom: 10px;"></i>
<h3><b>Kayıt Tamamlandı</b></h3>
<h3><br><strong>Kaydınız tarafımıza ulaşmıştır.</strong></h3> </center>
    <script>
      document.getElementById("contact-form").style.display = "none";
    </script>';
// Checkpoints
if(empty($safePost["adsoyad"])){
    $form_empty = true;
    $message_error .= errorMessage("Ad Soyad bilgilerinizi giriniz.");
}
if(empty($safePost["unvan"])){
    $form_empty = true;
    $message_error .= errorMessage("Unvan bilginizi giriniz.");
}
if(empty($safePost["firma_adi"])){
    $form_empty = true;
    $message_error .= errorMessage("Firma adınızı giriniz.");
}
if(empty($safePost["email"]) OR !filter_var($safePost["email"], FILTER_VALIDATE_EMAIL)){
    $form_empty = true;
    $message_error .= errorMessage("Geçerli bir e-mail adresi giriniz.");
}
if(empty($safePost["gsm"])){
    $form_empty = true;
    $message_error .= errorMessage("Cep telefonu numaranızı giriniz.");
}
if(empty($_POST["program"])){
   $form_empty = true;
   $message_error .= errorMessage("Lütfen en az bir eğitim programı seçiniz.");
}
if(!isset($_POST["aydinlatma"])){
    $form_empty = true;
    $message_error .= errorMessage("Aydınlatma metnini onaylayınız.");
} else{
    $aydinlatma_metni = "onaylandı";
}

// If any error, throw it to user
if($form_empty){
    $message_error .= "</div>";
    echo $message_error;
    exit;
}


    // insert it into database and send mail
    try {
        $pdo->beginTransaction();
        $params = array($safePost["adsoyad"], $safePost["firma_adi"], $safePost["email"], $safePost["unvan"], $safePost["telefon"],
            $safePost["gsm"], $firma_unvani, $vergi_dairesi, $vergi_no, $adres, $fatura_tipi, $_SERVER['REMOTE_ADDR'], $aydinlatma_metni, $programs);
        $sql = $pdo->prepare("INSERT INTO next_event_signup(isim, firma, sirketmail, unvan, telefon, ceptelefon,
        fatura_adi, vergi_dairesi, vergi_no, adres, fatura_tipi, ipaddress, aydinlatmametni,
    program) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute($params);
        $count = $sql->rowCount();
        $pdo->commit();
    }
        // if error on database operation, throw it error
    catch(Exception $e) {
        $pdo->rollBack();
        $message_error .= errorMessage($e->getMessage());
        $message_error .= "</div>";
        echo $message_error;
        exit;
}
Database::disconnect();

$mailTemplate .= <<<EOT
</table>
                     

                     
                  <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 19px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:#aaa;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 19px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:#aaa;color:#fff;background-color:#f38630;}
.tg .tg-cly1{text-align:left;vertical-align:middle}
.tg .tg-6ec3{font-size:14px;text-align:center;vertical-align:middle}
.tg .tg-cqfb{font-size:16px;text-align:left;vertical-align:middle}
.tg .tg-6nwz{font-size:14px;text-align:center;vertical-align:top}
.tg .tg-nrix{text-align:center;vertical-align:middle}
.tg .tg-g8np{color:#333333;text-align:center;vertical-align:middle}
</style>

   
   
     

                  <tr>
                     <td align="center" valign="top" style="padding-bottom: 40px; padding-left: 20px; padding-right: 20px;" class="description">
                        <!-- Link Verify // -->
                       
                     </td>
                  </tr>
               </tbody></table>
               
               
               
               <!-- Card Table Close// -->

               <!-- Space -->
               <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                  <tbody><tr>
                     <td height="30" style="font-size:1px;line-height:1px;">&nbsp;</td>
                  </tr>
               </tbody>
               </table>

            </td>
         </tr>
      </tbody></table>
      <!-- Email Body Close // -->

      <!-- Email Footer Open // -->
      <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperTable">
         <tbody><tr>
            <td align="center" valign="top">
               <!-- Content Table Open// -->
               <table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
                  <tbody><tr>
                     <td align="center" valign="top" style="padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;" class="socialLinks">
                        <!-- Social Links (Facebook)// -->
                        <a href="https://www.facebook.com/PwCTurkey" target="_blank" style="display: inline-block;" class="facebook">
                           <img src="http://weekly.grapestheme.com/newsletter/img/social/facebook.png" alt="" width="40" border="0" style="height:auto;margin:2px" class="">
                        </a>
                        <!-- Social Links (Twitter)// -->
                        <a href="https://twitter.com/PwC_Turkey" target="_blank" style="display: inline-block;" class="twitter">
                           <img src="http://weekly.grapestheme.com/newsletter/img/social/twitter.png" alt="" width="40" border="0" style="height:auto;margin:2px" class="">
                        </a>
                        <!-- Social Links (Pintrest)// -->
                       
                        <!-- Social Links (Instagram)// -->
                       
                        <!-- Social Links (Linkdin)// -->
                        <a href="https://www.linkedin.com/company/pwcturkey" target="_blank" style="display: inline-block;" class="linkdin">
                           <img src="http://weekly.grapestheme.com/newsletter/img/social/linkdin.png" alt="" width="40" border="0" style="height:auto;margin:2px" class="">
                        </a>
                     <a href="https://www.instagram.com/pwc_turkey/" target="_blank" style="display: inline-block;" class="instagram"><img src="http://weekly.grapestheme.com/newsletter/img/social/instagram.png" alt="" width="40" border="0" style="height:auto;margin:2px" class=""></a><a href="https://www.youtube.com/user/PwCTurkey" target="_blank" style="display: inline-block;" class="youtube"><img src="http://weekly.grapestheme.com/newsletter/img/social/youtube.png" alt="" width="40" border="0" style="height:auto;margin:2px" class=""></a></td>
                  </tr>

                  <tr>
                     <td align="center" valign="top" class="footerLinks" style="">
                        <!-- Use Full Links (Privacy Policy)// -->
                        <p class="smlText" style="color:#313131; font-family:"Open Sans", Helvetica, Arial, sans-serif; font-size:12px; font-weight:400; line-height:18px; text-align:center; margin:0; padding:0;">         </p>
                     </td>
                  </tr>

                  <tr>
                     <td align="center" valign="top" style="padding: 10px;" class="brandInfo">
                        <!-- Information of NewsLetter (Privacy Policy)// -->
                        <p class="smlText" style="color:#313131; font-family:"Open Sans", Helvetica, Arial, sans-serif; font-size:11px; font-weight:400; line-height:18px; text-align:center; margin:0; padding:0;">
                           © 2021 PwC Türkiye. Tüm hakları saklıdır. Bu belgede PwC ifadesi, PwC ağını veya PwC ağının üyesi olan bağımsız ve farklı tüzel kişiliklerden oluşan PwC Türkiye'yi ifade etmektedir.<br>

                           <br>PwC Danışmanlık Hizmetleri A.Ş. | Mersis no: 0-7330-4313-3900028 <br><br>
						  Etkinliğimize kayıt olurken <a href="https://www.okul.pwc.com.tr/aydinlatma-metni" target="_blank" style="text-decoration:underline !important">Aydınlatma Metni'ni</a> ve  <a href="https://www.okul.pwc.com.tr/acik-riza-metni" target="_blank" style="text-decoration:underline !important">Açık Rıza Metni'ni</a> <strong>onayladığınız için</strong> kişisel verileriniz, Aydınlatma Metni kapsamında işlenmiştir. Açık Rıza Metni'ni ve <a href="https://www.pwc.com.tr/tr/hakkimizda/kisisel-verilerin-korunmasi.html" target="_blank" style="text-decoration:underline !important">Gizlilik ve Çerez Politikası</a>’nı okuduğunuzu ve kabul ettiğinizi onayladınız.

						  
						   
						   
</p>
                     </td>
                  </tr>

                 
               </tbody></table>
               <!-- Content Table Close// -->
</td>
         </tr>

         <!-- Space -->
         <tr>
            <td height="30" style="font-size:1px;line-height:1px;">&nbsp;</td>
         </tr>
      </tbody></table>
      <!-- Email Footer Close // -->

<!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
      </td>
   </tr>
</tbody></table>

</center>
EOT;
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
$mail->setFrom('egitim@pwc.com.tr', 'PwC Türkiye');
$mailpwc = clone $mail;

if($test) {
    $mail->AddAddress('hyildirim@socialthinks.com');
}
$mail->AddAddress($safePost["email"]);
$mailpwc->AddAddress('derya.akbulut@pwc.com');
$mailpwc->AddAddress('sevilay.kilicaslan@pwc.com');
$mailpwc->AddAddress('asli.sapanatan@pwc.com');
$mailpwc->AddAddress('serdar.mangaoglu@pwc.com');
// Name is optional
$mail->setLanguage('tr', '/language');
$mailpwc->setLanguage('tr', '/language');

// Set email format to HTML
$mail->Subject = 'Next in Business | Kaydınız Alınmıştır';
$mailpwc->Subject = 'Next in Business | Yeni Kayıt';
$mail->msgHTML($mailTemplate);
$mailpwc->msgHTML($mailTemplate);
if($mail->send() && $mailpwc->send()){
    echo $message_success;
} else {
    $message_error .= errorMessage("Mail gönderilemedi!");
    $message_error .= "</div>";
    echo $message_error;
    exit;
}