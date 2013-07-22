<?php
/* @var $this ArtsRelationsController */
/* @var $model ArtsRelations */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'arts-relations-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'art1'); ?>
		<?php echo $form->textField($model,'art1',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'art1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'art2'); ?>
		<?php echo $form->textField($model,'art2',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'art2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'relation'); ?>
		<?php echo $form->textField($model,'relation'); ?>
		<?php echo $form->error($model,'relation'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->