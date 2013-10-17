<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Configuration file - "config.php"
================================================
*/

// MySQL information for L4D Stats DB
$mysql_server = "127.0.0.1";
$mysql_db = "l4dstats";
$mysql_user = "l4d";
$mysql_password = "l4d";
$mysql_tableprefix = "";

// MySQL information for IP to Country DB
// Fill this information only if a separate database is used
$mysql_ip2c_server = "";
$mysql_ip2c_db = "";
$mysql_ip2c_user = "";
$mysql_ip2c_password = "";
$mysql_ip2c_tableprefix = "";

// Heading for the stats page.
$site_name = "YOUR SITE NAME HERE";

// Game server address (adds a Steam connection link over the site name)
// Multiple game server addresses supported (just write multiple configurations and use the correct syntax for each of them)
/* THIS LINE: DO NOT MODIFY OR REMOVE */ $game_addresses = array();
// Syntax:
//   $game_addresses[] = array("<NAME>", "<ADDRESS>[:<PORT>]");
// Examples:
//   $game_addresses[] = array("Server 1: Left 4 Dead 2", "my.site.net:27016");
//   $game_addresses[] = array("Server 2: Kill Them Zombies", "123.0.0.234");

// Supported game versions
// 0 = Support both L4D1 and L4D2
// 1 = Left 4 Dead 1 (default)
// 2 = Left 4 Dead 2
$game_version = 2;

// Language settings
// Default: en, se
$default_lang = "en";

// XML player profile
// Leave empty or write false to disable it (disabled by default)
// Usage:
//		true - enabled
//		null/false - disabled
$xml_ply_profile = false;

// Award definitions file
$award_file = "awards.en.php";
$award_l4d2_file = "awards.l4d2.en.php";

// Refresh interval (seconds) for the front page (index.php)
// 0 = disabled
$stats_refreshinterval = 0;

// Minimum playtime and points required to be eligible for any awards, in minutes
$award_minplaytime = 60;
$award_minpointstotal = 0;

// Minimum kills, headshots and points to be eligible for "Headshot Ratio" award
$award_minkills = 100;
$award_minheadshots = 100;
$award_minpoints = 1000;

// How many top players would you like to show on the awards page on each award?
// Note! You should set this value to at least 1.
$award_display_players = 3;

// Amount of time in minutes between Awards page cache updates.
// 0 to disable cacheing
$award_cache_refresh = 60;

// Database time modifier (hours)
// 0 if the db time is the same as the websites
$dbtimemod = 0;

// Date format for player last online time
// http://www.php.net/manual/en/function.date.php
// Example: 24h - "M d, Y H:i";
$lastonlineformat = "M d, Y g:ia";

// Show player flags next to their names based on their IP
// 0 to disable
// Installation instructions:
//   1. Download and extract http://www.maxmind.com/download/geoip/database/GeoIPCountryCSV.zip to web stats root (same folder as updatetable.php)
//   2. Execute install.php (use a web browser) - BE PATIENT AND WAIT FOR THE EXECUTION TO FINISH!
//   3. Delete files GeoIPCountryCSV.zip and GeoIPCountryWhois.csv when installation is successful
$showplayerflags = 0;

// Show player city name next to their flag and country name (player.php) based on their IP (has no effect when $showplayerflags = 0)
// 0 to disable
// Installation instructions:
//   1. Download latest GeoLiteCity_YYYYMMDD.zip from http://www.maxmind.com/app/geolitecity and extract the files to web stats root (same folder as updatetable.php)
//   2. Execute install.php (use a web browser) - BE PATIENT AND WAIT FOR THE EXECUTION TO FINISH!
//   3. Delete files GeoLiteCity_YYYYMMDD.zip, GeoLiteCity-Blocks.csv and GeoLiteCity-Location.csv when installation is successful
$showplayercity = 0;

// Google Maps (player.php) additional URL parameters (URL postfix)
// Default: "&t=h&z=5"
//   Examples: (there is more!)
//     t => h = Satellite with labels / k = Satellite without labels / p = Terrain
//     z => Zoom factor
//     lci => com.panoramio.all = Photos / org.wikipedia.en = Wikipedia / com.youtube.all = Videos (combined with comma)
// Try out the usable parameters yourself
$googlemaps_addparam = "&t=h&z=5";

// Show Google Maps at the index.php
$showmap = true;

// Google Maps (index.php) API key (get yours from http://code.google.com/apis/maps/signup.html)
// No longer required... waiting for deletion
//$googlemaps_apikey = "";

// Show Google Maps (index.php) location for the first # players online (useful when web stats hosts multiple game servers)
// 0 to show all players
$googlemaps_showplayersonlinecount = 0;

// Google Maps (index.php) players online additional URL parameters (URL postfix)
// Default: "&size=600x300&maptype=satellite&sensor=false"
$googlemaps_playersonline_addparam = "&size=600x300&maptype=satellite&sensor=false";

// Google Maps (index.php) zoom when only one players online (or only server is displayed)
$googlemaps_playersonline_zoom = 3;

/*
Population CSV file. This is taken from the United States Census Bureau, you
can download a (possibly) more up-to-date file from this URL:

http://www.census.gov/popest/datasets.html

The file will be about half way down, under "Metropolitan, micropolitan, and
combined statistical area datasets", the CSV file under "Combined
statistical area population and estimated components of change". Or, check
the release thread and I can provide an exact URL for the download.

Keep in mind that the file has been drastically altered from it's original
state, including adding individual States as well as the entire US. If you
want to create your own CSV file, message me on Allied Modders and I will
help and possibly include it in a next release.
*/

$population_file = "population.usa.csv";

/*
Only display City results, and not Counties. Note: This will drastically
reduce the uniqueness of the results, cities only make up about 1/3rd of
the list. Set to True to enable. Default is False.

Also note, the minimum kills if you are using only citites needs to be
14000 or else you will get erroneous results! Default is 3000.
*/

$population_minkills = 3000;
$population_cities = False;

// Show/hide link for the timed maps (also disables the page for parameterless use)
$timedmaps_show_all = False;

// Allow reading of player Steam profile (overrides all avatar related if set to False)
// Warning! Setting value to true can slow loading of some pages.
$steam_profile_read = True;

// Show/hide player avatars (overrides all other avatar related if set to False)
$players_avatars_show = True;

// Show/hide online player avatars
// Warning! Setting value to true will slow down the index page some, depending how
// many players are currently online.
$players_online_avatars_show = False;

// Number of players to show additional info at Top 10 -players list (set to 0 to disable)
// Shows player avatar and some other information.
// Warning! Setting a number higher than 0 (zero) will slow every page load a little.
$top10players_additional_info = 0;

// Show Message Of The Day in each page
$show_motd = True;
?>
