<?php
/* @var $this PersonsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Persons',
);

$this->renderPartial('menu/list');//, array('cat'=>isset($cat)?$cat:0,'limit'=>isset($limit)?$limit:0));

?>

<div id="inner-block">

<?php 
if($limit == 1 || count($model)==1){
	if($model)
	echo $this->renderPartial('_personDetails',array(
			'model'=>$model[0],
			'limit'=>$limit,
	));
} else {

	$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view', 
			'ajaxUpdate'=>false, 
			'emptyText'=>Yii::t('general', 'In this category there are no records.'),
			'summaryText'=>"",
			'pager'=>array(
				'class'=>'MyPager',
			),
	));

}
?>
</div>