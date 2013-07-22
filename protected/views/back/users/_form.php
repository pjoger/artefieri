<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data'
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<?php if($model->isNewRecord){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'pwd'); ?>
		<?php 
			echo $form->passwordField($model,'pwd',array('size'=>60,'maxlength'=>40));
			echo $form->passwordField($model,'repeat_password', array('size'=>60, 'maxlength'=>40)); 
		?>
		<?php echo $form->error($model,'pwd'); ?>
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
		<div class="row clear" id="pwd-block">
			<div class="row">
				<?php echo $form->labelEx($model,'pwd'); ?>
				<?php echo $form->passwordField($model,'pwd',array('size'=>60,'maxlength'=>40, 'value'=>'', 'disabled'=>true)); ?>
			</div>
			
			<div class="row">
				<?php echo CHtml::label(Yii::t('app', 'Repeat password'),'repeat_password'); ?>
				<?php echo $form->passwordField($model,'repeat_password',array('size'=>60,'maxlength'=>40, 'value'=>'', 'disabled'=>true)); ?>
			</div>
		</div>
	<?php }?>
	
	<div class="row float-left no-margin-left clear">
		<?php echo $form->labelEx($model,'s_mail'); ?>
		<?php echo $form->textField($model,'s_mail',array('size'=>60,'maxlength'=>40)); ?>
		<?php
		if (!$model->isNewRecord){
			echo '<div style="float:left;text-align:right;width:85%;">';
			echo ($model->mail_confirmed == '1') ? Yii::t('content','Mail Confirmed') : Yii::t('content','Mail not confirmed') .'<br/>'. 
				CHtml::link(Yii::t('content','Send confirmation code'), Yii::app()->createUrl('/users/emailConfirm',array('id'=>$model->id)));
			echo '</div><div class="clear"></div>';
		}
		?>
		<?php echo $form->error($model,'s_mail'); ?>
	</div>

	<div class="row clear">
		<?php echo $form->labelEx($model,'s_phone'); ?>
		<?php echo $form->textField($model,'s_phone',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_phone'); ?>
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
		<?php echo $form->labelEx($model,'s_last_name'); ?>
		<?php echo $form->textField($model,'s_last_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_last_name'); ?>
	</div>

	<div class="row">
	<?php 
			echo CHtml::label(Yii::t('content', 'Country'), 'Users_country');
			echo CHtml::dropDownList('Users_country', '', 
					CHtml::listData(Countries::model()->findAll(array('order'=>'s_name')), 'id', 's_name'),
					array(
						'prompt'=> '- '. Yii::t('content', 'Country') .' -',
						'ajax' => array(
							'type' => 'POST',
							'url'=>CController::createUrl('cities/loadCities'),
							'update' => '#Users_s_city',
							'data' => array('country'=>'js:this.value'),
						)
					)
				);
	?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'s_city'); ?>
		<?php echo $form->dropDownList($model, 's_city', CHtml::listData(Cities::model()->findAll(), 'id', 's_name')) ; ?>
		<?php echo $form->error($model,'s_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_address'); ?>
		<?php echo $form->textArea($model,'s_address',array('cols'=>50,'rows'=>5, 'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_address'); ?>
	</div>

	<div class="row float-left no-margin-left">
		<?php echo $form->labelEx($model,'msisdn'); ?>
		<?php echo $form->textField($model,'msisdn',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'msisdn'); ?>
	</div>

	<div class="row float-left">
		<?php echo $form->labelEx($model,'msisdn_confirmed'); ?>
		<?php echo $form->textField($model,'msisdn_confirmed'); ?>
		<?php echo $form->error($model,'msisdn_confirmed'); ?>
	</div>

	<div class="row float-left no-margin-left">
		<?php
			echo CHtml::image($model->_image_file,
				$model->s_full_name,
				array("class" => "clickme", "title" => $model->s_full_name, "width"=>"300", "height"=>"220"));
			echo "<br/>".$form->fileField($model, '_image_file');
		?>
	</div>
	
	<div class="row float-left">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('size'=>3,'maxlength'=>3,'readonly'=>'readonly')); ?>
		<?php echo $form->labelEx($model,'avatar_w'); ?>
		<?php echo $form->textField($model,'avatar_w', array('readonly'=>'readonly')); ?>
		<?php echo $form->labelEx($model,'avatar_h'); ?>
		<?php echo $form->textField($model,'avatar_h', array('readonly'=>'readonly')); ?>
	</div>
	
	<div class="row float-left no-margin-left clear">
		<?php echo $form->labelEx($model,'account'); ?>
		<?php echo $form->textField($model,'account',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'account'); ?>
	</div>

	<div class="row float-left">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->dropDownList($model, 'currency', CHtml::listData(Currency::model()->findAll(), 'id', 's_title')) ; ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="row float-left">
		<?php echo $form->labelEx($model,'last_paymethod'); ?>
		<?php echo $form->textField($model,'last_paymethod', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'last_paymethod'); ?>
	</div>

	<div class="row clear">
		<?php echo $form->labelEx($model,'lang'); ?>
		<?php echo $form->dropDownList($model, 'lang', CHtml::listData(Lang::model()->findAll(), 'id', 's_name')) ; ?>
		<?php echo $form->error($model,'lang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_ip'); ?>
		<?php echo $form->textField($model,'last_ip',array('size'=>15, 'maxlength'=>15, 'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'last_ip'); ?>
	</div>

	<div class="row clear">
		<?php echo $form->labelEx($model,'added', array('class'=>'float-left no-margin-left')) .': '. $model->added; ?>
		<?php //echo $form->textField($model,'added', array('readonly'=>'readonly')); ?>
		<?php //echo $form->error($model,'added'); ?>
	</div>

	<div class="row">
		<?php
			$data = CHtml::listData(Groups::model()->findAll(), 'id', 's_name');
			$u_groups = GroupsUsers::model()->findAllByAttributes(array('user'=>$model->id));
			$selected = array();
			foreach ($u_groups as $g)
				$selected[$g->group] = array('selected' => 'selected');
			$htmlOptions = array('style'=>'width:200px', 'size' => '10', 'prompt'=>'', 'multiple' => 'multiple', 'options' => $selected);
			echo CHtml::listBox('user_groups','user_groups', $data, $htmlOptions);
		?>
	</div>
	
	
	<div class="row buttons clear" style="border-top: 1px solid #ccc">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'submitButtonAdmin float-right')); ?>
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

<div class="clear"></div>

<div class="form" id="addresses-form">
<?php 
// 	if($model->isNewRecord){
// 		$model->save();
// 		$model->isNewRecord = false;
// 	}
	if(isset($addresses)){ 
    	$this->renderPartial('table/_addresses', 
			array(
				'model'=>$model,
				'addresses'=>$addresses,
			)
		); 
	}
?>
</div><!-- end addresses form -->