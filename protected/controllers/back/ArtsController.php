<?php

class ArtsController extends Controller
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
				'actions'=>array('index','view','SelectBaguette', 'GetArtPrice', 'GetArtSitePrice', 'GetArtPrices'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','AjaxFillTree','FillTree', 'AjaxLoadTranslates', 'AuthorsCache'),
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

	public function actionSelectBaguette()
	{
		$baguette = new Arts('search');
		$baguette->unsetAttributes();
		if(isset($_GET['Arts']))
			$baguette->attributes = $_GET['Arts'];

		$baguette = Arts::model()->findAllByAttributes(array('type'=>'4'));
		$paspartu = Arts::model()->findAllByAttributes(array('type'=>'5'));
		$steklo   = Arts::model()->findAllByAttributes(array('type'=>'6'));
		$service  = Arts::model()->findAllByAttributes(array('type'=>'7'));

		$this->render('baguettes',array(
			'baguette'=>$baguette,
			'paspartu'=>$paspartu,
			'steklo'  =>$steklo,
			'service' =>$service,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Arts;
		$model->setScenario('create');

		$authors = Ownership::model()->getByArtId($model->id);
		$genres  = ArtsGenres::model()->getByArtId($model->id);
		$translates = ArtsLang::model()->getByArtId($model->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Arts']))
		{
			$model->attributes=$_POST['Arts'];

			$file_image = CUploadedFile::getInstance($model,'_image_file');
			if($file_image !== null) {
				if ( (is_object($file_image) && get_class($file_image)==='CUploadedFile') ){
          if ($file_image->error == 0){
            $model->_image_file = $file_image;
          }
        }
			}

			if($model->save()) {
				if($file_image !== null) {
          $img_info = Yii::app()->artefieri->saveCoverFromPost($file_image,$model->id);

          if ($img_info){
            $model->cover = $img_info['ext'];
            $model->cover_w = $img_info['width'];
            $model->cover_h = $img_info['height'];
            $model->save(); // сохраним данные обложки
          }
 				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'authors'=>$authors,
			'genres'=>$genres,
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

		$authors = Ownership::model()->getByArtId($model->id);
		$genres = ArtsGenres::model()->getByArtId($model->id);
		$translates = ArtsLang::model()->getByArtId($model->id);

		$far = ArtsRelations::model()->find('art1=:artid and relation=:rel', array(':artid'=>$id, ':rel'=>'2'));
		if(isset($far))
			$modelFCopy = Arts::model()->findByPk($far->art2);
		else
			$modelFCopy = null;

		$aar = ArtsRelations::model()->find('art1=:artid and relation=:rel', array(':artid'=>$id, ':rel'=>'3'));
		if(isset($aar))
			$modelACopy = Arts::model()->findByPk($aar->art2);
		else
			$modelACopy = null;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Arts']))
		{
			$model->attributes=$_POST['Arts'];
			$file_image = CUploadedFile::getInstance($model,'_image_file');
			if($file_image !== null) {
				if ( (is_object($file_image) && get_class($file_image)==='CUploadedFile') ){
          if ($file_image->error == 0){
            $model->_image_file = $file_image;
          }
        }
			}

			if($model->save()) {
				if($file_image !== null) {
          $img_info = Yii::app()->artefieri->saveCoverFromPost($file_image,$model->id);

          if ($img_info){
            $model->cover = $img_info['ext'];
            $model->cover_w = $img_info['width'];
            $model->cover_h = $img_info['height'];
            $model->save(); // сохраним данные обложки
          }
 				}
				$this->redirect(array('view','id'=>$model->id));
			}

		}

		$this->render('update',array(
			'model'=>$model,
			'authors'=>$authors,
			'genres'=>$genres,
			'translates'=>$translates,
			'modelFCopy'=>$modelFCopy,
			'modelACopy'=>$modelACopy,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//$this->loadModel($id)->delete();
		$model = $this->loadModel($id);
		$model->setScenario('delete');
		$model->options = 0;
		$model->save();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Arts');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Arts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Arts']))
			$model->attributes=$_GET['Arts'];

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
		$model=Arts::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='arts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Builds a Nested Tree with Genres using AJAX
	 * @param
	 */
	public function actionAjaxFillTree()
	{
		// accept only AJAX request (comment this when debugging)
		if (!Yii::app()->request->isAjaxRequest) {
			exit();
		}
		// parse the user input
 		$parentId = "NULL";
		if (isset($_GET['root']) && $_GET['root'] !== 'source') {
			$parentId = (int) $_GET['root'];
		}
		$artId = null;
		if(isset($_GET['0'])){
			$artId = (int) $_GET['0'];
		}
		//$artId = $_GET['0'];

		// read the data (this could be in a model)
		$children = $this->getData($parentId, $artId);

		echo str_replace(
			'"hasChildren":"0"',
			'"hasChildren":false',
			CTreeView::saveDataAsJson($children)
		);
		exit();
	}

	protected function getData($parentId, $artid){
		$children = Yii::app()->db->createCommand(
				"SELECT m1.id, m1.s_name AS text, m2.id IS NOT NULL AS hasChildren, m1.parent "
				. "FROM genres AS m1 LEFT JOIN genres AS m2 ON m1.id=m2.parent "
				. "WHERE m1.parent <=> $parentId "
				. "GROUP BY m1.id ORDER BY m1.sort_key ASC"
        )->queryAll();

		foreach ($children as $k => $child) {
			if ($child['hasChildren'] == 1){
				$children[$k]['children'] = $this->getData($child['id'], $artid);
			}
			$children[$k] = $this->formatData($child, $artid);
		}

		return $children;
	}

	/*
	 * @return data for the tree
	*/
	protected function formatData($item, $artid)
	{
		$link = ArtsGenres::model()->getByArtNGenre($artid, $item['id']);
		if(isset($item['hasChildren']) && $item['hasChildren'] == 1) {
			if ($item['parent'] === null){
	 			return array('text'=> $item['text'],'id'=>$item['id'],'hasChildren'=>isset($item['hasChildren']));
			} else {
				return array('text'=>CHtml::checkBox(
						'genres[]',
						(isset($link) && ($link!=null)) ? TRUE : FALSE,
						array('id'=>'genres_'.$item['id'], 'value'=>$item['id'], 'class'=>'genre')
						). '&nbsp;'. $item['text'],'id'=>$item['id'],'hasChildren'=>$item['hasChildren']);
			}
		} else {
			if(isset($artid) && $artid>0){
// 				$link = ArtsGenres::model()->getByArtNGenre($artid, $item['id']);
// 				if(isset($link) && ($link!=null)){
// 					return array('text'=>CHtml::checkBox('genres[]', TRUE,  array('id'=>'genres_'.$item['id'], 'value'=>$item['id'], 'class'=>'genre')). '&nbsp;'. $item['text'],'id'=>$item['id'],'hasChildren'=>$item['hasChildren']);
// 				} else {
// 					return array('text'=>CHtml::checkBox('genres[]', FALSE, array('id'=>'genres_'.$item['id'], 'value'=>$item['id'], 'class'=>'genre')). '&nbsp;'. $item['text'],'id'=>$item['id'],'hasChildren'=>$item['hasChildren']);
// 				}
				return array(
						'text'=>CHtml::checkBox(
							'genres[]',
							(isset($link) && ($link!=null)) ? TRUE : FALSE,
							array('id'=>'genres_'.$item['id'], 'value'=>$item['id'], 'class'=>'genre')
							). '&nbsp;'. $item['text'],
						'id'=>$item['id'],
						'hasChildren'=>$item['hasChildren']
						);
			} else {
				    return array('text'=>CHtml::checkBox('genres[]', FALSE, array('id'=>'genres_'.$item['id'], 'value'=>$item['id'], 'class'=>'genre')). '&nbsp;'. $item['text'],'id'=>$item['id'],'hasChildren'=>$item['hasChildren']);
			}
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
		$translates = ArtsLang::model()->getByArtId($model->id);
		$this->renderPartial('table/_translate',
			array(
				'art'=>$model,
				'translates'=>$translates,
			),
			false, true
		);
	}

	public function actionGetArtPrice()
	{
		$artid = (!empty($_POST['artid'])) ? $_POST['artid']: '0';
		echo Arts::model()->findByPk($artid)->price;
	}

	public function actionGetArtSitePrice()
	{
		$artid = (!empty($_POST['artid'])) ? $_POST['artid']: '0';
		echo Arts::model()->findByPk($artid)->site_price;
	}

	public function actionAuthorsCache(){
		if(isset($_POST['author_id'])){
			$array = array();
			$array = explode(',', Yii::app()->cookie->getAuthors());
			array_push($array, $_POST['author_id']);
			//$array[] = $_POST['author_id'];

			$toCookie = implode(',', $array);

			if(strlen($toCookie) == 2){
				$toCookie = substr($toCookie, 1);
			}

			Yii::app()->cookie->setAuthors($toCookie);

			echo json_encode(array('id'=>$_POST['author_id'], 'name'=>$_POST['author_name']));
		}
	}

}
