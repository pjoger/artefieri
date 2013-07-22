<?php
/* @var $this EventsLogController */
/* @var $model EventsLog */

$this->breadcrumbs=array(
	'Events Log'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Events Log', 'url'=>array('index')),
	array('label'=>'Create Events Log', 'url'=>array('create')),
	array('label'=>'Update Events Log', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Events Log', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Events Log', 'url'=>array('admin')),
);
?>

<h1>View EventsLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
// 		'id',
		'event',
		'event_time',
 		'user',
		'id_aux',
		's_comment',
		'eve_group',
		'ip',
	),
)); ?>
