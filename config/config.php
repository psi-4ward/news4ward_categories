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


// FE-Modules
$GLOBALS['FE_MOD']['news4ward']['news4wardCategories'] = '\News4ward\Module\Categories';

// News4wardList Filter HOOK
$GLOBALS['TL_HOOKS']['News4wardListFilter'][] = array('\News4ward\CategoriesHelper','categoryFilter');

// News4wardParseArticle HOOK
$GLOBALS['TL_HOOKS']['News4wardParseArticle'][] = array('\News4ward\CategoriesHelper','categoryParseArticle');
