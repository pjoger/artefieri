<?php

/**
 * This is the model class for table "sessions".
 *
 * The followings are the available columns in table 'sessions':
 * @property string $sid
 * @property string $user
 * @property string $last_used
 * @property string $ip
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property Users $user0
 */
class Sessions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sessions the static model class
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
		return 'sessions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid, last_used', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('sid', 'length', 'max'=>32),
			array('user', 'length', 'max'=>10),
			array('ip', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sid, user, last_used, ip, type', 'safe', 'on'=>'search'),
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
			'user0' => array(self::BELONGS_TO, 'Users', 'user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sid' => Yii::t('content','Sid'),
			'user' => Yii::t('content','User'),
			'last_used' => Yii::t('content','Last Used'),
			'ip' => Yii::t('content','Ip'),
			'type' => Yii::t('content','Type'),
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

		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('last_used',$this->last_used,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}