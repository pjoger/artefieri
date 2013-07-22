<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - '. Yii::t('content', 'Translates');

$this->breadcrumbs=array(
		'Translates'=>array('translates'),
		'Manage',
);

$this->menu=array(
		array('label'=>'Arts', 'url'=>array('/site/translates','t'=>'Arts')),
		array('label'=>'Authors', 'url'=>array('/site/translates','t'=>'Persons')),
		array('label'=>'Genres', 'url'=>array('/site/translates','t'=>'Genres')),
		array('label'=>'CMS', 'url'=>array('/site/translates','t'=>'Cms')),
);

$columns_lang = array(
//		'id'=>'id',
//		'name'=>$t_name,
		array(
			'class'=>'CLinkColumn',
			'labelExpression'=>'$data->'.$t_name,
			'urlExpression'=>' Yii::app()->createUrl("'.$t.'/update&id=".$data->id."#translates-table")',
			'header'=>Yii::t('content', 'Title'),
		),
	);

foreach ($langs as $lang){
	switch($t)
	{
		case 'Arts':
			$val = 'ArtsLang::model()->findByAttributes(array("art"=>$data->id,"lang"=>'. $lang->id .')) ? "Yes" : "No"';
			break;
		case 'Persons':
			$val = 'PersonsLang::model()->findByAttributes(array("person"=>$data->id,"lang"=>'. $lang->id .')) ? "Yes" : "No"';
			break;
		case 'Genres':
			$val = 'GenresLang::model()->findByAttributes(array("genre"=>$data->id,"lang"=>'. $lang->id .')) ? "Yes" : "No"';
			break;
		case 'Cms':
			$val = 'CmsLang::model()->findByAttributes(array("cms"=>$data->id,"lang"=>'. $lang->id .')) ? "Yes" : "No"';
			break;
	}

	$column_lang = array(
				'name' => $lang->lang_2,
				'type' => 'raw',
				'value' => $val,
 				'htmlOptions' => array('style'=>'text-align: center;','id'=>'translate-value')
	);
	$columns_lang[] = $column_lang;
}

?>

<h1>Manage Translates</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'translates-grid',
 	'dataProvider'=>$dataProvider,
	'columns'=>$columns_lang, 
)); 
?>

<?php 
Yii::app()->getClientScript()->registerScript('gridConditionalColor', '
		$(function(){
			$("#translates-grid td#translate-value").each(function(){
				var t =$(this).text();
				if(t == "Yes"){
					$(this).css("background-color","green");
					$(this).css("color","green");
				} else {
					$(this).css("background-color","red");
					$(this).css("color","red");
				}
			});
		});
//    $("#translates-grid td").css("color","green");  		
', CClientScript::POS_READY);
?>