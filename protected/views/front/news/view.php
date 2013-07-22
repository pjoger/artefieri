<?php
/* @var $this NewsController */
/* @var $model News */
?>

<div class="author-details">

	<div class="author-info">
		<div class="author-name">
			<h1><?php echo $model->s_title; ?></h1>
		</div>
		<div class="author-info-data">
			
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'cssFile'=>Yii::app()->baseUrl . '/css/style.css',
			'attributes'=>array(
				'text_source',
				'added',
				array(
					'name' => 'parent',
					'value'=> $model->parent!=null ? News::model()->findByPk($model->parent)->s_title : '',
				),
			),
		)); ?>

		</div><!-- author info data -->
	</div><!-- author info -->
</div><!-- author details -->