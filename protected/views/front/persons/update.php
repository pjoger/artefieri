<?php
/* @var $this PersonsController */
/* @var $model Persons */

$this->breadcrumbs=array(
	'Persons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t('content', 'List Authors'), 'url'=>array('index')),
	array('label'=>Yii::t('content', 'Create Author'), 'url'=>array('create')),
	array('label'=>Yii::t('content', 'View Authors'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('content', 'Manage Authors'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content', 'Update Author'); ?> <?php echo $model->id; ?></h1>

<?php 
	echo $this->renderPartial('_form', 
		array(
			'model'=>$model,
			'products'=>$products,
			'translates'=>$translates,
		)
	); 
?>