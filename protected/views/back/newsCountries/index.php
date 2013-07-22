<?php
/* @var $this NewsCountriesController */

$this->breadcrumbs=array(
	'News Countries',
);

$this->menu=array(
		array('label'=>'Create News Countries', 'url'=>array('create')),
		array('label'=>'Manage News Countries', 'url'=>array('admin')),
);

?>

<h1>Translations</h1>

<?php 
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
?>