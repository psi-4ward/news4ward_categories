-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

--
-- Table `tl_news4ward_article`
--

CREATE TABLE `tl_news4ward` (
  `categories` blob NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table `tl_news4ward_article`
--

CREATE TABLE `tl_news4ward_article` (
  `category` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
