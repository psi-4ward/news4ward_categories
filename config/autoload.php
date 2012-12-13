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


// Register the namespace
ClassLoader::addNamespace('Psi');

// Register the classes
ClassLoader::addClasses(array
(
	'Psi\News4ward\Module\Categories'   	=> 'system/modules/news4ward_categories/Module/Categories.php',
	'Psi\News4ward\CategoriesHelper'   		=> 'system/modules/news4ward_categories/CategoriesHelper.php',
));

// Register the templates
TemplateLoader::addFiles(array
(
	'mod_news4ward_categories' 					=> 'system/modules/news4ward_categories/templates',
));
