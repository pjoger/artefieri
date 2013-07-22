<?php
/* @var $this DeliveryInfoController */
/* @var $model DeliveryInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'delivery-info-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php if(!$model->isNewRecord):?>
	<div class="row float-left no-margin-left">
		<?php echo $form->labelEx($model,'id', array('class'=>'float-left no-margin-left')) . ": " . $model->id; ?>
	</div>
	<?php endif;?>

	<div class="row float-left clear no-margin-left">
		<?php echo $form->labelEx($model, 'order_user'); ?>
		<?php
			if(isset($model->_order_user)) 
				echo $model->_order_user->s_full_name ." <br/>". $model->_order_user->s_phone . " <br/>" . $model->_order_user->s_mail;
			else
				echo Yii::t('general', 'Not set'); 
		?>
	</div>

	<div class="row float-left clear no-margin-left">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php 
			//echo $form->textField($model,'address',array('size'=>10,'maxlength'=>10));
			echo 
				$form->dropDownList(
					$model, 
					'address', 
					CHtml::listData(
						DeliveryAddress::model()->findAllByAttributes(array('user'=>$model->_order_user->id)), 
						'id', 
						's_address')
				) ; 
			echo CHtml::link(
					Yii::t('content', 'Add delivery address'), 
					Yii::app()->createUrl(
						'/deliveryAddress/createForUser',
						array('id'=>$model->_order_user->id)
					),
					array('target'=>'_blank')
				);
		?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row float-left clear no-margin-left">
		<?php echo $form->labelEx($model,'how_to_pay'); ?>
		<?php echo $form->textField($model,'how_to_pay'); ?>
	</div>

	<div class="row float-left">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php
			echo 
				$form->dropDownList($model, 'status', array('0'=>'Pending','1'=>'Processed','3'=>'Delivered', '4'=>'Canceled'),
					array(
						"ajax"=>array("type"=>"POST", "url"=>Yii::app()->createUrl("deliveryInfo/statusUpdate"), 
									"success"=>"js:function(data){ $('#btUpdateBaskets').click();}",
									"update"=>"#basket-table", 
									"data"=>array("id"=>$model->id, "status"=>"js:this.value"),
					))
			); 
		?>
		<?php 
			echo CHtml::ajaxButton("UpdateBaskets",
					CController::createUrl('deliveryInfo/AjaxLoadBaskets',array('id'=>$model->id)), 
					array('update' => '#basket-table'),
					array('style'=>'display:none', 'id'=>'btUpdateBaskets'));
		?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="clear"></div>
	
	<div class="row float-left no-margin-left">
		<?php echo $form->labelEx($model,'s_note_user'); ?>
		<?php echo $form->textArea($model,'s_note_user',array('cols'=>40,'rows'=>5, 'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_note_user'); ?>
	</div>

	<div class="row float-left">
		<?php echo $form->labelEx($model,'s_note_oper'); ?>
		<?php echo $form->textArea($model,'s_note_oper',array('cols'=>40,'rows'=>5, 'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_note_oper'); ?>
	</div>

	<div class="row clear">
		<?php echo $form->labelEx($model,'added', array('class'=>'float-left no-margin-left')) . ": " . $model->added; ?>
	</div>

	<div class="row clear">
		<?php echo $form->labelEx($model,'last_update', array('class'=>'float-left no-margin-left')) . ": " . $model->last_update; ?>
	</div>

	<div class="row buttons clear" style="border-top: 1px solid #ccc;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'submitButtonAdmin float-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="clear"></div>

<div class="form clear" id="baskets-form">
<?php 
	if($model->isNewRecord){
		$model->save();
		$model->isNewRecord = false;
	}
	if(isset($basket)){ 
    	$this->renderPartial('table/_basket', 
			array(
				'model'=>$model,
				'basket'=>$basket,
			)
		); 
	}
?>
</div><!-- end baskets form -->