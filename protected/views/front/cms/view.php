<?php
/* @var $this CmsController */
/* @var $model Cms */

$this->pageTitle=Yii::app()->name . ' - '. $model->_display_title;
$this->breadcrumbs=array(
	$model->_display_title,
);

Yii::app()->clientScript->registerMetaTag($model->s_meta_title, 'title');
Yii::app()->clientScript->registerMetaTag($model->s_meta_keywords, 'keywords');
Yii::app()->clientScript->registerMetaTag($model->s_meta_descr, 'description');

?>

<div id="content" class="clear wrapper">
    <div id="inner-content">
        <div id="inner-block">
        	<div class="inner-title">
                <h1><?php echo $model->_display_title; ?></h1>
            </div><!-- title -->
            <div class="clear"></div>
        	<div class="article">
        		<?php echo $model->_display_html; ?>
            </div><!-- article -->
            
            <?php /* 
            <div class="clear"></div>
            <div class="float-right" style="text-align:right;">
            	<?php 
            		if ($model->user)
            			echo '<i>' . $model->user0->s_full_name . '</i><br/>';
            		echo $model->added; 
            	?>
            </div> 
             */ ?>
            
    </div>
</div> <!-- end content -->
</div>