<?php
/* @var $this ArtsDiscountController */
/* @var $model ArtsDiscount */

$this->breadcrumbs=array(
	'Arts Discounts'=>array('index'),
	$model->art,
);

$this->menu=array(
	array('label'=>'List ArtsDiscount', 'url'=>array('index')),
	array('label'=>'Create ArtsDiscount', 'url'=>array('create')),
	array('label'=>'Update ArtsDiscount', 'url'=>array('update', 'id'=>$model->art)),
	array('label'=>'Delete ArtsDiscount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->art),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ArtsDiscount', 'url'=>array('admin')),
);
?>

<h1>View ArtsDiscount #<?php echo $model->art; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'art',
		array(
			'name' => 'art',
			'value'=> Arts::model()->findByPk($model->art)->s_name,
		),
		'new_price',
		'expired',
	),
)); ?>
