<?php 

$list = SuperArtTypes::model()->findAll();

$this->menu = array();

// foreach($list as $category){
// 	$this->menu[] = array(
// 			'label'=> mb_convert_case($category->s_title, MB_CASE_UPPER, "UTF-8"),
// 			'url'=>array('arts/index', 'cat'=>$category->id, 'limit'=>$limit),
// 	);
// }

$_filters = json_decode(Yii::app()->params['filtre'], true);

foreach($list as $category){
	$v = isset($_filters['cat'])&&($_filters['cat']==$category->id)? ' selected' : '';
	$this->menu[] = array(
			'label'=> mb_convert_case($category->s_title, MB_CASE_UPPER, "UTF-8"),
			'url'=>array('arts/index', 'type'=>'cat', 'value' => $category->id, 'f' => urlencode(Yii::app()->params['filtre'])),
			'active'=>$v!='',
			'itemOptions'=>array('class'=>"$v"),
			'linkOptions'=>array('title'=>$category->s_title),
	);
}

?>
