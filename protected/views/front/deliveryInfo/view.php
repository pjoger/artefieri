<?php
/* @var $this DeliveryInfoController */
/* @var $model DeliveryInfo */

$this->breadcrumbs=array(
	'Delivery Infos'=>array('index'),
	$model->id,
);

$statuses = array(
		'0'=>Yii::t('content','Pending'),
		'1'=>Yii::t('content','Processed'),
		'3'=>Yii::t('content','Delivered'), 
		'4'=>Yii::t('content','Canceled')
		)

?>

<h1><?php echo Yii::t('content','View DeliveryInfo');?> #<?php echo $model->id; ?> for <?php echo Yii::app()->user->name; ?></h1>
<h2><?php echo Yii::t('content','Thank you for your order. Please check your email or profile for details.');?></h2>
<div class="deliveryDetails">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl . '/css/style.css',
	'attributes'=>array(
		'id',
		array(
			'label'=>'Adress',
			'value'=>DeliveryAddress::model()->findByAttributes(array("id"=>$model->address))->s_address,
		),
		//'how_to_pay',
		'last_update',
		array(
			'label'=>'Status',
			'value'=>$statuses[$model->status],
		),
		's_note_user',
		's_note_oper',
		'added',
	),
)); ?>
</div>