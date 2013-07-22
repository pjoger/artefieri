<table border="1" id="authors-table">
    <thead>
    <tr>
        <th class="center">Автор</th>
        <th class="center">Уровень</th>
        <th class="center"></th>
    </tr>
    </thead>
    <tbody>
<?php
	if(isset($authors) && count($authors) > 0):
		foreach ($authors as $author):
			$person = Persons::model()->findByPk($author->person); 
?>

		<tr class="reset" id="author_<?php echo $person->id;?>">
            <td>
            	<span><?php echo $person->s_full_name; ?></span>
            	<input type="hidden" name="authors[]" value="<?php echo $person->id; ?>" id="authors_id_<?php echo $person->id; ?>">
            </td>
            <td class="center"><?php echo $person->lvl; ?></td>
            <td class="center">
                <?php 
                	echo CHtml::ajaxLink(
						'<img src="'. Yii::app()->request->baseUrl .'/assets/32f803e/gridview/delete.png" alt="Delete" />',
						Yii::app()->createUrl('ownership/deleteFromArt'),
						array(
							'type' => 'POST',
							'success'=>'function(){$(\'#authors-table tr#author_'. $person->id .'\').remove();}',
							'data' => array('art'=>$art->id, 'person'=>$person->id)
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
<div class="art_actions-block">
	<div class="row buttons">
    	<?php  
			echo CHtml::link('Добавить автора', "", // the link for open the dialog  
				array(  
					'style'=>'cursor: pointer; text-decoration: underline;',  
					'onclick'=>"{ $('#addAuthorModal').dialog('open');}"));  
		?>  
	 	<?php 
			$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			    'id'=>'addAuthorModal',
			    'options'=>array(
			        'title'=>'Выберите автора',
			        'width'=>380,
			        'height'=>200,
			        'autoOpen'=>false,
			        'resizable'=>false,
			        'modal'=>true,
			        'overlay'=>array(
			            'backgroundColor'=>'#000',
			            'opacity'=>'0.5'
			        ),
//			        'buttons'=>array(
// 			            'OK'=>'js:function(){
// 								var arow = "<tr><td>"+$(\'#s_full_name\').val()+"</td><td>2</td><td>3</td><td>4</td></tr>";
// 								$("#authors-table").append(arow);
// 								$(this).dialog("close");
// 							}',
//						'OK'=>'js:function(){$(this).dialog("close");}',
//			            'Cancel'=>'js:function(){$(this).dialog("close");}',
//			        ),
			    ),
			));
		?>
		<div class="addAuthorForm">
		<?php 
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				//'model'=>$art,
			    'id'=>'id',
			    'name'=>'s_full_name',
			    'source'=>$this->createUrl('request/suggestAuthor'),
			    'htmlOptions'=>array(
			        'size'=>'40'
			    ),
				'options'=>array(
					'showAnim'=>'fold',
					'select'=>'js: function(event, ui) {
						var iid = "#author_id_"+ui.item.id;
						if($(iid).length == 0){
							var arow = "<tr id=\"author_"+ui.item.id+"\"><td><span>"+ui.item.value+"</span><input type=\"hidden\" name=\"authors[]\" value=\""+ui.item.id+"\" id=\"author_id_"+ui.item.id+"\"></td><td class=\"center\">"+ui.item.level+"</td><td class=\"center\"><a href=\"\" onclick=\"$(\'#authors-table tr#author_"+ui.item.id+"\').remove();\" class=\"delete\" title=\"delete\"><img src=\"'. Yii::app()->request->baseUrl .'/assets/32f803e/gridview/delete.png\" alt=\"Delete\" /></a></td></tr>";
							$("#authors-table").append(arow);
						}
						$("#addAuthorModal").dialog("close");
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
