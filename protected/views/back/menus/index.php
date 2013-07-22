<?php
/* @var $this MenusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menuses',
);

$this->menu=array(
	array('label'=>'Create Menu', 'url'=>array('create')),
	array('label'=>'Manage Menus', 'url'=>array('admin')),
);
?>

<h1>Menus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
