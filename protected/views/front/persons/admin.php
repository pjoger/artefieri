<?php
/* @var $this PersonsController */
/* @var $model Persons */

$this->breadcrumbs=array(
	'Persons'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('content', 'List Authors'), 'url'=>array('index')),
	array('label'=>Yii::t('content', 'Create Author'), 'url'=>array('create')),
);

?>

<h1><?php echo Yii::t('content', 'Manage Authors'); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'persons-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'s_first_name',
		//'s_middle_name',
		//'s_last_name',
		's_full_name',
		's_phone',
		/*
		's_address',
		's_email',
		's_www',
		'added',
		'text_descr_source',
		'text_descr_html',
		'birth',
		'photo',
		'photo_w',
		'photo_h',
		'lvl',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
