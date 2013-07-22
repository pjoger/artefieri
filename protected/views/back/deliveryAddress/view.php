<?php
/* @var $this DeliveryAddressController */
/* @var $model DeliveryAddress */

$this->breadcrumbs=array(
	'Delivery Addresses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DeliveryAddress', 'url'=>array('index')),
	array('label'=>'Create DeliveryAddress', 'url'=>array('create')),
	array('label'=>'Update DeliveryAddress', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeliveryAddress', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeliveryAddress', 'url'=>array('admin')),
);
?>

<h1>View DeliveryAddress #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user',
		'sid',
		's_mail',
		'city',
		's_city_name',
		's_full_name',
		's_address',
		'metro',
		'homePhone',
		'mobilePhone',
		'postal_index',
		's_note',
		'deleted',
		'region',
	),
)); ?>
