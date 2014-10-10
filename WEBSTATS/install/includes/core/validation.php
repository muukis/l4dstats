<?php
/*
=====================================================
PHP Setup Wizard Script - by VLD Interactive
----------------------------------------------------
http://www.phpsetupwizard.com/
http://www.vldinteractive.com/
-----------------------------------------------------
Copyright (c) 2005-2011 VLD Interactive
=====================================================
THIS IS COPYRIGHTED SOFTWARE
PLEASE READ THE LICENSE AGREEMENT
http://www.phpsetupwizard.com/license/
=====================================================
*/

/**
* Validation core class
*/
class Validation_Core
{
	var $config = array();
	var $language = array();
	var $error = false;

	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array
	 * @param	array
	 */
	function Validation_Core($config, $language)
	{
		$this->config = $config;
		$this->language = $language;
	}

	/**
	 * MySQL database
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function database($value, $params = array())
	{
		if ( !is_array($params) || !isset($params['db_host']) || !isset($params['db_user']) || !isset($params['db_pass']) || !isset($params['db_name']) ) {
			$this->error = $this->language['db_params'];
			return false;
		}

		$db_host = isset($_POST[$params['db_host']]) ? $_POST[$params['db_host']] : '';
		$db_user = isset($_POST[$params['db_user']]) ? $_POST[$params['db_user']] : '';
		$db_pass = isset($_POST[$params['db_pass']]) ? $_POST[$params['db_pass']] : '';
		$db_name = isset($_POST[$params['db_name']]) ? $_POST[$params['db_name']] : '';

		if ( $this->config['db_type'] == 'mysql' ) {
			$link = @mysql_connect($db_host, $db_user, $db_pass);
		}
		elseif ( $this->config['db_type'] == 'mysqli' ) {
			$link = @mysqli_connect($db_host, $db_user, $db_pass);
		}

		if ( !$link ) {
			$this->error = $this->language['db_connect'];
			return false;
		}

		if ( $db_name ) {
			if ( $this->config['db_type'] == 'mysql' ) {
				$db = @mysql_select_db($db_name, $link);
			}
			elseif ( $this->config['db_type'] == 'mysqli' ) {
				$db = @mysqli_select_db($link, $db_name);
			}

			if ( !$db ) {
				$this->error = $this->language['db_select'];
				return false;
			}
		}

		return true;
	}

	/**
	 * Is folder or file writable
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function is_writable($value)
	{
		@clearstatcache();

		if ( !@is_writable($value) ) {
			return false;
		}

		return true;
	}

	/**
	 * Required
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function required($value)
	{
		if ( is_array($value) ) {
			return $value ? true : false;
		}
		else {
			return $value != '' ? true : false;
		}
	}

	/**
	 * Match one field to another
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function matches($value, $param = '')
	{
		if ( is_array($param) ) {
			$param = current($param);
		}

		if ( !isset($_POST[$param]) ) {
			return false;
		}

		return $value === $_POST[$param] ? true : false;
	}

	/**
	 * Minimum length
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function min_length($value, $param = 0)
	{
		if ( function_exists('mb_strlen') ) {
			return mb_strlen($value) < $param ? false : true;
		}

		return strlen($value) < $param ? false : true;
	}

	/**
	 * Max length
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function max_length($value, $param = 0)
	{
		if ( function_exists('mb_strlen') ) {
			return mb_strlen($value) > $param ? false : true;
		}

		return strlen($value) > $param ? false : true;
	}

	/**
	 * Exact Length
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function exact_length($value, $param = 0)
	{
		if ( function_exists('mb_strlen') ) {
			return mb_strlen($value) != $param ? false : true;
		}

		return strlen($value) != $param ? false : true;
	}

	/**
	 * Minimum value
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function min_value($value, $param = 0)
	{
		if ( preg_match('#/[^0-9]#', $value) ) {
			return false;
		}

		return $value < $param ? false : true;
	}

	/**
	 * Max value
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function max_value($value, $param = 0)
	{
		if ( preg_match('#/[^0-9]#', $value) ) {
			return false;
		}

		return $value > $param ? false : true;
	}

	/**
	 * Exact value
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function exact_value($value, $param = 0)
	{
		return $value !== $param ? false : true;
	}

	/**
	 * Valid email
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function valid_email($value)
	{
		return (boolean)preg_match('#^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$#ix', $value);
	}

	/**
	 * Valid emails
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function valid_emails($value)
	{
		if ( strpos($value, ',') === false ) {
			return $this->valid_email($value);
		}

		foreach ( explode(',', $value) as $email ) {
			if ( $this->valid_email(trim($email)) === false ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Validate ip address
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function valid_ip($value)
	{
		$segments = explode('.', $value);

		if ( count($segments) != 4 ) {
			return false;
		}

		if ( $segments[0][0] == '0' ) {
			return false;
		}

		foreach ( $segments as $segment ) {
			if ( $segment == '' OR preg_match("/[^0-9]/", $segment) OR $segment > 255 OR strlen($segment) > 3 ) {
				return false;
			}
		}

		return true;
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function alpha($value)
	{
		return (boolean)preg_match('#^([a-z])+$#i', $value);
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha numeric
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function alpha_numeric($value)
	{
		return (boolean)preg_match('#^([a-z0-9])+$#i', $value);
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha numeric with underscores and dashes
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function alpha_dash($value)
	{
		return (boolean)preg_match('#^([-a-z0-9_-])+$#i', $value);
	}

	// --------------------------------------------------------------------

	/**
	 * Numeric
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function numeric($value)
	{
		return (boolean)preg_match('#^[\-+]?[0-9]*\.?[0-9]+$#', $value);

	}

	// --------------------------------------------------------------------

	/**
	 * Is numeric
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
  	function is_numeric($value)
	{
		return is_numeric($value) ? true : false;
	}

	// --------------------------------------------------------------------

	/**
	 * Integer
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function integer($value)
	{
		return (boolean)preg_match('#^[\-+]?[0-9]+$#', $value);
	}

	// --------------------------------------------------------------------

	/**
	 * Is a natural number (0,1,2,3, etc)
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function is_natural($value)
	{
   		return (boolean)preg_match('#^[0-9]+$#', $value);
	}

	// --------------------------------------------------------------------

	/**
	 * Is a natural number, but not a zero (1,2,3, etc)
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function is_natural_no_zero($value)
	{
		if ( !preg_match('#^[0-9]+$#', $value) ) {
			return false;
		}

		if ( $value == 0 ) {
			return false;
		}

		return true;
	}

	/**
	* Calls native PHP function
	*
	* @access	public
	* @param	array
	* @return	boolean
	*/
	function php_function($function, $value, $params = array())
	{
		if ( !is_array($params) ) {
			$params = array($params);
		}

		return call_user_func_array($function, array_merge(array($value), $params));
	}
}
