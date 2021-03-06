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
 * Class AvisotaStatic
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    Avisota
 */
class AvisotaStatic extends Frontend
{
	/**
	 * The current category.
	 *
	 * @var array
	 */
	private static $category = array();


	/**
	 * The current newsletter.
	 *
	 * @var array
	 */
	private static $newsletter = array();


	/**
	 * The current recipient.
	 *
	 * @var array
	 */
	private static $recipientData = array();

	/**
	 * Reset all data.
	 */
	public static function reset()
	{
		self::$category   = array();
		self::$newsletter = array();
		self::$recipientData  = array();
	}


	/**
	 * Reset the current category.
	 */
	public static function popCategory()
	{
		return array_shift(self::$category);
	}


	/**
	 * Set the current category.
	 *
	 * @param Database_Result $category
	 */
	public static function pushCategory($category)
	{
		array_unshift(self::$category, $category);
	}


	/**
	 * Get the current category.
	 *
	 * @return Database_Result
	 */
	public static function getCategory()
	{
		return self::$category[0];
	}


	/**
	 * Reset the current newsletter.
	 */
	public static function popNewsletter()
	{
		return array_shift(self::$newsletter);
	}


	/**
	 * Set the current newsletter.
	 *
	 * @param AvisotaNewsletter $newsletter
	 */
	public static function pushNewsletter(AvisotaNewsletter $newsletter)
	{
		array_unshift(self::$newsletter, $newsletter);
	}


	/**
	 * Get the current newsletter.
	 *
	 * @return AvisotaNewsletter
	 */
	public static function getNewsletter()
	{
		return self::$newsletter[0];
	}


	/**
	 * Reset the current recipient.
	 */
	public static function popRecipient()
	{
		return array_shift(self::$recipientData);
	}


	/**
	 * Set the current recipient.
	 *
	 * @param AvisotaRecipient $recipientData
	 */
	public static function pushRecipient(AvisotaRecipient $recipientData)
	{
		array_unshift(self::$recipientData, $recipientData);
	}


	/**
	 * Get the current recipient.
	 *
	 * @return AvisotaRecipient
	 */
	public static function getRecipient()
	{
		return self::$recipientData[0];
	}

	/**
	 * Singleton
	 */
	protected function __construct()
	{
	}
}
