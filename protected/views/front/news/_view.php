<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<strong><?php echo CHtml::link(CHtml::encode($data->s_title),array('news/view','id'=>$data->id)); ?></strong>

</div>