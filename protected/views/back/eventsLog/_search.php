<?php
/* @var $this EventsLogController */
/* @var $model EventsLog */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'event'); ?>
		<?php echo $form->textField($model,'event'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_time'); ?>
		<?php 
// 			echo $form->textField($model,'event_time'); 
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
	</div>

	<div class="row">
		<?php echo $form->label($model,'user'); ?>
		<?php 
// 			echo $form->textField($model,'user',array('size'=>10,'maxlength'=>10)); 
			echo $form->dropDownList($model, 'user',
				CHtml::listData(Users::model()->findAll(), 'id', 's_full_name'))
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_aux'); ?>
		<?php echo $form->textField($model,'id_aux',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_comment'); ?>
		<?php echo $form->textField($model,'s_comment',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eve_group'); ?>
		<?php echo $form->textField($model,'eve_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->