<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Table Creation page - "install.php"
================================================
*/

set_time_limit(1200);

// Include the primary PHP functions file
include("./common.php");


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function InsertDefaultMapAllL4D2GameModes($mapname)
{
	InsertDefaultMap($mapname, 0);
	InsertDefaultMap($mapname, 1);
	InsertDefaultMap($mapname, 2);
	InsertDefaultMap($mapname, 3);
	InsertDefaultMap($mapname, 4);
	InsertDefaultMap($mapname, 5);
	InsertDefaultMap($mapname, 6);
}

function InsertDefaultMap($mapname, $gamemode)
{
	global $mysql_tableprefix;
	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('" . $mapname . "', " . $gamemode . ");";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map \"" . $mapname . "\" (gamemode: " . $gamemode . ") inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">Error installing map \"" . $mapname . "\" (gamemode: " . $gamemode . "). Reason: " . mysql_error() . "</font><br />\n";
}

$create_maps = "CREATE TABLE `" . $mysql_tableprefix . "maps` (
  `name` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `gamemode` int(1) NOT NULL default '0',
  `custom` bit(1) NOT NULL default '\0',
  `playtime_nor` int(11) NOT NULL default '0',
  `playtime_adv` int(11) NOT NULL default '0',
  `playtime_exp` int(11) NOT NULL default '0',
  `restarts_nor` int(11) NOT NULL default '0',
  `restarts_adv` int(11) NOT NULL default '0',
  `restarts_exp` int(11) NOT NULL default '0',
  `points_nor` int(11) NOT NULL default '0',
  `points_adv` int(11) NOT NULL default '0',
  `points_exp` int(11) NOT NULL default '0',
  `points_infected_nor` int(11) NOT NULL default '0',
  `points_infected_adv` int(11) NOT NULL default '0',
  `points_infected_exp` int(11) NOT NULL default '0',
  `kills_nor` int(11) NOT NULL default '0',
  `kills_adv` int(11) NOT NULL default '0',
  `kills_exp` int(11) NOT NULL default '0',
  `survivor_kills_nor` int(11) NOT NULL default '0',
  `survivor_kills_adv` int(11) NOT NULL default '0',
  `survivor_kills_exp` int(11) NOT NULL default '0',
  `infected_win_nor` int(11) NOT NULL default '0',
  `infected_win_adv` int(11) NOT NULL default '0',
  `infected_win_exp` int(11) NOT NULL default '0',
  `survivors_win_nor` int(11) NOT NULL default '0',
  `survivors_win_adv` int(11) NOT NULL default '0',
  `survivors_win_exp` int(11) NOT NULL default '0',
  `infected_smoker_damage_nor` bigint(20) NOT NULL default '0',
  `infected_smoker_damage_adv` bigint(20) NOT NULL default '0',
  `infected_smoker_damage_exp` bigint(20) NOT NULL default '0',
  `infected_jockey_damage_nor` bigint(20) NOT NULL default '0',
  `infected_jockey_damage_adv` bigint(20) NOT NULL default '0',
  `infected_jockey_damage_exp` bigint(20) NOT NULL default '0',
  `infected_jockey_ridetime_nor` double NOT NULL default '0',
  `infected_jockey_ridetime_adv` double NOT NULL default '0',
  `infected_jockey_ridetime_exp` double NOT NULL default '0',
  `infected_charger_damage_nor` bigint(20) NOT NULL default '0',
  `infected_charger_damage_adv` bigint(20) NOT NULL default '0',
  `infected_charger_damage_exp` bigint(20) NOT NULL default '0',
  `infected_tank_damage_nor` bigint(20) NOT NULL default '0',
  `infected_tank_damage_adv` bigint(20) NOT NULL default '0',
  `infected_tank_damage_exp` bigint(20) NOT NULL default '0',
  `infected_boomer_vomits_nor` int(11) NOT NULL default '0',
  `infected_boomer_vomits_adv` int(11) NOT NULL default '0',
  `infected_boomer_vomits_exp` int(11) NOT NULL default '0',
  `infected_boomer_blinded_nor` int(11) NOT NULL default '0',
  `infected_boomer_blinded_adv` int(11) NOT NULL default '0',
  `infected_boomer_blinded_exp` int(11) NOT NULL default '0',
  `infected_spitter_damage_nor` int(11) NOT NULL default '0',
  `infected_spitter_damage_adv` int(11) NOT NULL default '0',
  `infected_spitter_damage_exp` int(11) NOT NULL default '0',
  `infected_spawn_1_nor` int(11) NOT NULL default '0' COMMENT 'Spawn as Smoker',
  `infected_spawn_1_adv` int(11) NOT NULL default '0' COMMENT 'Spawn as Smoker',
  `infected_spawn_1_exp` int(11) NOT NULL default '0' COMMENT 'Spawn as Smoker',
  `infected_spawn_2_nor` int(11) NOT NULL default '0' COMMENT 'Spawn as Boomer',
  `infected_spawn_2_adv` int(11) NOT NULL default '0' COMMENT 'Spawn as Boomer',
  `infected_spawn_2_exp` int(11) NOT NULL default '0' COMMENT 'Spawn as Boomer',
  `infected_spawn_3_nor` int(11) NOT NULL default '0' COMMENT 'Spawn as Hunter',
  `infected_spawn_3_adv` int(11) NOT NULL default '0' COMMENT 'Spawn as Hunter',
  `infected_spawn_3_exp` int(11) NOT NULL default '0' COMMENT 'Spawn as Hunter',
  `infected_spawn_4_nor` int(11) NOT NULL default '0' COMMENT 'Spawn as Spitter',
  `infected_spawn_4_adv` int(11) NOT NULL default '0' COMMENT 'Spawn as Spitter',
  `infected_spawn_4_exp` int(11) NOT NULL default '0' COMMENT 'Spawn as Spitter',
  `infected_spawn_5_nor` int(11) NOT NULL default '0' COMMENT 'Spawn as Jockey',
  `infected_spawn_5_adv` int(11) NOT NULL default '0' COMMENT 'Spawn as Jockey',
  `infected_spawn_5_exp` int(11) NOT NULL default '0' COMMENT 'Spawn as Jockey',
  `infected_spawn_6_nor` int(11) NOT NULL default '0' COMMENT 'Spawn as Charger',
  `infected_spawn_6_adv` int(11) NOT NULL default '0' COMMENT 'Spawn as Charger',
  `infected_spawn_6_exp` int(11) NOT NULL default '0' COMMENT 'Spawn as Charger',
  `infected_spawn_8_nor` int(11) NOT NULL default '0' COMMENT 'Spawn as Tank',
  `infected_spawn_8_adv` int(11) NOT NULL default '0' COMMENT 'Spawn as Tank',
  `infected_spawn_8_exp` int(11) NOT NULL default '0' COMMENT 'Spawn as Tank',
  `infected_hunter_pounce_counter_nor` int(11) NOT NULL default '0',
  `infected_hunter_pounce_counter_adv` int(11) NOT NULL default '0',
  `infected_hunter_pounce_counter_exp` int(11) NOT NULL default '0',
  `infected_hunter_pounce_damage_nor` int(11) NOT NULL default '0',
  `infected_hunter_pounce_damage_adv` int(11) NOT NULL default '0',
  `infected_hunter_pounce_damage_exp` int(11) NOT NULL default '0',
  `infected_tanksniper_nor` int(11) NOT NULL default '0',
  `infected_tanksniper_adv` int(11) NOT NULL default '0',
  `infected_tanksniper_exp` int(11) NOT NULL default '0',
  `caralarm_nor` int(11) NOT NULL default '0',
  `caralarm_adv` int(11) NOT NULL default '0',
  `caralarm_exp` int(11) NOT NULL default '0',
  `jockey_rides_nor` int(11) NOT NULL default '0',
  `jockey_rides_adv` int(11) NOT NULL default '0',
  `jockey_rides_exp` int(11) NOT NULL default '0',
  `charger_impacts_nor` int(11) NOT NULL default '0',
  `charger_impacts_adv` int(11) NOT NULL default '0',
  `charger_impacts_exp` int(11) NOT NULL default '0',
  PRIMARY KEY  (`name`,`gamemode`)
);";

$create_players = "CREATE TABLE `" . $mysql_tableprefix . "players` (
  `steamid` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `name` tinyblob NOT NULL,
  `lastontime` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `lastgamemode` int(1) NOT NULL default '0',
  `ip` varchar(16) NOT NULL default '0.0.0.0',
  `playtime` int(11) NOT NULL default '0' COMMENT 'Playtime in Coop',
  `playtime_versus` int(11) NOT NULL default '0' COMMENT 'Playtime in Versus',
  `playtime_realism` int(11) NOT NULL default '0' COMMENT 'Playtime in Realism',
  `playtime_survival` int(11) NOT NULL default '0' COMMENT 'Playtime in Survival',
  `playtime_scavenge` int(11) NOT NULL default '0' COMMENT 'Playtime in Scavenge',
  `playtime_realismversus` int(11) NOT NULL default '0' COMMENT 'Playtime in Realism',
  `points` int(11) NOT NULL default '0',
  `points_realism` int(11) NOT NULL default '0',
  `points_survival` int(11) NOT NULL default '0',
  `points_survivors` int(11) NOT NULL default '0',
  `points_infected` int(11) NOT NULL default '0',
  `points_scavenge_survivors` int(11) NOT NULL default '0',
  `points_scavenge_infected` int(11) NOT NULL default '0',
  `points_realism_survivors` int(11) NOT NULL default '0',
  `points_realism_infected` int(11) NOT NULL default '0',
  `kills` int(11) NOT NULL default '0',
  `melee_kills` int(11) NOT NULL default '0',
  `headshots` int(11) NOT NULL default '0',
  `kill_infected` int(11) NOT NULL default '0',
  `kill_hunter` int(11) NOT NULL default '0',
  `kill_smoker` int(11) NOT NULL default '0',
  `kill_boomer` int(11) NOT NULL default '0',
  `kill_spitter` int(11) NOT NULL default '0',
  `kill_jockey` int(11) NOT NULL default '0',
  `kill_charger` int(11) NOT NULL default '0',
  `versus_kills_survivors` int(11) NOT NULL default '0',
  `scavenge_kills_survivors` int(11) NOT NULL default '0',
  `realism_kills_survivors` int(11) NOT NULL default '0',
  `jockey_rides` int(11) NOT NULL default '0',
  `charger_impacts` int(11) NOT NULL default '0',
  `award_pills` int(11) NOT NULL default '0',
  `award_adrenaline` int(11) NOT NULL default '0',
  `award_fincap` int(11) NOT NULL default '0' COMMENT 'Friendly incapacitation',
  `award_medkit` int(11) NOT NULL default '0',
  `award_defib` int(11) NOT NULL default '0',
  `award_charger` int(11) NOT NULL default '0',
  `award_jockey` int(11) NOT NULL default '0',
  `award_hunter` int(11) NOT NULL default '0',
  `award_smoker` int(11) NOT NULL default '0',
  `award_protect` int(11) NOT NULL default '0',
  `award_revive` int(11) NOT NULL default '0',
  `award_rescue` int(11) NOT NULL default '0',
  `award_campaigns` int(11) NOT NULL default '0',
  `award_tankkill` int(11) NOT NULL default '0',
  `award_tankkillnodeaths` int(11) NOT NULL default '0',
  `award_allinsafehouse` int(11) NOT NULL default '0',
  `award_friendlyfire` int(11) NOT NULL default '0',
  `award_teamkill` int(11) NOT NULL default '0',
  `award_left4dead` int(11) NOT NULL default '0',
  `award_letinsafehouse` int(11) NOT NULL default '0',
  `award_witchdisturb` int(11) NOT NULL default '0',
  `award_pounce_perfect` int(11) NOT NULL default '0',
  `award_pounce_nice` int(11) NOT NULL default '0',
  `award_perfect_blindness` int(11) NOT NULL default '0',
  `award_infected_win` int(11) NOT NULL default '0',
  `award_scavenge_infected_win` int(11) NOT NULL default '0',
  `award_bulldozer` int(11) NOT NULL default '0',
  `award_survivor_down` int(11) NOT NULL default '0',
  `award_ledgegrab` int(11) NOT NULL default '0',
  `award_gascans_poured` int(11) NOT NULL default '0',
  `award_upgrades_added` int(11) NOT NULL default '0',
  `award_matador` int(11) NOT NULL default '0',
  `award_witchcrowned` int(11) NOT NULL default '0',
  `award_scatteringram` int(11) NOT NULL default '0',
  `infected_spawn_1` int(11) NOT NULL default '0' COMMENT 'Spawned as Smoker',
  `infected_spawn_2` int(11) NOT NULL default '0' COMMENT 'Spawned as Boomer',
  `infected_spawn_3` int(11) NOT NULL default '0' COMMENT 'Spawned as Hunter',
  `infected_spawn_4` int(11) NOT NULL default '0' COMMENT 'Spawned as Spitter',
  `infected_spawn_5` int(11) NOT NULL default '0' COMMENT 'Spawned as Jockey',
  `infected_spawn_6` int(11) NOT NULL default '0' COMMENT 'Spawned as Charger',
  `infected_spawn_8` int(11) NOT NULL default '0' COMMENT 'Spawned as Tank',
  `infected_boomer_vomits` int(11) NOT NULL default '0',
  `infected_boomer_blinded` int(11) NOT NULL default '0',
  `infected_hunter_pounce_counter` int(11) NOT NULL default '0',
  `infected_hunter_pounce_dmg` int(11) NOT NULL default '0',
  `infected_smoker_damage` int(11) NOT NULL default '0',
  `infected_jockey_damage` int(11) NOT NULL default '0',
  `infected_jockey_ridetime` double NOT NULL default '0',
  `infected_charger_damage` int(11) NOT NULL default '0',
  `infected_tank_damage` int(11) NOT NULL default '0',
  `infected_tanksniper` int(11) NOT NULL default '0',
  `infected_spitter_damage` int(11) NOT NULL default '0',
  PRIMARY KEY  (`steamid`)
);";

$create_timedmaps = "CREATE TABLE `" . $mysql_tableprefix . "timedmaps` (
  `map` varchar(255) character set latin1 NOT NULL,
  `gamemode` int(1) unsigned NOT NULL,
  `difficulty` int(1) unsigned NOT NULL,
  `steamid` varchar(255) character set latin1 NOT NULL,
  `plays` int(11) NOT NULL,
  `time` double NOT NULL,
  `players` int(2) NOT NULL,
  `modified` datetime NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY  (`map`,`gamemode`,`difficulty`,`steamid`)
);";

$create_ip2country = "CREATE TABLE `" . $mysql_ip2c_tableprefix . "ip2country` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `begin_ip_num` int(11) unsigned NOT NULL,
  `end_ip_num` int(11) unsigned NOT NULL,
  `country_code` varchar(4) NOT NULL,
  `country_name` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `begin_ip_num` (`begin_ip_num`,`end_ip_num`)
);";

$create_ip2country_loc = "CREATE TABLE `" . $mysql_ip2c_tableprefix . "ip2country_locations` (
  `loc_id` int(11) unsigned NOT NULL,
  `country_code` varchar(4) NOT NULL,
  `loc_region` varchar(128) NOT NULL,
  `loc_city` tinyblob NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY  (`loc_id`),
  KEY `country_code` (`country_code`)
);";

$create_ip2country_blo = "CREATE TABLE `" . $mysql_ip2c_tableprefix . "ip2country_blocks` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `begin_ip_num` int(11) unsigned NOT NULL,
  `end_ip_num` int(11) unsigned NOT NULL,
  `loc_id` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `beginend` USING BTREE (`begin_ip_num`,`end_ip_num`),
  KEY `loc_id` (`loc_id`)
);";

$create_settings = "CREATE TABLE `" . $mysql_tableprefix . "settings` (
  `steamid` varchar(255) NOT NULL,
  `mute` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`steamid`)
);";

$create_server_settings = "CREATE TABLE `" . $mysql_tableprefix . "server_settings` (
  `sname` varchar(64) NOT NULL,
  `svalue` blob,
  PRIMARY KEY  (`sname`)
);";

if (mysql_query($create_maps)) echo "Maps table created successfully!<br /><br />\n"; else echo mysql_error() . "<br /><br />\n";
if (mysql_query($create_players)) echo "Players table created successfully!<br /><br />\n"; else echo mysql_error() . "<br /><br />\n";
if (mysql_query($create_timedmaps)) echo "Timed Maps table created successfully!<br />\n"; else echo mysql_error() . "<br /><br />\n";
if (mysql_query($create_settings)) echo "Settings table created successfully!<br />\n"; else echo mysql_error() . "<br /><br />\n";
if (mysql_query($create_server_settings)) echo "Server Settings table created successfully!<br />\n"; else echo mysql_error() . "<br /><br />\n";
if (mysql_query($create_ip2country, $con_ip2c)) echo "IP to Country table created successfully!<br />\n"; else echo mysql_error() . "<br /><br />\n";
if (mysql_query($create_ip2country_loc, $con_ip2c)) echo "IP to Country Locations table created successfully!<br />\n"; else echo mysql_error() . "<br /><br />\n";
if (mysql_query($create_ip2country_blo, $con_ip2c)) echo "IP to Country Blocks table created successfully!<br />\n"; else echo mysql_error() . "<br /><br />\n";

$insert_server_settings = "INSERT INTO " . $mysql_tableprefix . "server_settings (sname, svalue) VALUES ('motdmessage', 'This server is the home of Custom Player Stats. Tip of the day: You can mute Custom Player Stats from Rank Menu. Type RANKMENU to open Rank Menu!');";
if (mysql_query($insert_server_settings)) echo "<font color=\"darkgreen\">Server Settings value inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$insert_server_settings = "INSERT INTO " . $mysql_tableprefix . "server_settings (sname, svalue) VALUES ('motdheader', 'Left 4 Dead Player Stats');";
if (mysql_query($insert_server_settings)) echo "<font color=\"darkgreen\">Server Settings value inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

if ($game_version != 2)
{
	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES
	('l4d_airport01_greenhouse', 0),
	('l4d_airport02_offices', 0),
	('l4d_airport03_garage', 0),
	('l4d_airport04_terminal', 0),
	('l4d_airport05_runway', 0),
	('l4d_farm01_hilltop', 0),
	('l4d_farm02_traintunnel', 0),
	('l4d_farm03_bridge', 0),
	('l4d_farm04_barn', 0),
	('l4d_farm05_cornfield', 0),
	('l4d_hospital01_apartment', 0),
	('l4d_hospital02_subway', 0),
	('l4d_hospital03_sewers', 0),
	('l4d_hospital04_interior', 0),
	('l4d_hospital05_rooftop', 0),
	('l4d_smalltown01_caves', 0),
	('l4d_smalltown02_drainage', 0),
	('l4d_smalltown03_ranchhouse', 0),
	('l4d_smalltown04_mainstreet', 0),
	('l4d_smalltown05_houseboat', 0),
	('l4d_garage01_alleys', 0),
	('l4d_garage02_lots', 0),
	('l4d_vs_airport01_greenhouse', 1),
	('l4d_vs_airport02_offices', 1),
	('l4d_vs_airport03_garage', 1),
	('l4d_vs_airport04_terminal', 1),
	('l4d_vs_airport05_runway', 1),
	('l4d_vs_farm01_hilltop', 1),
	('l4d_vs_farm02_traintunnel', 1),
	('l4d_vs_farm03_bridge', 1),
	('l4d_vs_farm04_barn', 1),
	('l4d_vs_farm05_cornfield', 1),
	('l4d_vs_hospital01_apartment', 1),
	('l4d_vs_hospital02_subway', 1),
	('l4d_vs_hospital03_sewers', 1),
	('l4d_vs_hospital04_interior', 1),
	('l4d_vs_hospital05_rooftop', 1),
	('l4d_vs_smalltown01_caves', 1),
	('l4d_vs_smalltown02_drainage', 1),
	('l4d_vs_smalltown03_ranchhouse', 1),
	('l4d_vs_smalltown04_mainstreet', 1),
	('l4d_vs_smalltown05_houseboat', 1),
	('l4d_garage01_alleys', 1),
	('l4d_garage02_lots', 1),
	('l4d_airport01_greenhouse', 3),
	('l4d_airport02_offices', 3),
	('l4d_airport03_garage', 3),
	('l4d_airport04_terminal', 3),
	('l4d_airport05_runway', 3),
	('l4d_farm01_hilltop', 3),
	('l4d_farm02_traintunnel', 3),
	('l4d_farm03_bridge', 3),
	('l4d_farm04_barn', 3),
	('l4d_farm05_cornfield', 3),
	('l4d_garage01_alleys', 3),
	('l4d_garage02_lots', 3),
	('l4d_hospital01_apartment', 3),
	('l4d_hospital02_subway', 3),
	('l4d_hospital03_sewers', 3),
	('l4d_hospital04_interior', 3),
	('l4d_hospital05_rooftop', 3),
	('l4d_smalltown01_caves', 3),
	('l4d_smalltown02_drainage', 3),
	('l4d_smalltown03_ranchhouse', 3),
	('l4d_smalltown04_mainstreet', 3),
	('l4d_smalltown05_houseboat', 3),
	('l4d_sv_lighthouse', 3),
	('l4d_vs_airport01_greenhouse', 3),
	('l4d_vs_airport02_offices', 3),
	('l4d_vs_airport03_garage', 3),
	('l4d_vs_airport04_terminal', 3),
	('l4d_vs_airport05_runway', 3),
	('l4d_vs_farm01_hilltop', 3),
	('l4d_vs_farm02_traintunnel', 3),
	('l4d_vs_farm03_bridge', 3),
	('l4d_vs_farm04_barn', 3),
	('l4d_vs_farm05_cornfield', 3),
	('l4d_vs_hospital01_apartment', 3),
	('l4d_vs_hospital02_subway', 3),
	('l4d_vs_hospital03_sewers', 3),
	('l4d_vs_hospital04_interior', 3),
	('l4d_vs_hospital05_rooftop', 3),
	('l4d_vs_smalltown01_caves', 3),
	('l4d_vs_smalltown02_drainage', 3),
	('l4d_vs_smalltown03_ranchhouse', 3),
	('l4d_vs_smalltown04_mainstreet', 3),
	('l4d_vs_smalltown05_houseboat', 3);";

	if (mysql_query($insert_maps)) echo "Maps data for L4D1 inserted successfully!<br /><br />\n"; else echo mysql_error() . "<br /><br />\n";
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// ***************************************************************************************************************************************
// Players table

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players CHANGE name name TINYBLOB NOT NULL;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

// L4D1 to L4D2
$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players CHANGE infected_spawn_5 infected_spawn_8 INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN lastgamemode INT(1) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN kill_spitter INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN kill_jockey INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN kill_charger INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN playtime_versus INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN playtime_realism INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN playtime_survival INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN playtime_scavenge INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN playtime_realismversus INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN points_survivors INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN points_infected INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN points_realism INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN points_scavenge_survivors INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN points_scavenge_infected INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN points_survival INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN points_realism_survivors INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN points_realism_infected INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN versus_kills_survivors INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN realism_kills_survivors INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN scavenge_kills_survivors INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN jockey_rides INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_pounce_perfect INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_pounce_nice INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_perfect_blindness INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_infected_win INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_scavenge_infected_win INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_bulldozer INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_survivor_down INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_ledgegrab INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_adrenaline INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_fincap INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_jockey INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_charger INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_defib INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_matador INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_witchcrowned INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_gascans_poured INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_upgrades_added INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN award_scatteringram INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_spawn_1 INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_spawn_2 INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_spawn_3 INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_spawn_4 INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_spawn_5 INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_spawn_6 INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_spawn_8 INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_boomer_vomits INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_boomer_blinded INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_hunter_pounce_counter INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_hunter_pounce_dmg INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_smoker_damage INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_spitter_damage INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_jockey_damage INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_jockey_ridetime DOUBLE NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_charger_damage INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_tank_damage INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN infected_tanksniper INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN ip VARCHAR(16) NOT NULL DEFAULT '0.0.0.0';";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN charger_impacts INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN melee_kills INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN mutations_kills_survivors INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN playtime_mutations INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_players = "ALTER TABLE " . $mysql_tableprefix . "players ADD COLUMN points_mutations INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Players table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";


// ***************************************************************************************************************************************
// Maps table

// L4D2 Reality Gamemode
$alter_players = "ALTER TABLE " . $mysql_tableprefix . "maps CHANGE versus gamemode INT(1) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

// L4D1 to L4D2
$alter_players = "ALTER TABLE " . $mysql_tableprefix . "maps CHANGE infected_spawn_5_nor infected_spawn_8_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

// L4D1 to L4D2
$alter_players = "ALTER TABLE " . $mysql_tableprefix . "maps CHANGE infected_spawn_5_adv infected_spawn_8_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

// L4D1 to L4D2
$alter_players = "ALTER TABLE " . $mysql_tableprefix . "maps CHANGE infected_spawn_5_exp infected_spawn_8_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_players)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN custom BIT NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN gamemode INT(1) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN points_infected_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN points_infected_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN points_infected_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN survivor_kills_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN survivor_kills_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN survivor_kills_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_win_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_win_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_win_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN survivors_win_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN survivors_win_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN survivors_win_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_smoker_damage_nor BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_smoker_damage_adv BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_smoker_damage_exp BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_jockey_damage_nor BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_jockey_damage_adv BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_jockey_damage_exp BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_jockey_ridetime_nor DOUBLE NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_jockey_ridetime_adv DOUBLE NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_jockey_ridetime_exp DOUBLE NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_charger_damage_nor BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_charger_damage_adv BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_charger_damage_exp BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spitter_damage_nor BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spitter_damage_adv BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spitter_damage_exp BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_tank_damage_nor BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_tank_damage_adv BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_tank_damage_exp BIGINT(20) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_boomer_vomits_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_boomer_vomits_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_boomer_vomits_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_boomer_blinded_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_boomer_blinded_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_boomer_blinded_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_1_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_1_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_1_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_2_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_2_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_2_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_3_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_3_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_3_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_4_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_4_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_4_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_5_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_5_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_5_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_6_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_6_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_6_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_8_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_8_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_spawn_8_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_hunter_pounce_counter_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_hunter_pounce_counter_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_hunter_pounce_counter_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_hunter_pounce_damage_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_hunter_pounce_damage_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_hunter_pounce_damage_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_tanksniper_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_tanksniper_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN infected_tanksniper_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN caralarm_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN caralarm_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN caralarm_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN jockey_rides_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN jockey_rides_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN jockey_rides_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN charger_impacts_nor INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN charger_impacts_adv INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN charger_impacts_exp INT(11) NOT NULL DEFAULT 0;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD COLUMN mutation VARCHAR(64) NOT NULL default '';";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps DROP PRIMARY KEY;";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_maps = "ALTER TABLE " . $mysql_tableprefix . "maps ADD PRIMARY KEY (name, gamemode, mutation);";
if (mysql_query($alter_maps)) echo "<font color=\"darkgreen\">Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

// ***************************************************************************************************************************************
// Maps table values (ORIGINAL MAPS)

if ($game_version != 2)
{
	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport01_greenhouse', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport02_offices', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport03_garage', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport04_terminal', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport05_runway', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm01_hilltop', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm02_traintunnel', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm03_bridge', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm04_barn', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm05_cornfield', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital01_apartment', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital02_subway', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital03_sewers', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital04_interior', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital05_rooftop', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown01_caves', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown02_drainage', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown03_ranchhouse', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown04_mainstreet', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown05_houseboat', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_garage01_alleys', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_garage02_lots', 0);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport01_greenhouse', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport02_offices', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport03_garage', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport04_terminal', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport05_runway', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm01_hilltop', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm02_traintunnel', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm03_bridge', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm04_barn', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm05_cornfield', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital01_apartment', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital02_subway', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital03_sewers', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital04_interior', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital05_rooftop', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown01_caves', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown02_drainage', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown03_ranchhouse', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown04_mainstreet', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown05_houseboat', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_garage01_alleys', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_garage02_lots', 1);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport01_greenhouse', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport02_offices', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport03_garage', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport04_terminal', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_airport05_runway', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm01_hilltop', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm02_traintunnel', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm03_bridge', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm04_barn', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_farm05_cornfield', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_garage01_alleys', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_garage02_lots', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital01_apartment', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital02_subway', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital03_sewers', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital04_interior', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_hospital05_rooftop', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown01_caves', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown02_drainage', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown03_ranchhouse', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown04_mainstreet', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_smalltown05_houseboat', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_sv_lighthouse', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport01_greenhouse', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport02_offices', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport03_garage', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport04_terminal', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_airport05_runway', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm01_hilltop', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm02_traintunnel', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm03_bridge', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm04_barn', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_farm05_cornfield', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital01_apartment', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital02_subway', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital03_sewers', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital04_interior', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_hospital05_rooftop', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown01_caves', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown02_drainage', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown03_ranchhouse', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown04_mainstreet', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	$insert_maps = "INSERT INTO " . $mysql_tableprefix . "maps (name, gamemode) VALUES ('l4d_vs_smalltown05_houseboat', 3);";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">Map inserted successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";
}

if ($game_version != 1)
{
	InsertDefaultMapAllL4D2GameModes("c1m1_hotel");
	InsertDefaultMapAllL4D2GameModes("c1m2_streets");
	InsertDefaultMapAllL4D2GameModes("c1m3_mall");
	InsertDefaultMapAllL4D2GameModes("c1m4_atrium");
	InsertDefaultMapAllL4D2GameModes("c2m1_highway");
	InsertDefaultMapAllL4D2GameModes("c2m2_fairgrounds");
	InsertDefaultMapAllL4D2GameModes("c2m3_coaster");
	InsertDefaultMapAllL4D2GameModes("c2m4_barns");
	InsertDefaultMapAllL4D2GameModes("c2m5_concert");
	InsertDefaultMapAllL4D2GameModes("c3m1_plankcountry");
	InsertDefaultMapAllL4D2GameModes("c3m2_swamp");
	InsertDefaultMapAllL4D2GameModes("c3m3_shantytown");
	InsertDefaultMapAllL4D2GameModes("c3m4_plantation");
	InsertDefaultMapAllL4D2GameModes("c4m1_milltown_a");
	InsertDefaultMapAllL4D2GameModes("c4m2_sugarmill_a");
	InsertDefaultMapAllL4D2GameModes("c4m3_sugarmill_b");
	InsertDefaultMapAllL4D2GameModes("c4m4_milltown_b");
	InsertDefaultMapAllL4D2GameModes("c4m5_milltown_escape");
	InsertDefaultMapAllL4D2GameModes("c5m1_waterfront");
	InsertDefaultMapAllL4D2GameModes("c5m2_park");
	InsertDefaultMapAllL4D2GameModes("c5m3_cemetery");
	InsertDefaultMapAllL4D2GameModes("c5m4_quarter");
	InsertDefaultMapAllL4D2GameModes("c5m5_bridge");
	InsertDefaultMapAllL4D2GameModes("c6m1_riverbank");
	InsertDefaultMapAllL4D2GameModes("c6m2_bedlam");
	InsertDefaultMapAllL4D2GameModes("c6m3_port");
	InsertDefaultMapAllL4D2GameModes("c7m1_docks");
	InsertDefaultMapAllL4D2GameModes("c7m2_barge");
	InsertDefaultMapAllL4D2GameModes("c7m3_port");
	InsertDefaultMapAllL4D2GameModes("c8m1_apartment");
	InsertDefaultMapAllL4D2GameModes("c8m2_subway");
	InsertDefaultMapAllL4D2GameModes("c8m3_sewers");
	InsertDefaultMapAllL4D2GameModes("c8m4_interior");
	InsertDefaultMapAllL4D2GameModes("c8m5_rooftop");
	InsertDefaultMapAllL4D2GameModes("c9m1_alleys");
	InsertDefaultMapAllL4D2GameModes("c9m2_lots");
	InsertDefaultMapAllL4D2GameModes("c10m1_caves");
	InsertDefaultMapAllL4D2GameModes("c10m2_drainage");
	InsertDefaultMapAllL4D2GameModes("c10m3_ranchhouse");
	InsertDefaultMapAllL4D2GameModes("c10m4_mainstreet");
	InsertDefaultMapAllL4D2GameModes("c10m5_houseboat");
	InsertDefaultMapAllL4D2GameModes("c11m1_greenhouse");
	InsertDefaultMapAllL4D2GameModes("c11m2_offices");
	InsertDefaultMapAllL4D2GameModes("c11m3_garage");
	InsertDefaultMapAllL4D2GameModes("c11m4_terminal");
	InsertDefaultMapAllL4D2GameModes("c11m5_runway");
	InsertDefaultMapAllL4D2GameModes("c12m1_hilltop");
	InsertDefaultMapAllL4D2GameModes("c12m2_traintunnel");
	InsertDefaultMapAllL4D2GameModes("c12m3_bridge");
	InsertDefaultMapAllL4D2GameModes("c12m4_barn");
	InsertDefaultMapAllL4D2GameModes("c12m5_cornfield");
	InsertDefaultMapAllL4D2GameModes("c13m1_alpinecreek");
	InsertDefaultMapAllL4D2GameModes("c13m2_southpinestream");
	InsertDefaultMapAllL4D2GameModes("c13m3_memorialbridge");
	InsertDefaultMapAllL4D2GameModes("c13m4_cutthroatcreek");

	// Convert specific custom maps to original
	$insert_maps = "UPDATE " . $mysql_tableprefix . "maps SET custom = 0 WHERE LOWER(name) REGEXP '^c([0-9]+)m([0-9]+)_';";
	if (mysql_query($insert_maps)) echo "<font color=\"darkgreen\">All default maps fixed from being custom!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";
}

// ***************************************************************************************************************************************
// Timedmaps table

$alter_timedmaps = "ALTER TABLE `" . $mysql_tableprefix . "timedmaps` CHANGE `map` `map` VARCHAR(255) CHARACTER SET latin1 NOT NULL;";
if (mysql_query($alter_timedmaps)) echo "<font color=\"darkgreen\">Timed Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_timedmaps = "ALTER TABLE `" . $mysql_tableprefix . "timedmaps` CHANGE `steamid` `steamid` VARCHAR(255) CHARACTER SET latin1 NOT NULL;";
if (mysql_query($alter_timedmaps)) echo "<font color=\"darkgreen\">Timed Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_timedmaps = "ALTER TABLE `" . $mysql_tableprefix . "timedmaps` CHANGE `time` `time` DOUBLE NOT NULL;";
if (mysql_query($alter_timedmaps)) echo "<font color=\"darkgreen\">Timed Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_timedmaps = "ALTER TABLE `" . $mysql_tableprefix . "timedmaps` ADD COLUMN `difficulty` INT(1) UNSIGNED NOT NULL;";
if (mysql_query($alter_timedmaps)) echo "<font color=\"darkgreen\">Timed Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_timedmaps = "ALTER TABLE `" . $mysql_tableprefix . "timedmaps` ADD COLUMN `mutation` VARCHAR(64) NOT NULL default '';";
if (mysql_query($alter_timedmaps)) echo "<font color=\"darkgreen\">Timed Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_timedmaps = "ALTER TABLE `" . $mysql_tableprefix . "timedmaps` DROP PRIMARY KEY;";
if (mysql_query($alter_timedmaps)) echo "<font color=\"darkgreen\">Timed Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

$alter_timedmaps = "ALTER TABLE `" . $mysql_tableprefix . "timedmaps` ADD PRIMARY KEY (`map`,`gamemode`,`difficulty`,`steamid`,`mutation`);";
if (mysql_query($alter_timedmaps)) echo "<font color=\"darkgreen\">Timed Maps table altered successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if (file_exists("GeoIPCountryWhois.csv"))
{
	$page = @fopen("GeoIPCountryWhois.csv", "r");

	if (!$page)
    die("Failed opening file 'GeoIPCountryWhois.csv': error was '$php_errormsg'");

	$query = "DELETE FROM `" . $mysql_ip2c_tableprefix . "ip2country`;";
	if (mysql_query($query, $con_ip2c)) echo "<font color=\"darkgreen\">IP to Country table cleared successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	echo "<font color=\"darkgreen\"><b>Reading GeoIPCountryWhois.csv - PLEASE WAIT!</b><br>\n";

	$insert = "";
	$insert_counter = 0;
	$rowcounter = 0;

	while (($data = fgetcsv($page, 1000, ",")) !== FALSE)
	{
		if ($insert_counter > 100)
		{
			$query = "INSERT INTO `" . $mysql_ip2c_tableprefix . "ip2country` (`begin_ip_num`,`end_ip_num`,`country_code`,`country_name`) VALUES" . $insert;
			if (mysql_query($query, $con_ip2c)) echo "| "; else die("<br /><font color=\"darkred\">" . mysql_error() . "</font><br />\n");

			$insert = "";
			$insert_counter = 0;
		}

		if ($insert_counter > 0)
			$insert .= ",";

		$insert .= " (" . $data[2] . "," . $data[3] . ",'" . $data[4] . "','" . mysql_real_escape_string($data[5]) . "')";
		$insert_counter++;
		$rowcounter++;
	}

	if ($insert_counter)
	{
		$query = "INSERT INTO `" . $mysql_ip2c_tableprefix . "ip2country` (`begin_ip_num`,`end_ip_num`,`country_code`,`country_name`) VALUES" . $insert;
		if (mysql_query($query, $con_ip2c)) echo "|"; else die("<br /><font color=\"darkred\">" . mysql_error() . "</font><br />\n");
	}

	echo "<br />" . $rowcounter . " rows inserted.<br />\n";
	echo "<br /><b>You can now delete file GeoIPCountryWhois.csv!</b></font><br />\n";
}
else
	echo "<font color=\"red\"><b>[OPTIONAL]</b> Download <a href=\"http://www.maxmind.com/download/geoip/database/GeoIPCountryCSV.zip\" target=\"_blank\">latest GeoIPCountryCSV.zip</a>, unzip it to the web stats folder and run <a href=\"./updatetable.php\">updatetable.php</a></font><br />\n";

if (file_exists("GeoLiteCity-Blocks.csv"))
{
	$page = @fopen("GeoLiteCity-Blocks.csv", "r");

	if (!$page)
    die("Failed opening file 'GeoLiteCity-Blocks.csv': error was '$php_errormsg'");

	$query = "DELETE FROM `" . $mysql_ip2c_tableprefix . "ip2country_blocks`;";
	if (mysql_query($query, $con_ip2c)) echo "<font color=\"darkgreen\">IP to Country Blocks table cleared successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	echo "<font color=\"darkgreen\"><b>Reading GeoLiteCity-Blocks.csv - PLEASE WAIT!</b><br>\n";

	$insert = "";
	$insert_counter = 0;
	$rowcounter = 0;

	while (($data = fgetcsv($page, 1000, ",")) !== FALSE)
	{
		if ($rowcounter++ < 2)
			continue;

		if ($insert_counter > 500)
		{
			$query = "INSERT INTO `" . $mysql_ip2c_tableprefix . "ip2country_blocks` (`begin_ip_num`,`end_ip_num`,`loc_id`) VALUES" . $insert;
			if (mysql_query($query, $con_ip2c)) echo "| "; else die("<br /><font color=\"darkred\">" . mysql_error() . "</font><br />\n");

			$insert = "";
			$insert_counter = 0;
		}

		if ($insert_counter > 0)
			$insert .= ",";

		$insert .= " (" . $data[0] . "," . $data[1] . "," . $data[2] . ")";
		$insert_counter++;
	}

	if ($insert_counter)
	{
		$query = "INSERT INTO `" . $mysql_ip2c_tableprefix . "ip2country_blocks` (`begin_ip_num`,`end_ip_num`,`loc_id`) VALUES" . $insert;
		if (mysql_query($query, $con_ip2c)) echo "|"; else die("<br /><font color=\"darkred\">" . mysql_error() . "</font><br />\n");
	}

	echo "<br />" . $rowcounter . " rows inserted.<br />\n";
	echo "<br /><b>You can now delete file GeoLiteCity-Blocks.csv!</b></font><br />\n";
}
else
	echo "<font color=\"red\"><b>[OPTIONAL]</b> Download <a href=\"http://www.maxmind.com/app/geolitecity\" target=\"_blank\">latest GeoLiteCity_YYYYMMDD.zip</a> (CSV format), unzip it (two files) to the web stats folder and run <a href=\"./updatetable.php\">updatetable.php</a></font><br />\n";

if (file_exists("GeoLiteCity-Location.csv"))
{
	$page = @fopen("GeoLiteCity-Location.csv", "r");

	if (!$page)
    die("Failed opening file 'GeoLiteCity-Location.csv': error was '$php_errormsg'");

	$query = "DELETE FROM `" . $mysql_ip2c_tableprefix . "ip2country_locations`;";
	if (mysql_query($query, $con_ip2c)) echo "<font color=\"darkgreen\">IP to Country Locations table cleared successfully!</font><br />\n"; else echo "<font color=\"darkred\">" . mysql_error() . "</font><br />\n";

	echo "<font color=\"darkgreen\"><b>Reading GeoLiteCity-Location.csv - PLEASE WAIT!</b><br>\n";

	$insert = "";
	$insert_counter = 0;
	$rowcounter = 0;

	while (($data = fgetcsv($page, 1000, ",")) !== FALSE)
	{
		if ($rowcounter++ < 2)
			continue;

		if ($insert_counter > 200)
		{
			$query = "INSERT INTO `" . $mysql_ip2c_tableprefix . "ip2country_locations` (`loc_id`,`country_code`,`loc_region`,`loc_city`,`latitude`,`longitude`) VALUES" . $insert;
			if (mysql_query($query, $con_ip2c)) echo "| "; else die("<br /><font color=\"darkred\">" . mysql_error() . "</font><br />\n");

			$insert = "";
			$insert_counter = 0;
		}

		if ($insert_counter > 0)
			$insert .= ",";

		$insert .= " (" . $data[0] . ",'" . $data[1] . "','" . $data[2] . "','" . mysql_real_escape_string($data[3]) . "'," . $data[5] . "," . $data[6] . ")";
		$insert_counter++;
	}

	if ($insert_counter)
	{
		$query = "INSERT INTO `" . $mysql_ip2c_tableprefix . "ip2country_locations` (`loc_id`,`country_code`,`loc_region`,`loc_city`,`latitude`,`longitude`) VALUES" . $insert;
		if (mysql_query($query, $con_ip2c)) echo "|"; else die("<br /><font color=\"darkred\">" . mysql_error() . "</font><br />\n");
	}

	echo "<br />" . $rowcounter . " rows inserted.<br />\n";
	echo "<br /><b>You can now delete file GeoLiteCity-Location.csv!</b></font><br />\n";
}
else
	echo "<font color=\"red\"><b>[OPTIONAL]</b> Download <a href=\"http://www.maxmind.com/app/geolitecity\" target=\"_blank\">latest GeoLiteCity_YYYYMMDD.zip</a> (CSV format), unzip it (two files) to the web stats folder and run <a href=\"./updatetable.php\">updatetable.php</a></font><br />\n";

echo "Database installation completed!<br />\n";
?>
