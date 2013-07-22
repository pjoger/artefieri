<?php
/* @var $this NewsCitiesController */
/* @var $model NewsCities */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news_cities-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php 
			echo $form->labelEx($model,'news');
			echo $form->dropDownList($model, 'news',
		        CHtml::listData(News::model()->findAll(), 'id', 's_title'));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->dropDownList($model, 'city',
	        CHtml::listData(Cities::model()->findAll(), 'id', 's_name')); ?>
	</div>

	<div class="row buttons clear">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
