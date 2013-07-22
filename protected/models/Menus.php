<?php

/**
 * This is the model class for table "menus".
 *
 * The followings are the available columns in table 'menus':
 * @property integer $id
 * @property string $page
 * @property string $s_name
 * @property integer $parent
 * @property integer $pos
 * @property integer $noindex
 *
 * The followings are the available model relations:
 * @property Groups[] $groups
 * @property Menus $parent0
 * @property Menus[] $menuses
 */
class Menus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menus the static model class
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
		return 'menus';
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
			array('parent, pos, noindex', 'numerical', 'integerOnly'=>true),
			array('page, s_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, page, s_name, parent, pos, noindex', 'safe', 'on'=>'search'),
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
			'groups' => array(self::MANY_MANY, 'Groups', 'groups_menus(menu, group)'),
			'parent0' => array(self::BELONGS_TO, 'Menus', 'parent'),
			'menuses' => array(self::HAS_MANY, 'Menus', 'parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content', 'ID'),
			'page' => Yii::t('content', 'Page'),
			's_name' => Yii::t('content', 'Name'),
			'parent' => Yii::t('content', 'Parent'),
			'pos' => Yii::t('content', 'Pos'),
			'noindex' => Yii::t('content', 'Noindex'),
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
		$criteria->compare('page',$this->page,true);
		$criteria->compare('s_name',$this->s_name,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('pos',$this->pos);
		$criteria->compare('noindex',$this->noindex);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}