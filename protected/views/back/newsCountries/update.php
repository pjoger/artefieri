<?php
/* @var $this NewsCountriesController */

$this->breadcrumbs=array(
	'News Countries'=>array('/newsCountries'),
	'Update',
);

$this->menu=array(
	array('label'=>'List News Countries',  'url'=>array('index')),
	array('label'=>'Create News Countries', 'url'=>array('create')),
	array('label'=>'View News Countries',   'url'=>array('view', 'id'=>array('news'=>$model->news, 'country'=>$model->country))),
	array('label'=>'Manage News Countries','url'=>array('admin')),
);
?>

<h1>Update News Countries</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
