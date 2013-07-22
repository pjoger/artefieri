<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-4 first">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
// 			'title'=>'',
// 			'htmlOptions'=>'menu',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'left-menu'),
			'itemCssClass'=>'item',
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<div class="span-20">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>