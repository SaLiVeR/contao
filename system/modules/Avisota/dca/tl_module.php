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
 * @author     Oliver Hoff <oliver@hofff.com>
 * @package    Avisota
 * @license    LGPL
 * @filesource
 */


$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'avisota_send_notification';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'avisota_do_cleanup';
$GLOBALS['TL_DCA']['tl_module']['palettes']['avisota_subscription'] = '{title_legend},name,headline,type;{avisota_subscription_legend},avisota_show_lists,avisota_lists,avisota_recipient_fields;{avisota_mail_legend},avisota_subscription_sender_name,avisota_subscription_sender;{template_legend},tableless,avisota_template_subscribe_mail_plain,avisota_template_subscribe_mail_html,avisota_template_unsubscribe_mail_plain,avisota_template_unsubscribe_mail_html,avisota_template_subscription;{avisota_notification_legend:hide},avisota_send_notification;{avisota_cleanup_legend:hide},avisota_do_cleanup;{protected_legend:hide},protected;{expert_legend:hide},jumpTo,guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['avisota_reader']       = '{title_legend},name,headline,type;{avisota_reader_legend},avisota_categories;{template_legend},avisota_reader_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__avisota_registration'] = '{avisota_registration_legend},avisota_registration_lists';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['avisota_send_notification'] = 'avisota_notification_time,avisota_template_notification_mail_plain,avisota_template_notification_mail_html';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['avisota_do_cleanup'] = 'avisota_cleanup_time';

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_recipient_fields'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_recipient_fields'],
	'exclude'                 => true,
	'inputType'               => 'checkboxWizard',
	'options_callback'        => array('tl_module_avisota', 'getEditableRecipientProperties'),
	'eval'                    => array('multiple'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_subscription_sender_name'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_subscription_sender_name'],
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_subscription_sender'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_subscription_sender'],
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'email', 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_show_lists'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_show_lists'],
	'inputType'               => 'checkbox',
	'eval'                    => array()
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_lists'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_lists'],
	'inputType'               => 'checkbox',
	'options_callback'        => array('tl_module_avisota', 'getLists'),
	'eval'                    => array('multiple'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_subscribe_mail_plain'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_subscribe_mail_plain'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_avisota', 'getTemplates'),
	'eval'                    => array('tl_class'=>'w50 clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_subscribe_mail_html'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_subscribe_mail_html'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_avisota', 'getTemplates'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_unsubscribe_mail_plain'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_unsubscribe_mail_plain'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_avisota', 'getTemplates'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_unsubscribe_mail_html'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_unsubscribe_mail_html'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_avisota', 'getTemplates'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_subscription'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_subscription'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_avisota', 'getSubscriptionTemplates'),
	'eval'                    => array('addBlankOption' => true, 'tl_class' => 'clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_registration_lists'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_registration_lists'],
	'inputType'               => 'checkbox',
	'options_callback'        => array('AvisotaRegistrationDCA', 'getLists'),
	'eval'                    => array('multiple' => true, 'tl_class' => 'clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_send_notification'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_send_notification'],
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange' => true, 'tl_class' => 'clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_notification_mail_plain'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_notification_mail_plain'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_avisota', 'getTemplates'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_notification_time'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_notification_time'],
	'default'                 => 3,
	'inputType'               => 'text',
	'eval'                    => array('mandatory' => true, 'rgxp' => 'digit')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_notification_mail_html'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_notification_mail_html'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_avisota', 'getTemplates'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_do_cleanup'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_do_cleanup'],
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange' => true, 'tl_class' => 'clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_cleanup_time'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_cleanup_time'],
	'default'                 => 7,
	'inputType'               => 'text',
	'eval'                    => array('mandatory' => true, 'rgxp' => 'digit')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_categories'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_categories'],
	'inputType'               => 'checkbox',
	'options_callback'        => array('tl_module_avisota', 'getCategories'),
	'eval'                    => array('mandatory'=>true, 'multiple'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_reader_template'] = array
(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['avisota_reader_template'],
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_avisota', 'getTemplates'),
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
);

/**
 * Class tl_module_avisota
 *
 *
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Avisota
 */
class tl_module_avisota extends Backend
{
	/**
	 * Get the category options
	 *
	 * @return array
	 */
	public function getCategories()
	{
		$objCategory = $this->Database
			->execute("SELECT * FROM tl_avisota_newsletter_category ORDER BY title");
		$arrList = array();
		while ($objCategory->next())
		{
			$arrList[$objCategory->id] = $objCategory->title;
		}
		return $arrList;
	}

	/**
	 * Get the lists options.
	 *
	 * @return array
	 */
	public function getLists()
	{
		$objList = $this->Database->execute("
				SELECT
					*
				FROM
					`tl_avisota_recipient_list`
				ORDER BY
					`title`");
		$arrList = array();
		while ($objList->next())
		{
			$arrList[$objList->id] = $objList->title;
		}
		return $arrList;
	}

	public function getTemplates(DataContainer $dc)
	{
		// Return all templates
		switch ($dc->field)
		{
			case 'avisota_template_subscribe_mail_plain':
				$strTemplatePrefix = 'mail_subscribe_plain_';
				break;
			case 'avisota_template_subscribe_mail_html':
				$strTemplatePrefix = 'mail_subscribe_html_';
				break;
			case 'avisota_template_unsubscribe_mail_plain':
				$strTemplatePrefix = 'mail_unsubscribe_plain_';
				break;
			case 'avisota_template_unsubscribe_mail_html':
				$strTemplatePrefix = 'mail_unsubscribe_html_';
				break;
			case 'avisota_template_notification_mail_plain':
				$strTemplatePrefix = 'mail_notification_plain_';
				break;
			case 'avisota_template_notification_mail_html':
				$strTemplatePrefix = 'mail_notification_html_';
				break;
			case 'avisota_reader_template':
				$strTemplatePrefix = 'avisota_reader_';
				break;
			default:
				return array();
		}

		return $this->getTemplateGroup($strTemplatePrefix, $dc->activeRecord->pid);
	}

	public function getEditableRecipientProperties()
	{
		$return = array();

		$this->loadLanguageFile('tl_avisota_recipient');
		$this->loadDataContainer('tl_avisota_recipient');

		foreach ($GLOBALS['TL_DCA']['tl_avisota_recipient']['fields'] as $k=>$v)
		{
			if ($v['eval']['feEditable'])
			{
				$return[$k] = $GLOBALS['TL_DCA']['tl_avisota_recipient']['fields'][$k]['label'][0];
			}
		}

		return $return;
	}


	/**
	 * Return all subscription templates as array
	 * @param object
	 * @return array
	 */
	public function getSubscriptionTemplates(DataContainer $dc)
	{
		$intPid = $dc->activeRecord->pid;

		if ($this->Input->get('act') == 'overrideAll')
		{
			$intPid = $this->Input->get('id');
		}

		return array_merge
		(
			array('mod_avisota_subscription'),
			$this->getTemplateGroup('subscription_', $intPid)
		);
	}
}
?>