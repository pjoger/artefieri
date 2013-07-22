<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_mail'); ?>
		<?php echo $form->textField($model,'s_mail',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_phone'); ?>
		<?php echo $form->textField($model,'s_phone',array('size'=>60,'maxlength'=>100)); ?>
	</div>

<!-- 	<div class="row"> -->
		<?php //echo $form->label($model,'offert_accepted'); ?>
		<?php //echo $form->textField($model,'offert_accepted'); ?>
<!-- 	</div> -->

	<div class="row">
		<?php echo $form->label($model,'s_full_name'); ?>
		<?php echo $form->textField($model,'s_full_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_first_name'); ?>
		<?php echo $form->textField($model,'s_first_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_middle_name'); ?>
		<?php echo $form->textField($model,'s_middle_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_last_name'); ?>
		<?php echo $form->textField($model,'s_last_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_city'); ?>
		<?php echo $form->dropDownList($model, 's_city', CHtml::listData(Cities::model()->findAll(), 'id', 's_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_address'); ?>
		<?php echo $form->textField($model,'s_address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mail_confirmed'); ?>
		<?php echo $form->dropDownList($model, 'mail_confirmed', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msisdn'); ?>
		<?php echo $form->textField($model,'msisdn',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msisdn_confirmed'); ?>
		<?php echo $form->dropDownList($model, 'msisdn_confirmed', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_used'); ?>
		<?php echo $form->textField($model,'last_used'); ?>
	</div>

<!-- 	<div class="row"> -->
		<?php //echo $form->label($model,'avatar'); ?>
		<?php //echo $form->textField($model,'avatar',array('size'=>4,'maxlength'=>4)); ?>
<!-- 	</div> -->

<!-- 	<div class="row"> -->
		<?php //echo $form->label($model,'avatar_w'); ?>
		<?php //echo $form->textField($model,'avatar_w'); ?>
<!-- 	</div> -->

<!-- 	<div class="row"> -->
		<?php //echo $form->label($model,'avatar_h'); ?>
		<?php //echo $form->textField($model,'avatar_h'); ?>
<!-- 	</div> -->

<!-- 	<div class="row"> -->
		<?php //echo $form->label($model,'added'); ?>
		<?php //echo $form->textField($model,'added'); ?>
<!-- 	</div> -->

<!-- 	<div class="row"> -->
		<?php //echo $form->label($model,'account'); ?>
		<?php //echo $form->textField($model,'account',array('size'=>9,'maxlength'=>9)); ?>
<!-- 	</div> -->

	<div class="row">
		<?php echo $form->label($model,'currency'); ?>
		<?php echo $form->dropDownList($model, 'currency',
	        CHtml::listData(Currency::model()->findAll(), 'id', 's_title')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lang'); ?>
		<?php echo $form->dropDownList($model, 'lang',
	        CHtml::listData(Lang::model()->findAll(), 'id', 's_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_paymethod'); ?>
		<?php echo $form->textField($model,'last_paymethod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_ip'); ?>
		<?php echo $form->textField($model,'last_ip',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->