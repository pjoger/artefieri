<?php

class BasketController extends Controller
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
				'actions'=>array('index','view','AddToBasket','AddBaghets'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','StatusUpdate','DeleteFrom'),
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
		$model=new Basket;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Basket']))
		{
			$model->attributes=$_POST['Basket'];
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

		if(isset($_POST['Basket']))
		{
			$model->attributes=$_POST['Basket'];
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

	public function actionDeleteFrom() {
		$id = $_POST['id'];
		$basket = Basket::model()->findByPk($id);
		$basket->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Basket');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Basket('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Basket']))
			$model->attributes=$_GET['Basket'];

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
		$model=Basket::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='basket-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAddToBasket()
	{
		$artId = $_GET['artid'];
		$model = new Basket;

		$art = Arts::model()->findByPk($artId);
		if ($art->isExclusive()){
			$this->removeExclusives();
		}

		$model->user = Yii::app()->user->id;
		$model->art = $artId;
		if($model->save())
		{
/* Пока все будет без выбора багета
			if ($art->needBaguette())
				$this->redirect(array('arts/selectBaguette','artId'=>$artId));
			else
 */
				$this->redirect(array('deliveryInfo/viewCart'));
		}

	}

	public function actionAddBaghets()
	{
		$artId = $_POST['artId'];
		$baghet = $_POST['baghet'];
		$complementTo = Basket::model()->findByAttributes(array('sid'=>Yii::app()->cookie->getSID(), 'art'=>$artId))->id;

		$basket = Basket::model()->findByPk($complementTo);
		$art = Arts::model()->findByPk($basket->art);
		if($baghet['SizeWidth'] != $art->size_x || $baghet['SizeHeight'] != $art->size_y){
			$basket->tag1 = $baghet['SizeWidth'] . ' x ' . $baghet['SizeHeight'];
			$basket->save();
		}

		Basket::model()->deleteAllByAttributes(array('complement_to'=>$complementTo));

		if (isset($baghet['art_id'])){
			$basket = new Basket();
			$basket->art = $baghet['art_id'];
			$basket->user = Yii::app()->user->id;
			$basket->complement_to = $complementTo;
			$basket->tag1 = $baghet['SizeWidth'] . ' x ' . $baghet['SizeHeight'];
			if ($basket->save()){

			}
		}

		if (isset($baghet['glass_id'])){
			$basket = new Basket();
			$basket->art = $baghet['glass_id'];
			$basket->user = Yii::app()->user->id;
			$basket->complement_to = $complementTo;
			$basket->tag1 = $baghet['SizeWidth'] . ' x ' . $baghet['SizeHeight'];
			if ($basket->save()){

			}
		}

		if (isset($baghet['paspartu_id'])){
			$basket = new Basket();
			$basket->art = $baghet['paspartu_id'];
			$basket->user = Yii::app()->user->id;
			$basket->complement_to = $complementTo;
			$basket->tag1 = $baghet['SizeWidth'] . ' x ' . $baghet['SizeHeight'];
			if ($basket->save()){

			}
		}

		$this->redirect(array('deliveryInfo/viewCart'));

	}

	public function removeExclusives(){
		$user = Yii::app()->user->id;
		$sid  = Yii::app()->cookie->getSID();
		$baskets = Basket::model()->findAllByAttributes(array('user'=>$user, 'sid'=>$sid, 'delivery'=>null));
		foreach ($baskets as $basket){
			if($basket->arts0->isExclusive()){
				$basket->delete();
			}
		}

	}

	public function actionStatusUpdate(){
		if(isset($_POST['ajax']) && $_POST['ajax']==='delivery_status')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		$basket_id = $_POST['art'];
		$person_id = $_POST['person'];

		$links = Ownership::model()->getByArtNPerson($art_id, $person_id);
		if(is_array($links)){
			foreach ($links as $link) {
				$link->delete();
			}
		} else {
			$links->delete;
		}

	}

}
