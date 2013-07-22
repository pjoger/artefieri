<?php
 
class WebUser extends CWebUser {
 
  function getId(){
    if(Yii::app()->user->isGuest){
      return 0;
    }
    else{
      return $this->getState('__id');
    }
  }
  
  function getSid(){
    return Yii::app()->user->getState('sid');
  }
  
  function getLogin(){
    return Yii::app()->user->getState('login');
  }
  
  function getName(){
    return Yii::app()->user->getState('name');
  }

  function getMail(){
    return Yii::app()->user->getState('mail');
  }

  function getOffertAccepted(){
    return Yii::app()->user->getState('offert_accepted');
  }

  function getMailConfirmed(){
    return Yii::app()->user->getState('mail_confirmed');
  }

  function getAccount(){
    return Yii::app()->user->getState('account');
  }

  function getCurrency(){
    return Yii::app()->user->getState('currency');
  }

  function getLang(){
    return Yii::app()->user->getState('lang');
  }

  function getIp(){
    return Yii::app()->user->getState('ip');
  }

  function getUa(){
    return Yii::app()->user->getState('ua');
  }

  function getDomain(){
    return Yii::app()->user->getState('domain');
  }

  function getCountry(){
    return Yii::app()->user->getState('region_name');
  }

  function getCity(){
    return Yii::app()->user->getState('city');
  }

  function getRegionName(){
    return Yii::app()->user->getState('region_name');
  }

}
?>