<?php
/* @var $this ArtsController */
/* @var $model Arts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'arts-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data'
	),
)); 
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'s_name'); ?>
		<?php echo $form->textField($model,'s_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model, 'type',
        CHtml::listData(ArtTypes::model()->findAll(), 'id', 's_name')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_descr_source'); ?>
		<?php 
				$this->widget('application.extensions.wysibb.WysiBBWidget', array(
					'model'=>$model,
					'attribute'=>'text_descr_source',
				));
		?>
		<?php echo $form->error($model,'text_descr_source'); ?>
	</div>

	<div class="row float-left no-margin-left">
		<?php
			if ($model->cover && $model->_thumb_file !== null){	
				echo CHtml::image($model->_thumb_file,
					$model->s_name,
					array("class" => "clickme", "title" => $model->s_name));
			}
			echo "<br/>".$form->fileField($model, '_image_file');
		?>
	</div>
	
	<div class="row float-left">
		<?php echo $form->labelEx($model,'cover'); ?>
		<?php echo $form->textField($model,'cover',array('size'=>3,'maxlength'=>3,'readonly'=>'readonly')); ?>
		<?php echo $form->labelEx($model,'cover_w'); ?>
		<?php echo $form->textField($model,'cover_w', array('readonly'=>'readonly')); ?>
		<?php echo $form->labelEx($model,'cover_h'); ?>
		<?php echo $form->textField($model,'cover_h', array('readonly'=>'readonly')); ?>
	</div>
	
	<div class="row clear">
		<?php echo $form->labelEx($model,'produced'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>'produced',
				'model'=>$model,
				'attribute'=>'produced',
				'language'=>'ru',
			    'options'=>array(
			        'showAnim'=>'fold',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'height:20px;', 
					'size'=>30,
					'class'=>'date'
			    ),
			));
		?>		
		<?php echo $form->error($model,'produced'); ?>
	</div>

	<!--  <div class="row">
		<?php //echo $form->labelEx($model,'currency'); ?>
		<?php //echo $form->dropDownList($model, 'currency',
        	//CHtml::listData(Currency::model()->findAll(), 'id', 'id')) ?>
		<?php //echo $form->error($model,'currency'); ?>
	</div>  -->

	<div class="row float-left no-margin-left">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row float-left">
		<?php echo $form->labelEx($model,'site_price'); ?>
		<?php echo $form->textField($model,'site_price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'site_price'); ?>
	</div>

<?php if($model->type == 1):?>	
	<div class="row clear">
		<div class="cpanel">
			<input class="float-left" type="checkbox" name="Arts_copy" id="Arts_copy" <?php echo (isset($modelACopy) && $modelACopy!=null)?"checked=checked" : ""; ?>>
			<label class="float-left" for="Arts_copy">Возможность авторской копии</label>
			<div class="cpanelContent clear">

				<div class="row float-left no-margin-left">
					<label for="Arts_price">Цена авторской копии</label>		
					<input size="10" maxlength="10" name="Arts_price_2" id="Arts_price_2" type="text" <?php echo (isset($modelACopy) && $modelACopy!=null)?'value="'.$modelACopy->price.'"' : 'value="0"'; ?>>
				</div>				
			
				<div class="row float-left">
					<label for="Arts_site_price">Цена авторской копии на сайте</label>		
					<input size="10" maxlength="10" name="Arts_site_price_2" id="Arts_site_price_2" type="text" <?php echo (isset($modelACopy) && $modelACopy!=null)?'value="'.$modelACopy->site_price.'"' : 'value="0"'; ?>>			
				</div>
				
			</div>
		</div>
	</div>

	<div class="row clear">
		<div class="cpanel">
			<input class="float-left" type="checkbox" name="Arts_foto_copy" id="Arts_foto_copy" <?php echo (isset($modelFCopy) && $modelFCopy!=null)?"checked=checked" : ""; ?> />
			<label class="float-left" for="Arts_foto_copy">Возможность фото копии</label>
			<div class="cpanelContent clear">

				<div class="row float-left no-margin-left">
					<label for="Arts_foto_price">Цена закупочной фото копии</label>		
					<input size="10" maxlength="10" name="Arts_foto_price_2" id="Arts_foto_price_2" type="text" <?php echo (isset($modelFCopy) && $modelFCopy!=null)?'value="'.$modelFCopy->price.'"' : 'value="0"'; ?>>
				</div>				
			
				<div class="row float-left">
					<label for="Arts_foto_site_price">Цена фото копии на сайте</label>		
					<input size="10" maxlength="10" name="Arts_foto_site_price_2" id="Arts_foto_site_price_2" type="text" <?php echo (isset($modelFCopy) && $modelFCopy!=null)?'value="'.$modelFCopy->site_price.'"' : 'value="0"'; ?>>			
				</div>
				
			</div>
		</div>
	</div>
<?php endif; ?>
	
	<div class="row clear">
		<?php echo $form->labelEx($model,'options'); ?>
		<?php echo $form->checkBox($model, 'options'); ?>
		<?php echo $form->error($model,'options'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'size_x'); ?>
		<?php echo $form->textField($model,'size_x'); ?>
		<?php echo $form->error($model,'size_x'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'size_y'); ?>
		<?php echo $form->textField($model,'size_y'); ?>
		<?php echo $form->error($model,'size_y'); ?>
	</div>

	<div class="row float-left no-margin-left">
		<?php echo CHtml::label(Yii::t('content', 'Country'), 'countries'); ?>
		<?php
			$countries = Countries::model()->findAll(array('order'=>'s_name'));
			$list = CHTML::listData($countries, 'id', 's_name');
			echo CHTML::dropDownList('countries', '', $list, 
						array(
								'prompt'=> '- '. Yii::t('content', 'Country') .' -',
								'ajax' => array(
										'type' => 'POST',
										'url'  => CController::createUrl('cities/loadCities'),
										'update' => '#cities',
										'data' => array('country'=>'js:this.value'),
								)
						)
					);
		?>
	</div>

	<div class="row float-left no-margin-left clear">
		<?php echo CHtml::label(Yii::t('content', 'City'), 'cities'); ?>
		<?php
			$cities = Cities::model()->findAll(array('order'=>'s_name'));
			$list = CHTML::listData($cities, 'id', 's_name');
			echo CHTML::dropDownList('cities', 'empty', $list, array('empty'=>''));
		?>
	</div>

	<div class="row clear">
	<?php 
		if(isset($authors)){ 
	    	$this->renderPartial('table/_authors', 
				array(
					'art'=>$model,
					'authors'=>$authors,
				)
			); 
		}
	?>
	</div>
	
	<div class="row">
	<?php echo CHtml::label('Жанры', ''); ?>
	<?php
		$s = ($model->id == '') ? '' : $model->id;
		$this->widget(
		    'CTreeView',
		    array(
				'id'=>'genresTree',
				'url' => array('arts/ajaxFillTree', $s),
			)
		);
	?>
	</div>
	
	<div class="row buttons clear" style="border-top: 1px solid #ccc;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'submitButtonAdmin float-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="clear"></div>

<?php if(!$model->isNewRecord):?>
<div class="form" id="translates-form">
	
<!-- 		<pre> -->
		<?php //print_r($translates); ?>
<!-- 		</pre> -->
	
<?php 
	if(isset($translates)): 
    	$this->renderPartial('table/_translate', 
			array(
				'art'=>$model,
				'translates'=>$translates,
			)
		); 
	endif; 
?>
	
</div><!-- end translates form -->
<?php endif; ?>
<?php 
    Yii::app()->getClientScript()->registerScript(
		'bindTreeNode',
		'$("ul#genresTree").find("li# input:checkbox.genre").live("click",function() {
	        if(!$(this).is(":checked")) {
				var returnVal = confirm("Вы уверенны что хотите удалить из данного жанра?");
				$(this).attr("checked", !returnVal);
				if(returnVal){
					jQuery.ajax({
            			type: "POST",
						data: {art:"'.$model->id.'", genre:$(this).val()},
            			url: "'.Yii::app()->createUrl('artsGenres/deleteFromArt').'",
            			success: function(html){
							//alert("genre removed");
						},
						error: function(xhr,tStatus,e){
							if(!xhr){
								//alert(" We have an error ");
								//alert(tStatus+"   "+e.message);
							}else{
								//alert("else: "+e.message);
							}
						},
         			});		
				} else {
					alert("genre not removed");
				}
	        }
		});',
		CClientScript::POS_READY
	);
?>
