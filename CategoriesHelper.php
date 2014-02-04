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


namespace Psi\News4ward;

class CategoriesHelper extends \Controller
{

	protected static $arrJumpTo = array();

	/**
	 * Return the WHERE-condition if a the url has an cat-parameter
	 * @return bool|string
	 */
	public function categoryFilter()
	{
		if(!$this->Input->get('cat')) return false;

		$cat = urldecode($this->Input->get('cat'));

		return array
		(
			'where'  => 'tl_news4ward_article.category=?',
			'values' => array($cat)
		);
	}


	/**
	 * Add category link to the template
	 *
	 * @param Object $obj
	 * @param Database_Result $objArticles
	 * @param FrontendTemplate $objTemplate
	 */
	public function categoryParseArticle($obj,$objArticles,$objTemplate)
	{
		if(!isset(self::$arrJumpTo[$objArticles->pid]))
		{
			$this->import('Database');
			$objJumpTo = $this->Database->prepare('SELECT tl_page.id, tl_page.alias
													FROM tl_page
													LEFT JOIN tl_news4ward ON (tl_page.id=tl_news4ward.jumpToList)
													WHERE tl_news4ward.id=?')
								->execute($objArticles->pid);
			if($objJumpTo->numRows)
			{
				self::$arrJumpTo[$objArticles->pid] = $objJumpTo->row();
			}
			else
			{
				self::$arrJumpTo[$objArticles->pid] = false;
			}
		}

		if(self::$arrJumpTo[$objArticles->pid])
		{
			$objTemplate->categoryHref = $this->generateFrontendUrl(self::$arrJumpTo[$objArticles->pid],'/cat/'.urlencode($objArticles->category));
		}
		else
		{
			$objTemplate->categoryHref = $this->generateFrontendUrl($GLOBALS['objPage']->row(),'/cat/'.urlencode($objArticles->category));
		}
	}
}

?>