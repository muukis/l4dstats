<p><?php
  if ($searchstr && strlen($searchstr) > 0)
  {
    echo sprintf($language_pack['searchresult'], htmlentities("\"" . $searchstr . "\"", ENT_COMPAT, "UTF-8"));
  }
  else
  {
    echo $language_pack['entersearchstr'];
  }
?></p>

<table class="stats">
<tr><th><?php echo $language_pack['player'];?></th><th><?php echo $language_pack['points'];?></th><th width="40%"><?php echo $language_pack['totalplaytime'];?></th></tr>
<?php
  if ($players == null)
  {
    echo "<tr><td align=\"center\" colspan=\"3\">" . $language_pack['noplayersfound'] . "</td></tr>";
  }
  else
  {
    foreach ($players as $player_index => $player_info)
    {
      $line = "<tr>";
      $line .= "<td>" . $player_info['flag'] . "<a href=\"player.php?steamid=" . $player_info['steamid']. "\">" . $player_info['name'] . "</a></td>";
      $line .= "<td>" . number_format($player_info['totalpoints']) . "</td>";
      $line .= "<td>" . formatage($player_info['totalplaytime'] * 60) . "</td></tr>\n";
      echo $line;
    }
  }
?>
</table>

