<?php
/* @var $this LangController */
/* @var $model Lang */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lang-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lang_2'); ?>
		<?php echo $form->textField($model,'lang_2',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'lang_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'domen'); ?>
		<?php echo $form->textField($model,'domen',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'domen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_name'); ?>
		<?php echo $form->textField($model,'s_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->