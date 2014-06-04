<?php

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

namespace Psi\News4ward\Module;

class Categories extends Module
{
    /**
   	 * Template
   	 * @var string
   	 */
   	protected $strTemplate = 'mod_news4ward_categories';


    /**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### News4ward Categories ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		$this->news_archives = $this->sortOutProtected(deserialize($this->news4ward_archives));

		// Return if there are no archives
		if (!is_array($this->news_archives) || count($this->news_archives) < 1)
		{
			return '';
		}

		$strBuffer = parent::generate();

		if (count($this->Template->categories) == 0)
		{
			return '';
		}

		return $strBuffer;
	}


	/**
	 * Generate module
	 */
	protected function compile()
    {
		$objCats = $this->Database->execute('SELECT category, count(id) as quantity FROM tl_news4ward_article
		                                     WHERE tl_news4ward_article.pid IN ('.implode(',',$this->news_archives).') AND category <> ""
                                                     GROUP BY category
                                                     ORDER BY category ASC');

		// just return if on empty result
		if(!$objCats->numRows)
		{
			$this->Template->categories = array();
			return;
		}

		// get jumpTo page
		if($this->jumpTo)
		{
			$objJumpTo = $this->Database->prepare('SELECT id,alias FROM tl_page WHERE id=?')->execute($this->jumpTo);
			if(!$objJumpTo->numRows)
				$objJumpTo = $GLOBALS['objPage'];
		}
		else
		{
			$objJumpTo = $GLOBALS['objPage'];
		}

		$arrCats = array();
		while($objCats->next())
		{
			$arr = $objCats->row();
			$arr['href'] = $this->generateFrontendUrl($objJumpTo->row(),'/cat/'.urlencode($objCats->category));
			$arr['active'] = ($this->Input->get('cat') == $objCats->category);
			
			// don’t show quantity if it is not enabled			
			if(!$this->news4ward_showQuantity)
			{
				$arr['quantity'] = false;
			}

			// set active item for the active filter hinting
			if($this->Input->get('cat') == $objCats->category)
			{
				if(!isset($GLOBALS['news4ward_filter_hint']))
				{
					$GLOBALS['news4ward_filter_hint'] = array();
				}

				$GLOBALS['news4ward_filter_hint']['category'] = array
				(
					'hint'  	=> $this->news4ward_filterHint,
					'value'		=> $objCats->category
				);
			}
			$arrCats[] = $arr;
		}

		$this->Template->categories = $arrCats;
	}


}
