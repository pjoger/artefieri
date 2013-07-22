<?php
/* @var $this CitiesController */
/* @var $model Cities */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cities-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php 
			echo $form->dropDownList($model, 'country',
       			 CHtml::listData(Countries::model()->findAll(), 'id', 's_name')); 
		?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_name_rus'); ?>
		<?php echo $form->textField($model,'s_name_rus',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_name_rus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_name'); ?>
		<?php echo $form->textField($model,'s_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->