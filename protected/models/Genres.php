<?php

/**
 * This is the model class for table "genres".
 *
 * The followings are the available columns in table 'genres':
 * @property string $id
 * @property string $s_name
 * @property string $parent
 * @property integer $sort_key
 *
 * The followings are the available model relations:
 * @property Arts[] $arts
 * @property Genres $parent0
 * @property Genres[] $genres
 * @property Lang[] $langs
 */
class Genres extends CActiveRecord
{
	public $s_parent = null;
	public $_display_name = ''; 
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Genres the static model class
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
		return 'genres';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort_key', 'numerical', 'integerOnly'=>true),
			array('s_name', 'length', 'max'=>255),
			array('parent', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, s_name, parent, sort_key', 'safe', 'on'=>'search'),
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
			'arts' => array(self::MANY_MANY, 'Arts', 'arts_genres(genre, art)'),
			'parent' => array(self::BELONGS_TO, 'Genres', 'parent'),
			'genres' => array(self::HAS_MANY, 'Genres', 'parent'),
			'langs' => array(self::MANY_MANY, 'Lang', 'genres_lang(genre, lang)'),
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
			'parent' => Yii::t('content','Parent'),
			'sort_key' => Yii::t('content','Sort Key'),
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
		$criteria->compare('s_name',$this->s_name,true);
		$criteria->compare('parent',$this->parent,true);
		$criteria->compare('sort_key',$this->sort_key);
		$criteria->compare('s_parent', $this->s_parent);

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
			if ($this->parent == '')
			{
				$this->parent = NULL;
			}
			return true;
		}
	}
	
	public function menuItems($parent)
	{
		if ($parent != 0)
			$model = Genres::model()->findAllByAttributes(array('parent'=>$parent));
		else
			$model = Genres::model()->findAll();
		$items = array();
		
		$_filters = json_decode(Yii::app()->params['filtre'], true);
		
		if (empty($model))
			return $items;
		
		foreach ($model as $genre)
		{
			$v = isset($_filters['gen'])&&($_filters['gen']==$genre->id)? ' filter-active' : '';
			$items[] = array(
					'label'=>strtoupper($genre->s_name),
					'url'=>array('arts/index','type'=>'gen','value'=>$genre->id, 'f' => urlencode(Yii::app()->params['filtre'])),
					'active'=>$v!='',
					'itemOptions'=>array('class'=>"item$v"),
					'linkOptions'=>array('title'=>$genre->s_name),
					);
		}
		
		return $items;
	}

	
	public function findByPkNParent($id, $parent = null)
	{
		if ($parent == null)
			return $this->findByPk($id);
		else 
			return $this->findByAttributes(array('id'=>$id, 'parent'=>$parent));
		
	}
	
	protected function afterFind()
	{
		if ($this->parent !== null)
			$this->s_parent = $this->getItemParent($this->parent);
		else 
			$this->s_parent = $this->id;
		
		$lang = Yii::app()->cookie->getLanguage();
		$lang_id = Lang::model()->findByAttributes(array('lang_2'=>$lang))->id;
		
		$gen_lang = GenresLang::model()->findByAttributes(array('genre'=>$this->id, 'lang'=>$lang_id));
		
		if ($gen_lang){
			$this->_display_name = $gen_lang->s_name !='' ? $gen_lang->s_name : $this->s_name;
		} else {
			$this->_display_name = $this->s_name;
		}
		
		parent::afterFind();
	}
	
	protected function getItemParent($id)
	{
		$model = Genres::model()->findByPk($id);
		if ($model->parent !== null)
			return $this->getItemParent($model->parent);
		else 
			return $model->id;
	}
	
}