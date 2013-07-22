<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('content', 'List News'), 'url'=>array('index')),
	array('label'=>Yii::t('content', 'Create News'), 'url'=>array('create')),
);

?>

<h1><?php echo Yii::t('content', 'Manage News'); ?></h1>

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
			'value' => '$data->is_archive?Yii::t(\'general\',\'Yes\'):Yii::t(\'general\', \'No\')',
			'filter' => array('0' => Yii::t('general', 'No'), '1' => Yii::t('general', 'Yes')),
			'htmlOptions' => array('style' => "text-align:center;"),
		),
		//'visible',
		array(
			'name' => 'visible',
			'type' => 'raw',
			'value' => '$data->visible?Yii::t(\'general\',\'Yes\'):Yii::t(\'general\', \'No\')',
			'filter' => array('0' => Yii::t('general', 'No'), '1' => Yii::t('general', 'Yes')),
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
