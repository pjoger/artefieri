<?php
/* @var $this ArtsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Arts',
);

$this->renderPartial('menu/list');//, array('cat'=>isset($cat)?$cat:0,'limit'=>isset($limit)?$limit:0));


?>
	<div id="inner-block">
			<?php
                if($count >= 120 || $count == 0){
                    echo $message;
                } 
        		else if($count == 1 && isset($model[0])){
					echo $this->renderPartial('_artDetails',array(
						'model'=>$model[0],
					));
				 } 
                 else { 
        	?>
			<h1><?php echo Yii::t('general', 'Search results'); ?></h1>
			<h3><?php echo Yii::t('general', 'Search by') . ' : ' .$keyword; ?></h3>
        	<div class="products">
        		<?php foreach ($model as $product):?>
            	<!-- <div class="products-row"> -->
            	
                	<div class="product-item">
                    	<div class="product-item-image">
                        	<a href="#" title="<?php echo $product->s_name; ?>">
                        	<?php 
                        		$author = isset($product->persons0) && count($product->persons0)>0 ? $product->persons0[0]->_display_full_name : ''; 
                        		echo  CHtml::link(
										CHtml::image($product->_thumb_file,
                        					$product->s_name,
                        					array("class" => "clickme", "title" => $product->s_name . ' : ' . $author , 'width'=>320, 'height'=>240))
										,array('arts/view','id'=>$product->id),array("class"=>"info"));
                        	?>
                        	</a>
                        </div><!-- product image -->
                        <div class="product-item-details">
                        	<div class="product-item-title floatleft">
                            	<h3 class="title">"<?php echo CHtml::link('<span>'.$product->s_name.'</span>',array('arts/view','id'=>$product->id),array("class"=>"info")); ?>"</h3>
                            </div> <!-- product title -->
                            <div class="product-item-info floatright">
                            	<?php echo CHtml::link('<span>i</span>',array('arts/view','id'=>$product->id),array("class"=>"info")); ?>
                            </div><!-- product info -->
<?php /*
                            <div class="product-item-price floatright">
                            	<h3 class="price"><?php 
                            		//echo $product->site_price;
                            		$c_def = Yii::app()->cookie->getCurrency();
                            		$c = $product->currency;
                            		if ($c_def != $c)
                            			$v = $product->currencies->convertcurrency($c, $c_def, $product->site_price);
                            		else
                            			$v = $product->site_price;
                            		echo $v.' '.$c_def;
                            		
                            		//echo Yii::app()->getModule('currencymanager')->convertcurrency($c,$product->site_price).' '.$c;
                            	?></h3>
                            </div><!-- product price -->
*/?>
                        </div>
                    </div><!-- product item -->
                                        
                <!-- </div> --><!-- products row -->
                <?php endforeach; ?>
            </div><!-- product details -->
            <?php } ?>

		</div>