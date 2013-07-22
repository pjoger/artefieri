<?php
/* @var $this SuperArtTypesToTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Super Art Types To Types',
);

$this->menu=array(
	array('label'=>'Create SuperArtTypesToTypes', 'url'=>array('create')),
	array('label'=>'Manage SuperArtTypesToTypes', 'url'=>array('admin')),
);
?>

<h1>Super Art Types To Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
