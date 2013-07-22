<?php
/* @var $this SuperArtTypesController */
/* @var $model SuperArtTypes */

$this->breadcrumbs=array(
	'Super Art Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SuperArtTypes', 'url'=>array('index')),
	array('label'=>'Create SuperArtTypes', 'url'=>array('create')),
	array('label'=>'View SuperArtTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SuperArtTypes', 'url'=>array('admin')),
);
?>

<h1>Update SuperArtTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>