<?php
/* @var $this ArtsDiscountController */
/* @var $model ArtsDiscount */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'arts-discount-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'art'); ?>
		<?php 
				echo $form->dropDownList($model, 'art',
        			CHtml::listData(Arts::model()->findAll(), 'id', 's_name'),
						array(
							'prompt' => '--Please Select --',
							'value' => '0',
							'ajax'  => array(
									'type'  => 'POST',
									'url' => CController::createUrl('artsDiscount/GetArtPrice'),
									'update' => '#product_price',   //selector to update value
									'data' => array('artid'=>'js:this.value'),
									'success' => 'function(data){
										$("#product_price").val(data);
										if($("#percent_discount").val()){
											$("#percent_discount").change();
										}
									}',
							)
						)
				); 
		?>
		<?php echo $form->error($model,'art'); ?>
	</div>

	<div class="row">
		<div class="float-left no-margin-left">
			<?php echo CHtml::label('Product price', 'product_price'); ?>
			<?php
				$value = $model->isNewRecord ? '' : Arts::model()->findByPk($model->art)->price;
				echo CHtml::textField('product_price', $value, array('id'=>'product_price', 'size'=>10, 'maxlength'=>10, 'readonly'=>true)); 
			?>
		</div>
		<div class="float-left ">
			<?php echo CHtml::label('Percent', 'percent_discount'); ?>
			<?php 
				$percent = $model->isNewRecord ? '' : (Arts::model()->findByPk($model->art)->price - $model->new_price);
				echo CHtml::textField('percent_discount', $percent, 
					array(
						'id'=>'percent_discount', 
						'size'=>10, 
						'maxlength'=>10,
					)
				); 
			?>
		</div>
		<div class="float-left">
			<?php echo $form->labelEx($model,'new_price'); ?>
			<?php echo $form->textField($model,'new_price',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'new_price'); ?>
		</div>
	</div>

	<div class="row clear">
		<?php echo $form->labelEx($model,'expired'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>'expired',
				'model'=>$model,
				'attribute'=>'expired',
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
		<?php echo $form->error($model,'expired'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 
Yii::app()->getClientScript()->registerScript('productDiscount', '
	$("#percent_discount").change(function(){ 
		var op = parseInt($("#product_price").val());
		var  p = parseInt($(this).val());
		if(op){
			var np = op - (op*p)/100;
			$("#ArtsDiscount_new_price").val(np);
		}
	});
	$("#ArtsDiscount_new_price").change(function(){ 
		var op = parseInt($("#product_price").val());
		var np = parseInt($(this).val());
		if(op){
			var p = 100 - (np*100)/op;
			$("#percent_discount").val(p);
		}
	});
	', CClientScript::POS_READY);
?>