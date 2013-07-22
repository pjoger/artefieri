<?php
/* @var $this NewsCountriesController */

$this->breadcrumbs=array(
	'News Countries'=>array('/newsCountries'),
	'Create',
);

$this->menu=array(
	array('label'=>'List News Countries', 'url'=>array('index')),
	array('label'=>'Manage News Countries', 'url'=>array('admin')),
);
?>

<h1>Create News Countries</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
