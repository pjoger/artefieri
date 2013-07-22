<table border="1" id="translates-table">
    <thead>
    <tr>
    	<th colspan=3 class="center" style="border-bottom: 1px solid #ffc">Переводы</th>
    </tr>
    <tr>
        <th class="center">Язык</th>
        <th class="center">Название</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
<?php
	if(isset($translates) && count($translates) > 0):
		foreach ($translates as $translate):
			$art_lang = Lang::model()->findByPk($translate->lang); 
?>

		<tr class="reset" id="<?php echo $art_lang->id;?>">
            <td class="center">
            	<span><?php echo $art_lang->s_name; ?></span>
            </td>
            <td class="center">
            	<span>
            	<?php
            		echo CHtml::link($translate->s_name,
								array(
									'ArtsLang/view',
									'id'=>array('art'=>$translate->art,'lang'=>$translate->lang),
								),
								array('target'=>'_blank')
            				); 
            	?>
            	</span>
            </td>
            <td class="center">
                <?php 
                	echo CHtml::ajaxLink(
						'<img src="'. Yii::app()->request->baseUrl .'/assets/32f803e/gridview/delete.png" alt="Delete" />',
						Yii::app()->createUrl('ArtsLang/deleteFromArt'),
						array(
							'type' => 'POST',
							'success'=>'function(){$(\'#translates-table tr#'. $art_lang->id .'\').remove();}',
							'data' => array('id'=>array('art'=>$translate->art, 'lang'=>$translate->lang))
						),	 
 						array(
							'class' => 'delete',
							'href' => Yii::app()->createUrl('ArtsLang/deleteFromArt')
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
		echo CHtml::link('Добавить перевод', "", 
			array(
				'style'=>'cursor: pointer; text-decoration: underline;',
				'onclick'=>"{ $('.translateForm').toggle(); }"
			)
		);
	?>
	</div>  
	<div class="translateForm form clear" id="new_translate-block">
		<?php 
			$modelT = new ArtsLang();	
			$this->renderPartial('../artsLang/_form', array('model'=>$modelT, 'art'=>$art)); 
		?>
	</div>
</div>				
<?php 
	echo CHtml::ajaxButton("UpdateTranslates",
			CController::createUrl('arts/AjaxLoadTranslates',array('id'=>$art->id)), 
			array('update' => '#translates-form'),
			array('style'=>'display:none', 'id'=>'btUpdateTranslates'));
?>
<?php 
Yii::app()->getClientScript()->registerScript('submitNewTranslation', '
    	$("#artslang-form").live("submit", function(e) {
            e.preventDefault();
            var formOptions = {
                url: "'. Yii::app()->createUrl('ArtsLang/create'). '",
                success: function(data) {
                    var prod_id;
                    var error;
                    try {
                        prod_id = jQuery.parseJSON(data);
                    } catch(err) {
                        error = 1;
                    }
                    if(error == 1) {
                        $("#new_translate-block").html(data);
                    } else {
						$("#btUpdateTranslates").click();
					}
				},
                error: function(data) {
                    alert("Ошибка добавления записи.");
                }
            };
            $("#artslang-form").ajaxSubmit(formOptions);
	});
    		
', CClientScript::POS_READY);
?>