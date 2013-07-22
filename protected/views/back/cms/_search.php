<?php
/* @var $this CmsController */
/* @var $model Cms */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'user'); ?>
		<?php echo $form->dropDownList($model, 'user',
	        CHtml::listData(Users::model()->findAll(), 'id', 's_full_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'added'); ?>
		<?php echo $form->textField($model,'added'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_title'); ?>
		<?php echo $form->textField($model,'s_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'text_source'); ?>
		<?php echo $form->textArea($model,'text_source',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visible'); ?>
		<?php echo $form->checkBox($model, 'visible'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'public'); ?>
		<?php echo $form->checkBox($model, 'public'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_meta_title'); ?>
		<?php echo $form->textField($model,'s_meta_title',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_meta_keywords'); ?>
		<?php echo $form->textField($model,'s_meta_keywords',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_meta_descr'); ?>
		<?php echo $form->textField($model,'s_meta_descr',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_text_breadcrumbs_src'); ?>
		<?php echo $form->textArea($model,'s_text_breadcrumbs_src',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->