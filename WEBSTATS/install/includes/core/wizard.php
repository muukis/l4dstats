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
* PHP Setup Wizard core class
*/
class phpSetupWizard_Core
{
	var $config = array();
	var $language = array();
	var $languages = array();
	var $vars = array();
	var $step = array();

	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function phpSetupWizard_Core()
	{
		// start session
		session_start();

		if ( !session_id() ) {
			die('PHP Session could not be started.');
		}

		$this->load_config();
		$this->load_language();
		$this->load_steps();
	}

	/**
	 * Load configuration file
	 *
	 * @access	public
	 */
	function load_config()
	{
		// load configuration file
		if ( !@is_file(BASE_PATH . 'includes/config.php') ) {
			die('"includes/config.php" file was not found.');
		}
		include BASE_PATH . 'includes/config.php';

		if ( !isset($config) || !is_array($config) || !$config ) {
			die('"includes/config.php" file is not formatted correctly.');
		}

		// set session language
		if ( !isset($_SESSION['language']) || !$_SESSION['language'] ) {
			$_SESSION['language'] = $config['language'];
		}

		// assign configuration array
		$this->config = $config;
	}

	/**
	 * Load language file
	 *
	 * @access	public
	 */
	function load_language()
	{
		// load core language file
		if ( @is_file(BASE_PATH . 'languages/core/' . $_SESSION['language'] . '.php') ) {
			$filename = $_SESSION['language'];
		}
		elseif ( @is_file(BASE_PATH . 'languages/core/' . $this->config['language'] . '.php') ) {
			$filename = $this->config['language'];
		}
		else {
			die('"includes/core/' . $_SESSION['language'] . '.php" file was not found.');
		}

		include BASE_PATH . 'languages/core/' . $filename . '.php';

		if ( !isset($language) || !is_array($language) || !$language ) {
			die('"languages/' . $filename . '.php" file is not formatted correctly.');
		}

		// assign language array
		$this->language = $language;
		unset($language);

		// load user language file
		$filename = '';
		if ( @is_file(BASE_PATH . 'languages/' . $_SESSION['language'] . '.php') ) {
			$filename = $_SESSION['language'];
		}
		elseif ( @is_file(BASE_PATH . 'languages/' . $this->config['language'] . '.php') ) {
			$filename = $this->config['language'];
		}

		if ( $filename ) {
			include BASE_PATH . 'languages/' . $filename . '.php';

			if ( isset($language) && is_array($language) ) {
				$this->language = array_merge($this->language, $language);
			}
		}
	}

	/**
	 * Load steps file
	 *
	 * @access	public
	 */
	function load_steps()
	{
		// load steps file
		if ( !@is_file(BASE_PATH . 'includes/steps.php') ) {
			die('"includes/steps.php" file was not found.');
		}
		include BASE_PATH . 'includes/steps.php';

		if ( !isset($steps) || !is_array($steps) ) {
			die('"includes/steps.php" file is not formatted correctly.');
		}

		// assign configuration array
		$this->config['steps'] = $steps;
	}

	/**
	 * Get languages
	 *
	 * @access	public
	 */
	function get_languages()
	{
		if ( $handle = @opendir(BASE_PATH . 'languages/core/') ) {
		    while ( ($filename = @readdir($handle)) !== false ) {
		        if ( @is_file(BASE_PATH . 'languages/core/' . $filename)  &&  $filename != '.'  &&  $filename != '..' && strtolower(substr($filename, -4)) == '.php' )
		        {
		            include BASE_PATH . 'languages/core/' . $filename;

		            if ( !isset($language) || !is_array($language) || !isset($language['language_name']) ) {
						die('languages/core/' . $filename . ' file is not formatted properly.');
					}

					$this->languages[substr($filename, 0, -4)] = $language['language_name'];

					unset($language);
		        }
		    }
			@closedir($handle);
		}

		if ( $handle = @opendir(BASE_PATH . 'languages/') ) {
		    while ( ($filename = @readdir($handle)) !== false ) {
		        if ( @is_file(BASE_PATH . 'languages/' . $filename)  &&  $filename != '.'  &&  $filename != '..' && strtolower(substr($filename, -4)) == '.php' )
		        {
		            include BASE_PATH . 'languages/' . $filename;

		            if ( !isset($language) || !is_array($language) ) {
						die('languages/' . $filename . ' file is not formatted properly.');
					}

					if ( isset($language['language_name']) && !isset($this->languages[substr($filename, 0, -4)]) ) {
						$this->languages[substr($filename, 0, -4)] = $language['language_name'];
					}

					unset($language);
		        }
		    }
			@closedir($handle);
		}
	}

	/**
	 * Run installation wizard
	 *
	 * @access	public
	 */
	function run()
	{
		// set step number
		$this->set_step_number();

		// parse current step
		$this->step = $this->config['steps'][$this->vars['step_num']-1];
		$status = $this->parse_step();

		// check if back/next buttons were pressed
		if ( $status && isset($_POST['button_next']) && $_POST['button_next'] && ($this->vars['step_num']+1) <= $this->vars['total_steps'] ) {
			$_SESSION['last_step']++;
			$this->redirect($this->config['wizard_file'].'?s=' . ($this->vars['step_num']+1));
		}
		elseif ( isset($_POST['button_back']) && $_POST['button_back'] ) {
			$this->redirect($this->config['wizard_file'].'?s=' . ($this->vars['step_num']-1));
		}

		// output content
		$this->output();
	}

	/**
	 * Set step number
	 *
	 * @access	public
	 */
	function set_step_number()
	{
		// get current step number
		$step_num = isset($_GET['s']) && $_GET['s'] && is_numeric($_GET['s']) && $_GET['s'] > 0 ? $_GET['s'] : 1;

		// is step number of out bounds?
		if ( !isset($this->config['steps'][$step_num-1]) || !is_array($this->config['steps'][$step_num-1]) ) {
			die('Step #' . $step_num . ' does not exist.');
		}

		// set up last step
		if ( !isset($_SESSION['last_step']) ) {
			$_SESSION['last_step'] = 1;
		}

		// did the user complete previous steps?
		if ( $step_num > 1 && $step_num > $_SESSION['last_step'] ) {
			$this->redirect($this->config['wizard_file'] . ( $_SESSION['last_step'] > 1 ? '?s=' . $_SESSION['last_step'] : '' ));
		}

		// assign step vars
		$this->vars['total_steps'] = count($this->config['steps']);
		$this->vars['step_num'] = $step_num;
		$this->vars['step_pct'] = $this->vars['total_steps'] > 1 ? ceil(100/($this->vars['total_steps']-1)*($step_num-1)) : 0;
	}

	/**
	 * Parse installation step
	 *
	 * @access	public
	 * @return	boolean
	 */
	function parse_step()
	{
		$status = true;

		// include and create validation class
		include BASE_PATH . 'includes/core/validation.php';
		include BASE_PATH . 'includes/validation.php';
		$validate = new Validation($this->config, $this->language);

		// loop through the form fields
		if ( isset($this->step['fields']) ) {
			foreach ( $this->step['fields'] as $index => $field ) {
				$field['index'] = $index;

				if ( $field['type'] == 'language' ) {

					// load languages
					$this->get_languages();

					// set field's value
					if ( isset($_POST['language']) ) {
						$value = $_POST['language'];
					}
					else {
						$value = $_SESSION['language'];
					}

					$this->step['fields'][$field['index']] = array(
						'label' => 'Language',
						'name' => 'language',
						'type' => 'select',
						'items' => $this->languages,
						'value' => $_SESSION['language'] = $_SESSION['language'] = $value,
					);
				}
				elseif ( $field['type'] == 'php-config' ) {

					$values = array();
					foreach ( $field['items'] as $key => $value ) {

						if ( is_array($value) ) {
							$name = $value[1];
							$value = $value[0];
						}
						else {
							$name = '';
						}

						$values[$key] = $this->validate_php_config($key, $value, $name);

						if ( isset($values[$key]['error']) && $values[$key]['error'] ) {
							$status = false;
						}
					}

					$this->step['fields'][$field['index']]['value'] = $field['value'] = $values;

					if ( !$status ) {
						$this->vars['error'] = $this->language['config_php_error'];
					}
				}
				elseif ( $field['type'] == 'php-modules' ) {

					$modules = get_loaded_extensions();
					$values = array();
					foreach ( $field['items'] as $key => $value ) {

						$name = is_array($value) ? $value[1] : $value;
						$value = is_array($value) && $value[0] ? true : false;

						if ( $value ) {
							$values[$key] = array(
								'value' => in_array($key, $modules) ? $this->language['config_available'] : $this->language['config_unavailable'],
								'error' => in_array($key, $modules) ? 0 : 1,
								'message' => in_array($key, $modules) ? $this->language['config_pass'] : $this->language['config_fail'],
							);
						}
						else {
							$values[$key] = array(
								'value' => in_array($key, $modules) ? $this->language['config_available'] : $this->language['config_unavailable'],
								'error' => 0,
								'message' => $this->language['config_pass'],
							);
						}

						if ( isset($values[$key]['error']) && $values[$key]['error'] ) {
							$status = false;
						}
					}

					$this->step['fields'][$field['index']]['value'] = $field['value'] = $values;

					if ( !$status ) {
						$this->vars['error'] = $this->language['config_php_error'];
					}
				}
				elseif ( $field['type'] == 'file-permissions' ) {

					$values = array();
					foreach ( $field['items'] as $key => $value ) {

						$is_exists = @file_exists($key);
						if ( !$is_exists ) {
							$values[$key] = array(
								'value' => $this->language['config_readable'],
								'error' => 1,
								'message' => @substr($key, -1) == '/' ? $this->language['config_folder_none'] : $this->language['config_file_none'],
							);
						}
						else {
							if ( $value == 'write' ) {
								$is_write = @is_writable($key);
								$values[$key] = array(
									'value' => $this->language['config_writable'],
									'error' => $is_write ? 0 : 1,
									'message' => $is_write ? $this->language['config_pass'] : (@substr($key, -1) == '/' ? $this->language['config_write_folder'] : $this->language['config_write_file']),
								);
							}
							else {
								$is_read = @is_readable($key);
								$values[$key] = array(
									'value' => $this->language['config_readable'],
									'error' => $is_read ? 0 : 1,
									'message' => $is_read ? $this->language['config_pass'] : (@substr($key, -1) == '/' ? $this->language['config_read_folder'] : $this->language['config_read_file']),
								);
							}
						}

						$values[$key]['path'] = $key;
						if ( strpos($key, './../') === 0 ) {
							$values[$key]['path'] = substr($key, 5);
						}
						elseif ( strpos($key, '../') === 0 ) {
							$values[$key]['path'] = substr($key, 3);
						}

						if ( isset($values[$key]['error']) && $values[$key]['error'] ) {
							$status = false;
						}
					}

					$this->step['fields'][$field['index']]['value'] = $field['value'] = $values;

					if ( !$status ) {
						$this->vars['error'] = $this->language['config_file_error'];
					}
				}
				elseif ( $field['type'] == 'checkbox' ) {

					// set field's value
					if ( isset($_POST[$field['name']]) || isset($_POST['button_next']) && $_POST['button_next'] ) {
						$values = isset($_POST[$field['name']]) ? $_POST[$field['name']] : array();
					}
					elseif ( isset($_SESSION['params'][$field['name']]) ) {
						$values = $_SESSION['params'][$field['name']];
					}
					else {
						if ( isset($field['default']) ) {
							$values = is_array($field['default']) ? $field['default'] : array($field['default']);
						}
						else {
							$values = array();
						}
					}
					$this->step['fields'][$field['index']]['value'] = $_SESSION['params'][$field['name']] = $field['value'] = $values;
				}
				elseif ( $field['type'] != 'header' && $field['type'] != 'info' ) {
					// set field's value
					if ( isset($_POST[$field['name']]) ) {
						$value = $_POST[$field['name']];
					}
					elseif ( isset($_SESSION['params'][$field['name']]) ) {
						$value = $_SESSION['params'][$field['name']];
					}
					else {
						$value = isset($field['default']) ? $field['default'] : '';
					}
					$this->step['fields'][$field['index']]['value'] = $_SESSION['params'][$field['name']] = $field['value'] = $value;
				}

				// check if any validation is required
				if ( isset($_POST['button_next']) && $_POST['button_next'] && isset($field['validate']) && $field['validate'] ) {

					// loop through validation rules
					foreach ( $field['validate'] as $rule ) {

						// validate rule
						if ( $status && !$this->validate_rule($validate, $field, $rule) ) {
							$status = false;
						}
					}
				}
			}
		}

		// run user specified callbacks
		if ( $status && isset($this->step['callbacks']) ) {

			// include a create user callbacks class
			include BASE_PATH . 'includes/core/callbacks.php';
			include BASE_PATH . 'includes/callbacks.php';
			$callbacks = new Callbacks($this->config, $this->language);

			// loop through callbacks
			foreach ( $this->step['callbacks'] as $callback ) {

				// do we need to execute it now?
				if ( (!isset($callback['execute']) || $callback['execute'] == 'after') && isset($_POST['button_next']) && $_POST['button_next'] || isset($callback['execute']) && $callback['execute'] == 'before') {

					// run callback
					if ( $status && !$this->run_callback($callbacks, $callback) ) {
						$status = false;
					}
				}
			}
		}

		return $status;
	}

	/**
	 * Validate rule
	 *
	 * @access	public
	 * @param	object
	 * @param	array
	 * @param	array
	 * @return	boolean
	 */
	function validate_rule($validate, $field, $rule)
	{
		// set parameters
		if ( isset($rule['params']) ) {
			$params = is_array($rule['params']) ? array($rule['params']) : array($rule['params']);
		}
		else {
			$params = array();
		}

		// set default status to false
		$status = false;

		// check if this is a custom function
		if ( method_exists($validate, $rule['rule']) ) {
			$status = call_user_func_array(array($validate, $rule['rule']), array_merge(array($field['value']), $params));
		}
		// check if this is a php function
		elseif ( function_exists($rule['rule']) ) {
			$status = call_user_func_array(array($validate, 'php_function'), array_merge(array($rule['rule'], $field['value']), $params));
			$status = false;
		}
		else {
			$validate->error = 'Validation rule ' . $rule['rule'] . ' does not seem to be valid.';
		}

		// did the rule validate?
		if ( !$status ) {
			$this->set_validate_error($validate, $field, $rule, $params);
			return false;
		}

		return true;
	}

	/**
	 * Validate PHP configuration.
	 *
	 * @access	public
	 * @param	object
	 * @param	array
	 * @param	array
	 * @param	array
	 */
	function validate_php_config($key, $value, $name = '')
	{
		$values = array();

		$config = $key == 'php_version' ? phpversion() : ini_get($key);

		if ( $config == 'On' ) $config = true;
		elseif ( $config == 'Off' || $config == '' ) $config = false;

		if ( is_null($value) ) {
			$values = array(
				'value' => $config === false? $this->language['config_no'] : ($config === true || $config === '1' ? $this->language['config_yes'] : $config),
				'error' => 0,
				'message' => $this->language['config_pass'],
			);
		}
		elseif ( is_bool($value) ) {
			if ( $value ) {
				$values = array(
					'value' => $config ? $this->language['config_yes'] : $this->language['config_no'],
					'error' => $config ? 0 : 1,
					'message' => $config ? $this->language['config_pass'] : $this->language['config_fail'],
				);
			}
			else {
				$values = array(
					'value' => !$config ? $this->language['config_no'] : $this->language['config_yes'],
					'error' => !$config ? 0 : 1,
					'message' => !$config ? $this->language['config_pass'] : $this->language['config_fail'],
				);
			}
		}
		else {
			$comparison = '=';
			if ( substr($value, 0, 2) == '>=' || substr($value, 0, 2) == '<=' ) {
				$comparison = substr($value, 0, 2);
				$value = substr($value, 2);
			}
			elseif ( substr($value, 0, 1) == '>' || substr($value, 0, 1) == '<' || substr($value, 0, 1) == '=' ) {
				$comparison = substr($value, 0, 1);
				$value = substr($value, 1);
			}

			$newcfg = $this->return_bytes($config);
			$newval = $this->return_bytes($value);

			switch ( $comparison ) {
				case '=>':
				case '>=':
					$values = array(
						'error' => $newcfg >= $newval ? 0 : 1,
						'message' => $newcfg >= $newval ? $this->language['config_pass'] : sprintf($this->language['config_greater_eq'], $name ? $name : $key, $value),
					);
					break;
				case '=<':
				case '<=':
					$values = array(
						'error' => $newcfg <= $newval ? 0 : 1,
						'message' => $newcfg <= $newval ? $this->language['config_pass'] : sprintf($this->language['config_less_eq'], $name ? $name : $key, $value),
					);
					break;
				case '>':
					$values = array(
						'error' => $newcfg > $newval ? 0 : 1,
						'message' => $newcfg > $newval ? $this->language['config_pass'] : sprintf($this->language['config_greater'], $name ? $name : $key, $value),
					);
					break;
				case '<':
					$values = array(
						'error' => $newcfg < $newval ? 0 : 1,
						'message' => $newcfg < $newval ? $this->language['config_pass'] : sprintf($this->language['config_less'], $name ? $name : $key, $value),
					);
					break;
				default:
					$values = array(
						'error' => $newcfg == $newval ? 0 : 1,
						'message' => $newcfg == $newval ? $this->language['config_pass'] : sprintf($this->language['config_eq'], $name ? $name : $key, $value),
					);
					break;
			}

			$values['value'] = $config;
		}

		return $values;
	}

	/**
	 * Set validation class error.
	 *
	 * @access	public
	 * @param	object
	 * @param	array
	 * @param	array
	 * @param	array
	 */
	function set_validate_error($validate, $field, $rule, $params)
	{
		// is error message included
		if ( isset($rule['error']) ) {
			$validate->error = $rule['error'];
		}
		// is error message in the language file
		elseif ( isset($this->language[$rule['rule']]) ) {
			$params = $this->prep_params($params);
			$validate->error = call_user_func_array('sprintf', array_merge(array($this->language[$rule['rule']]), array($field['label']), $params));
		}
		// is error message already set
		elseif ( !$validate->error ) {
			$validate->error = 'Error message does not exist for ' . $rule['rule'] . ' rule.';
		}

		$this->vars['error'] = $this->step['fields'][$field['index']]['error'] = $validate->error;
	}

	/**
	 * Replace parameters with field labels
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	function prep_params($params)
	{
		if ( isset($params[0]) && is_array($params[0]) ) {
			$params = current($params);
		}

		foreach ( $params as $index => $param ) {
			foreach ( $this->step['fields'] as $field ) {
				if ( isset($field['name']) && $field['name'] == $param ) {
					$params[$index] = $field['label'];
				}
			}
		}

		return $params;
	}

	/**
	 * Parse field attributes
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	array
	 * @return	string
	 */
	function parse_attributes($attrs, $default = array())
	{
		$attr = '';

		foreach ( $attrs as $name => $value ) {
			if ( isset($default[$name]) ) {
				$attr .= ' ' . $name . '="' . $default[$name] . ' ' . $value . '"';
				unset($default[$name]);
			}
			else {
				$attr = ' ' . $name . '="' . $value . '"';
			}
		}

		foreach ( $default as $name => $value ) {
			$attr = ' ' . $name . '="' . $value . '"';
		}

		return $attr;
	}

	/**
	 * Run user specified callback
	 *
	 * @access	public
	 * @param	object
	 * @param	array
	 * @return	boolean
	 */
	function run_callback($callbacks, $callback)
	{
		// set default status to false
		$status = false;

		// set parameters
		if ( isset($callback['params']) ) {
			$params = is_array($callback['params']) ? array($callback['params']) : array($callback['params']);
		}
		else {
			$params = array();
		}

		if ( method_exists($callbacks, $callback['name']) ) {
			$status = call_user_func_array(array($callbacks, $callback['name']), $params);
		}
		else {
			$callbacks->error = $callback['name'] . ' callback does not exist.';
		}

		if ( !$status ) {

			// is error message in the language file
			if ( isset($this->language[$callback['name']]) ) {
				$params = $this->prep_params($params);
				$this->vars['error'] = $callbacks->error = call_user_func_array('sprintf', array_merge(array($this->language[$callback['name']]), $params));
			}
			// is error message already set
			elseif ( $callbacks->error ) {
				$this->vars['error'] = $callbacks->error;
			}
			else {
				$this->vars['error'] = $callbacks->error = $callback['name'] . ' callback did not return a successful result.';
			}

			return false;
		}

		return $status;
	}

	/**
	 * Output content
	 *
	 * @access	public
	 */
	function output()
	{
		if ( !@is_file(BASE_PATH . 'views/' . $this->config['view'] . '/view.php') ) {
			die('views/' . $this->config['view'] . '/view.php file was not found.');
		}

		ob_start();

		include BASE_PATH . 'views/' . $this->config['view'] . '/view.php';

		$content = ob_get_contents();
		ob_end_clean();

		echo $content;
	}

	/**
	 * Convert value to bytes
	 *
	 * @access	public
	 */
	function return_bytes($val)
	{
	    $val = strtolower(trim($val));
	    if ( substr($val, -1) == 'b' ) {
	    	$val = substr($val, 0, -1);
		}
	    $last = substr($val, -1);
	    switch ( $last ) {
	        case 'g':
	        case 'gb':
	            $val *= 1024;
	        case 'm':
	        case 'mb':
	            $val *= 1024;
	        case 'k':
	        case 'kb':
	            $val *= 1024;
	    }

	    return $val;
	}

	/**
	 * Redirect
	 *
	 * @access	public
	 * @param	string
	 */
	function redirect($url)
	{
		header('location: ' . $url);
		exit;
	}
}
