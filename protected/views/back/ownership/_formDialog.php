<div class="form" id="ownershipDialogForm">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'ownership-form',
			'enableAjaxValidation'=>true,
	));
	?>
	    <?php echo $form->errorSummary($model); ?>
	  
	    <div class="row">
	    <?php 
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				//'model'=>$art,
			    'id'=>'id',
			    'name'=>'s_full_name',
			    'source'=>$this->createUrl('request/suggestAuthor'),
			    'htmlOptions'=>array(
			        'size'=>'40'
			    ),
			));
		?>			
		
	    <div class="row buttons float-right">
	        <?php echo CHtml::ajaxSubmitButton(
	        			Yii::t('ownership','Create Ownership'),
	        			CHtml::normalizeUrl(
							array('ownership/addnew','render'=>false)
						),
						array('success'=>'js: function(data) {
	                        $("#Person_id").append(data);
	                        $("#ownershipDialog").dialog("close");
	                    }'),
	        			array('id'=>'closeOwnershipDialog')
	        		); 
	        ?>
	    </div>
 
	<?php $this->endWidget(); ?>
 
</div>