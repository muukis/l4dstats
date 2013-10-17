<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Campaign stats - "maps.php"
================================================
Changelog

-- 8/19/09 Customized by muukis
Added support for custom maps.

-- 8/23/09 Customized by muukis
Fixed some lines that could cause errors in some
PHP configurations.

-- 10/12/13 Multilang support (for all PHP viewable pages)
Added Multilang support for every viewable PHP page.
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

// Set GameType as var, and quit on hack attempt
if (strstr($_GET['type'], "/")) exit;
$type = strtolower($_GET['type']);

if ($type == "coop" || $type == "versus" || $type == "realism" || $type == "survival" || $type == "scavenge" || $type == "realismversus" || $type == "mutations")
{
	$disptype = ucfirst($type);

	setcommontemplatevariables($tpl);

	$tpl->set("title", $lang_tpl_maps_title . " (" . $disptype . ")"); // Window title
	$tpl->set("page_heading", $lang_tpl_maps_title . " (" . $disptype . ")"); // Page header

	$maparr = array();
	$totals = array();
	
	if ($type == "coop")
	{
		$campaigns = $coop_campaigns;
		$query_where = " AND gamemode = 0";
	}
	else if ($type == "versus")
	{
		$campaigns = $versus_campaigns;
		$query_where = " AND gamemode = 1";
	}
	else if ($type == "realism")
	{
		$campaigns = $realism_campaigns;
		$query_where = " AND gamemode = 2";
	}
	else if ($type == "survival")
	{
		$campaigns = $survival_campaigns;
		$query_where = " AND gamemode = 3";
	}
	else if ($type == "scavenge")
	{
		$campaigns = $scavenge_campaigns;
		$query_where = " AND gamemode = 4";
	}
	else if ($type == "realismversus")
	{
		$campaigns = $realismversus_campaigns;
		$query_where = " AND gamemode = 5";
	}
	else if ($type == "mutations")
	{
		$campaigns = $mutations_campaigns;
		$query_where = " AND gamemode = 6";
	}

	foreach ($campaigns as $prefix => $title) {
		$query = "SELECT playtime_nor + playtime_adv + playtime_exp as playtime,
																		points_nor + points_adv + points_exp as points,
																	kills_nor + kills_adv + kills_exp as kills";

		if ($type == "coop" || $type == "realism" || $type == "survival" || $type == "mutations")
			$query .= ", restarts_nor + restarts_adv + restarts_exp as restarts";
		else if ($type == "versus" || $type == "scavenge" || $type == "realismversus")
		{
			$query .= ", infected_win_nor + infected_win_adv + infected_win_exp as infected_win";
			$query .= ", points_infected_nor + points_infected_adv + points_infected_exp as points_infected";
			$query .= ", survivor_kills_nor + survivor_kills_adv + survivor_kills_exp as kill_survivor";
		}

		$query .= " FROM " . $mysql_tableprefix . "maps";
		
		if (strlen($prefix) > 0)
			$query .= " WHERE LOWER(name) like '" . strtolower($prefix) . "%' and custom = 0";
		else
			$query .= " WHERE custom = 1 AND playtime_nor + playtime_adv + playtime_exp > 0";
		
		$query .= $query_where;

			$result = mysql_query($query) or die(mysql_error());
	
			if (mysql_num_rows($result) <= 0)
				continue;
		
			$playtime = 0;
			$points = 0;
			$points_infected = 0;
			$kills = 0;
			$kill_survivor = 0;
			$restarts = 0;
			$infected_win = 0;
	
			while ($row = mysql_fetch_array($result))
			{
				$playtime += $row['playtime'];
				$points += $row['points'];
				$kills += $row['kills'];
				if ($type == "coop" || $type == "realism" || $type == "survival" || $type == "mutations")
					$restarts += $row['restarts'];
				else if ($type == "versus" || $type == "scavenge" || $type == "realismversus")
				{
					$points_infected += $row['points_infected'];
					$kill_survivor += $row['kill_survivor'];
					$infected_win += $row['infected_win'];
				}
			}
			
			$totals['playtime'] += $playtime;
			$totals['points'] += $points;
			$totals['kills'] += $kills;
			if ($type == "coop" || $type == "realism" || $type == "survival" || $type == "mutations")
				$totals['restarts'] += $restarts;
			else if ($type == "versus" || $type == "scavenge" || $type == "realismversus")
			{
				$totals['points_infected'] += $points_infected;
				$totals['kill_survivor'] += $kill_survivor;
				$totals['infected_win'] += $infected_win;
			}
			$line = ($i & 1) ? "<tr>" : "<tr class=\"alt\">";
			$maparr[] = $line . "<td>" . $title . "</td><td>" . formatage($playtime * 60) . "</td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td>" . number_format($infected_win) . "</td><td>" . number_format($points_infected) . "</td>" : "") . "<td>" . number_format($points) . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "" : " (" . number_format(getppm($points, $playtime), 2) . ")") . "</td><td>" . number_format($kills) . "</td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td>" . number_format($kill_survivor) . "</td>" : "") . (($type == "coop" || $type == "realism" || $type == "survival" || $type == "mutations") ? "<td>" . number_format($restarts) . "</td>" : "") . "</tr>\n";
			$i++;
	}
	
	$line = ($i & 1) ? "<tr>" : "<tr class=\"alt\">";
	$maparr[] = $line . "<td><b>SERVER TOTAL</b></td><td><b>" . formatage($totals['playtime'] * 60) . "</b></td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td><b>" . number_format($totals['infected_win']) . "</b></td><td><b>" . number_format($totals['points_infected']) . "</b></td>" : "") . "<td><b>" . number_format($totals['points']) . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "" : " (" . number_format(getppm($totals['points'], $totals['playtime']), 2) . ")") . "</b></td><td><b>" . number_format($totals['kills']) . "</b></td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td><b>" . number_format($totals['kill_survivor']) . "</b></td>" : "") . (($type == "coop" || $type == "realism" || $type == "survival" || $type == "mutations") ? "<td><b>" . number_format($totals['restarts']) . "</b></td>" : "") . "</tr>\n";
	
	$stats = new Template($templatefiles["maps_overview_" . $type . ".tpl"]);
	$stats->set("icon_infected", $imagefiles['icon_infected.gif']); // Team infected icon
	$stats->set("icon_survivors", $imagefiles['icon_survivors.png']); // Team survivors icon
	$totalpop = getpopulation($totals['kills'], $population_file, False);
	$stats->set("totalpop", $totalpop);
	$stats->set("maps", $maparr);
	$output = $stats->fetch($templatefiles["maps_overview_" . $type . ".tpl"]);
	
	foreach ($campaigns as $prefix => $title) {

		$stats = new Template($templatefiles['page.tpl']);
		$stats->set("page_subject", $title);

		$maps = new Template("./templates/maps_campaign_" . $type . ".tpl");
		$maps->set("icon_infected", $imagefiles['icon_infected.gif']); // Team infected icon
		$maps->set("icon_survivors", $imagefiles['icon_survivors.png']); // Team survivors icon
		$maparr = array();

		$query = "SELECT name, playtime_nor + playtime_adv + playtime_exp as playtime,
																	points_nor + points_adv + points_exp as points,
																	kills_nor + kills_adv + kills_exp as kills";

		if ($type == "coop" || $type == "realism" || $type == "survival" || $type == "mutations")
			$query .= ", restarts_nor + restarts_adv + restarts_exp as restarts";
		else if ($type == "versus" || $type == "scavenge" || $type == "realismversus")
		{
			$query .= ", infected_win_nor + infected_win_adv + infected_win_exp as infected_win";
			$query .= ", points_infected_nor + points_infected_adv + points_infected_exp as points_infected";
			$query .= ", survivor_kills_nor + survivor_kills_adv + survivor_kills_exp as kill_survivor";
		}

		$query .= " FROM " . $mysql_tableprefix . "maps";
		
		if (strlen($prefix) > 0)
			$query .= " WHERE LOWER(name) like '" . strtolower($prefix) . "%' and custom = 0";
		else
			$query .= " WHERE custom = 1 AND playtime_nor + playtime_adv + playtime_exp > 0";

		$query .= $query_where;
		$query .= " ORDER BY name ASC";

		$result = mysql_query($query) or die(mysql_error());

		if (mysql_num_rows($result) <= 0)
			continue;

		// DEBUG
		//$maparr[] = "<tr><td>" . $query . "</td></tr>";

		$i = 1;
		while ($row = mysql_fetch_array($result)) {
				$line = ($i & 1) ? "<tr>" : "<tr class=\"alt\">";
				$maparr[] = $line . "<td>" . $row['name'] . "</td><td>" . formatage($row['playtime'] * 60) . "</td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td>" . number_format($row['infected_win']) . "</td><td>" . number_format($row['points_infected']) . "</td>" : "") . "<td>" . number_format($row['points']) . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "" : " (" . number_format(getppm($row['points'], $row['playtime']), 2) . ")") . "</td><td>" . number_format($row['kills']) . "</td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td>" . number_format($row['kill_survivor']) . "</td>" : "") . (($type == "coop" || $type == "realism" || $type == "survival" || $type == "mutations") ? "<td>" . number_format($row['restarts']) . "</td>" : "") . "</tr>\n";
				$i++;
		}
		
		$maps->set("maps", $maparr);
		$body = $maps->fetch($templatefiles["maps_campaign_" . $type . ".tpl"]);
		
		$stats->set("page_body", $body);
		$stats->set("page_link", "<a href=\"campaign.php?id=" . $prefix . "&type=" . $type . "\">");
		$stats->set("page_link2", "</a>");
		$output .= $stats->fetch($templatefiles['page.tpl']);
	}
}
else
	$output = "<h1>Illegal gametype</h1>";

$tpl->set("body", trim($output));

// Output the top 10 
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch($templatefiles['layout.tpl']);
?>
