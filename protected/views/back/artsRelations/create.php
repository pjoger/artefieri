<?php
/* @var $this ArtsRelationsController */
/* @var $model ArtsRelations */

$this->breadcrumbs=array(
	'Arts Relations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ArtsRelations', 'url'=>array('index')),
	array('label'=>'Manage ArtsRelations', 'url'=>array('admin')),
);
?>

<h1>Create ArtsRelations</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>