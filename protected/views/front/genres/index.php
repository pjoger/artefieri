<?php
/* @var $this GenresController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Genres',
);

$this->menu=array(
	array('label'=>Yii::t('content','Create Genres'), 'url'=>array('create')),
	array('label'=>Yii::t('content', 'Manage Genres'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('content', 'Genres'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
