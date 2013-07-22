<?php

/**
 * This is the model class for table "art_types".
 *
 * The followings are the available columns in table 'art_types':
 * @property integer $id
 * @property string $s_name
 * @property string $s_name_mn
 * @property integer $need_baguette
 *
 * The followings are the available model relations:
 * @property Arts[] $arts
 * @property SuperArtTypesToTypes $superArtTypesToTypes
 */
class ArtTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArtTypes the static model class
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
		return 'art_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('s_name, s_name_mn', 'required'),
			array('need_baguette', 'numerical', 'integerOnly'=>true),
			array('s_name, s_name_mn', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, s_name, s_name_mn, need_baguette', 'safe', 'on'=>'search'),
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
			'arts0' => array(self::HAS_MANY, 'Arts', 'type'),
			'superArtTypesToTypes0' => array(self::HAS_ONE, 'SuperArtTypesToTypes', 'sub'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			's_name' => Yii::t('content','Title'),
			's_name_mn' => Yii::t('content','In the plural'),
			'need_baguette' => Yii::t('content','Need Baguette'),
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
		$criteria->compare('s_name',$this->s_name,true);
		$criteria->compare('s_name_mn',$this->s_name_mn,true);
		$criteria->compare('need_baguette',$this->need_baguette);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}