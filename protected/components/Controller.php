<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function init()
	{
		parent::init();

		// preload 'request' so that it has chance to respond to onBeginRequest event.
		//$this->getRequest();
		
		if (isset($_POST['_lang']))
		{
			Yii::app()->language = $_POST['_lang'];
			Yii::app()->session['lang'] = Yii::app()->language;
			Yii::app()->cookie->setLanguage(Yii::app()->language);
		}
		else if (isset(Yii::app()->session['lang']))
		{
			Yii::app()->language = Yii::app()->session['lang'];
			Yii::app()->cookie->setLanguage(Yii::app()->language);
		}

		if (isset($_POST['_currency']))
		{
			Yii::app()->session['currency'] = $_POST['_currency'];
			Yii::app()->cookie->setCurrency($_POST['_currency']);
		}
		else if (isset(Yii::app()->session['currency']))
		{
			Yii::app()->cookie->setCurrency(Yii::app()->session['currency']);
		}
    
	    //if(isset($_SESSION)){
	
			if(!isset(Yii::app()->request->cookies['lang'])){
				Yii::app()->cookie->setLanguage(Yii::app()->language);
			}
			if(!isset(Yii::app()->request->cookies['currency'])){
				Yii::app()->cookie->setCurrency("USD");
			}
			if(!isset(Yii::app()->request->cookies['ip'])){
				Yii::app()->cookie->setIP();
			}
			if(!isset(Yii::app()->request->cookies['country'])){
 				Yii::app()->cookie->setCountry(Yii::app()->location->getCountryName());
			}
			if(!isset(Yii::app()->request->cookies['city'])){
 				Yii::app()->cookie->setCity(Yii::app()->location->getCityName());
			}
			if(!isset(Yii::app()->request->cookies['region'])){
 				Yii::app()->cookie->setRegion(Yii::app()->location->getRegionName());
			}
		//}
		
		// update conversion rates
		
		
	}
	
}