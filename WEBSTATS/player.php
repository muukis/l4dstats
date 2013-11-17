<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Player stats page - "player.php"
================================================
*/

// Include the primary PHP functions file
include("./common.php");

// Load outer template
$tpl = new Template($templatefiles['layout.tpl']);

// Set Steam ID as var, and quit on hack attempt
if (strstr($_GET['steamid'], "/")) exit;
$id = mysql_real_escape_string($_GET['steamid']);

$result = mysql_query("SELECT * FROM " . $mysql_tableprefix . "players WHERE steamid = '" . $id . "'");
$row = mysql_fetch_array($result);
$totalpoints = $row['points'] + $row['points_survival'] + $row['points_survivors'] + $row['points_infected'] + ($game_version != 1 ? $row['points_realism'] + $row['points_scavenge_survivors'] + $row['points_scavenge_infected'] + $row['points_realism_survivors'] + $row['points_realism_infected'] + $row['points_mutations'] : 0);
$rankrow = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS rank FROM " . $mysql_tableprefix . "players WHERE points + points_survival + points_survivors + points_infected" . ($game_version != 1 ? " + points_realism + points_scavenge_survivors + points_scavenge_infected + points_realism_survivors + points_realism_infected + points_mutations" : "") . " >= '" . $totalpoints . "'"));
$rank = $rankrow['rank'];

$arr_survivor_awards = array();
$arr_survivor_awards[$language_pack['awardpillsgiven']] = array($row['award_pills'], $language_pack['awardpillsgivendesc']);
$arr_survivor_awards[$language_pack['awardmedkitsgiven']] = array($row['award_medkit'], $language_pack['awardmedkitsgivendesc']);
$arr_survivor_awards[$language_pack['awardsavedfriendliesfromhunters']] = array($row['award_hunter'], $language_pack['awardsavedfriendliesfromhuntersdesc']);
$arr_survivor_awards[$language_pack['awardsavedfriendliesfromsmokers']] = array($row['award_smoker'], $language_pack['awardsavedfriendliesfromsmokersdesc']);
if ($game_version != 1)
{
	$arr_survivor_awards[$language_pack['awarddefibrillatorsused']] = array($row['award_defib'], $language_pack['awarddefibrillatorsuseddesc']);
	$arr_survivor_awards[$language_pack['awardadrenalinesgiven']] = array($row['award_adrenaline'], $language_pack['awardadrenalinesgivendesc']);
	$arr_survivor_awards[$language_pack['awardsavedfriendliesfromjockeys']] = array($row['award_jockey'], $language_pack['awardsavedfriendliesfromjockeysdesc']);
	$arr_survivor_awards[$language_pack['awardsavedfriendliesfromchargers']] = array($row['award_charger'], $language_pack['awardsavedfriendliesfromchargers']);
	$arr_survivor_awards[$language_pack['awardleveledcharges']] = array($row['award_matador'], $language_pack['awardleveledchargesdesc']);
	$arr_survivor_awards[$language_pack['awardgascanisterspoured']] = array($row['award_gascans_poured'], $language_pack['awardgascanisterspoureddesc']);
	$arr_survivor_awards[$language_pack['awardammoupgradesdeployed']] = array($row['award_upgrades_added'], $language_pack['awardammoupgradesdeployeddesc']);
}
$arr_survivor_awards[$language_pack['awardcrownedwitches']] = array($row['award_witchcrowned'], $language_pack['awardcrownedwitchesdesc']);
$arr_survivor_awards[$language_pack['awardprotectedfriendlies']] = array($row['award_protect'], $language_pack['awardprotectedfriendliesdesc']);
$arr_survivor_awards[$language_pack['awardrevivedfriendlies']] = array($row['award_revive'], $language_pack['awardrevivedfriendliesdesc']);
$arr_survivor_awards[$language_pack['awardrescuedfriendlies']] = array($row['award_rescue'], $language_pack['awardrescuedfriendliesdesc']);
$arr_survivor_awards[$language_pack['awardtankskilledwithteam']] = array($row['award_tankkill'], $language_pack['awardtankskilledwithteamdesc']);
$arr_survivor_awards[$language_pack['awardtankskilledwithnodeaths']] = array($row['award_tankkillnodeaths'], $language_pack['awardtankskilledwithnodeathsdesc']);
$arr_survivor_awards[$language_pack['awardsafehousesreachedwithallsurvivors']] = array($row['award_allinsafehouse'], $language_pack['awardsafehousesreachedwithallsurvivorsdesc']);
$arr_survivor_awards[$language_pack['awardcampaignscompleted']] = array($row['award_campaigns'], $language_pack['awardcampaignscompleteddesc']);

$arr_infected_awards = array();
$arr_infected_awards[$language_pack['awardallsurvivorsdead']] = array($row['award_infected_win'], $language_pack['awardallsurvivorsdeaddesc']);
$arr_infected_awards[$language_pack['awardperfectblindness']] = array($row['award_perfect_blindness'], $language_pack['awardperfectblindnessdesc']);
$arr_infected_awards[$language_pack['awarddeathfromabove']] = array($row['award_pounce_perfect'], $language_pack['awarddeathfromabovedesc']);
$arr_infected_awards[$language_pack['awardpainfromabove']] = array($row['award_pounce_nice'], $language_pack['awardpainfromabovedesc']);
$arr_infected_awards[$language_pack['awardbulldozer']] = array($row['award_bulldozer'], $language_pack['awardbulldozerdesc']);
$arr_infected_awards[$language_pack['awardsurvivorsincapacitated']] = array($row['award_survivor_down'], $language_pack['awardsurvivorsincapacitateddesc']);
$arr_infected_awards[$language_pack['awardcausedledgegrab']] = array($row['award_ledgegrab'], $language_pack['awardcausedledgegrabdesc']);
if ($game_version != 1)
{
	$arr_infected_awards[$language_pack['awardscatteringram']] = array($row['award_scatteringram'], $language_pack['awardscatteringramdesc']);
}

if (mysql_num_rows($result) > 0)
{
	$playername = htmlentities($row['name'], ENT_COMPAT, "UTF-8");
	$playername2 = $playername;

	if ($steam_profile_read)
	{
		$avatarimg = "";
		$playercurrentname = "";
		$playersummary = "";
		$playerheadline = "";
		$playerhoursplayed2wk = "";
		$playersteamrating = "";
		$playermembersince = "";
		$playerprivacystate = "";

		$playersteamprofile = getplayersteamprofilexml($row['steamid']);

		if ($playersteamprofile)
		{
			if ($players_avatars_show)
			{
				$avatarimgurl = parseplayeravatar($playersteamprofile, "full");
				
				if (!$avatarimgurl)
				{
					$avatarimgurl = parseplayeravatar($playersteamprofile, "medium");
				}
				
				if (!$avatarimgurl)
				{
					$avatarimgurl = parseplayeravatar($playersteamprofile, "icon");
				}

				if($avatarimgurl)
				{
					$avatarimg = "<img src='" . $avatarimgurl . "' border='0'>";
				}
			}
			
			$playercurrentname = htmlentities(parseplayername($playersteamprofile), ENT_COMPAT, "UTF-8");
			$playersummary = htmlentities(parseplayersummary($playersteamprofile), ENT_COMPAT, "UTF-8");
			$playerheadline = htmlentities(parseplayerheadline($playersteamprofile), ENT_COMPAT, "UTF-8");
			$playerhoursplayed2wk = htmlentities(parseplayerhoursplayed2wk($playersteamprofile), ENT_COMPAT, "UTF-8");
			$playersteamrating = htmlentities(parseplayersteamrating($playersteamprofile), ENT_COMPAT, "UTF-8");
			$playermembersince = htmlentities(parseplayermembersince($playersteamprofile), ENT_COMPAT, "UTF-8");
			$playerprivacystate = htmlentities(parseplayerprivacystate($playersteamprofile), ENT_COMPAT, "UTF-8");
			
			$isplayerprofileprivate = ($playerprivacystate != "public");
			
			if ($playersummary == $language_pack['noinformationgiven'])
			{
				$playersummary = "";
			}
			
			$playerprofileinfo = "<table cellpadding='0' cellspacing='0' border='0' style='font-size:9px;'>";
			
			if ($playercurrentname != $playername2)
			{
				$playercurrentname = "<tr><td><i>" . $language_pack['currentname'] . ":</i></td><td width='20px'>&nbsp;</td><td width='100%'><i><b>" . $playercurrentname . "</b></i></td></tr>";
			}
			else
			{
				$playercurrentname = "";
			}
			
			if (!$isplayerprofileprivate)
			{
				if ($playerheadline)
				{
					$playerprofileinfo .= "<tr><td colspan='3' style='font-size:12px;'><b>" . $playerheadline . "</b></td></tr>";
				}
				
				if ($playersummary)
				{
					$playerprofileinfo .= "<tr><td colspan='3' style='color:#FFCC33;'>" . $playersummary . "</td></tr>";
				}
			}
			
			$playerprofileinfo .= "<tr><td colspan='3' style='font-size:6px;'>&nbsp;</td></tr>";
			$playerprofileinfo .= $playercurrentname;

			if ($isplayerprofileprivate)
			{
				$playerprofileinfo .= "<tr><td colspan='3' style='font-size:6px;'>&nbsp;</td></tr>";
				$playerprofileinfo .= "<tr><td colspan='3' style='font-size:12px;font-weight:bold;color:#FFCC33;'>" . $language_pack['thisprofileisprivate'] . "</td></tr>";
			}
			else
			{
				if ($playersteamrating)
				{
					$playerprofileinfo .= "<tr><td>" . $language_pack['steamrating'] . ":</td><td width='20px'>&nbsp;</td><td width='100%'><b>" . $playersteamrating . "</b></td></tr>";
				}
				
				if ($playermembersince)
				{
					$playerprofileinfo .= "<tr><td>" . $language_pack['steammembersince'] . ":</td><td width='20px'>&nbsp;</td><td width='100%'><b>" . $playermembersince . "</b></td></tr>";
				}
				
				if ($playerhoursplayed2wk)
				{
					$playerprofileinfo .= "<tr><td>" . $language_pack['steamplayingtime'] . ":</td><td width='20px'>&nbsp;</td><td width='100%'><b>" . $playerhoursplayed2wk . " hrs past 2 weeks</b></td></tr>";
				}
			}
			
			$playerprofileinfo .= "</table>";
			
			$steamprofiletable = "<table cellspacing='0' cellpadding='0' border='0'><tr><td valign='top'>" . $avatarimg . "</td><td>&nbsp;</td><td valign='top'><div class='post'><h1 class='title' style='background:none;padding:0;margin-top:-8px;'>" . $playername2 . "</h1></div><div style='background:none;padding:0;margin-top:-20px;max-width:300px'>" . $playerprofileinfo . "</div></td></tr></table>";
			
			$anchor = "<a href=\"http://steamcommunity.com/profiles/" . getfriendid($row['steamid']) . "\" onmouseover=\"showtip('" . str_replace("\"", "\\\"", str_replace("'", "\\'", str_replace("\\", "\\\\", $steamprofiletable))) . "');\" onmouseout=\"hidetip();\">";
			
			$playername2 = $anchor . $playername2 . "</a>";
		}
	}
	
	$timesrow = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS times FROM " . $mysql_tableprefix . "timedmaps WHERE steamid = '" . $id . "'"));
	$times = $timesrow['times'];

	$tpl->set("title", $language_pack['viewingplayer'] . ": " . $playername); // Window title
	$tpl->set("page_heading", $language_pack['viewingplayer'] . ": " . $playername2); // Page header

	$stats = new Template($templatefiles['player.tpl']);

	$stats->set("player_name", $playername);
	if ($showplayerflags)
	{
		$ip2c->get_country_code($row['ip']);

		$city_name = ($showplayercity ? $ip2c->get_city_name($row['ip']) : "");
		$country_name = htmlentities($ip2c->get_country_name($row['ip']), ENT_COMPAT, "UTF-8");

		$loc_lon = $ip2c->get_longitude($row['ip']);
		$loc_lat = $ip2c->get_latitude($row['ip']);

		$link_start = "";
		$link_stop = "";

		if (strlen($city_name))
			$city_name .= ", ";

		if ($loc_lon != 0.0 || $loc_lat != 0.0)
		{
			$link_start = "<a href=\"http://maps.google.com/maps?q=" . $loc_lat. "," . $loc_lon . "%28" . str_replace(" ", "+", (strlen($city_name) > 0 ? $city_name : "") . $country_name) . "%29" . $googlemaps_addparam . "\" target=\"_blank\">";
			$link_stop = "</a>";
		}

		$stats->set("player_country", "<tr><td>" . $language_pack['location'] . ":</td><td>" . $ip2c->get_country_flag($row['ip']) . $link_start . $city_name . $country_name . $link_stop . "</td></tr>");
	}

	$stats->set("player_steamid", $row['steamid']);
	$stats->set("player_steamid2", $row['steamid']);
	$stats->set("player_timedmaps", $times . " " . $language_pack['runs']);

	if (function_exists(bcadd)) $stats->set("player_url", getfriendid($row['steamid']) );
	else $stats->set("player_url", "<b>ERROR</b>");

	$stats->set("player_lastonline", date($lastonlineformat, $row['lastontime'] + ($dbtimemod * 3600)) . " (" . formatage(time() - $row['lastontime'] + ($dbtimemod * 3600)) . " " . $language_pack['ago'] . ")");
	$stats->set("player_playtime", gettotalplaytime($row));
	if ($game_version != 1)
	{
		$stats->set("player_playtime_realism", "&nbsp;&nbsp;" . $language_pack['realism'] . ": " . getplaytime($row['playtime_realism']) . "<br>&nbsp;&nbsp;" . $language_pack['mutations'] . ": " . getplaytime($row['playtime_mutations']) . "<br>");
		$stats->set("player_playtime_scavenge", "<br>&nbsp;&nbsp;" . $language_pack['scavenge'] . ": " . getplaytime($row['playtime_scavenge']) . "<br>&nbsp;&nbsp;" . $language_pack['realismversus'] . ": " . getplaytime($row['playtime_realismversus']));
	}
	else
	{
		$stats->set("player_playtime_realism", "");
		$stats->set("player_playtime_scavenge", "");
	}
	$stats->set("player_playtime_coop", getplaytime($row['playtime']));
	$stats->set("player_playtime_versus", getplaytime($row['playtime_versus']));
	$stats->set("player_playtime_survival", getplaytime($row['playtime_survival']));
	$stats->set("player_rank", $rank);

	// Points
	$stats->set("player_points", number_format($totalpoints));
	$stats->set("player_points_coop", number_format($row['points']));
	if ($game_version != 1)
	{
		$stats->set("player_points_realism", $language_pack['realism'] . ": " . number_format($row['points_realism']) . "<br>" . $language_pack['mutations'] . ": " . number_format($row['points_mutations']) . "<br>");
		$stats->set("player_points_scavenge", "<br><b>" . $language_pack['scavenge'] . ": " . number_format($row['points_scavenge_infected'] + $row['points_scavenge_survivors']) . "</b><br>&nbsp;&nbsp;" . $language_pack['survivors'] . ": " . number_format($row['points_scavenge_survivors']) . "<br>&nbsp;&nbsp;Infected: " . number_format($row['points_scavenge_infected']) . "<br><b>Realism&nbsp;Versus: " . number_format($row['points_realism_infected'] + $row['points_realism_survivors']) . "</b><br>&nbsp;&nbsp;Survivors: " . number_format($row['points_realism_survivors']) . "<br>&nbsp;&nbsp;Infected: " . number_format($row['points_realism_infected']));
	}
	else
	{
		$stats->set("player_points_realism", "");
		$stats->set("player_points_scavenge", "");
	}
	$stats->set("player_points_versus", number_format($row['points_infected'] + $row['points_survivors']));
	$stats->set("player_points_versus_sur", number_format($row['points_survivors']));
	$stats->set("player_points_versus_inf", number_format($row['points_infected']));
	$stats->set("player_points_survival", number_format($row['points_survival']));

	if ($row['infected_spawn_1'] == 0 || $row['infected_smoker_damage'] == 0) $stats->set("player_avg_smoker", "0");
	else $stats->set("player_avg_smoker", number_format($row['infected_smoker_damage'] / $row['infected_spawn_1'], 2));

	if ($row['infected_boomer_vomits'] == 0 || $row['infected_boomer_blinded'] == 0) $stats->set("player_avg_boomer", "0");
	else $stats->set("player_avg_boomer", number_format($row['infected_boomer_blinded'] / $row['infected_boomer_vomits'], 2));

	if ($row['infected_hunter_pounce_counter'] == 0 || $row['infected_hunter_pounce_dmg'] == 0) $stats->set("player_avg_hunter", "0");
	else $stats->set("player_avg_hunter", number_format($row['infected_hunter_pounce_dmg'] / $row['infected_hunter_pounce_counter'], 2));

	if ($row['infected_spawn_8'] == 0 || $row['infected_tank_damage'] == 0) $stats->set("player_avg_tank", "0");
	else $stats->set("player_avg_tank", number_format($row['infected_tank_damage'] / $row['infected_spawn_8'], 2));

	$stats->set("player_spawn_smoker", number_format($row['infected_spawn_1']));
	$stats->set("player_smoker_damage", number_format($row['infected_smoker_damage']));
	$stats->set("player_spawn_boomer", number_format($row['infected_spawn_2']));
	$stats->set("player_boomer_vomits", number_format($row['infected_boomer_vomits']));
	$stats->set("player_boomer_blinded", number_format($row['infected_boomer_blinded']));
	$stats->set("player_spawn_hunter", number_format($row['infected_spawn_3']));
	$stats->set("player_hunter_pounces", number_format($row['infected_hunter_pounce_counter']));
	$stats->set("player_hunter_damage", number_format($row['infected_hunter_pounce_dmg']));
	$stats->set("player_spawn_tank", number_format($row['infected_spawn_8']));
	$stats->set("player_tank_damage", number_format($row['infected_tank_damage']));

	if ($game_version != 1)
	{
		$avg_spitter = "0";
		if ($row['infected_spawn_4'] > 0 && $row['infected_spitter_damage'] > 0)
			$avg_spitter = number_format($row['infected_spitter_damage'] / $row['infected_spawn_4'], 2);

		$avg_jockey = "0";
		if ($row['infected_spawn_5'] > 0 && $row['infected_jockey_damage'] > 0)
			$avg_jockey = number_format($row['infected_jockey_damage'] / $row['infected_spawn_5'], 2);

		$avg_charger = "0";
		if ($row['infected_spawn_6'] > 0 && $row['infected_charger_damage'] > 0)
			$avg_charger = number_format($row['infected_charger_damage'] / $row['infected_spawn_6'], 2);

		$l4d2_special_infected = "";
		$l4d2_special_infected .= "<tr align=\"left\" onmouseover=\"showtip('Spitter damage average per spawn<br>&nbsp;&nbsp;damage: " . number_format($row['infected_spitter_damage']) . "<br>&nbsp;&nbsp;spawns: " . number_format($row['infected_spawn_4']) . "');\" onmouseout=\"hidetip();\"><td>Spitter Average:</td><td>" . $avg_spitter . "</td></tr>\n";
		$l4d2_special_infected .= "<tr align=\"left\" onmouseover=\"showtip('Jockey damage average per spawn<br>&nbsp;&nbsp;damage: " . number_format($row['infected_jockey_damage']) . "<br>&nbsp;&nbsp;spawns: " . number_format($row['infected_spawn_5']) . "<br>&nbsp;&nbsp;rides: " . number_format($row['jockey_rides']) . "<br>&nbsp;&nbsp;ride time: " . formatage($row['infected_jockey_ridetime']) . "');\" onmouseout=\"hidetip();\"><td>Jockey Average:</td><td>" . $avg_jockey . "</td></tr>\n";
		$l4d2_special_infected .= "<tr align=\"left\" onmouseover=\"showtip('Charger damage average per spawn<br>&nbsp;&nbsp;impacts: " . number_format($row['charger_impacts']) . "<br>&nbsp;&nbsp;damage: " . number_format($row['infected_charger_damage']) . "<br>&nbsp;&nbsp;spawns: " . number_format($row['infected_spawn_6']) . "');\" onmouseout=\"hidetip();\"><td>Charger Average:</td><td>" . $avg_charger . "</td></tr>";

		$stats->set("l4d2_special_infected", $l4d2_special_infected);
	}
	else
		$stats->set("l4d2_special_infected", "");

	if ($row['kills'] == 0 || $row['headshots'] == 0) $stats->set("player_ratio", "0");
	else $stats->set("player_ratio", number_format($row['headshots'] / $row['kills'], 4) * 100);

	// Not useful until the time played as a Suvivor and Infected is separated
	//$stats->set("player_kpm", number_format($row['kills'] / $row['playtime'], 4));

	// PPM
	$totalplaytime = gettotalplaytimecalc($row);
	$stats->set("player_ppm", number_format(getppm($totalpoints, $totalplaytime), 2));
	$stats->set("player_ppm_coop", number_format(getppm($row['points'], $row['playtime']), 2));
	if ($game_version != 1)
	{
		$stats->set("player_ppm_realism", $language_pack['realism'] . ": " . number_format(getppm($row['points_realism'], $row['playtime_realism']), 2) . "<br>" . $language_pack['mutations'] . ": " . number_format(getppm($row['points_mutations'], $row['playtime_mutations']), 2) . "<br>");
		$stats->set("player_ppm_scavenge", "<br>" . $language_pack['scavenge'] . ": " . number_format(getppm($row['points_scavenge_infected'] + $row['points_scavenge_survivors'], $row['playtime_scavenge']), 2) . "<br>" . $language_pack['realismversus'] . ": " . number_format(getppm($row['points_realism_infected'] + $row['points_realism_survivors'], $row['playtime_realismversus']), 2));
	}
	else
	{
		$stats->set("player_ppm_realism", "");
		$stats->set("player_ppm_scavenge", "");
	}
	$stats->set("player_ppm_versus", number_format(getppm($row['points_infected'] + $row['points_survivors'], $row['playtime_versus']), 2));
	$stats->set("player_ppm_survival", number_format(getppm($row['points_survival'], $row['playtime_survival']), 2));

	$stats->set("infected_killed", number_format($row['kills']));
	$stats->set("melee_kills", number_format($row['melee_kills']));
	$stats->set("survivors_killed", number_format($row['versus_kills_survivors'] + $row['scavenge_kills_survivors'] + $row['realism_kills_survivors'] + $row['mutations_kills_survivors']));
	$stats->set("survivors_killed_versus", number_format($row['versus_kills_survivors']));
	if ($game_version != 1)
		$stats->set("survivors_killed_scavenge", "<br>" . $language_pack['scavenge'] . ": " . number_format($row['scavenge_kills_survivors']) . "<br>" . $language_pack['realismversus'] . ": " . number_format($row['realism_kills_survivors']) . "<br>" . $language_pack['mutations'] . ": " . number_format($row['mutations_kills_survivors']));
	else
		$stats->set("survivors_killed_scavenge", "");
	$stats->set("player_headshots", number_format($row['headshots']));

	$arr_rank = array();

	/* Simple Rank Shower */
	if ($rank == 1) {
		$arr_rank[] = "<div class='rank lvl1'>" . $rank . "</div>";
	} elseif ($rank == 2) {
		$arr_rank[] = "<div class='rank lvl2'>" . $rank . "</div>";
	} elseif ($rank == 3) {
		$arr_rank[] = "<div class='rank lvl3'>" . $rank . "</div>";
	} elseif ($rank == 4) {
		$arr_rank[] = "<div class='rank lvl4-9'>" . $rank . "</div>";
	} elseif ($rank == 5) {
		$arr_rank[] = "<div class='rank lvl4-9'>" . $rank . "</div>";
	} elseif ($rank == 6) {
		$arr_rank[] = "<div class='rank lvl4-9'>" . $rank . "</div>";
	} elseif ($rank == 7) {
		$arr_rank[] = "<div class='rank lvl4-9'>" . $rank . "</div>";
	} elseif ($rank == 8) {
		$arr_rank[] = "<div class='rank lvl4-9'>" . $rank . "</div>";
	} elseif ($rank == 9) {
		$arr_rank[] = "<div class='rank lvl4-9'>" . $rank . "</div>";
	} elseif ($rank >= 10) {
		$arr_rank[] = "<div class='rank lvl10-999'>" . $rank . "</div>";
	}
	/* End Simple Rank Shower */
	
	if (count($arr_rank) == 0)
		$arr_rank[] = "<div class='rank lvl10-999'>N/A</div>";

	$arr_achievements = array();
	$maxachivements = 30;
	
	//ach 1
	if ($row['kills'] > $population_minkills) {$arr_achievements[] = "";}
	//ach 2
	if ($row['melee_kills'] >= 1500) {$arr_achievements[] = "";}
	//ach 3
	if ($row['headshots'] >= 500) {$arr_achievements[] = "";}
	//ach 4	
	if ($row['playtime'] >= 500) {$arr_achievements[] = "";}
	//ach 5
	if ($row['award_witchdisturb'] >= 15) {$arr_achievements[] = "";}
	//ach 6
	if ($row['award_teamkill'] >= 15) {$arr_achievements[] = "";}
	//ach 7
	if ($row['award_fincap'] >= 30) {$arr_achievements[] = "";}
	//ach 8
	if ($row['kill_boomer'] >= 4) {$arr_achievements[] = "";}
	//ach 9
	if ($row['award_pills'] >= 1) {$arr_achievements[] = "";}
	//ach 10
	if ($row['award_tankkillnodeaths'] >= 10) {$arr_achievements[] = "";}
	//ach 11
	if ($row['award_medkit'] >= 4) {$arr_achievements[] = "";}

	if (count($arr_achievements) > 0) {
		$arr_achievements[$maxachivements] = count($arr_achievements);
	} elseif (count($arr_achievements) == 0) {
		$arr_achievements[] = "0";
	}

	arsort($arr_survivor_awards);
	arsort($arr_infected_awards);

	$stats->set("arr_survivor_awards", $arr_survivor_awards);
	$stats->set("arr_infected_awards", $arr_infected_awards);
	$stats->set("arr_achievements", $arr_achievements);
	$stats->set("arr_rank", $arr_rank);

	$output = $stats->fetch($templatefiles['player.tpl']);
} else {
	$tpl->set("title", $language_pack['viewingplayer'] . ": INVALID"); // Window title
	$tpl->set("page_heading", $language_pack['viewingplayer'] . ": INVALID"); // Page header

	$output = "This player is no longer in our stats system. If this was a valid player before, it is likely they were removed due to inactivity.";
}

$tpl->set('body', trim($output));

// Output the top 10
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch($templatefiles['layout.tpl']);
?>
