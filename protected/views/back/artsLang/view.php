<?php
/* @var $this ArtsLangController */

$this->breadcrumbs=array(
	'Translations'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List Translations', 'url'=>array('index')),
	array('label'=>'Create Translation', 'url'=>array('create')),
	array('label'=>'Update Translation', 'url'=>array('update', 'id'=>array('art'=>$model->art, 'lang'=>$model->lang))),
	array('label'=>'Delete Translation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>array('art'=>$model->art, 'lang'=>$model->lang)),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Translations', 'url'=>array('admin')),
);
?>

<h1>View Translation</h1>

<?php 
	 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'art',
		array(
			'name' => 'art',
			'value'=> Arts::model()->findByPk($model->art)->s_name,
		),
		//'lang',
		array(
			'name' => 'lang',
			'value'=> Lang::model()->findByPk($model->lang)->s_name,
		),
		's_name',
		'text_descr_source',
		//'text_descr_html',
	),
)); 
?>
