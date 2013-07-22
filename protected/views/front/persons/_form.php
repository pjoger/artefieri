<?php
/* @var $this PersonsController */
/* @var $model Persons */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'persons-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data'
	),
)); ?>

	<p class="note"><?php echo Yii::t('general', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('general', 'are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'s_first_name'); ?>
		<?php echo $form->textField($model,'s_first_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_middle_name'); ?>
		<?php echo $form->textField($model,'s_middle_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_middle_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_last_name'); ?>
		<?php echo $form->textField($model,'s_last_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_phone'); ?>
		<?php echo $form->textField($model,'s_phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'s_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_address'); ?>
		<?php echo $form->textField($model,'s_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_email'); ?>
		<?php echo $form->textField($model,'s_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'s_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_www'); ?>
		<?php echo $form->textField($model,'s_www',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'s_www'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_descr_source'); ?>
		<?php 
				$this->widget('application.extensions.wysibb.WysiBBWidget', array(
					'model'=>$model,
					'attribute'=>'text_descr_source',
				));
		?>
		<?php echo $form->error($model,'text_descr_source'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo CHtml::image(Yii::app()->baseUrl . '/images/persons/' . $model->photo, 
				$model->s_full_name,
   				array("class" => "clickme", "title" => $model->s_full_name, "width"=>"300", "height"=>"220"));
		?>
		<?php echo $form->fileField($model, 'photo'); ?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birth'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>'birth',
				'model'=>$model,
				'attribute'=>'birth',
				'language'=>'ru',
			    'options'=>array(
			        'showAnim'=>'fold',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'height:20px;', 
					'size'=>30,
					'class'=>'date'
			    ),
			));
		?>		
		<?php echo $form->error($model,'birth'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'lvl'); ?>
		<?php echo $form->textField($model,'lvl'); ?>
		<?php echo $form->error($model,'lvl'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('general', 'Create') : Yii::t('general', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
		
<?php if(!$model->isNewRecord):?>
<div class="form" id="products-form">
<?php 
	if(isset($products)): 
    	$this->renderPartial('table/_products', 
			array(
				'author'=>$model,
				'products'=>$products,
			)
		); 
	endif; 
?>
</div>

<div class="form" id="translates-form">
<?php 
	if(isset($translates)): 
    	$this->renderPartial('table/_translate', 
			array(
				'author'=>$model,
				'translates'=>$translates,
			)
		); 
	endif; 
?>
</div>
<?php endif; ?>

