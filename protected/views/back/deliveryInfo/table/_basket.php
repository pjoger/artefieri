<table border="1" id="basket-table">
    <thead>
    <tr>
        <th class="center"><?php echo Yii::t('content', 'Art'); ?></th>
        <th class="center"><?php echo Yii::t('content', 'Complement to'); ?></th>
        <th class="center"><?php echo Yii::t('content', 'Price'); ?></th>
        <th class="center"><?php echo Yii::t('content', 'Site Price'); ?></th>
		<th class="center"><?php echo Yii::t('content', 'Real payed'); ?></th>
		<th class="center"><?php echo Yii::t('content', 'Currency'); ?></th>
		<th></th>
	</tr>
    </thead>
    <tbody>
<?php
	if(isset($basket) && count($basket) > 0):
		foreach ($basket as $item):
			$art = Arts::model()->findByPk($item->art); 
			if(!$art) continue;
?>

		<tr class="reset" id="item_<?php echo $item->id;?>">
            <td>
            <span><a href="<?php echo Yii::app()->createUrl('basket/update&id='.$item->id); ?>" target="_blank"><?php echo $art->s_name; ?></a></span>
            	<input type="hidden" name="arts[]" value="<?php echo $art->id; ?>" id="art_id_<?php echo $art->id; ?>">
            </td>
            <td class="center"><?php 
            	echo ($item->complement_to !== null) ? Arts::model()->findByPk(Basket::model()->findByPk($item->complement_to)->art)->s_name : "";
            ?></td>
            <td class="center"><?php echo $item->price; ?></td>
			<td class="center"><?php echo $item->site_price; ?></td>
			<td class="center"><?php 
				echo CHtml::textField('real_payed_'.$item->id, $item->real_payed, array('size'=>10,'align'=>'center','id'=>'paid_'.$item->id));
				echo CHtml::ajaxLink(
						CHtml::image(Yii::app()->baseUrl.'/assets/32f803e/gridview/update.png'), 
						Yii::app()->createUrl('basket/updatePaid'),
						array(
								'type' => 'POST',
								'update'=>'#paid_'. $item->id,
								'data' => array('id'=>$item->id, 'paid'=>'js:$("#paid_'.$item->id.'").val()')
						)
					);
			?></td>
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
							'success'=>'js:function(data){ $("#btUpdateBaskets").click();}',
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
        <th class="center" colspan="2">Total</th>
        <th class="center"><?php echo $model->_order_amount; ?></th>
        <th class="center"><?php echo $model->_order_price; ?></th>
		<th class="center"><?php echo $model->_order_payed; ?></th>
		<th class="center" colspan="2"></th>
    </tfoot>
</table>
<div class="row">
	<div class="row buttons float-right">
   	<?php  
		echo CHtml::link('Добавить в корзину', "", 
			array(
				'style'=>'cursor: pointer; text-decoration: underline;',
				'onclick'=>"{ $('.basketForm').toggle(); }"
			)
		);
	?>
	</div>  
	<div class="basketForm form clear" id="new_basket-block">
		<?php 
			$modelB = new Basket();	
			$this->renderPartial('../basket/_form', array('model'=>$modelB, 'delivery'=>$model)); 
		?>
	</div>
</div>				
<?php 
	echo CHtml::ajaxButton("UpdateItem",
			CController::createUrl('deliveryInfo/AjaxLoadBaskets',array('id'=>$model->id)), 
			array('update' => '#baskets-form'),
			array('style'=>'display:none', 'id'=>'btUpdateBaskets'));
?>
<?php 
Yii::app()->getClientScript()->registerScript('submitNewBasket', '
    	$("#basket-form").live("submit", function(e) {
            e.preventDefault();
            var formOptions = {
                url: "'. Yii::app()->createUrl('basket/create'). '",
                success: function(data) {
                    var prod_id;
                    var error;
                    try {
                        prod_id = jQuery.parseJSON(data);
                    } catch(err) {
                        error = 1;
                    }
                    if(error == 1) {
                        $("#new_basket-block").html(data);
                    } else {
						$("#btUpdateBaskets").click();
					}
				},
                error: function(data) {
                    alert("Ошибка добавления записи.");
                }
            };
            $("#basket-form").ajaxSubmit(formOptions);
	});
    		
', CClientScript::POS_READY);
?>