<?php if(!defined('TL_ROOT')) {die('You cannot access this file directly!'); }

/**
 * @copyright 4ward.media 2012 <http://www.4wardmedia.de>
 * @author Christoph Wiechert <wio@psitrax.de>
 */

array_insert($GLOBALS['TL_DCA']['tl_news4ward']['list']['global_operations'],0, array
(
	'categories' => array
	(
		'label'               => &$GLOBALS['TL_LANG']['tl_news4ward']['categories'],
		'href'                => 'table=tl_news4ward_categories',
		'class'               => 'header_edit_all',
		'attributes'          => 'onclick="Backend.getScrollOffset();" style="background-image:url(system/modules/news4ward_categories/html/icon.gif)"'
	)
));