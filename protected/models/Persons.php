<?php

/**
 * This is the model class for table "persons".
 *
 * The followings are the available columns in table 'persons':
 * @property string $id
 * @property string $s_first_name
 * @property string $s_middle_name
 * @property string $s_last_name
 * @property string $s_full_name
 * @property string $s_phone
 * @property string $s_address
 * @property string $s_email
 * @property string $s_www
 * @property string $added
 * @property string $text_descr_source
 * @property string $text_descr_html
 * @property string $birth
 * @property string $photo
 * @property integer $photo_w
 * @property integer $photo_h
 * @property integer $lvl
 *
 * The followings are the available model relations:
 * @property Users[] $users
 * @property Arts[] $arts
 * @property Lang[] $langs
 */
class Persons extends CActiveRecord
{
	public $_image_file = null;
	public $_thumb_file = null;
	public $_display_first_name = '';
	public $_display_middle_name = '';
	public $_display_last_name = '';
	public $_display_full_name = '';
	public $_display_text_source = '';
	public $_display_text_html = '';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Persons the static model class
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
		return 'persons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('s_first_name, s_last_name', 'required'),
			array('photo_w, photo_h, lvl', 'numerical', 'integerOnly'=>true),
			array('s_first_name, s_middle_name, s_last_name, s_full_name, s_address', 'length', 'max'=>255),
			array('s_phone, s_email, s_www', 'length', 'max'=>50),
			array('photo', 'file', 'allowEmpty'=>true, 'types'=>'gif, jpg, png'),
			array('added, text_descr_source, text_descr_html, birth', 'safe'),
			array('photo', 'unsafe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, s_first_name, s_middle_name, s_last_name, s_full_name, s_phone, s_address, s_email, s_www, added, text_descr_source, text_descr_html, birth, lvl', 'safe', 'on'=>'search'),
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
			'users' => array(self::MANY_MANY, 'Users', 'copyrights(person, user)'),
			'arts' => array(self::MANY_MANY, 'Arts', 'ownership(person, art)'),
/*			'langs' => array(self::HAS_MANY, 'PersonsLang', 'person',
        'with' => array(

        ),
      ),*/
			'langs' => array(self::MANY_MANY, 'Lang', 'persons_lang(person, lang)',
/*        'with' => array(

        ),*/
      ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			's_first_name' => Yii::t('content','First Name'),
			's_middle_name' => Yii::t('content','Middle Name'),
			's_last_name' => Yii::t('content','Last Name'),
			's_full_name' => Yii::t('content','Full Name'),
			's_phone' => Yii::t('content','Phone'),
			's_address' => Yii::t('content','Address'),
			's_email' => Yii::t('content','E-Mail'),
			's_www' => Yii::t('content','Www'),
			'added' => Yii::t('content','Added'),
			'text_descr_source' => Yii::t('content','Description'),
			'text_descr_html' => Yii::t('content','Description Html'),
			'birth' => Yii::t('content','Birth date'),
			'photo' => Yii::t('content','Photo'),
			'photo_w' => Yii::t('content','Photo Width'),
			'photo_h' => Yii::t('content','Photo Height'),
			'lvl' => Yii::t('content','Lvl'),
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
		$criteria->compare('s_first_name',$this->s_first_name,true);
		$criteria->compare('s_middle_name',$this->s_middle_name,true);
		$criteria->compare('s_last_name',$this->s_last_name,true);
		$criteria->compare('s_full_name',$this->s_full_name,true);
		$criteria->compare('s_phone',$this->s_phone,true);
		$criteria->compare('s_address',$this->s_address,true);
		$criteria->compare('s_email',$this->s_email,true);
		$criteria->compare('s_www',$this->s_www,true);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('text_descr_source',$this->text_descr_source,true);
		$criteria->compare('text_descr_html',$this->text_descr_html,true);
		$criteria->compare('birth',$this->birth,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('photo_w',$this->photo_w);
		$criteria->compare('photo_h',$this->photo_h);
		$criteria->compare('lvl',$this->lvl);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
					'pageSize'=>25,
			)
		));
	}

	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->added = date("Y-m-d H:i:s");
				$this->lvl = 0;
			}
			if($this->s_www)
			{
				if( strpos($this->s_www,'http')===false)
				{
					$this->s_www = 'http://'. $this->s_www;
				}
			}
			$this->s_full_name = $this->s_first_name . ' ' . $this->s_middle_name . ' ' . $this->s_last_name;
			$this->birth = date('Y-m-d', strtotime($this->birth));
			$this->text_descr_html = Yii::app()->decoda->parse($this->text_descr_source);

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
		$event->s_comment = 'PERSONS ' . strtoupper($scenario) . ': ID=' . $this->id . ', NAME=' . $this->s_full_name;
// 		$event->eve_group = 1;
		$event->ip = Yii::app()->cookie->getIP();
		$event->save();

		parent::afterSave();

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
				'condition'=>'(s_full_name like :keyword) or (id like :keyword)',
				'order'=>'s_full_name',
				'limit'=>$limit,
				'params'=>array(':keyword'=>"%$keyword%")
		));
		$suggest=array();
		foreach($models as $model) {
			$suggest[] = array(
					'label'=>$model->s_full_name,  // label for dropdown list
					'value'=>$model->s_full_name,  // value for input field
					'id'=>$model->id,       // return values from autocomplete
					'level'=>$model->lvl,
			);
		}
		return $suggest;
	}

	protected function afterFind()
	{
		$date = date('Y-m-d', strtotime($this->birth));
		$this->birth = $date;

		$file_name = str_pad($this->id,8,"0",STR_PAD_LEFT).'.'.$this->photo;
		$thumb_name =  str_pad($this->id,8,"0",STR_PAD_LEFT).'_thumb.'.$this->photo;
		$splited = str_split($file_name, 2);
		$file_path = $splited[0] .'/'. $splited[1] .'/'. $splited[2] . '/';
		if (file_exists(Yii::app()->basePath.'/../images/persons/'.$file_path.$file_name))
			$this->_image_file = Yii::app()->baseUrl.'/images/persons/'.$file_path.$file_name;
		if (file_exists(Yii::app()->basePath.'/../images/persons/'.$file_path.$thumb_name))
			$this->_thumb_file = Yii::app()->baseUrl.'/images/persons/'.$file_path.$thumb_name;
		elseif (file_exists(Yii::app()->basePath.'/../images/persons/'.$file_path.$file_name))
			$this->_thumb_file = $this->createThumbnail($file_name, $thumb_name, $file_path);

		$lang = Yii::app()->cookie->getLanguage();
		$lang_id = Lang::model()->findByAttributes(array('lang_2'=>$lang))->id;

		$pers_lang = PersonsLang::model()->findByAttributes(array('person'=>$this->id, 'lang'=>$lang_id));

		if ($pers_lang){
			$this->_display_first_name  = $pers_lang->s_first_name !='' ? $pers_lang->s_first_name : $this->s_first_name;
			$this->_display_middle_name = $pers_lang->s_middle_name !='' ? $pers_lang->s_middle_name : $this->s_middle_name;
			$this->_display_last_name   = $pers_lang->s_last_name !='' ? $pers_lang->s_last_name : $this->s_last_name;
			$this->_display_full_name   = $pers_lang->s_full_name !='' ? $pers_lang->s_full_name : $this->s_full_name;
			$this->_display_text_source = $pers_lang->text_descr_source !='' ? $pers_lang->text_descr_source : $this->text_descr_source;
			$this->_display_text_html   = $pers_lang->text_descr_html !='' ? $pers_lang->text_descr_html : $this->text_descr_html;
		} else {
			$this->_display_first_name  = $this->s_first_name;
			$this->_display_middle_name = $this->s_middle_name;
			$this->_display_last_name   = $this->s_last_name;
			$this->_display_full_name   = $this->s_full_name;
			$this->_display_text_source = $this->text_descr_source;
			$this->_display_text_html   = $this->text_descr_html;
		}

		parent::afterFind();
	}

	protected function createThumbnail($image_file, $thumb_file, $file_path)
	{
		Yii::import('application.extensions.image.Image');
		$image = new Image(Yii::app()->basePath.'/../images/persons/'.$file_path.$image_file);
		$image->resize(300, 300, Image::WIDTH)->quality(75)->sharpen(20);
		$image->save(Yii::app()->basePath.'/../images/persons/'.$file_path.$thumb_file);
		return Yii::app()->baseUrl.'/images/persons/'.$file_path.$thumb_file;
	}

	public function menuItems()
	{
		$model = Persons::model()->findAll();
		$items = array();

		$_filters = json_decode(Yii::app()->params['filtre'], true);

		foreach ($model as $person)
		{
			$v = isset($_filters['author'])&&($_filters['author']==$person->id)? ' filter-active' : '';
			$items[] = array(
					'label'=>$person->_display_full_name,
					'url'=>array('arts/index','type'=>'author','value'=>$person->id, 'f' => urlencode(Yii::app()->params['filtre'])),
					'active'=>$v!='',
					'itemOptions'=>array('class'=>"item$v"),
					'linkOptions'=>array('title'=>$person->_display_full_name),
			);
		}

		return $items;
	}

	public function getPersonsByAlfa($alfa)
	{
		$criteria = new CDbCriteria();
		$criteria->join .= 'INNER JOIN `persons_lang` ON `t`.`id` = `persons_lang`.`person`';
		$criteria->condition = 't`.`s_first_name` like "'. $alfa .'%" OR `t`.`s_middle_name` like "'. $alfa .'%" OR `t`.`s_last_name` like "'. $alfa .'%"';
		$criteria->condition = '`persons_lang`.`s_first_name` like "'. $alfa .'%" OR `persons_lang`.`s_middle_name` like "'. $alfa .'%" OR `persons_lang`.`s_last_name` like "'. $alfa .'%"';
		$criteria->distinct = true;
		$results = Persons::model()->findAll($criteria);
		return $results;
	}

}