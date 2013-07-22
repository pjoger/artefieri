<?php
/* @var $this EventsLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Events Log',
);

$this->menu=array(
	array('label'=>'Create Events Log', 'url'=>array('create')),
	array('label'=>'Manage Events Log', 'url'=>array('admin')),
);
?>

<h1>Events Log</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
