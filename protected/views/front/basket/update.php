<?php
/* @var $this BasketController */
/* @var $model Basket */

$this->breadcrumbs=array(
	'Baskets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t('content','List Baskets'), 'url'=>array('index')),
	array('label'=>Yii::t('content','Create Basket'), 'url'=>array('create')),
	array('label'=>Yii::t('content','View Basket'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('content','Manage Baskets'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content','Update Basket');?> #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>