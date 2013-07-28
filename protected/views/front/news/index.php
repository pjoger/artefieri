<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'News',
);

$this->renderPartial('menu/list');//, array('cat'=>isset($cat)?$cat:0,'limit'=>isset($limit)?$limit:0));

?>

        <div id="inner-block">
 			<?php
				$this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$dataProvider,
					'itemView'=>'_view',
					'htmlOptions'=>array('class'=>'events'),
					'ajaxUpdate'=>false,
					'emptyText'=>Yii::t('general', 'In this category there are no records.'),
					'summaryText'=>"",
					'pager'=>array(
							'class'=>'MyPager',
					),
				));
			?>
				<div class="clear"></div>
      </div>

