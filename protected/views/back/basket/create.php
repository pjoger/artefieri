<?php
/* @var $this BasketController */
/* @var $model Basket */

$this->breadcrumbs=array(
	'Baskets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Basket', 'url'=>array('index')),
	array('label'=>'Manage Basket', 'url'=>array('admin')),
);
?>

<h1>Create Basket</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>