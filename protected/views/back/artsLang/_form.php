<?php
/* @var $this ArtsLangController */
/* @var $model ArtsLang */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'artslang-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php 
			if(isset($art) && $art->id){
				echo $form->hiddenField($model, 'art', array('value'=>$art->id));
				echo '<input type="hidden" name="ajaxmodal" value="1"/>';	
			}else {
				echo $form->labelEx($model,'art');
				//echo $form->textField($model,'art',array('size'=>60,'maxlength'=>255));
				echo $form->dropDownList($model, 'art',
			        CHtml::listData(Arts::model()->findAll(), 'id', 's_name'));
				//echo $form->error($model,'art');
			} 
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'lang'); ?>
		<?php echo $form->dropDownList($model, 'lang',
	        CHtml::listData(Lang::model()->findAll(), 'id', 's_name')); ?>
		<?php //echo $form->error($model,'lang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_name'); ?>
		<?php echo $form->textField($model,'s_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'s_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_descr_source'); ?>
		<?php 
				$this->widget('application.extensions.wysibb.WysiBBWidget', array(
					'model'=>$model,
					'attribute'=>'text_descr_source',
				));
		?>
		<?php //cho $form->error($model,'text_descr_source'); ?>
	</div>

	<div class="row buttons clear">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
