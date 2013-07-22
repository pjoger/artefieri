<?php
/* @var $this BasketController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Baskets',
);

$this->menu=array(
	array('label'=>Yii::t('content','Create Basket'), 'url'=>array('create')),
	array('label'=>Yii::t('content','Manage Baskets'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content','Baskets');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
