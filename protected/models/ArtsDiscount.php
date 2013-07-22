<?php

/**
 * This is the model class for table "arts_discount".
 *
 * The followings are the available columns in table 'arts_discount':
 * @property string $art
 * @property string $new_price
 * @property string $expired
 *
 * The followings are the available model relations:
 * @property Arts $art0
 */
class ArtsDiscount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArtsDiscount the static model class
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
		return 'arts_discount';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('art, new_price, expired', 'required'),
			array('art, new_price', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('art, new_price, expired', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'art' => Yii::t('content', 'Art'),
			'new_price' => Yii::t('content', 'New Price'),
			'expired' => Yii::t('content', 'Expires'),
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

		$criteria->compare('art',$this->art,true);
		$criteria->compare('new_price',$this->new_price,true);
		$criteria->compare('expired',$this->expired,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			$this->expired = date('Y-m-d', strtotime($this->expired));
				
			return true;
		}
	}
	
	public function afterSave()
	{
		$event = new EventsLog;
// 		$event->event = 0;
		$event->event_time = date("Y-m-d H:i:s");
		$event->user = Yii::app()->user->id;
// 		$event->id_aux = null;
		$scenario = $this->getScenario();
		$event->s_comment = 'DISCOUNTS ' . strtoupper($scenario) . ': ART=' . $this->art . ', NAME=' . $this->arts0->s_name;
// 		$event->eve_group = 1;
		$event->ip = Yii::app()->cookie->getIP();
		$event->save();
		
		parent::afterSave();
	}
	
	protected function afterFind()
	{
		$date = date('Y-m-d', strtotime($this->expired));
		$this->expired = $date;
	
		parent::afterFind();
	}
	
	
}