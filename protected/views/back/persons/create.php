<?php
/* @var $this PersonsController */
/* @var $model Persons */

$this->breadcrumbs=array(
	'Persons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Persons', 'url'=>array('index')),
	array('label'=>'Manage Persons', 'url'=>array('admin')),
);
?>

<h1>Create Person</h1>

<?php 
	echo $this->renderPartial('_form', 
		array(
			'model'=>$model,
			'products'=>$products,
			'translates'=>$translates,
		)
	); 
?>