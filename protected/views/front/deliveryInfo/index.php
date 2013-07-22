<?php
/* @var $this DeliveryInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Delivery Infos',
);

$this->menu=array(
	array('label'=>Yii::t('content','Create DeliveryInfo'), 'url'=>array('create')),
	array('label'=>Yii::t('content','Manage DeliveryInfo'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content','DeliveryInfo'); ?></h1>

<?php 
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
?>
