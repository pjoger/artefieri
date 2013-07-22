<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('general', 'Contact Us');
$this->breadcrumbs=array(
	'Contact',
);

$user = null;
if (Yii::app()->session && Yii::app()->session['id']){
	$user = Users::model()->findByPk(Yii::app()->session['id']);
} 

?>

<div id="content" class="clear wrapper">
<div id="inner-content">
<div id="inner-block">

<div class="inner-title">
	<h1><?php echo Yii::t('general', 'Send feedback'); ?></h1>
</div><!-- title -->
<div class="clear"></div>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<div class="form feedback" id="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="feedback-sender">
	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php 
			echo $form->textField($model,'first_name', array('value'=> $user !== null ? Yii::app()->session['first_name'] : "")); 
		?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name', array('value'=> $user !== null ? Yii::app()->session['last_name'] : "")); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone', array('value'=> $user !== null ? $user->s_phone : "")); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('value'=> $user !== null ? $user->s_mail : "")); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	</div>

	<?php /* if(!Yii::app()->user->isGuest): ?>
	<div class="feedback-sender-change floatright">
		<a href="#" title=""><span><?php echo Yii::t('content', 'Change registration information'); ?></span></a>
	</div>
	<?php endif; */ ?>
	
	<div class="feedback-form clear">
	<div class="width100p floatleft">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="width100p floatleft">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>15, 'cols'=>80)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="feedback-sup">
		<label for="feedbackAttach"><?php echo Yii::t('content', 'Attach a file'); ?>:</label><input type="file" name="feedbackAttach" id="feedbackAttach" value="<?php echo Yii::t('content', 'No file selected'); ?>" />
		<span><?php echo Yii::t('content', '(file size no more than 10 MB)'); ?></span>
	</div>
       
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row clear">
		<?php echo $form->labelEx($model,'verifyCode'); ?><br/>
		<div>
		<?php $this->widget('CCaptcha'); ?><br/>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint"><?php echo Yii::t('content', 'Please enter the letters as they are shown in the image above.'); ?>
		<br/><?php echo Yii::t('content', 'Letters are not case-sensitive.'); ?></div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons floatright" style="margin-top: 20px;">
		<?php echo CHtml::submitButton(Yii::t('general','Send feedback'),array('style'=>'border: none; color: #ec4c23; text-decoration: underline; background: none;')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="clear"></div>

<?php endif; ?>
</div>
</div>
</div>