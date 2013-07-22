<?php
/* @var $this GenresController */
/* @var $model Genres */

$this->breadcrumbs=array(
	'Genres'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('content','List Genres'), 'url'=>array('index')),
	array('label'=>Yii::t('content', 'Manage Genres'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content', 'Create Genres'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>