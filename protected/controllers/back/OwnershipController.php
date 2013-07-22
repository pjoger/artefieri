<?php

class OwnershipController extends Controller
{
	public function actionAdmin()
	{
		$this->render('admin');
	}

	public function actionCreate()
	{
		$this->render('create');
		
		// Uncomment the following line if AJAX validation is needed  
		//$this->performAjaxValidation($model);  
// 		if(isset($_POST['Ownership']))  
// 		{  
// 			$model->attributes=$_POST['Ownership'];  
// 			if($model->save()){ //save the record to the database  
// 				if (Yii::app()->request->isAjaxRequest) // check for ajax request  
// 				{  
// 					echo CJSON::encode(array(  // display message  
// 						'status'=>'success',  
// 						'div'=>"Ownership successfully created"  
// 					));  
// 					exit;         
// 				}  
// 				else{  
// 					$this->redirect(array('ownership/view','id'=>$model->id)); // if the condition fail redirect the user to post/view  
// 				}  
// 			}
// 		}
// 		if (Yii::app()->request->isAjaxRequest) // check the condition  
// 		{  
// 			echo CJSON::encode(array(  
// 				'status'=>'failure',
// 				'div'=>$this->renderPartial('_form', array('model'=>$model), true)));  
// 			exit;
// 		}
// 		else{  
// 			$this->render('create',array(  // return the form  
// 				'model'=>$model,
// 			));
// 		}
// 		$this->refresh();
	}
	
	public function actionDelete()
	{
//		$this->loadModel($id)->delete();
		$this->loadModel($id);
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
// 		if(!isset($_GET['ajax']))
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		
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

	public function actionAddArt() {
		$art_id = $_POST['art'];
		$person_id = $_POST['person'];
		$ownership = new Ownership();
		$ownership->art = $art_id;
		$ownership->person = $person_id;
		$ownership->save();
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

	public function actionAddnew() {
		$model=new Ownership;
		// Ajax Validation enabled
		$this->performAjaxValidation($model);
		// Flag to know if we will render the form or try to add
		// new jon.
		$flag=true;
		if(isset($_POST['Ownership']))
		{       
			$flag=false;
			$model->attributes=$_POST['Ownership'];
	
			if($model->save()) {
				//Return an <option> and select it
				echo CHtml::tag('option',array (
						'value'=>$model->id,
						'selected'=>true
					),
					CHtml::encode($model->jdescr),
					true
				);
			}
		}
		if($flag) {
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			$this->renderPartial('createDialog',array('model'=>$model,),false,true);
		}
	}
		
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ownership-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}