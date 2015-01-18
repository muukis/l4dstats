<?php

if (file_exists('../config.php'))
{
	require('../config.php');
}

// The $steps array below contains the exact copy of the steps
// in our online demo at http://www.phpsetupwizard.com/demo
// We left it to help you understand how PHP Setup Wizard works
// Feel free to change it as necessary or simply clean it up and
// create your own $steps array to suit your needs. Enjoy!

$templates_root = '../templates';
$available_templates = null;

if (file_exists($templates_root))
{
	$templates = scandir($templates_root);
	
	foreach ($templates as $key => $template)
	{
		$template_root = $templates_root . '/' . $template;
		$template_file = $template_root . '/template.php';
		
		if (is_dir($template_root) &&
		    !in_array($template, array('.', '..')) &&
		    file_exists($template_file))
		{
			require($template_file);
			$available_templates[$template] = $template_name;
		}
	}
}

$languages_root = '../lang';
$available_languages = null;

if (file_exists($languages_root))
{
	$languages_file_prefix = $languages_root . '/language.';
	$languages_file_prefix_len = strlen($languages_file_prefix);
	$languages_file_postfix = '.php';
	$languages_file_postfix_len = strlen($languages_file_postfix);
	
	foreach (glob($languages_file_prefix . '*' . $languages_file_postfix) as $language_filename)
	{
		$languages_id = substr($language_filename, $languages_file_prefix_len);
		$languages_id = substr($languages_id, 0, $languages_file_postfix_len * -1);
		$languages_id = strtolower($languages_id);

		require($language_filename);
		$available_languages[$languages_id] = $lang_name;
	}
}

$steps = array(

	// Step 2
	array(
		// Step name
		'name' => 'Server requirements',

		// Items we're going to display
		'fields' => array(

			// text1
			array(
				'type' => 'info',
				'value' => 'Before proceeding with the full installation, we will carry out some tests on your server configuration to ensure that you are able to install and run L4DStats.
				Please ensure you read through the results thoroughly and do not proceed until all the required tests are passed.',
			),

			// Check PHP configuration
			array(
				'type' => 'php-config',
				'label' => 'Required PHP settings',
				'items' => array(
					'php_version' => array('>=4.0', 'PHP Version'), // PHP version must be at least 4.0
					'short_open_tag' => null, // Display the value for "short_open_tag" setting
					'register_globals' => false, // "register_globals" must be disabled
					'safe_mode' => false, // "safe_mode" must be disabled
					'upload_max_filesize' => '>=2mb', // "upload_max_filesize" must be at least 2mb
				),
			),

			// Check loaded PHP modules
			array(
				'type' => 'php-modules',
				'label' => 'Required PHP modules',
				'items' => array(
					'mysql' => array(true, 'MySQL'), // make sure "mysql" module is loaded
					'curl' => array(true, 'cURL'), // make sure "curl" module is loaded
				),
			),

		),
	),

	// Step 3
	array(
		// Step name
		'name' => 'Database settings',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'Specify your database settings here. Please note that the database for L4DStats must be created prior to this step. If you have not created one yet, do so now.',
			),

			// Select box
			array(
				'label' => 'Skip database installation',
				'name' => 'db_skip_install',
				'type' => 'select',
				'selectedvalue' => isset($_SESSION['params']['db_skip_install']) ? ($_SESSION['params']['db_skip_install'] ? 'true' : 'false') : 'false',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => 'Database hostname',
				'name' => 'db_hostname',
				'type' => 'text',
				'default' => isset($mysql_server) ? $mysql_server : '',
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => 'Database username',
				'name' => 'db_username',
				'type' => 'text',
				'default' => '',
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => 'Database password',
				'name' => 'db_password',
				'type' => 'text',
				'default' => '',
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => 'Database table prefix',
				'name' => 'db_prefix',
				'type' => 'text',
				'default' => isset($mysql_tableprefix) ? $mysql_tableprefix : '',
			),

			// Text box
			array(
				'label' => 'Database name',
				'name' => 'db_name',
				'type' => 'text',
				'default' => isset($mysql_db) ? $mysql_db : '',
				'highlight_on_error' => false,
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
					array(
						'rule' => 'database', // system will automatically verify database connection details based on the provided values
						'params' => array(
							'db_skip' => 'db_skip_install',
							'db_host' => 'db_hostname',
							'db_user' => 'db_username',
							'db_pass' => 'db_password',
							'db_prefix' => 'db_prefix',
							'db_name' => 'db_name'
						)
					),
				),
			),
		),
	),

	// Step 3
	array(
		// Step name
		'name' => 'Website settings',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'Specify your Custom Player Stats site settings. These settings modify the look and feel of your web site.',
			),

			// Text box
			array(
				'label' => 'Site Name',
				'name' => 'serv_sitename',
				'type' => 'text',
				'default' => isset($site_name) ? $site_name : 'My Custom Player Stats Web Site',
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'Site template',
				'name' => 'serv_sitetemplate',
				'type' => 'select',
				'selectedvalue' => isset($default_site_template) ? $default_site_template : 'left4dead',
				'items' => $available_templates,
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),
			
			// Select box
			array(
				'label' => 'Default language',
				'name' => 'language',
				'type' => 'select',
				'selectedvalue' => isset($default_lang) ? $default_lang : 'en',
				'items' => $available_languages,
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'Display only city results',
				'name' => 'serv_pop_cities',
				'type' => 'select',
				'selectedvalue' => isset($population_cities) ? ($population_cities ? 'true' : 'false') : 'true',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'Show the timed maps',
				'name' => 'serv_time_maps',
				'type' => 'select',
				'selectedvalue' => isset($timedmaps_show_all) ? ($timedmaps_show_all ? 'true' : 'false') : 'true',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'Allow reading Steam profile',
				'name' => 'serv_steam_profile',
				'type' => 'select',
				'selectedvalue' => isset($steam_profile_read) ? ($steam_profile_read ? 'true' : 'false') : 'true',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'Show player avatars',
				'name' => 'serv_avatars',
				'type' => 'select',
				'selectedvalue' => isset($players_avatars_show) ? ($players_avatars_show ? 'true' : 'false') : 'false',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'Show players online avatar',
				'name' => 'serv_online_avatars',
				'type' => 'select',
				'selectedvalue' => isset($players_online_avatars_show) ? ($players_online_avatars_show ? 'true' : 'false') : 'false',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'Show MOTD',
				'name' => 'serv_motd',
				'type' => 'select',
				'selectedvalue' => isset($show_motd) ? ($show_motd ? 'true' : 'false') : 'true',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'Game version',
				'name' => 'game_ver',
				'type' => 'select',
				'selectedvalue' => isset($game_version) ? $game_version : '0',
				'items' => array(
					'0' => 'L4D & L4D2',
					'1' => 'Left 4 Dead',
					'2' => 'Left 4 Dead 2'
				),
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'XML player profile',
				'name' => 'serv_xmlply',
				'type' => 'select',
				'selectedvalue' => isset($xml_ply_profile) ? ($xml_ply_profile ? 'true' : 'false') : 'false',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'highlight_on_error' => false,
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => 'SOAP API enabled',
				'name' => 'serv_soap',
				'type' => 'select',
				'selectedvalue' => isset($enable_soap) ? ($enable_soap ? 'true' : 'false') : 'true',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'required' => 'true',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),
		),
	),

	// Step 4
	array(
		// Step name
		'name' => 'Ready to install',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'We are now ready to proceed with installation. At this step we will attempt to create all required tables and populate them with data. Should something go wrong, go back to the Database Settings step and make sure everything is correct.',
			),
		),

		// Callback functions that will be executed
		'callbacks' => array(
			array('name' => 'install'), // run "install" function the "includes/callbacks.php" file upon successful form submission
		),
	),

	// Step 5
	array(
		// Step name
		'name' => 'Completed',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'Installation complete!',
			),

			// Simple text
			array(
				'type' => 'info',
				'value' => '<a href="javascript:location.reload();">Reload page</a> to open your Custom Player Stats web site.',
			),
		),
	),
);
