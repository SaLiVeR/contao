<?php

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2013 Tristan Lins
 *
 * PHP version 5
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    avisota
 * @license    LGPL
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'][] = array('tl_module_avisota', 'onload_callback');

$GLOBALS['TL_DCA']['tl_module']['metapalettes']['avisota_subscribe']    = array
(
	'title'                => array('name', 'headline', 'type'),
	'avisota_subscription' => array('avisota_show_lists', 'avisota_lists', 'avisota_recipient_fields'),
	'template'             => array('tableless', 'avisota_template_subscribe'),
	'protected'            => array(':hide', 'protected'),
	'expert'               => array(
		':hide',
		'avisota_form_target',
		'avisota_subscribe_confirmation_page',
		'guests',
		'cssID',
		'space'
	)
);
$GLOBALS['TL_DCA']['tl_module']['metapalettes']['avisota_unsubscribe']  = array
(
	'title'                => array('name', 'headline', 'type'),
	'avisota_subscription' => array('avisota_show_lists', 'avisota_lists'),
	'template'             => array('tableless', 'avisota_template_unsubscribe'),
	'protected'            => array(':hide', 'protected'),
	'expert'               => array(
		':hide',
		'avisota_form_target',
		'avisota_unsubscribe_confirmation_page',
		'guests',
		'cssID',
		'space'
	)
);
$GLOBALS['TL_DCA']['tl_module']['metapalettes']['avisota_subscription'] = array
(
	'title'                => array('name', 'headline', 'type'),
	'avisota_subscription' => array('avisota_show_lists', 'avisota_lists', 'avisota_recipient_fields'),
	'template'             => array('tableless', 'avisota_template_subscription'),
	'protected'            => array(':hide', 'protected'),
	'expert'               => array(
		':hide',
		'avisota_form_target',
		'avisota_subscribe_confirmation_page',
		'avisota_unsubscribe_confirmation_page',
		'guests',
		'cssID',
		'space'
	)
);
$GLOBALS['TL_DCA']['tl_module']['metapalettes']['avisota_reader']       = array
(
	'title'          => array('name', 'headline', 'type'),
	'avisota_reader' => array('avisota_categories'),
	'template'       => array('avisota_reader_template'),
	'protected'      => array(':hide', 'protected'),
	'expert'         => array(':hide', 'guests', 'cssID', 'space')
);
$GLOBALS['TL_DCA']['tl_module']['metapalettes']['avisota_list']         = array
(
	'title'        => array('name', 'headline', 'type'),
	'avisota_list' => array('avisota_categories', 'perPage'),
	'redirect'     => array(':hide', 'avisota_view_page'),
	'template'     => array(':hide', 'avisota_list_template'),
	'protected'    => array(':hide', 'protected'),
	'expert'       => array(':hide', 'guests,cssID,space')
);

$GLOBALS['TL_DCA']['tl_module']['metasubpalettes']['avisota_send_notification'] = array
(
	'avisota_notification_time',
	'avisota_template_notification_mail_plain',
	'avisota_template_notification_mail_html'
);
$GLOBALS['TL_DCA']['tl_module']['metasubpalettes']['avisota_do_cleanup']        = array
(
	'avisota_cleanup_time'
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_recipient_fields'] = array
(
	'exclude'          => true,
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['avisota_recipient_fields'],
	'exclude'          => true,
	'inputType'        => 'checkboxWizard',
	'options_callback' => array('tl_module_avisota', 'getEditableRecipientProperties'),
	'eval'             => array('multiple' => true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_subscription_sender_name'] = array
(
	'exclude'   => true,
	'label'     => &$GLOBALS['TL_LANG']['tl_module']['avisota_subscription_sender_name'],
	'inputType' => 'text',
	'eval'      => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_subscription_sender'] = array
(
	'exclude'   => true,
	'label'     => &$GLOBALS['TL_LANG']['tl_module']['avisota_subscription_sender'],
	'inputType' => 'text',
	'eval'      => array('rgxp' => 'email', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_show_lists'] = array
(
	'exclude'   => true,
	'label'     => &$GLOBALS['TL_LANG']['tl_module']['avisota_show_lists'],
	'inputType' => 'checkbox',
	'eval'      => array()
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_lists'] = array
(
	'exclude'          => true,
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['avisota_lists'],
	'inputType'        => 'checkbox',
	'options_callback' => array('tl_module_avisota', 'getLists'),
	'eval'             => array('multiple' => true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_subscribe_confirmation_page'] = array
(
	'exclude'   => true,
	'label'     => &$GLOBALS['TL_LANG']['tl_module']['avisota_subscribe_confirmation_page'],
	'inputType' => 'pageTree',
	'eval'      => array('fieldType' => 'radio')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_unsubscribe_confirmation_page'] = array
(
	'exclude'   => true,
	'label'     => &$GLOBALS['TL_LANG']['tl_module']['avisota_unsubscribe_confirmation_page'],
	'inputType' => 'pageTree',
	'eval'      => array('fieldType' => 'radio')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_subscribe'] = array
(
	'exclude'          => true,
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_subscribe'],
	'inputType'        => 'select',
	'options_callback' => array('tl_module_avisota', 'getTemplates'),
	'eval'             => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_unsubscribe'] = array
(
	'exclude'          => true,
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_unsubscribe'],
	'inputType'        => 'select',
	'options_callback' => array('tl_module_avisota', 'getTemplates'),
	'eval'             => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_template_subscription'] = array
(
	'exclude'          => true,
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['avisota_template_subscription'],
	'inputType'        => 'select',
	'options_callback' => array('tl_module_avisota', 'getTemplates'),
	'eval'             => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_categories'] = array
(
	'exclude'          => true,
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['avisota_categories'],
	'inputType'        => 'checkbox',
	'options_callback' => array('tl_module_avisota', 'getCategories'),
	'eval'             => array('mandatory' => true, 'multiple' => true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_reader_template'] = array
(
	'exclude'          => true,
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['avisota_reader_template'],
	'inputType'        => 'select',
	'options_callback' => array('tl_module_avisota', 'getTemplates'),
	'eval'             => array('mandatory' => true, 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_list_template'] = array
(
	'exclude'          => true,
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['avisota_list_template'],
	'inputType'        => 'select',
	'options_callback' => array('tl_module_avisota', 'getTemplates'),
	'eval'             => array('mandatory' => true, 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_view_page'] = array
(
	'exclude'   => true,
	'label'     => &$GLOBALS['TL_LANG']['tl_module']['avisota_view_page'],
	'inputType' => 'pageTree',
	'eval'      => array('fieldType' => 'radio')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_selectable_lists'] = array
(
	'exclude'          => true,
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['avisota_selectable_lists'],
	'inputType'        => 'checkbox',
	'options_callback' => array('tl_module_avisota', 'getLists'),
	'eval'             => array('multiple' => true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_confirm_on_activate'] = array
(
	'exclude'   => true,
	'label'     => &$GLOBALS['TL_LANG']['tl_module']['avisota_confirm_on_activate'],
	'inputType' => 'checkbox',
	'eval'      => array()
);

$GLOBALS['TL_DCA']['tl_module']['fields']['avisota_form_target'] = array
(
	'exclude'   => true,
	'label'     => &$GLOBALS['TL_LANG']['tl_module']['avisota_form_target'],
	'inputType' => 'pageTree',
	'eval'      => array('fieldType' => 'radio')
);
