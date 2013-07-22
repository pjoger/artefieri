<?php

/**
 * This is the model class for table "arts_genres".
 *
 * The followings are the available columns in table 'arts_genres':
 * @property string $genre
 * @property string $art
 */
class ArtsGenres extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArtsGenres the static model class
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
		return 'arts_genres';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('genre, art', 'required'),
			array('genre, art', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('genre, art', 'safe', 'on'=>'search'),
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
			'genre' => Yii::t('content','Genre'),
			'art' => Yii::t('content','Art'),
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

		$criteria->compare('genre',$this->genre,true);
		$criteria->compare('art',$this->art,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Retrieves a list of art-genres associations based on the art id.
	 * @return CActiveDataProvider the data provider that can return the models .
	 */
	public function getByArtId($artid){
		$criteria = new CDbCriteria();
		$criteria->condition = '(art = :art_id)';
		$criteria->params = array(':art_id' => $artid);
		$result = ArtsGenres::findAll($criteria);
		return $result;
	}
	
	public function getByArtNGenre($artid, $genreid){
		$criteria = new CDbCriteria();
		$criteria->condition = '(art = :art_id)and(genre = :genre_id)';
		$criteria->params = array(':art_id' => $artid, ':genre_id' => $genreid);
		$result = ArtsGenres::findAll($criteria);
		return $result;
	}
	
}