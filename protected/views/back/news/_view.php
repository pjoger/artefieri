<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

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

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_archive')); ?>:</b>
	<?php echo CHtml::encode($data->is_archive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visible')); ?>:</b>
	<?php echo CHtml::encode($data->visible); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent')); ?>:</b>
	<?php echo CHtml::encode($data->parent); ?>
	<br />

</div>