<?php

/**
 * This is the model class for table "delivery_info".
 *
 * The followings are the available columns in table 'delivery_info':
 * @property string $id
 * @property string $address
 * @property integer $how_to_pay
 * @property string $last_update
 * @property integer $status
 * @property string $s_note_user
 * @property string $s_note_oper
 * @property string $added
 *
 * The followings are the available model relations:
 * @property Basket[] $baskets
 * @property DeliveryAddress $addresses
 */
class DeliveryInfo extends CActiveRecord
{
	
	public $_order_amount = 0;
	public $_order_price = 0;
	public $_order_currency = null;
	public $_order_payed = 0;
	public $_order_user = null;
	public $_is_random_id = false;
	public $_guest_user_name = '';
	public $_guest_mail = '';
	public $_guest_phone = '';
	public $_guest_address = '';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeliveryInfo the static model class
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
		return 'delivery_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('added', 'required'),
			array('_guest_user_name, _guest_mail, _guest_phone, _guest_address', 'validGuest', 'on' => 'insert'),
			array('how_to_pay, status', 'numerical', 'integerOnly'=>true),			
			array('address', 'length', 'max'=>10),
			array('s_note_user, s_note_oper', 'length', 'max'=>255),
			array('added', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, address, how_to_pay, last_update, status, s_note_user, s_note_oper, added', 'safe', 'on'=>'search'),
		);
	}
	
	public function validGuest($attribute, $params)
	{
		$a = $this->$attribute;
		
		if (Yii::app()->user->isGuest && $a == '') {
			$this->addError($attribute, Yii::t('app', 'Field could not be empty'));
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'baskets' => array(self::HAS_MANY, 'Basket', 'delivery','order'=>'baskets.added DESC'),
			'addresses' => array(self::BELONGS_TO, 'DeliveryAddress', 'address'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'address' => Yii::t('content','Address'),
			'how_to_pay' => Yii::t('content','How To Pay'),
			'last_update' => Yii::t('content','Last Update'),
			'status' => Yii::t('content','Status'),
			's_note_user' => Yii::t('general','Message'), //Yii::t('content','User Note'),
			's_note_oper' => Yii::t('content','Operator Note'),
			'added' => Yii::t('content','Added'),
			'order_user' => Yii::t('content','User'),
			'guest_user_name' => Yii::t('content','Имя'),
			'guest_mail' => Yii::t('content','E-Mail'),
			'guest_phone' => Yii::t('content','Phone'),
			'guest_address' => Yii::t('content','Address'),
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('how_to_pay',$this->how_to_pay);
		$criteria->compare('last_update',$this->last_update,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('s_note_user',$this->s_note_user,true);
		$criteria->compare('s_note_oper',$this->s_note_oper,true);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('_order_user',$this->_order_user, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
	{
		if ($this->_is_random_id) {
			$this->id = null;
			$this->isNewRecord = true;
		}
		
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->added = date("Y-m-d H:i:s");
			}

			$this->last_update = date("Y-m-d H:i:s");
				
			if($this->address == '')
				$this->address = null;
			
			return true;
		}
	}
	
	protected function afterFind()
	{
		$date = date('Y-m-d', strtotime($this->added));
		$this->added = $date;
	
		$date = date('Y-m-d', strtotime($this->last_update));
		$this->last_update = $date;
		
		$basket = Basket::model()->findAllByAttributes(array('delivery'=>$this->id));
		if (count($basket) > 0)
		{
			foreach ($basket as $item) {
				$this->_order_amount += $item->price;
				$this->_order_price += $item->site_price;
				$this->_order_payed += $item->real_payed;
				if( ($this->_order_user === null) || ($this->_order_user->id != $item->user) )
					$this->_order_user = Users::model()->findByPk($item->user);
				if( ($this->_order_currency === null) || ($this->_order_currency->id != $item->currency) )
					$this->_order_currency = Currency::model()->findByPk($item->currency);
			}
		}

		
		parent::afterFind();
	}
	
}