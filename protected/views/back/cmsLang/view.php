<?php
/* @var $this CmsLangController */

$this->breadcrumbs=array(
	'Cms Lang'=>array('/cmsLang'),
	'View',
);

$this->menu=array(
	array('label'=>'List Translations', 'url'=>array('index')),
	array('label'=>'Create Translation', 'url'=>array('create')),
	array('label'=>'Update Translation', 'url'=>array('update', 'id'=>array('cms'=>$model->cms, 'lang'=>$model->lang))),
	array('label'=>'Delete Translation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>array('cms'=>$model->cms, 'lang'=>$model->lang)),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Translations', 'url'=>array('admin')),
);
?>

<h1>View Translation</h1>

<?php 
	 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name' => 'cms',
			'value'=> Cms::model()->findByPk($model->cms)->s_title,
		),
		array(
			'name' => 'lang',
			'value'=> Lang::model()->findByPk($model->lang)->s_name,
		),
		's_title',
		'text_source',
	),
)); 
?>