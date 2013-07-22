<table border="1" id="translates-table">
    <thead>
    <tr>
    	<th colspan=3 class="center" style="border-bottom: 1px solid #ffc">Переводы</th>
    </tr>
    <tr>
        <th class="center">Язык</th>
        <th class="center">Полное имя</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
<?php
	if(isset($translates) && count($translates) > 0):
		foreach ($translates as $translate):
			$person_lang = Lang::model()->findByPk($translate->lang); 
?>

		<tr class="reset" id="<?php echo $person_lang->id;?>">
            <td class="center">
            	<span><?php echo $person_lang->s_name; ?></span>
            </td>
            <td class="center">
            	<span>
            	<?php
            		echo CHtml::link($translate->s_full_name,
								array(
									'PersonsLang/view',
									'id'=>array('person'=>$translate->person,'lang'=>$translate->lang),
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
						Yii::app()->createUrl('PersonsLang/deleteFromPerson'),
						array(
							'type' => 'POST',
							'success'=>'function(){$(\'#translates-table tr#'. $person_lang->id .'\').remove();}',
							'data' => array('id'=>array('person'=>$translate->person, 'lang'=>$translate->lang))
						),	 
 						array(
							'class' => 'delete',
							'href' => Yii::app()->createUrl('PersonsLang/deleteFromPerson')
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
			$modelT = new PersonsLang();	
			$this->renderPartial('../personsLang/_form', array('model'=>$modelT, 'person'=>$author)); 
		?>
	</div>
</div>				
<?php 
Yii::app()->getClientScript()->registerScript('submitNewTranslation', '
        //var arow = new String("<tr><td class=\"center\"><span>&lang_name&</span></td><td class=\"center\"><span>&art_name&</span></td><td class=\"center\">&del_but&</td></tr>");
    	$("#personslang-form").live("submit", function(e) {
            e.preventDefault();
            var formOptions = {
                url: "'. Yii::app()->createUrl('/PersonsLang/create'). '",
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
						var pid = '. $author->id .';
						var fn = $("#personslang-form input[name=\"PersonsLang[s_first_name]\"]").val();
						var mn = $("#personslang-form input[name=\"PersonsLang[s_middle_name]\"]").val();
						var ln = $("#personslang-form input[name=\"PersonsLang[s_last_name]\"]").val();
						var lan = $("#personslang-form select[name=\"PersonsLang[lang]\"]").val();
						var lan_t = $("#personslang-form select[name=\"PersonsLang[lang]\"] option:selected").text();
						var arow = "<tr id=\""+lan+"\">"+
									"<td class=\"center\"><span>"+lan_t+"</span></td>"+
									"<td class=\"center\"><span>"+fn+" "+mn+" "+ln+"</span></td>"+
									"<td class=\"center\">"+
"<a class=\"delete\" href=\"#\" id=\"yt__"+lan+"\" onclick=\"jQuery(function(){jQuery.ajax({\'type\':\'POST\', \'success\':function(){$(\'#translates-table tr#"+lan+"\').remove();}, \'data\':{\'id\':{\'person\':\'"+pid+"\',\'lang\':\'"+lan+"\'}}, \'url\':\''. Yii::app()->createUrl('PersonsLang/deleteFromPerson') .'\', \'cache\':false });});return false; \">"+
"<img src=\"'. Yii::app()->request->baseUrl .'/assets/32f803e/gridview/delete.png\" alt=\"Delete\"></a>"+
									"</td></tr>";
 								$("#translates-table").append(arow);
								$(".translateForm").toggle();
					}
				},
                error: function(data) {
                    alert("Ошибка добавления записи.");
                }
            };
            $("#personslang-form").ajaxSubmit(formOptions);
	});
    		
', CClientScript::POS_READY);
?>