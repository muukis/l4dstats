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

	// Multilang support
		//-- BASE
	$tpl->set("lang_tpl_layout_ply", $lang_tpl_layout_ply);
	$tpl->set("lang_tpl_layout_points", $lang_tpl_layout_points);
	$tpl->set("lang_tpl_layout_mode", $lang_tpl_layout_mode);
	$tpl->set("lang_tpl_layout_playtime", $lang_tpl_layout_playtime);
		//-- MENU
	$tpl->set("lang_tpl_layout_menutitle", $lang_tpl_layout_menutitle);
	$tpl->set("lang_tpl_layout_top10", $lang_tpl_layout_top10);
	$tpl->set("lang_tpl_layout_plyonline", $lang_tpl_layout_plyonline);
	$tpl->set("lang_tpl_layout_plyrank", $lang_tpl_layout_plyrank);
	$tpl->set("lang_tpl_layout_plysearch", $lang_tpl_layout_plysearch);
	$tpl->set("lang_tpl_layout_plyaward", $lang_tpl_layout_plyaward);
	$tpl->set("lang_tpl_layout_modestats", $lang_tpl_layout_modestats);
	$tpl->set("lang_tpl_layout_servstats", $lang_tpl_layout_servstats);
		//-- SEARCH
	$tpl->set("lang_tpl_layout_search", $lang_tpl_layout_search);
	$tpl->set("lang_tpl_layout_search_btn", $lang_tpl_layout_search_btn);
	
	// End

// Set Steam ID as var, and quit on hack attempt
if (strstr($_GET['steamid'], "/")) exit;
$id = mysql_real_escape_string($_GET['steamid']);

setcommontemplatevariables($tpl);

$result = mysql_query("SELECT * FROM " . $mysql_tableprefix . "players WHERE steamid = '" . $id . "'");
$row = mysql_fetch_array($result);
$totalpoints = $row['points'] + $row['points_survival'] + $row['points_survivors'] + $row['points_infected'] + ($game_version != 1 ? $row['points_realism'] + $row['points_scavenge_survivors'] + $row['points_scavenge_infected'] + $row['points_realism_survivors'] + $row['points_realism_infected'] + $row['points_mutations'] : 0);
$rankrow = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS rank FROM " . $mysql_tableprefix . "players WHERE points + points_survival + points_survivors + points_infected" . ($game_version != 1 ? " + points_realism + points_scavenge_survivors + points_scavenge_infected + points_realism_survivors + points_realism_infected + points_mutations" : "") . " >= '" . $totalpoints . "'"));
$rank = $rankrow['rank'];

$arr_survivor_awards = array();
$arr_survivor_awards[$lang_award_pills] = array($row['award_pills'], $lang_award_pills_desc);
$arr_survivor_awards[$lang_award_medkit] = array($row['award_medkit'], $lang_award_medkit_desc);
$arr_survivor_awards[$lang_award_shunt] = array($row['award_hunter'], $lang_award_shunt_desc);
$arr_survivor_awards[$lang_award_ssmoke] = array($row['award_smoker'], $lang_award_ssmoke_desc);
if ($game_version != 1)
{
	$arr_survivor_awards[$lang_award_defib] = array($row['award_defib'], $lang_award_defib_desc);
	$arr_survivor_awards[$lang_award_andren] = array($row['award_adrenaline'], $lang_award_andren_desc);
	$arr_survivor_awards[$lang_award_jockey_save] = array($row['award_jockey'], $lang_award_jockey_save_desc);
	$arr_survivor_awards[$lang_award_charger] = array($row['award_charger'], $lang_award_charger);
	$arr_survivor_awards[$lang_award_charger_lvld] = array($row['award_matador'], $lang_award_charger_lvld_desc);
	$arr_survivor_awards[$lang_award_canister] = array($row['award_gascans_poured'], $lang_award_canister_desc);
	$arr_survivor_awards[$lang_award_ammoup] = array($row['award_upgrades_added'], $lang_award_ammoup_desc);
}
$arr_survivor_awards[$lang_award_witch_crowned] = array($row['award_witchcrowned'], $lang_award_witch_crowned_desc);
$arr_survivor_awards[$lang_award_rescue_1] = array($row['award_protect'], $lang_award_rescue_1_desc);
$arr_survivor_awards[$lang_award_rescue_2] = array($row['award_revive'], $lang_award_rescue_2_desc);
$arr_survivor_awards[$lang_award_rescue_3] = array($row['award_rescue'], $lang_award_rescue_3_desc);
$arr_survivor_awards[$lang_award_misc_3] = array($row['award_tankkill'], $lang_award_misc_3_desc);
$arr_survivor_awards[$lang_award_misc_4] = array($row['award_tankkillnodeaths'], $lang_award_misc_4_desc);
$arr_survivor_awards[$lang_award_misc_2] = array($row['award_allinsafehouse'], $lang_award_misc_2_desc);
$arr_survivor_awards[$lang_award_misc_1] = array($row['award_campaigns'], $lang_award_misc_1_desc);

$arr_infected_awards = array();
$arr_infected_awards[$lang_award_inf_1] = array($row['award_infected_win'], $lang_award_inf_1_desc);
$arr_infected_awards[$lang_award_inf_2] = array($row['award_perfect_blindness'], $lang_award_inf_2_desc);
$arr_infected_awards[$lang_award_inf_3] = array($row['award_pounce_perfect'], $lang_award_inf_3_desc);
$arr_infected_awards[$lang_award_inf_4] = array($row['award_pounce_nice'], $lang_award_inf_4_desc);
$arr_infected_awards[$lang_award_inf_5] = array($row['award_bulldozer'], $lang_award_inf_5_desc);
$arr_infected_awards[$lang_award_inf_6] = array($row['award_survivor_down'], $lang_award_inf_6_desc);
$arr_infected_awards[$lang_award_inf_7] = array($row['award_ledgegrab'], $lang_award_inf_7_desc);
if ($game_version != 1)
{
	$arr_infected_awards[$lang_award_inf_8] = array($row['award_scatteringram'], $lang_award_inf_8_desc);
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
			
			if ($playersummary == $lang_xml_ply_sum)
			{
				$playersummary = "";
			}
			
			$playerprofileinfo = "<table cellpadding='0' cellspacing='0' border='0' style='font-size:9px;'>";
			
			if ($playercurrentname != $playername2)
			{
				$playercurrentname = "<tr><td><i>" . $lang_xml_ply_nam . "</i></td><td width='20px'>&nbsp;</td><td width='100%'><i><b>" . $playercurrentname . "</b></i></td></tr>";
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
				$playerprofileinfo .= "<tr><td colspan='3' style='font-size:12px;font-weight:bold;color:#FFCC33;'>" . $lang_xml_ply_private . "</td></tr>";
			}
			else
			{
				if ($playersteamrating)
				{
					$playerprofileinfo .= "<tr><td>" . $lang_xml_ply_steam_rating . "</td><td width='20px'>&nbsp;</td><td width='100%'><b>" . $playersteamrating . "</b></td></tr>";
				}
				
				if ($playermembersince)
				{
					$playerprofileinfo .= "<tr><td>" . $lang_xml_ply_steam_member . "</td><td width='20px'>&nbsp;</td><td width='100%'><b>" . $playermembersince . "</b></td></tr>";
				}
				
				if ($playerhoursplayed2wk)
				{
					$playerprofileinfo .= "<tr><td>" . $lang_xml_ply_steam_playing . "</td><td width='20px'>&nbsp;</td><td width='100%'><b>" . $playerhoursplayed2wk . " hrs past 2 weeks</b></td></tr>";
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

	$tpl->set("title", $lang_tpl_player . " " . $playername); // Window title
	$tpl->set("page_heading", $lang_tpl_player . " " . $playername2); // Page header

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

		$stats->set("player_country", "<tr><td>" . $lang_tpl_location . "</td><td>" . $ip2c->get_country_flag($row['ip']) . $link_start . $city_name . $country_name . $link_stop . "</td></tr>");
	}
	$stats->set("player_steamid", $row['steamid']);
	$stats->set("player_steamid2", $row['steamid']);
	
	// Multilang support
	
	$stats->set("lang_tpl_player_surv", $lang_tpl_player_surv);
	$stats->set("lang_tpl_player_infe", $lang_tpl_player_infe);
	$stats->set("lang_tpl_player_id1", $lang_tpl_player_id1);
	$stats->set("lang_tpl_player_id2", $lang_tpl_player_id2);
	$stats->set("lang_tpl_player_id3", $lang_tpl_player_id3);
	$stats->set("lang_tpl_player_id4", $lang_tpl_player_id4);
	$stats->set("lang_tpl_player_id_title1", $lang_tpl_player_id_title1);
	$stats->set("lang_tpl_player_id_title2", $lang_tpl_player_id_title2);
	// Tip
	$stats->set("lang_tpl_player_id3_tip", $lang_tpl_player_id3_tip);
		// Shared
		$stats->set("lang_tpl_points", $lang_tpl_points);
		$stats->set("lang_tpl_ikill", $lang_tpl_ikill);
		$stats->set("lang_tpl_skill", $lang_tpl_skill);
		$stats->set("lang_tpl_tip_points", $lang_tpl_tip_points);
		$stats->set("lang_tpl_tip_ikill", $lang_tpl_tip_ikill);
		$stats->set("lang_tpl_tip_skill", $lang_tpl_tip_skill);
	
	// End

	$stats->set("player_timedmaps", $times . " runs");

	if (function_exists(bcadd)) $stats->set("player_url", getfriendid($row['steamid']) );
	else $stats->set("player_url", "<b>ERROR</b>");

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

	$output = $stats->fetch("./templates/" . $templatefiles['player.tpl']);
} else {
	$tpl->set("title", $lang_tpl_player . " INVALID"); // Window title
	$tpl->set("page_heading", $lang_tpl_player . " INVALID"); // Page header

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
