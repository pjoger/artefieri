<?php
/* @var $this CmsController */
/* @var $data Cms */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode($data->user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('added')); ?>:</b>
	<?php echo CHtml::encode($data->added); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_title')); ?>:</b>
	<?php echo CHtml::encode($data->s_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_source')); ?>:</b>
	<?php echo CHtml::encode($data->text_source); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_html')); ?>:</b>
	<?php echo CHtml::encode($data->text_html); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visible')); ?>:</b>
	<?php echo CHtml::encode($data->visible); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('public')); ?>:</b>
	<?php echo CHtml::encode($data->public); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_meta_title')); ?>:</b>
	<?php echo CHtml::encode($data->s_meta_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_meta_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->s_meta_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_meta_descr')); ?>:</b>
	<?php echo CHtml::encode($data->s_meta_descr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_text_breadcrumbs_src')); ?>:</b>
	<?php echo CHtml::encode($data->s_text_breadcrumbs_src); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_breadcrumbs_html')); ?>:</b>
	<?php echo CHtml::encode($data->text_breadcrumbs_html); ?>
	<br />

	*/ ?>

</div>