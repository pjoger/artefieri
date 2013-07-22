<?php
/* @var $this ArtsDiscountController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Arts Discounts',
);

$this->menu=array(
	array('label'=>'Create ArtsDiscount', 'url'=>array('create')),
	array('label'=>'Manage ArtsDiscount', 'url'=>array('admin')),
);
?>

<h1>Arts Discounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
