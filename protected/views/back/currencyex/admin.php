<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
	'Currencies'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Currency', 'url'=>array('index')),
	array('label'=>'Create Currency', 'url'=>array('create')),
);

?>

<h1>Manage Currency rates</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'currency-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
        array(
            'id'=>'id',
            'class'=>'CCheckBoxColumn',
            'selectableRows' => '50',
        ),
		'conversion_rate',
		'country',
		'currency',
        array(
            'name'=>'status',
            'header'=>'Status',
            'filter'=>array('1'=>'Active','0'=>'In active'),
            'value'=>'($data->status==1)?("Active"):("In active")',
        ),
		//'currency_code',
		//'status',
		array(
			'header'=>'Update Rate',
			'type'=>'raw',
			'value'=> 'CHtml::link($data->currency_code, Yii::app()->createUrl("currencymanager/currency/updateconversionrate",array("id"=>$data->id)))',
		),
		/*
		'updated_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('currency-grid');
    }
</script>
<?php $this->endWidget(); ?>