<?php
/* @var $this ArtsController */
/* @var $model Arts */

$this->breadcrumbs=array(
	'Arts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Arts', 'url'=>array('index')),
	array('label'=>'Manage Arts', 'url'=>array('admin')),
);
?>

<h1>Create Arts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'authors'=>$authors, 'genres'=>$genres, 'translates'=>$translates)); ?>