<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Player achievement progress page - "player_awards.php"
================================================
*/

// Include the primary PHP functions file
include("./common.php");

// Load outer template
$tpl = new Template($templatefiles['layout.tpl']);

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

$arr_kills = array();
$arr_kills[$lang_kills_commons] = array($row['kill_infected'], $lang_kills_commons_title);
$arr_kills[$lang_kills_hunters] = array($row['kill_hunter'], $lang_kills_hunters_title);
$arr_kills[$lang_kills_smokers] = array($row['kill_smoker'], $lang_kills_smokers_title);
$arr_kills[$lang_kills_boomers] = array($row['kill_boomer'], $lang_kills_boomers_title);

if ($game_version != 1)
{
	$arr_kills[$lang_kills_spitters] = array($row['kill_spitter'], $lang_kills_spitters_title);
	$arr_kills[$lang_kills_jockeys] = array($row['kill_jockey'], $lang_kills_jockeys_title);
	$arr_kills[$lang_kills_chargers] = array($row['kill_charger'], $lang_kills_chargers_title);
}

$arr_demerits = array();
$arr_demerits[$lang_kills_dem_1] = array($row['award_friendlyfire'], $lang_kills_dem_1_title);
$arr_demerits[$lang_kills_dem_2] = array($row['award_fincap'], $lang_kills_dem_2_title);
$arr_demerits[$lang_kills_dem_3] = array($row['award_teamkill'], $lang_kills_dem_3_title);
$arr_demerits[$lang_kills_dem_4] = array($row['award_left4dead'], $lang_kills_dem_4_title);
$arr_demerits[$lang_kills_dem_5] = array($row['award_letinsafehouse'], $lang_kills_dem_5_title);
$arr_demerits[$lang_kills_dem_6] = array($row['award_witchdisturb'], $lang_kills_dem_6_title);

if (mysql_num_rows($result) > 0)
{
	$playername = htmlentities($row['name'], ENT_COMPAT, "UTF-8");
	$playername2 = $playername;

	$timesrow = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS times FROM " . $mysql_tableprefix . "timedmaps WHERE steamid = '" . $id . "'"));
	$times = $timesrow['times'];

	$tpl->set("title", $playername . " :: " . $lang_tpl_player_stats); // Window title
	$tpl->set("page_heading","<a href='player.php?steamid=" . $row['steamid'] . "'>" . $playername2 . " :: " . $lang_tpl_player_stats . "</a>"); // Page header

	$stats = new Template($templatefiles['player_stats.tpl']);

	$stats->set("player_name", $playername);

	$stats->set("player_steamid", $row['steamid']);

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
	
	// Multilang support
	$stats->set("lang_tpl_title_sub", $lang_tpl_player_stats_sub);
	$stats->set("lang_tpl_rank", $lang_tpl_rank);
	$stats->set("lang_tpl_points", $lang_tpl_points);
	$stats->set("lang_tpl_ikill", $lang_tpl_ikill);
	$stats->set("lang_tpl_skill", $lang_tpl_skill);
	$stats->set("lang_tpl_headshot", $lang_tpl_headshot);
	$stats->set("lang_tpl_headratio", $lang_tpl_headratio);
	$stats->set("lang_tpl_ppm", $lang_tpl_ppm);
	$stats->set("lang_tpl_tip_rank", $lang_tpl_tip_rank);
	$stats->set("lang_tpl_tip_points", $lang_tpl_tip_points);
	$stats->set("lang_tpl_tip_ikill", $lang_tpl_tip_ikill);
	$stats->set("lang_tpl_tip_skill", $lang_tpl_tip_skill);


	$arr_achievements = array();
	$arr_achievements2 = array();
	// Achivement 1
	if ($row[$ach01_award] > $population_minkills) {
		$popkills = getpopulation($row[$ach01_award], $population_file, $population_cities);
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach01.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach01 . "<h3>
				<h5>
					Killed more zombies than the entire population of <a href=\"http://google.com/search?q=site:en.wikipedia.org+" . $popkills[0] . "&btnI=1\">" . $popkills[0] . "</a>, population <b>" . number_format($popkills[1]) . "</b>.<br />
						That is almost more than the entire population of <a href=\"http://google.com/search?q=site:en.wikipedia.org+" . $popkills[2] . "&btnI=1\">" . $popkills[2] . "</a>, population <b>" . number_format($popkills[3]) . "</b>.
				</h5>
				</div>
			</div>
		</div>
		<br clear='left'></br>
		";
	}
	// Achivement 2
	if ($row[$ach02_award] >= $ach02_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach02.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach02 . "<h3>
				<h5>
					" . $ach02_desc . "
				</h5>
				<div class='achievement-progress-text'> " . $ach02_progress . " / " . $ach02_progress . "</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='100%'> 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>
		";
	}
	// Achivement 3
	if ($row[$ach03_award] >= $ach03_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach03.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach03 . "<h3>
				<h5>
					" . $ach03_desc . "
				</h5>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
	// Achivement 4
	if ($row[$ach04a_award] >= $ach04a_progress && $row[$ach04a_award] < $ach04b_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach04a.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach04a . "<h3>
				<h5>
					" . $ach04a_desc . "
				</h5>
				<div class='achievement-progress-text'> " . $row['playtime'] . " / 1500</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='" . $row['playtime'] / 15 . "%' > 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	} elseif ($row[$ach04b_progress] >= $ach04b_progress && $row[$ach04b_progress] > $ach04a_progress) { 
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach04b.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach04b . "<h3>
				<h5>
					" . $ach04b_desc . "
				</h5>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
	// Achivement 5
	if ($row[$ach05_award] >= $ach05_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach05a.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach05 . "<h3>
				<h5>
					" . $ach05_desc . "
				</h5>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
	// Achivement 6
	if ($row[$ach06_award] >= $ach06_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach06a.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach06 . "<h3>
				<h5>
					" . $ach06_desc . "
				</h5>
				<h4 onmouseover=\"showtip('". $badachivement_desc ."');\" onmouseout=\"hidetip();\">
					<span style='color:red;'>" . $badachivement . "</span>
				</h4>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
	// Achivement 7
	if ($row[$ach07_award] >= $ach07_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach07a.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach07 . "<h3>
				<h5>
					" . $ach07_desc . "
				</h5>
				<h4 onmouseover=\"showtip('". $badachivement_desc ."');\" onmouseout=\"hidetip();\">
					<span style='color:red;'>" . $badachivement . "</span>
				</h4>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
	// Achivement 8
	if ($row[$ach08_award] >= $ach09_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach08.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach08 . "<h3>
				<h5>
					" . $ach08_desc . "
				</h5>
				<h4 onmouseover=\"showtip('". $devtest_desc ."');\" onmouseout=\"hidetip();\">
					<span style='color:lightgreen;'>" . $devtest . "</span>
				</h4>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
	// Achivement 9
	if ($row[$ach09_award] >= $ach09_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach09.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach09 ."<h3>
				<h5>
					" . $ach09_desc . "
				</h5>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
	// Achivement 10
	if ($row[$ach10_award] >= $ach10_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach10.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach10 . "<h3>
				<h5>
					" . $ach10_desc . "
				</h5>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
	
	// Achivement 11
	if ($row[$ach11_award] >= $ach11_progress) {
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='achieved'></div>
				<img src='img/ach/ach11.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach11 . "<h3>
				<h5>
					" . $ach11_desc . "<br>
				</h5>
				<div class='achievement-progress-text'> ". $ach11_progress ." / ". $ach11_progress ."</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='100%'> 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}

	if (count($arr_achievements) == 0)
		$arr_achievements[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/null.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>N/A<h3>
				<h5>
					" . $playername . " haven't earned any achievements yet.
				</h5>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	
	// If they haven't been earned yet
	
		// Achivement 2
	if ($row[$ach02_award] <= $ach02_progress-1) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach02.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach02 . "<h3>
				<h5>
					" . $ach02_desc . "
				</h5>
				<div class='achievement-progress-text'> " . $row[$ach02_award] . " / " . $ach02_progress . "</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='" . $row[$ach02_award] / 15 . "%' > 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
		// Achivement 3
	if ($row[$ach03_award] <= $ach03_progress-1) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach03.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach03 . "<h3>
				<h5>
					" . $ach03_desc . "
				</h5>
				<div class='achievement-progress-text'> " . $row[$ach03_award] . " / " . $ach03_progress . "</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='" . $row[$ach03_award] / 5 . "%' > 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
		// Achivement 4
	if ($row[$ach04a_award] <= $ach04a_progress-1) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach04a.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach04a . "<h3>
				<h5>
					" . $ach04a_desc . "
				</h5>
				<div class='achievement-progress-text'> " . $row[$ach04a_award] . " / " . $ach04a_progress . "</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='" . $row[$ach04a_award] / 5 . "%' > 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
		// Achivement 5
	if ($row[$ach05_award] <= $ach05_progress-1) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach05a.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach05 . "<h3>
				<h5>
					" . $ach05_desc . "
				</h5>
				<div class='achievement-progress-text'> " . $row[$ach05_award] . " / " . $ach05_progress . "</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='" . $row[$ach05_award] * 6.6 . "%' > 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
		// Achivement 6
	if ($row[$ach06_award] >= 0 && $row[$ach06_award] <= $ach06_progress-1) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach06a.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach06 . "<h3>
				<h5>
					" . $ach06_desc . "
				</h5>
				<h4 onmouseover=\"showtip('". $badachivement_desc ."');\" onmouseout=\"hidetip();\">
					<span style='color:red;'>" . $badachivement . "</span>
				</h4>
				<div class='achievement-progress-text'> " . $row[$ach06_award] . " / " . $ach06_progress . "</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='" . $row[$ach06_award] * 6.6 . "%' > 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
		// Achivement 7
	if ($row[$ach07_award] >= 0 && $row[$ach07_award] <= $ach07_progress-1) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach07a.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach07 . "<h3>
				<h5>
					" . $ach07_desc . "
				</h5>
				<h4 onmouseover=\"showtip('". $badachivement_desc ."');\" onmouseout=\"hidetip();\">
					<span style='color:red;'>" . $badachivement . "</span>
				</h4>
				<div class='achievement-progress-text'> " . $row[$ach07_award] . " / " . $ach07_progress . "</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='" . $row[$ach07_award] * 3.3 . "%' > 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
		// Achivement 9
	if ($row[$ach09_award] == 0) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach09.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach09 . "<h3>
				<h5>
					" . $ach09_desc . "
				</h5>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
		// Achivement 10
	if ($row[$ach10_award] <= $ach10_progress-1) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach10.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach10 . "<h3>
				<h5>
					" . $ach10_desc ."
				</h5>
				<div class='achievement-progress-text'> " . $row[$ach10_award] . " / ". $ach10_progress ."</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='" . $row[$ach10_award] * 10 . "%' > 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}
		// Achivement 11
			// The first achievement progress code (old, but works)
	if ($row[$ach11_award] == 3) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach11.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach11 . "<h3>
				<h5>
					" . $ach11_desc . "
				</h5>
				<div class='achievement-progress-text'> 3 / 4</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='80%'> 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	} elseif ($row[$ach11_award] == 2) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach11.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach11 . "<h3>
				<h5>
					" . $ach11_desc . "
				</h5>
				<div class='achievement-progress-text'> 2 / 4</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='50%'> 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	} elseif ($row[$ach11_award] == 1) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach11.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach11 . "<h3>
				<h5>
					" . $ach11_desc . "
				</h5>
				<div class='achievement-progress-text'> 1 / 4</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='20%'> 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	} elseif ($row[$ach11_award] == 0) {
		$arr_achievements2[] = "
		<div class='achievement-base'>
			<div class='achievement-img'>
				<div class='notachieved'></div>
				<img src='img/ach/ach11.jpg' />
			</div>
			<div class='achievement-desc-base'>
				<div class='achievement-desc'>
				<h3>" . $ach11 . "<h3>
				<h5>
					" . $ach11_desc . "
				</h5>
				<div class='achievement-progress-text'> 0 / 4</div>
				<div class='achievement-progress-bar'>
					<img src='img/misc/ach_bar.gif' height='14' width='0%'> 
				</div>
				</div>
			</div>
		</div>
		<br clear='left'></br>";
	}

	arsort($arr_kills);
	arsort($arr_demerits);

	$stats->set("arr_kills", $arr_kills);
	$stats->set("arr_demerits", $arr_demerits);
	$stats->set("arr_achievements", $arr_achievements);
	$stats->set("arr_achievements2", $arr_achievements2);

	$output = $stats->fetch($templatefiles['player_stats.tpl']);
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
echo $tpl->fetch($templatefiles['layout.tpl']);
?>
