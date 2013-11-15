<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Player Search page - "search.php"
================================================
*/

// Include the primary PHP functions file
include("./common.php");

// Load outer template
$tpl = new Template($templatefiles['layout.tpl']);

// Set Steam ID as var, and quit on hack attempt
$searchstring = mysql_real_escape_string($_POST['search']);
if ($searchstring."" == "") $searchstring = md5("nostring");

$tpl->set("title", $language_pack['playersearch']); // Window title
$tpl->set("page_heading", $language_pack['playersearch']); // Page header

$result = mysql_query("SELECT * FROM " . $mysql_tableprefix . "players WHERE name LIKE '%" . $searchstring . "%' OR steamid LIKE '%" . $searchstring . "%' ORDER BY name LIMIT 100");
if (mysql_error()) {
  $output = "<p><b>MySQL Error:</b> " . mysql_error() . "</p>\n";
} else {
  $arr_players = array();
  $stats = new Template($templatefiles['search.tpl']);

  $i = 1;
  while ($row = mysql_fetch_array($result))
  {
    $arr_players[$i++] = getplayerinfo($row);
    /*
    $line = createtablerowtooltip($row, $i);
    $line .= "<td>" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . "<a href=\"player.php?steamid=" . $row['steamid']. "\">" . htmlentities($row['name'], ENT_COMPAT, "UTF-8") . "</a></td>";
    $line .= "<td>" . gettotalpoints($row) . "</td><td>" . gettotalplaytime($row) . "</td></tr>\n";

    $i++;
    $arr_online[] = $line;
    */
  }

  //if (mysql_num_rows($result) == 0) $arr_online[] = "<tr><td colspan=\"3\" align=\"center\">" . $language_pack['noplayersfound'] . "</td</tr>\n";
  $stats->set("searchstr", $_POST['search']);
  $stats->set("players", $arr_players);
  $output = $stats->fetch($templatefiles['search.tpl']);
}

$tpl->set('body', trim($output));

// Output the top10
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch($templatefiles['layout.tpl']);
?>
