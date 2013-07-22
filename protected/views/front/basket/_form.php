<?php
/* @var $this BasketController */
/* @var $model Basket */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'basket-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'delivery'); ?>
		<?php echo $form->dropDownList($model, 'delivery', CHtml::listData(DeliveryInfo::model()->findAll(), 'id', 'id')) ; ?>
		<?php echo $form->error($model,'delivery'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sid'); ?>
		<?php echo $form->textField($model,'sid',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'sid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user'); ?>
		<?php echo $form->dropDownList($model, 'user', CHtml::listData(Users::model()->findAll(), 'id', 's_full_name')) ; ?>
		<?php echo $form->error($model,'user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'art'); ?>
		<?php echo $form->dropDownList($model, 'art', CHtml::listData(Arts::model()->findAll(), 'id', 's_name')) ; ?>
		<?php echo $form->error($model,'art'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'complement_to'); ?>
		<?php echo $form->dropDownList($model, 'complement_to', CHtml::listData(Basket::model()->findAll(), 'id', 'sid'), array('prompt'=>'')) ; ?>
		<?php echo $form->error($model,'complement_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_price'); ?>
		<?php echo $form->textField($model,'site_price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'site_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'real_payed'); ?>
		<?php echo $form->textField($model,'real_payed',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'real_payed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->dropDownList($model, 'currency', CHtml::listData(Currency::model()->findAll(), 'id', 's_title')) ; ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'added'); ?>
		<?php echo $form->textField($model,'added', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'added'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valid_till'); ?>
		<?php 
			//echo $form->textField($model,'valid_till'); 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>'valid_till',
				'model'=>$model,
				'attribute'=>'valid_till',
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
		<?php echo $form->error($model,'valid_till'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payed'); ?>
		<?php echo $form->textField($model,'payed', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'payed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('general','Create') : Yii::t('general','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->