<?php
/* @var $this CmsLangController */
/* @var $model CmsLang */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cms'); ?>
		<?php echo $form->dropDownList($model, 'cms',
	        CHtml::listData(Cms::model()->findAll(), 'id', 's_title')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lang'); ?>
		<?php echo $form->dropDownList($model, 'lang',
	        CHtml::listData(Lang::model()->findAll(), 'id', 's_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_title'); ?>
		<?php echo $form->textField($model,'s_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'text_source'); ?>
		<?php echo $form->textArea($model,'text_source',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->