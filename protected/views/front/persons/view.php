<?php
/* @var $this PersonsController */
/* @var $model Persons */

$this->breadcrumbs=array(
	'Persons'=>array('index'),
	$model->id,
);

$this->renderPartial('menu/list');//, array('cat'=>isset($cat)?$cat:0,'limit'=>isset($limit)?$limit:0));

?>

<div id="inner-block">
<?php 
	echo $this->renderPartial('_personDetails',array(
		'model'=>$model,
	));
?>
</div>