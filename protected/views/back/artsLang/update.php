<?php
/* @var $this ArtsLangController */

$this->breadcrumbs=array(
	'Translations'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'List Translations',  'url'=>array('index')),
	array('label'=>'Create Translation', 'url'=>array('create')),
	array('label'=>'View Translation',   'url'=>array('view', 'id'=>array('art'=>$model->art, 'lang'=>$model->lang))),
	array('label'=>'Manage Translations','url'=>array('admin')),
);
?>

<h1>Update Art Translation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

