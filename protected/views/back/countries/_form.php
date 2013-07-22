<?php
/* @var $this CountriesController */
/* @var $model Countries */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'countries-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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

	<div class="row">
		<?php echo $form->labelEx($model,'lang'); ?>
		<?php echo $form->dropDownList($model, 'lang',
        	CHtml::listData(Lang::model()->findAll(), 'id', 's_name')) ?>
		<?php echo $form->error($model,'lang'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'code3'); ?>
		<?php echo $form->textField($model,'code3',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'code3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code2'); ?>
		<?php echo $form->textField($model,'code2',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'code2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->dropDownList($model, 'currency', 
				CHtml::listData(Currency::model()->findAll(), 'id', 's_title')); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->