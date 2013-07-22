<?php
/* @var $this CmsLangController */
/* @var $data CmsLang */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cms')); ?>:</b>
	<?php //echo CHtml::encode($data->cms); ?>
	<?php echo Cms::model()->findByPk($data->cms)->s_title; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang')); ?>:</b>
	<?php //echo CHtml::encode($data->lang); ?>
	<?php echo Lang::model()->findByPk($data->lang)->s_name; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_title')); ?>:</b>
	<?php echo CHtml::encode($data->s_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_source')); ?>:</b>
	<?php echo CHtml::encode($data->text_source); ?>
	<br />

</div>