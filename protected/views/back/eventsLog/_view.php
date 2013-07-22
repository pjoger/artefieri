<?php
/* @var $this EventsLogController */
/* @var $data EventsLog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event')); ?>:</b>
	<?php echo CHtml::encode($data->event); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_time')); ?>:</b>
	<?php echo CHtml::encode($data->event_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode($data->user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_aux')); ?>:</b>
	<?php echo CHtml::encode($data->id_aux); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_comment')); ?>:</b>
	<?php echo CHtml::encode($data->s_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eve_group')); ?>:</b>
	<?php echo CHtml::encode($data->eve_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

</div>