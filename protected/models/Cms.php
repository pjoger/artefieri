<?php

/**
 * This is the model class for table "cms".
 *
 * The followings are the available columns in table 'cms':
 * @property string $id
 * @property string $user
 * @property string $added
 * @property string $s_title
 * @property string $text_source
 * @property string $text_html
 * @property integer $visible
 * @property integer $public
 * @property string $s_meta_title
 * @property string $s_meta_keywords
 * @property string $s_meta_descr
 * @property string $s_text_breadcrumbs_src
 * @property string $text_breadcrumbs_html
 *
 * The followings are the available model relations:
 * @property Users $user0
 * @property Lang[] $langs
 */
class Cms extends CActiveRecord
{
	public $_display_title = '';
	public $_display_html = '';
	public $_display_src = '';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cms the static model class
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
		return 'cms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('s_title, text_source', 'required'),
			array('visible, public', 'numerical', 'integerOnly'=>true),
			array('user', 'length', 'max'=>10),
			array('s_title', 'length', 'max'=>255),
			array('s_meta_title, s_meta_keywords, s_meta_descr', 'length', 'max'=>500),
			array('added, text_source, text_html, s_text_breadcrumbs_src, text_breadcrumbs_html', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user, added, s_title, text_source, text_html, visible, public, s_meta_title, s_meta_keywords, s_meta_descr, s_text_breadcrumbs_src, text_breadcrumbs_html', 'safe', 'on'=>'search'),
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
			'user0' => array(self::BELONGS_TO, 'Users', 'user'),
			'langs' => array(self::MANY_MANY, 'Lang', 'cms_lang(cms, lang)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'user' => Yii::t('content','User'),
			'added' => Yii::t('content','Added'),
			's_title' => Yii::t('content','Title'),
			'text_source' => Yii::t('content','Text Source'),
			'text_html' => Yii::t('content','Text Html'),
			'visible' => Yii::t('content','Visible'),
			'public' => Yii::t('content','Public'),
			's_meta_title' => Yii::t('content','Meta Title'),
			's_meta_keywords' => Yii::t('content','Meta Keywords'),
			's_meta_descr' => Yii::t('content','Meta Description'),
			's_text_breadcrumbs_src' => Yii::t('content','Text Breadcrumbs Source'),
			'text_breadcrumbs_html' => Yii::t('content','Text Breadcrumbs Html'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('s_title',$this->s_title,true);
		$criteria->compare('text_source',$this->text_source,true);
		$criteria->compare('text_html',$this->text_html,true);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('public',$this->public);
		$criteria->compare('s_meta_title',$this->s_meta_title,true);
		$criteria->compare('s_meta_keywords',$this->s_meta_keywords,true);
		$criteria->compare('s_meta_descr',$this->s_meta_descr,true);
		$criteria->compare('s_text_breadcrumbs_src',$this->s_text_breadcrumbs_src,true);
		$criteria->compare('text_breadcrumbs_html',$this->text_breadcrumbs_html,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->added = date("Y-m-d H:i:s");
			}
			else
			{
			}
			$this->text_html = Yii::app()->decoda->parse($this->text_source);
			$this->text_breadcrumbs_html = Yii::app()->decoda->parse($this->s_text_breadcrumbs_src);
			return true;
		}
	}
	
	public function afterSave()
	{
		$event = new EventsLog;
// 		$event->event = 0;
		$event->event_time = date("Y-m-d H:i:s");
		$event->user = Yii::app()->user->id;
// 		$event->id_aux = null;
		$scenario = $this->getScenario();
		$event->s_comment = 'CMS ' . strtoupper($scenario) . ': ID=' . $this->id . ', NAME=' . $this->s_title;
// 		$event->eve_group = 1;
		$event->ip = Yii::app()->cookie->getIP();
		$event->save();
		
		parent::afterSave();
		
	}
	
	public function afterFind()
	{
		$lang = Yii::app()->cookie->getLanguage();
		$lang_id = Lang::model()->findByAttributes(array('lang_2'=>$lang))->id;
		
		$cms_lang = CmsLang::model()->findByAttributes(array('cms'=>$this->id, 'lang'=>$lang_id));
		
		if ($cms_lang){
			$this->_display_title = $cms_lang->s_title != '' ? $cms_lang->s_title : $this->s_title;
			$this->_display_html  = $cms_lang->text_html != '' ? $cms_lang->text_html : $this->text_html;
			$this->_display_src   = $cms_lang->text_source != '' ? $cms_lang->text_source : $this->text_source;
		} else {
			$this->_display_title = $this->s_title;
			$this->_display_html  = $this->text_html;
			$this->_display_src   = $this->text_source;
		}
		
		parent::afterFind();
	}
	
	/**
	 * Suggests a list of existing values matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of names to be returned
	 * @return array list of matching lastnames
	 */
	public function suggest($keyword,$limit=20)
	{
		$models=$this->findAll(array(
				'condition'=>'(s_title like :keyword) or (id like :keyword)',
				'order'=>'s_title',
				'limit'=>$limit,
				'params'=>array(':keyword'=>"%$keyword%")
		));
		$suggest=array();
		foreach($models as $model) {
			$suggest[] = array(
					'label'=>$model->s_title,  // label for dropdown list
					'value'=>$model->s_title,  // value for input field
					'id'=>$model->id,       // return values from autocomplete
			);
		}
		return $suggest;
	}
	
	
	
	
}