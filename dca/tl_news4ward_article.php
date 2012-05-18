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
$GLOBALS['TL_DCA']['tl_news4ward_article']['fields']['category'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_news4ward_article']['category'],
	'inputType'               => 'select',
	'exclude'                 => true,
	'options_callback'        => array('tl_news4ward_categories','getCategories'),
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50')
);


// Palette
$GLOBALS['TL_DCA']['tl_news4ward_article']['palettes']['default'] = str_replace(',alias,',',alias,category,',$GLOBALS['TL_DCA']['tl_news4ward_article']['palettes']['default']);

/**
 * Class tl_news4ward_categories
 * Helperclass to receive the categories defined in a news4ward-archive
 */
class tl_news4ward_categories extends System
{

	/**
	 * Fetch all categories for the current archive
	 * @param Data_Container $dc
	 * @return array
	 */
	public function getCategories($dc)
	{
		$this->import('Database');
		$arrCategories = array();
		$categories = $this->Database->prepare('SELECT categories FROM tl_news4ward WHERE id=?')->execute($dc->activeRecord->pid);
		$categories = deserialize($categories->categories,true);
		foreach($categories as $v)
		{
			$arrCategories[] = $v['category'];
		}
		return $arrCategories;
	}
}
?>