<?php
/* @var $this MenusController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menuses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Menus', 'url'=>array('index')),
	array('label'=>'Create Menus', 'url'=>array('create')),
	array('label'=>'Update Menus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Menus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Menus', 'url'=>array('admin')),
);
?>

<h1>View Menu #<?php echo $model->s_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		's_name',
		'page',
		array(
			'name'=> 'parent',
			'value'=> $model->parent !== null ? $model->parent0->s_name : '',
		),
		'pos',
		'noindex',
	),
)); ?>
