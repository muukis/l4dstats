<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Player Ranking list page - "playerlist.php"
================================================
*/

// Include the primary PHP functions file
include("./common.php");

// Load outer template
$tpl = new Template("./templates/" . $templatefiles['layout.tpl']);

// Set Steam ID as var, and quit on hack attempt
if (strstr($_GET['page'], "/")) exit;
$page = $_GET['page'];

// Set game type as var, and quit on hack attempt
if (strstr($_GET['type'], "/")) exit;
$type = strtolower($_GET['type']);

// Set game type as var, and quit on hack attempt
if (strstr($_GET['team'], "/")) exit;
$team = strtolower($_GET['team']);

$query = "";

if($type == "" || $type == "coop" || $type == "realism" || $type == "versus" || $type == "survival" || $type == "scavenge" || $type == "realismversus" || $type == "mutations")
{
	$typelabel = "";
	
	if ($type == "coop") $typelabel = " (Coop)";
	else if ($type == "versus" && $team == "") $typelabel = " (Versus)";
	else if ($type == "scavenge" && $team == "") $typelabel = " (Scavenge)";
	else if ($type == "realism" && $team == "") $typelabel = " (Realism)";
	else if ($type == "survival" && $team == "") $typelabel = " (Survival)";
	else if ($type == "realismversus" && $team == "") $typelabel = " (Realism&nbsp;Versus)";
	else if ($type == "versus" && $team == "survivors") $typelabel = " (Versus : Survivors)";
	else if ($type == "versus" && $team == "infected") $typelabel = " (Versus : Infected)";
	else if ($type == "scavenge" && $team == "survivors") $typelabel = " (Scavenge : Survivors)";
	else if ($type == "scavenge" && $team == "infected") $typelabel = " (Scavenge : Infected)";
	else if ($type == "realismversus" && $team == "survivors") $typelabel = " (Realism&nbsp;Versus : Survivors)";
	else if ($type == "realismversus" && $team == "infected") $typelabel = " (Realism&nbsp;Versus : Infected)";
	else if ($type == "mutations" && $team == "") $typelabel = " (Mutations)";
	else $team = "";
	
	setcommontemplatevariables($tpl);

	$tpl->set("title", "Player Rankings" . $typelabel); // Window title
	$tpl->set("page_heading", "Player Rankings" . $typelabel); // Page header

	$sort = "";
	$playtime = "";
	
	if ($type == "coop")
	{
		$playtime = "playtime";
		$sort = "points";
	}
	else if ($type == "realism")
	{
		$playtime = "playtime_realism";
		$sort = "points_realism";
	}
	else if ($type == "survival")
	{
		$playtime = "playtime_survival";
		$sort = "points_survival";
	}
	else if ($type == "versus")
	{
		$playtime = "playtime_versus";
		if ($team == "survivors") $sort = "points_survivors";
		else if ($team == "infected") $sort = "points_infected";
		else $sort = "points_survivors + points_infected";
	}
	else if ($type == "scavenge")
	{
		$playtime = "playtime_scavenge";
		if ($team == "survivors") $sort = "points_scavenge_survivors";
		else if ($team == "infected") $sort = "points_scavenge_infected";
		else $sort = "points_scavenge_survivors + points_scavenge_infected";
	}
	else if ($type == "realismversus")
	{
		$playtime = "playtime_realismversus";
		if ($team == "survivors") $sort = "points_realism_survivors";
		else if ($team == "infected") $sort = "points_realism_infected";
		else $sort = "points_realism_survivors + points_realism_infected";
	}
	else if ($type == "mutations")
	{
		$playtime = "playtime_mutations";
		$sort = "points_mutations";
	}
	else
	{
		$playtime = $TOTALPLAYTIME;
		$sort = $TOTALPOINTS;
	}
	
	$query = "SELECT COUNT(*) as players_count FROM " . $mysql_tableprefix . "players WHERE " . $playtime . " > 0";

	$result = mysql_query($query);
	
	if (mysql_error()) {
    $output = "<p><b>MySQL Error:</b> " . mysql_error() . "</p>\n";
	
	} else {
		$row = mysql_fetch_array($result);

    $arr_players = array();
    $stats = new Template("./templates/" . $templatefiles['ranking.tpl']);

    $page_current = intval($page);
    $page_perpage = 100;
    $page_maxpages = ceil($row['players_count'] / $page_perpage) - 1;
    $page_nextpage = (intval($page_current + 1) > $page_maxpages) ? "0" : intval($page_current + 1);
    $page_prevpage = intval($page_current - 1);

    if ($page_prevpage < 0) $page_prevpage = $page_maxpages;
    if ($page_prevpage < 1) $page_prevpage = 0;

		$extra = ($type != "" ? "type=" . $type . "&" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") && $team != "" ? "team=" . $team . "&" : "") : "");
    $stats->set("page_prev", "playerlist.php?" . $extra . "page=" . $page_prevpage);
    $stats->set("page_current", $page_current + 1);
    $stats->set("page_total", $page_maxpages + 1);
    $stats->set("page_next", "playerlist.php?" . $extra . "page=" . $page_nextpage);

		if ($game_version != 1)
		{
			$stats->set("teammode_separator", "<br />\n");
			$stats->set("realism_link", " | <a href=\"?type=realism\">Realism</a> | <a href=\"?type=mutations\">Mutations</a>");
			$stats->set("scavenge_link", " | <a href=\"?type=scavenge\">Scavenge</a> (<a href=\"?type=scavenge&team=survivors\">Survivors</a> / <a href=\"?type=scavenge&team=infected\">Infected</a>)<br>\n" .
																	 "<a href=\"?type=realismversus\">Realism&nbsp;Versus</a> (<a href=\"?type=realismversus&team=survivors\">Survivors</a> / <a href=\"?type=realismversus&team=infected\">Infected</a>)");
		}
		else
		{
			$stats->set("teammode_separator", " | ");
			$stats->set("realism_link", "");
			$stats->set("scavenge_link", "");
		}

		if ($row['players_count'] > 0)
		{
	    $query = "SELECT *, " . $sort . " as real_points, " . $playtime . " as real_playtime FROM " . $mysql_tableprefix . "players where " . $playtime . " > 0 ORDER BY " . $sort . " DESC LIMIT ". intval($page_current * $page_perpage) .",". $page_perpage;
	    $result = mysql_query($query);

			if (mysql_error())
			{
				$arr_players[] = "<p><b>MySQL Error:</b> " . mysql_error() . "</p>\n";
				//$arr_players[] = "<br /><p><b>Query:</b> " . $query . "</p>\n";
		  }
			else
			{
		    $i = ($page_current !== 0) ? 1 + intval($page_current * 100) : 1;
		    while ($row = mysql_fetch_array($result))
		    {
			    $line = createtablerowtooltip($row, $i);
	        $line .= "<td align=\"center\">" . number_format($i) . "</td><td>" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . "<a href=\"player.php?steamid=" . $row['steamid']. "\">" . htmlentities($row['name'], ENT_COMPAT, "UTF-8") . "</a></td>";
	        $line .= "<td>" . number_format($row['real_points']) . "</td>";
	        $line .= "<td>" . formatage($row['real_playtime'] * 60) . "</td>";
	        $line .= "<td>" . formatage(time() - $row['lastontime']) . " ago</td></tr>\n";
	        //$line .= "<td>" . $query . "</td></tr>\n";
	        $arr_players[] = $line;
	        $i++;
		    }
	  	}
    }
    else
	  	$arr_players[] = "<tr><td align=\"center\" colspan=\"5\">No players found!</td></tr>";

    $stats->set("players", $arr_players);

    $output = $stats->fetch("./templates/" . $templatefiles['ranking.tpl']);
	}
}
else
	$output = "<h1>Illegal gametype</h1>";

$tpl->set('body', trim($output));

// Output the sidebar
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch("./templates/" . $templatefiles['layout.tpl']);
?>
