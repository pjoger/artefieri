<?php
/* @var $this SuperArtTypesToTypesController */
/* @var $model SuperArtTypesToTypes */

$this->breadcrumbs=array(
	'Super Art Types To Types'=>array('index'),
	$model->sub,
);

$this->menu=array(
	array('label'=>'List SuperArtTypesToTypes', 'url'=>array('index')),
	array('label'=>'Create SuperArtTypesToTypes', 'url'=>array('create')),
	array('label'=>'Update SuperArtTypesToTypes', 'url'=>array('update', 'id'=>$model->sub)),
	array('label'=>'Delete SuperArtTypesToTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sub),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SuperArtTypesToTypes', 'url'=>array('admin')),
);
?>

<h1>View SuperArtTypesToTypes #<?php echo $model->sub; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'super',
		'sub',
	),
)); ?>
