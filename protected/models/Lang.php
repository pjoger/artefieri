<?php

/**
 * This is the model class for table "lang".
 *
 * The followings are the available columns in table 'lang':
 * @property integer $id
 * @property string $lang_2
 * @property string $domen
 * @property string $s_name
 *
 * The followings are the available model relations:
 * @property Arts[] $arts
 * @property Cms[] $cms
 * @property Countries[] $countries
 * @property Genres[] $genres
 * @property Persons[] $persons
 * @property Recenses[] $recenses
 * @property Users[] $users
 */
class Lang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Lang the static model class
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
		return 'lang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lang_2, domen', 'required'),
			array('lang_2', 'length', 'max'=>2),
			array('domen', 'length', 'max'=>4),
			array('s_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, lang_2, domen, s_name', 'safe', 'on'=>'search'),
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
			'arts' => array(self::MANY_MANY, 'Arts', 'arts_lang(lang, art)'),
			'cms' => array(self::MANY_MANY, 'Cms', 'cms_lang(lang, cms)'),
			'countries' => array(self::HAS_MANY, 'Countries', 'lang'),
			'genres' => array(self::MANY_MANY, 'Genres', 'genres_lang(lang, genre)'),
			'persons' => array(self::MANY_MANY, 'Persons', 'persons_lang(lang, person)'),
			'recenses' => array(self::HAS_MANY, 'Recenses', 'lang'),
			'users' => array(self::HAS_MANY, 'Users', 'lang'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'lang_2' => Yii::t('general','Lang'),
			'domen' => Yii::t('content','Domain'),
			's_name' =>  Yii::t('content','Title'),
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
		$criteria->compare('lang_2',$this->lang_2,true);
		$criteria->compare('domen',$this->domen,true);
		$criteria->compare('s_name',$this->s_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function menuItems()
	{
		$model = Lang::model()->findAll();
		$items = array();
		
		if (empty($model))
			return $items;
			
		foreach ($model as $lang)
		{
			$items[] = array(
					'label'=>strtoupper($lang->lang_2),
					'url'=>'#',
					'itemOptions'=>array('class'=>"item"),
					'linkOptions'=>array('title'=>$lang->s_name),
					);
		}
		
		return $items;
	}

	public function arrayItems()
	{
		$model = Lang::model()->findAll();
		$items = array();
	
		if (empty($model))
			return $items;
	
		foreach ($model as $lang)
		{
			$items[$lang->lang_2] = $lang->s_name;
		}
	
		return $items;
	}
	
}