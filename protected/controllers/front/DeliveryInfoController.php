<?php

class DeliveryInfoController extends Controller
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
				'actions'=>array('index','view','viewCart','create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','AjaxLoadBaskets'),
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

	public function actionViewCart()
	{
// 		$layout = '//layouts/column1';
		
// 		$sid = Yii::app()->session->sessionID;
		$baskets = Basket::model()->with('arts0.persons0', 'arts0.types','arts0.currencies')->findAllByAttributes(array('sid'=>Yii::app()->cookie->getSID(),'delivery'=>null));
		
		$model = new DeliveryInfo();
		
		if(isset($_POST['DeliveryInfo']))
		{
			$model->attributes=$_POST['DeliveryInfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('viewCart',array(
			'model'=>$model,
 			'baskets'=>$baskets,
		));
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new DeliveryInfo;
		$baskets = Basket::model()->with('arts0.persons0', 'arts0.types','arts0.currencies')->findAllByAttributes(array('sid'=>Yii::app()->cookie->getSID(),'delivery'=>null));
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeliveryInfo']))
		{
			$model->attributes=$_POST['DeliveryInfo'];
			
			if($model->save()){
				
				if (Yii::app()->user->isGuest) {
					
					$username = $_POST['DeliveryInfo']['_guest_user_name'];
					$email = $_POST['DeliveryInfo']['_guest_mail'];
					$user = Users::model()->find('LOWER(login)=? or LOWER(s_mail)=?', array($username, $email));
					$address_id = -1;
					
					if ($user === null){
						
						$user = new Users();
						$user->login = $email;
						$user->s_mail = $email;
						$user->s_phone = $_POST['DeliveryInfo']['_guest_phone'];
						$user->s_address = $_POST['DeliveryInfo']['_guest_address'];
						$user->s_first_name = $username;
						$user->s_last_name = $username;
						$user->offert_accepted = 1;
						$user->pwd = $user->genRandomString(6); //'q1w2e3';
						$user->repeat_password = $user->pwd;
						
						if ($user->save())
						{
							$user_id = $user->id;
							
							$address = new DeliveryAddress();
							$address->user = $user->id;
							$address->s_mail = $user->s_mail;
							$address->homePhone = $user->s_phone;
							$address->s_full_name = $user->s_full_name;
							$address->s_address = $user->s_address;
							
							if ($address->save())
								$address_id = $address->id;
						}
						
					} else {
						$user_id = $user->id;
						$address_id = DeliveryAddress::model()->findByAttributes(array('user'=>$user_id));
						if(!$address_id){
							$address = new DeliveryAddress();
							$address->user = $user->id;
							$address->s_mail = $user->s_mail;
							$address->homePhone = $_POST['DeliveryInfo']['_guest_phone'];
							$address->s_full_name = $user->s_full_name;
							$address->s_address = $_POST['DeliveryInfo']['_guest_address'];
							
							if ($address->save())
								$address_id = $address->id;
						} else {
							$address_id = $address_id->id;
						}
					}
					
					if ($address_id > -1)
					{
						$model->address = $address_id;
						$model->save();
					}
					
				} else {
					$user_id = Yii::app()->user->id;
				}
				
				$baskets = Basket::model()->findAllByAttributes(array('sid'=>Yii::app()->cookie->getSID()));
				foreach ($baskets as $basket){
					$basket->user = $user_id;
					$basket->delivery = $model->id;
					$basket->save();
				}

				$name='=?UTF-8?B?'.base64_encode($model->addresses->s_full_name ).'?=';
				$subject='=?UTF-8?B?'.base64_encode('New order').'?=';
				$headers="From: ".Yii::app()->name." <do-not-reply@af.ru>\r\n".
						"MIME-Version: 1.0\r\n".
						"Content-type: text/plain; charset=UTF-8";
				$body = 'New Order #'.$model->id;
				
				mail($model->addresses->s_mail,$subject,$body,$headers);
				
				$this->redirect(array('view','id'=>$model->id));
			}
		
		}
				
		$this->render('viewCart',array(
			'model'=>$model,
			'baskets'=>$baskets,
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
				$this->redirect(array('view','id'=>$model->id));
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
					$art = $basket->arts;
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
