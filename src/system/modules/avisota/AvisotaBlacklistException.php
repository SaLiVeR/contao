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
 * Class AvisotaBlacklistException
 *
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    Avisota
 */
class AvisotaBlacklistException extends Exception
{
	protected $email;

	protected $lists;

	public function __construct($email = null, array $lists = array(), $message = '', $code = 0, $previous = null)
	{
		parent::__construct($message, $code, $previous);
		$this->email = $email;
		$this->lists = $lists;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getLists()
	{
		return $this->lists;
	}
}
