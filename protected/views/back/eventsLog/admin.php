<?php
/* @var $this EventsLogController */
/* @var $model EventsLog */

$this->breadcrumbs=array(
	'Events Log'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Events Log', 'url'=>array('index')),
	array('label'=>'Create Event Log', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('events-log-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Events Logs</h1>

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

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'events-log-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
// 		'id',
		'event',
		'event_time',
// 		'user',
		array(
			'name' => 'user',
			'type' => 'raw',
			'filter' => CHtml::listData(Users::model()->findAll(), 'id', 's_full_name'),
			'value'=>'Users::model()->findByPk($data->user)->s_full_name'
		),
		'id_aux',
		's_comment',
		'eve_group',
		'ip',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
?>
