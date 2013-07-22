<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
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
	                	<li class="item"><?php echo CHtml::link('<span>10</span>',array($this->uniqueid.'/'.$this->action->Id, 'type'=>'limit', 'value'=>10, 'f' => urlencode(Yii::app()->params['filtre'])), array('class'=> $l==10 ? "selected" : " ") ); ?></li>
	                	<li class="item"><?php echo CHtml::link('<span>20</span>',array($this->uniqueid.'/'.$this->action->Id, 'type'=>'limit', 'value'=>20, 'f' => urlencode(Yii::app()->params['filtre'])), array('class'=> $l==20 ? "selected" : " ") ); ?></li>
	                	<li class="item"><?php echo CHtml::link('<span>'. Yii::t('general', 'All') .'</span>',array($this->uniqueid.'/'.$this->action->Id,'type'=>'limit', 'value'=>120, 'f' => urlencode(Yii::app()->params['filtre'])), array('class'=> $l==120 ? "selected" : " ") ); ?></li>
	                </ul>
	            	<span><?php echo Yii::t('general', 'Display by'); ?>:</span>
	            </div>
	        </div><!-- inner right -->
	
	    	<div id="inner-top" class="width100p">
	        	<div class="items_filter">
	                <div id="list_0" class="inner-top-submenu" style="display: block">
	                    <ul class="top-menu">
	                    	<?php 
	                    		foreach (range('A', 'Z') as $a)
	                    		{
	                    			echo '<li class="item">'. CHtml::link('<span>'.$a.'</span>', Yii::app()->createUrl('/arts/index',array('type'=>'author','value'=>$a, 'f' => urlencode(Yii::app()->params['filtre'])))). '</li>';
	                    		}
	                    	?>
	                    </ul><!-- alfa literals menu -->
	                </div> <!-- alfa literals menu-->
				</div>
	        </div><!-- inner top -->
	    </div>
		<?php echo $content; ?>
	</div><!-- content -->
<?php $this->endContent(); ?>
