<?php
$c_def = Yii::app()->cookie->getCurrency();
if (isset($delivery))
foreach ($delivery as $d){
?>
<div class="profile-block">
	<ul class="order-info">
		<li>
			<span class="order-field-name"><?php echo Yii::t('content', 'Order #'); ?></span>
			<span class="order-field-value"><?php echo $d->id.' ('.$d->added.')'; ?></span>
		</li>
		<?php 
			$c = Yii::app()->cookie->getCurrency(); 
			foreach ($d->baskets as $b){
				echo '<li><span class="order-field-name">'.Yii::t('content', 'Price').':</span>'
					.'<span class="order-field-value">'
					.$b->arts0->s_name.' ';

				$c = $b->currency;
				if ($c_def != $c)
					$v = $b->currencies->convertcurrency($c, $c_def, $b->site_price);
				else
					$v = $b->site_price;
				
				
				//$v = Yii::app()->getModule('currencymanager')->convertcurrency($c,$b->site_price);
				echo $v.' '.$c_def;
				//echo $b->site_price.$b->arts0->currencies->id;
				echo '</span></li>';
			}
		?>
		<li><span class="order-field-name"><?php echo Yii::t('content', 'Delivery'); ?>: </span><span class="order-field-value">-</span></li>
		<li><span class="order-field-name"><?php echo Yii::t('content', 'Decor'); ?>: </span><span class="order-field-value">-</span></li>
		<li><span class="order-field-name"><?php echo Yii::t('content', 'Interior selection'); ?>: </span><span class="order-field-value">-</span></li>
		<li>
			<span class="order-field-name order-total"><?php echo Yii::t('content', 'Order amount'); ?></span>
			<span class="order-field-value order-total"># <?php echo $d->id; ?>:</span>
			<span class="order-field-value order-total">
			<?php 
				$c = $d->_order_currency->id;
				if ($c_def != $c)
					$v = $d->_order_currency->convertcurrency($c, $c_def, $d->_order_price);
				else
					$v = $d->_order_price;
				
				//echo Yii::app()->getModule('currencymanager')->convertcurrency($c,$d->_order_price).' '.$c; 
				echo $v.' '.$c_def;
			?>
			</span>
		</li>
	</ul>
</div><!-- profile block -->
<?php } ?>
<?php 
    Yii::app()->getClientScript()->registerScript(
		'bindCarusel','
			var pH = $(".kabinet-profile").height();
			$(".kabinet-orders").css("height",pH);
		',CClientScript::POS_READY
	);
?>
			