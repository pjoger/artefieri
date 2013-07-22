<?php
/* @var $this NewsCitiesController */

$this->breadcrumbs=array(
	'News Cities'=>array('/newsCities'),
	'Update',
);

$this->menu=array(
	array('label'=>'List News Cities',  'url'=>array('index')),
	array('label'=>'Create News Cities', 'url'=>array('create')),
	array('label'=>'View News Cities',   'url'=>array('view', 'id'=>array('news'=>$model->news, 'city'=>$model->city))),
	array('label'=>'Manage News Cities','url'=>array('admin')),
);
?>

<h1>Update News Cities</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>