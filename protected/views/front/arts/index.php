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
        		if($limit == 1 && isset($model[0])){
					echo $this->renderPartial('_artDetails',array(
						'model'=>$model[0],
// 						'cat'=>$cat,
// 						'limit'=>$limit,
					));
				 } else {
        	?>
        	<div class="products">
        		<?php foreach ($model as $product):?>
                	<div class="product-item">
                    	<div class="product-item-image">
                        	<a href="#" title="<?php echo $product->_display_name; ?>">
                        	<?php
                        		echo  CHtml::link(
										CHtml::image($product->_covers['320x240'],
                        					$product->_display_name,
                        					array("class" => "clickme", "title" => $product->_display_name))
										,array('arts/view','id'=>$product->id),array("class"=>"info"));
                        	?>
                        	</a>
                        </div><!-- product image -->
                        <div class="product-item-details">
                        	<div class="product-item-title floatleft">
                            	<h3 class="title">"<?php echo CHtml::link('<span>'.$product->_display_name.'</span>',array('arts/view','id'=>$product->id),array("class"=>"info")); ?>"</h3>
                            </div> <!-- product title -->
<?php /*
                            <div class="product-item-info floatright">
                            	<?php echo CHtml::link('<span>i</span>',array('arts/view','id'=>$product->id),array("class"=>"info")); ?>
                            </div><!-- product info -->
*/ ?>
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
                        </div>
                    </div><!-- product item -->

                <?php endforeach; ?>
            </div><!-- product details -->
            <?php } ?>
			<!-- <div class="clear"></div> -->
			<div class="paginator">
				<?php $this->widget('MyPager', array(
					'pages' => $pages,
					'maxButtonCount'=>10,
				));?>
			</div>

		</div>