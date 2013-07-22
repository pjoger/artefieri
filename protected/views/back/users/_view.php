<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login')); ?>:</b>
	<?php echo CHtml::encode($data->login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pwd')); ?>:</b>
	<?php echo CHtml::encode($data->pwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_mail')); ?>:</b>
	<?php echo CHtml::encode($data->s_mail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_phone')); ?>:</b>
	<?php echo CHtml::encode($data->s_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('offert_accepted')); ?>:</b>
	<?php echo CHtml::encode($data->offert_accepted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_full_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_full_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('s_first_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_middle_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_middle_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_last_name')); ?>:</b>
	<?php echo CHtml::encode($data->s_last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_city')); ?>:</b>
	<?php echo CHtml::encode($data->s_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_address')); ?>:</b>
	<?php echo CHtml::encode($data->s_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mail_confirmed')); ?>:</b>
	<?php echo CHtml::encode($data->mail_confirmed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msisdn')); ?>:</b>
	<?php echo CHtml::encode($data->msisdn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msisdn_confirmed')); ?>:</b>
	<?php echo CHtml::encode($data->msisdn_confirmed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_used')); ?>:</b>
	<?php echo CHtml::encode($data->last_used); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avatar')); ?>:</b>
	<?php echo CHtml::encode($data->avatar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avatar_w')); ?>:</b>
	<?php echo CHtml::encode($data->avatar_w); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avatar_h')); ?>:</b>
	<?php echo CHtml::encode($data->avatar_h); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('added')); ?>:</b>
	<?php echo CHtml::encode($data->added); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account')); ?>:</b>
	<?php echo CHtml::encode($data->account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo CHtml::encode($data->currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang')); ?>:</b>
	<?php echo CHtml::encode($data->lang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_paymethod')); ?>:</b>
	<?php echo CHtml::encode($data->last_paymethod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_ip')); ?>:</b>
	<?php echo CHtml::encode($data->last_ip); ?>
	<br />

	*/ ?>

</div>