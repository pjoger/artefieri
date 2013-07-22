<?php

class CitiesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','LoadCities'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GetByCountry'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Cities;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cities']))
		{
			$model->attributes=$_POST['Cities'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cities']))
		{
			$model->attributes=$_POST['Cities'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Cities');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cities('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cities']))
			$model->attributes=$_GET['Cities'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Get Cities by Country
	 */
	public function actionGetByCountry()
	{
		// accept only AJAX request (comment this when debugging)
		if (!Yii::app()->request->isAjaxRequest) {
			exit();
		}
		if(isset($_POST['country'])){
			if(!is_array($_POST['country']))
			{
				//$countries = array();
				$countries = explode(',', $_POST['country']); //$_POST['country'];
			} else {
				$countries = $_POST['country'];
			}
			foreach($countries as $country)
			{
				$cities = Cities::model()->getCitiesByCountry($country);
				foreach($cities as $city){
					echo "<option value=\"{$city->id}\">{$city->s_name}</option>\n";
				}
			}
		} else {
			$cities = Cities::model()->findAll();
			foreach($cities as $city){
				echo "<option value=\"{$city->id}\">{$city->s_name}</option>\n";
			}
		}
	}
	
	public function actionLoadCities()
	{
		if (isset($_POST['country']) && !empty($_POST['country']))
			$data = Cities::model()->findAll('country=:country_id',array(':country_id'=>(int) $_POST['country']));
		else
			$data = Cities::model()->findAll();
		//$data->dbCriteria->order = 's_name ASC';
		$data = CHtml::listData($data, 'id', 's_name');
		echo "<option value=''>- ". Yii::t('content', 'City') ." -</option>";
		foreach ($data as $value=>$city_name)
		{
			echo CHtml::tag('option', array('value'=>$value), CHtml::encode($city_name), true);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Cities::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cities-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
