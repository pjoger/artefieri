<?php
/* @var $this ArtsRelationsController */
/* @var $model ArtsRelations */

$this->breadcrumbs=array(
	'Arts Relations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArtsRelations', 'url'=>array('index')),
	array('label'=>'Create ArtsRelations', 'url'=>array('create')),
	array('label'=>'View ArtsRelations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ArtsRelations', 'url'=>array('admin')),
);
?>

<h1>Update ArtsRelations <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>