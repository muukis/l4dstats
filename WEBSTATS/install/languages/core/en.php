<?php

$language = array(
	// general
	'language_name' 		=> "English",
	'select_language'	 	=> "Select your preferred language",

	// general validation rules
	'required' 				=> "The %s field is required.",
	'valid_email'			=> "The %s field must contain a valid email address.",
	'valid_emails' 			=> "The %s field must contain all valid email addresses.",
	'valid_ip' 				=> "The %s field must contain a valid IP.",
	'min_length'			=> "The %s field must be at least %s characters in length.",
	'max_length'			=> "The %s field can not exceed %s characters in length.",
	'exact_length'			=> "The %s field must be exactly %s characters in length.",
	'min_value'				=> "The %s field must be greater or equal to %s.",
	'max_value'				=> "The %s field must be less or equal to %s.",
	'exact_value'			=> "The %s field must be equal to %s.",
	'alpha'					=> "The %s field may only contain alphabetical characters.",
	'alpha_numeric'			=> "The %s field may only contain alpha-numeric characters.",
	'alpha_dash'			=> "The %s field may only contain alpha-numeric characters, underscores, and dashes.",
	'numeric'				=> "The %s field must contain a number.",
	'is_numeric'			=> "The %s field must contain a number.",
	'integer'				=> "The %s field must contain an integer.",
	'matches'				=> "The %s field does not match the %s field.",
	'is_natural'			=> "The %s field must contain a number.",
	'is_natural_no_zero'	=> "The %s field must contain a number greater than zero.",

	// file validation rules
	'is_dir'				=> "The %s field must contain a valid folder path.",
	'is_file'				=> "The %s field must contain a valid file path.",
	'is_writable'			=> "The %s folder or file must be writable.",

	// database validation rules
	'db_params'				=> "MySQL parameters in the validation rule are not valid.",
	'db_connect'			=> "Could not connect to MySQL database.",
	'db_select'				=> "Connection with MySQL has been established, however specified database could not be selected.",
	'db_error'				=> "Database error: %s",
	'db_error_query'		=> "Database error: %s <br/><br/>Query: %s",
	'db_batch'				=> "Database batch query is not formatted properly.",
	'db_file'				=> "Database file %s does not exist or is not readable.",

	// configuration and comparison rules
	'config_pass'			=> "OK!",
	'config_fail'			=> "Failed",
	'config_yes'			=> "Yes",
	'config_no'				=> "No",
	'config_available'		=> "Available",
	'config_unavailable'	=> "Not available",
	'config_greater_eq'		=> "The %s setting must be greater than or equal to %s.",
	'config_less_eq'		=> "The %s setting must be less than or equal to %s.",
	'config_greater'		=> "The %s setting must be greater than %s.",
	'config_less'			=> "The %s setting must be less than %s.",
	'config_eq'				=> "The %s setting must be equal to %s.",
	'config_php_error'		=> "Your PHP configuration does not seem to match the requirements. Please correct the errors before you continue.",

	// file and folder permission rules
	'config_file_error'		=> "Your file permissions do not seem to match the requirements. Please correct the errors before you continue.",
	'config_writable'		=> "Writable",
	'config_file_none'		=> "File does not exist.",
	'config_folder_none'	=> "Folder does not exist.",
	'config_write_file'		=> "File is not writable.",
	'config_write_folder'	=> "Folder is not writable.",
	'config_readable'		=> "Readable",
	'config_read_file'		=> "File is not readable or does not exist.",
	'config_read_folder'	=> "Folder is not readable or does not exist.",
);
