<?php
/* @var $this PersonsLangController */

$this->breadcrumbs=array(
	'Persons Lang'=>array('/personsLang'),
	'Update',
);

$this->menu=array(
	array('label'=>'List Translations',  'url'=>array('index')),
	array('label'=>'Create Translation', 'url'=>array('create')),
	array('label'=>'View Translation',   'url'=>array('view', 'id'=>array('person'=>$model->person, 'lang'=>$model->lang))),
	array('label'=>'Manage Translations','url'=>array('admin')),
);
?>

<h1>Update Author Translation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
