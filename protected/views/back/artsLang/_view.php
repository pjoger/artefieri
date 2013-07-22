<?php
/* @var $this ArtsLangController */
/* @var $data ArtsLang */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('art')); ?>:</b>
	<?php //echo CHtml::encode($data->art); ?>
	<?php echo Arts::model()->findByPk($data->art)->s_name; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang')); ?>:</b>
	<?php //echo CHtml::encode($data->lang); ?>
	<?php echo Lang::model()->findByPk($data->lang)->s_name; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_descr_source')); ?>:</b>
	<?php echo CHtml::encode($data->text_descr_source); ?>
	<br />

</div>