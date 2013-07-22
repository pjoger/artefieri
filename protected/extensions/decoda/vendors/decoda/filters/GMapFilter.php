<?php
/**
 * MapFilter
 *
 * Provides the tag for GoogleMaps. Only Google Maps services are supported.
 *
 * @author      EndErr - http://www.enderra.net
 * @copyright   Copyright 2006-2011, Miles Johnson, Inc.
 * @license     http://opensource.org/licenses/mit-license.php - Licensed under The MIT License
 * @link        http://www.enderra.net
 */

class GMapFilter extends DecodaFilter {

	/**
	 * Supported tags.
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_tags = array(  
		'gmap' => array(
			'template' => 'gmap',
			'type' => self::TYPE_BLOCK,
			'allowed' => self::TYPE_NONE,
			'attributes' => array(
				'default' => '/[a-zA-Z0-9]+/',
				'size' => '/small|medium|large/i'
			)
		)
	);

	/**
	 * Map formats.
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_formats = array(
		'googlemaps' => array(
			'small' => array(560, 315),
			'medium' => array(640, 360),
			'large' => array(853, 480),
			'path' => '{id}'
		)
	);

	/**
	 * Custom build the HTML for Google Maps.
	 * 
	 * @access public
	 * @param array $tag
	 * @param string $content
	 * @return string
	 */
	public function parse(array $tag, $content) {
		$provider = $tag['attributes']['default'];
		$size = strtolower(isset($tag['attributes']['size']) ? $tag['attributes']['size'] : 'medium');

		if (empty($this->_formats[$provider])) {
			return $provider . ':' . $content;
		}

		$gmap = $this->_formats[$provider];
		$size = isset($gmap[$size]) ? $gmap[$size] : $gmap['medium'];

		$tag['attributes']['width'] = $size[0];
		$tag['attributes']['height'] = $size[1];
		$tag['attributes']['url'] = str_replace(array('{id}', '{width}', '{height}'), array($content, $size[0], $size[1]), $gmap['path']);

		return parent::parse($tag, $content);
	}

}