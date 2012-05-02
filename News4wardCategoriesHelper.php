<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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

class News4wardCategoriesHelper extends Controller
{

	/**
	 * Return the WHERE-condition if a the url has an cat-parameter
	 * @return bool|string
	 */
	public function categoryFilter()
	{
		if(!$this->Input->get('cat')) return false;

		$cat = mysql_real_escape_string(urldecode($this->Input->get('cat')));

		return 'tl_news4ward_article.category="'.$cat.'"';
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
		$objTemplate->categoryHref = $this->generateFrontendUrl($GLOBALS['objPage']->row(),'/cat/'.urlencode($objArticles->category));
	}
}

?>