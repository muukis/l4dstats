<?php

/**
* Callbacks class
*/
class Callbacks extends Callbacks_Core
{
	function is_installed($params = array())
	{
		if ( is_file(BASE_PATH . '../installation_setup.txt') ) {

			$this->error = 'Webstats already appears to be installed.';
			return false;
		}
		return true;
	} 
	function install($params = array())
	{
		$dbconf = array(
			// Database Connection
			'db_host' => $_SESSION['params']['db_hostname'],
			'db_user' => $_SESSION['params']['db_username'],
			'db_pass' => $_SESSION['params']['db_password'],
			'db_prefix' => $_SESSION['params']['db_prefix'],
			'db_name' => $_SESSION['params']['db_name'],
			'db_engine' => $_SESSION['params']['db_engine'],
			'db_encoding' => 'utf8',
			// Web Configs
			'serv_sn' => $_SESSION['params']['serv_sitename'],
			'serv_pci' => $_SESSION['params']['serv_pop_cities'],
			'serv_xpl' => $_SESSION['params']['serv_xmlply'],
			'serv_tm' => $_SESSION['params']['serv_time_maps'],
			'serv_stprf' => $_SESSION['params']['serv_steam_profile'],
			'serv_avis' => $_SESSION['params']['serv_avatars'],
			'serv_onavi' => $_SESSION['params']['serv_online_avatars'],
			'serv_mtd' => $_SESSION['params']['serv_motd'],
			// Misc
			'language' => $_SESSION['params']['language'],
			'game_ver' => $_SESSION['params']['game_ver'],
			// WebStats Version
			'web_ver' => $_SESSION['params']['webstats_ver'],
		);
		if ( !$this->db_init($dbconf) ) {
			return false;
		}

		$replace = array(
			'{:db_prefix}' => $_SESSION['params']['db_prefix'],
			'{:db_engine}' => $_SESSION['params']['db_engine'],
			'{:db_charset}' => $this->db_version >= '4.1' ? 'DEFAULT CHARSET=utf8' : '',
			'{:website}' => $_SESSION['params']['virtual_path']
		);

		if ( !$this->db_import_file(BASE_PATH.'sql/data.sql', $replace) ) {
			return false;
		}

		if ( $_SESSION['params']['game_ver'] == 0 )
		{
			if ( !$this->db_import_file(BASE_PATH.'sql/l4d.sql', $replace) ) {
				return false;
			}
			if ( !$this->db_import_file(BASE_PATH.'sql/l4d2.sql', $replace) ) {
				return false;
			}
		}
		elseif ( $_SESSION['params']['game_ver'] == 1 )
		{
			if ( !$this->db_import_file(BASE_PATH.'sql/l4d.sql', $replace) ) {
				return false;
			}
		}
		elseif ( $_SESSION['params']['game_ver'] == 2 )
		{
			if ( !$this->db_import_file(BASE_PATH.'sql/l4d2.sql', $replace) ) {
				return false;
			}
		}

		$config_file = '<?php'."\n";;
		$config_file .= '/*'."\n";
		$config_file .= '================================================'."\n";
		$config_file .= 'LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK'."\n";
		$config_file .= 'Copyright (c) 2010 Mikko Andersson'."\n";
		$config_file .= '================================================'."\n";
		$config_file .= 'Configuration file - "config.php"'."\n";
		$config_file .= '================================================'."\n";
		$config_file .= '*/'."\n\n";

		$config_file .= '// Don\'t edit this if you don\'t want to re-install again.'."\n";
		$config_file .= '$l4dstats_web_installed = true;'."\n\n";

		$config_file .= '$mysql_server = \'' . addslashes($_SESSION['params']['db_hostname']) . '\';'."\n";
		$config_file .= '$mysql_user = \'' . addslashes($_SESSION['params']['db_username']) . '\';'."\n";
		$config_file .= '$mysql_password = \'' . addslashes($_SESSION['params']['db_password']) . '\';'."\n";
		$config_file .= '$mysql_db = \'' . addslashes($_SESSION['params']['db_name']) . '\';'."\n";
		$config_file .= '$mysql_tableprefix = \'' . addslashes($_SESSION['params']['db_prefix']) . '\';'."\n\n";

		$config_file .= '// MySQL information for IP to Country DB'."\n";
		$config_file .= '// Fill this information only if a separate database is used'."\n";
		$config_file .= '$mysql_ip2c_server = \'\';'."\n";
		$config_file .= '$mysql_ip2c_user = \'\';'."\n";
		$config_file .= '$mysql_ip2c_password = \'\';'."\n";
		$config_file .= '$mysql_ip2c_db = \'\';'."\n";
		$config_file .= '$mysql_ip2c_tableprefix = \'\';'."\n\n";

		$config_file .= '// Heading for the stats page.'."\n";
		$config_file .= '$site_name = \'' . addslashes($_SESSION['params']['serv_sitename']) . '\';'."\n\n";
		$config_file .= '// Game server address (adds a Steam connection link over the site name)'."\n";
		$config_file .= '// Multiple game server addresses supported (just write multiple configurations and use the correct syntax for each of them)'."\n";
		$config_file .= '/* THIS LINE: DO NOT MODIFY OR REMOVE */ $game_addresses = array();'."\n";
		$config_file .= '// Syntax:'."\n";
		$config_file .= '//   $game_addresses[] = array("<NAME>", "<ADDRESS>[:<PORT>]");'."\n";
		$config_file .= '// Examples:'."\n";
		$config_file .= '//   $game_addresses[] = array("Server 1: Left 4 Dead 2", "my.site.net:27016");'."\n";
		$config_file .= '//   $game_addresses[] = array("Server 2: Kill Them Zombies", "123.0.0.234");'."\n\n";

		$config_file .= '// Supported game versions'."\n";
		$config_file .= '// 0 = Support both L4D1 and L4D2'."\n";
		$config_file .= '// 1 = Left 4 Dead 1 (default)'."\n";
		$config_file .= '// 2 = Left 4 Dead 2'."\n";
		$config_file .= '$game_version = ' . addslashes($_SESSION['params']['game_ver']) . ';'."\n\n";

		$config_file .= '// WebStats Version'."\n";
		$config_file .= '// Do not edit!'."\n";
		$config_file .= '$webstats_version = ' . addslashes($_SESSION['params']['webstats_ver']) . ';'."\n\n";

		$config_file .= '// Template for the stats page.'."\n";
		$config_file .= '// Leave empty if the default template is used.'."\n";
		$config_file .= '// Usage: "mytemplate" (requires directory ./templates/mytemplate existence)'."\n";
		$config_file .= '$default_site_template = \'\';'."\n\n";

		$config_file .= '// Language settings'."\n";
		$config_file .= '// Default: en, fi, ru, se'."\n";
		$config_file .= '$default_lang = \'' . addslashes($_SESSION['params']['language']) . '\';'."\n\n";

		$config_file .= '// XML player profile'."\n";
		$config_file .= '// Leave empty or write false to disable it (disabled by default)'."\n";
		$config_file .= '// Usage:'."\n";
		$config_file .= '//		true - enabled'."\n";
		$config_file .= '//		null/false - disabled'."\n";
		$config_file .= '$xml_ply_profile = ' . addslashes($_SESSION['params']['serv_xmlply']) . ';'."\n\n";

		$config_file .= '// Award definitions file'."\n";
		$config_file .= '$award_file = \'awards.en.php\';'."\n";
		$config_file .= '$award_l4d2_file = \'awards.l4d2.en.php\';'."\n\n";

		$config_file .= '// Refresh interval (seconds) for the front page (index.php)'."\n";
		$config_file .= '// 0 = disabled'."\n";
		$config_file .= '$stats_refreshinterval = 0;'."\n\n";

		$config_file .= '// Minimum playtime and points required to be eligible for any awards, in minutes'."\n";
		$config_file .= '$award_minplaytime = 60;'."\n";
		$config_file .= '$award_minpointstotal = 0;'."\n\n";

		$config_file .= '// Minimum kills, headshots and points to be eligible for "Headshot Ratio" award\';'."\n";
		$config_file .= '$award_minkills = 100;'."\n";
		$config_file .= '$award_minheadshots = 100;'."\n";
		$config_file .= '$award_minpoints = 1000;'."\n\n";

		$config_file .= '// How many top players would you like to show on the awards page on each award?'."\n";
		$config_file .= '// Note! You should set this value to at least 1.'."\n";
		$config_file .= '$award_display_players = 3;'."\n\n";

		$config_file .= '// Amount of time in minutes between Awards page cache updates.'."\n";
		$config_file .= '// 0 to disable cacheing'."\n";
		$config_file .= '$award_cache_refresh = 60;'."\n\n";

		$config_file .= '// Database time modifier (hours)'."\n";
		$config_file .= '// 0 if the db time is the same as the websites'."\n";
		$config_file .= '$dbtimemod = 0;'."\n\n";

		$config_file .= '// Date format for player last online time'."\n";
		$config_file .= '// http://www.php.net/manual/en/function.date.php'."\n";
		$config_file .= '// Example: 24h - "M d, Y H:i";'."\n";
		$config_file .= '$lastonlineformat = \'M d, Y g:ia\';'."\n\n";

		$config_file .= '// Show player flags next to their names based on their IP'."\n";
		$config_file .= '// 0 to disable'."\n";
		$config_file .= '// Installation instructions:'."\n";
		$config_file .= '//   1. Download and extract http://www.maxmind.com/download/geoip/database/GeoIPCountryCSV.zip to web stats root (same folder as updatetable.php)'."\n";
		$config_file .= '//   2. Execute install.php (use a web browser) - BE PATIENT AND WAIT FOR THE EXECUTION TO FINISH!'."\n";
		$config_file .= '//   3. Delete files GeoIPCountryCSV.zip and GeoIPCountryWhois.csv when installation is successful'."\n";
		$config_file .= '$showplayerflags = 0;'."\n\n";

		$config_file .= '// Show player city name next to their flag and country name (player.php) based on their IP (has no effect when $showplayerflags = 0)'."\n";
		$config_file .= '// 0 to disable'."\n";
		$config_file .= '// Installation instructions:'."\n";
		$config_file .= '//   1. Download latest GeoLiteCity_YYYYMMDD.zip from http://www.maxmind.com/app/geolitecity and extract the files to web stats root (same folder as updatetable.php)'."\n";
		$config_file .= '//   2. Execute install.php (use a web browser) - BE PATIENT AND WAIT FOR THE EXECUTION TO FINISH!'."\n";
		$config_file .= '//   3. Delete files GeoLiteCity_YYYYMMDD.zip and GeoIPCountryWhois.csv when installation is successful'."\n";
		$config_file .= '$showplayercity = 0;'."\n\n";

		$config_file .= '// Google Maps (player.php) additional URL parameters (URL postfix)'."\n";
		$config_file .= '// Default: "&t=h&z=5"'."\n";
		$config_file .= '//   Examples: (there is more!)'."\n";
		$config_file .= '//     t => h = Satellite with labels / k = Satellite without labels / p = Terrain'."\n";
		$config_file .= '//     lci => com.panoramio.all = Photos / org.wikipedia.en = Wikipedia / com.youtube.all = Videos (combined with comma)'."\n";
		$config_file .= '// Try out the usable parameters yourself'."\n";
		$config_file .= '$googlemaps_addparam = \'&t=h&z=5\';'."\n\n";

		$config_file .= '// Show Google Maps at the index.php'."\n";
		$config_file .= '$showmap = true;'."\n\n";

		$config_file .= '// Show Google Maps (index.php) location for the first # players online (useful when web stats hosts multiple game servers)'."\n";
		$config_file .= '// 0 to show all players'."\n";
		$config_file .= '$googlemaps_showplayersonlinecount = 0;'."\n\n";

		$config_file .= '// Google Maps (index.php) players online additional URL parameters (URL postfix)'."\n";
		$config_file .= '// Default: "&size=600x300&maptype=satellite&sensor=false"'."\n";
		$config_file .= '$googlemaps_playersonline_addparam = \'&size=600x300&maptype=satellite&sensor=false\';'."\n\n";

		$config_file .= '// Google Maps (index.php) zoom when only one players online (or only server is displayed)'."\n";
		$config_file .= '$googlemaps_playersonline_zoom = 3;'."\n\n";

		$config_file .= '/*'."\n";
		$config_file .= 'Population CSV file. This is taken from the United States Census Bureau, you'."\n";
		$config_file .= 'can download a (possibly) more up-to-date file from this URL:'."\n\n";

		$config_file .= 'http://www.census.gov/popest/datasets.html'."\n\n";

		$config_file .= 'The file will be about half way down, under "Metropolitan, micropolitan, and'."\n";
		$config_file .= 'combined statistical area datasets", the CSV file under "Combined'."\n";
		$config_file .= 'statistical area population and estimated components of change". Or, check'."\n";
		$config_file .= 'the release thread and I can provide an exact URL for the download.'."\n\n";

		$config_file .= 'Keep in mind that the file has been drastically altered from it\'s original'."\n";
		$config_file .= 'state, including adding individual States as well as the entire US. If you'."\n";
		$config_file .= 'want to create your own CSV file, message me on Allied Modders and I will'."\n";
		$config_file .= 'help and possibly include it in a next release.'."\n";
		$config_file .= '*/'."\n\n";

		$config_file .= '$population_file = \'population.usa.csv\';'."\n\n";

		$config_file .= '/*'."\n";
		$config_file .= 'Only display City results, and not Counties. Note: This will drastically'."\n";
		$config_file .= 'reduce the uniqueness of the results, cities only make up about 1/3rd of'."\n";
		$config_file .= 'the list. Set to True to enable. Default is False.'."\n\n";

		$config_file .= 'Also note, the minimum kills if you are using only citites needs to be'."\n";
		$config_file .= '14000 or else you will get erroneous results! Default is 3000.'."\n";
		$config_file .= '*/'."\n\n";

		$config_file .= '$population_minkills = 3000;'."\n";
		$config_file .= '$population_cities = ' . addslashes($_SESSION['params']['serv_pop_cities']) . ';'."\n\n";

		$config_file .= '// Show/hide link for the timed maps (also disables the page for parameterless use)'."\n";
		$config_file .= '$timedmaps_show_all = ' . addslashes($_SESSION['params']['serv_time_maps']) . ';'."\n\n";

		$config_file .= '// Allow reading of player Steam profile (overrides all avatar related if set to False)'."\n";
		$config_file .= '// Warning! Setting value to true can slow loading of some pages.'."\n";
		$config_file .= '$steam_profile_read = ' . addslashes($_SESSION['params']['serv_steam_profile']) . ';'."\n\n";

		$config_file .= '// Show/hide player avatars (overrides all other avatar related if set to False)'."\n";
		$config_file .= '$players_avatars_show = ' . addslashes($_SESSION['params']['serv_avatars']) . ';'."\n";

		$config_file .= '// Show/hide online player avatars'."\n";
		$config_file .= '// Warning! Setting value to true will slow down the index page some, depending how'."\n";
		$config_file .= '// many players are currently online.'."\n";
		$config_file .= '$players_online_avatars_show = ' . addslashes($_SESSION['params']['serv_online_avatars']) . ';'."\n\n";

		$config_file .= '// Number of players to show additional info at Top 10 -players list (set to 0 to disable)'."\n";
		$config_file .= '// Shows player avatar and some other information.'."\n";
		$config_file .= '// Warning! Setting a number higher than 0 (zero) will slow every page load a little.'."\n";
		$config_file .= '$top10players_additional_info = 0;'."\n\n";

		$config_file .= '// Show Message Of The Day in each page'."\n";
		$config_file .= '$show_motd = ' . addslashes($_SESSION['params']['serv_motd']) . ';'."\n";
		$config_file .= '?>';

		$installation_file = '================================================='."\n";;
		$installation_file .= 'This is an automated file.'."\n";
		$installation_file .= 'NOTE: Delete this file to re-install L4DStats.'."\n";
		$installation_file .= '================================================='."\n\n";

		$installation_file .= 'WebStats Version: ' . addslashes($_SESSION['params']['webstats_ver']) . ''."\n";

		@file_put_contents('../config.php', $config_file);

		@file_put_contents('../installation_setup.txt', $installation_file);

		return true;
	}

}
