<?php

/**
 * This is the model class for table "news_countries".
 *
 * The followings are the available columns in table 'news_countries':
 * @property string $news
 * @property integer $country
 */
class NewsCountries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NewsCountries the static model class
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
		return 'news_countries';
	}

	public function primaryKey()
	{
		// For composite primary key, return an array like the following
		return array('news', 'country');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('news, country', 'required'),
			array('country', 'numerical', 'integerOnly'=>true),
			array('news', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('news, country', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'news' => Yii::t('content','News'),
			'country' => Yii::t('content','Country'),
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

		$criteria->compare('news',$this->news,true);
		$criteria->compare('country',$this->country);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getByNewsNCountry($newsid, $countryid){
		$criteria = new CDbCriteria();
		$criteria->condition = '(news = :news_id) and (country=:country_id)';
		$criteria->params = array(':news_id' => $newsid, ':country_id' => $countryid);
		$result = NewsCountries::model()->find($criteria);
		return $result;
	}
	
	

}