<?php
/* @var $this SuperArtTypesToTypesController */
/* @var $data SuperArtTypesToTypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sub), array('view', 'id'=>$data->sub)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('super')); ?>:</b>
	<?php echo CHtml::encode($data->super); ?>
	<br />


</div>