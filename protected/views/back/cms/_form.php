<?php
/* @var $this CmsController */
/* @var $model Cms */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cms-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<!-- 	<div class="row"> -->
		<?php //echo $form->labelEx($model,'user'); ?>
		<?php //echo $form->textField($model,'user',array('size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->error($model,'user'); ?>
<!-- 	</div> -->

	<div class="row">
		<?php echo $form->labelEx($model,'s_title'); ?>
		<?php echo $form->textField($model,'s_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_meta_keywords'); ?>
		<?php echo $form->textField($model,'s_meta_keywords',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'s_meta_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_meta_descr'); ?>
		<?php echo $form->textField($model,'s_meta_descr',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'s_meta_descr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_source'); ?>
		<?php 
				$this->widget('application.extensions.wysibb.WysiBBWidget', array(
					'model'=>$model,
					'attribute'=>'text_source',
				));
		?>
		<?php echo $form->error($model,'text_source'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visible'); ?>
		<?php echo $form->checkBox($model, 'visible'); ?>
		<?php echo $form->error($model,'visible'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'public'); ?>
		<?php echo $form->checkBox($model, 'public'); ?>
		<?php echo $form->error($model,'public'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_meta_title'); ?>
		<?php echo $form->textField($model,'s_meta_title',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'s_meta_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_text_breadcrumbs_src'); ?>
		<?php echo $form->textField($model, 's_text_breadcrumbs_src',array('size'=>60, 'maxlength'=>500)); ?>
		<?php echo $form->error($model,'s_text_breadcrumbs_src'); ?>
	</div>

<!-- 	<div class="row"> -->
		<?php //echo $form->labelEx($model,'text_breadcrumbs_html'); ?>
		<?php //echo $form->textArea($model,'text_breadcrumbs_html',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'text_breadcrumbs_html'); ?>
<!-- 	</div> -->

	<div class="row buttons clear" style="border-top: 1px solid #ccc;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'submitButtonAdmin float-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="clear"></div>

<?php //if(!$model->isNewRecord):?>
<div class="form clear" id="translates-form">
<!-- 	<pre> -->
		<?php //print_r($translates); ?>
<!-- 	</pre> -->
<?php 
 	if(isset($translates)): 
     	$this->renderPartial('table/_translate', 
 			array(
 				'cms'=>$model,
 				'translates'=>$translates,
 			)
 		); 
 	endif; 
?>
</div>
