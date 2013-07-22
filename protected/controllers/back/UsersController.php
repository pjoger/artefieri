<?php

class UsersController extends Controller
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
				'actions'=>array('index','view','AjaxLoadAddresses'),
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
		$model=new Users('insert');
		$addresses = DeliveryAddress::model()->findAllByAttributes(array('user'=>$model->id));
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->setScenario('needPwd');
			$model->attributes=$_POST['Users'];

			$file_image = CUploadedFile::getInstance($model,'_image_file');
			if($file_image !== null) {
				if ( (is_object($file_image) && get_class($file_image)==='CUploadedFile') )
					$model->_image_file = $file_image;
				$model->avatar = pathinfo($file_image, PATHINFO_EXTENSION);
				$model->avatar_w = null;
				$model->avatar_h = null;
			}
			
			if($model->save())
			{
				if($file_image !== null) {
					$this->updatePhoto($model, $file_image);
				}
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'addresses'=>$addresses,
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
		$addresses = DeliveryAddress::model()->findAllByAttributes(array('user'=>$model->id));
		
		$model->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			if(isset($_POST['change_pwd'])){
				$model->setScenario('needPwd');
			}
			$model->attributes=$_POST['Users'];

			$file_image = CUploadedFile::getInstance($model,'_image_file');			
			if($file_image !== null) {
				if ( (is_object($file_image) && get_class($file_image)==='CUploadedFile') )
					$model->_image_file = $file_image;
				$model->avatar = pathinfo($file_image, PATHINFO_EXTENSION);
				$model->avatar_w = null;
				$model->avatar_h = null;
			}

			if($model->save(false))
			{
				if($file_image !== null) {
					$this->updatePhoto($model, $file_image);
				}
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'addresses'=>$addresses,
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
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAjaxLoadAddresses()
	{
		// accept only AJAX request (comment this when debugging)
		if (!Yii::app()->request->isAjaxRequest) {
			exit();
		}
		$id = $_GET['id'];
		$model=$this->loadModel($id);
		$addresses = DeliveryAddress::model()->findAllByAttributes(array('user'=>$model->id));
		$this->renderPartial('table/_addresses',
			array(
				'model'=>$model,
				'addresses'=>$addresses,
			),
			false, true
		);
	}
	
	public function updatePhoto($model, $myfile ) {
		if ( is_object($myfile) ) {
			$ext = pathinfo($myfile, PATHINFO_EXTENSION);
			$file_name = str_pad($model->id,8,"0",STR_PAD_LEFT).'.'.$ext;
			$splited = str_split($file_name, 2);
			$file_path = $splited[0] .'/'. $splited[1] .'/'. $splited[2] . '/';
			$file_path = Yii::app()->basePath.'/../images/users/' . $file_path;
echo "<pre>";print_r($file_name);echo "</pre>";
			if (!is_dir($file_path)) {
				mkdir($file_path);
			}
			if (file_exists($file_path.$file_name)) {
				unlink ($file_path.$file_name);
			}
			$model->_image_file->saveAs($file_path.$file_name);
					
			return true;
	
		} else return false;
	}
	
}
