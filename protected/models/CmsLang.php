<?php

/**
 * This is the model class for table "cms_lang".
 *
 * The followings are the available columns in table 'cms_lang':
 * @property string $cms
 * @property integer $lang
 * @property string $s_title
 * @property string $text_source
 * @property string $text_html
 */
class CmsLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CmsLang the static model class
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
		return 'cms_lang';
	}

	public function primaryKey()
	{
		// For composite primary key, return an array like the following
		return array('cms', 'lang');
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cms, lang, s_title', 'required'),
			array('lang', 'numerical', 'integerOnly'=>true),
			array('cms', 'length', 'max'=>10),
			array('s_title', 'length', 'max'=>255),
			array('text_source, text_html', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cms, lang, s_title, text_source, text_html', 'safe', 'on'=>'search'),
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
			'cms' => Yii::t('content','Cms'),
			'lang' => Yii::t('general','Lang'),
			's_title' => Yii::t('content','Title'),
			'text_source' => Yii::t('content','Text Source'),
			'text_html' => Yii::t('content','Text Html'),
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

		$criteria->compare('cms',$this->cms,true);
		$criteria->compare('lang',$this->lang);
		$criteria->compare('s_title',$this->s_title,true);
		$criteria->compare('text_source',$this->text_source,true);
		$criteria->compare('text_html',$this->text_html,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getByCmsId($cmsId) {
	
		$criteria = new CDbCriteria();
		$criteria->condition = 'cms = :cms_id';
		$criteria->params = array(':cms_id' => $cmsId);
		$results = CmsLang::model()->findAll($criteria);
	
		return $results;
	}
	
	public function getByCmsNLang($cmsid, $langid){
		$criteria = new CDbCriteria();
		$criteria->condition = '(cms = :cms_id) and (lang=:lang_id)';
		$criteria->params = array(':cms_id' => $cmsid, ':lang_id' => $langid);
		$result = CmsLang::model()->find($criteria);
		return $result;
	}
	
	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			$this->text_html = Yii::app()->decoda->parse($this->text_source);
			return true;
		}
	}
	
	public function afterSave($model=null)
	{
		$cmsId = $this->cms;
	}
	
	public function afterDelete($model=null)
	{
		$cmsId = $this->cms;
	}

}