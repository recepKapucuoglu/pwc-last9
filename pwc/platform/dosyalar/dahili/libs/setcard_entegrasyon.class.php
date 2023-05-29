<?php
class setcardEntegrasyon {

    private $lookupServiceUrl = "http://app.setcard.com.tr/service/getCityList.aspx";
	private $serviceUrl = "http://app.setcard.com.tr/service/searchMember.aspx";
	 
	public function getLookup($type=0,$parentId=0){
		try {
			$service_url = $this->getlookupServiceUrl().'?type='.$type.'&parentId='.$parentId;
			$curl = curl_init($service_url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$curl_response = curl_exec($curl);
			$reqReturn = json_decode($curl_response,true);
			return $reqReturn;
		} catch (Exception $exception) {
            echo 'Entegrasyonda hata oluştu. Hata :' . $exception->getMessage();
        }
	}
	
	public function getMember($ilId=0,$IlceId=0,$memberName="",$categoriesId=""){
		try {
			if($categoriesId=="") {
				$service_url = $this->getserviceUrl().'?ilId='.$ilId.'&IlceId='.$IlceId.'&memberName='.$memberName;
			} else
				$service_url = $this->getserviceUrl().'?ilId='.$ilId.'&IlceId='.$IlceId.'&memberName='.$memberName.'&categoryId='.$categoriesId;
			
			$curl = curl_init($service_url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$curl_response = curl_exec($curl);
			$reqReturn = json_decode($curl_response,true);
			return $reqReturn;
		} catch(Exception $exception){
            echo 'Entegrasyonda hata oluştu. Hata :' . $exception->getMessage();
        }
	}

	
	public function getserviceUrl() {
        return $this->serviceUrl;
    }

    public function setserviceUrl($serviceUrl) {
        $this->serviceUrl = $serviceUrl;
    }
	
	public function getlookupServiceUrl() {
        return $this->lookupServiceUrl;
    }

    public function setlookupServiceUrl($lookupServiceUrl) {
        $this->lookupServiceUrl = $lookupServiceUrl;
    }

}

?>
