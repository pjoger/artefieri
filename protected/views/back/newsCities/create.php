<?php
/* @var $this NewsCitiesController */

$this->breadcrumbs=array(
	'News Cities'=>array('/newsCities'),
	'Create',
);

$this->menu=array(
	array('label'=>'List News Cities', 'url'=>array('index')),
	array('label'=>'Manage News Cities', 'url'=>array('admin')),
);
?>

<h1>Create News Cities</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
