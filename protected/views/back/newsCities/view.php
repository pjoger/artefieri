<?php
/* @var $this NewsCitiesController */

$this->breadcrumbs=array(
	'News Cities'=>array('/newsCities'),
	'View',
);

$this->menu=array(
	array('label'=>'List News by Cities', 'url'=>array('index')),
	array('label'=>'Create News by City', 'url'=>array('create')),
	array('label'=>'Update News by City', 'url'=>array('update', 'id'=>array('news'=>$model->news, 'city'=>$model->city))),
	array('label'=>'Delete News by City', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>array('news'=>$model->news, 'city'=>$model->city)),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage News by Cities', 'url'=>array('admin')),
);
?>

<h1>View News Cities</h1>

<?php 
	 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'news',
		array(
			'name' => 'news',
			'value'=> News::model()->findByPk($model->news)->s_title,
		),
		//'lang',
		array(
			'name' => 'city',
			'value'=> Cities::model()->findByPk($model->city)->s_name,
		),
	),
)); 
?>
