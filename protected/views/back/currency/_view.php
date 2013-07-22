<?php
/* @var $this CurrencyController */
/* @var $data Currency */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_title')); ?>:</b>
	<?php echo CHtml::encode($data->s_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_prefix')); ?>:</b>
	<?php echo CHtml::encode($data->s_prefix); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_postfix')); ?>:</b>
	<?php echo CHtml::encode($data->s_postfix); ?>
	<br />


</div>