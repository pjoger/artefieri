<?php
/**
 * CmsBlock class file.
 * @author Christoffer Niska <christoffer.niska@nordsoftware.com>
 * @copyright Copyright &copy; 2011, Nord Software Ltd
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package cms.widgets
 */

/**
 * Widget that renders the node with the given name.
 */
class GetCurrencyDropdown extends CWidget
{
	/**
	 * @property string the content name.
	 */
	public $reloadgrid=false;
	public $filterzeros = true;
	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$assetsurl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('currencymanager.assets.chosen') );
		Yii::app()->clientScript->registerScriptFile($assetsurl.'/chosen.jquery.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile($assetsurl.'/chosen-init.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerCssFile($assetsurl.'/chosen.css', CClientScript::POS_HEAD);

        //get all active curriencies
        $criteria = new CDbCriteria();
        if($this->filterzeros){
        	$criteria->condition = 'status=:status and conversion_rate>:conversion_rate';
        	$criteria->params = array(':status'=>1,':conversion_rate'=>0);
        }else{
        	$criteria->condition = 'status=:status';
        	$criteria->params = array(':status'=>1);
        }
        $model=CurrencyEx::model()->findAll($criteria);

        $this->render('_select',array('model'=>$model,'reloadgrid'=>$this->reloadgrid));
	}
}
