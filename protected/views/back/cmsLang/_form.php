<?php
/* @var $this CmsLangController */
/* @var $model CmsLang */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cmslang-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php 
			if(isset($cms) && $cms->id){
				echo $form->hiddenField($model, 'cms', array('value'=>$cms->id));
				echo '<input type="hidden" name="ajaxmodal" value="1"/>';	
			}else {
				echo $form->labelEx($model,'cms');
				echo $form->dropDownList($model, 'cms',
			        CHtml::listData(Cms::model()->findAll(), 'id', 's_title'));
			} 
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'lang'); ?>
		<?php echo $form->dropDownList($model, 'lang',
	        CHtml::listData(Lang::model()->findAll(), 'id', 's_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_title'); ?>
		<?php echo $form->textField($model,'s_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_source'); ?>
		<?php 
				$this->widget('application.extensions.wysibb.WysiBBWidget', array(
					'model'=>$model,
					'attribute'=>'text_source',
				));
		?>
	</div>

	<div class="row buttons clear">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
