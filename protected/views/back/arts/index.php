<?php
/* @var $this ArtsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Arts',
);

$this->menu=array(
	array('label'=>'Create Arts', 'url'=>array('create')),
	array('label'=>'Manage Arts', 'url'=>array('admin')),
);
?>

<h1>Arts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
