<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-4 first">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
// 			'title'=>'',
// 			'htmlOptions'=>'menu',
		));
		$this->widget('zii.widgets.CMenu', array(
			'activeCssClass'=>'selected',
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'left-menu'),
			'itemCssClass'=>'item',
			'linkLabelWrapper'=>null,
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<div class="span-20">
	<div id="content">
	
	    <div>
			<?php 
				$_filters = json_decode(Yii::app()->params['filtre'], true);
				$l = isset($_filters['limit']) ? $_filters['limit'] : 120;
			?>	
	    	<div id="inner-right">
	        	<div class="pager-select">
	                <ul class="pager-pages">
	                	<li class="item"><?php echo CHtml::link('<span>1</span>', array($this->uniqueid.'/'.$this->action->Id, 'type'=>'limit', 'value'=>1,  'f' => urlencode(Yii::app()->params['filtre'])), array('class'=> $l==1 ? "selected" : " ") ); ?></li>
	                	<li class="item"><?php echo CHtml::link('<span>10</span>',array($this->uniqueid.'/'.$this->action->Id, 'type'=>'limit', 'value'=>10, 'f' => urlencode(Yii::app()->params['filtre'])), array('class'=> $l==10 ? "selected" : " ")); ?></li>
	                	<li class="item"><?php echo CHtml::link('<span>20</span>',array($this->uniqueid.'/'.$this->action->Id, 'type'=>'limit', 'value'=>20, 'f' => urlencode(Yii::app()->params['filtre'])), array('class'=> $l==20 ? "selected" : " ")); ?></li>
	                	<li class="item"><?php echo CHtml::link('<span>'. Yii::t('general', 'All') .'</span>',array($this->uniqueid.'/'.$this->action->Id,'type'=>'limit', 'value'=>120, 'f' => urlencode(Yii::app()->params['filtre'])), array('class'=> $l==120 ? "selected" : " ")); ?></li>
	                </ul>
	            	<span><?php echo Yii::t('general', 'Display by');?>:</span>
	            </div>
	        </div><!-- inner right -->
	    	<div id="inner-top">
	        	<div class="inner-top-menu">
	            	<ul class="top-menu separator">
	                	<li class="item"><a href="#" title=""><span><?php echo Yii::t('content', 'Author A..Z');?></span></a></li>
	                	<li class="item"><a href="#" title=""><span><?php echo Yii::t('content', 'Art name A..Z');?></span></a></li>
	                	<li class="item"><a href="#" title=""><span><?php echo Yii::t('content', 'Genre');?></span></a></li>
	                	<li class="item"><a href="#" title=""><span><?php echo Yii::t('content', 'Theme');?></span></a></li>
	                	<li class="item"><a href="#" title=""><span><?php echo Yii::t('content', 'The dominant color');?></span></a></li>
	                	<li class="item"><a href="#" title=""><span><?php echo Yii::t('content', 'Price');?></span></a></li>
	                	<li class="item"><a href="#" title=""><span><?php echo Yii::t('content', 'Size');?></span></a></li>
	                </ul> <!-- art types menu -->
	            </div> <!-- art types menu -->
	        	<div class="items_filter">
	                <div id="list_0" class="inner-top-submenu" style="<?php //echo (!isset($_GET) || !isset($_GET['type']) || $_GET['type']=='author')? 'display: block' : 'display: none'; ?>"> <!-- authors filters -->
						<ul class="top-submenu">
	                    	<?php 
	                    		foreach (range('A', 'Z') as $a)
	                    		{
	                    			echo '<li class="item">'. CHtml::ajaxLink(
											'<span>'.$a.'</span>', 
											Yii::app()->createUrl('/persons/LoadPersons'),
											array(
													'type' => 'POST',
													'success' => "js:function(data){
																$('#top-subsubmenu').html(data);
															}",
													'data' => array( 'alfa' => $a)
												)
											). 
										'</li>';
	                    		}
	                    	?>
	                    </ul><!-- alfa literals menu -->
	                    <div id="top-subsubmenu"></div>

	                </div> <!-- alfa literals menu-->
	                <div id="list_1" class="inner-top-submenu" style="<?php //echo isset($_GET)&&isset($_GET['type'])&&($_GET['type']=='art')? 'display: block' : 'display: none'; ?>">
	                    <ul class="top-submenu">
	                    	<?php 
	                    		foreach (range('A', 'Z') as $a)
	                    		{
	                    			$v = isset($_filters['art'])&&($_filters['art']==$a)? ' filter-active' : '';
	                    			echo '<li class="item'. $v .'" >'. CHtml::link('<span>'.$a.'</span>', 
										Yii::app()->createUrl(
											'/arts/index',
											array(
												'type'=>'art',
												'value'=>$a, 
												'f' => urlencode(Yii::app()->params['filtre']))
											)
										). '</li>';
	                    		}
	                    	?>
	                    </ul><!-- alfa literals menu -->
	                </div> <!-- alfa literals menu-->                
		        	<div id="list_2" class="inner-top-submenu" style="<?php //echo isset($_GET)&&isset($_GET['type'])&&($_GET['type']=='gen')? 'display: block' : 'display: none'; ?>"> <!-- genres filter -->
						<?php 
							$items = Genres::model()->menuItems(1);
							$menu = array(
	  							'activeCssClass'=>'selected',
	  							'linkLabelWrapper'=>null, 
	  							'htmlOptions'=>array('class'=>'top-submenu columns'),
	  							'items'=>$items
							);
							$this->widget('zii.widgets.CMenu', $menu);
						?>
		            </div><!-- genres filter -->
		            <div id="list_3" class="inner-top-submenu" style="<?php //echo isset($_GET)&&isset($_GET['type'])&&($_GET['type']=='gen2')? 'display: block' : 'display: none'; ?>"><!-- themes filters -->
						<?php 
							$items = Genres::model()->menuItems(9);
							$menu = array(
	  							'activeCssClass'=>'selected',
	  							'linkLabelWrapper'=>null, 
	  							'htmlOptions'=>array('class'=>'top-submenu columns'),
	  							'items'=>$items
							);
							$this->widget('zii.widgets.CMenu', $menu);
						?>
		            </div> <!-- themes filters -->
		            <div id="list_4" class="inner-top-submenu"  style="<?php //echo isset($_GET)&&isset($_GET['type'])&&($_GET['type']=='color')? 'display: block' : 'display: none'; ?>"> <!-- art colors menu -->
	                    <ul class="top-submenu colors">
	                        <li class="item"><a href="#" title="">
	                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/colors/color_grey.png','grey',array("title" => "grey"));?>
	                        </a></li>
	                        <li class="item"><a href="#" title="">
	                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/colors/color_white.png','white',array("title" => "white"));?>
	                        </a></li>
	                        <li class="item"><a href="#" title="">
	                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/colors/color_black.png','black',array("title" => "black"));?>
	                        </a></li>
	                        <li class="item"><a href="#" title="">
	                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/colors/color_yellow.png','yellow',array("title" => "yellow"));?>
	                        </a></li>
	                        <li class="item"><a href="#" title="">
	                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/colors/color_orange.png','orange',array("title" => "orange"));?>
	                        </a></li>
	                        <li class="item"><a href="#" title="">
	                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/colors/color_red.png','red',array("title" => "red"));?>
	                        </a></li>
	                        <li class="item"><a href="#" title="">
	                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/colors/color_blue.png','blue',array("title" => "blue"));?>
	                        </a></li>
	                        <li class="item"><a href="#" title="">
	                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/colors/color_lightblue.png','lightblue',array("title" => "lightblue"));?>
	                        </a></li>
	                    </ul>
		            </div> <!-- art colors menu -->
		            <div id="list_5" class="inner-top-submenu" style="<?php //echo isset($_GET)&&isset($_GET['type'])&&($_GET['type']=='price')? 'display: block' : 'display: none'; ?>">
	                    <ul class="top-submenu sizes extend">
	                        <li class="item"><a href="#" title=""><span><?php echo Yii::t('content', 'ASC'); ?></span></a></li>
	                        <li class="item"><a href="#" title=""><span><?php echo Yii::t('content', 'DESC'); ?></span></a></li>
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>0 - 500$</span>', Yii::app()->createUrl('/arts/index',array('type'=>'price','value'=>'0-500', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '<div class="updown"><div class="up"></div><div class="down"></div></div></li>';
                        	?>
	                        <?php 
	                        	echo '<li class="item">'; 
	                        	echo CHtml::link('<span>500 - 1000$</span>', Yii::app()->createUrl('/arts/index',array('type'=>'price','value'=>'500-1000', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '<div class="updown"><div class="up"></div><div class="down"></div></div></li>';
	                        ?>
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>1000 - 5000$</span>', Yii::app()->createUrl('/arts/index',array('type'=>'price','value'=>'1000-5000', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '<div class="updown"><div class="up"></div><div class="down"></div></div></li>';
	                        ?>
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>5000 - 10000$</span>', Yii::app()->createUrl('/arts/index',array('type'=>'price','value'=>'5000-10000', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '<div class="updown"><div class="up"></div><div class="down"></div></div></li>';
	                        ?>
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>10000 - 20000$</span>', Yii::app()->createUrl('/arts/index',array('type'=>'price','value'=>'10000-20000', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '<div class="updown"><div class="up"></div><div class="down"></div></div></li>';
	                        ?>
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>'. Yii::t('content', 'More than') .'20000$</span>', Yii::app()->createUrl('/arts/index',array('type'=>'price','value'=>'20000', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '</li>';
	                        ?>
	                   </ul> <!-- art types menu -->
		            </div>
		            <div id="list_6" class="inner-top-submenu" style="<?php //echo isset($_GET)&&isset($_GET['type'])&&($_GET['type']=='size')? 'display: block' : 'display: none'; ?>">
		                <ul class="top-submenu sizes extend">
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>'. Yii::t('content', 'Horizontal') .'</span>', Yii::app()->createUrl('/arts/index',array('type'=>'size','value'=>'horiz', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '</li>';
                        	?>
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>'. Yii::t('content', 'Vertical') .'</span>', Yii::app()->createUrl('/arts/index',array('type'=>'size','value'=>'vert', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '</li>';
                        	?>
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>'. Yii::t('content', 'Small (less than 30x30 cm)') .'</span>', Yii::app()->createUrl('/arts/index',array('type'=>'size','value'=>'small', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '</li>';
                        	?>
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>'. Yii::t('content', 'Medium size (less than 100x100 cm)') .'</span>', Yii::app()->createUrl('/arts/index',array('type'=>'size','value'=>'medium', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '</li>';
                        	?>
	                        <?php 
	                        	echo '<li class="item">';
	                        	echo CHtml::link('<span>'. Yii::t('content', 'Big size (more than 100x100 cm)') .'</span>', Yii::app()->createUrl('/arts/index',array('type'=>'size','value'=>'big', 'f' => urlencode(Yii::app()->params['filtre']))));
	                        	echo '</li>';
                        	?>
	                   </ul> <!-- art types menu -->
		            </div>
				</div>
	        </div><!-- inner top -->
	    </div>
		<?php echo $content; ?>
	</div><!-- content -->
</div>

<?php $this->endContent(); ?>

<script src="<?php echo Yii::app()->request->baseUrl.'/js/jquery.mousewheel.js'; ?>" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl.'/js/jScrollPane.js'; ?>" type="text/javascript"></script>
<?php 
Yii::app()->getClientScript()->registerScript("filterscroll", '
		$(document).ready(function(){
            $("div.inner-top-menu ul.top-menu li a").click(function(event){
                event.preventDefault();
                
                var selected = $(this);
                $("div.items_filter div.inner-top-submenu").hide();
		
				$("div.inner-top-menu ul.top-menu li a").css({color: "#494033"});
				selected.css({color:"#F00"});

				var submenu = $("div.items_filter div#list_"+$("ul.top-menu li").index(selected.parent("li"))); 
                submenu.show();
				if($(submenu).find("ul").hasClass("extend")){
					$("div.items_filter").width(900);
					$(submenu).css({overflow: "visible"});
				} else {
					$("div.items_filter").width("100%");
				}

            });
        });
', CClientScript::POS_READY);

Yii::app()->clientScript->registerCoreScript('jquery'); //if you do not set it yet
$this->widget('ext.EJsScroll.EJsScroll',
		array(
				'selector' => '.inner-top-submenu',
				'showArrowsBar'=>true
		)
);
?>
