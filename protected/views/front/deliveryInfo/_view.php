<?php
/* @var $this DeliveryInfoController */
/* @var $data DeliveryInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('how_to_pay')); ?>:</b>
	<?php echo CHtml::encode($data->how_to_pay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_update); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_note_user')); ?>:</b>
	<?php echo CHtml::encode($data->s_note_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_note_oper')); ?>:</b>
	<?php echo CHtml::encode($data->s_note_oper); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('added')); ?>:</b>
	<?php echo CHtml::encode($data->added); ?>
	<br />

	*/ ?>

</div>