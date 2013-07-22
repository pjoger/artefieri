<?php
/* @var $this SuperArtTypesController */
/* @var $model SuperArtTypes */

$this->breadcrumbs=array(
	'Super Art Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SuperArtTypes', 'url'=>array('index')),
	array('label'=>'Manage SuperArtTypes', 'url'=>array('admin')),
);
?>

<h1>Create SuperArtTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>