<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Index / Players Online page - "index.php"
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
$id = trim(mysql_real_escape_string($_GET['steamid']));

// Set Steam ID as var, and quit on hack attempt
if (strstr($_GET['id'], "/")) exit;
$mapprefix = trim(mysql_real_escape_string($_GET['id']));

// Set gamemode as var, and quit on hack attempt
if (strstr($_GET['gamemode'], "/")) exit;
$gamemode = trim(mysql_real_escape_string($_GET['gamemode']));

setcommontemplatevariables($tpl);

$tpl->set("title", $lang_tpl_tmaps_title); // Window title
$tpl->set("page_heading", $lang_tpl_tmaps_title); // Page header

$fulloutput = "";
$campaigns = array();

if (mysql_error()) {
	$fulloutput = "<p><b>MySQL Error:</b> " . mysql_error() . "</p>\n";

} else if (!$timedmaps_show_all && !(strlen($id) > 0 || strlen($mapprefix) > 0 && strlen($gamemode) > 0)) {
	$fulloutput = "<p><b>You must provide a player <a href=\"http://developer.valvesoftware.com/wiki/SteamID\" target=\"_blank\">Steam ID</a> or proper map info to display Timed Maps statistics!</b></p>\n";
	
} else {
	$forstart = 0;
	$forstop = 6;

	if (strlen($gamemode) > 0)
	{
		$forstart = $forstop = (int)$gamemode;
	}

	for ($j = $forstart; $j <= $forstop; $j++)
	{
		$query_where = "";
		$query_orderby = "ASC";

		switch ($j)
		{
			case 0:
				$campaigns = $coop_campaigns;
				break;
			case 1:
				$campaigns = $versus_campaigns;
				break;
			case 2:
				$campaigns = $realism_campaigns;
				break;
			case 3:
				$campaigns = $survival_campaigns;
				$query_orderby = "DESC";
				break;
			case 4:
				$campaigns = $scavenge_campaigns;
				break;
			case 5:
				$campaigns = $realismversus_campaigns;
				break;
			case 6:
				$campaigns = $mutations_campaigns;
				break;
		}

		$query_where = " AND m1.gamemode = " . $j;

		if ($id)
			$query_where .= " AND p.steamid = '" . $id . "'";

		if ($id)
			$query_where .= " AND p.steamid = '" . $id . "'";

		$previous_map = "";
		$starttag = "";
		$endtag = "";

		foreach ($campaigns as $prefix => $title) {
			if ($mapprefix && strcmp($mapprefix . "", $prefix . "") != 0)
				continue;

			$arr_maprunners = array();
			
			$stats = new Template($templatefiles['tmap_page.tpl']);
			$stats->set("page_subject", $title);

			$maprun = new Template($templatefiles['timedmaps.tpl']);
	
			$query = "SELECT m1.*, p.name, p.ip FROM " . $mysql_tableprefix . "timedmaps AS m1 INNER JOIN " . $mysql_tableprefix . "players AS p ON m1.steamid = p.steamid INNER JOIN " . $mysql_tableprefix . "maps AS m2 ON m1.map = m2.name AND m1.gamemode = m2.gamemode";
			if (strlen($prefix) > 0)
				$query .= " WHERE m1.map like '" . $prefix . "%' and m2.custom = 0";
			else
				$query .= " WHERE m2.custom = 1";
			$query .= $query_where;
			$query .= " ORDER BY m1.gamemode ASC, m1.map ASC, m1.difficulty DESC, m1.time " . $query_orderby . ", p.name ASC";

			$result = mysql_query($query);

			if (!$result || mysql_num_rows($result) <= 0)
				continue;

			$i = 1;
			while ($row = mysql_fetch_array($result)) {

				$line = "<tr"; // onmouseover=\"showtip('test');\" onmouseout=\"hidetip();\"";
				$line .= ($i++ & 1) ? ">" : " class=\"alt\">";
		
				if ($previous_map != $row['map'])
				{
					$starttag = "<b>";
					$endtag = "</b>";
				}
				else
				{
					$starttag = "";
					$endtag = "";
				}

				$difficulty = "Unknown";

				switch ($row['difficulty'])
				{
					case 1:
						$difficulty = "Normal";
						break;
					case 2:
						$difficulty = "Advanced";
						break;
					case 3:
						$difficulty = "Expert";
						break;
				}

				$gamemode = "Unknown";

				switch ($row['gamemode'])
				{
					case 0:
						$gamemode = "Co-op";
						break;
					case 2:
						$gamemode = "Realism";
						break;
					case 3:
						$gamemode = "Survival";
						break;
					case 6:
						$gamemode = "Mutations";
						break;
				}
		
				$line .= "<td>" . $starttag . "(" . $gamemode . ") " . $row['map'] . $endtag . "</td>";
/*
				switch ($row['gamemode'])
				{
					case 0:
						$line .= "<td>" . $starttag . "Co-op" . $endtag . "</td>";
						break;
		
					case 1:
						$line .= "<td>" . $starttag . "Versus" . $endtag . "</td>";
						break;
		
					case 2:
						$line .= "<td>" . $starttag . "Realism" . $endtag . "</td>";
						break;
		
					default:
						$line .= "<td>" . $starttag . "UNKNOWN" . $endtag . "</td>";
						break;
				}
*/
				$line .= "<td>" . $starttag . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . "<a href=\"player.php?steamid=" . $row['steamid']. "\">" . htmlentities($row['name'], ENT_COMPAT, "UTF-8") . "</a>" . $endtag . "</td>";
				$line .= "<td>" . $starttag . $difficulty . $endtag . "</td>";
		
				$thetime = "";
				//$time = $row['time'] - ($row['time'] % 60);
				//if ($time > 0)
				//	$thetime = ($time / 60) . "m&nbsp;";
				//$thetime .= ($row['time'] % 60) . "s";
				$thetime = formatage($row['time']);
				$line .= "<td>" . $starttag . $thetime . $endtag . "</td>";
		
				$line .= "</tr>\n";
		
				$arr_maprunners[] = $line;
		
				$previous_map = $row['map'];
			}
		
			if (mysql_num_rows($result) == 0) $arr_maprunners[] = "<tr><td colspan=\"3\" align=\"center\">There are no map timings!</td</tr>\n";
		
			$maprun->set("maprunners", $arr_maprunners);
			$body = $maprun->fetch($templatefiles['timedmaps.tpl']);
			
			$stats->set("page_body", $body);
			$stats->set("page_link", "<a href=\"timedmaps.php?gamemode=" . $j . "&id=" . $prefix . "\">View Full Stats for " . $title . "</a>");

			$fulloutput .= $stats->fetch($templatefiles['tmap_page.tpl']);
		}
	}
}

$tpl->set('body', trim($fulloutput));

// Output the top 10 
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch($templatefiles['layout.tpl']);
?>
