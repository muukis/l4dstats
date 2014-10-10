<table class="stats">
<tr><th><?php echo $language_pack['mapname']; ?></th><th><?php echo $language_pack['playtime']; ?></th><th><?php echo $language_pack['pointsppm']; ?></th><th><?php echo $language_pack['kills']; ?></th><th><?php echo $language_pack['restarts']; ?></th></tr>
<?php
  foreach ($maps as $i => $row)
  {
    $line = ($i & 1) ? "<tr>" : "<tr class=\"alt\">";
    $line .= "<td>" . $row['name'] . "</td><td>" . formatage($row['playtime'] * 60) . "</td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td>" . number_format($row['infected_win']) . "</td><td>" . number_format($row['points_infected']) . "</td>" : "") . "<td>" . number_format($row['points']) . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "" : " (" . number_format(getppm($row['points'], $row['playtime']), 2) . ")") . "</td><td>" . number_format($row['kills']) . "</td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td>" . number_format($row['kill_survivor']) . "</td>" : "") . (($type == "coop" || $type == "realism" || $type == "survival" || $type == "mutations") ? "<td>" . number_format($row['restarts']) . "</td>" : "") . "</tr>\n";
    echo $line;
  }
?>
</table>
