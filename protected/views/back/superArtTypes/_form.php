<?php
/* @var $this SuperArtTypesController */
/* @var $model SuperArtTypes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'super-art-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mem'); ?>
		<?php echo $form->textField($model,'mem',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'mem'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sortkey'); ?>
		<?php echo $form->textField($model,'sortkey'); ?>
		<?php echo $form->error($model,'sortkey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_title'); ?>
		<?php echo $form->textField($model,'s_title',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'s_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_imin_title'); ?>
		<?php echo $form->textField($model,'s_imin_title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_imin_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_mn_rodit_title'); ?>
		<?php echo $form->textField($model,'s_mn_rodit_title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_mn_rodit_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hidden'); ?>
		<?php echo $form->textField($model,'hidden'); ?>
		<?php echo $form->error($model,'hidden'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exclusive'); ?>
		<?php echo $form->textField($model,'exclusive'); ?>
		<?php echo $form->error($model,'exclusive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->