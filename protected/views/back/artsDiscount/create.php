<?php
/* @var $this ArtsDiscountController */
/* @var $model ArtsDiscount */

$this->breadcrumbs=array(
	'Arts Discounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ArtsDiscount', 'url'=>array('index')),
	array('label'=>'Manage ArtsDiscount', 'url'=>array('admin')),
);
?>

<h1>Create ArtsDiscount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>