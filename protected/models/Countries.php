<?php

/**
 * This is the model class for table "countries".
 *
 * The followings are the available columns in table 'countries':
 * @property integer $id
 * @property string $s_name_rus
 * @property string $s_name
 * @property integer $lang
 * @property string $code3
 * @property string $code2
 * @property string $currency
 *
 * The followings are the available model relations:
 * @property Cities[] $cities
 * @property Lang $lang0
 * @property Currency $currency0
 * @property News[] $news
 */
class Countries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Countries the static model class
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
		return 'countries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('s_name_rus, s_name', 'required'),
			array('lang', 'numerical', 'integerOnly'=>true),
			array('s_name_rus, s_name', 'length', 'max'=>255),
			array('code3', 'length', 'max'=>4),
			array('code2', 'length', 'max'=>2),
			array('currency', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, s_name_rus, s_name, lang, code3, code2, currency', 'safe', 'on'=>'search'),
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
			'cities' => array(self::HAS_MANY, 'Cities', 'country'),
			'lang0' => array(self::BELONGS_TO, 'Lang', 'lang'),
			'currency0' => array(self::BELONGS_TO, 'Currency', 'currency'),
			'news' => array(self::MANY_MANY, 'News', 'news_countries(country, news)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			's_name_rus' => Yii::t('content','Title (Ru)'),
			's_name' => Yii::t('content','Title'),
			'lang' => Yii::t('general','Lang'),
			'code3' => Yii::t('general','Code3'),
			'code2' => Yii::t('general','Code2'),
			'currency' => Yii::t('general','Currency'),
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
		$criteria->compare('s_name_rus',$this->s_name_rus,true);
		$criteria->compare('s_name',$this->s_name,true);
		$criteria->compare('lang',$this->lang);
		$criteria->compare('code3',$this->code3,true);
		$criteria->compare('code2',$this->code2,true);
		$criteria->compare('currency',$this->currency,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCountriesByNews($news_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'news = :news_id';
		$criteria->params = array(':news_id' => $news_id);
		$countries = NewsCountries::model()->findAll($criteria);
		$c = array();
		foreach ($countries as $country)
		{
			array_push($c, Countries::model()->findByPk($country->country)->id);
		}
		$results = Countries::model()->findAllByPk($c);
		return $results;		
	}
	
	public function getFreeCountriesByNews($news_id)
	{
		$results = Countries::model()->findAllBySql('
				select * from countries where not id in (select nc.country from news_countries as nc where nc.news=:news_id)
				', array(':news_id'=>$news_id));
				
// 		$criteria = new CDbCriteria();
// 		$criteria->condition = 'news <> :news_id';
// 		$criteria->params = array(':news_id' => $news_id);
// 		$countries = NewsCountries::model()->findAll($criteria);
// 		$c = array();
// 		foreach ($countries as $country)
// 		{
// 			array_push($c, Countries::model()->findByPk($country->country)->id);
// 		}
// 		$results = Countries::model()->findAllByPk($c);
 		return $results;		
	}
	
	
	
}