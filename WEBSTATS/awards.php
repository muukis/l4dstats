<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Rank Awards page - "awards.php"
================================================
*/

function addordinalnumbersuffix($num)
{
  if (!in_array(($num % 100), array(11,12,13)))
  {
    switch ($num % 10)
    {
      // Handle 1st, 2nd, 3rd
      case 1: return $num . 'st';
      case 2: return $num . 'nd';
      case 3: return $num . 'rd';
    }
  }

  return $num . 'th';
}

// Include the primary PHP functions file
include("./common.php");

// Load outer template
$tpl = new Template($templatefiles['layout.tpl']);

// Include award file
include("./" . $award_file);

if ($game_version != 1)
	include("./" . $award_l4d2_file);

$awardarr = array("kills" => $award_kills,
				  "headshots" => $award_headshots,

				  "versus_kills_survivors + scavenge_kills_survivors + realism_kills_survivors" => $award_killsurvivor,
				  "kill_infected" => $award_killinfected,
				  "melee_kills" => $award_melee_kills,
				  "kill_hunter" => $award_killhunter,
				  "kill_smoker" => $award_killsmoker,
				  "kill_boomer" => $award_killboomer,

				  "award_pills" => $award_pills,
				  "award_medkit" => $award_medkit,
				  "award_hunter" => $award_hunter,
				  "award_smoker" => $award_smoker,
				  "award_protect" => $award_protect,
				  "award_revive" => $award_revive,
				  "award_rescue" => $award_rescue,
				  "award_campaigns" => $award_campaigns,
				  "award_tankkill" => $award_tankkill,
				  "award_tankkillnodeaths" => $award_tankkillnodeaths,
				  "award_allinsafehouse" => $award_allinsafehouse,

				  "award_friendlyfire" => $award_friendlyfire,
				  "award_teamkill" => $award_teamkill,
				  "award_fincap" => $award_fincap,
				  "award_left4dead" => $award_left4dead,
				  "award_letinsafehouse" => $award_letinsafehouse,
				  "award_witchdisturb" => $award_witchdisturb,

				  "award_pounce_nice" => $award_pounce_nice,
				  "award_pounce_perfect" => $award_pounce_perfect,
				  "award_perfect_blindness" => $award_perfect_blindness,
				  "award_infected_win" => $award_infected_win,
				  "award_bulldozer" => $award_bulldozer,
				  "award_survivor_down" => $award_survivor_down,
				  "award_ledgegrab" => $award_ledgegrab,
				  "award_witchcrowned" => $award_witchcrowned,

				  "infected_tanksniper" => $infected_tanksniper
				  );

// L4D2 awards
if ($game_version != 1)
{
	$awardarr["kill_spitter"] = $award_killspitter;
	$awardarr["kill_jockey"] = $award_killjockey;
	$awardarr["kill_charger"] = $award_killcharger;

	$awardarr["award_adrenaline"] = $award_adrenaline;
	$awardarr["award_defib"] = $award_defib;
	$awardarr["award_jockey"] = $award_jockey;
	$awardarr["award_charger"] = $award_charger;

	$awardarr["award_matador"] = $award_matador;
	$awardarr["award_scatteringram"] = $award_scatteringram;
}

$cachedate = filemtime("./templates/awards_cache.html");
if ($cachedate < time() - (60*$award_cache_refresh)) {
	$real_playtime_sql = $TOTALPLAYTIME;
	$real_playtime = "real_playtime";
	$real_points_sql = $TOTALPOINTS;
	$real_points = "real_points";
	$extrasql = ", " . $real_points_sql . " as " . $real_points . ", " . $real_playtime_sql . " as " . $real_playtime;

	if ((int)$award_display_players <= 0)
	{
		$award_display_players = 1;
	}

	$query = "SELECT *" . $extrasql . " FROM " . $mysql_tableprefix . "players WHERE (" . $real_playtime_sql . ") >= " . $award_minplaytime . " ORDER BY (" . $real_points . " / " . $real_playtime . ") DESC LIMIT " . $award_display_players;
	$result = mysql_query($query);

	if ($result && mysql_num_rows($result) > 0)
	{
		$i = 0;

		while ($row = mysql_fetch_array($result))
		{
			if ($i++ == 0)
			{
				$table_body .= "<tr><td>" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . sprintf($award_ppm, "player.php?steamid=" . $row['steamid'], htmlentities($row['name'], ENT_COMPAT, "UTF-8"), number_format($row[$real_points] / $row[$real_playtime], 2));
			}
			else
			{
				$table_body .= "<br />\n<i style=\"font-size: 12px;\">" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . sprintf($award_second, "player.php?steamid=" . $row['steamid'], htmlentities($row['name'], ENT_COMPAT, "UTF-8"), addordinalnumbersuffix($i), number_format($row[$real_points] / $row[$real_playtime], 2)) . "</i>";
			}
		}

		$table_body .= "</td></tr>\n";
	}

	$query = "SELECT *" . $extrasql . " FROM " . $mysql_tableprefix . "players WHERE (" . $real_playtime_sql . ") >= " . $award_minplaytime . " ORDER BY " . $real_playtime . " DESC LIMIT " . $award_display_players;
	$result = mysql_query($query);

	if ($result && mysql_num_rows($result) > 0)
	{
		$i = 0;

		while ($row = mysql_fetch_array($result))
		{
			if ($i++ == 0)
			{
				$table_body .= "<tr><td>" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . sprintf($award_time, "player.php?steamid=" . $row['steamid'], htmlentities($row['name'], ENT_COMPAT, "UTF-8"), formatage($row[$real_playtime] * 60));
			}
			else
			{
				$table_body .= "<br />\n<i style=\"font-size: 12px;\">" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . sprintf($award_second, "player.php?steamid=" . $row['steamid'], htmlentities($row['name'], ENT_COMPAT, "UTF-8"), addordinalnumbersuffix($i), formatage($row[$real_playtime] * 60)) . "</i>";
			}
		}

		$table_body .= "</td></tr>\n";
	}

	$headshotratiosql = $real_playtime_sql . " >= " . $award_minplaytime . " AND " . $real_points_sql . " >= " . $award_minpoints . " AND kills >= " . $award_minkills . " AND headshots >= " . $award_minheadshots;

	$query = "SELECT *" . $extrasql . " FROM " . $mysql_tableprefix . "players WHERE " . $headshotratiosql . " ORDER BY (headshots/kills) DESC LIMIT " . $award_display_players;
	$result = mysql_query($query);

	if ($result && mysql_num_rows($result) > 0)
	{
		$i = 0;

		while ($row = mysql_fetch_array($result))
		{
			if (!($row['headshots'] && $row['kills']))
			{
				break;
			}

			if ($i++ == 0)
			{
				$table_body .= "<tr><td>" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . sprintf($award_ratio, "player.php?steamid=" . $row['steamid'], htmlentities($row['name'], ENT_COMPAT, "UTF-8"), number_format($row['headshots'] / $row['kills'], 4) * 100);
			}
			else
			{
				$table_body .= "<br />\n<i style=\"font-size: 12px;\">" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . sprintf($award_second, "player.php?steamid=" . $row['steamid'], htmlentities($row['name'], ENT_COMPAT, "UTF-8"), addordinalnumbersuffix($i), (number_format($row['headshots'] / $row['kills'], 4) * 100) . "&#37;") . "</i>";
			}
		}

		$table_body .= "</td></tr>\n";
	}

	foreach ($awardarr as $award => $awardstring) {
		$queryresult = array();

		$awardsql = ($award !== "award_teamkill" || $award !== "award_friendlyfire") ? " WHERE " . $real_playtime_sql . " >= " . $award_minplaytime . " AND " . $real_points_sql . " >= " . $award_minpointstotal : "";

		$query = "SELECT name, steamid, ip, " . $award . " AS queryvalue" . $extrasql . " FROM " . $mysql_tableprefix . "players " . $awardsql . " ORDER BY " . $award . " DESC LIMIT " . $award_display_players;
		$result = mysql_query($query);

		if ($result && mysql_num_rows($result) > 0)
		{
			$i = 0;

			while ($row = mysql_fetch_array($result))
			{
				if ($i++ == 0)
				{
					$table_body .= "<tr><td>" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . sprintf($awardstring, "player.php?steamid=" . $row['steamid'], htmlentities($row['name'], ENT_COMPAT, "UTF-8"), number_format($row['queryvalue']));
				}
				else
				{
					$table_body .= "<br />\n<i style=\"font-size: 12px;\">" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . sprintf($award_second, "player.php?steamid=" . $row['steamid'], htmlentities($row['name'], ENT_COMPAT, "UTF-8"), addordinalnumbersuffix($i), number_format($row['queryvalue'])) . "</i>";
				}
			}

			$table_body .= "</td></tr>\n";
		}
	}
	
	$stats = new Template($templatefiles['awards.tpl']);
	$stats->set("awards_date", date($lastonlineformat, time()));
	$stats->set("awards_body", $table_body);
	
	$award_output = $stats->fetch($templatefiles['awards.tpl']);
	file_put_contents("./templates/awards_cache.html", trim($award_output));
	// Multilang support
		//-- BASE
	$stats->set("lang_tpl_award_lastupdate", $language_pack['tpl_award_lastupdate']);
	// End
}

$tpl->set("title", $language_pack['tpl_award_title']); // Window title
$tpl->set("page_heading", $language_pack['tpl_award_title']); // Page header

$output = file_get_contents("./templates/awards_cache.html");

$tpl->set('body', trim($output));

// Output the top10
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch($templatefiles['layout.tpl']);
?>
