<?php

class NewsCountriesController extends Controller
{

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	
	public function actionAdmin()
	{
		//$this->render('admin');
		$model=new NewsCountries('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NewsCountries']))
			$model->attributes=$_GET['NewsCountries'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCreate()
	{
		//$this->render('create');
		$model=new NewsCountries();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['NewsCountries']))
		{
			$model->attributes=$_POST['NewsCountries'];
 			if($model->validate()) {
				if($model->save()){
					if(!$_POST['ajaxmodal'])
						$this->redirect(array('view', 'id'=>array('news'=>$model->news, 'country'=>$model->country)));
					else return;
				}	
			}
		}

		// если запрос асинхронный, то нам нужно отдать только данные
		if(Yii::app()->request->isAjaxRequest){
			Yii::app()->end();
		}
		else {
			// если запрос не асинхронный, отдаём форму полностью
			$this->render('create',array(
				'model'=>$model,
			));
		}
	}

	public function actionDelete()
	{
		//$this->render('delete');
		$news = $_GET['id']['news'];
		$country = $_GET['id']['country'];
		
		$model=$this->loadModel($news,$country);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		//$this->render('index');
		$dataProvider=new CActiveDataProvider('NewsCountries');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionUpdate()
	{
		//$this->render('update');
 		$news = $_GET['id']['news'];
 		$country = $_GET['id']['country'];

		$model=$this->loadModel($news,$lang);

		if(isset($_POST['NewsCountries']))
		{
			$model->attributes=$_POST['NewsCountries'];
			if($model->save())
				$this->redirect(array('view','id'=>array('news'=>$model->news, 'country'=>$model->country)));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionView()
	{
 		$news = $_GET['id']['news'];
 		$country = $_GET['id']['country'];
		
		$criteria = new CDbCriteria();
		$criteria->condition = '(news = :news_id) and (country=:country_id)';
		$criteria->params = array(':news_id' => $news, ':country_id' => $country);
		$result = NewsCountries::model()->find($criteria);
		$model = $result;
		
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the 2 primary keys given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($news, $countries)
	{
		$model=NewsCountries::model()->getByNewsNCountry($news, $country);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='news_countries-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}