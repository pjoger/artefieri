<?php
/* @var $this CmsLangController */

$this->breadcrumbs=array(
	'Cms Lang'=>array('/cmsLang'),
	'Update',
);

$this->menu=array(
	array('label'=>'List Translations',  'url'=>array('index')),
	array('label'=>'Create Translation', 'url'=>array('create')),
	array('label'=>'View Translation',   'url'=>array('view', 'id'=>array('cms'=>$model->cms, 'lang'=>$model->lang))),
	array('label'=>'Manage Translations','url'=>array('admin')),
);
?>

<h1>Update CMS Translation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
