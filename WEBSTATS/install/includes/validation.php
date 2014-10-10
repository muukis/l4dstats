<?php

/**
* Validation class
*/
class Validation extends Validation_Core
{
	// These function are part of the default $steps array to help you
	// illustrate how this script works. Feel free to delete them.

	function validate_license($value, $params = array())
	{
		if ( strcmp('1234-1234-1234-1234', $value) != 0 ) {
			return false;
		}
		return true;
	}

	function validate_system_path($value, $params = array())
	{
		if ( !is_file(rtrim($value, '/').'/config.php') || !is_writable(rtrim($value, '/').'/config.php') ) {
			$this->error = rtrim($value, '/').'/config.php file does not exist or is not writeable.';
			return false;
		}

		return true;
	}
}
