<?php
/* @var $this SuperArtTypesController */
/* @var $model SuperArtTypes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mem'); ?>
		<?php echo $form->textField($model,'mem',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sortkey'); ?>
		<?php echo $form->textField($model,'sortkey'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_title'); ?>
		<?php echo $form->textField($model,'s_title',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_imin_title'); ?>
		<?php echo $form->textField($model,'s_imin_title',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_mn_rodit_title'); ?>
		<?php echo $form->textField($model,'s_mn_rodit_title',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hidden'); ?>
		<?php echo $form->textField($model,'hidden'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exclusive'); ?>
		<?php echo $form->textField($model,'exclusive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->