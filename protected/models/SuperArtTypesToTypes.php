<?php

/**
 * This is the model class for table "super_art_types_to_types".
 *
 * The followings are the available columns in table 'super_art_types_to_types':
 * @property integer $super
 * @property integer $sub
 *
 * The followings are the available model relations:
 * @property SuperArtTypes $super0
 * @property ArtTypes $sub0
 */
class SuperArtTypesToTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SuperArtTypesToTypes the static model class
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
		return 'super_art_types_to_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('super, sub', 'required'),
			array('super, sub', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('super, sub', 'safe', 'on'=>'search'),
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
			'super0' => array(self::BELONGS_TO, 'SuperArtTypes', 'super'),
			'sub0' => array(self::BELONGS_TO, 'ArtTypes', 'sub'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'super' => 'Super',
			'sub' => 'Sub',
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

		$criteria->compare('super',$this->super);
		$criteria->compare('sub',$this->sub);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}