<?php

/**
 * This is the model class for table "delivery_address".
 *
 * The followings are the available columns in table 'delivery_address':
 * @property string $id
 * @property string $user
 * @property string $sid
 * @property string $s_mail
 * @property string $city
 * @property string $s_city_name
 * @property string $s_full_name
 * @property string $s_address
 * @property string $metro
 * @property string $homePhone
 * @property string $mobilePhone
 * @property string $postal_index
 * @property string $s_note
 * @property integer $deleted
 * @property string $region
 *
 * The followings are the available model relations:
 * @property Users $user0
 * @property DeliveryInfo[] $deliveryInfos
 */
class DeliveryAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeliveryAddress the static model class
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
		return 'delivery_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('deleted', 'numerical', 'integerOnly'=>true),
			array('user, city, metro, region', 'length', 'max'=>10),
			array('sid', 'length', 'max'=>32),
			array('s_mail, postal_index', 'length', 'max'=>50),
			array('s_city_name', 'length', 'max'=>127),
			array('s_full_name, s_address, s_note', 'length', 'max'=>255),
			array('homePhone, mobilePhone', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user, sid, s_mail, city, s_city_name, s_full_name, s_address, metro, homePhone, mobilePhone, postal_index, s_note, deleted, region', 'safe', 'on'=>'search'),
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
			'users0' => array(self::BELONGS_TO, 'Users', 'user'),
			'deliveryInfos' => array(self::HAS_MANY, 'DeliveryInfo', 'address'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'user' => Yii::t('content','User'),
			'sid' => Yii::t('content','Sid'),
			's_mail' => Yii::t('content','E-Mail'),
			'city' => Yii::t('content','City'),
			's_city_name' => Yii::t('content','City Name'),
			's_full_name' => Yii::t('content','Full Name'),
			's_address' => Yii::t('content','Address'),
			'metro' => Yii::t('content','Metro'),
			'homePhone' => Yii::t('content','Home Phone'),
			'mobilePhone' => Yii::t('content','Mobile Phone'),
			'postal_index' => Yii::t('content','Postal Index'),
			's_note' => Yii::t('content','Note'),
			'deleted' => Yii::t('content','Deleted'),
			'region' => Yii::t('content','Region'),
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
		$criteria->compare('user',$this->user,true);
		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('s_mail',$this->s_mail,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('s_city_name',$this->s_city_name,true);
		$criteria->compare('s_full_name',$this->s_full_name,true);
		$criteria->compare('s_address',$this->s_address,true);
		$criteria->compare('metro',$this->metro,true);
		$criteria->compare('homePhone',$this->homePhone,true);
		$criteria->compare('mobilePhone',$this->mobilePhone,true);
		$criteria->compare('postal_index',$this->postal_index,true);
		$criteria->compare('s_note',$this->s_note,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('region',$this->region,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
	{
	
		if (parent::beforeSave())
		{
			if ($this->city !== ''  && $this->s_city_name == '')
				$this->s_city_name = Cities::model()->findByPk($this->city)->s_name;
			if ($this->s_full_name == '')
				$this->s_full_name = Users::model()->findByPk($this->user)->s_full_name;
			if ($this->s_mail == '')
				$this->s_mail = Users::model()->findByPk($this->user)->s_mail;
			if ($this->s_address == '')
				$this->s_address = Users::model()->findByPk($this->user)->s_address;

			return true;
		}
	}
	
	
}