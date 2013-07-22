<?php

class DeliveryInfoController extends Controller
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
				'actions'=>array('create','update','AjaxLoadBaskets'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','StatusUpdate'),
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
		$model = new DeliveryInfo;
		$basket = new Basket;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeliveryInfo']))
		{
			$model->attributes=$_POST['DeliveryInfo'];
			if($model->save())
			{
				$name='=?UTF-8?B?'.base64_encode($model->addresses->s_full_name ).'?=';
				$subject='=?UTF-8?B?'.base64_encode('Order status change').'?=';
				$headers="From: ".Yii::app()->name." <do-not-reply@af.ru>\r\n".
						"MIME-Version: 1.0\r\n".
						"Content-type: text/plain; charset=UTF-8";
				$body = 'New Order #'.$id;
				
				mail($model->addresses->s_mail,$subject,$body,$headers);
				
				$this->redirect(array('admin','id'=>$model->id));
			}

		}

		$this->render('create',array(
			'model'=>$model,
			'basket'=>$basket,
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
		$basket = Basket::model()->findAllByAttributes(array('delivery'=>$model->id));
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeliveryInfo']))
		{
			$model->attributes=$_POST['DeliveryInfo'];
			if($model->save())
			{
				$this->redirect(array('admin','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'basket'=>$basket,
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
// 		if ($model->status == 4) {
			foreach ($model->baskets as $basket) {
				$basket->delete();
			}
// 		}
// 		if ($model->baskets->count() == 0)
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
		$dataProvider=new CActiveDataProvider('DeliveryInfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DeliveryInfo('search');
		$user = $model->_order_user;
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DeliveryInfo']))
			$model->attributes=$_GET['DeliveryInfo'];

		$this->render('admin',array(
			'model'=>$model,
			'user'=>$user,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=DeliveryInfo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='delivery-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionStatusUpdate(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		$model = DeliveryInfo::model()->findByPk($id);
		$model->status = $status;
		$model->save();
		
		$baskets = $model->baskets;
		foreach ($baskets as $basket){
			switch($status){
				case 0:
					$art = Arts::model()->findByPk($basket->art);
					$basket->price = $art->price;
					$basket->site_price = $art->site_price;
					$basket->real_payed = 0;
					$basket->payed = null;
					$basket->valid_till = null;
					$basket->save();
					break;
				case 1:
					$art = $basket->art;
					if ($art->amount == 0)
						$basket->delete();
					else
						$art->decAmount();
					break;
				case 3:
					$basket->payed = date("Y-m-d H:i:s");
					$basket->valid_till = date("Y-m-d H:i:s");
					$basket->save();
					break;
				case 4:
					$basket->payed = date("Y-m-d H:i:s");
					$basket->valid_till = date("Y-m-d H:i:s");
					$basket->price = 0;
					$basket->site_price = 0;
					$basket->real_payed = 0;
					$basket->save();
					break;
			}
		}

		$name='=?UTF-8?B?'.base64_encode($model->addresses->s_full_name ).'?=';
		$subject='=?UTF-8?B?'.base64_encode('Order status change').'?=';
		$headers="From: ".Yii::app()->name." <do-not-reply@af.ru>\r\n".
			"MIME-Version: 1.0\r\n".
			"Content-type: text/plain; charset=UTF-8";
		$body = 'Order #'.$id.'<br/>Status changed to: '.$status;

		mail($model->addresses->s_mail,$subject,$body,$headers);
	
	}

	public function actionAjaxLoadBaskets()
	{
		// accept only AJAX request (comment this when debugging)
		if (!Yii::app()->request->isAjaxRequest) {
			exit();
		}
		$id = $_GET['id'];
		$model=$this->loadModel($id);
		$baskets = Basket::model()->findAllByAttributes(array('delivery'=>$model->id));
		$this->renderPartial('table/_basket',
			array(
				'model'=>$model,
				'basket'=>$baskets,
			),
			false, true
		);
	}
	
}
