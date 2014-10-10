<div class="post">
	<div class="entry">
<p><?php
  $link1 = sprintf($language_pack['campaignstatsdesclink'], $totalpop[0], $totalpop[0]);
  $link2 = sprintf($language_pack['campaignstatsdesclink'], $totalpop[2], $totalpop[2]);
  echo sprintf($language_pack['campaignstatsdesc'], $link1, number_format($totalpop[1]), $link2, number_format($totalpop[3]))
?></p>

		<table class="stats">
		<tr><th rowspan=2><?php echo $language_pack['campaignname'];?></th><th rowspan=2><?php echo $language_pack['totalplaytime'];?></th><th rowspan=2><?php echo $language_pack['totalall4dead'];?></th><th colspan=2><?php echo $language_pack['totalpoints'];?></th><th colspan=2><?php echo $language_pack['totalkills'];?></th></tr>
		<tr><th><img src="<?php echo $icon_infected;?>" alt="<?php echo $language_pack['totalinfectedpoints'];?>"></th><th><img src="<?php echo $icon_survivors;?>" alt="<?php echo $language_pack['totalsurvivorpoints'];?>"></th><th><img src="<?php echo $icon_infected;?>" alt="<?php echo $language_pack['totalinfectedpoints'];?>"></th><th><img src="<?php echo $icon_survivors;?>" alt="<?php echo $language_pack['totalsurvivorpoints'];?>"></th></tr>
<?php
  foreach ($maps as $map_index => $map_info)
  {
    if ($map_info['totalrow'])
    {
      $line = "<tr class=\"total\">";
    }
    else
    {
      $line = ($map_index & 1) ? "<tr>" : "<tr class=\"alt\">";
    }

    $line .= "<td>" . $map_info['title'] . "</td><td>" . formatage($map_info['playtime'] * 60) . "</td>" . (($map_info['type'] == "versus" || $map_info['type'] == "scavenge" || $map_info['type'] == "realismversus") ? "<td>" . number_format($map_info['infected_win']) . "</td><td>" . number_format($map_info['points_infected']) . "</td>" : "") . "<td>" . number_format($map_info['points']) . (($map_info['type'] == "versus" || $map_info['type'] == "scavenge" || $map_info['type'] == "realismversus") ? "" : " (" . number_format(getppm($map_info['points'], $map_info['playtime']), 2) . ")") . "</td><td>" . number_format($map_info['kills']) . "</td>" . (($map_info['type'] == "versus" || $map_info['type'] == "scavenge" || $map_info['type'] == "realismversus") ? "<td>" . number_format($map_info['kill_survivor']) . "</td>" : "") . (($map_info['type'] == "coop" || $map_info['type'] == "realism" || $map_info['type'] == "survival" || $map_info['type'] == "mutations") ? "<td>" . number_format($map_info['restarts']) . "</td>" : "") . "</tr>\n";
    echo $line;
  }
?>
		</table>
	</div>
</div>
