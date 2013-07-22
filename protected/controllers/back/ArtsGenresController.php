<?php

class ArtsGenresController extends Controller
{
	public function actionAdmin()
	{
		$this->render('admin');
	}

	public function actionCreate()
	{
		$this->render('create');
	}

	public function actionDelete()
	{
		$this->loadModel($id);
		
		if(Yii::app()->request->isAjaxRequest){
            $this->delete;
            Yii::app()->end();
        } else {
        	if(!isset($_GET['ajax']))
        		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
		
	}

	public function actionDeleteFromArt() {
		$art_id = $_POST['art'];
		$genre_id = $_POST['genre'];
		$links = ArtsGenres::model()->getByArtNGenre($art_id, $genre_id);
		if(is_array($links)){
			foreach ($links as $link) {
				$link->delete();
			}
		} else {
			$links->delete;
		}	
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionUpdate()
	{
		$this->render('update');
	}

	public function actionView()
	{
		$this->render('view');
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