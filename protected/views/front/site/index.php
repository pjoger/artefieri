<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="categories">
	<div class="categories-container">
		<?php  $list = SuperArtTypes::model()->findAll('hidden=0'); ?>
		<ul class="category-list clear">
			<?php foreach($list as $category): ?>
			<li class="category-item">
				<?php echo CHtml::link('<span>'. mb_convert_case($category->s_title, MB_CASE_UPPER, "UTF-8") .'</span>',
							array(
								"arts/index",
								"cat"=>$category->id,
						)); ?>
			</li>
			<?php endforeach; ?>
		</ul> 
	</div>
	<div class="categories-background"></div>
</div>


<?php 
 Yii::app()->getClientScript()->registerScript('artImageBackground', '
	var hoverInHandler = function() {
		var $this = $(this);
		var link = $this.find("a").attr("href");
		var pos  = link.lastIndexOf("?cat");
		var cat  = link.substr(pos+1);
		$.ajax({
		    url: "'. Yii::app()->createUrl('arts/getRandomArtImage'). '",
			type: "POST",
		    data: (function(){
 		    	return cat;
			})(),	        
		    success: function (data, textStatus) {
//				alert(data);
    			$("div.categories-background").fadeTo("slow", 0.1, function(){
    				$("div.categories-background").css("background-image","url("+data+")").css("background-repeat", "no-repeat no-repeat");
    				$("div.categories-background").css("background-position", "top center");
    				$("div.categories-background").css("background-size", "800px");
    			}).fadeTo("slow",0.5);
			}
		});
	};
	var hoverOutHandler = function() {
    };
	$("li.category-item").hover(hoverInHandler, hoverOutHandler);
', CClientScript::POS_READY);
?>

<?php 
	Yii::app()->getClientScript()->registerScript('contentMainHeight', "
		$(document).ready(function () {
		var new_height = $(window).height() - 140;
		if(new_height > 500){
			$('#content').height(new_height);
			$('.categories').height(new_height);
		}
		$(window).resize(function () {
			new_height = $(window).height() - 140;
			if(new_height > 500){
				$('#content').height(new_height);
				$('.categories').height(new_height);
			}
		});
	});
", CClientScript::POS_READY);
?>
