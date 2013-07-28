<?php

/**
 * This is the model class for table "arts".
 *
 * The followings are the available columns in table 'arts':
 * @property string $id
 * @property integer $type
 * @property string $s_name
 * @property string $added
 * @property string $produced
 * @property string $last_update
 * @property string $currency
 * @property string $price
 * @property string $site_price
 * @property integer $options
 * @property integer $amount
 * @property string $cover
 * @property integer $cover_w
 * @property integer $cover_h
 * @property integer $size_x
 * @property integer $size_y
 * @property string $text_descr_source
 * @property string $text_descr_html
 *
 * The followings are the available model relations:
 * @property ArtTypes $type0
 * @property Currency $currency0
 * @property ArtsDiscount $artsDiscount
 * @property Genres[] $genres
 * @property Lang[] $langs
 * @property ArtsRelations[] $artsRelations
 * @property ArtsRelations[] $artsRelations1
 * @property Basket[] $baskets
 * @property Persons[] $persons
 */
class Arts extends CActiveRecord
{
	public $_image_file = null;
	public $_thumb_file = NULL;
	public $oldRecord;
	public $_display_name = '';
	public $_display_text = '';
	public $_display_src = '';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Arts the static model class
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
		return 'arts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, s_name', 'required'),
			array('type, options, amount, cover_w, cover_h, size_x, size_y', 'numerical', 'integerOnly'=>true),
			array('s_name', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
			array('price, site_price', 'length', 'max'=>10),
			array('cover', 'file', 'allowEmpty'=>true, 'types'=>'gif, jpg, png'),
			array('produced, text_descr_source, text_descr_html', 'safe'),
			array('cover', 'unsafe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, s_name, added, produced, last_update, currency, price, site_price, options, amount, cover, cover_w, cover_h, size_x, size_y, text_descr_source, text_descr_html', 'safe', 'on'=>'search'),
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
			'types' => array(self::BELONGS_TO, 'ArtTypes', 'type'),
			'currencies' => array(self::BELONGS_TO, 'Currency', 'currency'),
			'artsDiscounts' => array(self::HAS_MANY, 'ArtsDiscount', 'art'),
			'genres0' => array(self::MANY_MANY, 'Genres', 'arts_genres(art, genre)'),
			'langs' => array(self::MANY_MANY, 'Lang', 'arts_lang(art, lang)'),
			'artsRelations1' => array(self::HAS_MANY, 'ArtsRelations', 'art1'),
			'artsRelations2' => array(self::HAS_MANY, 'ArtsRelations', 'art2'),
			'baskets' => array(self::HAS_MANY, 'Basket', 'art'),
			'persons0' => array(self::MANY_MANY, 'Persons', 'ownership(art, person)'),
			'ownership0' => array(self::HAS_MANY, 'Ownership', 'art'),
			'artslang0' => array(self::HAS_MANY, 'ArtsLang', 'art'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('content','ID'),
			'type' => Yii::t('content','Art type'),
			's_name' => Yii::t('content','Art title'),
			'added' => Yii::t('content','Added'),
			'produced' => Yii::t('content','Produced'),
			'last_update' => Yii::t('content','Last update'),
			'currency' => Yii::t('general','Currency'),
			'price' => Yii::t('content','Purchase price'),
			'site_price' => Yii::t('content','Site price'),
			'options' => Yii::t('content','On sale'),
			'amount' => Yii::t('content','Amount'),
			'cover' => Yii::t('content','Cover'),
			'cover_w' => Yii::t('content','Cover Width'),
			'cover_h' => Yii::t('content','Cover Height'),
			'size_x' => Yii::t('content','Size Width'),
			'size_y' => Yii::t('content','Size Height'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('s_name',$this->s_name,true);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('produced',$this->produced,true);
		$criteria->compare('last_update',$this->last_update,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('site_price',$this->site_price,true);
		$criteria->compare('options',$this->options);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('cover_w',$this->cover_w);
		$criteria->compare('cover_h',$this->cover_h);
		$criteria->compare('size_x',$this->size_x);
		$criteria->compare('size_y',$this->size_y);
		$criteria->compare('text_descr_source',$this->text_descr_source,true);
		$criteria->compare('text_descr_html',$this->text_descr_html,true);

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
				$this->last_update = date("Y-m-d H:i:s");
			}
			else
			{
				$this->last_update = date("Y-m-d H:i:s");
			}
			$this->produced = date('Y-m-d', strtotime($this->produced));

			$this->text_descr_html = Yii::app()->decoda->parse($this->text_descr_source);

			return true;
		}
	}

	public function afterSave($model=null)
	{

		if(isset($_POST['authors']))
		{
			$authors = $_POST['authors'];
			if(count($authors)>0)
			foreach($authors as $authorid){
				$ownership = new Ownership();
				$ownership->art = $this->id;
				$ownership->person = $authorid;
				$links = Ownership::model()->getByArtNPerson($this->id, $authorid);
				if(!$links || count($links) == 0)
					if($ownership->save()){
						// ownership set
					}
			}
		}

		if (isset($_POST['genres']))
		{
			$genres = $_POST['genres'];
			if(count($genres))
			foreach ($genres as $genre) {
				// insert new link if not exist
				$links = ArtsGenres::model()->getByArtNGenre($this->id, $genre);
				if(!$links || count($links) == 0){
					$modelAG = new ArtsGenres();
					$modelAG->art = $this->id;
					$modelAG->genre = $genre;
					if($modelAG->save()){
						// saved association Art-Genre
					}
				}
			}
		}

		// clone record
		if(isset($_POST['Arts_copy']) || isset($_POST['Arts_foto_copy']))
		{
			$artCopy = $_POST['Arts_copy'];
			unset($_POST['Arts_copy']);
			$artPhotoCopy = $_POST['Arts_foto_copy'];
			unset($_POST['Arts_foto_copy']);

			// clone record as copy
			if(isset($artCopy))
			{
				$modelACopy = ArtsRelations::model()->find('art1=:artid and relation=:rel', array(':artid'=>$_GET['id'], ':rel'=>'2'));
				if(!isset($modelACopy))
					$this->cloneArt(Arts::findByPk($_GET['id']), $_POST['Arts_price_2'], $_POST['Arts_site_price_2'], 2);
			}

			// clone record as photo copy
			if(isset($artPhotoCopy))
			{
				$modelFCopy = ArtsRelations::model()->find('art1=:artid and relation=:rel', array(':artid'=>$_GET['id'], ':rel'=>'3'));
				if(!isset($modelFCopy))
					$this->cloneArt(Arts::findByPk($_GET['id']), $_POST['Arts_foto_price_2'], $_POST['Arts_foto_site_price_2'], 3);
			}
		}

		$event = new EventsLog;
// 		$event->event = 0;
 		$event->event_time = date("Y-m-d H:i:s");
 		$event->user = Yii::app()->user->id;
// 		$event->id_aux = null;
		$scenario = $this->getScenario();
		$event->s_comment = 'ARTS ' . strtoupper($scenario) . ': ID=' . $this->id . ', NAME=' . $this->s_name;
// 		$event->eve_group = 1;
		$event->ip = Yii::app()->cookie->getIP();
		$event->save();

		if (isset($this->oldRecord)){
			if($this->oldRecord->price != $this->price)
			{
				$event = new EventsLog;
		// 		$event->event = 0;
				$event->event_time = date("Y-m-d H:i:s");
				$event->user = Yii::app()->user->id;
		// 		$event->id_aux = null;
				$scenario = $this->getScenario();
				$event->s_comment = 'ARTS ' . strtoupper($scenario) . ': OLD PRICE =' . $this->oldRecord->price . ', NEW PRICE =' . $this->price;
		// 		$event->eve_group = 1;
				$event->ip = Yii::app()->cookie->getIP();
				$event->save();
			}
			if($this->oldRecord->site_price != $this->site_price )
			{
				$event = new EventsLog;
		// 		$event->event = 0;
				$event->event_time = date("Y-m-d H:i:s");
				$event->user = Yii::app()->user->id;
		// 		$event->id_aux = null;
				$scenario = $this->getScenario();
				$event->s_comment = 'ARTS ' . strtoupper($scenario) . ': OLD SITE_PRICE =' . $this->oldRecord->site_price . ', NEW SITE_PRICE =' . $this->site_price;
		// 		$event->eve_group = 1;
				$event->ip = Yii::app()->cookie->getIP();
				$event->save();
			}
		}

		parent::afterSave();

	}

	protected function afterFind()
	{
		$this->oldRecord=clone $this;

		$date = date('Y-m-d', strtotime($this->produced));
		$this->produced = $date;

		$file_name = str_pad($this->id,8,"0",STR_PAD_LEFT).'.'.$this->cover;
		//$thumb_name =  str_pad($this->id,8,"0",STR_PAD_LEFT).'_320x240.'.$this->cover;
		$splited = str_split($file_name, 2);
		$file_path = $splited[0] .'/'. $splited[1] .'/'. $splited[2] . '/';
    $file_name = '/images/covers/'.$file_path.$file_name;

		if (file_exists(Yii::app()->basePath.'/..'.$file_name)){
			$this->_image_file = Yii::app()->baseUrl.$file_name;
      $thumb_name = $this->createThumbnail(Yii::app()->basePath.'/..'.$file_name, 320, 240);
      if ($thumb_name){
        $this->_thumb_file = Yii::app()->baseUrl.'/images/covers/'.$file_path.$thumb_name;
      }
    }

		$lang = Yii::app()->cookie->getLanguage();
		$lang_id = Lang::model()->findByAttributes(array('lang_2'=>$lang))->id;

		$arts_lang = ArtsLang::model()->findByAttributes(array('art'=>$this->id, 'lang'=>$lang_id));

		if ($arts_lang){
			$this->_display_name = $arts_lang->s_name != '' ? $arts_lang->s_name : $this->s_name;
			$this->_display_text = $arts_lang->text_descr_html != '' ? $arts_lang->text_descr_html : $this->text_descr_html;
			$this->_display_src  = $arts_lang->text_descr_source != '' ? $arts_lang->text_descr_source : $this->text_descr_source;
		} else {
			$this->_display_name = $this->s_name;
			$this->_display_text = $this->text_descr_html;
			$this->_display_src  = $this->text_descr_source;
		}

		parent::afterFind();
	}

	protected function createThumbnail_deprecated($image_file, $thumb_file, $file_path, $force=false)
	{
		Yii::import('application.extensions.image.Image');
		$image = new Image(Yii::app()->basePath.'/../images/covers/'.$file_path.$image_file);
		$image->resize(300, 300, Image::WIDTH);
		$image->save(Yii::app()->basePath.'/../images/covers/'.$file_path.$thumb_file);
		return Yii::app()->baseUrl.'/images/covers/'.$file_path.$thumb_file;
	}

	protected function createThumbnail($image_file, $w='', $h='', $force=false)
	{
    if (!$image_file || (!$w and !$h)){
      Yii::log('[WARN] wrong params', 'warning', 'system.web.CController');
      return null;
    }
    $finfo = pathinfo($image_file);
    $rfile = $finfo['filename'].'_'.$w.'x'.$h.'.'.$finfo['extension'];
    if ($force || !file_exists($rfile)){
      Yii::import('application.extensions.image.Image');
      $image = new Image($image_file);
      $image->resize($w, $h, Image::AUTO);
      $image->save($finfo['dirname'].'/'.$rfile);
    }
		return $rfile;
	}

  private function cloneArt($baseArt, $price1, $price2, $relType)
	{
		$model = $baseArt;
		$masterId = $baseArt->id;
		$model->id = NULL;
		$model->isNewRecord = true;
		$model->type = $relType;
		$model->price = $price1;
		$model->site_price = $price2;
		if($model->save()){
			$secId = $model->id;
			$artsRelation = new ArtsRelations();
			$artsRelation->art1 = $masterId;
			$artsRelation->art2 = $secId;
			$artsRelation->relation = $relType;
			if($artsRelation->save()){
				// saved relation
			}
		}
	}

	public function isExclusive(){
		$s_art_type = SuperArtTypesToTypes::model()->with('super0')->findByAttributes(array('sub'=>$this->type));
		if ($s_art_type !== null)
			return $s_art_type->super0->exclusive;
		else
			return 0;
	}

	public function needBaguette(){
		return ArtTypes::model()->findByPk($this->type)->need_baguette;
	}

	public function decAmount(){

		$transaction =Yii::app()->db->beginTransaction();
		try
		{
			$this->amount -= 1;
			$this->save();
			$transaction->commit();

			if ($this->amount == 0){
				$baskets = Basket::model()->findAllByAttributes(array('art'=>$this->id));
				foreach ($baskets as $basket){
					if ($basket->delivery == null)
						$basket->delete();
					else {
						$order = DeliveryInfo::model()->findByPk($basket->delivery);
						if ($order->status == 0 || $order->status == 4){
							$basket->delete();
						}
					}
				}
			}

		}
		catch(Exception $e) // an exception is raised if a query fails
		{
			$transaction->rollback();
		}

	}

	public function incAmount(){

		$transaction =Yii::app()->db->beginTransaction();
		try
		{
			$this->amount += 1;
			$this->save();
			$transaction->commit();
		}
		catch(Exception $e) // an exception is raised if a query fails
		{
			$transaction->rollback();
		}

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
				'condition'=>'(s_name like :keyword) or (id like :keyword)',
				'order'=>'s_name',
				'limit'=>$limit,
				'params'=>array(':keyword'=>"%$keyword%")
		));
		$suggest=array();
		foreach($models as $model) {
			$suggest[] = array(
					'label'=>$model->s_name,  // label for dropdown list
					'value'=>$model->s_name,  // value for input field
					'id'=>$model->id,       // return values from autocomplete
					'type'=>$model->types->s_name,
			);
		}
		return $suggest;
	}

  public function GetLastCover($super = 0)
  {
			$criteria = new CDbCriteria(array(
          'select' => 't.id, t.cover, t.cover_w, t.cover_h',
          'join' => 'JOIN `super_art_types_to_types` ON `t`.`type` = `super_art_types_to_types`.`sub`',
          'condition' => 'super_art_types_to_types.super = :superID'
                        .' AND t.cover IS NOT NULL AND t.cover_w > 0',
          'order' => 't.id DESC',
          'limit' => '1',
          'params' => array(':superID' => $super)
      ));
			//$art = Arts::model()->find($criteria);
			$art = $this->find($criteria);

			if($art && $art['cover']){
				$file_name = str_pad($art['id'],8,"0",STR_PAD_LEFT).'.'.$art['cover'];
				$splited = str_split($file_name, 2);
				$file_path = $splited[0] .'/'. $splited[1] .'/'. $splited[2] . '/';
				if (file_exists(Yii::app()->basePath.'/../images/covers/'.$file_path.$file_name)){
					$art->_image_file = Yii::app()->baseUrl.'/images/covers/'.$file_path.$file_name;
					return $art->_image_file;
        }
				//echo "<span> ID=\"{$arts->id}\" NAME=\"{$arts->_image_file}\"</span>";
			} else {
//				echo CVarDumper::dump($art['cover'],3,true);
      }
			return "";
  }


}