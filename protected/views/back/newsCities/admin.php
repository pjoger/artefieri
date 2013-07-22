<?php
/* @var $this NewsCitiesController */

$this->breadcrumbs=array(
	'News Cities'=>array('/newsCities'),
	'Admin',
);

$this->menu=array(
		array('label'=>'List News Cities', 'url'=>array('index')),
		array('label'=>'Create News Cities', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
	 	$.fn.yiiGridView.update('news_cities-grid', {
			data: $(this).serialize()
		});
		return false;
	});
");

?>

<h1>Manage News Cities</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news_cities-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'news',
			'type' => 'raw',
			'filter' => CHtml::listData(News::model()->findAll(), 'id', 's_title'),
			'value'  => 'News::model()->findByPk($data->news)->s_title'
		),
		array(
			'name' => 'city',
			'type' => 'raw',
			'filter' => CHtml::listData(Cities::model()->findAll(), 'id', 's_name'),
			'value'  => 'Cities::model()->findByPk($data->city)->s_name'
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
?>