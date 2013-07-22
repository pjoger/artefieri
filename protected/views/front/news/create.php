<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('content', 'List News'), 'url'=>array('index')),
	array('label'=>Yii::t('content', 'Manage News'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content', 'Create News'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>