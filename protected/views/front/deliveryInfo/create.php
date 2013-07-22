<?php
/* @var $this DeliveryInfoController */
/* @var $model DeliveryInfo */

$this->breadcrumbs=array(
	'Delivery Infos'=>array('index'),
	'Create',
);

?>

<h1><?php echo Yii::t('content','Create DeliveryInfo'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>