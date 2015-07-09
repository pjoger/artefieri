<?php

$fdomain = $_SERVER['HTTP_HOST'];
$p = strrpos($fdomain, '.');
$fdomain = substr($fdomain, $p+1);
$l = Lang::model()->findByAttributes(array('domen'=>$fdomain));
$lang = ($l !== null) ? $l->lang_2 : 'en';
$langid = ($l !== null) ? $l->id : 2;

$arts_lang = ArtsLang::model()->findByAttributes(array('art'=>$model->id, 'lang'=>$langid));
$arts_name = isset($arts_lang) && $arts_lang->s_name != '' ? $arts_lang->s_name : $model->s_name;

$metaDescription = $model->types->s_name . ' ' . $arts_name;
$metaKeyword = $model->types->s_name . ' ' . $arts_name;

if(isset($model->persons0)){
	$metaDescription .= ' '. Yii::t('content', 'authors', array(), null, $lang);
	if (is_array($model->persons0)){
		foreach ($model->persons0 as $key=>$author):
			$persons_lang = PersonsLang::model()->findByAttributes(array('person'=>$author->id, 'lang'=>$langid));
			$person_name = isset($persons_lang)&& $persons_lang->s_full_name !='' ? $persons_lang->s_full_name : $author->s_full_name;
			$metaDescription .=  ' ' . $person_name . ' ';
			$metaKeyword .=  ' ' . $person_name;
		endforeach;
	} else {
		$persons_lang = PersonsLang::model()->findByAttributes(array('person'=>$model->persons0->id, 'lang'=>$langid));
		$person_name = isset($persons_lang)&& $persons_lang->s_full_name !='' ? $persons_lang->s_full_name : $model->persons0->s_full_name;
		$metaDescription .= ' ' . $model->persons0->_display_full_name;
		$metaKeyword .= ' ' . $model->persons0->_display_full_name;
	}
}
$metaDescription .= ' '. Yii::t('content', 'buy with delivery', array(), null, $lang) . ' ';

Yii::app()->clientScript->registerMetaTag($metaDescription, 'description');

if(isset($model->genres0))
{
	foreach ($model->genres0 as $key=>$genre)
	{
		$genres_lang = GenresLang::model()->findByAttributes(array('genre'=>$genre->id, 'lang'=>$langid));
		$genre_name = isset($genres_lang) && $genres_lang->s_name !='' ? $genres_lang->s_name : $genre->s_name;
		$metaKeyword .= ' ' . $genre_name;
	}
}

Yii::app()->clientScript->registerMetaTag($metaKeyword, 'keywords');

?>

	<!-- <h1><?php echo $model->_display_name; ?></h1> -->
        	<div class="product-details">
            	<div class="product-image">
                	<a href="#"><?php
                				if($model->cover){
	                        		echo CHtml::image($model->_covers['600x'],
	                        			$model->s_name,
	                        			array("class" => "clickme", "title" => $model->s_name));
                				}
                    ?></a>
                </div><!-- product  image -->
                <div class="product-info">
                	<div class="product-data">
                    	<ul class="product-data-table">
                        	<li><span class="detail-title"><?php echo Yii::t('content', 'Title'); ?>: </span><span class="detail-data">«<?php echo $model->_display_name; ?>»</span></li>
                        	<li><span class="detail-title"><?php echo Yii::t('content', 'Author'); ?>: </span>
							<?php
								if (is_array($model->persons0)){
									foreach ($model->persons0 as $key=>$author):
										echo ($key > 0)?',':'';
										echo '<span class="detail-data">'. $author->_display_full_name .'</span>';
									endforeach;
								} else {
									echo '<span class="detail-data">'. $model->persons0->_display_full_name .'</span>';
								}
							?>
                        	</li>
                        	<li><span class="detail-title"><?php echo Yii::t('content', 'Produced'); ?>: </span><span class="detail-data"><?php echo $model->produced; ?></span></li>
                        	<li><span class="detail-title"><?php echo Yii::t('content', 'Size'); ?>: </span><span class="detail-data"><?php echo (isset($model->size_x)?$model->size_x/10 : '') . ' x ' .(isset($model->size_y)?$model->size_y/10:'');?></span></li>
<?php /*
                        	<li>
                        		<span class="detail-title"><?php echo Yii::t('content', 'Price'); ?>: </span>
                        		<span class="detail-data">
                        		<?php
                        			//echo $model->site_price;
                        			$c_def = Yii::app()->cookie->getCurrency();
									$c = $model->currency;
									if ($c_def != $c)
										$v = $model->currencies->convertcurrency($c, $c_def, $model->site_price);
									else
										$v = $model->site_price;
                        			echo $v.' '.$c_def;
                        		?>
                        		</span>
                        	</li>
*/?>
                        	<li><span class="detail-title"><?php echo Yii::t('content', 'Genre'); ?>: </span>
                        	<?php
								$s = '';
								foreach ($model->genres0 as $key=>$genre)
								{
									if ($genre->s_parent == 1)
									{
										$s .= $s != '' ? ', ' : '';
										$s .= '<span class="detail-data">'. $genre->s_name .'</span>';
									}
								};
								echo $s;
                        	?>
                        	</li>
                        	<li><span class="detail-title"><?php echo Yii::t('content', 'Theme'); ?>: </span>
                        	<?php
								$s = '';
								foreach ($model->genres0 as $key=>$genre)
								{
									if ($genre->s_parent == 9)
									{
										$s .= $s != '' ? ', ' : '';
										$s .= '<span class="detail-data">'. $genre->s_name .'</span>';
									}
								};
								echo $s;
                        	?>
                        	</li>
                        	<li><span class="detail-title"><?php echo Yii::t('content', 'The dominant color'); ?>: </span><span class="detail-data">СЕРЫЙ, БЕЛЫЙ</span></li>
                        </ul>
                    </div><!-- product dtails -->
                    <div class="product-order">
                    	<div class="product-cart">
                        	<div class="order-cart"><?php echo CHtml::link('<span>'. Yii::t('content', 'Buy') .'</span>',array('basket/AddToBasket','artid'=>$model->id),array("class"=>"info")); ?></div>
                        </div> <!-- order cart -->
                        <div class="item-list">
                        	<ul>
                        		<li><a href="" title=""><span><?php echo Yii::t('content', 'Payment method'); ?></span></a></li>
                        		<li><a href="" title=""><span><?php echo Yii::t('content', 'Ask a question about the goods'); ?></span></a></li>
                        		<li><a href="" title=""><span><?php echo Yii::t('content', 'Back to work list'); ?></span></a></li>
                            </ul>
                        </div><!-- links -->
                    </div><!-- order block -->
                </div><!-- product info -->
                <div class="clear"></div>
            </div><!-- product details -->
