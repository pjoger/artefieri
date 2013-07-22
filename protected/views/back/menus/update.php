<?php
/* @var $this MenusController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Menus', 'url'=>array('index')),
	array('label'=>'Create Menu', 'url'=>array('create')),
	array('label'=>'View Menus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Menus', 'url'=>array('admin')),
);
?>

<h1>Update Menu: <?php echo $model->s_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>