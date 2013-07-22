<?php

/**
 * This is the model class for table "currency".
 *
 * The followings are the available columns in table 'currency':
 * @property string $id
 * @property string $price
 * @property string $time
 * @property string $s_title
 * @property string $s_prefix
 * @property string $s_postfix
 *
 * The followings are the available model relations:
 * @property Arts[] $arts
 * @property Basket[] $baskets
 * @property Countries[] $countries
 * @property Users[] $users
 */
class Currency extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Currency the static model class
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
		return 'currency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, s_title, price', 'required'),
			array('id', 'length', 'max'=>3),
			array('price', 'length', 'max'=>10),
			array('s_title', 'length', 'max'=>50),
			array('s_prefix, s_postfix', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, price, time, s_title, s_prefix, s_postfix', 'safe', 'on'=>'search'),
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
			'arts' => array(self::HAS_MANY, 'Arts', 'currency'),
			'baskets' => array(self::HAS_MANY, 'Basket', 'currency'),
			'countries' => array(self::HAS_MANY, 'Countries', 'currency'),
			'users' => array(self::HAS_MANY, 'Users', 'currency'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'price' => Yii::t('content','Price'),
			'time' => Yii::t('content','Time'),
			's_title' => Yii::t('content','Title'),
			's_prefix' => Yii::t('content','Prefix'),
			's_postfix' => Yii::t('content','Postfix'),
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
		$criteria->compare('price',$this->price,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('s_title',$this->s_title,true);
		$criteria->compare('s_prefix',$this->s_prefix,true);
		$criteria->compare('s_postfix',$this->s_postfix,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				//$this->time = time();
			}
			return true;
		}
	}

	public function menuItems()
	{
		$model = Currency::model()->findAll();
		$items = array();
		
		if (empty($model))
			return $items;
		
		foreach ($model as $cr)
		{
			$items[] = array(
					'label'=>strtoupper($cr->id),
					'url'=>'#',
					'itemOptions'=>array('class'=>'item'),
					'linkOptions'=>array('title'=>$cr->s_title),
					);
		}
		
		return $items;
	}

	public function convertcurrency($from,$to,$price){
		//find the to conversion rate
		if ($from == 'USD'){
			$model = CurrencyEx::model()->findByAttributes(array('currency_code'=>$to));
			return round($model->conversion_rate*$price,2);
		} else {
			$model = CurrencyEx::model()->findByAttributes(array('currency_code'=>$from));
			if ($to == 'USD') {
				return round($price/$model->conversion_rate, 2);
			} else {
				$model_1 = CurrencyEx::model()->findByAttributes(array('currency_code'=>$to));
				$x = $price/$model->conversion_rate;
				return round($x * $model_1->conversion_rate, 2);
			}
		}
	}
	
	
}