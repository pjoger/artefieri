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
				<?php echo CHtml::link('<span>'. $category->s_title .'</span>',
							array(
								"arts/index",
								"cat"=>$category->id
							),
							array(
								//"mousehover" => "alert('hello')",
								"name" => "catback_".$category->id
							)
						);
          /* $cover = Arts::model()->GetLastCover($category->id);
					if ($cover){
						echo '<div class="categories-background" style="background-image: url(\''.$cover.'\');"></div>';
					}
					*/
        ?>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php
			foreach($list as $category){
				$cover = Arts::model()->GetLastCover($category->id);
				if ($cover){
					echo '<div id="catback_'.$category->id.'" class="categories-background" style="background-image: url(\''.$cover.'\');"></div>';
				}
			}
		?>
	</div>
	<!-- <div class="categories-background"></div> -->
</div>


<?php

 Yii::app()->getClientScript()->registerScript('artImageBackground', '
	var CurVisible;
	var hoverInHandler = function() {
		var $this = $(this);
		var cat = $(this).attr("name");
		if (CurVisible && CurVisible.attr("id") != cat){
			CurVisible.hide(0);
		}
		CurVisible = $("#"+cat);
		$("#"+cat).stop().fadeTo("slow", 0.3, function(){
		});
	};
	var hoverOutHandler = function() {
		if (CurVisible){
			CurVisible.stop().fadeOut({
				duration: 100,
				queue: false,
			});
		}
	};
	$("li.category-item a").hover(hoverInHandler, hoverOutHandler);
', CClientScript::POS_READY);

?>

<?php
/*
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
*/
?>
