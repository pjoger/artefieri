<?php
/* @var $this GenresController */
/* @var $model Genres */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'genres-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'s_name'); ?>
		<?php echo $form->textField($model,'s_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->textField($model,'parent',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort_key'); ?>
		<?php echo $form->textField($model,'sort_key'); ?>
		<?php echo $form->error($model,'sort_key'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('general','Create') : Yii::t('general','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->