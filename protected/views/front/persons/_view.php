<?php
/* @var $this PersonsController */
/* @var $data Persons */
?>

<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->_display_full_name), array('persons/view','id'=>$data->id)); ?>

</div>