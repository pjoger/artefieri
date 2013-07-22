<?php 
	$items = Currency::model()->menuItems();
	$cc = strtoupper(Yii::app()->cookie->getCurrency());

	echo '<ul class="menu">';
	foreach($items as $key=>$item) {
		$l = ($item['label'] == $cc) ? ' selected':'';
		echo '<li class="item'.$l.'">';
		echo CHtml::ajaxLink(
				$item['label'], 
				Yii::app()->createUrl(''),
				array(
						'type' =>'POST',
						'data' =>array('_currency' => $item['label']),
						'success'=>'function(){location.reload();}',
				),
				$item['linkOptions']
			);
		echo '</li>';
	}	
	echo '</ul>';
?>
