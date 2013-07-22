<?php
/* @var $this ArtsController */
/* @var $model Arts */

$this->breadcrumbs=array(
	'Arts'=>array('index'),
	$model->id,
);

$this->renderPartial('menu/list', array('cat'=>isset($cat)?$cat:0,'limit'=>isset($limit)?$limit:0));

?>
<div id="inner-block">
<?php 
	echo $this->renderPartial('_artDetails',array(
		'model'=>$model,
	));
?>
</div>