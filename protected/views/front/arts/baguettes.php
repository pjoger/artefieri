<?php
/* @var $this ArtsController */
/* @var $model Arts */

$this->breadcrumbs=array(
	'Arts'=>array('index'),
	'Manage',
);

$this->layout = '//layouts/column1';

?>

<?php
    Yii::app()->getClientScript()->registerScript(
		'bindCarusel',
		'
	$(document).ready(function(){

		var index = 0;
		var index2 = 0;
		var count = 8;
		var count2 = 13;
		var to_class  = ".baghet-items-1";
		var to_class2 = ".baghet-paspartu-1";

		$(".baghet-items-1").show();
		$(".baghet-items-1 li").hide();
		$(".baghet-items-1 li").slice(index, index+count).css("display", "inline-block");

		$(".baghet-paspartu-1").show();
		$(".baghet-paspartu-1 li").hide();
		$(".baghet-paspartu-1 li").slice(index2, index2+count2).css("display", "inline-block");

		$("div.baghet-menu li.item a").click(function(event){
			event.preventDefault();
			index = 0;
			to_class_id = $(this).parent().attr("id");
			to_class = ".baghet-items-"+to_class_id.substr(to_class_id.length - 1);
			$("div.baghet-menu li.item").removeClass("baghet-menu-active");
			$(this).addClass("baghet-menu-active");
			$("div.baghet-items ul").hide();
			$(to_class).fadeIn(100);
			$(to_class + " li").hide();
			$(to_class + " li").slice(index, index+count).css("display", "inline-block");
		});

		$(".baghet-nav-left").click(function(event){
			//event.preventDefault();
			index -=count;
			if(index < 0) index = 0;
			$(".baghet-items-"+to_class.substr(to_class.length - 1)+" li").hide();
			$(".baghet-items-"+to_class.substr(to_class.length - 1)+" li").slice(index, index+count).css("display", "inline-block");
		});

		$(".baghet-nav-right").click(function(event){
			//event.preventDefault();
			var previousIndex = index;
			index +=count;
			if(index >= $("."+to_class+" li").length){
				index = previousIndex;
			}
			$(".baghet-items-"+to_class.substr(to_class.length - 1)+" li").hide();
			$(".baghet-items-"+to_class.substr(to_class.length - 1)+" li").slice(index, index+count).css("display", "inline-block");
		});

		$(".baghet-nav-left2").click(function(event){
			index2 -=count2;
			if(index2 < 0) index2 = 0;
			$(".baghet-paspartu-"+to_class2.substr(to_class2.length - 1)+" li").hide();
			$(".baghet-paspartu-"+to_class2.substr(to_class2.length - 1)+" li").slice(index2, index2+count2).css("display", "inline-block");
		});

		$(".baghet-nav-right2").click(function(event){
			var previousIndex = index2;
			index2 +=count2;
			if(index2 >= $("."+to_class2+" li").length){
				index2 = previousIndex;
			}
			$(".baghet-paspartu-"+to_class2.substr(to_class2.length - 1)+" li").hide();
			$(".baghet-paspartu-"+to_class2.substr(to_class2.length - 1)+" li").slice(index2, index2+count2).css("display", "inline-block");
		});

		$("div.baghet-items li a").click(function(event){
			event.preventDefault();
			var name = $(this).attr("title");
			var price = $(this).siblings("input[name=\"baghet_price\"]").val();
			$("#baghet_art_site_price").val(price);
			price = ((( parseFloat( $("#baghet_SizeWidth").val() ) + parseFloat( $("#baghet_SizeHeight").val() ) )*2)/100 * price).toFixed(2);
			$("#baghet_art_id").val($(this).siblings("input[name=\"baghet_id\"]").val());
			$("#baghet_artName").text(name);
			$("#baghet_art_price").val(price);
			$("#baghet_artPrice").text(price);
			$("div.baghet-items li").removeClass("active");
			$(this).parent().addClass("active");
			setTotalPrice();
		});

		$("div.baghet-glass li a").click(function(event){
			event.preventDefault();
			var name  = $(this).attr("title");
			var price = $(this).siblings("input[name=\"glass_price\"]").val();
			$("#baghet_glass_site_price").val(price);
			$("#baghet_glass_id").val($(this).siblings("input[name=\"glass_id\"]").val());
			$("#baghet_glassName").text(name);
			price = ((parseFloat($("#baghet_SizeWidth").val())*parseFloat($("#baghet_SizeHeight").val()))/10000 * price).toFixed(2);
			$("#baghet_glass_price").val(price);
			$("#baghet_glassPrice").text(price);
			$("div.baghet-glass li").removeClass("active");
			$(this).parent().addClass("active");
			setTotalPrice();
		});

		$("div.baghet-paspartu li a").click(function(event){
			event.preventDefault();
			var name = $(this).attr("title");
			var price = $(this).siblings("input[name=\"paspartu_price\"]").val();
			$("#baghet_paspartu_site_price").val(price);
			$("#baghet_paspartu_id").val($(this).siblings("input[name=\"paspartu_id\"]").val());
			$("#baghet_paspartuName").text(name);
			price = ((parseFloat($("#baghet_SizeWidth").val())*parseFloat($("#baghet_SizeHeight").val()))/10000 * price).toFixed(2);
			$("#baghet_paspartu_price").val(price);
			$("#baghet_paspartuPrice").text(price);
			$("div.baghet-paspartu li").removeClass("active");
			$(this).parent().addClass("active");
			setTotalPrice();
		});

		$("#baghet_SizeWidth, #baghet_SizeHeight").change(function() {
			var ov = parseFloat($("#baghet_art_sizex").val());
			var nv = parseFloat($("#baghet_SizeWidth").val());
			if (nv == 0 || nv < ov)
				$("#baghet_SizeWidth").val(ov);
			ov = parseFloat($("#baghet_art_sizey").val());
			nv = parseFloat($("#baghet_SizeHeight").val());
			if (nv == 0 || nv < ov)
				$("#baghet_SizeHeight").val(ov);
			var sX = parseInt($("#baghet_SizeWidth").val());
			var sY = parseInt($("#baghet_SizeHeight").val());

			// baghet new price
			var aP = parseFloat($("#baghet_art_site_price").val());
			var new_price = (((sX + sY)*2)/100 * aP).toFixed(2);
			$("#baghet_art_price").val(new_price);
			$("#baghet_artPrice").text(new_price);

			// glass new price
			aP = parseFloat($("#baghet_glass_site_price").val());
			new_price = ((sX * sY)/10000 * aP).toFixed(2);
			$("#baghet_glass_price").val(new_price);
			$("#baghet_glassPrice").text(new_price);

			// paspartu new price
			aP = parseFloat($("#baghet_paspartu_site_price").val());
			new_price = ((sX * sY)/10000 * aP).toFixed(2);
			$("#baghet_paspartu_price").val(new_price);
			$("#baghet_paspartuPrice").text(new_price);

			setTotalPrice();
		});

		function setTotalPrice(){
			var tP = (parseFloat($("#baghet_art_price").val()) + parseFloat($("#baghet_glass_price").val()) + parseFloat($("#baghet_paspartu_price").val())).toFixed(2);
			$("#baghet_totalPrice").text(tP);
			$("#baghet_total_price").val(tP);
		}

// 		$("#submitBaghetForm").submit(function() {
// 			if(parseFloat($("#baghet_total_price").val()) == 0){
// 				return false;
// 			}
// 		});

	});
',
		CClientScript::POS_READY
	);

    $c_def = Yii::app()->cookie->getCurrency();

?>
<h1 class="title"><?php echo Yii::t('content', 'Framing'); ?></h1>

<div class="clear"></div>
<div class="baghet">
	<div class="baghet-block clear">
		<h2><?php echo Yii::t('content', 'Material baguette'); ?></h2>
		<div class="baghet-menu clear">
			<ul>
				<li class="item baghet-menu-active" id="baghet-menu-1"><a href="#" title=""><span><?php echo Yii::t('content', 'Wood'); ?></span></a></li>
				<li class="item" id="baghet-menu-2"><a href="#" title=""><span><?php echo Yii::t('content', 'Glass'); ?></span></a></li>
				<li class="item" id="baghet-menu-3"><a href="#" title=""><span><?php echo Yii::t('content', 'Plastic'); ?></span></a></li>
				<li class="item" id="baghet-menu-4"><a href="#" title=""><span><?php echo Yii::t('content', 'Metal'); ?></span></a></li>
				<li class="item" id="baghet-menu-5"><a href="#" title=""><span><?php echo Yii::t('content', 'Other'); ?></span></a></li>
			</ul>
		</div> <!-- BAGHET MATERIALS -->
		<div class="baghet-items wide clear">
			<div class="baghet-nav-left"></div>
			<ul class="baghet-items-1">
			<?php
				$baghet_selected = Basket::model()->with(
					array(
						'arts0.currencies'=>array(
							'select'=>false,
							'joinType'=>'INNER JOIN',
							'condition'=>'arts0.type=4',
						)
					))->findByAttributes(array('complement_to'=>$basket->id, 'sid'=>Yii::app()->cookie->getSID()));
				foreach ($baguette as $baghet):
					$c = $baghet->currency;
					if ($c_def != $c)
						$v = $baghet->currencies->convertcurrency($c, $c_def, $baghet->site_price);
					else
						$v = $baghet->site_price;
					echo '<li class="item ';
					echo (isset($baghet_selected) && ($baghet->id == $baghet_selected->art))?'active':'';
					echo '"><a href="#" title="'.$baghet->s_name.'">';
					if ($baghet->cover){
						echo CHtml::image($baghet->_image_file,
								$baghet->s_name,
								array("title" => $baghet->s_name));
					}
					echo '</a>';
					echo '<input type="hidden" name="baghet_id" value="'.$baghet->id.'">';
					echo '<input type="hidden" name="baghet_price" value="'.$v.'">';
					echo '<input type="hidden" name="baghet_size_x" value="'. $baghet->size_x/10 .'">';
					echo '<input type="hidden" name="baghet_size_y" value="'. $baghet->size_y/10 .'">';
					echo '</li>';
				endforeach; ?>
			</ul>
			<ul class="baghet-items-2" style="display:none">
			<?php
				foreach ($baguette as $baghet):
					$c = $baghet->currency;
					if ($c_def != $c)
						$v = $baghet->currencies->convertcurrency($c, $c_def, $baghet->site_price);
					else
						$v = $baghet->site_price;
					echo '<li class="item"><a href="#" title="'.$baghet->s_name.'">';
					if ($baghet->cover){
						echo CHtml::image($baghet->_image_file,
								$baghet->s_name,
								array("title" => $baghet->s_name));
					}
					echo '</a>';
					echo '<input type="hidden" name="baghet_id" value="'.$baghet->id.'">';
					echo '<input type="hidden" name="baghet_price" value="'.$v.'">';
					echo '<input type="hidden" name="baghet_size_x" value="'. $baghet->size_x/10 .'">';
					echo '<input type="hidden" name="baghet_size_y" value="'. $baghet->size_y/10 .'">';
					echo '</li>';
				endforeach; ?>
			</ul>
			<div class="baghet-nav-right"></div>
		</div> <!-- BAGHET MATERIAL IMAGE -->
	</div><!-- BAGHET MATERIAL -->
	<div class="baghet-block clear">
		<h2><?php echo Yii::t('content','Protective glass'); ?></h2>
		<div class="baghet-glass">
			<ul class="baghet-glass-1">
			<?php
				$glass_selected = Basket::model()->with(
					array(
						'arts0'=>array(
							'select'=>false,
							'joinType'=>'INNER JOIN',
							'condition'=>'arts0.type=6',
						)
					))->findByAttributes(array('complement_to'=>$basket->id, 'sid'=>Yii::app()->cookie->getSID()));
				foreach ($steklo as $glass):
					$c = $glass->currency;
					if ($c_def != $c)
						$v = $glass->currencies->convertcurrency($c, $c_def, $glass->site_price);
					else
						$v = $glass->site_price;
					echo '<li class="item ';
					echo (isset($glass_selected) && ($glass->id == $glass_selected->art))?'active':'';
					echo '">';
					echo '<a href="#" title="'.$glass->s_name.'" >'.$glass->s_name.'</a>';
					echo '<input type="hidden" name="glass_id" value="'.$glass->id.'">';
					echo '<input type="hidden" name="glass_price" value="'.$v.'">';
					echo '<input type="hidden" name="glass_size_x" value="'. $glass->size_x/10 .'">';
					echo '<input type="hidden" name="glass_size_y" value="'. $glass->size_y/10 .'">';
					echo '</li>';
				endforeach; ?>
			</ul><!-- PROTECTION GLASS -->
		</div>
		<div class="clear"></div>
	</div><!-- PROTECTION GLASS -->
	<div class="baghet-block clear">
		<h2><?php echo Yii::t('content','Passepartout'); ?></h2>
		<div class="baghet-paspartu tiny">
			<div class="baghet-nav-left2"></div>
			<ul class="baghet-paspartu-1">
			<?php
				$paspartu_selected = Basket::model()->with(
					array(
						'arts0'=>array(
							'select'=>false,
							'joinType'=>'INNER JOIN',
							'condition'=>'arts0.type=5',
						)
					))->findByAttributes(array('complement_to'=>$basket->id, 'sid'=>Yii::app()->cookie->getSID()));
				foreach ($paspartu as $paspartu):
					$c = $paspartu->currency;
					if ($c_def != $c)
						$v = $paspartu->currencies->convertcurrency($c, $c_def, $paspartu->site_price);
					else
						$v = $paspartu->site_price;
					echo '<li class="item ';
					echo (isset($paspartu_selected) && ($paspartu->id == $paspartu_selected->art))?'active':'';
					echo '"><a href="#" title="'.$paspartu->s_name.'">';
					if ($paspartu->cover){
						echo CHtml::image($paspartu->_image_file,
								$paspartu->s_name,
								array("title" => $paspartu->s_name));
					}
					echo '</a>';
					echo '<input type="hidden" name="paspartu_id" value="'.$paspartu->id.'">';
					echo '<input type="hidden" name="paspartu_price" value="'.$v.'">';
					echo '<input type="hidden" name="paspartu_size_x" value="'. $paspartu->size_x/10 .'">';
					echo '<input type="hidden" name="paspartu_size_y" value="'. $paspartu->size_y/10 .'">';
					echo '</li>';
				endforeach;
			?>
			</ul>
			<div class="baghet-nav-right2"></div>
		</div> <!-- BAGHET PASPARTU IMAGE -->
		<div class="clear"></div>
	</div><!-- BAGHET PASPARTU -->

	<div class="baghet-block clear">
		<div class="link" style="margin-top:20px">
			<a href="#" title=""><span><?php echo Yii::t('content','Select Paint');?></span></a>
		</div>
		<div class="baghet-details floatleft">
			<div class="baghet-params">
				<form action="../basket/addBaghets" method="post" id="submitBaghetForm">
				<div class="baghet-size clear">
					<h2><?php echo Yii::t('content', 'Baguette size'); ?> *</h2>
					<table>
						<tr>
							<?php
								if ($basket->tag1 !== null || $basket->tag1 != '')
									$size = explode(" x ", $basket->tag1);
								else
									$size=array("0"=>($art->size_x)/10, "1" => ($art->size_y)/10);

							?>
							<td>
								<input type="text"   id="baghet_SizeWidth" name="baghet[SizeWidth]" value="<?php echo $size[0];  //echo $art->size_x/10; ?>" />
								<input type="hidden" name="baghet[art_sizex]" id="baghet_art_sizex" value="<?php echo $size[0]; //echo $art->size_x/10; ?>"/>
							</td>
							<td><span>x</span></td>
							<td>
								<input type="text" id="baghet_SizeHeight" name="baghet[SizeHeight]" value="<?php echo $size[1]; ?>" />
								<input type="hidden" name="baghet[art_sizey]" id="baghet_art_sizey" value="<?php echo $size[1]; ?>" />
							</td>
							<td><span><?php echo Yii::t('content', 'cm');?></span></td>
						</tr>
						<tr>
							<td><span><?php echo Yii::t('content', 'W');?></span></td>
							<td><span>x</span></td>
							<td><span><?php echo Yii::t('content', 'H');?></span></td>
							<td><span><?php echo Yii::t('content', 'cm');?></span></td>
						</tr>
					</table>
				</div>
				<div class="baghet-prices clear">
					<ul>
						<li>
							<span><?php echo Yii::t('content', 'Baguette art');?>: </span>
							<span id="baghet_artName"><?php echo isset($baghet_selected)?$baghet_selected->arts0->s_name : ''; ?></span>
							<input type="hidden" name="baghet[art_id]" id="baghet_art_id" value="<?php echo isset($baghet_selected)?$baghet_selected->art : ''; ?>">
						</li>
						<li>
							<span><?php echo Yii::t('content', 'The cost of a baguette');?>: </span>
							<?php
								if (isset($baghet_selected)){
									$b_price = round(($size[0] + $size[1])*2/100*$baghet_selected->arts0->site_price,2);
									$c = $baghet_selected->arts0->currency;
									if ($c_def != $c)
										$b_price = $baghet_selected->arts0->currencies->convertcurrency($c, $c_def, $b_price);
								} else {
									$b_price = 0;
								}
							?>
							<span id="baghet_artPrice"><?php echo $b_price;?></span> <span><?php echo $c_def;?></span>
							<input type="hidden" name="baghet[art_price]" id="baghet_art_price" value="<?php echo $b_price;?>">
							<input type="hidden" name="baghet[art_site_price]" id="baghet_art_site_price" value="<?php echo isset($baghet_selected)?$baghet_selected->arts0->site_price : '0'; ?>">
						</li>
						<li style="display: none;" id="error_baghet"><span class="active"><?php echo Yii::t('content', 'Baguette not selected!');?></span></li>
					</ul>
					<ul>
						<li>
							<span><?php echo Yii::t('content', 'Glass art');?>: </span>
							<span id="baghet_glassName"><?php echo isset($glass_selected)?$glass_selected->arts0->s_name : ''; ?></span>
							<input type="hidden" name="baghet[glass_id]" id="baghet_glass_id" value="<?php echo isset($glass_selected)?$glass_selected->art : ''; ?>">
						</li>
						<li>
							<span><?php echo Yii::t('content', 'The cost of a baguette');?>: </span>
							<?php
								if (isset($glass_selected)){
									$s_price = round(($size[0] * $size[1])/10000*$glass_selected->arts0->site_price, 2);
									$c = $glass_selected->arts0->currency;
									if ($c_def != $c)
										$s_price = $glass_selected->arts0->currencies->convertcurrency($c, $c_def, $s_price);
								} else {
									$s_price = 0;
								}
							?>
							<span id="baghet_glassPrice"><?php echo $s_price;?></span> <span><?php echo $c_def;?></span>
							<input type="hidden" name="baghet[glass_price]" id="baghet_glass_price" value="<?php echo $s_price;?>">
							<input type="hidden" name="baghet[glass_site_price]" id="baghet_glass_site_price" value="<?php echo isset($glass_selected)?$glass_selected->arts0->site_price : '0'; ?>">
						</li>
						<li style="display: none;" id="error_glass"><span class="active"><?php echo Yii::t('content', 'Glass not selected!');?></span></li>
					</ul>
					<ul>
						<li>
							<span><?php echo Yii::t('content', 'Passepartout art');?>: </span>
							<span id="baghet_paspartuName"><?php echo isset($paspartu_selected)?$paspartu_selected->arts0->s_name : ''; ?></span>
							<input type="hidden" name="baghet[paspartu_id]" id="baghet_paspartu_id" value="<?php echo isset($paspartu_selected)?$paspartu_selected->art : ''; ?>">
						</li>
						<li>
							<span><?php echo Yii::t('content', 'The cost of a baguette');?>: </span>
							<?php
								if (isset($paspartu_selected)){
									$p_price = round(($size[0] * $size[1])/10000*$paspartu_selected->arts0->site_price,2);
									$c = $paspartu_selected->arts0->currency;
									if ($c_def != $c)
										$p_price = $paspartu_selected->arts0->currencies->convertcurrency($c, $c_def, $p_price);
								} else {
									$p_price = 0;
								}
							?>
							<span id="baghet_paspartuPrice"><?php echo $p_price;?></span> <span><?php echo $c_def;?></span>
							<input type="hidden" name="baghet[paspartu_price]" id="baghet_paspartu_price" value="<?php echo $p_price;?>">
							<input type="hidden" name="baghet[paspartu_site_price]" id="baghet_paspartu_site_price" value="<?php echo isset($paspartu_selected)?$paspartu_selected->arts0->site_price : ''; ?>">
						</li>
						<li style="display: none;" id="error_paspartu"><span class="active"><?php echo Yii::t('content', 'Passepartout not selected!');?></span></li>
					</ul>
					<ul>
						<li class="colorRed">
							<span><?php echo Yii::t('content', 'The cost of decor');?>:</span>
							<span id="baghet_totalPrice"><?php echo $b_price+$s_price+$p_price; ?></span> <span><?php echo $c_def;?></span>
							<input type="hidden" name="baghet[total_price]" id="baghet_total_price" value="<?php echo $b_price+$s_price+$p_price; ?>">
						</li>
					</ul>
				</div>
				<div class="baghet-order clear">
					<input type="hidden" name="artId" value="<?php echo $art->id; ?>" />
					<div class="link "><input type="submit" value="<?php echo Yii::t('content', 'Buy');?>" class="order-cart"></div>
					<div class="link"><a href="#" title=""><span><?php echo Yii::t('general', 'To gallery');?></span></a></div>
					<div><span><?php echo Yii::t('content', '* - Internal size baguette frame');?></span></div>
				</div>
				</form>
			</div>
			<div class="baghet-result">
				<div class="baghet-border">
					<?php
						if ($art->cover){
							echo CHtml::image($art->_covers['600x'],
									$art->s_name,
									array("title" => $art->s_name, "class" => "baghet-image"));
						}
					?>
<!-- <img class="baghet-image" src="images/baghet-image-1.png" alt="Baghet Image Result" /> -->
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div><!-- BAGHET DETAILS -->
</div><!-- baghet -->
