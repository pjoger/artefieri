<?php

/**
 * This is the model class for table "persons_lang".
 *
 * The followings are the available columns in table 'persons_lang':
 * @property string $person
 * @property integer $lang
 * @property string $s_first_name
 * @property string $s_middle_name
 * @property string $s_last_name
 * @property string $s_full_name
 * @property string $text_descr_source
 * @property string $text_descr_html
 */
class PersonsLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonsLang the static model class
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
		return 'persons_lang';
	}

	public function primaryKey()
	{
		// For composite primary key, return an array like the following
		return array('person', 'lang');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('person, lang, s_first_name, s_last_name', 'required'),
			array('lang', 'numerical', 'integerOnly'=>true),
			array('person', 'numerical', 'integerOnly'=>true, 'max'=>10),
			array('s_first_name, s_middle_name, s_last_name ', 'length', 'max'=>255),
			array('text_descr_source, text_descr_html', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('person, lang, s_first_name, s_middle_name, s_last_name, s_full_name, text_descr_source, text_descr_html', 'safe', 'on'=>'search'),
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
			'person' => Yii::t('content','Author'),
			'lang' => Yii::t('general','Lang'),
			's_first_name' => Yii::t('content','First Name'),
			's_middle_name' => Yii::t('content','Middle Name'),
			's_last_name' => Yii::t('content','Last Name'),
			's_full_name' => Yii::t('content','Full Name'),
			'text_descr_source' => Yii::t('content','Description Source'),
			'text_descr_html' => Yii::t('content','Description Html'),
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

		$criteria->compare('person',$this->person,true);
		$criteria->compare('lang',$this->lang);
		$criteria->compare('s_first_name',$this->s_first_name,true);
		$criteria->compare('s_middle_name',$this->s_middle_name,true);
		$criteria->compare('s_last_name',$this->s_last_name,true);
		$criteria->compare('s_full_name',$this->s_full_name,true);
		$criteria->compare('text_descr_source',$this->text_descr_source,true);
		$criteria->compare('text_descr_html',$this->text_descr_html,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getByPersonId($personId) {
	
		$criteria = new CDbCriteria();
		$criteria->condition = 'person = :person_id';
		$criteria->params = array(':person_id' => $personId);
		$translates = PersonsLang::model()->findAll($criteria);
	
		return $translates;
	}
	
	public function getByPersonNLang($personid, $langid){
		$criteria = new CDbCriteria();
		$criteria->condition = '(person = :person_id) and (lang=:lang_id)';
		$criteria->params = array(':person_id' => $personid, ':lang_id' => $langid);
		$result = PersonsLang::model()->find($criteria);
		return $result;
	}
	
	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			$this->s_full_name = $this->s_first_name . ' ' . $this->s_middle_name . ' ' . $this->s_last_name; 
			$this->text_descr_html = Yii::app()->decoda->parse($this->text_descr_source);
			return true;
		}
	}
	
	
}