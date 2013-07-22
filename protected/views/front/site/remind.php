<?php
/* @var $this SiteController */
/* @var $model RemindForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '. Yii::t('content', 'Remind password');
$this->breadcrumbs=array(
	Yii::t('content', 'Remind password'),
);
?>

<?php if ($model->scenario == 'remind'): ?>

<h1><?php echo Yii::t('content', 'Remind password'); ?></h1>

<p><?php echo Yii::t('content', 'Please fill in your login or email'); ?>:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'remind-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t('content', 'Username') . ' / ' . Yii::t('content', 'E-Mail')); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('general', 'Send')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<?php elseif ($model->scenario == 'reminded'): ?>

<h1 class="color-orange"><?php echo Yii::t('content', 'New password sent. Please check your email.'); ?></h1>

<div class="form">
	<div class="row">
		<?php echo CHtml::link(Yii::t('content', 'Back to login page'), Yii::app()->createUrl('/site/login'))?>
	</div>
</div>

<?php endif; ?>
