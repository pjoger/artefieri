<?php
/* @var $this PersonsController */
/* @var $model Persons */

$this->breadcrumbs=array(
	'Persons'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Persons', 'url'=>array('index')),
	array('label'=>'Create Persons', 'url'=>array('create')),
	array('label'=>'Update Persons', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Persons', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Persons', 'url'=>array('admin')),
);
?>

<h1>View Persons #<?php echo $model->s_full_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		's_first_name',
		's_middle_name',
		's_last_name',
		's_full_name',
		's_phone',
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
	),
)); ?>
