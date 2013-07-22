<?php
/* @var $this GenresController */
/* @var $data Genres */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent')); ?>:</b>
	<?php echo CHtml::encode($data->parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort_key')); ?>:</b>
	<?php echo CHtml::encode($data->sort_key); ?>
	<br />


</div>