<table class="stats">
<tr><th colspan="5"><a href="?"><?php echo $language_pack['overall'];?></a> | <a href="?type=coop"><?php echo $language_pack['coop'];?></a><?php echo $realism_link;?> | <a href="?type=survival"><?php echo $language_pack['survival'];?></a><?php echo $teammode_separator;?><a href="?type=versus"><?php echo $language_pack['versus'];?></a> (<a href="?type=versus&team=survivors"><?php echo $language_pack['survivors'];?></a> / <a href="?type=versus&team=infected"><?php echo $language_pack['infected'];?></a>)<?php echo $scavenge_link;?></th></tr>
<tr><th colspan="5"><a href="<?php echo $page_prev;?>">&lt;&lt; <?php echo $language_pack['prev'];?> 100</a> | <?php echo $language_pack['page'];?> <?php echo $page_current;?> / <?php echo $page_total;?> | <a href="<?php echo $page_next;?>"><?php echo $language_pack['next'];?> 100 &gt;&gt;</a></th></tr>
<tr><th><?php echo $language_pack['rank']; ?></th><th><?php echo $language_pack['player']; ?></th><th><?php echo $language_pack['points']; ?></th><th><?php echo $language_pack['playtime']; ?></th><th><?php echo $language_pack['lastonline']; ?></th></tr>
<?php
/*
  $line .= "<td align=\"center\">" . number_format($i) . "</td><td>" . ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : "") . "<a href=\"player.php?steamid=" . $row['steamid']. "\">" . htmlentities($row['name'], ENT_COMPAT, "UTF-8") . "</a></td>";
  $line .= "<td>" . number_format($row['real_points']) . "</td>";
  $line .= "<td>" . formatage($row['real_playtime'] * 60) . "</td>";
  $line .= "<td>" . formatage(time() - $row['lastontime']) . " ago</td></tr>\n";
  //$line .= "<td>" . $query . "</td></tr>\n";
*/
	if ($players == null)
	{
		echo "<tr><td align=\"center\" colspan=\"5\">" . $language_pack['norankedplayersfound'] . "</td></tr>";
	}
	else
	{
		foreach ($players as $player_rank => $player_info)
		{
			$line = "<tr>";
			$line .= "<td align=\"center\">" . number_format($player_rank) . "</td><td>" . $player_info['flag'] . "<a href=\"player.php?steamid=" . $player_info['steamid']. "\">" . $player_info['name'] . "</a></td>";
			$line .= "<td>" . number_format($player_info['row']['real_points']) . "</td>";
			$line .= "<td>" . formatage($player_info['row']['real_playtime'] * 60) . "</td>";
			$line .= "<td>" . formatage(time() - $player_info['row']['lastontime']) . " " . $language_pack['ago'] . "</td></tr>\n";
			echo $line;
		}
	}
?>
<tr><th colspan="5"><a href="<?php echo $page_prev;?>">&lt;&lt; <?php echo $language_pack['prev'];?> 100</a> | <?php echo $language_pack['page'];?> <?php echo $page_current;?> / <?php echo $page_total;?> | <a href="<?php echo $page_next;?>"><?php echo $language_pack['next'];?> 100 &gt;&gt;</a></th></tr>
</table>

