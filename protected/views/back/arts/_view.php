<?php
/* @var $this ArtsController */
/* @var $data Arts */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('added')); ?>:</b>
	<?php echo CHtml::encode($data->added); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('produced')); ?>:</b>
	<?php echo CHtml::encode($data->produced); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_update); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo CHtml::encode($data->currency); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_price')); ?>:</b>
	<?php echo CHtml::encode($data->site_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('options')); ?>:</b>
	<?php echo CHtml::encode($data->options); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cover')); ?>:</b>
	<?php echo CHtml::encode($data->cover); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cover_w')); ?>:</b>
	<?php echo CHtml::encode($data->cover_w); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cover_h')); ?>:</b>
	<?php echo CHtml::encode($data->cover_h); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size_x')); ?>:</b>
	<?php echo CHtml::encode($data->size_x); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size_y')); ?>:</b>
	<?php echo CHtml::encode($data->size_y); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_descr_source')); ?>:</b>
	<?php echo CHtml::encode($data->text_descr_source); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_descr_html')); ?>:</b>
	<?php echo CHtml::encode($data->text_descr_html); ?>
	<br />

	*/ ?>

</div>