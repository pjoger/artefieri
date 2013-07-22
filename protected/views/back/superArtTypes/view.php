<?php
/* @var $this SuperArtTypesController */
/* @var $model SuperArtTypes */

$this->breadcrumbs=array(
	'Super Art Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SuperArtTypes', 'url'=>array('index')),
	array('label'=>'Create SuperArtTypes', 'url'=>array('create')),
	array('label'=>'Update SuperArtTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SuperArtTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SuperArtTypes', 'url'=>array('admin')),
);
?>

<h1>View SuperArtTypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mem',
		'sortkey',
		's_title',
		's_imin_title',
		's_mn_rodit_title',
		'hidden',
		'exclusive',
	),
)); ?>
