<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - '. Yii::t('general', 'Error');
$this->breadcrumbs=array(
	'Error',
);
?>

<h2><?php echo Yii::t('general', 'Error'); ?> <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>