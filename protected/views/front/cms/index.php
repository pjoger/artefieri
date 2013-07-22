<?php
/* @var $this CmsController */
/* @var $dataProvider CActiveDataProvider */
/* dixplay index of articles */

$this->breadcrumbs=array(
	'Cms',
);

?>

<h1><?php echo Yii::t('content', 'Articles'); ?></h1>

<?php 
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
?>
