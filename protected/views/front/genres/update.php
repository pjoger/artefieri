<?php
/* @var $this GenresController */
/* @var $model Genres */

$this->breadcrumbs=array(
	'Genres'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t('content','List Genres'), 'url'=>array('index')),
	array('label'=>Yii::t('content','Create Genres'), 'url'=>array('create')),
	array('label'=>Yii::t('content','View Genres'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('content', 'Manage Genres'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content', 'Update Genres'); ?>: <?php echo $model->s_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>