<?php
/* @var $this BasketController */
/* @var $model Basket */

$this->breadcrumbs=array(
	'Baskets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Basket', 'url'=>array('index')),
	array('label'=>'Create Basket', 'url'=>array('create')),
	array('label'=>'Update Basket', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Basket', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Basket', 'url'=>array('admin')),
);
?>

<h1>View Basket #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user',
		'sid',
		'art',
		'payed',
		'added',
		'currency',
		'price',
		'site_price',
		'real_payed',
		'valid_till',
		'delivery',
		'complement_to',
	),
)); ?>
