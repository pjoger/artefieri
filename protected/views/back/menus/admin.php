<?php
/* @var $this MenusController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menuses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Menus', 'url'=>array('index')),
	array('label'=>'Create Menu', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('menus-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Menus</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'menus-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		's_name',
		'page',
		array(
			'name'=> 'parent',
			'type'=>'raw',
			'value'=> '$data->parent !== null ? $data->parent0->s_name : ""',
		),
		'pos',
		'noindex',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
