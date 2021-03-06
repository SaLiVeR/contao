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
 * Class AvisotaTransportEmailException
 *
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    Avisota
 */
class AvisotaTransportEmailException extends Exception
{
	protected $recipient;

	protected $email;

	public function __construct($recipient, Email $email, $message = '', $code = 0, $previous = null)
	{
		parent::__construct($message, $code, $previous);
		$this->recipient  = $recipient;
		$this->newsletter = $email;
	}

	public function getRecipient()
	{
		return $this->recipient;
	}

	public function getEmail()
	{
		return $this->email;
	}
}
