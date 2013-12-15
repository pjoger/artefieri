<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '. Yii::t('content', 'Login');
$this->breadcrumbs=array(
	Yii::t('content', 'Login'),
);
?>

<h1><?php echo Yii::t('content', 'Login'); ?></h1>

<p><?php echo Yii::t('content', 'Please fill out the following form with your login credentials'); ?>:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo Yii::t('general', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('general', 'are required.'); ?></p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<!-- <p class="hint">
			<?php echo Yii::t('content', 'Hint: You may login.'); ?>
		</p> -->
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe',array('style'=>'float:left;')); ?>
		<?php echo $form->label($model,'rememberMe',array('style'=>'float:left;margin-left:10px')); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row clear">
		<?php echo CHtml::link(Yii::t('content','Remind password'), Yii::app()->createUrl('/site/remindPassword')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('content', 'Login')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
