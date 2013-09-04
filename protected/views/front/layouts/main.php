<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />  -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />

  <link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="wrapper clear" id="page">

	<div id="header" class="wrapper">
	    <div id="header-right">
	    	<div id="kontakt">
	        	<span><?php /*echo Yii::t('general', 'Phone');?>: +7 495 555 44 33 */?><br/>
	            <?php echo CHtml::mailto(Yii::t('general', 'e-Mail').': mail@artefieri.com','mail@artefieri.com'); ?></span>
	        </div> <!-- end kontakt -->
<?php /* ?>
<!-- 	        <div id="menusearch"> -->
	            <div id="search">
	                <div>
	                    <form action="<?php echo Yii::app()->createUrl('arts/search');?>" method="get">
	                        <div class="searchbox">
	                            <button class="search-magnifier" type="submit" value="Search"></button>
	                            <input  class="searchfield" type="text" onfocus="if(this.value=='<?php echo Yii::t('general', 'Search');?> ...') this.value='';" onblur="if(this.value=='') this.value='<?php echo Yii::t('general', 'Search');?> ...';" value="<?php echo Yii::t('general', 'Search');?> ..." size="20" alt="<?php echo Yii::t('general', 'Search');?>" maxlength="255" name="searchword" autocomplete="off">
	                        </div>
	                        <input type="hidden" name="task" value="search">
	                    </form>	<!-- search form -->
	                </div>
	            </div> <!-- end search --> <?php
*/ ?>
				<div id="secondmenu">
					<?php $this->widget('zii.widgets.CMenu',array(
							'htmlOptions'=>array('class'=>'menu'),
							'items'=>array(
								array(
										'label'=>Yii::t('menu', 'For visitors'),
										'itemOptions'=>array('class'=>'item arrow-down menu-title'),
										'linkOptions'=>array('class'=>'submenu'),
										'encodeLabel' => false,
										'items'=>array(
												array('label'=>Yii::t('menu', 'About us'), 'url'=>array('/cms/view', 'id'=>2),'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'Partners'), 'url'=>array('/cms/view', 'id'=>3),'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'How to buy'), 'url'=>array('/cms/view', 'id'=>4),'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'Payment \ Requisites'), 'url'=>array('/cms/view', 'id'=>5),'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'Basket'), 'url'=>array('/deliveryInfo/viewCart'),'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'Cabinet'), 'url'=>array('/site/login'),'visible'=>Yii::app()->user->isGuest,'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'Register'), 'url'=>array('/users/view'),'visible'=>Yii::app()->user->isGuest,'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'Cabinet'), 'url'=>array('/users/view'),'visible'=>!Yii::app()->user->isGuest,'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'Logout'), 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest,'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'Send message'), 'url'=>array('/site/feedback'),'itemOptions'=>array('class'=>'item'),'itemOptions'=>array('class'=>'item')),
												array('label'=>Yii::t('menu', 'Contacts'), 'url'=>array('/cms/view', 'id'=>6),'itemOptions'=>array('class'=>'item')),
										)
								),
								array(
									'label'=>Yii::t('menu', 'For partners'),
									'itemOptions'=>array('class'=>'item arrow-down menu-title'),
									'linkOptions'=>array('class'=>'submenu'),
									'items'=>array(
											array('label'=>Yii::t('menu', 'Sell own works'), 'url'=>array('/cms/view', 'id'=>8),'itemOptions'=>array('class'=>'item')),
											array('label'=>Yii::t('menu', 'Sale at auction'), 'url'=>array('/cms/view', 'id'=>9),'itemOptions'=>array('class'=>'item')),
											array('label'=>Yii::t('menu', 'Shipping and freight'), 'url'=>array('/cms/view', 'id'=>10),'itemOptions'=>array('class'=>'item')),
											array('label'=>Yii::t('menu', 'Framing'), 'url'=>array('/cms/view', 'id'=>11),'itemOptions'=>array('class'=>'item')),
											array('label'=>Yii::t('menu', 'Recovery'), 'url'=>array('/cms/view', 'id'=>12),'itemOptions'=>array('class'=>'item')),
											array('label'=>Yii::t('menu', 'Cost estimate'), 'url'=>array('/cms/view', 'id'=>13),'itemOptions'=>array('class'=>'item')),
											array('label'=>Yii::t('menu', 'Interior Consultancy'), 'url'=>array('/cms/view', 'id'=>14),'itemOptions'=>array('class'=>'item')),
											array('label'=>Yii::t('menu', 'Rent of exhibition halls'), 'url'=>array('/cms/view', 'id'=>16),'itemOptions'=>array('class'=>'item')),
											array('label'=>Yii::t('menu', 'Promoting authors'), 'url'=>array('/cms/view', 'id'=>17),'itemOptions'=>array('class'=>'item')),
									)
								),
							),
					)); ?>
	                <div class="searchbox">
	                    <form action="<?php echo Yii::app()->createUrl('arts/search');?>" method="get">
	                        <div>
	                            <button class="search-magnifier" type="submit" value="Search"></button>
<?php
/*<!--	                            <input  class="searchfield" type="text" onfocus="if(this.value=='<?php echo Yii::t('general', 'Search');?> ...') this.value='';" onblur="if(this.value=='') this.value='<?php echo Yii::t('general', 'Search');?> ...';" value="<?php echo Yii::t('general', 'Search');?> ..." size="20" alt="<?php echo Yii::t('general', 'Search');?>" maxlength="255" name="searchword" autocomplete="off">--> */
?>
	                            <input  class="searchfield" type="text" placeholder="<?php echo Yii::t('general', 'Search');?>" size="20" alt="<?php echo Yii::t('general', 'Search');?>" maxlength="255" name="searchword">
	                        </div>
	                        <input type="hidden" name="task" value="search">
	                    </form>	<!-- search form -->
	                </div>

            </div> <!-- end second menu -->
	        <!--</div> --> <!-- end second menu & search block -->
	        <div class="clear"></div>
	        <div id="settings">
	        	<div id="lang-block">
	            	<a href="#" title="" class="menu-title" style="color:#cccccc; cursor:default;"><?php echo Yii::t('menu', 'Language');?></a>
	                <div class="submenu">
						<?php
//							$this->widget('application.components.LangBox');
						?>
	               </div> <!-- language menu -->
	            </div> <!-- end language -->
	            <div id="currency-block">
	            	<a href="#" title="" class="menu-title"><span onmouseover=""><?php echo Yii::t('menu', 'Currency');?></span></a>
	                <div class="submenu">
						<?php
							$this->widget('application.components.CurrencyBox');
						?>
					</div> <!-- language menu -->
	            </div> <!-- end currency -->
	        </div> <!-- end language and currency selector -->
	    </div><!-- header right -->
		<div id="header-left">
			<div id="mainmenu">
				<?php $this->widget('zii.widgets.CMenu',array(
					'activeCssClass'=>'selected',
					'htmlOptions'=>array('class'=>'menu'),
						'items'=>array(
							array('label'=>Yii::t('menu', 'Home'), 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'item')),
							array('label'=>Yii::t('menu', 'Gallery'), 'url'=>array('/arts/index'),'itemOptions'=>array('class'=>'item')),
							array('label'=>Yii::t('menu', 'Authors'), 'url'=>array('/persons/index'),'itemOptions'=>array('class'=>'item')),
							array('label'=>Yii::t('menu', 'Events'), 'url'=>array('/news/index'),'itemOptions'=>array('class'=>'item')),
						),
				)); ?>
			</div> <!-- end mainmenu -->
		</div> <!-- end header-left -->
		<div id="logo">
			<div id="logo2"> <a href="<?php echo Yii::app()->createUrl('/site/index'); ?>" title="Artefieri" class="logo" ></a> </div>
		</div><!-- end logo -->
	</div> <!-- end header -->

			<?php echo $content; ?>

	<div id="footer">
	</div><!-- footer -->

</div><!-- page -->
<?php
//this checks id the controller action is not 'login' then it keeps the current url in returnUrl
if(CController::getAction()->id!='login' && CController::getAction()->id!='remindPassword')
{
    Yii::app()->user->setReturnUrl(Yii::app()->request->getUrl());

}
Yii::app()->getClientScript()->registerScript("submitmenu", "
	$(document).ready(function(){
		$('.menu-title').click(function(){
			var v = $(this).find('ul').css('display');
			$('.menu-title ul').hide(500);
			if(v!='block')
				$(this).find('ul').show();
			var v = $(this).next('.submenu').css('display');
			$('.menu-title').next('.submenu').hide(500);
			if(v!='block')
				$(this).next('.submenu').show();
		});
		$('.menu-title ul').mouseleave(function(){
			$('.menu-title ul').hide(500);
		});
		$('.menu-title').next('.submenu').mouseleave(function(){
			$('.menu-title').next('.submenu').hide(500);
		});
	});
", CClientScript::POS_READY);
Yii::app()->getClientScript()->registerScript('filters', '
    $(document).ready(function(){
            $("ul.top-menu li a").click(function(event){
                event.preventDefault();
                var selected = $(this);
                $("div.items_filter div.inner-top-bottom, div.items_filter div.inner-top-menu").hide(500);
                $("div.items_filter div#list_"+$("ul.top-menu li").index(selected.parent("li"))).show();
            });
        });
', CClientScript::POS_READY);
?>

</body>
</html>
