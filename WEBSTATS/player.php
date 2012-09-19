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
$tpl = new Template("./templates/" . $templatefiles['layout.tpl']);

// Set Steam ID as var, and quit on hack attempt
if (strstr($_GET['steamid'], "/")) exit;
$id = mysql_real_escape_string($_GET['steamid']);

setcommontemplatevariables($tpl);

$result = mysql_query("SELECT * FROM " . $mysql_tableprefix . "players WHERE steamid = '" . $id . "'");
$row = mysql_fetch_array($result);
$totalpoints = $row['points'] + $row['points_survival'] + $row['points_survivors'] + $row['points_infected'] + ($game_version != 1 ? $row['points_realism'] + $row['points_scavenge_survivors'] + $row['points_scavenge_infected'] + $row['points_realism_survivors'] + $row['points_realism_infected'] + $row['points_mutations'] : 0);
$rankrow = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS rank FROM " . $mysql_tableprefix . "players WHERE points + points_survival + points_survivors + points_infected" . ($game_version != 1 ? " + points_realism + points_scavenge_survivors + points_scavenge_infected + points_realism_survivors + points_realism_infected + points_mutations" : "") . " >= '" . $totalpoints . "'"));
$rank = $rankrow['rank'];

$arr_kills = array();
$arr_kills['Common Infected'] = array($row['kill_infected'], "Common Infected killed");
$arr_kills['Hunters'] = array($row['kill_hunter'], "Hunters killed");
$arr_kills['Smokers'] = array($row['kill_smoker'], "Smokers killed");
$arr_kills['Boomers'] = array($row['kill_boomer'], "Boomers killed");

if ($game_version != 1)
{
	$arr_kills['Spitters'] = array($row['kill_spitter'], "Spitters killed");
	$arr_kills['Jockeys'] = array($row['kill_jockey'], "Jockeys killed");
	$arr_kills['Chargers'] = array($row['kill_charger'], "Chargers killed");
}

$arr_survivor_awards = array();
$arr_survivor_awards['Pills Given'] = array($row['award_pills'], "Pills given to another Survivor");
$arr_survivor_awards['Medkits Given'] = array($row['award_medkit'], "Healed another Survivor");
$arr_survivor_awards['Saved Friendlies from Hunters'] = array($row['award_hunter'], "Saved a Survivor from Hunters");
$arr_survivor_awards['Saved Friendlies from Smokers'] = array($row['award_smoker'], "Saved a Survivor from Smokers");
if ($game_version != 1)
{
	$arr_survivor_awards['Defibrillators Used'] = array($row['award_defib'], "Dead Survivors brought back to life");
	$arr_survivor_awards['Adrenalines Given'] = array($row['award_adrenaline'], "Adrenalines given to another Survivor");
	$arr_survivor_awards['Saved Friendlies from Jockeys'] = array($row['award_jockey'], "Saved a Survivor from Jockeys");
	$arr_survivor_awards['Saved Friendlies from Chargers'] = array($row['award_charger'], "Saved a Survivor from Chargers");
	$arr_survivor_awards['Leveled Charges'] = array($row['award_matador'], "Killed a Charging Charger with a melee weapon");
	$arr_survivor_awards['Gas Canisters Poured'] = array($row['award_gascans_poured'], "Successfully poured Gas Canisters");
	$arr_survivor_awards['Ammo Upgrades Deployed'] = array($row['award_upgrades_added'], "Ammo Upgrades Deployed");
}
$arr_survivor_awards['Crowned Witches'] = array($row['award_witchcrowned'], "Successfully Crowned Witches");
$arr_survivor_awards['Protected Friendlies'] = array($row['award_protect'], "Protected another Survivor from a common Infected");
$arr_survivor_awards['Revived Friendlies'] = array($row['award_revive'], "Helped Incapacitated Survivors");
$arr_survivor_awards['Rescued Friendlies'] = array($row['award_rescue'], "Rescued Survivors from rescue rooms");
$arr_survivor_awards['Tanks Killed with Team'] = array($row['award_tankkill'], "Killed Tanks");
$arr_survivor_awards['Tanks Killed with No Deaths'] = array($row['award_tankkillnodeaths'], "Killed Tanks with No Deaths");
$arr_survivor_awards['Safe Houses Reached with All Survivors'] = array($row['award_allinsafehouse'], "Safe Houses Reached with No Deaths");
$arr_survivor_awards['Campaigns Completed'] = array($row['award_campaigns'], "Campaigns Completed");

$arr_infected_awards = array();
$arr_infected_awards['All Survivors Dead'] = array($row['award_infected_win'], "All Survivors dead");
$arr_infected_awards['Perfect Blindness'] = array($row['award_perfect_blindness'], "All Survivors blinded");
$arr_infected_awards['Death From Above'] = array($row['award_pounce_perfect'], "Perfect Hunter pounces");
$arr_infected_awards['Pain From Above'] = array($row['award_pounce_nice'], "Very good Hunter pounces");
$arr_infected_awards['Bulldozer'] = array($row['award_bulldozer'], "Dealing massive damage to Survivor");
$arr_infected_awards['Survivors Incapacitated'] = array($row['award_survivor_down'], "Survivors incapacitated");
$arr_infected_awards['Caused Ledge Grab'] = array($row['award_ledgegrab'], "Caused Survivors to grab a ledge");
if ($game_version != 1)
{
	$arr_infected_awards['Scattering Ram'] = array($row['award_scatteringram'], "Charged a Scattering Ram at a group of survivors");
}

$arr_demerits = array();
$arr_demerits['Friendly Fire Incidents'] = array($row['award_friendlyfire'], "Survivors harmed");
$arr_demerits['Incapacitated Friendlies'] = array($row['award_fincap'], "Survivors incapacitated");
$arr_demerits['Teammates Killed'] = array($row['award_teamkill'], "Survivors killed");
$arr_demerits['Friendlies Left For Dead'] = array($row['award_left4dead'], "Survivors left to die");
$arr_demerits['Infected Let In Safe Room'] = array($row['award_letinsafehouse'], "Infected let in safe room");
$arr_demerits['Witches Disturbed'] = array($row['award_witchdisturb'], "Witches disturbed");

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
			
			if ($playersummary == "No information given.")
			{
				$playersummary = "";
			}
			
			$playerprofileinfo = "<table cellpadding='0' cellspacing='0' border='0' style='font-size:9px;'>";
			
			if ($playercurrentname != $playername2)
			{
				$playercurrentname = "<tr><td><i>Current&nbsp;name:</i></td><td width='20px'>&nbsp;</td><td width='100%'><i><b>" . $playercurrentname . "</b></i></td></tr>";
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
				$playerprofileinfo .= "<tr><td colspan='3' style='font-size:12px;font-weight:bold;color:#FFCC33;'>This profile is private.</td></tr>";
			}
			else
			{
				if ($playersteamrating)
				{
					$playerprofileinfo .= "<tr><td>Steam&nbsp;Rating:</td><td width='20px'>&nbsp;</td><td width='100%'><b>" . $playersteamrating . "</b></td></tr>";
				}
				
				if ($playermembersince)
				{
					$playerprofileinfo .= "<tr><td>Steam&nbsp;Member&nbsp;Since:</td><td width='20px'>&nbsp;</td><td width='100%'><b>" . $playermembersince . "</b></td></tr>";
				}
				
				if ($playerhoursplayed2wk)
				{
					$playerprofileinfo .= "<tr><td>Steam&nbsp;Playing&nbsp;Time:</td><td width='20px'>&nbsp;</td><td width='100%'><b>" . $playerhoursplayed2wk . " hrs past 2 weeks</b></td></tr>";
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

	$tpl->set("title", "Viewing Player: " . $playername); // Window title
	$tpl->set("page_heading", "Viewing Player: " . $playername2); // Page header

	$stats = new Template("./templates/" . $templatefiles['player.tpl']);

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

		$stats->set("player_country", "<tr><td>Location:</td><td>" . $ip2c->get_country_flag($row['ip']) . $link_start . $city_name . $country_name . $link_stop . "</td></tr>");
	}
	$stats->set("player_steamid", $row['steamid']);

	$stats->set("player_timedmaps", $times . " runs");

	if (function_exists(bcadd)) $stats->set("player_url", "<a href=\"http://steamcommunity.com/profiles/" . getfriendid($row['steamid']) . "\">" . $playername . "'s Community Page</a>");
	else $stats->set("player_url", "<b>Community page URL disabled</b>");

	$stats->set("player_lastonline", date($lastonlineformat, $row['lastontime'] + ($dbtimemod * 3600)) . " (" . formatage(time() - $row['lastontime'] + ($dbtimemod * 3600)) . " ago)");
	$stats->set("player_playtime", gettotalplaytime($row));
	if ($game_version != 1)
	{
		$stats->set("player_playtime_realism", "&nbsp;&nbsp;Realism: " . getplaytime($row['playtime_realism']) . "<br>&nbsp;&nbsp;Mutations: " . getplaytime($row['playtime_mutations']) . "<br>");
		$stats->set("player_playtime_scavenge", "<br>&nbsp;&nbsp;Scavenge: " . getplaytime($row['playtime_scavenge']) . "<br>&nbsp;&nbsp;Realism&nbsp;Versus: " . getplaytime($row['playtime_realismversus']));
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
		$stats->set("player_points_realism", "Realism: " . number_format($row['points_realism']) . "<br>Mutations: " . number_format($row['points_mutations']) . "<br>");
		$stats->set("player_points_scavenge", "<br><b>Scavenge: " . number_format($row['points_scavenge_infected'] + $row['points_scavenge_survivors']) . "</b><br>&nbsp;&nbsp;Survivors: " . number_format($row['points_scavenge_survivors']) . "<br>&nbsp;&nbsp;Infected: " . number_format($row['points_scavenge_infected']) . "<br><b>Realism&nbsp;Versus: " . number_format($row['points_realism_infected'] + $row['points_realism_survivors']) . "</b><br>&nbsp;&nbsp;Survivors: " . number_format($row['points_realism_survivors']) . "<br>&nbsp;&nbsp;Infected: " . number_format($row['points_realism_infected']));
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
		$stats->set("player_ppm_realism", "Realism: " . number_format(getppm($row['points_realism'], $row['playtime_realism']), 2) . "<br>Mutations: " . number_format(getppm($row['points_mutations'], $row['playtime_mutations']), 2) . "<br>");
		$stats->set("player_ppm_scavenge", "<br>Scavenge: " . number_format(getppm($row['points_scavenge_infected'] + $row['points_scavenge_survivors'], $row['playtime_scavenge']), 2) . "<br>Realism&nbsp;Versus: " . number_format(getppm($row['points_realism_infected'] + $row['points_realism_survivors'], $row['playtime_realismversus']), 2));
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
		$stats->set("survivors_killed_scavenge", "<br>Scavenge: " . number_format($row['scavenge_kills_survivors']) . "<br>Realism&nbsp;Versus: " . number_format($row['realism_kills_survivors']) . "<br>Mutations: " . number_format($row['mutations_kills_survivors']));
	else
		$stats->set("survivors_killed_scavenge", "");
	$stats->set("player_headshots", number_format($row['headshots']));


	$arr_achievements = array();

	if ($row['kills'] > $population_minkills) {
		$popkills = getpopulation($row['kills'], $population_file, $population_cities);
		$arr_achievements[] = "<td><b>City Buster</b></td>
		<td>" . $playername . " has killed more zombies than the entire population of <a href=\"http://google.com/search?q=site:en.wikipedia.org+" . $popkills[0] . "&btnI=1\">" . $popkills[0] . "</a>, population " . number_format($popkills[1]) . ".<br />
		That is almost more than the entire population of <a href=\"http://google.com/search?q=site:en.wikipedia.org+" . $popkills[2] . "&btnI=1\">" . $popkills[2] . "</a>, population " . number_format($popkills[3]) . ".</td>";
	}

	if (count($arr_achievements) == 0)
		$arr_achievements[] = "<td><b>N/A</b></td><td>" . $playername . " has not yet earned any achievements.</td>";

	arsort($arr_kills);
	arsort($arr_survivor_awards);
	arsort($arr_infected_awards);
	arsort($arr_demerits);

	$stats->set("arr_kills", $arr_kills);
	$stats->set("arr_survivor_awards", $arr_survivor_awards);
	$stats->set("arr_infected_awards", $arr_infected_awards);
	$stats->set("arr_demerits", $arr_demerits);
	$stats->set("arr_achievements", $arr_achievements);

	$output = $stats->fetch("./templates/" . $templatefiles['player.tpl']);
} else {
	$tpl->set("title", "Viewing Player: INVALID"); // Window title
	$tpl->set("page_heading", "Viewing Player: INVALID"); // Page header

	$output = "This player is no longer in our stats system. If this was a valid player before, it is likely they were removed due to inactivity.";
}

$tpl->set('body', trim($output));

// Output the top 10
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch("./templates/" . $templatefiles['layout.tpl']);
?>
