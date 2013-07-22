<?php
/* @var $this DeliveryAddressController */
/* @var $data DeliveryAddress */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode($data->user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sid')); ?>:</b>
	<?php echo CHtml::encode($data->sid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_mail')); ?>:</b>
	<?php echo CHtml::encode($data->s_mail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_city_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_city_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_full_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_full_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('s_address')); ?>:</b>
	<?php echo CHtml::encode($data->s_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metro')); ?>:</b>
	<?php echo CHtml::encode($data->metro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('homePhone')); ?>:</b>
	<?php echo CHtml::encode($data->homePhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobilePhone')); ?>:</b>
	<?php echo CHtml::encode($data->mobilePhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postal_index')); ?>:</b>
	<?php echo CHtml::encode($data->postal_index); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_note')); ?>:</b>
	<?php echo CHtml::encode($data->s_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region')); ?>:</b>
	<?php echo CHtml::encode($data->region); ?>
	<br />

	*/ ?>

</div>