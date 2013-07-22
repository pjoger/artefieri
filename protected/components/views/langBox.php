<?php 
	$items = Lang::model()->menuItems();
	$cl = strtoupper(Yii::app()->language);
	
	echo '<ul class="menu">';
	foreach($items as $key=>$item) {
		$l = ($item['label'] == $cl) ? ' selected':'';
		echo '<li class="item'.$l.'">';
		echo CHtml::ajaxLink(
				$item['label'], 
				Yii::app()->createUrl(''),
				array(
						'type' =>'POST',
						'data' =>array('_lang' => strtolower($item['label'])),
						'success'=>'function(){location.reload();}',
				),
				$item['linkOptions']
			);
		echo '</li>';
	}	
	echo '</ul>';
?>
