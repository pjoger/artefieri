<?php
/* @var $this DeliveryInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Delivery Infos',
);

$this->menu=array(
	array('label'=>'Create DeliveryInfo', 'url'=>array('create')),
	array('label'=>'Manage DeliveryInfo', 'url'=>array('admin')),
);
?>

<h1>Delivery Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
