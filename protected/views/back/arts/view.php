<?php
/* @var $this ArtsController */
/* @var $model Arts */

$this->breadcrumbs=array(
	'Arts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Arts', 'url'=>array('index')),
	array('label'=>'Create Arts', 'url'=>array('create')),
	array('label'=>'Update Arts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Arts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Arts', 'url'=>array('admin')),
);
?>

<h1>View Arts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',*/
		'type',
		's_name',
		'added',
		'produced',
		'last_update',
		'currency',
		'price',
		'site_price',
		'options',
		'amount',
		'cover',
		'cover_w',
		'cover_h',
		'size_x',
		'size_y',
		'text_descr_source',
		/*'text_descr_html',*/
	),
)); ?>
