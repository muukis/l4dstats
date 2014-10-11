<?php

// The $steps array below contains the exact copy of the steps
// in our online demo at http://www.phpsetupwizard.com/demo
// We left it to help you understand how PHP Setup Wizard works
// Feel free to change it as necessary or simply clean it up and
// create your own $steps array to suit your needs. Enjoy!

$steps = array(

	// Step 1
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

	// Step 2
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

			// Text box
			array(
				'label' => '<span style="color:red">*</span>Database hostname',
				'name' => 'db_hostname',
				'type' => 'text',
				'default' => 'localhost',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => '<span style="color:red">*</span>Database username',
				'name' => 'db_username',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => '<span style="color:red">*</span>Database password',
				'name' => 'db_password',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => '<span style="color:red">*</span>Database name',
				'name' => 'db_name',
				'type' => 'text',
				'default' => '',
				'highlight_on_error' => false,
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => 'Database prefix',
				'name' => 'db_prefix',
				'type' => 'text',
				'default' => '',
			),

			// Select box
			array(
				'label' => '<span style="color:red">*</span>Database Engine',
				'name' => 'db_engine',
				'type' => 'select',
				'default' => 'InnoDB',
				'items' => array(
					'InnoDB' => 'InnoDB',
					'MyISAM' => 'MyISAM',
				),
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Simple text
			array(
				'type' => 'header',
				'value' => 'L4Dstats information',
			),

			// Text box
			array(
				'label' => '<span style="color:red">*</span>Site Name',
				'name' => 'serv_sitename',
				'type' => 'text',
				'default' => 'My L4DStats Page',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => '<span style="color:red">*</span>Display only City results',
				'name' => 'serv_pop_cities',
				'type' => 'select',
				'default' => 'false',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => '<span style="color:red">*</span>Show the timed maps',
				'name' => 'serv_time_maps',
				'type' => 'select',
				'default' => 'false',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => '<span style="color:red">*</span>Allow reading Steam profile',
				'name' => 'serv_steam_profile',
				'type' => 'select',
				'default' => 'true',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => '<span style="color:red">*</span>Show player avatars',
				'name' => 'serv_avatars',
				'type' => 'select',
				'default' => 'true',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => '<span style="color:red">*</span>Show players online avatar',
				'name' => 'serv_online_avatars',
				'type' => 'select',
				'default' => 'true',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => '<span style="color:red">*</span>Show Motd',
				'name' => 'serv_motd',
				'type' => 'select',
				'default' => 'true',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

	/*
		The Commented language settings are on the works.
	*/

			// Select box
			array(
				'label' => '<span style="color:red">*</span>Select Language',
				'name' => 'language',
				'type' => 'select',
				'default' => 'en',
				'items' => array(
					'en' => 'English',
					'fi' => 'Finnish',
				//	'no' => 'Norwegian',
					'ru' => 'Russian',
				//	'se' => 'Swedish',
				),
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => '',
				'name' => 'webstats_ver',
				'type' => 'text_hidden',
				'default' => '1.2',
				'value' => '1.2',
			),

			// Select box
			array(
				'label' => '<span style="color:red">*</span>Game Version',
				'name' => 'game_ver',
				'type' => 'select',
				'default' => '2',
				'items' => array(
					'0' => 'L4D & L4D2',
					'1' => 'Left 4 Dead',
					'2' => 'Left 4 Dead 2'
				),
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Select box
			array(
				'label' => '<span style="color:red">*</span>XML player profile',
				'name' => 'serv_xmlply',
				'type' => 'select',
				'default' => 'false',
				'items' => array(
					'false' => 'False',
					'true' => 'True'
				),
				'highlight_on_error' => false,
				'validate' => array(
					array('rule' => 'required'), // make it "required"
					array(
						'rule' => 'database', // system will automatically verify database connection details based on the provided values
						'params' => array(
							'serv_sn' => 'serv_sitename',
							'serv_pci' => 'serv_pop_cities',
							'serv_tm' => 'serv_time_maps',
							'serv_stprf' => 'serv_steam_profile',
							'serv_avis' => 'serv_avatars',
							'serv_onavi' => 'serv_online_avatars',
							'serv_mtd' => 'serv_motd',
							'serv_xpl' => 'serv_xmlply',
							'language' => 'language',
							'game_ver' => 'game_ver',
							'web_ver' => 'webstats_ver',
							'db_host' => 'db_hostname',
							'db_user' => 'db_username',
							'db_pass' => 'db_password',
							'db_prefix' => 'db_prefix',
							'db_engine' => 'db_engine',
							'db_name' => 'db_name'
						)
					),
				),
			),
		),
		'callbacks' => array(
			array(
				'name' => 'is_installed',
				'execute' => 'before',
				'params' => array('webstats_ver' => '1.2')
			),
		),
	),

	// Step 3
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

	// Step 4
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
				'value' => 'If something went wrong under installation, and you want to re-install L4D2Stats, be sure to remove the file installation_setup.txt that got created.',
			),
		),
	),
);
