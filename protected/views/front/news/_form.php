<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('general', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('general', 'are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'s_title'); ?>
		<?php echo $form->textField($model,'s_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'s_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_source'); ?>
		<?php 
			$this->widget('application.extensions.wysibb.WysiBBWidget', array(
				'model'=>$model,
				'attribute'=>'text_source',
			));
		?>
		<?php echo $form->error($model,'text_source'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_archive'); ?>
		<?php echo $form->checkBox($model,'is_archive'); ?>
		<?php echo $form->error($model,'is_archive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visible'); ?>
		<?php echo $form->checkBox($model,'visible'); ?>
		<?php echo $form->error($model,'visible'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php 
			echo $form->dropDownList($model, 'parent',
       			 CHtml::listData(News::model()->findAll(), 'id', 's_title')); 
		?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label(Yii::t('content', 'Countries'), 'news_countries'); ?>
		<?php 
			$this->widget('ext.widgets.multiselects.XMultiSelects',array(
			    'leftTitle'=>'',
			    'leftName'=>'News[countries_list][]',
			    'leftList'=>CHtml::listData(Countries::model()->getFreeCountriesByNews($model->id),'id','s_name'),
			    'rightTitle'=>'',
			    'rightName'=>'News[countries_selected][]',
			    'rightList'=>CHtml::listData(Countries::model()->getCountriesByNews($model->id),'id','s_name'),
			    'size'=>10,
			    'width'=>'200px',
			));		
		?>
	</div>
	
	<div class="row">
		<?php echo CHtml::label(Yii::t('content', 'Cities'), 'news_cities'); ?>
		<?php 
			$this->widget('ext.widgets.multiselects.XMultiSelects',array(
			    'leftTitle'=>'',
			    'leftName'=>'News[cities_list][]',
			    'leftList'=>CHtml::listData($model->isNewRecord ? Cities::model()->findAll() : Cities::model()->getFreeCitiesByNews($model->id),'id','s_name'),
			    'rightTitle'=>'',
			    'rightName'=>'News[cities_selected][]',
			    'rightList'=>CHtml::listData(Cities::model()->getCitiesByNews($model->id),'id','s_name'),
			    'size'=>10,
			    'width'=>'200px',
			));		
		?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('general', 'Create') : Yii::t('general', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 
Yii::app()->getClientScript()->registerScript('populateCities', '
	var changeHandler = function() {
		$.ajax({
		    url: "'. Yii::app()->createUrl('cities/getByCountry'). '",
			type: "POST",
		    data: (function(){
				var foo = []; 
				$("select[name=\'News[countries_selected][]\'] option").each(function(){
					var $this = $(this);
			        foo.push({name: "country[]", value: $this.val()});
				});
		    	return $.param(foo);
			})(),	        
		    success: function (data, textStatus) {
				$("select[name=\'News[cities_list][]\']").find(\'option\').remove();
				$("select[name=\'News[cities_list][]\']").append(data);
		    }
		});
	}
	$("select[name=\'News[countries_selected][]\']").change(changeHandler).keypress(changeHandler);
', CClientScript::POS_READY);
?>
