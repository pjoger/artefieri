<?php
/* @var $this ArtsRelationsController */
/* @var $model ArtsRelations */

$this->breadcrumbs=array(
	'Arts Relations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ArtsRelations', 'url'=>array('index')),
	array('label'=>'Create ArtsRelations', 'url'=>array('create')),
	array('label'=>'Update ArtsRelations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ArtsRelations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ArtsRelations', 'url'=>array('admin')),
);
?>

<h1>View ArtsRelations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'art1',
		'art2',
		'relation',
	),
)); ?>
