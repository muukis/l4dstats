<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Campaign detailed stats - "campaign.php"
================================================
*/

// Include the primary PHP functions file
include("./common.php");

// Load outer template
$tpl = new Template($templatefiles['layout.tpl']);

// Set Campaign ID as var, and quit on hack attempt
if (strstr($_GET['id'], "/")) exit;
$campaign = mysql_real_escape_string($_GET['id']);

// Set GameType as var, and quit on hack attempt
if (strstr($_GET['type'], "/")) exit;
$type = strtolower($_GET['type']);

if ($type == "coop" || $type == "versus" || $type == "realism" || $type == "survival" || $type == "scavenge" || $type == "realismversus" || $type == "mutations")
{
	$disptype = ucfirst($type);
	if ($type == "coop")
	{
		$campaigns = $coop_campaigns;
		$query_where = " and gamemode = 0";
	}
	else if ($type == "versus")
	{
		$campaigns = $versus_campaigns;
		$query_where = " and gamemode = 1";
	}
	else if ($type == "realism")
	{
		$campaigns = $versus_campaigns;
		$query_where = " and gamemode = 2";
	}
	else if ($type == "survival")
	{
		$campaigns = $versus_campaigns;
		$query_where = " and gamemode = 3";
	}
	else if ($type == "scavenge")
	{
		$campaigns = $versus_campaigns;
		$query_where = " and gamemode = 4";
	}
	else if ($type == "realismversus")
	{
		$campaigns = $versus_campaigns;
		$query_where = " and gamemode = 5";
	}
	else if ($type == "mutations")
	{
		$campaigns = $versus_campaigns;
		$query_where = " and gamemode = 6";
	}

	$title = $campaigns[$campaign];
	if ($title . "" == "") {
	    $tpl->set("title", "Invalid Campaign"); // Window title
	    $tpl->set("page_heading", "Invalid Campaign"); // Page header
	
	    $output = "You have selected an invalid campaign. Please go back, and report this error to the site administrator. Thank you.";
	    $tpl->set("body", trim($output));
	
	    // Output the top 10
	    $tpl->set("top10", $top10);
	
	    // Print out the page!
	    echo $tpl->fetch($templatefiles['layout.tpl']);
	
	    exit;
	}

	$tpl->set("title", $title . " Stats (" . $disptype . ")"); // Window title
	$tpl->set("page_heading", $title . " Stats (" . $disptype . ")"); // Page header

	$totalkills = 0;
	$query = "SELECT * FROM " . $mysql_tableprefix . "maps";
	
	if (strlen($campaign) > 0)
		$query .= " WHERE name LIKE '" . $campaign . "%' and custom = 0";
	else
		$query .= " WHERE custom = 1";

	$query .= $query_where;
	$query .= " ORDER BY name ASC";
	
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
			$playtime = array($row['playtime_nor'], $row['playtime_adv'], $row['playtime_exp'], $row['playtime_nor'] + $row['playtime_adv'] + $row['playtime_exp']);
			$points = array($row['points_nor'], $row['points_adv'], $row['points_exp'], $row['points_nor'] + $row['points_adv'] + $row['points_exp']);
			
	    $stats = new Template($templatefiles['page.tpl']);
	    $stats->set("page_subject", $row['name']);

	$stats->set("page_mapname", $page_mapname);
	    
	$page_mapname = array();
	
	// Yama
	if ($row['name'] == l4d_yama_1) {
		$page_mapname[] = "Tokyo Streets";
	} elseif ($row['name'] == l4d_yama_2) {
		$page_mapname[] = "Forest Town";
	} elseif ($row['name'] == l4d_yama_3) {
		$page_mapname[] = "Kiyomizu Temple";
	} elseif ($row['name'] == l4d_yama_4) {
		$page_mapname[] = "Mining Village";
	} elseif ($row['name'] == l4d_yama_5) {
		$page_mapname[] = "Maya Kanko Hotel";
	}
	// If map aint listed
	elseif ($row['name'] == 0) {
		$page_mapname[] = $row['name'];
	}

	    $map = new Template($templatefiles["maps_detailed_" . $type . ".tpl"]);
			$map->set("icon_infected", $imagefiles['icon_infected.gif']); // Team infected icon
			$map->set("icon_survivors", $imagefiles['icon_survivors.png']); // Team survivors icon
	    $playtime_arr = array(formatage($playtime[0] * 60),
	                          formatage($playtime[1] * 60),
	                          formatage($playtime[2] * 60),
	                          formatage($playtime[3] * 60));
	
	  	$points_arr = array(number_format($points[0]),
	                        number_format($points[1]),
	                        number_format($points[2]),
	                        number_format($points[3]));
	
	    $points_infected_arr = array(number_format($row['points_infected_nor']),
	                        number_format($row['points_infected_adv']),
	                        number_format($row['points_infected_exp']),
	                        number_format($row['points_infected_nor'] + $row['points_infected_adv'] + $row['points_infected_exp']));
	
	    $kills_arr = array(number_format($row['kills_nor']),
	                       number_format($row['kills_adv']),
	                       number_format($row['kills_exp']),
	                       number_format($row['kills_nor'] + $row['kills_adv'] + $row['kills_exp']));
	
	    $survivor_kills_arr = array(number_format($row['survivor_kills_nor']),
	                       number_format($row['survivor_kills_adv']),
	                       number_format($row['survivor_kills_exp']),
	                       number_format($row['survivor_kills_nor'] + $row['survivor_kills_adv'] + $row['survivor_kills_exp']));
	
	    $infected_win_arr = array(number_format($row['infected_win_nor']),
	                          number_format($row['infected_win_adv']),
	                          number_format($row['infected_win_exp']),
	                          number_format($row['infected_win_nor'] + $row['infected_win_adv'] + $row['infected_win_exp']));
	
	    $restarts_arr = array(number_format($row['restarts_nor']),
	                          number_format($row['restarts_adv']),
	                          number_format($row['restarts_exp']),
	                          number_format($row['restarts_nor'] + $row['restarts_adv'] + $row['restarts_exp']));
	
			$ppm_arr = array(number_format(getppm($points[0], $playtime[0]), 2),
											 number_format(getppm($points[1], $playtime[1]), 2),
											 number_format(getppm($points[2], $playtime[2]), 2),
											 number_format(getppm($points[3], $playtime[3]), 2));
			
	    $totalkills = $totalkills + ($row['kills_nor'] + $row['kills_adv'] + $row['kills_exp']);
	
	    $map->set("playtime", $playtime_arr);
	    $map->set("infected_win", $infected_win_arr);
	    $map->set("points", $points_arr);
	    $map->set("ppm", $ppm_arr);
	    $map->set("points_infected", $points_infected_arr);
	    $map->set("kills", $kills_arr);
	    $map->set("survivor_kills", $survivor_kills_arr);
	    $map->set("restarts", $restarts_arr);
	    $body = $map->fetch($templatefiles["maps_detailed_" . $type . ".tpl"]);
	
	    $stats->set("page_body", $body);
	    $output .= $stats->fetch($templatefiles['page.tpl']);
	}
	
	$campaignpop = getpopulation($totalkills, $population_file, False);
  $link1 = sprintf($language_pack['campaignstatsdesclink'], $campaignpop[0], $campaignpop[0]);
  $link2 = sprintf($language_pack['campaignstatsdesclink'], $campaignpop[2], $campaignpop[2]);
	$campaigninfo = sprintf($language_pack['campaignstatsdetaildesc'], $title, $link1, number_format($campaignpop[1]), $link2, number_format($campaignpop[3])) . "\n";
	//$campaigninfo = "<p>More zombies have been killed in <b>" . $title . "</b> than the entire population of <a href=\"http://google.com/search?q=site:en.wikipedia.org+" . $campaignpop[0] . "&btnI=1\">" . $campaignpop[0] . "</a>, population <b>" . number_format($campaignpop[1]) . "</b>.<br />That is almost more than the entire population of <a href=\"http://google.com/search?q=site:en.wikipedia.org+" . $campaignpop[2] . "&btnI=1\">" . $campaignpop[2] . "</a>, population <b>" . number_format($campaignpop[3]) . "</b>!</p>\n";

	$output = trim($campaigninfo . $output);
}
else
	$output = $language_pack['illegalgamemode'];
	
$tpl->set("body", $output);

// Output the top 10 
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch($templatefiles['layout.tpl']);
?>
