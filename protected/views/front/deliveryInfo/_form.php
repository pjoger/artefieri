<?php
/* @var $this DeliveryInfoController */
/* @var $model DeliveryInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'delivery-info-form',
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->createUrl('deliveryInfo/create'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php if (Yii::app()->user->isGuest):?>
	<div class="row">
		<?php 
			echo $form->labelEx($model, 'guest_user_name');
			echo $form->textField($model, '_guest_user_name');
		?>
	</div>
	
	<div class="row">
		<?php 
			echo $form->labelEx($model, 'guest_mail');
			echo $form->textField($model, '_guest_mail');
		?>
	</div>
	
	<div class="row">
		<?php 
			echo $form->labelEx($model, 'guest_phone');
			echo $form->textField($model, '_guest_phone');
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'guest_address'); ?>
		<?php echo $form->textField($model,'_guest_address',array('size'=>10,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'guest_address'); ?>
	</div>

	<?php else :?>
	<div class="row">
		<?php 
			echo $form->labelEx($model, 'order_user');
			echo $form->textField($model, '_order_user', array('readonly'=>'readonly','value'=>Yii::app()->user->name));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->dropDownList($model, 'address', CHtml::listData(DeliveryAddress::model()->findAllByAttributes(array('user'=>Yii::app()->user->userId)), 'id', 's_address')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'s_note_user'); ?>
		<?php echo $form->textArea($model,'s_note_user',array('cols'=>40,'rows'=>5, 'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_note_user'); ?>
	</div>

	<div class="row buttons">
		<div class="profile-links">
		<?php //echo CHtml::submitButton($model->isNewRecord ? Yii::t("general","Create") : Yii::t("general","Save")); ?>
		<?php echo CHtml::submitButton(Yii::t("general","Send"),array('class'=>'colorRed')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
