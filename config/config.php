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


// Add Table to news4ward
$GLOBALS['BE_MOD']['content']['news4ward']['tables'][] = 'tl_news4ward_categories';

// FE-Modules
$GLOBALS['FE_MOD']['news4ward']['news4wardCategories'] = 'ModuleNews4wardCategories';

// News4wardList Filter HOOK
$GLOBALS['TL_HOOKS']['News4wardListFilter'][] = array('News4wardCategoriesHelper','categoryFilter');

// News4wardParseArticle HOOK
$GLOBALS['TL_HOOKS']['News4wardParseArticle'][] = array('News4wardCategoriesHelper','categoryParseArticle');

?>