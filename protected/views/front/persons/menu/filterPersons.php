<?php 

$menu = array(
		'activeCssClass'=>'selected',
		'linkLabelWrapper'=>null,
		'htmlOptions'=>array('class'=>'top-submenu columns'),
		'items'=>$items
);
$this->widget('zii.widgets.CMenu', $menu);
?>

