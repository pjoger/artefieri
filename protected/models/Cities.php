<?php

/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $id
 * @property integer $country
 * @property string $s_name_rus
 * @property string $s_name
 *
 * The followings are the available model relations:
 * @property Countries $country0
 * @property News[] $news
 */
class Cities extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cities the static model class
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
		return 'cities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country, s_name_rus, s_name', 'required'),
			array('country', 'numerical', 'integerOnly'=>true),
			array('s_name_rus, s_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, country, s_name_rus, s_name', 'safe', 'on'=>'search'),
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
			'country0' => array(self::BELONGS_TO, 'Countries', 'country'),
			'news' => array(self::MANY_MANY, 'News', 'news_cities(city, news)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'country' => Yii::t('content','Country'),
			's_name_rus' => Yii::t('content','Title (Ru)'),
			's_name' => Yii::t('content','Title'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('country',$this->country);
		$criteria->compare('s_name_rus',$this->s_name_rus,true);
		$criteria->compare('s_name',$this->s_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCitiesByNews($news_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'news = :news_id';
		$criteria->params = array(':news_id' => $news_id);
		$results = NewsCities::model()->findAll($criteria);
		return $results;		
	}
	
	public function getFreeCitiesByNews($news_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'news <> :news_id';
		$criteria->params = array(':news_id' => $news_id);
		$results = NewsCities::model()->findAll($criteria);
		return $results;
	}

	public function getCitiesByCountry($country_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'country = :country_id';
		$criteria->params = array(':country_id' => $country_id);
		$results = Cities::model()->findAll($criteria);
		return $results;
	}
	
	
}