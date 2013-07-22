<?php 

$fdomain = $_SERVER['HTTP_HOST'];
$p = strrpos($fdomain, '.');
$fdomain = substr($fdomain, $p+1);
$l = Lang::model()->findByAttributes(array('domen'=>$fdomain));
$lang = ($l !== null) ? $l->lang_2 : 'en';
$langid = ($l !== null) ? $l->id : 2;

$art_types = '';
$art_genres = '';
if (isset($model->arts)){
	if (is_array($model->arts)){
		foreach ($model->arts as $art):
			$art_types .=  ' ' . $art->types->s_name;
			if(isset($art->genres0))
				foreach ($art->genres0 as $genre){
					$genres_lang = GenresLang::model()->findByAttributes(array('genre'=>$genre->id, 'lang'=>$langid));
					$genre_name = isset($genres_lang) && $genres_lang->s_name !='' ? $genres_lang->s_name : $genre->s_name;
					if (!stripos($genre_name, $art_genres))
						$art_genres .= ' ' . $genre_name;
				}
		endforeach;
	} else {
		$art_types .= ' ' . $model->arts->types->s_name;
		if(isset($model->arts->genres0))
			foreach ($model->arts->genres0 as $genre) {
				$genres_lang = GenresLang::model()->findByAttributes(array('genre'=>$genre->id, 'lang'=>$langid));
				$genre_name = isset($genres_lang) && $genres_lang->s_name !='' ? $genres_lang->s_name : $genre->s_name;
				if (!stripos($genre_name, $art_genres))
					$art_genres .= ' ' . $genre_name;
			}
	}
}


$persons_lang = PersonsLang::model()->findByAttributes(array('person'=>$model->id, 'lang'=>$langid));
$person_name = isset($persons_lang)&& $persons_lang->s_full_name !='' ? $persons_lang->s_full_name : $model->s_full_name;

$metaDescription = $art_types . ' ' . $person_name . ' ' . Yii::t('content', 'buy with delivery', array(), null, $lang);
$metaKeyword     = $art_types . ' ' . $person_name . ' ' . $art_genres;

Yii::app()->clientScript->registerMetaTag($metaDescription, 'description');
Yii::app()->clientScript->registerMetaTag($metaKeyword, 'keywords');

?>

<div class="author-details">
	<div class="author-info">
		<div class="author-name">
			<h1 class="title"><?php echo $model->_display_last_name . ' ' . $model->_display_first_name;?></h1>
		</div>
<?php /* 
		<div class="author-info-data">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'cssFile'=>Yii::app()->baseUrl . '/css/style.css',
				'attributes'=>array(
					's_first_name',
					's_middle_name',
					's_last_name',
					's_full_name',
					's_phone',
					's_address',
					's_email',
					's_www',
					'added',
					'birth',
					'lvl',
				),
			)); ?>
		</div><!-- author info data -->
*/ ?>
	</div><!-- author info -->
	<?php if($model->photo):?>
	<div class="author-image">
		<?php if ($model->photo && $model->_thumb_file !== null):?>
		<a href="#"><?php 
			echo CHtml::image($model->_thumb_file,
				$model->s_full_name,
				array("class" => "clickme", "title" => $model->s_full_name));
		?></a>
		<?php endif; ?>
	</div><!-- author image -->
	<?php endif; ?>
<!-- 	<div class="clear"></div> -->
	<div class="author-bio">
		<?php echo $model->_display_text_html; ?>
	</div>
	<!-- <div class="author-events">
		<div class="author-events-data">
			<ul class="author-events-list">
				<li class="item event"><a href="#" title="event"><span></span></a></li> 
			</ul>
		</div>
	</div> --> <!-- author events -->
	<div class="clear"></div>
	<div class="author-nav">
		<?php 
			echo CHtml::link(
				Yii::t('content', 'See the work'),
				array('arts/index','type'=>'author', 'value'=>$model->id),array("title"=>$model->s_full_name));
		?>			
	</div>
</div><!-- author details -->
 			
