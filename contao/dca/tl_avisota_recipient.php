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


/**
 * Table tl_avisota_recipient
 */
$GLOBALS['TL_DCA']['tl_avisota_recipient'] = array
(

	// Config
	'config'       => array
	(
		'dataContainer'     => 'Table',
		'switchToEdit'      => true,
		'enableVersioning'  => true,
		'onload_callback'   => array
		(
			array('Avisota\DataContainer\Recipient', 'checkPermission'),
			array('Avisota\DataContainer\Recipient', 'filterByMailingLists'),
			array('Avisota\DataContainer\Recipient', 'onload_callback')
		),
		'onsubmit_callback' => array
		(
			array('Avisota\DataContainer\Recipient', 'onsubmit_callback')
		),
		'ondelete_callback' => array
		(
			array('Avisota\DataContainer\Recipient', 'ondelete_callback')
		)
	),
	// List
	'list'         => array
	(
		'sorting'           => array
		(
			'mode'        => 2,
			'fields'      => array('email'),
			'panelLayout' => 'filter;sort,search,limit',
		),
		'label'             => array
		(
			'fields'         => array('firstname', 'lastname', 'email'),
			'format'         => '%s %s &lt;%s&gt;',
			'label_callback' => array('Avisota\DataContainer\Recipient', 'getLabel')
		),
		'global_operations' => array
		(
			'migrate' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['migrate'],
				'href'       => 'table=tl_avisota_recipient_migrate&amp;act=edit',
				'class'      => 'header_recipient_migrate recipient_tool',
				'attributes' => 'onclick="Backend.getScrollOffset();"'
			),
			'import'  => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['import'],
				'href'       => 'table=tl_avisota_recipient_import&amp;act=edit',
				'class'      => 'header_recipient_import recipient_tool',
				'attributes' => 'onclick="Backend.getScrollOffset();"'
			),
			'export'  => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['export'],
				'href'       => 'table=tl_avisota_recipient_export&amp;act=edit',
				'class'      => 'header_recipient_export recipient_tool',
				'attributes' => 'onclick="Backend.getScrollOffset();"'
			),
			'remove'  => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['remove'],
				'href'       => 'table=tl_avisota_recipient_remove&amp;act=edit',
				'class'      => 'header_recipient_remove recipient_tool',
				'attributes' => 'onclick="Backend.getScrollOffset();"'
			),
			'all'     => array
			(
				'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'       => 'act=select',
				'class'      => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations'        => array
		(
			'edit'                => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['edit'],
				'href'            => 'act=edit',
				'icon'            => 'edit.gif',
				'button_callback' => array('Avisota\DataContainer\Recipient', 'editRecipient')
			),
			'delete'              => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['delete'],
				'href'            => 'act=delete',
				'icon'            => 'delete.gif',
				'attributes'      => 'class="contextmenu" onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
				'button_callback' => array('Avisota\DataContainer\Recipient', 'deleteRecipient')
			),
			'delete_no_blacklist' => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['delete_no_blacklist'],
				'href'            => 'act=delete&amp;blacklist=false',
				'icon'            => 'delete.gif',
				'attributes'      => 'class="edit-header" onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
				'button_callback' => array('Avisota\DataContainer\Recipient', 'deleteRecipientNoBlacklist')
			),
			'show'                => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['show'],
				'href'  => 'act=show',
				'icon'  => 'show.gif'
			),
			'notify'              => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['notify'],
				'href'            => '',
				'icon'            => 'system/modules/avisota/html/notify.png',
				'button_callback' => array('Avisota\DataContainer\Recipient', 'notify')
			),
		),
	),
	// Palettes
	'metapalettes' => array
	(
		'default' => array
		(
			'recipient'    => array('email'),
			'subscription' => array('lists', 'subscriptionAction'),
			'personals'    => array('salutation', 'title', 'firstname', 'lastname', 'gender'),
			'tracing'      => array('permitPersonalTracing')
		)
	),
	// Fields
	'fields'       => array
	(
		'email'                 => array
		(
			'label'         => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['email'],
			'exclude'       => true,
			'search'        => true,
			'sorting'       => true,
			'flag'          => 1,
			'inputType'     => 'text',
			'eval'          => array(
				'tl_class'   => 'w50',
				'rgxp'       => 'email',
				'mandatory'  => true,
				'maxlength'  => 255,
				'importable' => true,
				'exportable' => true
			),
			'save_callback' => array
			(
				array('Avisota\DataContainer\Recipient', 'saveEmail')
			)
		),
		'lists'                 => array
		(
			'label'         => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['lists'],
			'inputType'     => 'checkbox',
			'foreignKey'    => 'tl_avisota_mailing_list.title',
			'eval'          => array(
				'multiple'       => true,
				'doNotSaveEmpty' => true,
				'doNotCopy'      => true,
				'doNotShow'      => true,
				'tl_class'       => 'clr'
			),
			'load_callback' => array
			(
				array('Avisota\DataContainer\Recipient', 'loadMailingLists')
			),
			'save_callback' => array
			(
				array('Avisota\DataContainer\Recipient', 'validateBlacklist'),
				array('Avisota\DataContainer\Recipient', 'saveMailingLists')
			)
		),
		'subscriptionAction'    => array
		(
			'label'         => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['subscriptionAction'],
			'inputType'     => 'select',
			'options'       => array('sendConfirmation', 'activateSubscription', 'doNothink'),
			'reference'     => &$GLOBALS['TL_LANG']['tl_avisota_recipient'],
			'eval'          => array(
				'doNotSaveEmpty' => true,
				'doNotCopy'      => true,
				'doNotShow'      => true
			),
			'save_callback' => array(array('Avisota\DataContainer\Recipient', 'saveSubscriptionAction'))
		),
		'salutation'            => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['salutation'],
			'exclude'   => true,
			'filter'    => true,
			'sorting'   => true,
			'flag'      => 1,
			'inputType' => 'select',
			'options'   => array(),
			//array_combine($GLOBALS['TL_CONFIG']['avisota_salutations'], $GLOBALS['TL_CONFIG']['avisota_salutations']),
			'eval'      => array(
				'maxlength'          => 255,
				'includeBlankOption' => true,
				'importable'         => true,
				'exportable'         => true,
				'feEditable'         => true,
				'tl_class'           => 'w50'
			)
		),
		'title'                 => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['title'],
			'exclude'   => true,
			'search'    => true,
			'sorting'   => true,
			'flag'      => 1,
			'inputType' => 'text',
			'eval'      => array(
				'maxlength'  => 255,
				'importable' => true,
				'exportable' => true,
				'feEditable' => true,
				'tl_class'   => 'w50'
			)
		),
		'firstname'             => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['firstname'],
			'exclude'   => true,
			'search'    => true,
			'sorting'   => true,
			'flag'      => 1,
			'inputType' => 'text',
			'eval'      => array(
				'maxlength'  => 255,
				'importable' => true,
				'exportable' => true,
				'feEditable' => true,
				'tl_class'   => 'w50'
			)
		),
		'lastname'              => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['lastname'],
			'exclude'   => true,
			'search'    => true,
			'sorting'   => true,
			'flag'      => 1,
			'inputType' => 'text',
			'eval'      => array(
				'maxlength'  => 255,
				'importable' => true,
				'exportable' => true,
				'feEditable' => true,
				'tl_class'   => 'w50'
			)
		),
		'gender'                => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['gender'],
			'exclude'   => true,
			'filter'    => true,
			'sorting'   => true,
			'inputType' => 'select',
			'options'   => array('male', 'female'),
			'reference' => &$GLOBALS['TL_LANG']['MSC'],
			'eval'      => array(
				'includeBlankOption' => true,
				'importable'         => true,
				'exportable'         => true,
				'feEditable'         => true,
				'tl_class'           => 'clr'
			)
		),
		'permitPersonalTracing' => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['permitPersonalTracing'],
			'exclude'   => true,
			'filter'    => true,
			'inputType' => 'checkbox',
			'eval'      => array(
				'importable' => true,
				'exportable' => true,
				'feEditable' => true,
				'tl_class'   => 'clr m12'
			)
		),
		'token'                 => array
		(
			'label' => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['token']
		),
		'addedOn'               => array
		(
			'label'   => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['addedOn'],
			'default' => time(),
			'filter'  => true,
			'sorting' => true,
			'flag'    => 8,
			'eval'    => array(
				'importable' => true,
				'exportable' => true,
				'doNotShow'  => true,
				'doNotCopy'  => true
			)
		),
		'addedBy'               => array
		(
			'label'      => &$GLOBALS['TL_LANG']['tl_avisota_recipient']['addedBy'],
			'default'    => $this->User->id,
			'filter'     => true,
			'sorting'    => true,
			'flag'       => 1,
			'foreignKey' => 'tl_user.name',
			'eval'       => array(
				'importable' => true,
				'exportable' => true,
				'doNotShow'  => true,
				'doNotCopy'  => true
			)
		)
	)
);
