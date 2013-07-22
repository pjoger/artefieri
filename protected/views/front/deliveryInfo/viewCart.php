<?php
/* @var $this DeliveryInfoController */
/* @var $model DeliveryInfo */

$this->breadcrumbs=array(
	'Delivery Info'=>array('index'),
	$model->id,
);

$c_def = Yii::app()->cookie->getCurrency();

?>

<?php if(count($baskets) == 0):?> 
<h1 class="title order-cart float-left" ><?php echo Yii::t('content','The cart is empty, please make come orders before');?></h1>
<div class="clear"></div>
<?php else: ?>
<h1 class="title " ><span class="order-cart float-left"><?php echo Yii::t('content','Cart');?></span></h1>
<div class="clear"></div>
<table style="width: 100%" class="order-form">
	<tr>
		<td style="width:50%">
			<div class="cart-block">
			<?php 
				$product_price = 0;
				$service_price = 0;
				$total_price = 0;
				$discount = 0;
				$nalog = 0;
				
				$basket_baghet = false;
				$basket_glass = false;
				$basket_paspartu = false;
				
				foreach ($baskets as $basket):
				
					if ($basket->complement_to !== null){	
						switch($basket->arts0->types->id){
							case 4: $basket_baghet = true; break;
							case 6: $basket_glass = true; break;
							case 5: $basket_paspartu = true; break;
						}
					} else {
						$artId = $basket->art;
					}
					
			?>
				<div class="profile-block">
					<?php 
						$hasimage = $basket->arts0->_thumb_file !== null;
						if($hasimage){ ?>
							<div class="order-item-image">
								<img class="item-tumb" src="<?php echo $basket->arts0->_thumb_file; ?>"/>
							</div>
					<?php }	?>
					<ul class="order-info" <?php if($hasimage) echo 'style="width: 70%;"'; ?>>
						<li>
							<span class="order-field-title"><?php echo $basket->arts0->types->s_name; ?></span>
							<span class="selectFor">
							<?php 
								if ($basket->complement_to == null){
									echo CHtml::link(Yii::t('content','Select'),array('arts/index'), array('class'=>'colorRed '));
								} else {
									echo CHtml::link(Yii::t('content','Select'),array('arts/selectBaguette', 'artId'=>$artId), array('class'=>'colorRed '));
								}
							?>
							</span>
						</li>
						<li>
							<span class="order-field-name"><?php echo Yii::t('content','Title');?>:</span>
							<span class="order-field-value colorRed"><?php echo $basket->arts0->s_name; ?></span>
						</li>
						<li>
							<span class="order-field-name"><?php echo Yii::t('content','Author');?>:</span>
							<?php foreach ($basket->arts0->persons0 as $key=>$author): ?>
							<?php echo ($key > 0)?',':''; ?>
							<span class="order-field-value colorRed"><?php echo $author->s_full_name; ?></span>
							<?php endforeach; ?>
						</li>
						<li>
							<span class="order-field-name"><?php echo Yii::t('content','Produced');?>:</span>
							<span class="order-field-value colorRed"><?php echo $basket->arts0->produced; ?></span>
						</li>
						<li>
							<span class="order-field-name"><?php echo Yii::t('content','Size');?>:</span>
							<span class="order-field-value colorRed">
							<?php 
								if ($basket->complement_to !== null)
								{
									$r = Basket::model()->with('arts0')->findByAttributes(array('id'=>$basket->complement_to));
									echo $basket->tag1 . ' cm';// $r->arts0->size_x.'x'.$r->arts0->size_y;
								} else 
									echo $basket->arts0->size_x/10 . ' x ' . $basket->arts0->size_y/10 . ' cm'; 
							?>
							</span>
						</li>
						<li>
							<span class="order-field-name"><?php echo Yii::t('content','Price');?>:</span>
							<span class="order-field-value colorRed">
							<?php
								$c = $basket->arts0->currency;
								if ($basket->complement_to !== null)
								{
									//$r = Basket::model()->with('arts0')->findByAttributes(array('id'=>$basket->complement_to));
									//echo ($r->arts0->size_x + $r->arts0->size_y)*$basket->site_price;
									$size = explode(" x ", $basket->tag1);
									if($basket->arts0->type == 4){
										$price = round((($size[0] + $size[1])*2)/100 * $basket->site_price, 2);
										if ($c_def != $c)
											$price = $basket->arts0->currencies->convertcurrency($c, $c_def, $price);			
										echo $price . ' ' . $c_def;
										$total_price += $price;
									} else {
										$price = round(($size[0] * $size[1])/100000 * $basket->site_price, 2);
										if ($c_def != $c)
											$price = $basket->arts0->currencies->convertcurrency($c, $c_def, $price);			
										echo $price . ' ' . $c_def;
										$total_price += $price;
									}
									//$total_price += ($r->arts0->size_x + $r->arts0->size_y)*$basket->site_price;
								} else {
									if ($c_def != $c)
										$price = $basket->arts0->currencies->convertcurrency($c, $c_def, $basket->site_price);
									else
										$price = $basket->site_price;
									echo $price . ' ' . $c_def;
									$product_price += $price;
									$d = ArtsDiscount::model()->findByAttributes(array('art'=>$basket->art));
									if ($d !== null)
									{
										if ($d->expired < date('Y-m-d',time())){
											$discount = $basket->site_price - $d->new_price;
											if ($c_def != $c)
												$discount = $basket->arts0->currencies->convertcurrency($c, $c_def, $discount);
										}
									} else 
										$discount = 0;
								} 
							?>
							</span>
						</li>
					</ul>
				</div><!-- profile block -->
				<?php endforeach;?>
				<?php 
					if(!$basket_baghet)
						echo '<div class="profile-block">'. 
							 '	<ul class="order-info">'. 
							 '		<li>'.
							 '			<span class="order-field-title">'. Yii::t('content','Baguette art') .'</span>'.
							 '			<span class="colorRed selectFor">'. CHtml::link(Yii::t('content','Select'),array('arts/selectBaguette', 'artId'=>$artId), array('class'=>'colorRed ')) .'</span>'.
							 '		</li>'.
							 '	</ul>'.
							 '</div>';
					
					
					
					if(!$basket_glass)
						echo '<div class="profile-block">'.
						'	<ul class="order-info">'.
						'		<li>'.
						'			<span class="order-field-title">'. Yii::t('content','Protective glass') .'</span>'.
						'			<span class="colorRed selectFor">'. CHtml::link(Yii::t('content','Select'),array('arts/selectBaguette', 'artId'=>$artId), array('class'=>'colorRed ')) .'</span>'.
						'		</li>'.
						'	</ul>'.
						'</div>';
					if(!$basket_paspartu)
						echo '<div class="profile-block">'.
						'	<ul class="order-info">'.
						'		<li>'.
						'			<span class="order-field-title">'. Yii::t('content','Passepartout') .'</span>'.
						'			<span class="colorRed selectFor">'. CHtml::link(Yii::t('content','Select'),array('arts/selectBaguette', 'artId'=>$artId), array('class'=>'colorRed ')) .'</span>'.
						'		</li>'.
						'	</ul>'.
						'</div>';
						
				?>
				<div class="profile-block clear">
					<h2 class="title">Услуга</h2>
					<ul class="order-info">
						<li>
							<span class="order-field-name minus-red"><?php echo Yii::t('content','Decor');?></span><br/>
							<span class="order-field-name"><?php echo Yii::t('content','Price');?>: </span>
							<span class="order-field-value colorRed"><?php echo 0 . ' ' . $c_def; ?></span>
						</li>
						<li>
							<span class="order-field-name minus-red"><?php echo Yii::t('content','Interior selection');?></span><br/>
							<span class="order-field-name"><?php echo Yii::t('content','Price');?>: </span>
							<span class="order-field-value colorRed"><?php echo 0 . ' ' . $c_def; ?></span>
						</li>
						<li>
							<span class="order-field-name minus-red"><?php echo Yii::t('content','Delivery');?></span>
							<span class="colorRed selectFor"><?php echo Yii::t('content','Select');?></span>
							<br/>
							<span class="order-field-name"><?php echo Yii::t('content','By courier');?> </span><br/>
							<?php if (!Yii::app()->user->isGuest):?>
							<span class="order-field-name"><?php echo Yii::t('content','Delivery address');?>: </span>
							<span class="order-field-value colorRed">
							<?php 
								//$d = DeliveryAddress::model()->findAllByAttributes(array('user'=>));
							?>
							</span><br/>
							<?php endif; ?>
							<span class="order-field-name"><?php echo Yii::t('content','Price');?>: </span>
							<span class="order-field-value colorRed"><?php echo 0 . ' ' . $c_def; ?></span>
						</li>
					</ul>
				</div><!-- profile block -->
				<div class="profile-block clear">
					<table class="order-info">
						<tr style="margin-bottom: 10px; ">
							<td class="order-field-name" style="display: table-cell;"><?php echo Yii::t('content','Cost of the goods');?>: </td>
							<td class="order-field-value" ><?php echo $product_price . ' ' . $c_def;?></td>
						</tr>
						<tr style="margin-bottom: 10px; ">
							<td class="order-field-name" style="display: table-cell;"><?php echo Yii::t('content','Cost of services');?>: </td>
							<td class="order-field-value"><?php echo $service_price . ' ' . $c_def;?></td>
						</tr>
						<tr style="margin-bottom: 10px; ">
							<td class="order-field-name" style="display: table-cell;"><?php echo Yii::t('content','Order amount');?>: </td>
							<td class="order-field-value colorRed"><?php echo $total_price+$product_price . ' ' . $c_def;?></td>
						</tr>
						<tr style="margin-bottom: 10px; ">
							<td class="order-field-name"><?php echo Yii::t('content','Discount');?>: </td>
							<td class="order-field-value" style="display: table-cell;"><?php echo $discount . ' ' . $c_def;?></td>
						</tr>
						<tr style="margin-bottom: 10px;">
							<td class="order-field-name" ><?php echo Yii::t('content','Tax');?>: </td>
							<td class="order-field-value" ><?php echo $nalog . ' ' . $c_def; ?></td>
						</tr>
						<tr style="margin-bottom: 10px; ">
							<td class="order-field-name colorRed" ><?php echo Yii::t('content','Total for payable');?>: </td>
							<td class="order-field-value colorRed" ><?php echo $total_price+$product_price+$service_price-$discount+$nalog . ' ' . $c_def;?></td>
						</tr>
					</table>
				</div><!-- profile block -->
			</div>
		</td>
		<td style="width:50%" valign="bottom">
			<div class="cart-user-info">
				<h2 class="title"><?php echo Yii::t('content','Use the contact form and message us');?></h2>
				<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</td>
	</tr>
</table>
<?php endif; ?>