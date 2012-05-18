-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_news4ward_treecategories`
-- 

CREATE TABLE `tl_news4ward_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0', 
  `alias` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `alias` (`alias`)
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_news4ward_treecategory_article`
-- 

CREATE TABLE `tl_news4ward_category_article` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cid` int(10) unsigned NOT NULL default '0',
  `pid` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


