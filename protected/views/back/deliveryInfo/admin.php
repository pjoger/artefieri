<?php
/* @var $this DeliveryInfoController */
/* @var $model DeliveryInfo */

$this->breadcrumbs=array(
	'Delivery Infos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DeliveryInfo', 'url'=>array('index')),
	array('label'=>'Create DeliveryInfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('delivery-info-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage: Delivery Info</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'delivery-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CLinkColumn',
			'labelExpression'=>'$data->id',
			'urlExpression'=>' Yii::app()->createUrl("deliveryInfo/update&id=".$data->id)',
			'header'=>Yii::t('content', 'ID'),
			'htmlOptions'=>array('style'=>'text-align:center'),
		),
		array(
			'name'=>'_order_price',
			'htmlOptions'=>array('style'=>'text-align:center'),
		),
		array(
			'name'=>'_order_payed',
			'htmlOptions'=>array('style'=>'text-align:center'),
		),
		'added',
		array(	
			'class' => 'CDataColumn',
			'type'  => 'text',
			'name'  => '_order_user',
			'header'=> 'User full name',
			'value' => '$data->addresses->s_full_name',//'$data->_order_user->s_full_name',
			'filter'=> '',
		),
		array(	
			'name'  => 'address',
			'type'  => 'raw',
			'value' => '$data->addresses->s_address',
		),
		array(
			'class'=>'CDataColumn',
			'type'=>'text',
			'name'=>'_order_user',
			'header'=>'User phone',
			'value'=>'$data->addresses->mobilePhone',
			'filter'=>'',
		),
		array(
			'class'=>'CDataColumn',
			'type'=>'text',
			'name'=>'_order_user',
			'header'=>'User email',
			'value'=>'$data->addresses->s_mail',
			'filter'=>'',
		),
		//'how_to_pay',
		//'status',
		array(
			'name' => 'status',
			'type' => 'raw',
			'value' => 'CHtml::dropDownList("delivery_status_".$data->id, '.
							'$data->status, array("0" => "Pending","1"=>"Processed", "3" => "Delivered", "4" => "Canceled"),'.
							'array('.
							'	"ajax"=>array("type"=>"POST", "url"=>Yii::app()->createUrl("deliveryInfo/statusUpdate"), '.
							'				"update"=>"#".$data->id, "data"=>array("id"=>$data->id, "status"=>"js:this.value"),'.
							'))'.
						');',
			'htmlOptions'=>array('style'=>'text-align:center'),
			'filter' => array("0" => "Pending","1"=>"Processed", "3" => "Delivered", "4" => "Canceled"),
		),
		//'added',
		//'last_update',
		//'s_note_user',
		//'s_note_oper',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}{update}',
		),
	),
)); 
?>