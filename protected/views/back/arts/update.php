<?php
/* @var $this ArtsController */
/* @var $model Arts */

$this->breadcrumbs=array(
	'Arts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Arts', 'url'=>array('index')),
	array('label'=>'Create Arts', 'url'=>array('create')),
	array('label'=>'View Arts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Arts', 'url'=>array('admin')),
);
?>

<h1>Update Art: <?php echo $model->s_name; ?></h1>

<?php 
	echo $this->renderPartial('_form', 
			array(
				'model'=>$model, 
				'authors'=>$authors, 
				'genres'=>$genres, 
				'translates'=>$translates,
				'modelFCopy'=>$modelFCopy,
				'modelACopy'=>$modelACopy,
			)); 
?>