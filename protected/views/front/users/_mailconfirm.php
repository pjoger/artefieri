<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveRecord  */

$this->pageTitle=Yii::app()->name . ' - '. Yii::t('content', 'Mail Confirmation');
$this->breadcrumbs=array(
	Yii::t('content', 'Mail Confirmation'),
);
?>

<h1><?php echo Yii::t('content', 'Mail Confirmation'); ?></h1>

<?php if ($model->scenario == 'mailconfirm'): ?>

	<p><?php echo Yii::t('content', 'A message was sent at your email. Please follow the link provided'); ?></p>

<?php elseif ($model->scenario == 'mailconfirmed'): ?>

	<p><?php echo Yii::t('content', 'Your email was confirmed'); ?></p>

<?php else: ?>

<?php endif; ?>