<?php
/* @var $this GenresController */
/* @var $model Genres */

$this->breadcrumbs=array(
	'Genres'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Genres', 'url'=>array('index')),
	array('label'=>'Manage Genres', 'url'=>array('admin')),
);
?>

<h1>Create Genres</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>