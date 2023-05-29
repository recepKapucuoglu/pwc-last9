<?php 
// require_once("dosyalar/dahili/_db.php");

//elearning token service.
class ElearningService
{
    private $tokenUrl = 'https://pwc.elearningsolutions.net/api/TokenAuth/Authenticate';

    private $username = 'service.user';
    private $password = '2CHW:Kbe!9nPA-JWg.x9';

    private $CreateAuthUrl = 'https://pwc.elearningsolutions.net/api/services/app/externalapi/CreateAuthToken';

    private $userCode;

    public function __construct($userCode)
    {
        $this->userCode = $userCode;
 
    }

    private function getToken()
    {
        // Gönderilecek veri
        $data = array(
            'usernameOrEmailAddress' => $this->username,
            'password' => $this->password
        );

        // POST isteği yapılacak URL'yi ayarla
        // $ch = curl_init($this->tokenUrl);

        // // POST isteği için gerekli ayarları yap
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // // İstek gönder ve yanıtı al
        // $response = curl_exec($ch);

        $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $this->tokenUrl );
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                
                $response = curl_exec($ch);
                
                if(curl_error($ch)) {
                    echo 'cURL Error: ' . curl_error($ch);
                } 
                
                curl_close($ch);

        // İstek sonucunu kontrol et
        if ($response === false) {
            // İstek başarısız oldu
            return false;
        } else {
            // İstek başarılı oldu
            // Yanıtı JSON formatına dönüştür
            $json_response = json_decode($response);

            // AccessToken değerini al
            $access_token = $json_response->result->accessToken;

            return $access_token;
        }

        // Curl isteğini kapat
    }
    public function createUserToken() {

        $token=$this->getToken();
        $userCode=$this->userCode;
        $data = array(
            'USER_CODE' => $userCode
        );

        // $ch = curl_init($this->CreateAuthUrl);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $token"));


        // $response = curl_exec($ch);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->CreateAuthUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        
        if(curl_error($ch)) {
            echo 'cURL Error: ' . curl_error($ch);
        } 
        curl_close($ch);

        $json_response = json_decode($response);
        $access_token = $json_response->resultDesc;


        return $access_token;



    }

    public function loginElearningUser(){
      $createUserToken= $this->createUserToken();
      $redirectUrl='https://pwc.elearningsolutions.net/Account/LoginWithAuthToken/?p='.$createUserToken.'&returnUrl=lms/trainings/mytrainings';
      header('Location: '.$redirectUrl.' ');
      exit();
    }

}

// $db->where("id","3001");
// $res=$db->getOne('web_user');
// // Kullanım örneği
$token_service = new ElearningService('test123');
// $token_service = new ElearningService("serdar.mangaoglu");
$token_service->loginElearningUser();




$db->whereIn('education_level', [2,1]);
$db->whereIn('education_type', ['E-Learning', 'Online Webex']);
$db->whereIn('education_category', ['online egitimler', 'vergi egitimleri']);
$educations = $db->get('education');


