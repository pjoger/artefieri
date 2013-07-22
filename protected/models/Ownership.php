<?php

/**
 * This is the model class for table "ownership".
 *
 * The followings are the available columns in table 'ownership':
 * @property string $art
 * @property string $person
 * @property integer $relation
 */
class Ownership extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ownership the static model class
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
		return 'ownership';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('art, person', 'required'),
			array('relation', 'numerical', 'integerOnly'=>true),
			array('art, person', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('art, person, relation', 'safe', 'on'=>'search'),
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
			'art' => Yii::t('content','Art'),
			'person' => Yii::t('content','Author'),
			'relation' => Yii::t('content','Relation'),
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
		$criteria->compare('person',$this->person,true);
		$criteria->compare('relation',$this->relation);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getByArtId($artId) {
	
		$criteria = new CDbCriteria();
		$criteria->condition = 'art = :art_id';
		$criteria->params = array(':art_id' => $artId);
		$authors = Ownership::model()->findAll($criteria);
	
		return $authors;
	}
	
	public function getByArtNPerson($artid, $personid){
		$criteria = new CDbCriteria();
		$criteria->condition = '(art = :art_id) and (person=:person_id)';
		$criteria->params = array(':art_id' => $artid, ':person_id' => $personid);
		$result = Ownership::findAll($criteria);
		return $result;
	}
	
	public function getByAuthorId($authorId) {
	
		$criteria = new CDbCriteria();
		$criteria->condition = 'person = :person_id';
		$criteria->params = array(':person_id' => $authorId);
		$arts = Ownership::model()->findAll($criteria);
	
		return $arts;
	}
	
}