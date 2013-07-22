<?php
/* @var $this DeliveryInfoController */
/* @var $model DeliveryInfo */

$this->breadcrumbs=array(
	'Delivery Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeliveryInfo', 'url'=>array('index')),
	array('label'=>'Manage DeliveryInfo', 'url'=>array('admin')),
);
?>

<h1>Create DeliveryInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'basket'=>$basket)); ?>