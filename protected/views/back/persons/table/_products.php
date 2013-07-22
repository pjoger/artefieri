<table border="1" id="products-table">
    <thead>
    <tr>
    	<th colspan=3 class="center" style="border-bottom: 1px solid #ffc"><?php echo Yii::t('content', 'Artwork'); ?></th>
    </tr>
    <tr>
        <th class="center"><?php echo Yii::t('content', 'Title'); ?></th>
        <th class="center"><?php echo Yii::t('content', 'Art type'); ?></th>
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
		echo CHtml::link(Yii::t('content', 'Create Artwork'), "", 
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
	<div class="row buttons float-right">
    	<?php  
			echo CHtml::link(Yii::t('content', 'Select Artwork'), "", // the link for open the dialog  
				array(  
					'style'=>'cursor: pointer; text-decoration: underline;',  
					'onclick'=>"{ $('#addArtModal').dialog('open');}"));  
		?>  
	 	<?php 
			$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			    'id'=>'addArtModal',
			    'options'=>array(
			        'title'=>Yii::t('content', 'Select Artwork'),
			        'width'=>380,
			        'height'=>200,
			        'autoOpen'=>false,
			        'resizable'=>false,
			        'modal'=>true,
			        'overlay'=>array(
			            'backgroundColor'=>'#000',
			            'opacity'=>'0.5'
			        ),
			    ),
			));
		?>
		<div class="addArtForm">
		<?php 
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			    'id'=>'id',
			    'name'=>'s_name',
			    'source'=>$this->createUrl('request/suggestArt'),
			    'htmlOptions'=>array(
			        'size'=>'40'
			    ),
				'options'=>array(
					'showAnim'=>'fold',
					'select'=>'js: function(event, ui) {
						var iid = "#art_id_"+ui.item.id;
						if($(iid).length == 0){
							$.post(
								"'. Yii::app()->createUrl('ownership/addArt').'",
								{ art: ui.item.id, person: "'. $author->id .'" }
							).done(function(){ 
								var arow = "<tr id=\"art_"+ui.item.id+"\">"+
										   "<td><span>"+ui.item.value+"</span>"+
										   "<input type=\"hidden\" name=\"arts[]\" value=\""+ui.item.id+"\" id=\"art_id_"+ui.item.id+"\">"+
										   "</td>"+
										   "<td class=\"center\">"+ui.item.type+"</td>"+
										   "<td class=\"center\">"+
"<a class=\"delete\" href=\"#\" id=\"yt__"+ui.item.id+"\" onclick=\"jQuery(function(){jQuery.ajax({\'type\':\'POST\', \'success\':function(){$(\'#products-table tr#art_"+ui.item.id+"\').remove();}, \'data\':{\'art\':\'"+ui.item.id+"\',\'person\':\''. $author->id .'\'}, \'url\':\''. Yii::app()->createUrl('ownership/deleteFromArt') .'\', \'cache\':false });});return false; \">"+
"<img src=\"'. Yii::app()->request->baseUrl .'/assets/32f803e/gridview/delete.png\" alt=\"Delete\"></a></td></tr>";
								$("#products-table").append(arow);
							})
							 .fail(function(){ alert("fail add"); });
						}
						$("#addArtModal").dialog("close");
					}'				
				),
			));
		?>			
		</div>
	<?php 
		$this->endWidget('zii.widgets.jui.CJuiDialog');
	?>
	</div>		
</div>				
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