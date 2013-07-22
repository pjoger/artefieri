<?php

/**
 * This is the model class for table "super_art_types".
 *
 * The followings are the available columns in table 'super_art_types':
 * @property integer $id
 * @property string $mem
 * @property integer $sortkey
 * @property string $s_title
 * @property string $s_imin_title
 * @property string $s_mn_rodit_title
 * @property integer $hidden
 * @property integer $exclusive
 *
 * The followings are the available model relations:
 * @property SuperArtTypesToTypes[] $superArtTypesToTypes
 */
class SuperArtTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SuperArtTypes the static model class
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
		return 'super_art_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, mem', 'required'),
			array('id, sortkey, hidden, exclusive', 'numerical', 'integerOnly'=>true),
			array('mem', 'length', 'max'=>25),
			array('s_title', 'length', 'max'=>128),
			array('s_imin_title, s_mn_rodit_title', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, mem, sortkey, s_title, s_imin_title, s_mn_rodit_title, hidden, exclusive', 'safe', 'on'=>'search'),
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
			'superArtTypesToTypes' => array(self::HAS_MANY, 'SuperArtTypesToTypes', 'super'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'mem' => Yii::t('content','Mem'),
			'sortkey' => Yii::t('content','Sort key'),
			's_title' => Yii::t('content','Title'),
			's_imin_title' => Yii::t('content','Imin Title'),
			's_mn_rodit_title' => Yii::t('content','Mn Rodit Title'),
			'hidden' => Yii::t('content','Hidden'),
			'exclusive' => Yii::t('content','Exclusive'),
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
		$criteria->compare('mem',$this->mem,true);
		$criteria->compare('sortkey',$this->sortkey);
		$criteria->compare('s_title',$this->s_title,true);
		$criteria->compare('s_imin_title',$this->s_imin_title,true);
		$criteria->compare('s_mn_rodit_title',$this->s_mn_rodit_title,true);
		$criteria->compare('hidden',$this->hidden);
		$criteria->compare('exclusive',$this->exclusive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}