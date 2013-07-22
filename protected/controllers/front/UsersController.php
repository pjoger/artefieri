<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
				'actions'=>array('view','register','emailConfirm', 'sendMailConfirm'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>array('@'),
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
	public function actionView()
	{
		if (Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->createUrl('/users/register'));
		else
			$id = Yii::app()->user->userId;
		
		$delivery = DeliveryInfo::model()->with(array(
					'baskets'=>array(
								'select'=>false,
								'joinType'=>'INNER JOIN',
								'condition'=>'baskets.user='.$id,
							)
				))->findAll();
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'delivery'=>$delivery,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRegister()
	{
		if (!Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->createUrl('/users/view'));
		
		$model=new Users('insert');
		
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
				
				$this->redirect(array('view'));
			}
		}

		$this->render('view',array(
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
		$model->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$delivery = DeliveryInfo::model()->with(array(
				'baskets'=>array(
						'select'=>false,
						'joinType'=>'INNER JOIN',
						'condition'=>'baskets.user='.$id,
				)
		))->findAll();
		
		
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
				
				$this->redirect(array('view'));
			}
		}

		$this->render('view',array(
			'model'=>$model,
// 			'addresses'=>$addresses,
			'delivery'=>$delivery,
		));
	}

	public function actionSendMailConfirm($id)
	{
		$model = $this->loadModel($id);
	
 		if($model->sendMailConfirmCode()) 
			$model->scenario = 'mailconfirm';

 		$this->render('_mailconfirm',array('model'=>$model));
	}
	
	public function actionEmailConfirm($ac)
	{
		$l = array();
		
		if(isset($_GET))
		{
			$ac = isset($ac) ? urldecode($ac) : '';
			$l = json_decode($ac, true);
			$mail = $l['m'];
			$code = $l['c'];
			
			$model = Users::model()->findByAttributes(array('s_mail'=>$mail));
			if($model){
				$model->scenario = 'mailconfirmed';
				$model->mail_confirmed = 1;
				$model->tag1 = null;
				$model->save(false);
			}
			
		}
		
		$this->render('_mailconfirm', array('model'=>$model, 'mail'=>$mail, 'code'=>$code));
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

	
}
