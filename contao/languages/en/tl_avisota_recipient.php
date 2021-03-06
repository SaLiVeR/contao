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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_avisota_recipient']['confirmed']               = array(
	'Confirmed',
	'This account has been confirmed.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['email']                   = array(
	'Email',
	'Please enter the email address.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['lists']                   = array(
	'Mailing lists',
	'Please choose the subscribed mailing lists.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['subscriptionAction']      = array(
	'Activation',
	'Please choose the activation method for subscriptions on new mailing lists.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['salutation']              = array(
	'Salutation',
	'Please choose the prefered salutation.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['title']                   = array(
	'Title',
	'Please enter the recipients title.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['firstname']               = array(
	'Forename',
	'Please enter the recipients forename.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['lastname']                = array(
	'Surename',
	'Please enter the recipients surname.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['gender']                  = array(
	'Gender',
	'Please choose the recipients gender.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['permitPersonalTracing']   = array(
	'Personenbezogene Profilbildung <span style="color:red">REMOVE</span>',
	'Der Abonnent hat seine Erlaubnis zur Erfassung eines personenbezogenen Profils erteilt.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['permitPersonalTracingFE'] = array(
	'Datenschutz <span style="color:red">REMOVE</span>',
	'Ja, ich willige der Erhebung, Verarbeitung und Nutzung meiner personenbezogenen Daten gemäß der <a href="%s" onclick="window.open(this.href); return false;">Datenschutzrichtlinie</a> ein.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['token']                   = array(
	'Token <span style="color:red">REMOVE</span>',
	'The double opt-in confirmation token.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['addedOn']                 = array(
	'Added on',
	'Date of subscription.',
	'added on %s'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['addedBy']                 = array(
	'Added by',
	'Contao user who added this recipient.',
	' by %s',
	'by a deleted user'
);


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_avisota_recipient']['recipient_legend']    = 'Recipient';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['subscription_legend'] = 'Subscription';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['personals_legend']    = 'Personals';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_avisota_recipient']['confirm']                 = '%s neue Abonnenten wurden importiert.';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['invalid']                 = '%s ungültige Einträge wurden übersprungen.';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['subscribed']              = 'registriert am %s';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['manually']                = 'manuell hinzugefügt';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['confirmManualActivation'] = 'Sind Sie sicher, dass Sie dieses Abonnement manuell aktivieren möchten?';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['confirmationSent']        = 'Bestätigungsmail gesendet am %s';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['reminderSent']            = 'Erinnerungsmail gesendet am %s';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['remindersSent']           = '%d. Erinnerungsmail gesendet am %s';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['sendConfirmation']        = 'Bestätigungsmail senden';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['activateSubscription']    = 'Abonnement direkt aktivieren';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['doNothink']               = 'Abonnement unbestätigt eintragen';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_avisota_recipient']['new']                 = array(
	'New recipient',
	'Add a new recipient'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['show']                = array(
	'Recipient details',
	'Show the details of recipient ID %s'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['copy']                = array(
	'Duplicate recipient',
	'Duplicate recipient ID %s'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['delete']              = array(
	'Delete recipient',
	'Delete recipient ID %s'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['delete_no_blacklist'] = array(
	'Delete recipient without blacklisting',
	'Delete recipient ID %s without blacklisting'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['edit']                = array(
	'Edit recipient',
	'Edit recipient ID %s'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['notify']              = array(
	'Notify recipient',
	'Notify recipient ID %s'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['migrate']             = array(
	'Migrieren <span style="color:red">REMOVE</span>',
	'Abonnenten aus dem Contao Newslettersystem migrieren.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['import']              = array(
	'CSV-Import <span style="color:red">REMOVE</span>',
	'Import von Abbonements aus einer CSV-Datei.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['export']              = array(
	'CSV-Export <span style="color:red">REMOVE</span>',
	'Export von Abbonements in eine CSV-Datei.'
);
$GLOBALS['TL_LANG']['tl_avisota_recipient']['remove']              = array(
	'CSV-Löschen <span style="color:red">REMOVE</span>',
	'Löschen von Abbonements aus einer CSV-Datei.'
);


/**
 * Exceptions
 */
$GLOBALS['TL_LANG']['tl_avisota_recipient']['globally_blacklisted']  = 'Der Verteiler <strong>%s</strong> befindet sich in der Blacklist, wenn Sie die Blacklist ignorieren möchten, speichern Sie erneut!';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['blacklisted'] = 'Die Verteiler <strong>%s</strong> befinden sich in der Blacklist, wenn Sie die Blacklist ignorieren möchten, speichern Sie erneut!';
