<?php
/* @var $this SuperArtTypesController */
/* @var $data SuperArtTypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mem')); ?>:</b>
	<?php echo CHtml::encode($data->mem); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sortkey')); ?>:</b>
	<?php echo CHtml::encode($data->sortkey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_title')); ?>:</b>
	<?php echo CHtml::encode($data->s_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_imin_title')); ?>:</b>
	<?php echo CHtml::encode($data->s_imin_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_mn_rodit_title')); ?>:</b>
	<?php echo CHtml::encode($data->s_mn_rodit_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hidden')); ?>:</b>
	<?php echo CHtml::encode($data->hidden); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('exclusive')); ?>:</b>
	<?php echo CHtml::encode($data->exclusive); ?>
	<br />

	*/ ?>

</div>