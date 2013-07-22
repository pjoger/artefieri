<?php

/**
 * This is the model class for table "basket".
 *
 * The followings are the available columns in table 'basket':
 * @property string $id
 * @property string $user
 * @property string $sid
 * @property string $art
 * @property string $payed
 * @property string $added
 * @property string $currency
 * @property string $price
 * @property string $site_price
 * @property string $real_payed
 * @property string $valid_till
 * @property string $delivery
 * @property string $complement_to
 * @property string $tag1
 *
 * The followings are the available model relations:
 * @property Arts $arts
 * @property Users $user0
 * @property DeliveryInfo $delivery0
 * @property Currency $currency0
 * @property Basket $complementTo
 * @property Basket[] $baskets
 */
class Basket extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Basket the static model class
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
		return 'basket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, art', 'required'),
			array('user, art, price, site_price, real_payed, delivery, complement_to', 'length', 'max'=>10),
			array('sid', 'length', 'max'=>32),
			array('currency', 'length', 'max'=>3),
			array('payed, valid_till', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user, sid, art, payed, added, currency, price, site_price, real_payed, valid_till, delivery, complement_to', 'safe', 'on'=>'search'),
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
			'arts0' => array(self::BELONGS_TO, 'Arts', 'art'),
			'users0' => array(self::BELONGS_TO, 'Users', 'user'),
			'deliveries' => array(self::BELONGS_TO, 'DeliveryInfo', 'delivery'),
			'currencies' => array(self::BELONGS_TO, 'Currency', 'currency'),
			'complementTo' => array(self::BELONGS_TO, 'Basket', 'complement_to'),
			'baskets' => array(self::HAS_MANY, 'Basket', 'complement_to'),
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
			'art' => Yii::t('content','Art'),
			'payed' => Yii::t('content','Paid'),
			'added' => Yii::t('content','Added'),
			'currency' => Yii::t('general','Currency'),
			'price' => Yii::t('content','Price'),
			'site_price' => Yii::t('content','Site price'),
			'real_payed' =>  Yii::t('content','Real paid'),
			'valid_till' => Yii::t('content','Valid till'),
			'delivery' => Yii::t('content','Delivery'),
			'complement_to' => Yii::t('content','Complement To'),
			'tag1' => Yii::t('content','Tag'), 
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
		$criteria->compare('art',$this->art,true);
		$criteria->compare('payed',$this->payed,true);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('site_price',$this->site_price,true);
		$criteria->compare('real_payed',$this->real_payed,true);
		$criteria->compare('valid_till',$this->valid_till,true);
		$criteria->compare('delivery',$this->delivery,true);
		$criteria->compare('complement_to',$this->complement_to,true);
		$criteria->compare('tag1',$this->tag1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
	{
		
		if (parent::beforeSave())
		{
			$art = Arts::model()->findByPk($this->art);
			$this->price = $art->price;
			$this->site_price = $art->site_price;
			//$this->currency = $art->currency;

			$this->sid = Yii::app()->cookie->getSID();
			
			if ($this->isNewRecord)
			{
				$this->added = date("Y-m-d H:i:s");
				$this->payed = null;
				$this->valid_till = null;
			}
			else
			{
				// on payed for
				if($this->real_payed == $this->site_price)
				{
					$this->payed = date("Y-m-d H:i:s");
					$this->valid_till = $this->payed;
				}
			}
			
			if($this->complement_to == '')
				$this->complement_to = null;
			
			return true;
		}
	}
	
	protected function afterFind()
	{
		$date = date('Y-m-d', strtotime($this->added));
		$this->added = $date;
	
		if ($this->payed !== null) {
			$date = date('Y-m-d', strtotime($this->payed));
			$this->payed = $date;
		} else {
			//$this->payed = '';
		}
		
		if ($this->valid_till !== null) {
			$date = date('Y-m-d', strtotime($this->valid_till));
			$this->valid_till = $date;
		} else {
			//$this->valid_till = '';
		}
		
		parent::afterFind();
	}
	
}