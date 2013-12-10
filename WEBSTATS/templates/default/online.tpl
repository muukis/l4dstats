<table class="stats">
<tr><th><?php echo $language_pack['player']; ?></th><th><?php echo $language_pack['points']; ?></th><th><?php echo $language_pack['gamemode']; ?></th><th width="40%"><?php echo $language_pack['totalplaytime']; ?></th></tr>
<?php

if (count($online) == 0)
{
	echo "<tr><td colspan=\"4\" align=\"center\">" . $language_pack['noplayersonline'] . "</td></tr>\n";
}
else
{
	foreach ($online as $i => $player)
	{
		$row = $player['row'];

	  if ($row['lastontime'] > time()) $row['lastontime'] = time();

		$lastgamemode = "Unknown";
		switch ($row['lastgamemode'])
		{
			case 0:
				$lastgamemode = $language_pack['coop'];
				break;
			case 1:
				$lastgamemode = $language_pack['versus'];
				break;
			case 2:
				$lastgamemode = $language_pack['realism'];
				break;
			case 3:
				$lastgamemode = $language_pack['survival'];
				break;
			case 4:
				$lastgamemode = $language_pack['scavenge'];
				break;
			case 5:
				$lastgamemode = $language_pack['realismversus'];
				break;
			case 6:
				$lastgamemode = $language_pack['mutation'];
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

		echo $line;
	}
}

?>
</table>
