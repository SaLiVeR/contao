<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

#copyright


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_avisota_recipient']['email']       = array('E-Mail', 'Specify email address.');
$GLOBALS['TL_LANG']['tl_avisota_recipient']['confirmed']   = array('Activate','Un-Check to deactivate this subscriber.');
$GLOBALS['TL_LANG']['tl_avisota_recipient']['token']       = array('Token ','The auth token is the double opt-in method used.');
$GLOBALS['TL_LANG']['tl_avisota_recipient']['addedOn']     = array('Joined ', 'The date of the subscription.');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_avisota_recipient']['recipient_legend'] = 'Subscriber';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_avisota_recipient']['subscribed'] = 'registered on %s';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['manually']   = 'added manually';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['confirm']    = '%s new recipients have been imported.';
$GLOBALS['TL_LANG']['tl_avisota_recipient']['invalid']    = '%s invalid entries have been skipped.';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_avisota_recipient']['new']         = array('New Subscriber ','Create a new subscriber');
$GLOBALS['TL_LANG']['tl_avisota_recipient']['show']        = array('Subscriber Details ',' Details of the subscriber ID %s');
$GLOBALS['TL_LANG']['tl_avisota_recipient']['copy']        = array('Copy Subscriber ','Copy subscriber ID %s');
$GLOBALS['TL_LANG']['tl_avisota_recipient']['delete']      = array('Delete Subscriber', 'Delete subscriber ID %s');
$GLOBALS['TL_LANG']['tl_avisota_recipient']['edit']        = array('Edit Subscriber', 'Edit details of subscriber ID %s');
$GLOBALS['TL_LANG']['tl_avisota_recipient']['import']      = array('CSV Import', 'Import recipients from a CSV file');
?>