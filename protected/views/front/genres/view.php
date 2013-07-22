<?php
/* @var $this GenresController */
/* @var $model Genres */

$this->breadcrumbs=array(
	'Genres'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('content', 'List Genres'), 'url'=>array('index')),
	array('label'=>Yii::t('content', 'Create Genres'), 'url'=>array('create')),
	array('label'=>Yii::t('content', 'Update Genres'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('content', 'Delete Genres'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('content', 'Manage Genres'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content', 'View Genres'); ?> #<?php echo $model->s_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		's_name',
		'parent',
		'sort_key',
	),
)); ?>
