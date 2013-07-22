<?php
/* @var $this LangController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Langs',
);

$this->menu=array(
	array('label'=>'Create Lang', 'url'=>array('create')),
	array('label'=>'Manage Lang', 'url'=>array('admin')),
);
?>

<h1>Langs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
