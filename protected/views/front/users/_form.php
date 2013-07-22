<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('general', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('general', 'are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'s_last_name'); ?>
		<?php echo $form->textField($model,'s_last_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_last_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'s_first_name'); ?>
		<?php echo $form->textField($model,'s_first_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_middle_name'); ?>
		<?php echo $form->textField($model,'s_middle_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_middle_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_city'); ?>
		<?php echo $form->dropDownList($model, 's_city', CHtml::listData(Cities::model()->findAll(), 'id', 's_name')) ; ?>
		<?php echo $form->error($model,'s_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_phone'); ?>
		<?php echo $form->textField($model,'s_phone',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_mail'); ?>
		<?php echo $form->emailField($model,'s_mail',array('size'=>50,'maxlength'=>50)); ?>
		<?php 
		if (!$model->isNewRecord){
			echo '<div style="float:left;text-align:right;width:85%;">';
			echo ($model->mail_confirmed == '1') ? Yii::t('content','Mail Confirmed') : Yii::t('content','Mail not confirmed') .'<br/>'. 
				CHtml::link(Yii::t('content','Send confirmation code'), Yii::app()->createUrl('/users/sendMailConfirm',array('id'=>$model->id)));
			echo '</div><div class="clear"></div>';
		}
		?>
		<?php echo $form->error($model,'s_mail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<?php if($model->isNewRecord){ ?>
	<div class="row">
		<?php 
			echo $form->labelEx($model,'pwd');
			echo $form->passwordField($model,'pwd',array('size'=>60,'maxlength'=>40));
			echo '<label for="Users_repeat_password">'.Yii::t('content', 'Repeat password').'</label>';
			echo $form->passwordField($model,'repeat_password', array('size'=>60, 'maxlength'=>40)); 
			echo $form->error($model,'pwd'); 
		?>
	</div>
	<?php }else{
		echo '<div class="row">';
		echo CHtml::CheckBox(
				'change_pwd',
				false,
				array('value'=>'on', 'style'=>'margin-top: 8px; float: left;')
		);
		echo CHtml::label(Yii::t('content','Change password'),'change_pwd', array('style'=>'float:left; margin-left: 10px;'));
		echo '</div>';
	?>
		<div class="row" id="pwd-block">
			<div class="row">
				<?php echo $form->labelEx($model,'pwd'); ?>
				<?php echo $form->passwordField($model,'pwd',array('size'=>60,'maxlength'=>40, 'value'=>'', 'disabled'=>true)); ?>
			</div>
			
			<div class="row">
				<?php echo CHtml::label(Yii::t('content', 'Repeat password'),'repeat_password'); ?>
				<?php echo $form->passwordField($model,'repeat_password',array('size'=>60,'maxlength'=>40, 'value'=>'', 'disabled'=>true)); ?>
			</div>
		</div>
	<?php } ?>

	<?php if($model->isNewRecord){ ?>
	<div class="row">
		<?php 
			echo $form->checkBox($model,'offert_accepted');
			echo '<span> '. Yii::t('content', 'Agree with the terms of the contract-offer') .'</span>'; 
		?>
	</div>
	<?php } ?>
	
	<div class="row buttons">
		<div class="profile-links">
		<?php 
			if ($this->action->Id == 'view'){ 
				echo CHtml::link($model->isNewRecord ? Yii::t('content', 'Create profile') : Yii::t('content', 'Edit personal information'), Yii::app()->createUrl('/users/update',array('id'=>Yii::app()->user->userId)),array('class'=>'colorRed'));
			} else {//if ($this->action->Id == 'update') {
				echo CHtml::submitButton($model->isNewRecord ? Yii::t('content', 'Create profile') : Yii::t('general', 'Save'),array('class'=>'colorRed'));
			}
		?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
		
<?php 
Yii::app()->getClientScript()->registerScript(
"bindChgPwd", 
"
	$('#pwd-block').hide();
	$('#change_pwd').click(function() {
	    if($(this).is(':checked')) {
	    	$('#Users_pwd').removeAttr('disabled');
	    	$('#Users_repeat_password').removeAttr('disabled');
	    	$('#pwd-block').show(500);
	    } 
	    else{
	    	$('#Users_pwd').attr('disabled', 'disabled');
	    	$('#Users_repeat_password').attr('disabled', 'disabled');
	    	$('#pwd-block').hide(500);
	    }
	});
",	CClientScript::POS_READY
);
?>