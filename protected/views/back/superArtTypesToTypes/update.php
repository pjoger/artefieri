<?php
/* @var $this SuperArtTypesToTypesController */
/* @var $model SuperArtTypesToTypes */

$this->breadcrumbs=array(
	'Super Art Types To Types'=>array('index'),
	$model->sub=>array('view','id'=>$model->sub),
	'Update',
);

$this->menu=array(
	array('label'=>'List SuperArtTypesToTypes', 'url'=>array('index')),
	array('label'=>'Create SuperArtTypesToTypes', 'url'=>array('create')),
	array('label'=>'View SuperArtTypesToTypes', 'url'=>array('view', 'id'=>$model->sub)),
	array('label'=>'Manage SuperArtTypesToTypes', 'url'=>array('admin')),
);
?>

<h1>Update SuperArtTypesToTypes <?php echo $model->sub; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>