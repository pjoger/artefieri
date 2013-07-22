<?php
/* @var $this MenusController */
/* @var $data Menus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('page')); ?>:</b>
	<?php echo CHtml::encode($data->page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent')); ?>:</b>
	<?php echo $data->parent !== null ? $data->parent0->s_name : ""; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pos')); ?>:</b>
	<?php echo CHtml::encode($data->pos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('noindex')); ?>:</b>
	<?php echo CHtml::encode($data->noindex); ?>
	<br />


</div>