<table class="stats">
<tr><th rowspan=2><?php echo $language_pack['mapname']; ?></th><th rowspan=2><?php echo $language_pack['playtime']; ?></th><th rowspan=2><?php echo $language_pack['all4dead']; ?></th><th colspan=2><?php echo $language_pack['points']; ?></th><th colspan=2><?php echo $language_pack['kills']; ?></th></tr>
<tr><th><img src="<?php echo $icon_infected;?>" alt="<?php echo $language_pack['infectedpoints']; ?>"></th><th><img src="<?php echo $icon_survivors;?>" alt="<?php echo $language_pack['survivorpoints']; ?>"></th><th><img src="<?php echo $icon_infected;?>" alt="<?php echo $language_pack['infectedkills']; ?>"></th><th><img src="<?php echo $icon_survivors;?>" alt="<?php echo $language_pack['survivorkills']; ?>"></th></tr>
<?php
  foreach ($maps as $i => $row)
  {
    $line = ($i & 1) ? "<tr>" : "<tr class=\"alt\">";
    $line .= "<td>" . $row['name'] . "</td><td>" . formatage($row['playtime'] * 60) . "</td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td>" . number_format($row['infected_win']) . "</td><td>" . number_format($row['points_infected']) . "</td>" : "") . "<td>" . number_format($row['points']) . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "" : " (" . number_format(getppm($row['points'], $row['playtime']), 2) . ")") . "</td><td>" . number_format($row['kills']) . "</td>" . (($type == "versus" || $type == "scavenge" || $type == "realismversus") ? "<td>" . number_format($row['kill_survivor']) . "</td>" : "") . (($type == "coop" || $type == "realism" || $type == "survival" || $type == "mutations") ? "<td>" . number_format($row['restarts']) . "</td>" : "") . "</tr>\n";
    echo $line;
  }
?>
</table>
