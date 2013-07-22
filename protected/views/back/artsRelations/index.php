<?php
/* @var $this ArtsRelationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Arts Relations',
);

$this->menu=array(
	array('label'=>'Create ArtsRelations', 'url'=>array('create')),
	array('label'=>'Manage ArtsRelations', 'url'=>array('admin')),
);
?>

<h1>Arts Relations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
