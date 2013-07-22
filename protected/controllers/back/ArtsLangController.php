<?php

class ArtsLangController extends Controller
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
		$model=new ArtsLang('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ArtsLang']))
			$model->attributes=$_GET['ArtsLang'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCreate()
	{
		$model=new ArtsLang;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ArtsLang']))
		{
			$model->attributes=$_POST['ArtsLang'];

 			if($model->validate()) {
				if($model->save()){
					if(!$_POST['ajaxmodal'])
						$this->redirect(array('view', 'id'=>array('art'=>$model->art, 'lang'=>$model->lang)));
					else return;
				}	
			}  
		}

		// если запрос асинхронный, то нам нужно отдать только данные
		if(Yii::app()->request->isAjaxRequest){
// 			$art = Arts::model()->findByPk($model->art);
// 			$this->renderPartial('_form', array(
// 				'model'=>$model,
// 				'art'=>$art,
// 			));
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
		
		$art = $_GET['id']['art'];
		$lang = $_GET['id']['lang'];
		
		$model=$this->loadModel($art,$lang);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionDeleteFromArt()
	{
		//$this->render('deleteFromArt');
		$art = $_POST['id']['art'];
		$lang = $_POST['id']['lang'];
		$this->loadModel($art, $lang)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		//$this->render('index');

		$dataProvider=new CActiveDataProvider('ArtsLang');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionUpdate()
	{
 		$art = $_GET['id']['art'];
 		$lang = $_GET['id']['lang'];

		$model=$this->loadModel($art,$lang);

		if(isset($_POST['ArtsLang']))
		{
			$model->attributes=$_POST['ArtsLang'];
			if($model->save())
				$this->redirect(array('view','id'=>array('art'=>$model->art, 'lang'=>$model->lang)));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionView()
	{
 		$art = $_GET['id']['art'];
 		$lang = $_GET['id']['lang'];

		$criteria = new CDbCriteria();
		$criteria->condition = '(art = :art_id) and (lang=:lang_id)';
		$criteria->params = array(':art_id' => $art, ':lang_id' => $lang);
		$result = ArtsLang::model()->find($criteria);
		$model = $result;
		
		$this->render('view',array(
			'model'=>$model,
		));
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
	
	/**
	 * Returns the data model based on the 2 primary keys given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($art, $lang)
	{
		$model=ArtsLang::model()->getByArtNLang($art, $lang);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='artslang-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}