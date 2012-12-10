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
 * Avisota defaults
 */
$GLOBALS['TL_LANG']['avisota']['latest_link'] = '<a href="%s" target="_blank">Unser aktueller Newsletter</a>';

/**
 * Subscription
 */
$GLOBALS['TL_LANG']['avisota']['subscription']['preamble'] = 'Melden Sie sich zu unserem Newsletter an.';
$GLOBALS['TL_LANG']['avisota']['subscription']['empty']    = 'Sie sind bereits zu unserem Newsletter angemeldet.';


/**
 * Subscribe
 */
$GLOBALS['TL_LANG']['avisota']['subscribe']['submit']              = 'Abonnieren';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['subject']     = 'Newsletter Abonnement bestätigen';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['send']        = 'Sie wurden erfolgreich zu unserem Newsletter angemeldet, Sie erhalten in Kürze eine Aktivierungsmail um Ihr Abonnent zu bestätigen.';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['confirm']     = 'Ihr Abonnement für %s wurde erfolgreich aktiviert.';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['rejected']    = 'Die E-Mail Adresse %s scheint ungültig und wurde abgewiesen.';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['html']        = '<p>Sehr geehrter Interessent, wir freuen uns Sie als Abonnenten unseres Newsletters %1$s begrüßen zu dürfen.</p>
<p>Bitte öffnen Sie die folgende Adresse in Ihrem Browser, um das Abonnement zu bestätigen.<br/>
<a href="%2$s">%2$s</a></p>
<p>Sollten Sie Ihr Abonnement nicht bestätigen wollen, können Sie es über die folgende Adresse auch wieder löschen.<br/>
<a href="%3$s">%3$s</a></p>
<p>Vielen Dank</p>';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['plain']       = 'Sehr geehrter Interessent, wir freuen uns Sie als Abonnenten unseres Newsletters %s begrüßen zu dürfen.

Bitte öffnen Sie die folgende Adresse in Ihrem Browser, um das Abonnement zu bestätigen.
%s

Sollten Sie Ihr Abonnement nicht bestätigen wollen, können Sie es über die folgende Adresse auch wieder löschen.
%s

Vielen Dank';

/**
 * Unsubscribe
 */
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['empty'] = 'Sie sind nicht an unserem Newsletter angemeldet.';

$GLOBALS['TL_LANG']['avisota']['unsubscribe']['submit']            = 'Kündigen';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['subject']   = 'Newsletter Abonnement gekündigt';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['confirm']   = 'Sie wurden erfolgreich aus unserem Newsletter ausgetragen.';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['rejected']  = 'Die E-Mail Adresse %s scheint ungültig und wurde abgewiesen.';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['html']      = '<p>Sehr geehrter Abonnent, Sie wurden aus unserem Newsletter %1$s ausgetragen.</p>
<p>Wir bedauern Ihre Entscheidung und würden uns freuen, Sie in Zukunft wieder als Abonnenten begrüßen zu dürfen.</p>
<p>Sie können sich jederzeit wieder an unserem Newsletter anmelden.<br/>
<a href="%2$s">%2$s</a></p>
<p>Vielen Dank</p>';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['plain']     = 'Sehr geehrter Abonnent, Sie wurden aus unserem Newsletter %1$s ausgetragen.

Wir bedauern Ihre Entscheidung und würden uns freuen, Sie in Zukunft wieder als Abonnenten begrüßen zu dürfen.

Sie können sich jederzeit wieder an unserem Newsletter anmelden.
%s

Vielen Dank';

/**
 * Notification
 */
$GLOBALS['TL_LANG']['avisota']['notification']['mail']['subject']   = 'Erinnerung - Newsletter Abonnement bestätigen';
$GLOBALS['TL_LANG']['avisota']['notification']['mail']['html']        = '<p>Sehr geehrter Interessent,<br>
wir möchten Sie daran Erinnern, dass Sie Ihr Abonnent unseres Newsletters %s noch nicht bestätigt haben. Wir können Ihnen leider erst unseren Newsletter zukommen lassen, wenn Sie Ihr Abonnement bestätigt haben.</p>
<p>Bitte öffnen Sie die folgende Adresse in Ihrem Browser, um das Abonnement zu bestätigen.<br>
<a href="%2$s">%2$s</a></p>
<p>Vielen Dank</p>';
$GLOBALS['TL_LANG']['avisota']['notification']['mail']['plain']       = 'Sehr geehrter Interessent,
wir möchten Sie daran Erinnern, dass Sie Ihr Abonnent unseres Newsletters %s noch nicht bestätigt haben. Wir können Ihnen leider erst unseren Newsletter zukommen lassen, wenn Sie Ihr Abonnement bestätigt haben.

Bitte öffnen Sie die folgende Adresse in Ihrem Browser, um das Abonnement zu bestätigen.
%s

Vielen Dank';

/**
 * Reader
 */
$GLOBALS['TL_LANG']['avisota']['reader']['notFound'] = 'Der gewünschte Newsletter konnte nicht gefunden werden!';
