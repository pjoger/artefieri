<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cities', 'url'=>array('index')),
	array('label'=>'Create Cities', 'url'=>array('create')),
	array('label'=>'Update Cities', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cities', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cities', 'url'=>array('admin')),
);
?>

<h1>View Cities #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		//'country',
		array(
			'name' => 'country',
			'type' => 'raw',
			'filter' => CHtml::listData(Countries::model()->findAll(), 'id', 's_name'),
			'value'=> Countries::model()->findByPk($model->country)->s_name,
		),
		's_name_rus',
		's_name',
	),
)); ?>
