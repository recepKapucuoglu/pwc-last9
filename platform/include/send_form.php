<?php
$test = false;
require_once("./libs/class.phpmailer.php");
require("./libs/class.smtp.php");
require("./libs/class.pop3.php");
require("./func.php");

function generateGoogle($title, $start_date, $end_date, $detail, $location){
    $title = urlencode($title);
    $detail = urlencode($detail);
    $location = urlencode($location);
    return "https://calendar.google.com/calendar/r/eventedit?text=$title&dates=$start_date/$end_date&details=$detail&location=$location";
}
$_POST = array_map('trim', $_POST);
$_POST = array_map('strip_tags', $_POST);
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

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#EEEEEE;" id="bodyTable">
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
                           <img src="https://www.okul.pwc.com.tr/platform/images/banner-mailing-yeni2.jpg" alt="" border="0" style="width:100%; height:auto; display:block;" class="">
                        </a>
                     </td>
                  </tr>

                  <tr>
                     <td align="center" valign="top" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;" class="title">
                        <!-- Main Title Text // -->
                        <h1 class="bigTitle" style="color:#313131; font-family:"Open Sans", Helvetica, Arial, sans-serif; font-size:26px; font-weight:600; font-style:normal; letter-spacing:normal; line-height:34px; text-align:center; padding:0; margin:0;">
                           Sn. {$_POST["adsoyad"]}
                        </h1>
                        21. Çözüm Ortaklığı Platformu'na kaydınız başarıyla alınmıştır. <br><br>
                        Aşağıda kayıt olduğunuz Workshop bilgilerini görebilir, takviminize ekleyebilirsiniz.<br><br>
                        Ödeme detayları sizinle ayrı bir e-mailde paylaşılacaktır.<br><br>
                        20 Aralık Salı günü Swissotel The Bosphorus'da görüşmek üzere!<br><br>

                        Saygılarımızla,<br>
                        PwC Türkiye

                     </td>
                  </tr>

                  <tr>
                     <td align="center" valign="top" style="padding-bottom:20px;">
                        <!-- Divider // -->
                        <table align="center" border="0" width="50" cellpadding="0" cellspacing="0" class="divider">
                           <tbody><tr>
                              <td align="center" style="border-bottom:2px solid #e0301e;font-size:0;line-height:0;">&nbsp;</td>
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
                              <td align="center" style="border-bottom:2px solid #e0301e;font-size:0;line-height:0;">&nbsp;</td>
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
                     

                  <tr>
                     <td align="center" valign="top" style="padding-bottom: 40px; padding-left: 20px; padding-right: 20px;" class="btn-card">
                     <h2 class="bigTitle" style="color: #eb8c00; font-family:"Open Sans", Helvetica, Arial, sans-serif; font-size:20px; font-weight:600; font-style:normal; letter-spacing:normal; line-height:34px; text-align:center; padding:0; margin:0;">
                           Kayıt Olduğum Workshoplar
                        </h2>
                        <!-- Button Table // -->
                        <table class="tg" style="border: 2px solid black; border-collapse: collapse;">
  <tr style="border: 2px solid black;">
    <th class="tg-6ec3"><span style="font-weight:bold; float: left; padding:10px">Workshop adı</span></th>
    <th class="tg-6ec3"><span style="font-weight:bold; text-align: center; padding:10px">Tarih</span></th>
    <th class="tg-6ec3"><span style="font-weight:bold; text-align: center; padding:10px">Başlangıç</span></th>
    <th class="tg-6ec3"><span style="font-weight:bold; text-align: center; padding:10px">Bitiş</span></th>
    <th class="tg-6ec3"><span style="font-weight:bold; text-align: center; padding:10px">Takvime Ekle</span></th>
  </tr>
EOT;

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
    "leave_year" => FILTER_SANITIZE_STRING,
    "enter_year" => FILTER_SANITIZE_STRING,
    "selectedVideos" => FILTER_SANITIZE_STRING,
    "iletisimizni" => FILTER_SANITIZE_STRING,
);

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

$safePost = filter_input_array(INPUT_POST, $safePost);
$safePost = array_map('trim', $safePost);
if(isset($safePost["iletisimizni"])){
    $safePost["iletisimizni"] = "izin verildi";
} else {
    $safePost["iletisimizni"] = "izin verilmedi";
}
$alumni = (isset($_POST["alumni"])) ? "evet" : "hayır";
// Build error message
$message_error = '<div class="alert alert-danger"><strong>Uyarı!</strong> Kaydınız tamamlanamadı.';
$message_success = '
<center> <i class="fa fa-check-circle" style="color: green; font-size: 100px; margin-bottom: 10px;"></i>
<h2><b>Kaydınız alındı.</b></h3>
<h3>İlginiz için teşekkürler. Kayıt bilgilerinizi e-posta adresine ilettik.</h3>
 </center>
    <script>
      document.getElementById("register-form-d").style.display = "none";
      document.getElementById("response-head").style.display = "none";
    </script>';
// Checkpoints
$already_registered = $pdo->prepare("SELECT id FROM event_signup WHERE sirketmail = :email");
$already_registered->execute(array(
   "email" => $safePost["email"],
));
if($already_registered->rowCount() > 0){
   $form_empty = true;
   $message_error .= errorMessage("Daha önce bu mail adresiyle kayıt yapılmıştır.");
}
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
if(count(explode(",", $safePost["selectedVideos"])) === 2) {
   $form_empty = true;
   $message_error .= errorMessage("Lütfen en az bir workshop seçiniz.");
}
else{
    $aydinlatma_metni = isset($_POST["aydinlatma"]) ? "onaylandı" : "onaylanmadı";
}
if($safePost["selectedVideos"] == "not" OR empty($safePost["selectedVideos"])){
    $form_empty = true;
    $message_error .= errorMessage("<a href='#workshopProg'>En az bir workshop seçmelisiniz</a>");
}

// If any error, throw it to user
if($form_empty){
    $message_error .= "</div>";
    echo $message_error;
    exit;
}

// Database record
$arrayofIds = explode(",", $safePost["selectedVideos"]);
// if new course is registered
$courseCount = false;
foreach ($arrayofIds as $selectedId){
    // Retrieve the course associated with id
    $idof = intval($selectedId);
    $stmt = $pdo->prepare("SELECT * FROM timetables WHERE id = :id");
    $stmt->bindParam(':id', $idof, PDO::PARAM_INT);
    $stmt->execute();
    $course = $stmt->fetch();
    // Check if he/she already registered this course. If so, pass this event
    $select = $pdo->prepare("SELECT id FROM event_signup WHERE sunumismi = :name AND sirketmail = :email");
    $select->execute(array(
        "name" => $course["name"],
        "email" => $safePost["email"],
    ));
    if($select->rowCount() > 0){
        echo "";
        continue;
    }
    // insert it into database and send mail
    try {
        $pdo->beginTransaction();
        $params = array($safePost["adsoyad"], $safePost["firma_adi"], $safePost["email"], $safePost["unvan"], $safePost["telefon"],
            $safePost["gsm"], $aydinlatma_metni, $course["name"], "20 Aralık 2022", $course["start_time"], $course["end_time"],
            $dateNow, $safePost["iletisimizni"], $alumni, $safePost["leave_year"], $safePost["enter_year"],$firma_unvani,$vergi_dairesi,$vergi_no,$adres,$fatura_tipi,$_SERVER['REMOTE_ADDR']);
        $sql = $pdo->prepare("INSERT INTO event_signup(isim, firma, sirketmail, unvan, telefon, ceptelefon, aydinlatmametni,
    sunumismi, sunumgunu, sunumbaslangicsaati, sunumbitissaati, kayitzamani, iletisimizni, alumni, hes, enter_year,fatura_adi,vergi_dairesi,vergi_no,adres,fatura_tipi,ipaddress) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute($params);
        $count = $sql->rowCount();
        $start = DateTime::createFromFormat("d-m-Y G:i", "{$course["date"]} {$course["start_time"]}");
        $startTimestamp = $start->getTimestamp();
        $startIso = date('Ymd\THis\Z', $startTimestamp - 3*60*60);
        $end = DateTime::createFromFormat("d-m-Y G:i", "{$course["date"]} {$course["end_time"]}");
        $endTimestamp = $end->getTimestamp();
        $endIso = date('Ymd\THis\Z', $endTimestamp - 3*60*60);
        $googleCalendar = generateGoogle("PwC Türkiye 21. Çözüm Ortaklığı Platformu | {$course["name"]}",
            $startIso, $endIso, "", "Vişnezade, Acısu Sokaği No:19, 34357 Beşiktaş/İstanbul");
        $googleCalendar = "<a href='$googleCalendar'><img style='margin-left: 1.3rem !important;' width='20px' height='20px' src='https://www.okul.pwc.com.tr/platform/images/workshop-takvim-icon-red.png' /></a>";
        $mailTemplate .= <<<EOT
                        <tr style="border: 2px solid black;">
                        <td class="tg-cly1" style="padding: 10px;">{$course["name"]}</td>
                        <td class="tg-nrix" style="padding: 10px;">20 Aralık 2022</td>
                        <td class="tg-g8np" style="padding: 10px;">{$course["start_time"]}</td>
                        <td class="tg-nrix" style="padding: 10px;">{$course["end_time"]}</td>
                          <td class="tg-g8np" style="padding: 10px;">{$googleCalendar}</td>
                      </tr>
EOT;
        $courseCount = true;
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
}
// If there is no new workshop!
if(!$courseCount){
    $error_str = "";
    $your_mail = $safePost["email"];
    $smt = $pdo->prepare("SELECT * FROM event_signup WHERE sirketmail = :id");
    $smt->bindParam(':id', $your_mail, PDO::PARAM_STR);
    $smt->execute();
    $repeatingWorkshops = $smt->fetchAll();
    foreach ($repeatingWorkshops as $item) {
        $error_str .= $item["sunumismi"] . ", ";
    }
    $message_error .= errorMessage("Daha önce oluşturmuş olduğunuz kayıttan($error_str) farklı bir workshop seçmediniz!");
    $message_error .= "</div>";
    echo $message_error;
    exit;
}
Database::disconnect();

$mailTemplate .= <<<EOT
</table>
                  <tr>
                     <td align="center" valign="top" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;" class="title">
                        <!-- Main Title Text // -->
                        * <strong>Takvime Ekle</strong> butonu Google Calendar üzerinden çalışmaktadır.
                     </td>
                     
                     

                     
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
                        <a href="https://www.facebook.com/PwCTurkiye" target="_blank" style="display: inline-block;" class="facebook">
                           <img src="http://weekly.grapestheme.com/newsletter/img/social/facebook.png" alt="" width="40" border="0" style="height:auto;margin:2px" class="">
                        </a>
                        <!-- Social Links (Twitter)// -->
                        <a href="https://twitter.com/PwC_Turkiye" target="_blank" style="display: inline-block;" class="twitter">
                           <img src="http://weekly.grapestheme.com/newsletter/img/social/twitter.png" alt="" width="40" border="0" style="height:auto;margin:2px" class="">
                        </a>
                        <!-- Social Links (Pintrest)// -->
                       
                        <!-- Social Links (Instagram)// -->
                       
                        <!-- Social Links (Linkdin)// -->
                        <a href="https://www.linkedin.com/company/pwcturkiye" target="_blank" style="display: inline-block;" class="linkdin">
                           <img src="http://weekly.grapestheme.com/newsletter/img/social/linkdin.png" alt="" width="40" border="0" style="height:auto;margin:2px" class="">
                        </a>
                     <a href="https://www.instagram.com/pwc_turkiye/" target="_blank" style="display: inline-block;" class="instagram"><img src="http://weekly.grapestheme.com/newsletter/img/social/instagram.png" alt="" width="40" border="0" style="height:auto;margin:2px" class=""></a><a href="https://www.youtube.com/user/PwCTurkey" target="_blank" style="display: inline-block;" class="youtube"><img src="http://weekly.grapestheme.com/newsletter/img/social/youtube.png" alt="" width="40" border="0" style="height:auto;margin:2px" class=""></a></td>
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
                           © 2022 PwC Türkiye. Tüm hakları saklıdır. Bu belgede PwC ifadesi, PwC ağını veya PwC ağının üyesi olan bağımsız ve farklı tüzel kişiliklerden oluşan PwC Türkiye'yi ifade etmektedir.<br>

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

if(true) {
    //$mail->AddAddress('hyildirim@socialthinks.com');
   //$mail->AddAddress('horal@socialthinks.com');
}
$mailpwc = clone $mail;
$mail->AddAddress($safePost["email"]);
$mailpwc->AddAddress('derya.akbulut@pwc.com');
$mailpwc->AddAddress('sevilay.kilicaslan@pwc.com');
$mailpwc->AddAddress('asli.sapanatan@pwc.com');
// Name is optional
$mail->setLanguage('tr', '/language');
$mailpwc->setLanguage('tr', '/language');

// Set email format to HTML
$mail->Subject = '21. Çözüm Ortaklığı Platformu | Kaydınız Tamamlanmıştır';
$mailpwc->Subject = '21. Çözüm Ortaklığı Platformu | Yeni Kayıt';
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