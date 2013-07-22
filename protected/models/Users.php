<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $login
 * @property string $pwd
 * @property string $s_mail
 * @property string $s_phone
 * @property integer $offert_accepted
 * @property string $s_full_name
 * @property string $s_first_name
 * @property string $s_middle_name
 * @property string $s_last_name
 * @property string $s_city
 * @property string $s_address
 * @property integer $mail_confirmed
 * @property string $msisdn
 * @property integer $msisdn_confirmed
 * @property string $last_used
 * @property string $avatar
 * @property integer $avatar_w
 * @property integer $avatar_h
 * @property string $added
 * @property string $account
 * @property string $currency
 * @property integer $lang
 * @property integer $last_paymethod
 * @property string $last_ip
 * @property string $tag1
 *
 * The followings are the available model relations:
 * @property Basket[] $baskets
 * @property Cms[] $cms
 * @property Persons[] $persons
 * @property DeliveryAddress[] $deliveryAddresses
 * @property Groups[] $groups
 * @property News[] $news
 * @property Recenses[] $recenses
 * @property Sessions[] $sessions
 * @property Lang $lang0
 * @property Currency $currency0
 */
class Users extends CActiveRecord
{
	
	public $repeat_password;
	public $initialPassword;
	public $_image_file = null;
	public $oldRecord;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('offert_accepted', 'required', 'on'=>'insert'),
// 			array('initialPassword, repeat_password', 'required', 'on'=>'update'),
			array('pwd', 'required', 'on'=>'needPwd'),
			array('pwd, repeat_password', 'length', 'min'=>6, 'max'=>40 ),
			array('repeat_password', 'compare', 'compareAttribute'=>'pwd', 'message'=>'Password not match', 'on'=>'needPwd'),
// 			array('pwd', 'compare', 'compareAttribute'=>'repeat_password'), //, 'on'=>'insert'),
// 			array('initialPassword', 'compare', 'compareAttribute'=>'repeat_password', 'on'=>'update'),
			array('s_mail', 'email'), 
			array('login, s_mail, s_first_name, s_last_name', 'required'),
			array('offert_accepted, mail_confirmed, msisdn_confirmed, avatar_w, avatar_h, lang, last_paymethod', 'numerical', 'integerOnly'=>true),
			array('login, s_phone, s_first_name, s_middle_name, s_last_name, s_city, msisdn', 'length', 'max'=>100),
			array('s_mail', 'length', 'max'=>50),
			array('s_full_name, s_address', 'length', 'max'=>255),
			array('avatar', 'length', 'max'=>20),
			array('account', 'length', 'max'=>9),
			array('currency', 'length', 'max'=>3),
			array('last_ip', 'length', 'max'=>15),
			array('added', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, pwd, s_mail, s_phone, offert_accepted, s_full_name, s_first_name, s_middle_name, s_last_name, s_city, s_address, mail_confirmed, msisdn, msisdn_confirmed, last_used, avatar, avatar_w, avatar_h, added, account, currency, lang, last_paymethod, last_ip', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'baskets' => array(self::HAS_MANY, 'Basket', 'user'),
			'cms' => array(self::HAS_MANY, 'Cms', 'user'),
			'persons' => array(self::MANY_MANY, 'Persons', 'copyrights(user, person)'),
			'deliveryAddresses' => array(self::HAS_MANY, 'DeliveryAddress', 'user'),
			'groups' => array(self::MANY_MANY, 'Groups', 'groups_users(user, group)'),
			'news' => array(self::HAS_MANY, 'News', 'user'),
			'recenses' => array(self::HAS_MANY, 'Recenses', 'user'),
			'sessions' => array(self::HAS_MANY, 'Sessions', 'user'),
			'lang' => array(self::BELONGS_TO, 'Lang', 'lang'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'login' => Yii::t('content','Username'),
			'pwd' => Yii::t('content','Password'),
			's_mail' => Yii::t('content','E-Mail'),
			's_phone' => Yii::t('content','Phone'),
			'offert_accepted' => Yii::t('content','Offert Accepted'),
			's_full_name' => Yii::t('content','Full Name'),
			's_first_name' => Yii::t('content','First Name'),
			's_middle_name' => Yii::t('content','Middle Name'),
			's_last_name' => Yii::t('content','Last Name'),
			's_city' => Yii::t('content','City'),
			's_address' => Yii::t('content','Address'),
			'mail_confirmed' => Yii::t('content','Mail Confirmation'),
			'msisdn' => Yii::t('content','Msisdn'),
			'msisdn_confirmed' => Yii::t('content','Msisdn Confirmed'),
			'last_used' => Yii::t('content','Last Used'),
			'avatar' => Yii::t('content','Avatar'),
			'avatar_w' => Yii::t('content','Avatar Width'),
			'avatar_h' => Yii::t('content','Avatar Height'),
			'added' => Yii::t('content','Added'),
			'account' => Yii::t('content','Account'),
			'currency' => Yii::t('general','Currency'),
			'lang' => Yii::t('general','Lang'),
			'last_paymethod' => Yii::t('content','Last Paymethod'),
			'last_ip' => Yii::t('content','Last Ip'),
			'tag1' => Yii::t('content', 'Tag'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('s_mail',$this->s_mail,true);
		$criteria->compare('s_phone',$this->s_phone,true);
		$criteria->compare('offert_accepted',$this->offert_accepted);
		$criteria->compare('s_full_name',$this->s_full_name,true);
		$criteria->compare('s_first_name',$this->s_first_name,true);
		$criteria->compare('s_middle_name',$this->s_middle_name,true);
		$criteria->compare('s_last_name',$this->s_last_name,true);
		$criteria->compare('s_city',$this->s_city,true);
		$criteria->compare('s_address',$this->s_address,true);
		$criteria->compare('mail_confirmed',$this->mail_confirmed);
		$criteria->compare('msisdn',$this->msisdn,true);
		$criteria->compare('msisdn_confirmed',$this->msisdn_confirmed);
		$criteria->compare('last_used',$this->last_used,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('avatar_w',$this->avatar_w);
		$criteria->compare('avatar_h',$this->avatar_h);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('account',$this->account,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('lang',$this->lang);
		$criteria->compare('last_paymethod',$this->last_paymethod);
		$criteria->compare('last_ip',$this->last_ip,true);
		$criteria->compare('tag1', $this->tag1, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
	{

// 		//add the password hash if it's a new record
// 		if ($this->getIsNewRecord())
// 		{
// 			//creates the password hash from the plaintext password
// 			$this->pwd = base64_encode($this->pwd);
// 		}
// 		else if (!empty($this->pwd)&&!empty($this->repeat_password)&&($this->pwd===$this->repeat_password))
// 		//if it's not a new password, save the password only if it is not empty and the two passwords match
// 		{
// 			$this->pwd = base64_encode($this->pwd);
// 		}		
		
		
		// in this case, we will use the old hashed password.
// 		if(empty($this->pwd) && empty($this->repeat_password) && !empty($this->initialPassword))
// 			$this->pwd=$this->repeat_password=$this->initialPassword;
// 		else 
	
		if($this->getScenario() == 'needPwd'){
			//$this->pwd = base64_encode($this->pwd);
			$this->pwd=$this->encrypt($this->pwd);
		} 
		else {
			$this->pwd = $this->initialPassword;
		}
				
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->added = date("Y-m-d H:i:s");
				$this->tag1 = $this->genRandomString(20);
			} else {
				if($this->oldRecord->s_mail != $this->s_mail)
					$this->tag1 = $this->genRandomString(20);
			}
			$this->s_full_name = $this->s_first_name . ' ' . $this->s_middle_name . ' ' .$this->s_last_name; 

			return true;
		}
	}
	
	protected function afterFind()
	{
		$this->oldRecord=clone $this;
		
 		$this->initialPassword = $this->pwd;
		
		$date = date('Y-m-d', strtotime($this->added));
		$this->added = $date;
	
		$file_name = str_pad($this->id,8,"0",STR_PAD_LEFT).'.'.$this->avatar;
		$splited = str_split($file_name, 2);
		$file_path = $splited[0] .'/'. $splited[1] .'/'. $splited[2] . '/';
		$this->_image_file = Yii::app()->baseUrl.'/images/users/'.$file_path.$file_name; 
		
		parent::afterFind();
	}
	
	public function afterSave()
	{
		parent::afterSave();
		
		GroupsUsers::model()->deleteAllByAttributes(array('user'=>$this->id));
		
		if (isset($_POST['user_groups']))
		{
			$u_groups = $_POST['user_groups'];
			foreach ($u_groups as $u_group){
				$ug = new GroupsUsers();
				$ug->user = $this->id;
				$ug->group = $u_group;
				$ug->save();
			}
		}else{
			if($this->getIsNewRecord()){
				$groupsuser = new GroupsUsers();
				$groupsuser->user = $this->id;
				$groupsuser->group = 3;
				$groupsuser->save();
			}
		}
			
	}
	
	public function saveModel($data=array())
	{
		//because the hashes needs to match
		if(!empty($data['pwd']) && !empty($data['repeat_password']))
		{
			$data['pwd'] = base64_encode($this->pwd); //Yii::app()->user->hashPassword($data['pwd']);
			$data['repeat_password'] = base64_encode($this->pwd); //Yii::app()->user->hashPassword($data['repeat_password']);
		}
	
		$this->attributes=$data;
	
		if(!$this->save())
			return CHtml::errorSummary($this);
	
		return true;
	}

	public function renewPassword()
	{
		$newpwd = self::genRandomString(6);
		
		$this->scenario = 'needPwd';
		$this->pwd = $newpwd;
		$this->repeat_password = $newpwd;
		if ($this->save())
		{
			$headers="From: Artefieri <do-not-reply@af.ru>\r\n".
					 "MIME-Version: 1.0\r\n".
					 "Content-type: text/html; charset=UTF-8";
			$message = Yii::t('mails', 'Password changed. <br/>Username: {username} <br/>New password: {password}', array('{username}' => $this->login, '{password}'=>$newpwd));
			mail($this->s_mail, 'Password generator', $message, $headers);
			
			return true;
		} else {
			$this->addError('password', Yii::t('content', 'Error changing password'));
			return false;
		}
	}
	
	public function sendMailConfirmCode()
	{
		$newcode = self::genRandomString(20);
		
		$this->tag1 = $newcode;
		if ($this->save(false))
		{
			$l = array('m'=>$this->s_mail, 'c'=>$newcode);
			$l = json_encode($l);
			$confirmlink = Yii::app()->createAbsoluteUrl('/users/emailConfirm', array('ac'=>urlencode($l)));
			
			$headers="From: Artefieri <do-not-reply@af.ru>\r\n".
					 "MIME-Version: 1.0\r\n".
					 "Content-type: text/html; charset=UTF-8";
			$message = Yii::t('mails', 'e-Mail activation. <br/>Activatin link:<br/><a href="{link}">{link}</a>', array('{link}'=>$confirmlink));
			
			mail($this->s_mail, 'e-Mail activation', $message, $headers);
			
			return true;
		} else {
			$this->addError('s_mail', Yii::t('content', 'Error sending confirmation email'));
			return false;
		}
	}
	
	//========================================================================================================================
	
	//Functiile de criptare/comparare a valorilor introduse cu valorile criptate
	
	function blowfishSalt($cost = 13){
		if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
			throw new Exception("cost parameter must be between 4 and 31");
		}
		$rand = array();
		for ($i = 0; $i < 8; $i += 1) {
			$rand[] = pack('S', mt_rand(0, 0xffff));
		}
		$rand[] = substr(microtime(), 2, 6);
		$rand = sha1(implode('', $rand), true);
		$salt = '$2a$' . sprintf('%02d', $cost) . '$';
		$salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
		return $salt;
	}
	
	public function encrypt($value){
		$this->pwd = crypt($value, $this->blowfishSalt());
		return $this->pwd;
	}
	
	public function comparePw($value, $record){
		if($record === crypt($value, $record))
			return true;
		else
			return false;
	}
	
	/**
	 * genRandomString - Generates random string
	 * @author Macinville <http://macinville.com>
	 * @license MIT License <http://www.opensource.org/licenses/mit-license.php>
	 * @param int $length Length of the return string.
	 * @param string $chars User-defined set of characters to be used in randoming. If this is set, $type will be ignored.
	 * @param array $type Type of the string to be randomed.Can be set by boolean values.
	 * <ul>
	 * <li><b>alphaSmall</b> - small letters, true by default</li>
	 * <li><b>alphaBig</b> - big letters, true by default</li>
	 * <li><b>num</b> - numbers, true by default</li>
	 * <li><b>othr</b> - non-alphanumeric characters found on regular keyboard, false by default</li>
	 * <li><b>duplicate</b> - allow duplicate use of characters, true by default</li>
	 * </ul>
	 * @return string The generated random string
	 */
	
	public function genRandomString($length=10, $chars='', $type=array()) {
		//initialize the characters
		$alphaSmall = 'abcdefghijklmnopqrstuvwxyz';
		$alphaBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '0123456789';
		$othr = '`~!@#$%^&*()/*-+_=[{}]|;:",<>.\/?' . "'";
	
		$characters = "";
		$string = '';
		//defaults the array values if not set
		isset($type['alphaSmall'])  ? $type['alphaSmall']: $type['alphaSmall'] = true;  //alphaSmall - default true
		isset($type['alphaBig'])    ? $type['alphaBig']: $type['alphaBig'] = true;      //alphaBig - default true
		isset($type['num'])         ? $type['num']: $type['num'] = true;                //num - default true
		isset($type['othr'])        ? $type['othr']: $type['othr'] = false;             //othr - default false
		isset($type['duplicate'])   ? $type['duplicate']: $type['duplicate'] = true;    //duplicate - default true
		 
		if (strlen(trim($chars)) == 0) {
			$type['alphaSmall'] ? $characters .= $alphaSmall : $characters = $characters;
			$type['alphaBig'] ? $characters .= $alphaBig : $characters = $characters;
			$type['num'] ? $characters .= $num : $characters = $characters;
			$type['othr'] ? $characters .= $othr : $characters = $characters;
		}
		else
			$characters = str_replace(' ', '', $chars);
		 
		if($type['duplicate'])
			for (; $length > 0 && strlen($characters) > 0; $length--) {
			$ctr = mt_rand(0, (strlen($characters)) - 1);
			$string .= $characters[$ctr];
		}
		else
			$string = substr (str_shuffle($characters), 0, $length);
	
		return $string;
	}
	
}