<?php
/* @var $this BasketController */
/* @var $data Basket */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sid')); ?>:</b>
	<?php echo CHtml::encode($data->sid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode(Users::model()->findByPk($data->user)->s_full_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('art')); ?>:</b>
	<?php echo CHtml::encode(Arts::model()->findByPk($data->art)->s_name); ?>
	<br />

	<?php if($data->complement_to):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('complement_to')); ?>:</b>
	<?php echo CHtml::encode(Basket::model()->findByPk($data->complement_to)->sid); ?>
	<br />
	<?php endif;?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_price')); ?>:</b>
	<?php echo CHtml::encode($data->site_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('real_payed')); ?>:</b>
	<?php echo CHtml::encode($data->real_payed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo CHtml::encode(Currency::model()->findByPk($data->currency)->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('added')); ?>:</b>
	<?php echo CHtml::encode($data->added); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payed')); ?>:</b>
	<?php echo CHtml::encode($data->payed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valid_till')); ?>:</b>
	<?php echo CHtml::encode($data->valid_till); ?>
	<br />

	<?php /*>
	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery')); ?>:</b>
	<?php echo CHtml::encode($data->delivery); ?>
	<br />
	*/ ?>

	

</div>