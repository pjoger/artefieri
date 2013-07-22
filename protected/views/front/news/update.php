<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t('content', 'List News'), 'url'=>array('index')),
	array('label'=>Yii::t('content', 'Create News'), 'url'=>array('create')),
	array('label'=>Yii::t('content', 'View News'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('content', 'Manage News'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content', 'Update News'); ?>: <?php echo $model->s_title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>