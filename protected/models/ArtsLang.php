<?php

/**
 * This is the model class for table "arts_lang".
 *
 * The followings are the available columns in table 'arts_lang':
 * @property string $art
 * @property integer $lang
 * @property string $s_name
 * @property string $text_descr_source
 * @property string $text_descr_html
 */
class ArtsLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArtsLang the static model class
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
		return 'arts_lang';
	}

	public function primaryKey()
	{
		// For composite primary key, return an array like the following
		return array('art', 'lang');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('art, lang, s_name', 'required'),
			array('lang', 'numerical', 'integerOnly'=>true),
			array('art',  'numerical', 'integerOnly'=>true),
			array('s_name', 'length', 'max'=>255),
			array('text_descr_source, text_descr_html', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('art, lang, s_name, text_descr_source, text_descr_html', 'safe', 'on'=>'search'),
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
			'lang' =>  Yii::t('general','Lang'),
			's_name' => Yii::t('content','Art title'),
			'text_descr_source' => Yii::t('content','Description'),
			'text_descr_html' => Yii::t('content','Description HTML'),
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
		$criteria->compare('lang',$this->lang, true);
		$criteria->compare('s_name',$this->s_name,true);
		$criteria->compare('text_descr_source',$this->text_descr_source,true);
		$criteria->compare('text_descr_html',$this->text_descr_html,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getByArtId($artId) {
	
		$criteria = new CDbCriteria();
		$criteria->condition = 'art = :art_id';
		$criteria->params = array(':art_id' => $artId);
		$translates = ArtsLang::model()->findAll($criteria);
	
		return $translates;
	}
	
	public function getByArtNLang($artid, $langid){
		$criteria = new CDbCriteria();
		$criteria->condition = '(art = :art_id) and (lang=:lang_id)';
		$criteria->params = array(':art_id' => $artid, ':lang_id' => $langid);
		$result = ArtsLang::model()->find($criteria);
		return $result;
	}
	
	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			$this->text_descr_html = Yii::app()->decoda->parse($this->text_descr_source);
			return true;
		}
	}

	public function afterSave($model=null)
	{
		$artId = $this->art;
		$artsRel = ArtsRelations::model()->findAll('art1=:artid', array(':artid'=>$artId));
		foreach ($artsRel as $artRel) {
			$this->cloneTranslate($this, $artRel->art2);
		}
		
	}
	
	private function cloneTranslate($baseModel, $artId)
	{
		$model = $baseModel;
		$model->isNewRecord = true;
		$model->art = $artId;
		if($model->save()){
			// saved translation
		}
	}
	
	public function afterDelete($model=null)
	{
		$artId = $this->art;
		$artsRel = ArtsRelations::model()->findAll('art1=:artid', array(':artid'=>$artId));
		foreach ($artsRel as $artRel) {
			$modelT = ArtsLang::model()->find('art=:artid and lang=:langid', array(':artid'=>$artRel->art2, ':langid'=>$this->lang));
			$modelT->delete();
		}
	
	}
	
	
	
}