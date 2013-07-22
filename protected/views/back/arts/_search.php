<?php
/* @var $this ArtsController */
/* @var $model Arts */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_name'); ?>
		<?php echo $form->textField($model,'s_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'added'); ?>
		<?php echo $form->textField($model,'added'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'produced'); ?>
		<?php echo $form->textField($model,'produced'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_update'); ?>
		<?php echo $form->textField($model,'last_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency'); ?>
		<?php echo $form->textField($model,'currency',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'site_price'); ?>
		<?php echo $form->textField($model,'site_price',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'options'); ?>
		<?php echo $form->textField($model,'options'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cover'); ?>
		<?php echo $form->textField($model,'cover',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cover_w'); ?>
		<?php echo $form->textField($model,'cover_w'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cover_h'); ?>
		<?php echo $form->textField($model,'cover_h'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'size_x'); ?>
		<?php echo $form->textField($model,'size_x'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'size_y'); ?>
		<?php echo $form->textField($model,'size_y'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'text_descr_source'); ?>
		<?php echo $form->textArea($model,'text_descr_source',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'text_descr_html'); ?>
		<?php echo $form->textArea($model,'text_descr_html',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->