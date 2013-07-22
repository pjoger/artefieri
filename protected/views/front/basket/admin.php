<?php
/* @var $this BasketController */
/* @var $model Basket */

$this->breadcrumbs=array(
	'Baskets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('content','List Baskets'), 'url'=>array('index')),
	array('label'=>Yii::t('content','Create Basket'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('basket-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('content','Manage Baskets');?></h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'basket-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'delivery',
		'sid',
		array(
			'name' => 'user',
			'type' => 'raw',
			'filter' => CHtml::listData(Users::model()->findAll(), 'id', 's_full_name'),
			'value'=> 'Users::model()->findByPk($data->user)->s_full_name',
		),
		array(
			'name' => 'art',
			'type' => 'raw',
			'filter' => CHtml::listData(Arts::model()->findAll(), 'id', 's_name'),
			'value' => 'Arts::model()->findByPk($data->art)->s_name',
		),
		array(
			'name' => 'complement_to',
			'type' => 'raw',
			'filter' => CHtml::listData(Basket::model()->findAll(), 'id', 'sid'),
			'value' => 'Basket::model()->findByPk($data->complement_to)->sid',
		),
		'price',
		'site_price',
		'real_payed',
		array(
			'name' => 'currency',
			'type' => 'raw',
			'filter' => CHtml::listData(Currency::model()->findAll(), 'id', 's_title'),
			'value' => 'Currency::model()->findByPk($data->currency)->id',
		),
		'added',
		'valid_till',
		'payed',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
