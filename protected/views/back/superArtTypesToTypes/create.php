<?php
/* @var $this SuperArtTypesToTypesController */
/* @var $model SuperArtTypesToTypes */

$this->breadcrumbs=array(
	'Super Art Types To Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SuperArtTypesToTypes', 'url'=>array('index')),
	array('label'=>'Manage SuperArtTypesToTypes', 'url'=>array('admin')),
);
?>

<h1>Create SuperArtTypesToTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>