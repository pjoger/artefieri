<?php
/**
 * CDATA Filter
 *
 * Provides tags for block styled elements.
 *
 * @author      Miles Johnson - http://milesj.me
 * @copyright   Copyright 2006-2011, Miles Johnson, Inc.
 * @license     http://opensource.org/licenses/mit-license.php - Licensed under The MIT License
 * @link        http://milesj.me/code/php/decoda
 */

class CdataFilter extends DecodaFilter {

	/**
	 * Supported tags.
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_tags = array(  
		'cdata' => array(
			'tag' => 'cdata',
			'template' => 'cdata',
			'type' => self::TYPE_BLOCK,
			'allowed' => self::TYPE_BOTH,
		),
	);

}