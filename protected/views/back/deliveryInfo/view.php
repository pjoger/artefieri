<?php
/* @var $this DeliveryInfoController */
/* @var $model DeliveryInfo */

$this->breadcrumbs=array(
	'Delivery Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DeliveryInfo', 'url'=>array('index')),
	array('label'=>'Create DeliveryInfo', 'url'=>array('create')),
	array('label'=>'Update DeliveryInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeliveryInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeliveryInfo', 'url'=>array('admin')),
);
?>

<h1>View DeliveryInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'address',
		'how_to_pay',
		'last_update',
		'status',
		's_note_user',
		's_note_oper',
		'added',
	),
)); ?>
