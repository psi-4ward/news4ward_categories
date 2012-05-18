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

$GLOBALS['TL_DCA']['tl_news4ward_categories'] = array
(

	// Config
	'config'   => array
	(
		'dataContainer'                              => 'Table',
		'enableVersioning'                           => true,
		'label'                                      => &$GLOBALS['TL_LANG']['tl_news4ward_categories']['title'],
		'onload_callback'                            => array
		(
			// TODO: implement user/group mounts
			// array('tl_news4ward_categories','getRoot')
		)
	),

	// List
	'list'     => array
	(
		'sorting'           => array
		(
			'mode'                    => 5,
			'fields'                  => array('name'),
			'flag'                    => 1,
			'panelLayout'             => 'search,sort,filter,limit ',
			'icon'                    => 'system/modules/tl_news4ward_categories/html/icon.gif',
		),
		'label'             => array
		(
			'fields'                  => array('name'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations'        => array
		(
			'edit'         => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_news4ward_categories']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
			),
			'copy'         => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_news4ward_categories']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
			),
			'copyChildren' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_news4ward_categories']['copyChildren'],
				'href'                => 'act=paste&amp;mode=copy&amp;childs=1',
				'icon'                => 'copychilds.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();"',
			),
			'delete'       => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_news4ward_categories']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\''.$GLOBALS['TL_LANG']['MSC']['deleteConfirm'].'\')) return false; Backend.getScrollOffset();"',
			),
			'cut'          => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_news4ward_categories']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();"',
			),
			'show'         => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_news4ward_categories']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{name_legend},name,alias'
	),

	// Fields
	'fields'   => array
	(
		'name'  => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_news4ward_categories']['name'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array(
				'mandatory'=> true,
				'maxlength'=> 255,
				'tl_class' => 'w50'
			)
		),

		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_news4ward_categories']['alias'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=> 255, 'doNotCopy'=>true),
			'save_callback'           => array
			(
				array('tl_news4ward_categories','generateAlias')
			)
		),


	)
);

class tl_news4ward_categories extends Backend
{

	/**
	 * Retrieve the root point for taxonomy per user
	 *
	 * @param mixed
	 * @param object
	 * @return string
	 */

	public function getRoot()
	{
		$this->import('BackendUser','User');

		if($this->User->isAdmin || !count($this->User->groups)) {
			return NULL;
		}

		switch($this->User->inherit)
		{
			case 'custom' :
				$pagemounts = (array)$this->User->taxonomymounts;
				return $pagemounts;
				break;

			case 'group'  :
				$pagemounts = array();
				break;

			case 'extend' :
				$pagemounts = (array)$this->User->taxonomymounts;
				break;
		}

		$objField = $this->Database->execute("SELECT taxonomymounts FROM tl_user_group WHERE id IN(".join(",",$this->User->groups).")");

		while($objField->next())
		{
			if($objField->taxonomymounts)
			{
				$pagemounts = array_merge($pagemounts,deserialize($objField->taxonomymounts));
			}
		}

		$GLOBALS['TL_DCA']['tl_news4ward_categories']['list']['sorting']['root'] = array_unique($pagemounts);
		return array_unique($pagemounts);
	}


	/**
	 * Auto-generate an article alias if it has not been set yet
	 *
	 * @param $varValue
	 * @param DataContainer $dc
	 * @throws Exception
	 * @internal param $mixed
	 * @internal param $object
	 * @return string
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		// Generate an alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = standardize($dc->activeRecord->name);
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_news4ward_categories WHERE id=? OR alias=?")
								   ->execute($dc->id, $varValue);

		// Check whether the page alias exists
		if ($objAlias->numRows > 1)
		{
			if (!$autoAlias)
			{
				throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
			}

			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}


}

?>