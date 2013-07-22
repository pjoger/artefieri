<?php
/* @var $this BasketController */
/* @var $model Basket */

$this->breadcrumbs=array(
	'Baskets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('content','List Baskets'), 'url'=>array('index')),
	array('label'=>Yii::t('content','Manage Baskets'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content','Create Basket');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>