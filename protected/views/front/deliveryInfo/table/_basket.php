<table border="1" id="basket-table">
    <thead>
    <tr>
        <th class="center"><?php echo Yii::t('content', 'Art');?></th>
        <th class="center"><?php echo Yii::t('content', 'Complement to');?></th>
        <th class="center"><?php echo Yii::t('content', 'Price');?></th>
        <th class="center"><?php echo Yii::t('content', 'Site Price');?></th>
		<th class="center"><?php echo Yii::t('content', 'Real paid');?></th>
		<th class="center"><?php echo Yii::t('content', 'Currency');?></th>
		<th></th>
	</tr>
    </thead>
    <tbody>
<?php
	if(isset($basket) && count($basket) > 0):
		foreach ($basket as $item):
			$art = Arts::model()->findByPk($item->art); 
?>

		<tr class="reset" id="item_<?php echo $item->id;?>">
            <td>
            <span><a href="<?php echo Yii::app()->createUrl('basket/update&id='.$item->id); ?>"><?php echo $art->s_name; ?></a></span>
            	<input type="hidden" name="arts[]" value="<?php echo $art->id; ?>" id="art_id_<?php echo $art->id; ?>">
            </td>
            <td class="center"><?php echo Arts::model()->findByPk(Basket::model()->findByPk($item->complement_to)->art)->s_name; ?></td>
            <td class="center"><?php echo $item->price; ?></td>
			<td class="center">
			<?php 
				$c_def = Yii::app()->cookie->getCurrency();
				$c = $item->currency;
				if ($c_def != $c)
					$v = $item->currencies->convertcurrency($c, $c_def, $item->site_price);
				else 
					$v = $item->site_price;
				echo $v.' '.$c_def; 
				
				//echo $item->site_price; 
			?>
			</td>
			<td class="center"><?php echo CHtml::textField('real_payed_'.$item->id, $item->real_payed, array('size'=>10,'align'=>'center')); ?></td>
			<td class="center"><?php echo Currency::model()->findByPk($item->currency)->id; ?></td>
			<!-- <td class="center"><?php echo $item->added; ?></td>
			<td class="center"><?php echo $item->payed; ?></td>
			<td class="center"><?php echo $item->valid_till; ?></td> -->
			<td class="center">
                <?php 
                	echo CHtml::ajaxLink(
						'<img src="'. Yii::app()->request->baseUrl .'/assets/32f803e/gridview/delete.png" alt="Delete" />',
						Yii::app()->createUrl('basket/deleteFrom'),
						array(
							'type' => 'POST',
							'success'=>'js:function(data){ $("#btUpdateBaskets").click();}', //function(){$(\'#basket-table tr#item_'. $item->id .'\').remove();}',
							'data' => array('id'=>$item->id)
						),	 
 						array(
							'class' => 'delete',
							'href' => Yii::app()->createUrl('basket/deleteFrom')
						)
					); 
				?>
            </td>
        </tr>
<?php endforeach; 
	endif; ?>
	</tbody>
    <tfoot>
        <th class="center" colspan="2"><?php echo Yii::t('content', 'Total');?></th>
        <th class="center"><?php echo $model->_order_amount; ?></th>
        <th class="center"><?php echo $model->_order_price; ?></th>
		<th class="center"><?php echo $model->_order_payed; ?></th>
		<th class="center" colspan="2"></th>
    </tfoot>
</table>
