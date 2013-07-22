<?php
/* @var $this EventsLogController */
/* @var $model EventsLog */

$this->breadcrumbs=array(
	'Events Log'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Events Log', 'url'=>array('index')),
	array('label'=>'Manage Events Log', 'url'=>array('admin')),
);
?>

<h1>Create Events Log</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>