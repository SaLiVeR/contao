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
 * Table tl_avisota_newsletter_content
 */
$GLOBALS['TL_DCA']['tl_avisota_newsletter_content'] = array
(

	// Config
	'config'          => array
	(
		'dataContainer'    => 'Table',
		'ptable'           => 'tl_avisota_newsletter',
		'enableVersioning' => true,
		'onload_callback'  => array
		(
			array('Avisota\DataContainer\NewsletterContent', 'checkPermission')
		)
	),
	// List
	'list'            => array
	(
		'sorting'           => array
		(
			'mode'                  => 4,
			'fields'                => array('sorting'),
			'panelLayout'           => 'filter;search,limit',
			'headerFields'          => array('subject'),
			'child_record_callback' => array('Avisota\DataContainer\NewsletterContent', 'addElement')
		),
		'global_operations' => array
		(
			'view' => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_avisota_newsletter']['view'],
				'href'            => 'table=tl_avisota_newsletter&amp;key=send',
				'class'           => 'header_send',
				'button_callback' => array('Avisota\DataContainer\NewsletterContent', 'sendNewsletterButton')
			),
			'all'  => array
			(
				'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'       => 'act=select',
				'class'      => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations'        => array
		(
			'edit'   => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['edit'],
				'href'  => 'act=edit',
				'icon'  => 'edit.gif'
			),
			'copy'   => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['copy'],
				'href'       => 'act=paste&amp;mode=copy',
				'icon'       => 'copy.gif',
				'attributes' => 'onclick="Backend.getScrollOffset();"'
			),
			'cut'    => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['cut'],
				'href'       => 'act=paste&amp;mode=cut',
				'icon'       => 'cut.gif',
				'attributes' => 'onclick="Backend.getScrollOffset();"'
			),
			'delete' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['delete'],
				'href'       => 'act=delete',
				'icon'       => 'delete.gif',
				'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['toggle'],
				'icon'            => 'visible.gif',
				'attributes'      => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback' => array('Avisota\DataContainer\NewsletterContent', 'toggleIcon')
			),
			'show'   => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['show'],
				'href'  => 'act=show',
				'icon'  => 'show.gif'
			)
		),
	),
	// Palettes
	'palettes'        => array
	(
		'__selector__' => array('type')
	),
	'metapalettes'    => array
	(
		'default'   => array
		(
			'type' => array('type')
		),
		'headline'  => array
		(
			'type'   => array('type', 'area', 'headline'),
			'expert' => array(':hide', 'cssID', 'space')
		),
		'text'      => array
		(
			'type'   => array('type', 'area', 'headline'),
			'text'   => array('text', 'definePlain', 'personalize'),
			'image'  => array('addImage'),
			'expert' => array(':hide', 'cssID', 'space')
		),
		'list'      => array
		(
			'type'   => array('type', 'area', 'headline'),
			'list'   => array('listtype', 'listitems'),
			'expert' => array(':hide', 'cssID', 'space')
		),
		'table'     => array
		(
			'type'     => array('type', 'area', 'headline'),
			'table'    => array('tableitems'),
			'tconfig'  => array('summary', 'thead', 'tfoot'),
			'sortable' => array(':hide', 'sortable'),
			'expert'   => array(':hide', 'cssID', 'space')
		),
		'hyperlink' => array
		(
			'type'   => array('type', 'area', 'headline'),
			'link'   => array('url', 'linkTitle', 'embed'),
			'expert' => array(':hide', 'cssID', 'space')
		),
		'image'     => array
		(
			'type'   => array('type', 'area', 'headline'),
			'source' => array('singleSRC'),
			'image'  => array('alt', 'size', 'imagemargin', 'imageUrl', 'caption'),
			'expert' => array(':hide', 'cssID', 'space')
		),
		'gallery'   => array
		(
			'type'     => array('type', 'area', 'headline'),
			'source'   => array('multiSRC'),
			'image'    => array('size', 'imagemargin', 'perRow', 'sortBy'),
			'template' => array(':hide', 'galleryHtmlTpl', 'galleryPlainTpl'),
			'expert'   => array(':hide', 'cssID', 'space')
		),
		'news'      => array
		(
			'type'    => array('type', 'area', 'headline'),
			'include' => array('news'),
			'expert'  => array(':hide', 'cssID', 'space')
		),
		'events'    => array
		(
			'type'   => array('type', 'area', 'headline'),
			'events' => array('events'),
			'expert' => array(':hide', 'cssID', 'space')
		),
		'article'   => array
		(
			'type'    => array('type', 'area', 'headline'),
			'include' => array('articleAlias'),
			'expert'  => array(':hide', 'cssID', 'space')
		)
	),
	// Subpalettes
	'metasubpalettes' => array
	(
		'definePlain' => array('plain'),
		'addImage'    => array('singleSRC', 'alt', 'size', 'imagemargin', 'imageUrl', 'caption', 'floating'),
		'useImage'    => array('singleSRC', 'alt', 'size', 'caption'),
		'protected'   => array('groups')
	),
	// Fields
	'fields'          => array
	(
		'invisible'       => array
		(
			'label' => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['invisible']
		),
		'type'            => array
		(
			'label'            => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['type'],
			'default'          => 'text',
			'exclude'          => true,
			'filter'           => true,
			'inputType'        => 'select',
			'options_callback' => array('Avisota\DataContainer\NewsletterContent', 'getNewsletterElements'),
			'reference'        => &$GLOBALS['TL_LANG']['NLE'],
			'eval'             => array('helpwizard' => true, 'submitOnChange' => true, 'tl_class' => 'w50')
		),
		'area'            => array
		(
			'label'            => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['area'],
			'default'          => 'body',
			'exclude'          => true,
			'filter'           => true,
			'inputType'        => 'select',
			'options_callback' => array('Avisota\DataContainer\NewsletterContent', 'dcaGetNewsletterAreas'),
			'reference'        => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['area'],
			'eval'             => array('mandatory' => true, 'tl_class' => 'w50')
		),
		'headline'        => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['headline'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'inputUnit',
			'options'   => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
			'eval'      => array('maxlength' => 255, 'tl_class' => 'clr')
		),
		'text'            => array
		(
			'label'       => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['text'],
			'exclude'     => true,
			'search'      => true,
			'inputType'   => 'textarea',
			'eval'        => array('mandatory' => true, 'rte' => 'tinyNews', 'helpwizard' => true),
			'explanation' => 'insertTags'
		),
		'definePlain'     => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['definePlain'],
			'exclude'   => true,
			'inputType' => 'checkbox',
			'eval'      => array('submitOnChange' => true)
		),
		'plain'           => array
		(
			'label'       => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['plain'],
			'exclude'     => true,
			'search'      => true,
			'inputType'   => 'textarea',
			'eval'        => array('mandatory' => true, 'helpwizard' => true),
			'explanation' => 'insertTags'
		),
		'personalize'     => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['personalize'],
			'exclude'   => true,
			'filter'    => true,
			'inputType' => 'select',
			'options'   => array('anonymous', 'private'),
			'reference' => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content'],
			'eval'      => array('tl_class' => 'long')
		),
		'addImage'        => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['addImage'],
			'exclude'   => true,
			'inputType' => 'checkbox',
			'eval'      => array('submitOnChange' => true)
		),
		'singleSRC'       => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['singleSRC'],
			'exclude'   => true,
			'inputType' => 'fileTree',
			'eval'      => array('fieldType' => 'radio', 'files' => true, 'mandatory' => true, 'tl_class' => 'clr')
		),
		'alt'             => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['alt'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'long')
		),
		'size'            => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['size'],
			'exclude'   => true,
			'inputType' => 'imageSize',
			'options'   => array('crop', 'proportional', 'box'),
			'reference' => &$GLOBALS['TL_LANG']['MSC'],
			'eval'      => array('rgxp' => 'digit', 'nospace' => true, 'tl_class' => 'w50')
		),
		'imagemargin'     => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['imagemargin'],
			'exclude'   => true,
			'inputType' => 'trbl',
			'options'   => array('px', '%', 'em', 'pt', 'pc', 'in', 'cm', 'mm'),
			'eval'      => array('includeBlankOption' => true, 'tl_class' => 'w50')
		),
		'imageUrl'        => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['imageUrl'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array(
				'rgxp'           => 'url',
				'decodeEntities' => true,
				'maxlength'      => 255,
				'tl_class'       => 'w50 wizard'
			),
			'wizard'    => array
			(
				array('Avisota\DataContainer\NewsletterContent', 'pagePicker')
			)
		),
		'caption'         => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['caption'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'w50')
		),
		'floating'        => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['floating'],
			'default'   => 'above',
			'exclude'   => true,
			'inputType' => 'radioTable',
			'options'   => array('above', 'left', 'right', 'below'),
			'eval'      => array('cols' => 2),
			'reference' => &$GLOBALS['TL_LANG']['MSC'],
			'eval'      => array('mandatory' => true, 'tl_class' => 'w50')
		),
		'listtype'        => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['listtype'],
			'exclude'   => true,
			'inputType' => 'select',
			'options'   => array('ordered', 'unordered'),
			'reference' => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']
		),
		'listitems'       => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['listitems'],
			'exclude'   => true,
			'inputType' => 'listWizard',
			'eval'      => array('allowHtml' => true)
		),
		'tableitems'      => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['tableitems'],
			'exclude'   => true,
			'inputType' => 'tableWizard',
			'eval'      => array('allowHtml' => true, 'doNotSaveEmpty' => true, 'style' => 'width:142px; height:66px;')
		),
		'summary'         => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['summary'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array('mandatory' => true, 'maxlength' => 255)
		),
		'thead'           => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['thead'],
			'exclude'   => true,
			'inputType' => 'checkbox',
			'eval'      => array('tl_class' => 'w50')
		),
		'tfoot'           => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['tfoot'],
			'exclude'   => true,
			'inputType' => 'checkbox',
			'eval'      => array('tl_class' => 'w50')
		),
		'url'             => array
		(
			'label'     => &$GLOBALS['TL_LANG']['MSC']['url'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array(
				'mandatory'      => true,
				'rgxp'           => 'url',
				'decodeEntities' => true,
				'maxlength'      => 255,
				'tl_class'       => 'w50 wizard'
			),
			'wizard'    => array
			(
				array('Avisota\DataContainer\NewsletterContent', 'pagePicker')
			)
		),
		'linkTitle'       => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['linkTitle'],
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'w50')
		),
		'embed'           => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['embed'],
			'exclude'   => true,
			'inputType' => 'text',
			'eval'      => array('maxlength' => 255, 'tl_class' => 'long clr')
		),
		'multiSRC'        => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['multiSRC'],
			'exclude'   => true,
			'inputType' => 'fileTree',
			'eval'      => array('fieldType' => 'checkbox', 'files' => true, 'mandatory' => true)
		),
		'perRow'          => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['perRow'],
			'default'   => 4,
			'exclude'   => true,
			'inputType' => 'select',
			'options'   => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
			'eval'      => array('tl_class' => 'w50')
		),
		'sortBy'          => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['sortBy'],
			'exclude'   => true,
			'inputType' => 'select',
			'options'   => array('name_asc', 'name_desc', 'date_asc', 'date_desc', 'meta', 'random'),
			'reference' => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content'],
			'eval'      => array('tl_class' => 'w50')
		),
		'galleryHtmlTpl'  => array
		(
			'label'            => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['galleryHtmlTpl'],
			'default'          => 'nl_gallery_default_html',
			'exclude'          => true,
			'inputType'        => 'select',
			'options_callback' => array('Avisota\DataContainer\NewsletterContent', 'getGalleryTemplates'),
			'eval'             => array('tl_class' => 'w50')
		),
		'galleryPlainTpl' => array
		(
			'label'            => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['galleryPlainTpl'],
			'default'          => 'nl_gallery_default_plain',
			'exclude'          => true,
			'inputType'        => 'select',
			'options_callback' => array('Avisota\DataContainer\NewsletterContent', 'getGalleryTemplates'),
			'eval'             => array('tl_class' => 'w50')
		),
		'protected'       => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['protected'],
			'exclude'   => true,
			'filter'    => true,
			'inputType' => 'checkbox',
			'eval'      => array('submitOnChange' => true)
		),
		'groups'          => array
		(
			'label'      => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['groups'],
			'exclude'    => true,
			'inputType'  => 'checkbox',
			'foreignKey' => 'tl_member_group.name',
			'eval'       => array('mandatory' => true, 'multiple' => true)
		),
		'guests'          => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['guests'],
			'exclude'   => true,
			'filter'    => true,
			'inputType' => 'checkbox'
		),
		'cssID'           => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['cssID'],
			'exclude'   => true,
			'inputType' => 'text',
			'eval'      => array('multiple' => true, 'size' => 2, 'tl_class' => 'w50')
		),
		'space'           => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['space'],
			'exclude'   => true,
			'inputType' => 'text',
			'eval'      => array('multiple' => true, 'size' => 2, 'rgxp' => 'digit', 'nospace' => true)
		),
		'events'          => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['events'],
			'exclude'   => true,
			'inputType' => 'eventchooser',
			'eval'      => array('mandatory' => true)
		),
		'news'            => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['news'],
			'exclude'   => true,
			'inputType' => 'newschooser',
			'eval'      => array('mandatory' => true)
		),
		'articleAlias'    => array
		(
			'label'            => &$GLOBALS['TL_LANG']['tl_avisota_newsletter_content']['articleAlias'],
			'exclude'          => true,
			'inputType'        => 'select',
			'options_callback' => array('Avisota\DataContainer\NewsletterContent', 'getArticleAlias'),
			'eval'             => array('mandatory' => true, 'submitOnChange' => true),
			'wizard'           => array
			(
				array('Avisota\DataContainer\NewsletterContent', 'editArticleAlias')
			)
		)
	)
);
