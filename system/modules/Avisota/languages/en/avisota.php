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
$GLOBALS['TL_LANG']['avisota']['latest_link'] = '<a href="%s" target="_blank">Our Current Newsletter</a>';

$GLOBALS['TL_LANG']['avisota']['subscription']['preamble'] = 'Sign Up For Our Newsletter.';
$GLOBALS['TL_LANG']['avisota']['subscription']['lists']    = 'Distribution';
$GLOBALS['TL_LANG']['avisota']['subscription']['email']    = 'E-Mail Address';
$GLOBALS['TL_LANG']['avisota']['subscription']['empty']    = 'Are you already registered for our Newsletter?';

$GLOBALS['TL_LANG']['avisota']['subscribe']['submit']              = 'Subscribe';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['subject']     = 'Newsletter Subscription Confirmation';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['send']        = 'You are successfully logged into our mailing list and you will receive an activation email to confirm your subscription.';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['confirm']     = 'Your subscription for %s was successfully activated.';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['rejected']    = 'This email address %s is invalid and has been dismissed.';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['html']        = '<p>Dear Subscriber, we are pleased to welcome you to our Newsletter,  %1$s may be welcome.</p>
<p>Please open the following link in your browser to confirm the subscription.<br/>
<a href="%2$s">%2$s</a></p>
<p>Thank You!</p>';
$GLOBALS['TL_LANG']['avisota']['subscribe']['mail']['plain']       = 'Dear member, we would like to welcome you to our Newsletter %s.

Please open the following link in your browser to confirm the subscription.
%s

Thank You!';

$GLOBALS['TL_LANG']['avisota']['unsubscribe']['empty'] = 'You are not logged into our Newsletter.';

$GLOBALS['TL_LANG']['avisota']['unsubscribe']['submit']            = 'Cancel';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['subject']   = 'Newsletter Subscription Cancelled';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['confirm']   = 'They were held successfully in our newsletter.';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['rejected']  = 'The email address %s is invalid and has been dismissed.';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['html']      = '<p>Dear subscriber, you have been removed from the Newsletter %1$s.</p>
<p>We regret your decision for removing yourself from our Newsletter %1$s.  If there are any problems with our Newsletter, or you wish to give us some suggestions on how we can improve upon it, please feel free to contact the web master from our "Contact Us" page linked on our home page.  We look forward to serving you in the future.</p>
<p>You may always sign back up for our Newsletter at:<br/>
<a href="%2$s">%2$s</a></p>
<p>Thank You!</p>';
$GLOBALS['TL_LANG']['avisota']['unsubscribe']['mail']['plain']     = 'Dear subscriber, you have been removed from our Newsletter %1$s.

We regret your decision for removing yourself from our Newsletter %1$s.  If there are any problems with our Newsletter, or you wish to give us some suggestions on how we can improve upon it, please feel free to contact the web master from our "Contact Us" page linked on our home page.  We look forward to serving you in the future.

You may always sign back up for our Newsletter at:
%s

Thank You!';
