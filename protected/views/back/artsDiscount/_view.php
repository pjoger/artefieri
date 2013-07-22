<?php
/* @var $this ArtsDiscountController */
/* @var $data ArtsDiscount */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('art')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->art), array('view', 'id'=>$data->art)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('new_price')); ?>:</b>
	<?php echo CHtml::encode($data->new_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expired')); ?>:</b>
	<?php echo CHtml::encode($data->expired); ?>
	<br />


</div>