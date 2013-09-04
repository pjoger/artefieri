<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stil.css" />

<!-- 	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>  -->
<!--    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>  -->

  <link rel="icon" type="image/x-icon" href="/favicon_<?php echo (defined('APP_ENV') && APP_ENV != 'production') ? 'dev' : 'adm'; ?>.ico"/>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">Администратор :: <?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Arts', 'url'=>array('/arts/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Authors', 'url'=>array('/persons/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'CMS', 'url'=>array('/cms/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Orders', 'url'=>array('/deliveryInfo/admin'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Basket', 'url'=>array('/basket/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Discounts', 'url'=>array('/artsDiscount/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'News', 'url'=>array('/news/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Users', 'url'=>array('/users/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Logs', 'url'=>array('/eventsLog/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Translates', 'url'=>array('/site/translates'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Menus', 'url'=>array('/menus/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Currency rates', 'url'=>array('/currency/Updateconversionrate'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by EndErr.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form.min.js" type="text/javascript"></script>
</body>
</html>
