<table border="1" id="addresses-table">
    <thead>
    <tr>
        <th class="center">SID</th>
        <th class="center">e-Mail</th>
        <th class="center">City</th>
        <th class="center">Full Name</th>
		<th class="center">Address</th>
		<th class="center">Metro</th>
		<th class="center">Home phone</th>
		<th class="center">Mobile phone</th>
		<th class="center">PO box</th>
		<th></th>
	</tr>
    </thead>
    <tbody>
<?php
	if(isset($addresses) && count($addresses) > 0):
		foreach ($addresses as $item):
?>

		<tr class="reset" id="item_<?php echo $item->id;?>">
            <td class="center"><?php echo $item->sid; ?></td>
            <td class="center"><?php echo $item->s_mail; ?></td>
            <td class="center"><?php echo $item->s_city_name; ?></td>
			<td class="center"><?php echo $item->s_full_name; ?></td>
			<td class="center"><?php echo $item->s_address; ?></td>
			<td class="center"><?php echo $item->metro; ?></td>
			<td class="center"><?php echo $item->homePhone; ?></td>
			<td class="center"><?php echo $item->mobilePhone; ?></td>
			<td class="center"><?php echo $item->postal_index; ?></td>
			<td class="center">
                <?php 
                	echo CHtml::ajaxLink(
						'<img src="'. Yii::app()->request->baseUrl .'/assets/32f803e/gridview/delete.png" alt="Delete" />',
						Yii::app()->createUrl('deliveryAddress/deleteFromUser'),
						array(
							'type' => 'POST',
							'success'=>'js:function(data){ $("#btUpdateAddresses").click();}',
							'data' => array('id'=>$item->id)
						),	 
 						array(
							'class' => 'delete',
							'href' => Yii::app()->createUrl('deliveryAddress/deleteFromUser')
						)
					); 
				?>
            </td>
        </tr>
<?php endforeach; 
	endif; ?>
	</tbody>
</table>
<div class="row">
	<div class="row buttons float-right">
   	<?php  
		echo CHtml::link('Добавить адресс', "", 
			array(
				'style'=>'cursor: pointer; text-decoration: underline;',
				'onclick'=>"{ $('.addressesForm').toggle(); }"
			)
		);
	?>
	</div>  
	<div class="addressesForm form clear" id="new_address-block">
		<?php 
			$modelA = new DeliveryAddress();	
			$this->renderPartial('../deliveryAddress/_form', array('model'=>$modelA, 'user'=>$model)); 
		?>
	</div>
</div>				
<?php 
	echo CHtml::ajaxButton("UpdateItem",
			CController::createUrl('users/AjaxLoadAddresses',array('id'=>$model->id)), 
			array('update' => '#addresses-form'),
			array('style'=>'display:none', 'id'=>'btUpdateAddresses'));
?>
<?php 
Yii::app()->getClientScript()->registerScript('submitNewAddress', '
    	$("#delivery-address-form").live("submit", function(e) {
            e.preventDefault();
            var formOptions = {
                url: "'. Yii::app()->createUrl('deliveryAddress/create'). '",
                success: function(data) {
                    var prod_id;
                    var error;
                    try {
                        prod_id = jQuery.parseJSON(data);
                    } catch(err) {
                        error = 1;
                    }
                    if(error == 1) {
                        $("#new_address-block").html(data);
                    } else {
						$("#btUpdateAddresses").click();
					}
				},
                error: function(data) {
                    alert("Ошибка добавления записи.");
                }
            };
            $("#delivery-address-form").ajaxSubmit(formOptions);
	});
    		
', CClientScript::POS_READY);
?>