<?php
/* @var $this BasketController */
/* @var $model Basket */

$this->breadcrumbs=array(
	'Baskets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('content','List Baskets'), 'url'=>array('index')),
	array('label'=>Yii::t('content','Create Basket'), 'url'=>array('create')),
	array('label'=>Yii::t('content','Update Basket'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('content','Delete Basket'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('content','Manage Baskets'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content','View Basket');?> #<?php echo $model->id; ?></h1>

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
