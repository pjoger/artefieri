<?php
/* @var $this EventsLogController */
/* @var $model EventsLog */

$this->breadcrumbs=array(
	'Events Log'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Events Log', 'url'=>array('index')),
	array('label'=>'Create Events Log', 'url'=>array('create')),
	array('label'=>'View Events Log', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Events Log', 'url'=>array('admin')),
);
?>

<h1>Update Events Log: <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>