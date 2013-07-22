<?php
class CurrencyBox extends CWidget
{
    public function run()
    {
        $currentCurrency = Yii::app()->request->cookies['currency'];
        $this->render('currencyBox', array('currentCurrency' => $currentCurrency));
    }
}
?>