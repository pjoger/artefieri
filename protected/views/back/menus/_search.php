<?php
/* @var $this MenusController */
/* @var $model Menus */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'page'); ?>
		<?php echo $form->textField($model,'page',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_name'); ?>
		<?php echo $form->textField($model,'s_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent'); ?>
		<?php echo $form->dropDownList($model, 'parent', CHtml::listData(Menus::model()->findAll(), 'id', 's_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pos'); ?>
		<?php echo $form->textField($model,'pos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'noindex'); ?>
		<?php echo $form->textField($model,'noindex'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->