<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

?>

<h1><?php echo Yii::app()->user->isGuest ? Yii::t('content', 'Registration') : Yii::t('content', 'Personal cabinet'); ?></h1>

<div class="kabinet-profile width50p">
	<h2 class="title colorRed"><?php echo Yii::t('content', 'Personal information'); ?></h2>
	<div class="profile-links">
		<?php 
		if (Yii::app()->user->isGuest) {
			echo CHtml::link(
				'<span class="colorRed">'.Yii::t('content', 'Registration').'</span>',
				Yii::app()->createUrl('/site/login'));
		} else {
			echo CHtml::link(
				'<span class="colorRed">'.Yii::t('content', 'Logout').'</span>',
				Yii::app()->createUrl('/site/logout'));
		}
		?>
	</div><!-- profile links -->
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	<div class="profile-links">
		<?php 
		echo CHtml::link(
			'<span class="colorRed">'.Yii::t('general', 'To gallery').'</span>',
			Yii::app()->createUrl('/arts/index'));
		?>
	</div><!-- profile links -->
</div>
<div class="kabinet-orders width50p" style="border-left: 1px solid red;">
	<h3 class="order-cart" style="margin-top: 10px;margin-left:10px;"><?php echo Yii::t('content', 'My orders'); ?></h3>
	<div class="profile-links">
		<?php 
			echo CHtml::link(
				'<span class="colorRed">'.Yii::t('general', 'Send feedback').'</span>',
				Yii::app()->createUrl('/site/feedback'));
		?>
	</div><!-- profile links -->
	<div class="clear"></div>
	<?php
		if (isset($delivery)) 
			echo $this->renderPartial('_orders', array('delivery'=>$delivery));
		else  
			echo $this->renderPartial('_orders');
	?>
</div>