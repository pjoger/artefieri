<?php
/* @var $this DeliveryAddressController */
/* @var $model DeliveryAddress */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'delivery-address-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php 
			echo $form->labelEx($model,'user');
			if(isset($user) && $user->id){
				echo $user->s_full_name;
				echo $form->hiddenField($model, 'user', array('value'=>$user->id));
				echo '<input type="hidden" name="ajaxmodal" value="1"/>';	
			}else {
				echo $form->dropDownList($model, 'user', CHtml::listData(Users::model()->findAll(), 'id', 's_full_name')) ;
			}
			echo $form->error($model,'user'); 
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sid'); ?>
		<?php echo $form->textField($model,'sid',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'sid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_mail'); ?>
		<?php echo $form->textField($model,'s_mail',array('size'=>50,'maxlength'=>50, 'value'=> ($user !== null) ? $user->s_mail : '')); ?>
		<?php echo $form->error($model,'s_mail'); ?>
	</div>

	<div class="row">
		<?php 
			echo CHtml::label(Yii::t('content', 'Country'), 'DeliveryAddress_Country');
			echo CHtml::dropDownList('DeliveryAddress_Country', '', 
					CHtml::listData(Countries::model()->findAll(array('order'=>'s_name')), 'id', 's_name'),
					array(
						'prompt'=> '-'. Yii::t('content', 'Country') .'-',
						'ajax' => array(
							'type' => 'POST',
							'url'=>CController::createUrl('cities/loadCities'),
							'update' => '#DeliveryAddress_city',
							'data' => array('country'=>'js:this.value'),
						)
					)
				);
			
		
			echo $form->labelEx($model,'city');

			if(isset($user) && $user->id){ 
				echo $form->dropDownList(
							$model, 
							'city', 
							CHtml::listData(
								Cities::model()->findAll(), 
								'id', 
								's_name'
							),
							array('options' => array($user->s_city=>array('selected'=>true)))
						);
			} else { 
				echo $form->dropDownList(
						$model,
						'city',
						CHtml::listData(
								Cities::model()->findAll(),
								'id',
								's_name'
						)
					);
			}
		echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_city_name'); ?>
		<?php echo $form->textField($model,'s_city_name',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'s_city_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_full_name'); ?>
		<?php echo $form->textField($model,'s_full_name',array('size'=>60,'maxlength'=>255, 'value'=> ($user !== null) ? $user->s_full_name : '')); ?>
		<?php echo $form->error($model,'s_full_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_address'); ?>
		<?php echo $form->textField($model,'s_address',array('size'=>60,'maxlength'=>255, 'value'=> ($user !== null) ? $user->s_address : '')); ?>
		<?php echo $form->error($model,'s_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metro'); ?>
		<?php echo $form->textField($model,'metro',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'metro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'homePhone'); ?>
		<?php echo $form->textField($model,'homePhone',array('size'=>60,'maxlength'=>100, 'value'=> ($user !== null) ? $user->s_phone : '')); ?>
		<?php echo $form->error($model,'homePhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobilePhone'); ?>
		<?php echo $form->textField($model,'mobilePhone',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'mobilePhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postal_index'); ?>
		<?php echo $form->textField($model,'postal_index',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'postal_index'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_note'); ?>
		<?php echo $form->textField($model,'s_note',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->checkBox($model,'deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region'); ?>
		<?php echo $form->textField($model,'region',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'region'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->