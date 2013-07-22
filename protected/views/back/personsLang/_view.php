<?php
/* @var $this PersonsLangController */
/* @var $data ArtsLang */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('person')); ?>:</b>
	<?php //echo CHtml::encode($data->art); ?>
	<?php echo Persons::model()->findByPk($data->person)->s_full_name; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang')); ?>:</b>
	<?php //echo CHtml::encode($data->lang); ?>
	<?php echo Lang::model()->findByPk($data->lang)->s_name; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_first_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_middle_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_middle_name); ?>
	<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('s_last_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_descr_source')); ?>:</b>
	<?php echo CHtml::encode($data->text_descr_source); ?>
	<br />

</div>