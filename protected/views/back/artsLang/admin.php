<?php
/* @var $this ArtsLangController */

$this->breadcrumbs=array(
	'Translations'=>array('/artsLang'),
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
	$.fn.yiiGridView.update('artslang-grid', {
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
	'id'=>'artslang-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'art',
			'type' => 'raw',
			'filter' => CHtml::listData(Arts::model()->findAll(), 'id', 's_name'),
			'value'  => 'Arts::model()->findByPk($data->art)->s_name'
		),
		array(
			'name' => 'lang',
			'type' => 'raw',
			'filter' => CHtml::listData(Lang::model()->findAll(), 'id', 's_name'),
			'value'  => 'Lang::model()->findByPk($data->lang)->s_name'
		),
		's_name',
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

