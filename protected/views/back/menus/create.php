<?php
/* @var $this MenusController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Menus', 'url'=>array('index')),
	array('label'=>'Manage Menus', 'url'=>array('admin')),
);
?>

<h1>Create Menu</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>