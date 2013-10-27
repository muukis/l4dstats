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

$result = mysql_query("SELECT * FROM " . $mysql_tableprefix . "players WHERE lastontime >= '" . intval(time() - 300) . "' ORDER BY " . $TOTALPOINTS . " DESC");
$playercount = number_format(mysql_num_rows($result));

$tpl->set("title", $language_pack['playersonline']); // Window title
$tpl->set("page_heading", $language_pack['playersonline'] . " - " . $playercount); // Page header
if ($stats_refreshinterval > 0)
	$tpl->set("statspagemeta", "<meta http-equiv=\"refresh\" content=\"" . $stats_refreshinterval . "\">\n");
else
	$tpl->set("statspagemeta", "");

if (mysql_error()) {
  $output = "<p><b>MySQL Error:</b> " . mysql_error() . "</p>\n";

} else {
  $arr_online = array();
  $stats = new Template($templatefiles['online.tpl']);

	$googlemaps = "";
	$googlemaps_markercounter = 0;
	$googlemaps_servers = 0;
	$googlemaps_displayall = $googlemaps_showplayersonlinecount <= 0;

	if ($showmap && $showplayerflags && $showplayercity)
	{
		$googlemaps = "http://maps.googleapis.com/maps/api/staticmap?";

		$locations = count($game_locations);
		if ($locations == 1)
		{
			$site_lon = $game_locations[0]["lon"];
			$site_lat = $game_locations[0]["lat"];

			if ($site_lon || $site_lat)
			{
				$googlemaps_servers = 1;
				$googlemaps .= "&markers=color:red|label:S|" . $site_lat . "," . $site_lon;
			}
		}
		else if ($locations > 1)
		{
			$servers_counter = 0;

			foreach ($game_locations as $game_location)
			{
				$site_lon = $game_location["lon"];
				$site_lat = $game_location["lat"];

				$servers_counter++;

				if ($site_lon || $site_lat)
				{
					$googlemaps_servers++;
					$googlemaps .= "&markers=color:red|label:" . ($servers_counter > 9 ? "S" : $servers_counter) . "|" . $site_lat . "," . $site_lon;
				}
			}
		}
	}

  $i = 1;
  while ($row = mysql_fetch_array($result)) {
    if ($row['lastontime'] > time()) $row['lastontime'] = time();

		$lastgamemode = "Unknown";
		switch ($row['lastgamemode'])
		{
			case 0:
				$lastgamemode = "Coop";
				break;
			case 1:
				$lastgamemode = "Versus";
				break;
			case 2:
				$lastgamemode = "Realism";
				break;
			case 3:
				$lastgamemode = "Survival";
				break;
			case 4:
				$lastgamemode = "Scavenge";
				break;
			case 5:
				$lastgamemode = "Realism&nbsp;Versus";
				break;
			case 6:
				$lastgamemode = "Mutation";
				break;
		}

		$player_ip = $row['ip'];

		$avatarimg = "";
		
		if ($players_avatars_show && $players_online_avatars_show)
		{
			$avatarimgurl = getplayeravatar($row['steamid'], "icon");
			
			if($avatarimgurl)
			{
				$avatarimg = "<img src=\"" . $avatarimgurl . "\" border=\"0\">";
			}
		}
		
		$playername = ($showplayerflags ? $ip2c->get_country_flag($player_ip) : "") . "<a href=\"player.php?steamid=" . $row['steamid']. "\">" . htmlentities($row['name'], ENT_COMPAT, "UTF-8") . "</a>";
		
		if ($avatarimg)
		{
			$playername = "<table border=0 cellspacing=0 cellpadding=0><tr><td>" . $avatarimg . "</td><td>&nbsp;" . $playername . "</td></tr></table>";
		}

    $line = createtablerowtooltip($row, $i);
    $line .= "<td>" . $playername . "</td>";
    $line .= "<td>" . gettotalpoints($row) . "</td><td>" . $lastgamemode . "</td><td>" . gettotalplaytime($row) . "</td></tr>\n";

    $arr_online[] = $line;

		if (strlen($googlemaps) > 0 && ($googlemaps_displayall || $googlemaps_markercounter < $googlemaps_showplayersonlinecount))
		{
			$country_code = strtolower($ip2c->get_country_code($player_ip));

			if (strlen($country_code) > 0 && $country_code != "xx" && $country_code != "int")
			{
				$player_lat = $ip2c->get_latitude($player_ip);
				$player_lon = $ip2c->get_longitude($player_ip);

				$googlemaps_markercounter++;
				$googlemaps .= "&markers=color:blue|label:" . ($i > 9 ? "P" : $i) . "|" . $player_lat . "," . $player_lon;
			}
		}

    $i++;
  }

  if (count($arr_online) == 0) $arr_online[] = "<tr><td colspan=\"4\" align=\"center\">" . $language_pack['noplayersonline'] . "</td</tr>\n";

	$stats->set("online", $arr_online);
	$output = $stats->fetch($templatefiles['online.tpl']);

	if (strlen($googlemaps) > 0 && ($googlemaps_markercounter > 0 || $googlemaps_servers > 0))
	{
		if ($googlemaps_markercounter == 1 && $googlemaps_servers == 0 || $googlemaps_markercounter == 0 && $googlemaps_servers == 1)
			$googlemaps .= "&zoom=" . $googlemaps_playersonline_zoom;

		$googlemaps .= $googlemaps_playersonline_addparam;

		$output .= "<br><br><img src=\"" . $googlemaps . "\">";
	}
	
	/*
	// This part of the code adds a chatlog window in your "frontpage" (Players Online)
	// Download Extended Chat Log from here: http://forums.alliedmods.net/showthread.php?t=91331
	// Download Custom Player Stats modified Extended Chat Log PHP -page from here: http://forums.alliedmods.net/showthread.php?p=1365806#post1365806
	$output .= "
		<br><br>
		<iframe src =\"../l4d2/chatlog.php\" width=\"700\" height=\"250\" scrolling=\"no\" style=\"border-width:1px; border-style:solid; border-color: darkgrey;position: relative;left: 100px;top: 50px;\">
		  <p>Your browser does not support iframes.</p>
		</iframe>
	";
	*/
}

$tpl->set('body', trim($output));

// Output the top 10 
$tpl->set("top10", $top10);

// Output the MOTD
$tpl->set("motd_message", $layout_motd);

// Print out the page!
echo $tpl->fetch($templatefiles['layout.tpl']);
?>
