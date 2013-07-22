<?php
/* @var $this LangController */
/* @var $data Lang */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_2')); ?>:</b>
	<?php echo CHtml::encode($data->lang_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domen')); ?>:</b>
	<?php echo CHtml::encode($data->domen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_name); ?>
	<br />


</div>