<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage News</h1>

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
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*'id',*/
		/*'user',*/
		's_title',
		/*'text_html',*/
		'text_source',
		'added',
		//'is_archive',
		array(
			'name' => 'is_archive',
			'type' => 'raw',
			'value' => '$data->is_archive?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\', \'No\')',
			'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
			'htmlOptions' => array('style' => "text-align:center;"),
		),
		//'visible',
		array(
			'name' => 'visible',
			'type' => 'raw',
			'value' => '$data->visible?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\', \'No\')',
			'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
			'htmlOptions' => array('style' => "text-align:center;"),
		),
		//'parent',
		array(
			'name' => 'parent',
			'type' => 'raw',
			'filter' => CHtml::listData(News::model()->findAll(), 'id', 's_title'),
			'value'=>'$data->parent!=null ? News::model()->findByPk($data->parent)->s_title : ""'
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
