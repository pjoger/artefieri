<?php
/* @var $this DeliveryInfoController */
/* @var $model DeliveryInfo */

$this->breadcrumbs=array(
	'Delivery Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t('content','List DeliveryInfo'), 'url'=>array('index')),
	array('label'=>Yii::t('content','Create DeliveryInfo'), 'url'=>array('create')),
	array('label'=>Yii::t('content','View DeliveryInfo'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('content','Manage DeliveryInfo'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content', 'Update DeliveryInfo');?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'basket'=>$basket)); ?>