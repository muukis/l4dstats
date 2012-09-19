<table cellspacing="0" cellpaddin="0" border="0">
    <tr valign="top"><td align="center" width="50%">

<table class="stats">
    <tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Player Summary</th></tr>
<tr onmouseover="showtip('The ranking in the server stats');" onmouseout="hidetip();"><td>Rank:</td><td><?php echo $player_rank;?></td></tr>
<tr onmouseover="showtip('Total points earned from the server<br><b>Coop: <?php echo $player_points_coop;?><br><?php echo $player_points_realism;?>Survival: <?php echo $player_points_survival;?><br>Versus: <?php echo $player_points_versus;?></b><br>&nbsp;&nbsp;Survivors: <?php echo $player_points_versus_sur;?><br>&nbsp;&nbsp;Infected: <?php echo $player_points_versus_inf;?><?php echo $player_points_scavenge;?>');" onmouseout="hidetip();"><td>Points:</td><td><?php echo $player_points;?></td></tr>
<tr onmouseover="showtip('Normal and special infected killed<br>&nbsp;&nbsp;melee: <?php echo $melee_kills;?>');" onmouseout="hidetip();"><td>Infected Killed:</td><td><?php echo $infected_killed;?></td></tr>
<tr onmouseover="showtip('Survivors killed playing infected<br><b>Versus: <?php echo $survivors_killed_versus;?><?php echo $survivors_killed_scavenge;?></b>');" onmouseout="hidetip();"><td>Survivors Killed:</td><td><?php echo $survivors_killed;?></td></tr>
<tr onmouseover="showtip('Infected killed with a headshot');" onmouseout="hidetip();"><td>Headshots:</td><td><?php echo $player_headshots;?></td></tr>
<tr onmouseover="showtip('Headshots per total fired shots on infected');" onmouseout="hidetip();"><td>Headshot Ratio:</td><td><?php echo $player_ratio;?> %</td></tr>
<!--<tr onmouseover="showtip('Killed infected per total playtime as survivor');" onmouseout="hidetip();"><td>Kills per Minute:</td><td><?php echo $player_kpm;?></td></tr>-->
<tr onmouseover="showtip('Points earned per playtime<br><b>Coop: <?php echo $player_ppm_coop;?><br><?php echo $player_ppm_realism;?>Survival: <?php echo $player_ppm_survival;?><br>Versus: <?php echo $player_ppm_versus;?><?php echo $player_ppm_scavenge;?></b>');" onmouseout="hidetip();"><td>Points per Minute:</td><td><?php echo $player_ppm;?></td></tr>
<tr onmouseover="showtip('Survivors blinded on average per vomit<br>&nbsp;&nbsp;blinded : <?php echo $player_boomer_blinded;?><br>&nbsp;&nbsp;vomits : <?php echo $player_boomer_vomits;?><br>&nbsp;&nbsp;spawns: <?php echo $player_spawn_boomer;?>');" onmouseout="hidetip();"><td>Boomer Average:</td><td><?php echo $player_avg_boomer;?></td></tr>
<tr onmouseover="showtip('Hunter pounce damage average per pounce<br>&nbsp;&nbsp;damage: <?php echo $player_hunter_damage;?><br>&nbsp;&nbsp;pounces: <?php echo $player_hunter_pounces;?><br>&nbsp;&nbsp;spawns: <?php echo $player_spawn_hunter;?>');" onmouseout="hidetip();"><td>Hunter Average:</td><td><?php echo $player_avg_hunter;?></td></tr>
<tr onmouseover="showtip('Smoker damage average per spawn<br>&nbsp;&nbsp;damage: <?php echo $player_smoker_damage;?><br>&nbsp;&nbsp;spawns: <?php echo $player_spawn_smoker;?>');" onmouseout="hidetip();"><td>Smoker Average:</td><td><?php echo $player_avg_smoker;?></td></tr>
<?php echo $l4d2_special_infected;?>
<tr onmouseover="showtip('Tank damage average per spawn<br>&nbsp;&nbsp;damage: <?php echo $player_tank_damage;?><br>&nbsp;&nbsp;spawns: <?php echo $player_spawn_tank;?>');" onmouseout="hidetip();"><td>Tank Average:</td><td><?php echo $player_avg_tank;?></td></tr>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th>Infected Type</th><th>Kills</th></tr>
<?php foreach ($arr_kills as $title => $arr): ?>
<tr onmouseover="showtip('<?php echo $arr[1];?>');" onmouseout="hidetip();"><td><?php echo $title;?></td><td><?php echo number_format($arr[0]);?></td></tr>
<?php endforeach;?>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Demerits</th></tr>
<?php foreach ($arr_demerits as $title => $arr): ?>
<tr onmouseover="showtip('<?php echo $arr[1];?>');" onmouseout="hidetip();"><td align="right"><?php echo $title;?></td><td><?php echo number_format($arr[0]);?></td></tr>
<?php endforeach;?>
</table>

	</td></tr>
</table>

</td><td align="center" width="50%">

<table class="stats">
    <tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Player Profile</th></tr>
<tr><td>Name:</td><td><?php echo $player_name;?></td></tr>
<?php echo $player_country;?>
<tr><td>Steam ID:</td><td><?php echo $player_steamid;?></td></tr>
<tr><td>IP:</td><td><?php echo $player_ip;?></td></tr>
<tr><td>Steam Community:</td><td><?php echo $player_url;?></td></tr>
<tr><td>Last Online:</td><td><?php echo $player_lastonline;?></td></tr>
<tr onmouseover="showtip('<b>Playtime:</b><br>&nbsp;&nbsp;Coop: <?php echo $player_playtime_coop;?><br><?php echo $player_playtime_realism;?>&nbsp;&nbsp;Survival: <?php echo $player_playtime_survival;?><br>&nbsp;&nbsp;Versus: <?php echo $player_playtime_versus;?><?php echo $player_playtime_scavenge;?>');" onmouseout="hidetip();"><td>Total Playtime:</td><td><?php echo $player_playtime;?></td></tr>
<tr><td>Timed Maps:</td><td><a href="timedmaps.php?steamid=<?php echo $player_steamid;?>"><?php echo $player_timedmaps;?></a></td></tr>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Survivor Awards</th></tr>
<?php foreach ($arr_survivor_awards as $award => $arr): ?>
<tr onmouseover="showtip('<?php echo $arr[1];?>');" onmouseout="hidetip();"><td align="right"><?php echo $award;?></td><td><?php echo number_format($arr[0]);?></td></tr>
<?php endforeach;?>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Infected Awards</th></tr>
<?php foreach ($arr_infected_awards as $title => $arr): ?>
<tr onmouseover="showtip('<?php echo $arr[1];?>');" onmouseout="hidetip();"><td align="right"><?php echo $title;?></td><td><?php echo number_format($arr[0]);?></td></tr>
<?php endforeach;?>
</table>

	</td></tr>
</table>

</td></tr>
<tr><td colspan="2" align="center" width="100%">

<table class="statsbox">
<tr><th colspan="2">Achievements</th></tr>
<?php foreach ($arr_achievements as $achievement): ?>
<tr><?php echo $achievement;?></tr>
<?php endforeach;?>
</table>

</td></tr>
</table>

