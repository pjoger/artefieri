<?php
/* @var $this ArtsLangController */

$this->breadcrumbs=array(
	'Arts Lang'=>array('/artsLang'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Translations', 'url'=>array('index')),
	array('label'=>'Manage Translations', 'url'=>array('admin')),
);
?>

<h1>Create Arts Translation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
