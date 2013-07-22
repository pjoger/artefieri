<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Update News', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete News', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<h1>View News #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',
		'user',*/
		's_title',
		'text_source',
		/*'text_html',*/
		'added',
		//'is_archive',
		array(
			'name' => 'is_archive',
			'value'=>$model->is_archive?Yii::t('app','Yes'):Yii::t('app', 'No'),
		),
		//'visible',
		array(
			'name' => 'visible',
			'value'=>$model->visible?Yii::t('app','Yes'):Yii::t('app', 'No'),
		),
		//'parent',
		array(
			'name' => 'parent',
			'value'=> $model->parent!=null ? News::model()->findByPk($model->parent)->s_title : '',
		),
	),
)); ?>
