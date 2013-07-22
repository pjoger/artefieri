<?php
/* @var $this PersonsController */
/* @var $model Persons */

$this->breadcrumbs=array(
	'Persons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('content', 'List Authors'), 'url'=>array('index')),
	array('label'=>Yii::t('content', 'Manage Authors'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content', 'Create Author'); ?></h1>

<?php 
	echo $this->renderPartial('_form', 
		array(
			'model'=>$model,
			'products'=>$products,
			'translates'=>$translates,
		)
	); 
?>