<?php

class PersonsController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','AjaxLoadTranslates','AjaxLoadArts'),
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
		$model=new Persons;
		$model->setScenario('create');

		$products = Ownership::model()->getByAuthorId($model->id);
		$translates = PersonsLang::model()->getByPersonId($model->id);
				
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Persons']))
		{
			$model->attributes=$_POST['Persons'];

			$file_image = CUploadedFile::getInstance($model,'_image_file');
			if($file_image !== null) {
				if ( (is_object($file_image) && get_class($file_image)==='CUploadedFile') )
					$model->_image_file = $file_image;
				$model->photo = pathinfo($file_image, PATHINFO_EXTENSION);
				$model->photo_w = null;
				$model->photo_h = null;
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
			'products'=>$products,
			'translates'=>$translates,
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
		$model->setScenario('update');

		$products = Ownership::model()->getByAuthorId($model->id);
		$translates = PersonsLang::model()->getByPersonId($model->id);
				
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Persons']))
		{
			$model->attributes=$_POST['Persons'];

			$file_image = CUploadedFile::getInstance($model,'_image_file');
			if($file_image !== null) {
				if ( (is_object($file_image) && get_class($file_image)==='CUploadedFile') )
					$model->_image_file = $file_image;
				$model->photo = pathinfo($file_image, PATHINFO_EXTENSION);
				$model->photo_w = null;
				$model->photo_h = null;
			}
				
			if($model->save()){
				if($file_image !== null) {
 					$this->updatePhoto($model, $file_image);
				} 
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'products'=>$products,
			'translates'=>$translates,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->setScenario('delete');
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Persons');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Persons('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Persons']))
			$model->attributes=$_GET['Persons'];

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
		$model=Persons::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='persons-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAjaxLoadTranslates()
	{
		// accept only AJAX request (comment this when debugging)
		if (!Yii::app()->request->isAjaxRequest) {
			exit();
		}
		$id = $_GET['id'];
		$model=$this->loadModel($id);
		$translates = PersonsLang::model()->getByPersonId($model->id);
		$this->renderPartial('table/_translate',
				array(
					'author'=>$model,
					'translates'=>$translates,
				),
				false, true
		);
	}
	
	public function actionAjaxLoadArts()
	{
		// accept only AJAX request (comment this when debugging)
		if (!Yii::app()->request->isAjaxRequest) {
			exit();
		}
		$id = $_GET['id'];
		$model=$this->loadModel($id);
		//$arts = Arts::model()->with(array('persons0'=>array('select'=>false, 'joinType'=>'INNER JOIN', 'condition'=>'persons0.id='.$id)))->findAll();
		$arts = Ownership::model()->getByAuthorId($model->id);
		$this->renderPartial('table/_products',
				array(
					'author'=>$model,
					'products'=>$arts,
				),
				false, true
		);
// 		Yii::app()->end();
	}
	
	public function updatePhoto($model, $myfile ) {
		if ( is_object($myfile) ) {
			$ext = pathinfo($myfile, PATHINFO_EXTENSION);
			$file_name = str_pad($model->id,8,"0",STR_PAD_LEFT).'.'.$ext;
			$thumb_name = str_pad($model->id,8,"0",STR_PAD_LEFT).'_thumb.'.$ext;
			$splited = str_split($file_name, 2);
			$file_path = $splited[0] .'/'. $splited[1] .'/'. $splited[2] . '/';
			$file_path = Yii::app()->basePath.'/../images/persons/' . $file_path;
			if (!is_dir($file_path)) {
				mkdir($file_path);
			}
			if (file_exists($file_path.$file_name)) {
				unlink ($file_path.$file_name);
			}
			$model->_image_file->saveAs($file_path.$file_name);
					
			$image_info = getimagesize($file_path.$file_name);
			$model->photo_w = $image_info[0];
			$model->photo_h = $image_info[1];
			$model->save();
				
			Yii::import('application.extensions.image.Image');
			
			if ($image_info[0] > 600){
				$image = new Image($file_path.$file_name);
				$new_file_name = str_pad($model->id,8,"0",STR_PAD_LEFT).'_full.'.$ext;
				$image->save($file_path.$new_file_name);
				$image->resize(600, 600, Image::WIDTH);
				$image->save($file_path.$file_name);
			}
			
 			// Now create a thumb - again the thumb size is held in System Options Table
			$image = new Image($file_path.$file_name);
			$image->resize(300, 300, Image::WIDTH)->quality(75)->sharpen(20);
			$image->save($file_path.$thumb_name);
			
			return true;
	
		} else return false;
	}
	
	
}
