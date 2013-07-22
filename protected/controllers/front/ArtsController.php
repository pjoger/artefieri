<?php

class ArtsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2FiltersAll';
	
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
				'actions'=>array('index','view','SelectBaguette', 'search', 'GetRandomArtImage'),
				'users'=>array('*'),
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
		$this->layout = '//layouts/column2';
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionSelectBaguette($artId)
	{
		$basket   = Basket::model()->with('arts0')->findByAttributes(array('sid'=>Yii::app()->cookie->getSID(),'art'=>$artId));

		if($basket){
			$baguette = Arts::model()->with('currencies')->findAllByAttributes(array('type'=>'4'));
			$paspartu = Arts::model()->with('currencies')->findAllByAttributes(array('type'=>'5'));
			$steklo   = Arts::model()->with('currencies')->findAllByAttributes(array('type'=>'6'));
			$service  = Arts::model()->with('currencies')->findAllByAttributes(array('type'=>'7'));
			
			$this->render('baguettes',array(
				'basket' => $basket,
				'art'	 => $basket->arts0,
				'baguette'=>$baguette,
				'paspartu'=>$paspartu,
				'steklo'  =>$steklo,
				'service' =>$service,
			));
		} else {
			$this->redirect(array('arts/index'));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($type = '', $value = '', $f = '')
	{
		$_filters = array();
		
		if(isset($_GET))
		{
			$f = isset($f) ? urldecode($f) : '';
			$_filters = json_decode($f, true);
			$type  = isset($_GET['type'])  ? $_GET['type']  : null;
			$value = isset($_GET['value']) ? $_GET['value'] : null;
			if ($type !== null && $value !== null)
			{
				$_filters[$type] = $value;
				Yii::app()->params['filtre'] = json_encode($_filters);
			}
		}
		
		$limit = 1;
		$cat = 0;
		$criteria = new CDbCriteria();
		if(count($_filters) > 0){
			foreach ($_filters as $key=>$filter)
			{
				switch ($key)
				{
					case 'cat':
						$cat = $filter;
						break;
					case 'limit':
						$limit = $filter;
						break;
					case 'author':
						$criteria->join .= 'INNER JOIN `ownership` ON `t`.`id` = `ownership`.`art` ';
						$criteria->condition = '`ownership`.`person` = '. $filter .'';
// 						$criteria->join .= 'INNER JOIN `persons` ON `ownership`.`person` = `persons`.`id` ';
// 						$criteria->join .= 'INNER JOIN `persons_lang` ON `ownership`.`person` = `persons_lang`.`person`';
// 						$criteria->condition = '`persons`.`s_first_name` like "'. $filter .'%" OR `persons`.`s_middle_name` like "'. $filter .'%" OR `persons`.`s_last_name` like "'. $filter .'%"';
// 						$criteria->condition = '`persons_lang`.`s_first_name` like "'. $filter .'%" OR `persons_lang`.`s_middle_name` like "'. $filter .'%" OR `persons_lang`.`s_last_name` like "'. $filter .'%"';
						break;
					case 'art':
						$criteria->join .= 'INNER JOIN `arts_lang` ON `t`.`id` = `arts_lang`.`art` ';
						$criteria->condition = '`t`.`s_name` like "'. $filter .'%"';
						$criteria->condition = '`arts_lang`.`s_name` LIKE "'. $filter .'%"';
						break;
					case 'gen':
						$criteria->join .= 'INNER JOIN `arts_genres` ON `t`.`id` = `arts_genres`.`art` ';
						$criteria->condition = '`arts_genres`.`genre` = '. $filter ;
						break;
					case 'size':
						switch ($filter){
							case 'horiz':
								$criteria->condition = '`t`.`size_x` > `t`.`size_y` ';
								break;
							case 'vert':
								$criteria->condition = '`t`.`size_y` > `t`.`size_x` ';
								break;
							case 'small':
								$criteria->condition = '(`t`.`size_x` < 30) AND (`t`.`size_y` < 30) ';
								break;
							case 'medium':
								$criteria->condition = '(`t`.`size_x` between 30 AND 100) AND (`t`.`size_y` between 30 AND 100) ';
								break;
							case 'big':
								$criteria->condition = '(`t`.`size_x` > 100) AND (`t`.`size_y` > 100) ';
								break;
						}
						break;
					case 'price':
						switch ($filter){
							case '0-500':
								$criteria->condition = '`t`.`site_price` < 500 ';
								break;
							case '500-1000':
								$criteria->condition = '(`t`.`site_price` between 500 AND 1000) ';
								break;
							case '1000-5000':
								$criteria->condition = '(`t`.`site_price` between 1000 AND 5000) ';
								break;
							case '5000-10000':
								$criteria->condition = '(`t`.`site_price` between 5000 AND 10000) ';
								break;
							case '10000-20000':
								$criteria->condition = '(`t`.`site_price` between 10000 AND 20000) ';
								break;
							case '20000':
								$criteria->condition = '`t`.`site_price` > 20000';
								break;
						}
						break;
					case 'color':
						// ???
						break;
				}
			}
		}
		$criteria->join .= 'INNER JOIN `super_art_types_to_types` ON `t`.`type` = `super_art_types_to_types`.`sub`';
		$criteria->distinct = true;
		
		if ($cat == 0){
			$criteria->addCondition("super in (select s.id from super_art_types as s)");
		} else {
			$criteria->addCondition("super = ".$cat);
		}
		
		$count = Arts::model()->count($criteria);
		$pages = new MyPagination($count);
		$pages->pageSize = $limit;
		$pages->applyLimit($criteria);
		$arts  = Arts::model()->findAll($criteria);
		
		$this->render('index', array(
				"model" => $arts,
				"pages" => $pages,
				"limit" => $limit,
		));

	}
	
	public function actionSearch()
	{
		$this->layout = "//layouts/column2";
	
		if(isset($_GET['searchword']))
		{
			$message = "";
	
			if(strlen($_GET['searchword'])<3 || strlen($_GET['searchword'])>255){
				$message = "Введите не менее 3 символов, не более 255";
				$this->render('search', array(
						"count"   => 0,
						"message"=>$message,
				));
			}
	
			else{
				$criteria = new CDbCriteria();
					
				//Arts
				$criteria->join .= 'LEFT JOIN `arts_lang` ON `t`.`id` = `arts_lang`.`art`';
	
				$criteria->addCondition('t.s_name LIKE "%'.$_GET['searchword'].'%" OR arts_lang.s_name LIKE "%'.$_GET['searchword'].'%"', 'OR');
				$criteria->addCondition('t.text_descr_source LIKE "%'.$_GET['searchword'].'%" OR arts_lang.text_descr_source LIKE "%'.$_GET['searchword'].'%"', 'OR');
	
				//Genres
				$genresCriteria = new CDbCriteria();
				$genresCriteria->join .= 'INNER JOIN `arts_genres` ON `t`.`id` = `arts_genres`.`art`';
				$genresCriteria->join .= 'LEFT JOIN `genres` ON `arts_genres`.`genre` = `genres`.`id`';
				$genresCriteria->join .= 'LEFT JOIN `genres_lang` ON `genres`.`id` = `genres_lang`.`genre`';
	
				$genresCriteria->addCondition('(genres.s_name LIKE "%'.$_GET['searchword'].'%" OR genres_lang.s_name LIKE "%'.$_GET['searchword'].'%")', 'OR');
	
				$genresCriteria->distinct = true;
	
				if (Genres::model()->count($genresCriteria) > 0) {
					$criteria->mergeWith($genresCriteria, false);
				}
	
				//Persons
				$personsCriteria = new CDbCriteria();
				$personsCriteria->join .= 'LEFT JOIN `ownership` ON `t`.`id` = `ownership`.`art` ';
				$personsCriteria->join .= 'LEFT JOIN `persons` ON `ownership`.`person` = `persons`.`id` ';
				$personsCriteria->join .= 'LEFT JOIN `persons_lang` ON `persons`.`id` = `persons_lang`.`person` ';
	
				$personsCriteria->addCondition('persons.s_full_name LIKE "%'.$_GET['searchword'].'%" OR persons_lang.s_full_name LIKE "%'.$_GET['searchword'].'%"', 'OR');
					
				$personsCriteria->distinct = true;
	
				if(Persons::model()->count($personsCriteria) > 0){
					$criteria->mergeWith($personsCriteria, false);
				}
	
				//Conditia de selectare a tipurilor de arte
				$criteria->addCondition('t.type < 4', 'AND');
	
				//Distinct condtition
				$criteria->distinct = true;
	
				$count = Arts::model()->count($criteria);
	
				$criteria->limit = 120;
				$arts  = Arts::model()->findAll($criteria);
	
				if($count>=120 || $count == 0){
					$message = "Уточните поиск";
					$this->render('search', array(
							"count"   => 0,
							"message"=>$message,
					));
				}
				else{
					$this->render('search', array(
							"model" => $arts,
							"count"   => $count,
							"keyword" => $_GET['searchword'] 
					));
				}
			}
		}
	
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
	 * Get randon Art image
	 */
	public function actionGetRandomArtImage()
	{
		// accept only AJAX request (comment this when debugging)
		if (!Yii::app()->request->isAjaxRequest) {
			exit();
		}
		if(isset($_POST['cat'])){
			$cat = $_POST['cat'];

			$criteria = new CDbCriteria();
			$criteria->join .= 'INNER JOIN `super_art_types_to_types` ON `t`.`type` = `super_art_types_to_types`.`sub`';
			$criteria->distinct = true;
			$criteria->addCondition("super = ".$cat);

			$count  = Arts::model()->count($criteria);
			$offset = rand(0, $count);
			$criteria->limit = '1';
			$criteria->offset = $offset;
			$arts   = Arts::model()->find($criteria);
			
			if($arts && $arts->cover){
				$file_name = str_pad($arts->id,8,"0",STR_PAD_LEFT).'.'.$arts->cover;
				$splited = str_split($file_name, 2);
				$file_path = $splited[0] .'/'. $splited[1] .'/'. $splited[2] . '/';
				if (file_exists(Yii::app()->basePath.'/../images/covers/'.$file_path.$file_name))
					$arts->_image_file = Yii::app()->baseUrl.'/images/covers/'.$file_path.$file_name;
				echo $arts->_image_file;
				//echo "<span> ID=\"{$arts->id}\" NAME=\"{$arts->_image_file}\"</span>";
			}
			else 
				echo "";
			
		}
		
	}
	
	
	
}
