<?php
/* @var $this CmsController */
/* @var $data Cms */
/* Short view of articles */

?>

<div class="view">

	<h3><strong><?php echo CHtml::link($data->_display_title, Yii::app()->createUrl('cms/view', array('id'=>$data->id))); ?></strong></h3>

	<div class="article-details">
		<?php if ($data->user):?>
			<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
			<?php echo CHtml::encode($data->user); ?>
			<br />
		<?php endif;?>
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('added')); ?>:</b>
		<?php echo CHtml::encode($data->added); ?>
	</div>

	<div class="article-intro">
	<?php echo $data->_display_html; ?>
	</div>

</div>