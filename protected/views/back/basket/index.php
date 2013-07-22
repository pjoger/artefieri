<?php
/* @var $this BasketController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Baskets',
);

$this->menu=array(
	array('label'=>'Create Basket', 'url'=>array('create')),
	array('label'=>'Manage Basket', 'url'=>array('admin')),
);
?>

<h1>Baskets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
