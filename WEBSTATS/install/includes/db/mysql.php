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
* MySQL class
*/
class DB_MySQL
{
	var $config = array();
	var $language = array();
	var $error = false;
	var $link = null;
	var $engines = array();
	var $version = false;

	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array
	 * @param	array
	 */
	function DB_MySQL($config, $language)
	{
		$this->config = $config;
		$this->language = $language;
	}

	/**
	 * Connect to database
	 *
	 * @access	public
	 * @param	array
	 * @return	boolean
	 */
	function connect($params)
	{
		if ( !($this->link = @mysql_connect($params['db_host'], $params['db_user'], $params['db_pass'])) ) {
			$this->error = $this->language['db_connect'];
			return false;
		}
		if ( !@mysql_select_db($params['db_name'], $this->link) ) {
			$this->error = $this->language['db_select'];
			return false;
		}

		if ( $this->config['db_charset'] && $this->config['db_collation'] ) {
			$this->query("SET NAMES " . $this->config['db_charset'] . " COLLATE " . $this->config['db_collation'], true);
		}
		elseif ( $this->config['db_charset'] ) {
			$this->query("SET NAMES " . $this->config['db_charset'], true);
		}

		// get database version
		$result = $this->query("SELECT version() AS db_version", true);
		if ( $result ) {
			$obj = $this->fetch($result);
			$this->version = isset($obj->db_version) ? $obj->db_version : false;
		}

		// get supported engines
		$result = $this->query("SHOW ENGINES", false, true);
		if ( $result ) {
			while ( $obj = $this->fetch($result) ) {
				if ( isset($obj->Engine) && $obj->Engine && isset($obj->Support) && (strtolower($obj->Support) == 'yes' || strtolower($obj->Support) == 'default') ) {
					$this->engines[] = strtolower($obj->Engine);
				}
			}
		}

		return true;
	}

	/**
	 * Close database connection
	 *
	 * @access	public
	 * @return	boolean
	 */
	function close()
	{
		$result = @mysql_close($this->link);

		return $result;
	}

	/**
	 * Run database query
	 *
	 * @access	public
	 * @param	string
	 * @param	boolean
	 * @return	object
	 */
	function query($sql, $soft = false)
	{
		$result = @mysql_query($sql, $this->link);

		if ( $result === false && !$soft ) {
			$this->error($sql);
		}

		return $result;
	}

	/**
	 * Set error
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function error($sql = '')
	{
		if ( $this->config['db_show_queries'] && $sql ) {
			$this->error = sprintf($this->language['db_error_query'], @mysql_error($this->link), $sql);
		}
		else {
			$this->error = sprintf($this->language['db_error'], @mysql_error($this->link));
		}

		return $this->error;
	}

	/**
	 * Escape value
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function escape($value)
	{
		$value = @mysql_real_escape_string($value, $this->link);

		return $value;
	}

	/**
	 * Fetch object or array
	 *
	 * @access	public
	 * @param	object
	 * @param	string
	 * @return	object
	 */
	function fetch($result, $type = 'object')
	{
		$row = $type == 'object' ? @mysql_fetch_object($result) : @mysql_fetch_assoc($result);

		return $row;
	}

	/**
	 * Get last insert ID
	 *
	 * @access	public
	 * @return	integer
	 */
	function last_insert_id()
	{
		$id = @mysql_insert_id($this->link);

		return $id;
	}
}
