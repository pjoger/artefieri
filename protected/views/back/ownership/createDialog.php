<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	    'id'=>'ownershipDialog',
	    'options'=>array(
	        'title'=>'Выберите автора',
	        'width'=>380,
	        'height'=>200,
	        'autoOpen'=>true,
	        'resizable'=>false,
	        'modal'=>true,
	        'overlay'=>array(
	            'backgroundColor'=>'#000',
	            'opacity'=>'0.5'
	        ),
// 	        'buttons'=>array(
// 	            'OK'=>'js:function(){alert("OK");}',
// 	            'Cancel'=>'js:function(){$(this).dialog("close");}',
// 	        ),
	    ),
	));
	
	
?>
<?php 
	echo $this->renderPartial('_formDialog', array('model'=>$model)); 
?>
<?php 
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
