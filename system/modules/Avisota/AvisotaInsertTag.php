<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
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
 * @copyright  InfinitySoft 2010
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Avisota
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @filesource
 */


/**
 * Class AvisotaInsertTag
 *
 * InsertTag hook class.
 * @copyright  InfinitySoft 2010
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Avisota
 */
class AvisotaInsertTag extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
		$this->import('DomainLink');
		$this->import('AvisotaBase', 'Base');
	}
	
	
	public function replaceNewsletterInsertTags($strTag)
	{
		$strTag = explode('::', $strTag);
		switch ($strTag[0])
		{
		case 'recipient':
			$arrCurrentRecipient = Avisota::getCurrentRecipient();
		
			if ($arrCurrentRecipient)
			{
				switch ($strTag[1])
				{
				case 'salutation':
					if (isset($GLOBALS['TL_LANG']['tl_avisota_newsletter']['salutation_' . $arrCurrentRecipient['gender']]))
					{
						return $GLOBALS['TL_LANG']['tl_avisota_newsletter']['salutation_' . $arrCurrentRecipient['gender']];
					}
					else
					{
						return $GLOBALS['TL_LANG']['tl_avisota_newsletter']['salutation'];
					}
					
				case 'name':
					if (isset($arrCurrentRecipient['name']) && $arrCurrentRecipient['name'])
					{
						return $arrCurrentRecipient['name'];
					}
					else
					{
						return trim($arrCurrentRecipient['firstname'] . ' ' . $arrCurrentRecipient['lastname']);
					}
					
				default:
					if ($arrCurrentRecipient && isset($arrCurrentRecipient[$strTag[1]]))
					{
						return $arrCurrentRecipient[$strTag[1]];
					}
				}
			}
			return '';
			
		case 'newsletter':
			$arrCurrentRecipient = Avisota::getCurrentRecipient();
			$objCategory = Avisota::getCurrentCategory();
			$objNewsletter = Avisota::getCurrentNewsletter();
			
			if ($arrCurrentRecipient && $objCategory && $objNewsletter)
			{
				switch ($strTag[1])
				{
				case 'href':
					$objPage = $this->Base->getViewOnlinePage($objCategory, $arrCurrentRecipient);
					if ($objPage)
					{
						return $this->Base->extendURL($this->generateFrontendUrl($objPage->row(), '/item/' . ($objNewsletter->alias ? $objNewsletter->alias : $objNewsletter->id)), $objPage);
					}
					break;
					
				case 'unsubscribe':
				case 'unsubscribe_url':
					$strAlias = false;
					if (preg_match('#^list:(\d+)$#', $arrCurrentRecipient['outbox_source'], $arrMatch))
					{
						if ($arrMatch[1] > 0)
						{
							$objRecipientList = $this->Database->prepare("
									SELECT
										*
									FROM
										`tl_avisota_recipient_list`
									WHERE
										`id`=?")
								->execute($arrMatch[1]);
							if (!$objRecipientList->next())
							{
								return;
							}
							$strAlias = $objRecipientList->alias;
							$objPage = $this->getPageDetails($objRecipientList->subscriptionPage);
						}
					}

					if ($objCategory->subscriptionPage > 0)
					{
						$objPage = $this->getPageDetails($objCategory->subscriptionPage);
					}
					
					if ($objPage)
					{
						$strUrl = $this->Base->extendURL($this->generateFrontendUrl($objPage->row()) . '?' . ($arrCurrentRecipient['email'] ? 'email=' . $arrCurrentRecipient['email'] : '') . ($strAlias ? '&unsubscribetoken=' . $strAlias : ''));
					}
					else
					{
						$strUrl = $this->Base->extendURL('?' . ($arrCurrentRecipient['email'] ? 'email=' . $arrCurrentRecipient['email'] : '') . ($strAlias ? '&unsubscribetoken=' . $strAlias : ''));
					}
						
					if ($strTag[1] == 'unsubscribe_url')
					{
						return $strUrl;
					}
					
					switch ($strTag[2])
					{
					case 'html':
						return sprintf('<a href="%s">%s</a>', $strUrl, $GLOBALS['TL_LANG']['tl_avisota_newsletter']['unsubscribe']);
						
					case 'plain':
						return sprintf("%s\n[%s]", $GLOBALS['TL_LANG']['tl_avisota_newsletter']['unsubscribe'], $strUrl);
					}
					break;
				}
			}
			return '';
			
		case 'newsletter_latest_link':
		case 'newsletter_latest_url':
			if (strlen($strTag[1]))
			{
				$strId = "'" . implode("','", trimsplit(',', $strTag[1])) . "'";
				$objNewsletter = $this->Database->prepare("
						SELECT
							n.*,
							c.`viewOnlinePage`,
							c.`subscriptionPage`
						FROM
							`tl_avisota_newsletter` n
						INNER JOIN
							`tl_avisota_newsletter_category` c
						ON
							c.`id`=n.`pid`
						WHERE
							(	c.`id` IN ($strId)
							OR	c.`alias` IN ($strId))
							AND n.`sendOn`!=''
						ORDER BY
							n.`sendOn` DESC")
					->limit(1)
					->execute();
				if ($objNewsletter->next())
				{
					if (strlen($strTag[2]))
					{
						$objPage = $this->Database->prepare("
								SELECT
									*
								FROM
									`tl_page`
								WHERE
										`id`=?
									OR	`alias`=?")
							->execute($strTag[2], $strTag[2]);
						if (!$objPage->next())
						{
							$objPage = false;
						}
					}
					else
					{
						$objPage = $this->Base->getViewOnlinePage($objNewsletter, false);
					}
					if ($objPage)
					{
						$strUrl = $this->Base->extendURL($this->generateFrontendUrl($objPage->row(), '/item/' . ($objNewsletter->alias ? $objNewsletter->alias : $objNewsletter->id)), $objPage);
						if ($strTag[0] == 'newsletter_latest_link')
						{
							$this->loadLanguageFile('avisota');
							return sprintf($GLOBALS['TL_LANG']['avisota']['latest_link'], specialchars($strUrl));
						}
						else
						{
							return $strUrl;
						}
					}
				}
			}
			return '';
		}
		return false;
	}
}
?>