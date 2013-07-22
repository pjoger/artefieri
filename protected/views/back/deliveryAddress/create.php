<?php
/* @var $this DeliveryAddressController */
/* @var $model DeliveryAddress */

$this->breadcrumbs=array(
	'Delivery Addresses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeliveryAddress', 'url'=>array('index')),
	array('label'=>'Manage DeliveryAddress', 'url'=>array('admin')),
);
?>

<h1>Create DeliveryAddress</h1>

<?php 
	if (!isset($user))
		echo $this->renderPartial('_form', array('model'=>$model));
	else
		echo $this->renderPartial('_form', array('model'=>$model, 'user'=>$user));
?>