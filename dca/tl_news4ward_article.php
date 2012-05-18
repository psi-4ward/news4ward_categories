<?php if(!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * News4ward
 * a contentelement driven news/blog-system
 *
 * @author Christoph Wiechert <wio@psitrax.de>
 * @copyright 4ward.media GbR <http://www.4wardmedia.de>
 * @package news4ward_categories
 * @filesource
 * @licence LGPL
 */

// Field
$GLOBALS['TL_DCA']['tl_news4ward_article']['fields']['categories'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_news4ward_article']['categories'],
	'inputType'               => 'tableTree',
	'exclude'                 => true,
	'foreignTable'			  => 'tl_news4ward_category_article.cid',
	'save_callback'        	  => array(array('DCAHelper','saveToForeignTable')),
	'load_callback'        	  => array(array('DCAHelper','loadFromForeignTable')),
	'eval'      			  => array
	(
		'fieldType' => 'checkbox',
		'tableColumn'=> 'tl_news4ward_categories.name',
		'title'=> $GLOBALS['TL_LANG']['tl_news4ward_article']['categories'][0],
		'icon'=> 'system/modules/tl_news4ward_categories/html/icon.gif',
		'children' => true,
		'childrenOnly'=> false,
		'doNotSaveEmpty' => true
	),

);


// Palette
$GLOBALS['TL_DCA']['tl_news4ward_article']['palettes']['default'] = str_replace('{layout_legend}','{categories_legend},categories;{layout_legend}',$GLOBALS['TL_DCA']['tl_news4ward_article']['palettes']['default']);
