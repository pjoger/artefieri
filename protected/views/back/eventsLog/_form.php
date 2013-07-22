<?php
/* @var $this EventsLogController */
/* @var $model EventsLog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'events-log-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'event'); ?>
		<?php echo $form->textField($model,'event'); ?>
		<?php echo $form->error($model,'event'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'event_time'); ?>
		<?php 
			// echo $form->textField($model,'event_time'); 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>'event_time',
				'model'=>$model,
				'attribute'=>'event_time',
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
		<?php echo $form->error($model,'event_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user'); ?>
		<?php 
			echo $form->dropDownList($model, 'user',
				CHtml::listData(Users::model()->findAll(), 'id', 's_full_name'))
// 			echo $form->textField($model,'user',array('size'=>10,'maxlength'=>10)); 
		?>
		<?php echo $form->error($model,'user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_aux'); ?>
		<?php echo $form->textField($model,'id_aux',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'id_aux'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_comment'); ?>
		<?php echo $form->textField($model,'s_comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eve_group'); ?>
		<?php echo $form->textField($model,'eve_group'); ?>
		<?php echo $form->error($model,'eve_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>15,'maxlength'=>15, 'value'=>Yii::app()->cookie->getIP() )); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->