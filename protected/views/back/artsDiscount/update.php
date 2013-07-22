<?php
/* @var $this ArtsDiscountController */
/* @var $model ArtsDiscount */

$this->breadcrumbs=array(
	'Arts Discounts'=>array('index'),
	$model->art=>array('view','id'=>$model->art),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArtsDiscount', 'url'=>array('index')),
	array('label'=>'Create ArtsDiscount', 'url'=>array('create')),
	array('label'=>'View ArtsDiscount', 'url'=>array('view', 'id'=>$model->art)),
	array('label'=>'Manage ArtsDiscount', 'url'=>array('admin')),
);
?>

<h1>Update ArtsDiscount <?php echo $model->art; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>