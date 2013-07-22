<?php

class SiteController extends BackEndController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		//$model=new LoginForm;
		$model=new LoginForm('Back');

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$headers="From: Artefieri <>\r\n".
						"Reply-To: {Yii::app()->params['adminEmail']}\r\n".
						"MIME-Version: 1.0\r\n".
						"Content-type: text/plain; charset=UTF-8";
				mail(Yii::app()->params['adminEmail'],'site login','new login to site',$headers);
				if($model->username !== 'admin')
					$this->redirect(Yii::app()->request->baseUrl.'/index.php');
				else	
					$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->homeUrl);
		$this->redirect(Yii::app()->request->baseUrl);
	}

	/**
	 * Displays the translates page
	 */
	public function actionTranslates($t = 'Arts')
	{
		if (!isset($t))
			$t = 'Arts';
		$t = ucfirst($t);
		
		$criteria = new CDbCriteria();
		
		switch ($t)
		{
			case 'Arts':
				$criteria = array(
						'select'=>'id, s_name',
						'condition'=>'options=1 and type<>2 and type<>3',
						'order'=>'s_name ASC',
						'with'=>array('artslang0')
						);
				$t_name = 's_name';
				break;
			case 'Persons':
				$criteria = array(
						'order'=>'s_full_name ASC',
						'with'=>array('langs')
						);
				$t_name = 's_full_name';
				break;
			case 'Genres':
				$criteria = array(
						'select'=>'id, s_name',
						'order'=>'s_name ASC',
						'with'=>array('langs')
						);
				$t_name = 's_name';
				break;
			case 'Cms':
				$criteria = array(
						'select'=>'id, s_title',
						'order'=>'s_title ASC',
						'with'=>array('langs')
						);
				$t_name = 's_title';
				break;
		}
		
		$dataProvider=new CActiveDataProvider($t, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>50,
				),
		));
		
		$langs = Lang::model()->findAll();
		
		$this->render('pages/translates', array(
				'langs'=>$langs, 
				'dataProvider'=>$dataProvider, 
				't_name'=>$t_name,
				't' => $t
				));
	}

}