<table border="1" id="products-table">
    <thead>
    <tr>
    	<th colspan=3 class="center" style="border-bottom: 1px solid #ffc">Товары</th>
    </tr>
    <tr>
        <th class="center">Название</th>
        <th class="center">Тип товара</th>
        <th class="center"></th>
    </tr>
    </thead>
    <tbody>
<?php
	if(isset($products) && count($products) > 0):
		foreach($products as $product):
			$art = Arts::model()->findByPk($product->art); 
?>

		<tr class="reset" id="art_<?php echo $art->id;?>">
            <td>
            	<span>
            	<?php
            		echo CHtml::link($art->s_name,
								array(
									'arts/view',
									'id'=>$art->id,
								),
								array('target'=>'_blank')
            				); 
            	?>
            	</span>
            	<input type="hidden" name="arts[]" value="<?php echo $art->id; ?>" id="arts_id_<?php echo $art->id; ?>">
            </td>
            <td class="center">
            	<span><?php echo ArtTypes::model()->findByPk($art->type)->s_name; ?></span>
            </td>
            <td class="center">
                <?php 
                	echo CHtml::ajaxLink(
						'<img src="'. Yii::app()->request->baseUrl .'/assets/32f803e/gridview/delete.png" alt="Delete" />',
						Yii::app()->createUrl('ownership/deleteFromArt'),
						array(
							'type' => 'POST',
							'success'=>'function(){$(\'#products-table tr#art_'. $art->id .'\').remove();}',
							'data' => array('art'=>$art->id, 'person'=>$author->id)
						),	 
 						array(
							'class' => 'delete',
							'href' => Yii::app()->createUrl('ownership/deleteFromArt')
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
		echo CHtml::link('Добавить товар', "", 
			array(
				'style'=>'cursor: pointer; text-decoration: underline;',
				'onclick'=>"{ $('.productsForm').toggle(); }"
			)
		);
	?>
	</div>  
	<div class="productsForm form clear" id="new_products-block">
		<?php 
			$modelA = new Arts();	
			$this->renderPartial('../arts/_form', array('model'=>$modelA, 'author'=>$author)); 
		?>
	</div>
</div>				
<?php 
	echo CHtml::ajaxButton("UpdateProducts",
			CController::createUrl('persons/AjaxLoadArts',array('id'=>$author->id)), 
			array('update' => '#arts-form'),
			array('style'=>'display:none', 'id'=>'btUpdateProducts'));
?>
<?php 
Yii::app()->getClientScript()->registerScript('submitNewProduct', '
    	$("#arts-form").live("submit", function(e) {
            e.preventDefault();
            var formOptions = {
                url: "'. Yii::app()->createUrl('arts/create'). '",
                success: function(data) {
                    var prod_id;
                    var error;
                    try {
                        prod_id = jQuery.parseJSON(data);
                    } catch(err) {
                        error = 1;
                    }
                    if(error == 1) {
                        $("#new_product-block").html(data);
                    } else {
						$("#btUpdateProducts").click();
					}
				},
                error: function(data) {
                    alert("Ошибка добавления записи.");
                }
            };
            $("#arts-form").ajaxSubmit(formOptions);
	});
    		
', CClientScript::POS_READY);
?>