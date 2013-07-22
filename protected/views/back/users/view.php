<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
		'login',
//		'pwd',
		's_mail',
		's_phone',
		'offert_accepted',
		's_full_name',
// 		's_first_name',
// 		's_middle_name',
// 		's_last_name',
		's_city',
		's_address',
		'mail_confirmed',
		'msisdn',
		'msisdn_confirmed',
		'last_used',
		'avatar',
// 		'avatar_w',
// 		'avatar_h',
		'added',
		'account',
// 		'currency',
		array(
				'name' => 'currency',
				'type' => 'raw',
				'filter' => CHtml::listData(Currency::model()->findAll(), 'id', 's_title'),
				'value'=> Currency::model()->findByPk($model->currency)->s_title,
		),
// 		'lang',
		array(	
			'name' => 'lang',
			'type' => 'raw',
			'filter' => CHtml::listData(Lang::model()->findAll(), 'id', 's_name'),
			'value' => Lang::model()->findByPk($model->lang)->s_name,
		),
		'last_paymethod',
		'last_ip',
	),
)); ?>
