<?php
/* @var $this PersonsLangController */
/* @var $data ArtsLang */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('news')); ?>:</b>
	<?php echo News::model()->findByPk($data->news)->s_title; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo Cities::model()->findByPk($data->city)->s_name; ?>
	<br />

</div>