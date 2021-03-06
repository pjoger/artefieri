<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class FeedbackForm extends CFormModel
{
	public $first_name;
	public $last_name;
	public $phone;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('first_name, last_name, email, subject, body', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>Yii::t('content','Verification Code'),
      'first_name'=>Yii::t('content','First Name'),
      'last_name'=>Yii::t('content','Last Name'),
      'phone'=>Yii::t('content','Phone'),
      'email'=>Yii::t('content','E-Mail'),
      'subject'=>Yii::t('content','Subject'),
      'body'=>Yii::t('content','Your message'),
		);
	}
}