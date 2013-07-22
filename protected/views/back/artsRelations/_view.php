<?php
/* @var $this ArtsRelationsController */
/* @var $data ArtsRelations */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('art1')); ?>:</b>
	<?php echo CHtml::encode($data->art1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('art2')); ?>:</b>
	<?php echo CHtml::encode($data->art2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relation')); ?>:</b>
	<?php echo CHtml::encode($data->relation); ?>
	<br />


</div>