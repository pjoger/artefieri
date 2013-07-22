<?php

Yii::import('ext.EGeoIP');

class Location extends CApplicationComponent{
	
	//Return IP Address
	public function returnIpAddress(){
    	return Yii::app()->request->userHostAddress;
    }

    //Country code
	private function getCountryCode($ip){
// 		$location = Yii::app()->geoip->lookupLocation($ip);
// 		return strtolower($location->countryCode);
		$geoIp = new EGeoIP();
		$geoIp->locate($ip);
		return $geoIp->countryCode;
	}

    //Region name
	public function getRegionName(){
// 		$location = Yii::app()->geoip->lookupLocation($this->returnIpAddress());
// 		return $location->regionName;
		$geoIp = new EGeoIP();
		$geoIp->locate($this->returnIpAddress());
		return $geoIp->region;
	}

    //City name
	public function getCityName(){
// 		$location = Yii::app()->geoip->lookupLocation($this->returnIpAddress());
// 		return $location->city;
		$geoIp = new EGeoIP();
		$geoIp->locate($this->returnIpAddress());
		return $geoIp->city;
	}

    //Country name
    public function getCountryName(){
//     	$location = Yii::app()->geoip->lookupLocation($this->returnIpAddress());
//     	return $location->countryName;
		$geoIp = new EGeoIP();
		$geoIp->locate($this->returnIpAddress());
		return $geoIp->countryName;
    }
    
}
?>