<?php
/* @var $this MenusController */
/* @var $model Menus */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menus-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'s_name'); ?>
		<?php echo $form->textField($model,'s_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'s_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page'); ?>
		<?php 
			echo $form->textField($model,'page',array('size'=>60,'maxlength'=>100)); 
		?>

    	<?php  
			echo CHtml::link(Yii::t('content', 'Select Article'), "",   
				array(  
					'style'=>'cursor: pointer; text-decoration: underline;',  
					'onclick'=>"{ $('#addArticleModal').dialog('open');}"));  
		?>  
	 	<?php 
			$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			    'id'=>'addArticleModal',
			    'options'=>array(
			        'title'=>Yii::t('content', 'Select Article'),
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
		<div class="addArticleForm">
		<?php 
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			    'id'=>'id',
			    'name'=>'s_name',
			    'source'=>$this->createUrl('request/suggestArticle'),
			    'htmlOptions'=>array(
			        'size'=>'40'
			    ),
				'options'=>array(
					'showAnim'=>'fold',
					'select'=>'js: function(event, ui) {
						var atext = "/cms/view/"+ui.item.id;
						$("#Menus_page").val(atext);
						$("#addArticleModal").dialog("close");
					}'				
				),
			));
		?>			
		</div>
		<?php 
			$this->endWidget('zii.widgets.jui.CJuiDialog');
		?>
		
		<?php echo $form->error($model,'page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php 
			echo $form->dropDownList($model, 'parent',
					CHtml::listData(Menus::model()->findAll(array('order'=>'s_name')), 'id', 's_name', 'parent0.s_name'),
					array(
							'prompt' => '--Please Select --',
							'value' => null,
					)
				); 
			?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pos'); ?>
		<?php echo $form->textField($model,'pos'); ?>
		<?php echo $form->error($model,'pos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'noindex'); ?>
		<?php echo $form->textField($model,'noindex'); ?>
		<?php echo $form->error($model,'noindex'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->