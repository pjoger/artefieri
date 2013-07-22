<?php
/* @var $this PersonsController */
/* @var $model Persons */

$this->breadcrumbs=array(
	'Persons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Persons', 'url'=>array('index')),
	array('label'=>'Create Persons', 'url'=>array('create')),
	array('label'=>'View Persons', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Persons', 'url'=>array('admin')),
);
?>

<h1>Update Person: <?php echo $model->s_full_name; ?></h1>

<?php 
	echo $this->renderPartial('_form', 
		array(
			'model'=>$model,
			'products'=>$products,
			'translates'=>$translates,
		)
	); 
?>