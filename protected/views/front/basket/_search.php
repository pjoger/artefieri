<?php
/* @var $this BasketController */
/* @var $model Basket */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'delivery'); ?>
		<?php echo $form->textField($model,'delivery',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sid'); ?>
		<?php echo $form->textField($model,'sid',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user'); ?>
		<?php echo $form->dropDownList($model, 'user', CHtml::listData(Users::model()->findAll(), 'id', 's_full_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'art'); ?>
		<?php echo $form->dropDownList($model, 'art', CHtml::listData(Arts::model()->findAll(), 'id', 's_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'complement_to'); ?>
		<?php echo $form->dropDownList($model, 'complement_to', CHtml::listData(Basket::model()->findAll(), 'id', 'sid'), array('prompt'=>'')); ?>
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
		<?php echo $form->label($model,'real_payed'); ?>
		<?php echo $form->textField($model,'real_payed',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency'); ?>
		<?php echo $form->dropDownList($model, 'currency', CHtml::listData(Currency::model()->findAll(), 'id', 's_title')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'added'); ?>
		<?php echo $form->textField($model,'added'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payed'); ?>
		<?php echo $form->textField($model,'payed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valid_till'); ?>
		<?php echo $form->textField($model,'valid_till'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->