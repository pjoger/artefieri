<?php
class Cookie extends CApplicationComponent{
	
	//Get lang and currency from DB
    private function getLangAndCurrencyFromDB($countryCode2){
    	$command = Yii::app()->db->createCommand("SELECT lang.lang_2 AS countryCode, currency.id AS countryCurrency  FROM countries INNER JOIN lang ON countries.lang = lang.id INNER JOIN currency ON countries.currency = currency.id WHERE countries.code2 = '".$countryCode2."' LIMIT 0,1")->queryAll();
		
		if($command != null){
			return array(
				"countryCode" => $command[0]['countryCode'],
				"countryCurrency" => $command[0]['countryCurrency'],
			);
		}
		else{
			return array(
				"countryCode" => "en",
				"countryCurrency" => "USD",
			);
		}
    }


    //Getter and Setter for Currency

    public function setCurrency($currency){
    	$cookie = new CHttpCookie('currency', $currency);
		$cookie->expire = time()+2592000; 
		Yii::app()->request->cookies['currency'] = $cookie;
    }

    public function getCurrency(){
    	if(!isset(Yii::app()->request->cookies['currency'])){
    		$a = $this->getLangAndCurrencyFromDB($this->getCountryCode(Yii::app()->location->returnIpAddress()));
    		$value = $a['countryCurrency'];
    		//$this->setCurrency($value);	
    	}
    	else{
    		$value = Yii::app()->request->cookies->contains('currency') ? Yii::app()->request->cookies['currency']->value : '';
    	}
    	return $value;
    }

    //Getter and Setter for Language

    public function setLanguage($lang){
    	$cookie = new CHttpCookie('lang', $lang);
		$cookie->expire = time()+2592000; 
		Yii::app()->request->cookies['lang'] = $cookie;
    }

    public function getLanguage(){
    	if(!isset(Yii::app()->request->cookies['lang'])){
    		$a = $this->getLangAndCurrencyFromDB($this->getCountryCode(Yii::app()->location->returnIpAddress()));
    		$value = $a['countryCode'];
    		$this->setLanguage($value);	
    	}
    	else{
    		$value = Yii::app()->request->cookies->contains('lang') ? Yii::app()->request->cookies['lang']->value : '';
    	}
    	return $value;
    }

    //Getter and Setter for IP Address
    public function setIP(){
    	$cookie = new CHttpCookie('ip', Yii::app()->location->returnIpAddress());
		$cookie->expire = time()+2592000; 
		Yii::app()->request->cookies['ip'] = $cookie;
    }

    public function getIP(){
    	if(!isset(Yii::app()->request->cookies['ip'])){
    		$this->setIP(Yii::app()->location->returnIpAddress());
    	}
    	$value = Yii::app()->request->cookies->contains('ip') ? Yii::app()->request->cookies['ip']->value : '';
    	return $value;
    }

    //Getter and Setter for country name
    public function setCountry($country){
    	$cookie = new CHttpCookie('country', $country);
		$cookie->expire = time()+2592000; 
		Yii::app()->request->cookies['country'] = $cookie;
    }

    public function getCountry(){
    	if(!isset(Yii::app()->request->cookies['country'])){
    		$this->setCountry(Yii::app()->location->getCountryName());
    	}
    	$value = Yii::app()->request->cookies->contains('country') ? Yii::app()->request->cookies['country']->value : '';
    	return $value;
    }

    //Getter and Setter for city name
    public function setCity($city){
    	$cookie = new CHttpCookie('city', $city);
		$cookie->expire = time()+2592000; 
		Yii::app()->request->cookies['city'] = $cookie;
    }

    public function getCity(){
    	if(!isset(Yii::app()->request->cookies['city'])){
    		$this->setCity(Yii::app()->location->getCityName());
    	}
    	$value = Yii::app()->request->cookies->contains('city') ? Yii::app()->request->cookies['city']->value : '';
    	return $value;
    }

    //Getter and Setter for region name
    public function setRegion($region){
    	$cookie = new CHttpCookie('region', $region);
		$cookie->expire = time()+2592000; 
		Yii::app()->request->cookies['region'] = $cookie;
    }

    public function getRegion(){
    	if(!isset(Yii::app()->request->cookies['region'])){
    		$this->setRegion(Yii::app()->location->getRegionName());
    	}
    	$value = Yii::app()->request->cookies->contains('region') ? Yii::app()->request->cookies['region']->value : '';
    	return $value;
    }

    //Getter and Setter for SID
    public function setSID($sid){
        $cookie = new CHttpCookie('sid', $sid);
        $cookie->expire = time()+2592000; 
        Yii::app()->request->cookies['sid'] = $cookie;
    }

    public function getSID(){
        $value = Yii::app()->request->cookies->contains('sid') ? Yii::app()->request->cookies['sid']->value : Yii::app()->session->sessionID;
        return $value;
    }
    
    public function setAuthors($array){
    	$cookie = new CHttpCookie('authors', $array);
    	$cookie->expire = time()+2592000;
    	Yii::app()->request->cookies['authors'] = $cookie;
    }
    
    public function getAuthors(){
    	$value = Yii::app()->request->cookies->contains('authors') ? Yii::app()->request->cookies['authors']->value : '';
        return $value;
    }
}
?>