<?php
/* @var $this NewsCitiesController */

$this->breadcrumbs=array(
	'News Cities',
);

$this->menu=array(
		array('label'=>'Create News Cities', 'url'=>array('create')),
		array('label'=>'Manage News Cities', 'url'=>array('admin')),
);

?>

<h1>Translations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
