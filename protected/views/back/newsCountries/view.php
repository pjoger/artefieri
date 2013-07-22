<?php
/* @var $this NewsCountriesController */

$this->breadcrumbs=array(
	'News Countries'=>array('/newsCountries'),
	'View',
);

$this->menu=array(
	array('label'=>'List News Countries', 'url'=>array('index')),
	array('label'=>'Create News Countries', 'url'=>array('create')),
	array('label'=>'Update News Countries', 'url'=>array('update', 'id'=>array('news'=>$model->news, 'country'=>$model->country))),
	array('label'=>'Delete News Countries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>array('news'=>$model->news, 'country'=>$model->country)),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage News Countries', 'url'=>array('admin')),
);
?>

<h1>View News Countries</h1>

<?php 
	 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'news',
		array(
			'name' => 'news',
			'value'=> News::model()->findByPk($model->news)->s_title,
		),
		//'country',
		array(
			'name' => 'country',
			'value'=> Countries::model()->findByPk($model->country)->s_name,
		),
	),
)); 
?>