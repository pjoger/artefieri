<?php
/* @var $this GenresController */
/* @var $model Genres */

$this->breadcrumbs=array(
	'Genres'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('content','List Genres'), 'url'=>array('index')),
	array('label'=>Yii::t('content','Create Genres'), 'url'=>array('create')),
);

?>

<h1><?php echo Yii::t('content', 'Manage Genres'); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'genres-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		's_name',
		'parent',
		'sort_key',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
