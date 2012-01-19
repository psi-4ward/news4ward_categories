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
$GLOBALS['TL_DCA']['tl_news4ward']['fields']['categories'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_news4ward']['categories'],
	'exclude'                 => true,
	'inputType'               => 'multiColumnWizard',
	'eval'                    => array
	(
		'columnFields' => array
		(
			'category' => array
			(
				'label'     => array('&nbsp;'),
				'inputType' => 'text'
			)
		)
	)
);


// Palette
$GLOBALS['TL_DCA']['tl_news4ward']['palettes']['default'] = str_replace(';{protected_legend',';{categories_legend},categories;{protected_legend',$GLOBALS['TL_DCA']['tl_news4ward']['palettes']['default']);


?>