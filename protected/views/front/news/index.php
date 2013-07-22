<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'News',
);

$this->renderPartial('menu/list');//, array('cat'=>isset($cat)?$cat:0,'limit'=>isset($limit)?$limit:0));

?>

        <div id="inner-block">
 			<?php 
				$this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$dataProvider,
					'itemView'=>'_view',
					'htmlOptions'=>array('class'=>'events'),
					'ajaxUpdate'=>false,
					'emptyText'=>Yii::t('general', 'In this category there are no records.'),
					'summaryText'=>"",
					'pager'=>array(
							'class'=>'MyPager',
					),
				)); 
			?>
				<div class="clear"></div>
				<div class="event">
					<!-- <div class="event-image"><img src="images/event1.jpg" alt="" /></div> -->
           				<p>Agere intendimus paralyticus audi meae ceroma fronte comico hac navi quia illum vero rex cum. Introivit gubernum defunctam sed eu fugiens laudo misera Tharsia, postera eius est cum autem nobiscum. Perlecto tota tumet paucis horum patre. Nunc intuens clita hic ait mea Stet consequat Apolloni codicellos aperiri sacras. Mariae maximas hanc nec 'pectore zaetam at eius. Potentiam sum cum magna aliter diligo alii paupertas quantitas devenit potest flens ibidem quod eam est amet constanter determinatio vestes. Mutilena aliquam laetandum prudentia qualia nutrix. Apertius ingens ad te in rei exultant deo adiuves finem imponunt hoc contra te finis puellam. Pater unica suae forsitan dolor Jesus Circumdat. Mea in modo cavendum es, centum eum filiam in fuerat. Sic vero cum autem quod tamen cursu.</p>
            			<p>Agere intendimus paralyticus audi meae ceroma fronte comico hac navi quia illum vero rex cum. Introivit gubernum defunctam sed eu fugiens laudo misera Tharsia, postera eius est cum autem nobiscum. Perlecto tota tumet paucis horum patre. Nunc intuens clita hic ait mea Stet consequat Apolloni codicellos aperiri sacras. Mariae maximas hanc nec 'pectore zaetam at eius. Potentiam sum cum magna aliter diligo alii paupertas quantitas devenit potest flens ibidem quod eam est amet constanter determinatio vestes. Mutilena aliquam laetandum prudentia qualia nutrix. Apertius ingens ad te in rei exultant deo adiuves finem imponunt hoc contra te finis puellam. Pater unica suae forsitan dolor Jesus Circumdat. Mea in modo cavendum es, centum eum filiam in fuerat. Sic vero cum autem quod tamen cursu.</p>
            			<p>Agere intendimus paralyticus audi meae ceroma fronte comico hac navi quia illum vero rex cum. Introivit gubernum defunctam sed eu fugiens laudo misera Tharsia, postera eius est cum autem nobiscum. Perlecto tota tumet paucis horum patre. Nunc intuens clita hic ait mea Stet consequat Apolloni codicellos aperiri sacras. Mariae maximas hanc nec 'pectore zaetam at eius. Potentiam sum cum magna aliter diligo alii paupertas quantitas devenit potest flens ibidem quod eam est amet constanter determinatio vestes. Mutilena aliquam laetandum prudentia qualia nutrix. Apertius ingens ad te in rei exultant deo adiuves finem imponunt hoc contra te finis puellam. Pater unica suae forsitan dolor Jesus Circumdat. Mea in modo cavendum es, centum eum filiam in fuerat. Sic vero cum autem quod tamen cursu.</p>
					</div>
            </div>

