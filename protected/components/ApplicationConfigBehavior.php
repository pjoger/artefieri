<?php
 
/**
 * ApplicationConfigBehavior is a behavior for the application.
 * It loads additional config paramenters that cannot be statically 
 * written in config/main
 */
class ApplicationConfigBehavior extends CBehavior
{
    /**
     * Declares events and the event handler methods
     * See yii documentation on behaviour
     */
    public function events()
    {
        return array_merge(parent::events(), array(
            'onBeginRequest'=>'beginRequest',
        ));
    }
 
    /**
     * Load configuration that cannot be put in config/main
     */
    public function beginRequest()
    {
		if ($this->owner->user){
	    	if ($this->owner->user->getState('lang'))
	            $this->owner->language=$this->owner->user->getState('lang');
        	else 
            	$this->owner->language='ru';
		} else if (Yii::app()->request->cookies['lang']) {
			$this->owner->language=Yii::app()->request->cookies['lang'];
		} else 
			$this->owner->language='ru';
    }
}