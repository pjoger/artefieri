<?php
/* @var $this CmsLangController */

$this->breadcrumbs=array(
	'Cms Lang'=>array('/cmsLang'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Translations', 'url'=>array('index')),
	array('label'=>'Manage Translations', 'url'=>array('admin')),
);
?>

<h1>Create CMS Translation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
