<?php
/* @var $this BasketController */
/* @var $model Basket */

$this->breadcrumbs=array(
	'Baskets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Basket', 'url'=>array('index')),
	array('label'=>'Create Basket', 'url'=>array('create')),
	array('label'=>'View Basket', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Basket', 'url'=>array('admin')),
);
?>

<h1>Update Basket <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>