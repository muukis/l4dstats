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
* Callbacks core class
*/
class Callbacks_Core
{
	var $config = array();
	var $language = array();
	var $error = false;
	var $db = null;
	var $db_engines = array();
	var $db_version = false;

	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array
	 */
	function Callbacks_Core($config, $language)
	{
		$this->config = $config;
		$this->language = $language;
	}

	/**
	 * Create database object
	 *
	 * @access	public
	 * @param	array
	 * @return	object
	 */
	function db_init($params)
	{
		$dbtype = isset($params['db_type']) ? $params['db_type'] : $this->config['db_type'];

		// include database class
		if ( !@is_file(BASE_PATH . 'includes/db/'.$dbtype.'.php') ) {
			die('"includes/db/'.$dbtype.'.php" file was not found.');
		}
		include BASE_PATH . 'includes/db/'.$dbtype.'.php';

		$class = 'DB_'.$dbtype;

		$this->db = new $class($this->config, $this->language);

		if ( !$this->db_connect($params) ) {
			return false;
		}

		$this->db_engines = $this->db->engines;
		$this->db_version = $this->db->version;

		return true;
	}

	/**
	 * Connect to database
	 *
	 * @access	public
	 * @param	array
	 */
	function db_connect($params)
	{
		if ( !$this->db->connect($params) ) {
			$this->error = $this->db->error;
			return false;
		}

		return true;
	}

	/**
	 * Close database connection
	 *
	 * @access	public
	 * @return	boolean
	 */
	function db_close()
	{
		$result = $this->db->close();

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
	function db_query($sql, $soft = false)
	{
		if ( !($result = $this->db->query($sql, $soft)) ) {
			$this->error = $this->db->error;
		}

		return $result;
	}

	/**
	 * Escape value
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function db_escape($value)
	{
		$value = $this->db->escape($value);

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
	function db_fetch($result, $type = 'object')
	{
		if ( !($row = $this->db->fetch($result, $type)) ) {
			$this->error = $this->db->error;
		}

		return $row;
	}

	/**
	 * Get last insert ID
	 *
	 * @access	public
	 * @return	integer
	 */
	function db_last_insert_id()
	{
		if ( !($id = $this->db->last_insert_id()) ) {
			$this->error = $this->db->error;
		}

		return $id;
	}

	/**
	 * Import sql file
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @return	boolean
	 */
	function db_import_file($filename, $replace = array())
	{
		// does file exist?
		if ( @file_exists($filename) ) {

			$queries = array();
			$query = '';
			$comment = false;

			// read file
			$data = @file_get_contents($filename);

			// does data variable have anything in it?
			if ( $data ) {

				return $this->db_import_sql($data, $replace);
			}
			else {
				$this->error = sprintf($this->language['db_file'], $filename);
			}
		}
		else {
			$this->error = sprintf($this->language['db_file'], $filename);
		}

		return false;
	}

	/**
	 * Import batch sql data
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @return	boolean
	 */
	function db_import_sql($sql, $replace = array())
	{
		$queries = array();
		$query = '';
		$comment = false;

		// read file into array
		$lines = explode("\n", $sql);

		// does array have anything in it?
		if ( is_array($lines) ) {

			// loop through sql array
			foreach ( $lines as $line ) {

				$line = trim($line);
				if ( $line ) {

					// is this a one line comment?
					if ( strpos($line, '--') !== 0 && strpos($line, '#') !== 0 ) {

						// is this a multi line comment?
						if ( strpos($line, '/*') === 0 ) {
							$comment = true;
						}

						// are we inside a multi line comment?
						if ( !$comment ) {

							// append query
							$query .= $line;

							// is this the end of the query?
							if ( substr(rtrim($query), -1) == ';' ) {

								// do we need to replace anything?
								if ( $replace ) {

									// loop through the replacement array
									foreach ( $replace as $replace_from => $replace_to ) {

										// replace values
										$query = preg_replace('#'.preg_quote($replace_from, '#').'#i', $replace_to, $query);
									}
								}

								// truncate semi column
								$query = rtrim($query, ';');

								// run query
								if ( $this->db_query($query) === false ) {
									$this->error = $this->db->error;
									return false;
								}

								// reset query
								$query = '';
							}
						}

						// is this the end of a multi line comment?
						if ( substr(rtrim($line), -2) == '*/' ) {
							$comment = false;
						}
					}
				}
			}

			return true;
		}
		else {
			$this->error = sprintf($this->language['db_batch'], $filename);
		}

		return false;
	}
}
