<?php
class RequestController extends Controller
{
	/**
	 * @return array actions
	 */
	public function actions()
	{
		return array(
			'suggestAuthor'=>array(
				'class'=>'ext.actions.XSuggestAction',
				'modelName'=>'Persons',
				'methodName'=>'suggest',
			),
			'suggestArt'=>array(
				'class'=>'ext.actions.XSuggestAction',
				'modelName'=>'Arts',
				'methodName'=>'suggest',
			),
			'suggestArticle'=>array(
				'class'=>'ext.actions.XSuggestAction',
				'modelName'=>'Cms',
				'methodName'=>'suggest',
			),
		);
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl',
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
			array('allow',
				'actions'=>array(
					'suggestAuthor',
					'suggestArt',
					'suggestArticle'
				),
				'users'=>array('*'),
			),
// 			array('allow',
// 				'actions'=>array(),
// 				'ips'=>$this->ips,
// 			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
}