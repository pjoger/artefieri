<?php
/* @var $this ArtsController */
/* @var $model Arts */

$this->breadcrumbs=array(
	'Arts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Arts', 'url'=>array('index')),
	array('label'=>'Create Arts', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('arts-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Arts</h1>

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
	'id'=>'arts-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
// 		array(
// 			'class'=>'CLinkColumn',
// 			'labelExpression'=>'$data->s_name',
// 			'urlExpression'=>' Yii::app()->createUrl("basket/AddToBasket&artid=".$data->id)',
// 			'header'=>'s_name',
// 			'htmlOptions'=>array('style'=>'text-align:center'),
// 		),
		's_name',
		array(
			'name' => 'type',
			'type' => 'raw',
			'filter' => CHtml::listData(ArtTypes::model()->findAll(), 'id', 's_name'),
			'value'=>'ArtTypes::model()->findByPk($data->type)->s_name' 
		),
		//'added',
		'produced',
		'last_update',
		/*
		'currency',
		'price',
		'site_price',
		'options',
		*/
		array(
			'name' => 'options',
			'type' => 'raw',
			'value' => '$data->options?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\', \'No\')',
			'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
			'htmlOptions' => array('style' => "text-align:center;"),
		),
		'amount',
		/*'cover',
		'cover_w',
		'cover_h',
		'size_x',
		'size_y',
		'text_descr_source',
		'text_descr_html',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
