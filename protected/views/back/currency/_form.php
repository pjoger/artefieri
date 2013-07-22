<?php
/* @var $this CurrencyController */
/* @var $model Currency */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'currency-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_title'); ?>
		<?php echo $form->textField($model,'s_title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'s_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_prefix'); ?>
		<?php echo $form->textField($model,'s_prefix',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'s_prefix'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_postfix'); ?>
		<?php echo $form->textField($model,'s_postfix',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'s_postfix'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->