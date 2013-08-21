<?php

class PersonsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2FiltersAlfa';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','LoadPersons'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($type = '', $value = '', $f = '')
	{
		$_filters = array();

		if(isset($_GET))
		{
			$f = isset($f) ? urldecode($f) : '';
			$_filters = json_decode($f, true);
			$type  = isset($_GET['type'])  ? $_GET['type']  : null;
			$value = isset($_GET['value']) ? $_GET['value'] : null;
			if ($type !== null && $value !== null)
			{
				$_filters[$type] = $value;
				Yii::app()->params['filtre'] = json_encode($_filters);
			}
		}

		$limit = 20;
		$criteria = new CDbCriteria(
      array(
        'with' => array(
          'arts'=>array(
            'select' => false,
            'joinType'=>'INNER JOIN',
            'condition' => 'arts_arts.relation=1',
            'together' => true,
           ),
/*          'langs' => array(
            'on' => 'langs.lang_2=:lang',
            'params' => array(':lang'=> Yii::app()->language),
            'together' => true,
          ),*/
         )
      )
    );

		if(count($_filters) > 0){
			foreach ($_filters as $key=>$filter)
			{
				switch ($key)
				{
					case 'limit':
						$limit = $filter;
						break;
					case 'author':
						$criteria->join .= 'INNER JOIN `persons_lang` ON `t`.`id` = `persons_lang`.`person` ';
						$criteria->condition = '(`t`.`s_first_name` like "'. $filter .'%") OR (`t`.`s_middle_name` like "'. $filter .'%") OR (`t`.`s_last_name` like "'. $filter .'%")';
						$criteria->condition = '(`persons_lang`.`s_first_name` like "'. $filter .'%") OR (`persons_lang`.`s_middle_name` like "'. $filter .'%") OR (`persons_lang`.`s_last_name` like "'. $filter .'%")';
						break;
				}
			}
		}
		$criteria->distinct = true;

		$count = Persons::model()->count($criteria);
		$pages = new MyPagination($count);
		$pages->pageSize = $limit;
		$pages->applyLimit($criteria);
		$persons  = Persons::model()->findAll($criteria);

		$dataProvider=new CActiveDataProvider('Persons',array(
                'criteria'=>$criteria,
                'pagination'=>$pages,
            ));

		$this->render('index', array(
				"dataProvider" => $dataProvider,
				"model" => $persons,
				"pages" => $pages,
				"limit" => $limit,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Persons::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionLoadPersons()
	{
		if (isset($_POST['alfa']) && !empty($_POST['alfa'])){
			$alfa = $_POST['alfa'];
			$data = Persons::model()->getPersonsByAlfa($alfa);

			$items = array();
			$_filters = json_decode(Yii::app()->params['filtre'], true);

			foreach ($data as $person)
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

			$this->renderPartial('menu/filterPersons', array('items'=>$items));

		}

	}


}
