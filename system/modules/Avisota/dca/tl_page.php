<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

#copyright


/**
 * Table tl_page
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['avisota'] = '{title_legend},title,alias,type;{redirect_legend},jumpBack;{protected_legend:hide},protected;{cache_legend:hide},includeCache;{chmod_legend:hide},includeChmod;{expert_legend:hide},guests;{publish_legend},published,start,stop';

$GLOBALS['TL_DCA']['tl_page']['fields']['jumpBack'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['jumpBack'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'eval'                    => array('fieldType'=>'radio')
);

class tl_page_avisota extends tl_page
{
	public function alterDataContainer($strName)
	{
		if ($strName == 'tl_page')
		{
			$GLOBALS['TL_DCA']['tl_page']['config']['onsubmit_callback'][] = array('tl_page_avisota', 'onSubmit');
			$GLOBALS['TL_DCA']['tl_page']['list']['sorting']['paste_button_callback'] = array('tl_page_avisota', 'pastePage');
			$GLOBALS['TL_DCA']['tl_page']['list']['label']['label_callback'] = array('tl_page_avisota', 'addIcon');
			$GLOBALS['TL_DCA']['tl_page']['fields']['sitemap']['save_callback'][] = array('tl_page_avisota', 'sitemapCallback');
			$GLOBALS['TL_DCA']['tl_page']['fields']['hide']['save_callback'][] = array('tl_page_avisota', 'hideCallback');
			$GLOBALS['TL_DCA']['tl_page']['fields']['menu_visibility']['save_callback'][] = array('tl_page_avisota', 'sitemapCallback');
		}
	}
	
	public function sitemapCallback($varValue, DataContainer $dc)
	{
		if (!$dc->activeRecord)
		{
			$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")->execute($dc->id);
			if ($objPage->next() && $objPage->type == 'avisota')
			{
				return 'map_never';
			}
		}
		else if ($dc->activeRecord->type == 'avisota')
		{
			return 'map_never';
		}
		return $varValue;
	}
	
	public function hideCallback($varValue, DataContainer $dc)
	{
		if (!$dc->activeRecord)
		{
			$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")->execute($dc->id);
			if ($objPage->next() && $objPage->type == 'avisota')
			{
				return '1';
			}
		}
		else if ($dc->activeRecord->type == 'avisota')
		{
			return '1';
		}
		return $varValue;
	}
	
	public function onSubmit(DataContainer $dc)
	{
		if ($dc->activeRecord->type == 'avisota')
		{
			// note: menu_visibility is a xNavigation field, this is a quick hack
			$this->Database->prepare("UPDATE tl_page
					SET
						sitemap='map_never',
						hide=1
						" . ($this->Database->fieldExists('menu_visibility', 'tl_page') ? ", menu_visibility='map_never'" : "") . "
					WHERE id=?")
				->execute($dc->id);
		}
	}
	
	
	public function pastePage(DataContainer $dc, $row, $table, $cr, $arrClipboard=false)
	{
		if ($row['type'] == 'avisota')
		{
			$disablePA = false;
	
			// Disable all buttons if there is a circular reference
			if ($arrClipboard !== false && ($arrClipboard['mode'] == 'cut' && ($cr == 1 || $arrClipboard['id'] == $row['id']) || $arrClipboard['mode'] == 'cutAll' && ($cr == 1 || in_array($row['id'], $arrClipboard['id']))))
			{
				$disablePA = true;
			}
	
			// Check permissions if the user is not an administrator
			if (!$this->User->isAdmin)
			{
				$objPage = $this->Database->prepare("SELECT * FROM " . $table . " WHERE id=?")
										  ->limit(1)
										  ->execute($row['pid']);
	
				// Disable "paste after" button if there is no permission 2 for the parent page
				if (!$disablePA && $objPage->numRows)
				{
					if (!$this->User->isAllowed(2, $objPage->row()))
					{
						$disablePA = true;
					}
				}
	
				// Disable "paste after" button if the parent page is a root page and the user is not an administrator
				if (!$disablePA && ($row['pid'] < 1 || in_array($row['id'], $dc->rootIds)))
				{
					$disablePA = true;
				}
			}
	
			// Return the buttons
			$imagePasteAfter = $this->generateImage('pasteafter.gif', sprintf($GLOBALS['TL_LANG'][$table]['pasteafter'][1], $row['id']), 'class="blink"');
	
			if ($row['id'] > 0)
			{
				return $disablePA ? $this->generateImage('pasteafter_.gif', '', 'class="blink"').' ' : '<a href="'.$this->addToUrl('act='.$arrClipboard['mode'].'&amp;mode=1&amp;pid='.$row['id'].(!is_array($arrClipboard['id']) ? '&amp;id='.$arrClipboard['id'] : '')).'" title="'.specialchars(sprintf($GLOBALS['TL_LANG'][$table]['pasteafter'][1], $row['id'])).'" onclick="Backend.getScrollOffset();">'.$imagePasteAfter.'</a> ' . $this->generateImage('pasteinto_.gif', '', 'class="blink"');
			}
	
			return '';
		}
		return parent::pastePage($dc, $row, $table, $cr, $arrClipboard);
	}
	
	
	public function addIcon($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false)
	{
		if ($row['type'] == 'avisota')
		{
			$sub = 0;
			$image = 'system/modules/Avisota/html/page.png';
	
			// Page not published or not active
			if ((!$row['published'] || $row['start'] && $row['start'] > time() || $row['stop'] && $row['stop'] < time()))
			{
				$sub += 1;
			}
	
			// Page protected
			if ($row['protected'] && !in_array($row['type'], array('root', 'error_403', 'error_404')))
			{
				$sub += 2;
			}
	
			// Get image name
			if ($sub > 0)
			{
				$image = 'system/modules/Avisota/html/page_'.$sub.'.png';
			}
				
			// Return the image only
			if ($blnReturnImage)
			{
				return $this->generateImage($image, '', $imageAttribute);
			}

			// Return image
			return $this->generateImage($image, '', $imageAttribute).' '.$label;
		}
		return parent::addIcon($row, $label, $dc, $imageAttribute, $blnReturnImage);
	}
}

// add hook
$GLOBALS['TL_HOOKS']['loadDataContainer'][] = array('tl_page_avisota', 'alterDataContainer');

?>
