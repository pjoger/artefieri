<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property string $id
 * @property string $user
 * @property string $added
 * @property string $s_title
 * @property string $text_source
 * @property string $text_html
 * @property integer $is_archive
 * @property integer $visible
 * @property string $parent
 *
 * The followings are the available model relations:
 * @property Users $user0
 * @property News $parent0
 * @property News[] $news
 * @property Cities[] $cities
 * @property Countries[] $countries
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return 'news';
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
			array('is_archive, visible', 'numerical', 'integerOnly'=>true),
			array('user, parent', 'length', 'max'=>10),
			array('s_title', 'length', 'max'=>255),
			array('added, text_source, text_html', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user, added, s_title, text_source, text_html, is_archive, visible, parent', 'safe', 'on'=>'search'),
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
			'parent0' => array(self::BELONGS_TO, 'News', 'parent'),
			'news' => array(self::HAS_MANY, 'News', 'parent'),
			'cities' => array(self::MANY_MANY, 'Cities', 'news_cities(news, city)'),
			'countries' => array(self::MANY_MANY, 'Countries', 'news_countries(news, country)'),
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
			'is_archive' => Yii::t('content','Is Archive'),
			'visible' => Yii::t('content','Visible'),
			'parent' => Yii::t('content','Parent'),
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
		$criteria->compare('is_archive',$this->is_archive);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('parent',$this->parent,true);

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
				
			$this->text_html = Yii::app()->decoda->parse($this->text_source);
	
			return true;
		}
	}
	
	public function afterSave()
	{
		if(isset($_POST['News']['countries_selected']))
		{
			$countries = $_POST['News']['countries_selected'];
			if(count($countries)>0)
				foreach($countries as $country){
				$newsCountry = new NewsCountries(); 
				$newsCountry->news = $this->id;
				$newsCountry->country = $country;
				$links = NewsCountries::model()->getByNewsNCountry($this->id, $country);
				if(!$links || count($links) == 0)
					if($newsCountry->save()){
					// newsCountry set
				}
			}
		}
		
		$event = new EventsLog;
// 		$event->event = 0;
 		$event->event_time = date("Y-m-d H:i:s");
 		$event->user = Yii::app()->user->id;
// 		$event->id_aux = null;
		$scenario = $this->getScenario();
		$event->s_comment = 'NEWS ' . strtoupper($scenario) . ': ID=' . $this->id . ', TITLE=' . $this->s_title;
// 		$event->eve_group = 1;
		$event->ip = Yii::app()->cookie->getIP();
		$event->save();
		
		parent::afterSave();
	}
	
	protected function afterFind()
	{
		$date = date('Y-m-d', strtotime($this->added));
		$this->added = $date;
		
		parent::afterFind();
	}

}