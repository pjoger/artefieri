<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $userType = 'Front';
	private $id;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		
// 		$users=array(
// 			// username => password
// 			'demo'=>'demo',
// 			'admin'=>'admin',
// 		);
// 		if(!isset($users[$this->username]))
// 			$this->errorCode=self::ERROR_USERNAME_INVALID;
// 		else if($users[$this->username]!==$this->password)
// 			$this->errorCode=self::ERROR_PASSWORD_INVALID;
// 		else
// 			$this->errorCode=self::ERROR_NONE;
// 		return !$this->errorCode;
		
		$username = strtolower($this->username);
		
		if($this->userType=='Front') // This is front login
        {
         	/*check if login details exists in database*/
			$record=Users::model()->find('LOWER(login)=?', array($username)); 
			if($record===null)
            { 
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
            else if(!$record->comparePw($this->password, $record->pwd))            // here I compare db password with password field
            { 
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else
            {  
//             	$baskets = Basket::model()->findAllByAttributes(array('user'=>0, 'sid'=>Yii::app()->cookie->getSID(), 'delivery'=>null));
// 				if($baskets !== null){
// 					foreach ($baskets as $basket){
// 						$basket->user = $record->id;
// 						$basket->sid = Yii::app()->session->sessionID;
// 						$basket->save(); 
// 					}
// 				}
				
            	//Start sessiune
				Yii::app()->session->open();

				//Inregistrarea datelor in sessiune
				$this->setState('id', $record->id);
				Yii::app()->session['id'] = $record->id;

				$this->setState('sid', Yii::app()->session->sessionID);
				Yii::app()->session['sid'] = Yii::app()->session->sessionID;
				Yii::app()->cookie->setSID(Yii::app()->session->sessionID);

				$this->setState('login', $record->login);
				Yii::app()->session['login'] = $record->login;

				$this->setState('name', $record->s_full_name);
				Yii::app()->session['name'] = $record->s_full_name;

				$this->setState('first_name', $record->s_first_name);
				Yii::app()->session['first_name'] = $record->s_first_name;

				$this->setState('last_name', $record->s_last_name);
				Yii::app()->session['last_name'] = $record->s_last_name;

				$this->setState('mail', $record->s_mail);
				Yii::app()->session['mail'] = $record->s_mail;

				$this->setState('offert_accepted', $record->offert_accepted);
				Yii::app()->session['offert_accepted'] = $record->offert_accepted;

				$this->setState('mail_confirmed', $record->mail_confirmed);
				Yii::app()->session['mail_confirmed'] = $record->mail_confirmed;

				$this->setState('account', $record->account);
				Yii::app()->session['account'] = $record->account;

				//Verifica daca valuta este setata in baza de date, in caz contrar o citeste din cookie
				if($record->currency == null){
					$this->setState('currency', Yii::app()->cookie->getCurrency());
					Yii::app()->session['currency'] = Yii::app()->cookie->getCurrency();
				}
				else{
					$this->setState('currency', $record->currency);
					Yii::app()->session['currency'] = $record->currency;
					//Daca este gasita in baza de date, este schimbata si valoare din cookie
					Yii::app()->cookie->setCurrency($record->currency);
				}

				//Verifica daca limba este setata in baza de date, in caz contrar o citeste din cookie
				if($record->lang == null){
					$this->setState('lang', Yii::app()->cookie->getLanguage());
					Yii::app()->session['lang'] = Yii::app()->cookie->getLanguage();
					Yii::app()->language = Yii::app()->cookie->getLanguage();
				}
				else{
					$lang = Lang::model()->findByPk($record->lang)->lang_2;
					$this->setState('lang', $lang);
					Yii::app()->session['lang'] = $lang;
					//Daca este gasita in baza de date, este schimbata si valoare din cookie
					Yii::app()->cookie->setLanguage($lang);
					Yii::app()->language = $lang;
				}
            
				//Pentru inregistrarea datelor despre User Agent folosesc functia implicita Yii::app()->request->getUserAgent()
				$this->setState('ua', Yii::app()->request->getUserAgent());
				Yii::app()->session['ua'] = Yii::app()->request->getUserAgent();

				//Pentru inregistrarea datelor despre numele de domen folosesc functia implicita Yii::app()->request->serverName
				$this->setState('domain', Yii::app()->request->serverName);
				Yii::app()->session['domain'] = Yii::app()->request->serverName;

				//Aici si mai jos folosesc functiile de returnare a datelor geoIP din componenta Location.php
				$this->setState('ip', Yii::app()->location->returnIpAddress());
				Yii::app()->session['ip'] = Yii::app()->location->returnIpAddress();

				$this->setState('country', Yii::app()->location->getCountryName());
				Yii::app()->session['country'] = Yii::app()->location->getCountryName();

				$this->setState('region_name', Yii::app()->location->getRegionName());
				Yii::app()->session['region_name'] = Yii::app()->location->getRegionName();

				$this->setState('city', Yii::app()->location->getCityName());
				Yii::app()->session['city'] = Yii::app()->location->getCityName();

				$this->setState('userId',$record->id);

                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
        
        if($this->userType=='Back')// This is admin login
        {
         	/*check if login details exists in database*/
			$record=Users::model()->findByAttributes(array('login'=>$username));  // here I use Email as user name which comes from database
            if($record===null)
            { 
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
//            else if(!$this->password == 'q1w2e3')
            else if(!$record->comparePw($this->password, $record->pwd)) // let we have base64_encode password in database
            { 
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else
            {  

            	//Start sessiune
            	Yii::app()->session->open();
            	
            	//Inregistrarea datelor in sessiune
            	$this->setState('id', $record->id);
            	Yii::app()->session['id'] = $record->id;
            	
            	$this->setState('sid', Yii::app()->session->sessionID);
            	Yii::app()->session['sid'] = Yii::app()->session->sessionID;
            	Yii::app()->cookie->setSID(Yii::app()->session->sessionID);
            	
            	//Verifica daca valuta este setata in baza de date, in caz contrar o citeste din cookie
//             	if($record->currency == null){
//             		$this->setState('currency', Yii::app()->cookie->getCurrency());
//             		Yii::app()->session['currency'] = Yii::app()->cookie->getCurrency();
//             	}
//             	else{
//             		$this->setState('currency', $record->currency);
//             		Yii::app()->session['currency'] = $record->currency;
//             		//Daca este gasita in baza de date, este schimbata si valoare din cookie
//             		Yii::app()->cookie->setCurrency($record->currency);
//             	}
            	
//             	//Verifica daca limba este setata in baza de date, in caz contrar o citeste din cookie
//             	if($record->lang == null){
//             		$this->setState('lang', Yii::app()->cookie->getLanguage());
//             		Yii::app()->session['lang'] = Yii::app()->cookie->getLanguage();
//             	}
//             	else{
//             		$lang = Lang::model()->findByPk($record->lang)->lang_2;
//             		$this->setState('lang', $lang);
//             		Yii::app()->session['lang'] = $lang;
//             		//Daca este gasita in baza de date, este schimbata si valoare din cookie
//             		Yii::app()->cookie->setLanguage($lang);
//             	}
            	
//             	//Pentru inregistrarea datelor despre User Agent folosesc functia implicita Yii::app()->request->getUserAgent()
//             	$this->setState('ua', Yii::app()->request->getUserAgent());
//             	Yii::app()->session['ua'] = Yii::app()->request->getUserAgent();
            	
            	//Pentru inregistrarea datelor despre numele de domen folosesc functia implicita Yii::app()->request->serverName
            	$this->setState('domain', Yii::app()->request->serverName);
            	Yii::app()->session['domain'] = Yii::app()->request->serverName;
            	
            	//Aici si mai jos folosesc functiile de returnare a datelor geoIP din componenta Location.php
            	$this->setState('ip', Yii::app()->location->returnIpAddress());
            	Yii::app()->session['ip'] = Yii::app()->location->returnIpAddress();
            	
//             	$this->setState('country', Yii::app()->location->getCountryName());
//             	Yii::app()->session['country'] = Yii::app()->location->getCountryName();
            	
//             	$this->setState('region_name', Yii::app()->location->getRegionName());
//             	Yii::app()->session['region_name'] = Yii::app()->location->getRegionName();
            	
//             	$this->setState('city', Yii::app()->location->getCityName());
//             	Yii::app()->session['city'] = Yii::app()->location->getCityName();
            	
            	$this->setState('isAdmin',1);
                $this->setState('userId',$record->id);

                $this->setState('login', $record->login);
            	Yii::app()->session['login'] = $record->login;
            	
                $this->setState('name', $record->s_first_name);
            	Yii::app()->session['name'] = $record->s_first_name;

            	$this->setState('first_name', $record->s_first_name);
            	Yii::app()->session['first_name'] = $record->s_first_name;
            	
            	$this->setState('last_name', $record->s_last_name);
            	Yii::app()->session['last_name'] = $record->s_last_name;
            	 
                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
		
		
	}
}