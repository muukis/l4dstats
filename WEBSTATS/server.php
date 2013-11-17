<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson 
================================================
Player stats page - "server.php"
================================================
*/

// Include the primary PHP functions file
include("./common.php");

// Load outer template
$tpl = new Template($templatefiles['layout.tpl']);

//Big sql
$players_sql = "
	SELECT
		COUNT(*) AS total_players,
		SUM(award_adrenaline) AS award_adrenaline,
		SUM(award_allinsafehouse) AS award_allinsafehouse,
		SUM(award_bulldozer) AS award_bulldozer,
		SUM(award_campaigns) AS award_campaigns,
		SUM(award_charger) AS award_charger,
		SUM(award_fincap) AS award_fincap,
		SUM(award_friendlyfire) AS award_friendlyfire,
		SUM(award_gascans_poured) AS award_gascans_poured,
		SUM(award_hunter) AS award_hunter,
		SUM(award_infected_win) AS award_infected_win,
		SUM(award_jockey) AS award_jockey,
		SUM(award_ledgegrab) AS award_ledgegrab,
		SUM(award_left4dead) AS award_left4dead,
		SUM(award_letinsafehouse) AS award_letinsafehouse,
		SUM(award_matador) AS award_matador,
		SUM(award_medkit) AS award_medkit,
		SUM(award_perfect_blindness) AS award_perfect_blindness,
		SUM(award_pills) AS award_pills,
		SUM(award_pounce_nice) AS award_pounce_nice,
		SUM(award_pounce_perfect) AS award_pounce_perfect,
		SUM(award_protect) AS award_protect,
		SUM(award_rescue) AS award_rescue,
		SUM(award_revive) AS award_revive,
		SUM(award_scatteringram) AS award_scatteringram,
		SUM(award_smoker) AS award_smoker,
		SUM(award_survivor_down) AS award_survivor_down,
		SUM(award_tankkill) AS award_tankkill,
		SUM(award_tankkillnodeaths) AS award_tankkillnodeaths,
		SUM(award_teamkill) AS award_teamkill,
		SUM(award_upgrades_added) AS award_upgrades_added,
		SUM(award_witchcrowned) AS award_witchcrowned,
		SUM(award_witchdisturb) AS award_witchdisturb,
		SUM(charger_impacts) AS charger_impacts,
		SUM(headshots) AS headshots,
		SUM(infected_boomer_blinded) AS infected_boomer_blinded,
		SUM(infected_boomer_vomits) AS infected_boomer_vomits,
		SUM(infected_charger_damage) AS infected_charger_damage,
		SUM(infected_hunter_pounce_counter) AS infected_hunter_pounce_counter,
		SUM(infected_hunter_pounce_dmg) AS infected_hunter_pounce_dmg,
		SUM(infected_jockey_damage) AS infected_jockey_damage,
		SUM(infected_jockey_ridetime) AS infected_jockey_ridetime,
		SUM(infected_smoker_damage) AS infected_smoker_damage,
		SUM(infected_spawn_1) AS infected_spawn_1,
		SUM(infected_spawn_2) AS infected_spawn_2,
		SUM(infected_spawn_3) AS infected_spawn_3,
		SUM(infected_spawn_4) AS infected_spawn_4,
		SUM(infected_spawn_5) AS infected_spawn_5,
		SUM(infected_spawn_6) AS infected_spawn_6,
		SUM(infected_spawn_8) AS infected_spawn_8,
		SUM(infected_spitter_damage) AS infected_spitter_damage,
		SUM(infected_tank_damage) AS infected_tank_damage,
		SUM(jockey_rides) AS jockey_rides,
		SUM(kill_boomer) AS kill_boomer,
		SUM(kill_charger) AS kill_charger,
		SUM(kill_hunter) AS kill_hunter,
		SUM(kill_infected) AS kill_infected,
		SUM(kill_jockey) AS kill_jockey,
		SUM(kill_smoker) AS kill_smoker,
		SUM(kill_spitter) AS kill_spitter,
		SUM(kills) AS kills,
		SUM(melee_kills) AS melee_kills,
		SUM(points) AS points,
		SUM(points_infected) AS points_infected,
		SUM(points_mutations) AS points_mutations,
		SUM(points_realism) AS points_realism,
		SUM(points_realism_infected) AS points_realism_infected,
		SUM(points_realism_survivors) AS points_realism_survivors,
		SUM(points_scavenge_infected) AS points_scavenge_infected,
		SUM(points_scavenge_survivors) AS points_scavenge_survivors,
		SUM(points_survival) AS points_survival,
		SUM(points_survivors) AS points_survivors,
		SUM(mutations_kills_survivors) AS mutations_kills_survivors,
		SUM(realism_kills_survivors) AS realism_kills_survivors,
		SUM(scavenge_kills_survivors) AS scavenge_kills_survivors,
		SUM(versus_kills_survivors) AS versus_kills_survivors
	FROM
		" . $mysql_tableprefix . "players
";

$result = mysql_query($players_sql) or die("Error: " . mysql_error());
$total = mysql_fetch_array($result);

//Players
//Total players
$players = $total['total_players'];

//Total server points
$total_points = $total['points'];
$totalpoints_realism =  $total['points_realism'];
$totalpoints_mutations =  $total['points_mutations'];
$totalpoints_survival =  $total['points_survival'];
$totalpoints_survivors =  $total['points_survivors'];
$totalpoints_infected =  $total['points_infected'];
$totalpoints_scavenge_survivors =  $total['points_scavenge_survivors'];
$totalpoints_scavenge_infected =  $total['points_scavenge_infected'];
$totalpoints_realism_survivors =  $total['points_realism_survivors'];
$totalpoints_realism_infected =  $total['points_realism_infected'];
$totalpoints = $total_points + $totalpoints_survivors + $totalpoints_infected + $totalpoints_survival;

if ($game_version != 1)
	$totalpoints += $totalpoints_realism + $totalpoints_scavenge_survivors + $totalpoints_scavenge_infected + $totalpoints_realism_survivors + $totalpoints_realism_infected + $totalpoints_mutations;

// For PPM use
$player_totalpoints = $totalpoints;

$arr_kills = array();
$arr_kills[$language_pack['commoninfected']] = $total['kill_infected'];
$arr_kills[$language_pack['hunters']] = $total['kill_hunter'];
$arr_kills[$language_pack['smokers']] = $total['kill_smoker'];
$arr_kills[$language_pack['boomers']] = $total['kill_boomer'];

if ($game_version != 1)
{
	$arr_kills[$language_pack['spitters']] = $total['kill_spitter'];
	$arr_kills[$language_pack['jockeys']] = $total['kill_jockey'];
	$arr_kills[$language_pack['chargers']] = $total['kill_charger'];
}

$arr_survivor_awards = array();
$arr_survivor_awards[$language_pack['awardpillsgiven']] = $total['award_pills'];
if ($game_version != 1)
	$arr_survivor_awards[$language_pack['awardadrenalinesgiven']] = $total['award_adrenaline'];
$arr_survivor_awards[$language_pack['awardmedkitsgiven']] = $total['award_medkit'];
$arr_survivor_awards[$language_pack['awardsavedfriendliesfromhunters']] = $total['award_hunter'];
$arr_survivor_awards[$language_pack['awardsavedfriendliesfromsmokers']] = $total['award_smoker'];
if ($game_version != 1)
{
	$arr_survivor_awards[$language_pack['awardsavedfriendliesfromjockeys']] = $total['award_jockey'];
	$arr_survivor_awards[$language_pack['awardsavedfriendliesfromchargers']] = $total['award_charger'];
	$arr_survivor_awards[$language_pack['awardleveledcharges']] = $total['award_matador'];
	$arr_survivor_awards[$language_pack['awardgascanisterspoured']] = $total['award_gascans_poured'];
	$arr_survivor_awards[$language_pack['awardammoupgradesdeployed']] = $total['award_upgrades_added'];
}
$arr_survivor_awards[$language_pack['awardcrownedwitches']] = $total['award_witchcrowned'];
$arr_survivor_awards[$language_pack['awardprotectedfriendlies']] = $total['award_protect'];
$arr_survivor_awards[$language_pack['awardrevivedfriendlies']] = $total['award_revive'];
$arr_survivor_awards[$language_pack['awardrescuedfriendlies']] = $total['award_rescue'];
$arr_survivor_awards[$language_pack['awardtankskilledwithteam']] = $total['award_tankkill'];
$arr_survivor_awards[$language_pack['awardtankskilledwithnodeaths']] = $total['award_tankkillnodeaths'];
$arr_survivor_awards[$language_pack['awardsafehousesreachedwithallsurvivors']] = $total['award_allinsafehouse'];
$arr_survivor_awards[$language_pack['awardcampaignscompleted']] = $total['award_campaigns'];

$arr_infected_awards = array();
$arr_infected_awards[$language_pack['awardallsurvivorsdead']] = $total['award_infected_win'];
$arr_infected_awards[$language_pack['awardperfectblindness']] = $total['award_perfect_blindness'];
$arr_infected_awards[$language_pack['awarddeathfromabove']] = $total['award_pounce_perfect'];
$arr_infected_awards[$language_pack['awardpainfromabove']] = $total['award_pounce_nice'];
$arr_infected_awards[$language_pack['awardbulldozer']] = $total['award_bulldozer'];
$arr_infected_awards[$language_pack['awardsurvivorsincapacitated']] = $total['award_survivor_down'];
$arr_infected_awards[$language_pack['awardcausedledgegrab']] = $total['award_ledgegrab'];
if ($game_version != 1)
{
	$arr_infected_awards[$language_pack['awardscatteringram']] = $total['award_scatteringram'];
}

$arr_demerits = array();
$arr_demerits[$language_pack['friendlyfireincidents']] = $total['award_friendlyfire'];
$arr_demerits[$language_pack['incapacitatedfriendlies']] = $total['award_fincap'];
$arr_demerits[$language_pack['teammateskilled']] = $total['award_teamkill'];
$arr_demerits[$language_pack['friendliesleftfordead']] = $total['award_left4dead'];
$arr_demerits[$language_pack['infectedletinsaferoom']] = $total['award_letinsafehouse'];
$arr_demerits[$language_pack['witchesdisturbed']] = $total['award_witchdisturb'];


$playername = htmlentities($total['name'], ENT_COMPAT, "UTF-8");

$tpl->set("title", "Server Stats"); // Window title
$tpl->set("page_heading", "Server Stats"); // Page header

$stats = new Template($templatefiles['server.tpl']);

$stats->set("total", $total);
$stats->set("players", number_format($players));
$stats->set("points", number_format($totalpoints));
//$stats->set("playtime", formatage(($total['playtime'] + $total['playtime_versus'] + $total['playtime_survival'] + $total['playtime_versus'] + $total['playtime_scavenge']) * 60));
$stats->set("infected_killed", number_format($total['kills']));
$stats->set("melee_kills", number_format($total['melee_kills']));
$stats->set("survivors_killed_versus", number_format($total['versus_kills_survivors']));
if ($game_version != 1)
{
	$stats->set("survivors_killed_scavenge", "<br>Scavenge: " . number_format($total['scavenge_kills_survivors']) . "<br>Realism&nbsp;Versus: " . number_format($total['realism_kills_survivors']) . "<br>Mutations: " . number_format($total['mutations_kills_survivors']));
	$stats->set("survivors_killed", number_format($total['versus_kills_survivors'] + $total['scavenge_kills_survivors'] + $total['realism_kills_survivors'] + $total['mutations_kills_survivors']));
}
else
{
	$stats->set("survivors_killed_scavenge", "");
	$stats->set("survivors_killed", number_format($total['versus_kills_survivors']));
}
$stats->set("headshots", number_format($total['headshots']));

$totalpop = getpopulation($total['kills'], $population_file, True);
$stats->set("totalpop", $totalpop);

if ($total['infected_spawn_1'] == 0 || $total['infected_smoker_damage'] == 0) $stats->set("avg_smoker", "0");
else $stats->set("avg_smoker", number_format($total['infected_smoker_damage'] / $total['infected_spawn_1'], 2));

if ($total['infected_boomer_vomits'] == 0 || $total['infected_boomer_blinded'] == 0) $stats->set("avg_boomer", "0");
else $stats->set("avg_boomer", number_format($total['infected_boomer_blinded'] / $total['infected_boomer_vomits'], 2));

if ($total['infected_hunter_pounce_counter'] == 0 || $total['infected_hunter_pounce_dmg'] == 0) $stats->set("avg_hunter", "0");
else $stats->set("avg_hunter", number_format($total['infected_hunter_pounce_dmg'] / $total['infected_hunter_pounce_counter'], 2));

if ($total['infected_spawn_8'] == 0 || $total['infected_tank_damage'] == 0) $stats->set("avg_tank", "0");
else $stats->set("avg_tank", number_format($total['infected_tank_damage'] / $total['infected_spawn_8'], 2));

$stats->set("spawn_smoker", number_format($total['infected_spawn_1']));
$stats->set("smoker_damage", number_format($total['infected_smoker_damage']));
$stats->set("spawn_boomer", number_format($total['infected_spawn_2']));
$stats->set("boomer_vomits", number_format($total['infected_boomer_vomits']));
$stats->set("boomer_blinded", number_format($total['infected_boomer_blinded']));
$stats->set("spawn_hunter", number_format($total['infected_spawn_3']));
$stats->set("hunter_pounces", number_format($total['infected_hunter_pounce_counter']));
$stats->set("hunter_damage", number_format($total['infected_hunter_pounce_dmg']));
$stats->set("spawn_tank", number_format($total['infected_spawn_8']));
$stats->set("tank_damage", number_format($total['infected_tank_damage']));

if ($game_version != 1)
{
	$avg_spitter = "0";
	if ($total['infected_spawn_4'] > 0 && $total['infected_spitter_damage'] > 0)
		$avg_spitter = number_format($total['infected_spitter_damage'] / $total['infected_spawn_4'], 2);

	$avg_jockey = "0";
	if ($total['infected_spawn_5'] > 0 && $total['infected_jockey_damage'] > 0)
		$avg_jockey = number_format($total['infected_jockey_damage'] / $total['infected_spawn_5'], 2);

	$avg_charger = "0";
	if ($total['infected_spawn_6'] > 0 && $total['infected_charger_damage'] > 0)
		$avg_charger = number_format($total['infected_charger_damage'] / $total['infected_spawn_6'], 2);

	$l4d2_special_infected = array();
	$l4d2_special_infected[$language_pack['spitteraverage']] = $avg_spitter;
	$l4d2_special_infected[$language_pack['jockeyaverage']] = $avg_jockey;
	$l4d2_special_infected[$language_pack['chargeraverage']] = $avg_charger;
	/*
	$l4d2_special_infected .= "<tr align=\"left\" onmouseover=\"showtip('Spitter damage average per spawn<br>&nbsp;&nbsp;damage: " . number_format($total['infected_spitter_damage']) . "<br>&nbsp;&nbsp;spawns: " . number_format($total['infected_spawn_4']) . "');\" onmouseout=\"hidetip();\"><td>Spitter Average:</td><td>" . $avg_spitter . "</td></tr>\n";
	$l4d2_special_infected .= "<tr align=\"left\" onmouseover=\"showtip('Jockey damage average per spawn<br>&nbsp;&nbsp;damage: " . number_format($total['infected_jockey_damage']) . "<br>&nbsp;&nbsp;spawns: " . number_format($total['infected_spawn_5']) . "<br>&nbsp;&nbsp;rides: " . number_format($total['jockey_rides']) . "<br>&nbsp;&nbsp;ride length: " . formatage($total['infected_jockey_ridetime']) . "');\" onmouseout=\"hidetip();\"><td>Jockey Average:</td><td>" . $avg_jockey . "</td></tr>\n";
	$l4d2_special_infected .= "<tr align=\"left\" onmouseover=\"showtip('Charger damage average per spawn<br>&nbsp;&nbsp;impacts: " . number_format($total['charger_impacts']) . "<br>&nbsp;&nbsp;damage: " . number_format($total['infected_charger_damage']) . "<br>&nbsp;&nbsp;spawns: " . number_format($total['infected_spawn_6']) . "');\" onmouseout=\"hidetip();\"><td>Charger Average:</td><td>" . $avg_charger . "</td></tr>";
	*/

	$stats->set("l4d2_special_infected", $l4d2_special_infected);
}
else
	$stats->set("l4d2_special_infected", null);

if ($total['kills'] == 0 || $total['headshots'] == 0) $stats->set("ratio", "0");
else $stats->set("ratio", number_format($total['headshots'] / $total['kills'], 4) * 100);

$maps_sql = "
	SELECT
		gamemode,
		COUNT(*) AS total_maps,
		SUM(playtime_nor) AS _playtime_nor,
		SUM(playtime_adv) AS _playtime_adv,
		SUM(playtime_exp) AS _playtime_exp,
		SUM(points_nor) AS points_nor,
		SUM(points_adv) AS points_adv,
		SUM(points_exp) AS points_exp,
		SUM(points_infected_nor) AS points_infected_nor,
		SUM(points_infected_adv) AS points_infected_adv,
		SUM(points_infected_exp) AS points_infected_exp
	FROM
		" . $mysql_tableprefix . "maps
	WHERE
		playtime_nor + playtime_adv + playtime_exp > 0
	GROUP BY
		gamemode
	ORDER BY
		gamemode
";

$result = mysql_query($maps_sql) or die("Error: " . mysql_error());
$arr_maps = array();

$totalplaytime = 0;
$totalplaytime_nor = 0;
$totalplaytime_adv = 0;
$totalplaytime_exp = 0;
$totalpoints = 0;
$totalpoints_nor = 0;
$totalpoints_adv = 0;
$totalpoints_exp = 0;
$totalmaps = 0;

$arr_ppm_playtime = array();

while ($row = mysql_fetch_array($result))
{
	$gamemodename = "Unknown";
	$arr_vals = array();

	switch ($row['gamemode'])
	{
		case 0:
		$gamemodename = $language_pack['coop'];
			break;
		case 1:
			$gamemodename = $language_pack['versus'];
			break;
		case 2:
			if ($game_version == 1) continue;
			$gamemodename = $language_pack['realism'];
			break;
		case 3:
			$gamemodename = $language_pack['survival'];
			break;
		case 4:
			if ($game_version == 1) continue;
			$gamemodename = $language_pack['scavenge'];
			break;
		case 5:
			if ($game_version == 1) continue;
			$gamemodename = $language_pack['realismversus'];
			break;
		case 6:
			if ($game_version == 1) continue;
			$gamemodename = $language_pack['mutations'];
			break;
	}

	$gmtotalplaytime = $row['_playtime_nor'] + $row['_playtime_adv'] + $row['_playtime_exp'];
	$gmtotalpoints = $row['points_nor'] + $row['points_infected_nor'] + $row['points_adv'] + $row['points_infected_adv'] + $row['points_exp'] + $row['points_infected_exp'];

	$arr_ppm_playtime[strtolower($gamemodename)] = $gmtotalplaytime;

	$arr_vals['gamemodename'] = $gamemodename;
	$arr_vals['totalmaps'] = $row['total_maps'];
	$arr_vals['totalplaytime_nor'] = getplaytime($row['_playtime_nor']);
	$arr_vals['totalplaytime_adv'] = getplaytime($row['_playtime_adv']);
	$arr_vals['totalplaytime_exp'] = getplaytime($row['_playtime_exp']);
	$arr_vals['totalplaytime'] = getplaytime($gmtotalplaytime);
	$arr_vals['totalpoints_nor'] = number_format($row['points_nor'] + $row['points_infected_nor']);
	$arr_vals['totalpoints_adv'] = number_format($row['points_adv'] + $row['points_infected_adv']);
	$arr_vals['totalpoints_exp'] = number_format($row['points_exp'] + $row['points_infected_exp']);
	$arr_vals['totalpoints'] = number_format($gmtotalpoints);
	$ppm = 0;
	if ($gmtotalpoints > 0 && $gmtotalplaytime > 0)
		$ppm = $gmtotalpoints / $gmtotalplaytime;
	$arr_vals['totalppm'] = number_format($ppm, 2);
	$ppm_nor = 0;
	if ($row['points_nor'] + $row['points_infected_nor'] > 0 && $row['_playtime_nor'] > 0)
		$ppm_nor = ($row['points_nor'] + $row['points_infected_nor']) / $row['_playtime_nor'];
	$ppm_adv = 0;
	if ($row['points_adv'] + $row['points_infected_adv'] > 0 && $row['_playtime_adv'] > 0)
		$ppm_adv = ($row['points_adv'] + $row['points_infected_adv']) / $row['_playtime_adv'];
	$ppm_exp = 0;
	if ($row['points_exp'] + $row['points_infected_exp'] > 0 && $row['_playtime_exp'] > 0)
		$ppm_exp = ($row['points_exp'] + $row['points_infected_exp']) / $row['_playtime_exp'];
	$arr_vals['totalppm_nor'] = number_format($ppm_nor, 2);
	$arr_vals['totalppm_adv'] = number_format($ppm_adv, 2);
	$arr_vals['totalppm_exp'] = number_format($ppm_exp, 2);

	$arr_maps[] = $arr_vals;

	$totalplaytime_nor += $row['_playtime_nor'];
	$totalplaytime_adv += $row['_playtime_adv'];
	$totalplaytime_exp += $row['_playtime_exp'];
	$totalplaytime += $gmtotalplaytime;
	$totalpoints_nor += $row['points_nor'] + $row['points_infected_nor'];
	$totalpoints_adv += $row['points_adv'] + $row['points_infected_adv'];
	$totalpoints_exp += $row['points_exp'] + $row['points_infected_exp'];
	$totalpoints += $gmtotalpoints;
	$totalmaps += $row['total_maps'];
}

// PPM
$stats->set("player_ppm", number_format(getppm($player_totalpoints, $totalplaytime), 2));
$stats->set("player_ppm_coop", number_format(getppm($total['points'], $arr_ppm_playtime['coop']), 2));
if ($game_version != 1)
{
	$stats->set("player_ppm_realism", $language_pack['realism'] . ": " . number_format(getppm($total['points_realism'], $arr_ppm_playtime['realism']), 2) . "<br>");
	$stats->set("player_ppm_scavenge", "<br>" . $language_pack['realism'] . ": " . number_format(getppm($total['points_scavenge_infected'] + $total['points_scavenge_survivors'], $arr_ppm_playtime['scavenge']), 2) .
																		 "<br>" . $language_pack['realismversus'] . ": " . number_format(getppm($total['points_realism_infected'] + $total['points_realism_survivors'], $arr_ppm_playtime['realism&nbsp;versus']), 2) .
																		 "<br>" . $language_pack['mutations'] . ": " . number_format(getppm($total['points_mutations'], $arr_ppm_playtime['mutations']), 2));
}
else
{
	$stats->set("player_ppm_realism", "");
	$stats->set("player_ppm_scavenge", "");
}
$stats->set("player_ppm_versus", number_format(getppm($total['points_infected'] + $total['points_survivors'], $arr_ppm_playtime['versus']), 2));
$stats->set("player_ppm_survival", number_format(getppm($total['points_survival'], $arr_ppm_playtime['survival']), 2));

$stats->set("totalplaytime_nor", getplaytime($totalplaytime_nor));
$stats->set("totalplaytime_adv", getplaytime($totalplaytime_adv));
$stats->set("totalplaytime_exp", getplaytime($totalplaytime_exp));
$stats->set("totalplaytime", getplaytime($totalplaytime));
$stats->set("totalpoints_nor", number_format($totalpoints_nor));
$stats->set("totalpoints_adv", number_format($totalpoints_adv));
$stats->set("totalpoints_exp", number_format($totalpoints_exp));
$stats->set("totalpoints", number_format($totalpoints));
$stats->set("totalmaps", number_format($totalmaps));
$ppm = 0;
if ($totalpoints > 0 && $totalplaytime > 0)
	$ppm = $totalpoints / $totalplaytime;
$ppm_nor = 0;
if ($totalpoints_nor > 0 && $totalplaytime_nor > 0)
	$ppm_nor = $totalpoints_nor / $totalplaytime_nor;
$ppm_adv = 0;
if ($totalpoints_adv > 0 && $totalplaytime_adv > 0)
	$ppm_adv = $totalpoints_adv / $totalplaytime_adv;
$ppm_exp = 0;
if ($totalpoints_exp > 0 && $totalplaytime_exp > 0)
	$ppm_exp = $totalpoints_exp / $totalplaytime_exp;
$stats->set("totalppm", number_format($ppm, 2));
$stats->set("totalppm_nor", number_format($ppm_nor, 2));
$stats->set("totalppm_adv", number_format($ppm_adv, 2));
$stats->set("totalppm_exp", number_format($ppm_exp, 2));

arsort($arr_kills);
arsort($arr_survivor_awards);
arsort($arr_infected_awards);
arsort($arr_demerits);

$stats->set("arr_kills", $arr_kills);
$stats->set("arr_survivor_awards", $arr_survivor_awards);
$stats->set("arr_infected_awards", $arr_infected_awards);
$stats->set("arr_demerits", $arr_demerits);
$stats->set("arr_maps", $arr_maps);

$link1 = sprintf($language_pack['campaignstatsdesclink'], urlencode($totalpop[0]), $totalpop[0]);
$link2 = sprintf($language_pack['campaignstatsdesclink'], urlencode($totalpop[2]), $totalpop[2]);
$servermsg = sprintf($language_pack['campaignstatsdetaildesc'], $title, $link1, number_format($totalpop[1]), $link2, number_format($totalpop[3])) . "\n";
$stats->set("servermsg", $servermsg);

$output = $stats->fetch($templatefiles['server.tpl']);

$tpl->set('body', trim($output));

// Output the top 10
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch($templatefiles['layout.tpl']);
?>
