<?php 
require_once("dosyalar/dahili/_db.php");

// //elearning token service.
// class ElearningService
// {
//     private $tokenUrl = 'https://pwc.elearningsolutions.net/api/TokenAuth/Authenticate';

//     private $username = 'service.user';
//     private $password = '2CHW:Kbe!9nPA-JWg.x9';

//     private $CreateAuthUrl = 'https://pwc.elearningsolutions.net/api/services/app/externalapi/CreateAuthToken';

//     private $userCode;

//     public function __construct($userCode)
//     {
//         $this->userCode = $userCode;
 
//     }

//     private function getToken()
//     {
//         // Gönderilecek veri
//         $data = array(
//             'usernameOrEmailAddress' => $this->username,
//             'password' => $this->password
//         );

//         // POST isteği yapılacak URL'yi ayarla
//         $ch = curl_init($this->tokenUrl);

//         // POST isteği için gerekli ayarları yap
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//         // İstek gönder ve yanıtı al
//         $response = curl_exec($ch);

//         // İstek sonucunu kontrol et
//         if ($response === false) {
//             // İstek başarısız oldu
//             return false;
//         } else {
//             // İstek başarılı oldu
//             // Yanıtı JSON formatına dönüştür
//             $json_response = json_decode($response);

//             // AccessToken değerini al
//             $access_token = $json_response->result->accessToken;

//             return $access_token;
//         }

//         // Curl isteğini kapat
//         curl_close($ch);
//     }
//     public function createUserToken() {

//         $token=$this->getToken();
//         $userCode=$this->userCode;
//         $data = array(
//             'USER_CODE' => $userCode
//         );

//         $ch = curl_init($this->CreateAuthUrl);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//         curl_setopt($ch, CURLOPT_POST, 1);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $token"));


//         $response = curl_exec($ch);
//         $json_response = json_decode($response);
//         $access_token = $json_response->resultDesc;


//         return $access_token;

//         curl_close($ch);


//     }

//     public function loginElearningUser(){
//       $createUserToken= $this->createUserToken();
//       $redirectUrl='https://pwc.elearningsolutions.net/Account/LoginWithAuthToken/?p='.$createUserToken.'&returnUrl=lms/trainings/mytrainings';
//       header('Location: '.$redirectUrl.' ');
//       exit();
//     }

// }

// $db->where("id","3001");
// $res=$db->getOne('web_user');
// // Kullanım örneği
// $token_service = new ElearningService($res['elearning_user_code']);
// // $token_service = new ElearningService("serdar.mangaoglu");
// $token_service->loginElearningUser();


        // require_once("dosyalar/dahili/libs/class.phpmailer.php");
        // require("dosyalar/dahili/libs/class.smtp.php");
        require("dosyalar/dahili/mail_config.php");

        // // Mail Gönderme
        // $mail = new PHPMailer;

        // $mail->IsSMTP();
        // // $mail->Host = "10.9.18.5";
        //    // used only when SMTP requires authentication
      
        // // $mail->Username = 'egitim@pwc.com.tr';
        // // $mail->Password = '';
        // // $mail->SMTPAuth = false;
        // // $mail->SMTPAutoTLS = false;
        // // $mail->Port = 25;
        // $mail->Host = "smtp.gmail.com";
        // $mail->Username = "rkapucuoglu@socialthinks.com";
        // $mail->Password = 'Recep8990.';
        // $mail->SMTPAuth = true;
        // $mail->Port = 587;

        $mail->CharSet = 'utf-8';
        $mail->setFrom('egitim@pwc.com.tr', 'Business School');
        $mail->AddAddress("rkapucuoglu@socialthinks.com");
        // Name is optional
        $mail->addReplyTo('egitim@pwc.com.tr', 'Business School');
        $mail->setLanguage('tr', '/language');

        // Set email format to HTML
        $mail->Subject = 'Business School - Test Mail';
        $mail->msgHTML("test mail");
        if($mail->send()){
            "mail gönderildi";
        }
        else {
            echo " - Mail Gönderilemedi." . $mail->ErrorInfo;
        }
          


        // ORJINAL CONFİG MAİL İÇİN
        // $mail->IsSMTP();
		// $mail->Host = "10.9.18.5";

		// // used only when SMTP requires authentication  
		// //$mail->SMTPAuth = true;
		// $mail->Username = 'egitim@pwc.com.tr';
		// $mail->Password = '';
		// $mail->SMTPAuth = false;
		// $mail->SMTPAutoTLS = false; 
		// $mail->Port = 25; 
     //   phone gonderimi

        
  