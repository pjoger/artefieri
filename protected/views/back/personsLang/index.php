<?php
/* @var $this PersonsLangController */

$this->breadcrumbs=array(
	'Persons Lang',
);

$this->menu=array(
		array('label'=>'Create Translation', 'url'=>array('create')),
		array('label'=>'Manage Translations', 'url'=>array('admin')),
);

?>

<h1>Translations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>