<?php
/* @var $this SessionsController */
/* @var $model Sessions */

$this->breadcrumbs=array(
	'Sessions'=>array('index'),
	$model->sid=>array('view','id'=>$model->sid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sessions', 'url'=>array('index')),
	array('label'=>'Create Sessions', 'url'=>array('create')),
	array('label'=>'View Sessions', 'url'=>array('view', 'id'=>$model->sid)),
	array('label'=>'Manage Sessions', 'url'=>array('admin')),
);
?>

<h1>Update Sessions <?php echo $model->sid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>