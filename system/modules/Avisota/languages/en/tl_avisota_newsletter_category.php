<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

#copyright


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['title']              = array('Title ','Here you can enter the title of the category.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['alias']              = array('Category Alias','The Category alias is a unique reference that can be called instead of the numerical category Alias ID.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['viewOnlinePage']     = array('Newsletter Reader Page','Please select the Newsletter Read Page that subscribers will be directed to, if they choose to read the Newsletter online.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['subscriptionPage']   = array('Manage Member Subscriptions','Please select the page that subscribers will be forwareded to in order to manage their subscription.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['senderName']         = array('Sender Name ','Here you can enter the name of the sender.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['sender']             = array('Sender Address','Here you can enter a customized return address.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['useSMTP']            = array('Personal SMTP Server','Use your own SMTP server to send the Newsletter.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['smtpHost']           = array('SMTP Host Name ','Please enter the host name of the SMTP server.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['smtpUser']           = array('SMTP Username ','Here you can enter the SMTP user name.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['smtpPass']           = array('SMTP Password ','Here you can enter the SMTP password.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['smtpEnc']            = array('SMTP encryption ','Here you can select an encryption method (SSL or TLS).');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['smtpPort']           = array('SMTP port number ',' Please enter the port number of the SMTP server.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['tstamp']             = array('Change Date ', ' Date and time of last modification.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['areas']              = array('Areas', 'Comma separated list of additional content in the newsletter (e.a. header,left,right,footer).');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['template_html']      = array('HTML Email Template ', 'Here you can select the HTML e-mail template.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['template_plain']     = array('Plain text e-mail template ','Here you can choose the Plain Text e-mail template.');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['stylesheets']        = array('Style Sheets ',' Style sheets, which are to be included in the Newsletter.');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['category_legend'] = 'Category';
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['smtp_legend']     = 'SMTP-Settings';
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['expert_legend']   = 'Expert Settings';
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['template_legend'] = 'Template Settings';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['new']         = array('New Category ',' Create a new category');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['show']        = array('Category Details','Details of category ID %s');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['copy']        = array('Copy Category ', ' Copy category ID %s');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['delete']      = array('Delete Category', 'Delete category ID %s');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['edit']        = array('Edit Category', 'Edit category ID %s');
$GLOBALS['TL_LANG']['tl_avisota_newsletter_category']['editheader']  = array('Edit Category Header', 'Edit the header of category ID %s');

?>