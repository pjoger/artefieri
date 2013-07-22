<?php
/* @var $this SuperArtTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Super Art Types',
);

$this->menu=array(
	array('label'=>'Create SuperArtTypes', 'url'=>array('create')),
	array('label'=>'Manage SuperArtTypes', 'url'=>array('admin')),
);
?>

<h1>Super Art Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
