<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2010,2011 Tristan Lins
 *
 * Extension for:
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 * 
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Avisota
 * @license    LGPL
 * @filesource
 */



/**
 * Table tl_avisota_translation
 */
$GLOBALS['TL_DCA']['tl_avisota_translation'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Memory',
		'closed'                      => true,
		'onload_callback'             => array
		(
			array('tl_avisota_translation', 'onload_callback'),
		),
		'onsubmit_callback'           => array
		(
			array('tl_avisota_translation', 'onsubmit_callback'),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{translation_legend}'
	),
	
	// Fields
	'fields' => array()
);

class tl_avisota_translation extends Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
	
	/**
	 * Build the palette and field list.
	 */
	public function buildFields()
	{
		foreach ($GLOBALS['TL_LANG']['avisota'] as $k=>$v)
		{
			$this->_buildFields($k, $v);
		}
	}
	
	
	/**
	 * Recursive function.
	 * 
	 * @param string $k
	 * @param mixed $v
	 */
	protected function _buildFields($k, $v)
	{
		if (is_array($v))
		{
			if (strpos($k, '__') === false)
			{
				$GLOBALS['TL_DCA']['tl_avisota_translation']['palettes']['default'] .= ';{' . $k . '_legend}';
			}
			foreach ($v as $kk=>$vv)
			{
				$this->_buildFields($k . '__' . $kk, $vv, $dc);
			}
		}
		else
		{
			$GLOBALS['TL_DCA']['tl_avisota_translation']['palettes']['default'] .= ',' . $k;
			
			switch ($k)
			{
			case 'subscribe__mail__html':
			case 'unsubscribe__mail__html':
				$GLOBALS['TL_DCA']['tl_avisota_translation']['fields'][$k] = array
				(
					'label'                   => &$GLOBALS['TL_LANG']['tl_avisota_translation'][$k],
					'inputType'               => 'textarea',
					'eval'                    => array('rte'=>'tinyNews', 'allowHtml'=>true)
				);
				break;
				
			case 'subscribe__mail__plain':
			case 'unsubscribe__mail__plain':
				$GLOBALS['TL_DCA']['tl_avisota_translation']['fields'][$k] = array
				(
					'label'                   => &$GLOBALS['TL_LANG']['tl_avisota_translation'][$k],
					'inputType'               => 'textarea',
					'eval'                    => array('allowHtml'=>true)
				);
				break;
				
			default:
				$GLOBALS['TL_DCA']['tl_avisota_translation']['fields'][$k] = array
				(
					'label'                   => &$GLOBALS['TL_LANG']['tl_avisota_translation'][$k],
					'inputType'               => 'text',
					'eval'                    => array('tl_class'=>'long', 'allowHtml'=>true)
				);
			}
		}
	}
	
	
	/**
	 * Load translations.
	 * 
	 * @param DataContainer $dc
	 */
	public function onload_callback(DataContainer $dc)
	{
		foreach ($GLOBALS['TL_LANG']['avisota'] as $k=>$v)
		{
			$this->setData($k, $v, $dc);
		}
	}
	
	
	/**
	 * Save translations.
	 * 
	 * @param DataContainer $dc
	 */
	public function onsubmit_callback(DataContainer $dc)
	{
		$objFile = new File('system/config/langconfig.php');
		
		$strContent = '';
		$arrLines = $objFile->getContentAsArray();
		
		$n = preg_match('/^\?>/', $arrLines[count($arrLines)-1]) ? count($arrLines)-1 : count($arrLines);
		
		for ($i=0; $i<$n; $i++)
		{
			if (preg_match('/^### AVISOTA TRANSLATIONS ' . $GLOBALS['TL_LANGUAGE'] . ' START ###/', $arrLines[$i]))
			{
				for (; $i<$n; $i++)
				{
					if (preg_match('/^### AVISOTA TRANSLATIONS ' . $GLOBALS['TL_LANGUAGE'] . ' STOP ###/', $arrLines[$i]))
					{
						break;
					}
				}
			}
			else
			{
				$strContent .= $arrLines[$i] . "\n";
			}
		}
		
		$strContent .= $this->generateTranslationLines($dc);
		$strContent .= '?>';
		
		$objFile->write($strContent);
	}
	
	
	/**
	 * Set the field values.
	 * 
	 * @param unknown_type $k
	 * @param unknown_type $v
	 * @param DataContainer $dc
	 */
	protected function setData($k, $v, DataContainer $dc)
	{
		if (is_array($v))
		{
			foreach ($v as $kk=>$vv)
			{
				$this->setData($k . '__' . $kk, $vv, $dc);
			}
		}
		else
		{
			$dc->setData($k, $v);
		}
	}

	
	/**
	 * Generate the new translations php code.
	 * 
	 * @param DataContainer $dc
	 * @return string
	 */
	protected function generateTranslationLines(DataContainer $dc)
	{
		$strBuffer  = "### AVISOTA TRANSLATIONS $GLOBALS[TL_LANGUAGE] START ###\n";
		$strBuffer .= "if (\$GLOBALS['TL_LANGUAGE'] == '$GLOBALS[TL_LANGUAGE]')\n";
		$strBuffer .= "{\n";
		foreach ($GLOBALS['TL_LANG']['avisota'] as $k=>$v)
		{
			$strBuffer .= $this->getData($k, $v, $dc, sprintf("['%s']", $k));
		}
		$strBuffer .= "}\n";
		$strBuffer .= "### AVISOTA TRANSLATIONS $GLOBALS[TL_LANGUAGE] STOP ###\n";
		return $strBuffer;
	}
	
	
	/**
	 * Get the php code.
	 * 
	 * @param string $k
	 * @param mixed $v
	 * @param DataContainer $dc
	 * @param string $strPath
	 * @return string
	 */
	protected function getData($k, $v, DataContainer $dc, $strPath)
	{
		$strBuffer = '';
		if (is_array($v))
		{
			foreach ($v as $kk=>$vv)
			{
				$strBuffer .= $this->getData($k . '__' . $kk, $vv, $dc, sprintf("%s['%s']", $strPath, $kk));
			}
		}
		else
		{
			$strBuffer .= sprintf("\t\$GLOBALS['TL_LANG']['avisota']%s = '%s';\n", $strPath, str_replace(array('\\', "'"), array('\\\\', "\\'"), $dc->getData($k)));
		}
		return $strBuffer;
	}
}

$this->loadLanguageFile('avisota');
$this->import('tl_avisota_translation');
$this->tl_avisota_translation->buildFields();

?>