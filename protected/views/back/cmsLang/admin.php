<?php
/* @var $this CmsLangController */

$this->breadcrumbs=array(
	'Cms Lang'=>array('/cmsLang'),
	'Admin',
);

$this->menu=array(
		array('label'=>'List Translations', 'url'=>array('index')),
		array('label'=>'Create Translation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cmslang-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>Manage Translations</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cmslang-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'cms',
			'type' => 'raw',
			'filter' => CHtml::listData(Cms::model()->findAll(), 'id', 's_title'),
			'value'  => 'Cms::model()->findByPk($data->cms)->s_title'
		),
		array(
			'name' => 'lang',
			'type' => 'raw',
			'filter' => CHtml::listData(Lang::model()->findAll(), 'id', 's_name'),
			'value'  => 'Lang::model()->findByPk($data->lang)->s_name'
		),
		's_title',
		/*
		'text_descr_source',
		'text_descr_html',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
?>

