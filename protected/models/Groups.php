<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property integer $id
 * @property string $s_name
 * @property integer $is_buyer
 *
 * The followings are the available model relations:
 * @property Actions[] $actions
 * @property Menus[] $menuses
 * @property Users[] $users
 */
class Groups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Groups the static model class
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
		return 'groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('s_name', 'required'),
			array('is_buyer', 'numerical', 'integerOnly'=>true),
			array('s_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, s_name, is_buyer', 'safe', 'on'=>'search'),
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
			'actions' => array(self::HAS_MANY, 'Actions', 'group'),
			'menuses' => array(self::MANY_MANY, 'Menus', 'groups_menus(group, menu)'),
			'users' => array(self::MANY_MANY, 'Users', 'groups_users(group, user)'),
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
			'is_buyer' => Yii::t('content','Is Buyer'),
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
		$criteria->compare('is_buyer',$this->is_buyer);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}