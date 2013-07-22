<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RemindForm extends CFormModel
{
	public $username;
	public $userType;
	public $errorCode = 0;

	private $_identity;

	
	public function __construct($arg='Front') { // default it is set to Front     
        $this->userType = $arg;
    }
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username/email required
			array('username', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function remind()
	{
		$record = Users::model()->find('LOWER(login)=?', array($this->username));
		if($record===null)
		{
			$record = Users::model()->find('LOWER(s_mail)=?', array($this->username));
			if ($record === null)
				$this->errorCode = 1;
		}
		if ($this->errorCode == 0)
		{
			if($record->renewPassword())
			{
				return true;
			} else 
				$this->addError('username', $record->errors['username']);
		} else {
			$this->addError('username', Yii::t('content', 'Incorrect username or email'));
			return false;
		}
			
	}
	
}
