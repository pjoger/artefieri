<?php
/* @var $this LangController */
/* @var $model Lang */

$this->breadcrumbs=array(
	'Langs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Lang', 'url'=>array('index')),
	array('label'=>'Create Lang', 'url'=>array('create')),
	array('label'=>'Update Lang', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Lang', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lang', 'url'=>array('admin')),
);
?>

<h1>View Lang #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lang_2',
		'domen',
		's_name',
	),
)); ?>
