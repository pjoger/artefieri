<?php
/* @var $this SuperArtTypesToTypesController */
/* @var $model SuperArtTypesToTypes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'super-art-types-to-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'super'); ?>
		<?php echo $form->textField($model,'super'); ?>
		<?php echo $form->error($model,'super'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sub'); ?>
		<?php echo $form->textField($model,'sub'); ?>
		<?php echo $form->error($model,'sub'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->