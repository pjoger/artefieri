<?php

/**
 * This is the model class for table "arts_relations".
 *
 * The followings are the available columns in table 'arts_relations':
 * @property integer $id
 * @property string $art1
 * @property string $art2
 * @property integer $relation
 *
 * The followings are the available model relations:
 * @property Arts $art10
 * @property Arts $art20
 */
class ArtsRelations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArtsRelations the static model class
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
		return 'arts_relations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('art1, art2', 'required'),
			array('relation', 'numerical', 'integerOnly'=>true),
			array('art1, art2', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, art1, art2, relation', 'safe', 'on'=>'search'),
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
			'art10' => array(self::BELONGS_TO, 'Arts', 'art1'),
			'art20' => array(self::BELONGS_TO, 'Arts', 'art2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'art1' => Yii::t('content','Art'),
			'art2' => Yii::t('content','Art2'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('art1',$this->art1,true);
		$criteria->compare('art2',$this->art2,true);
		$criteria->compare('relation',$this->relation);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}