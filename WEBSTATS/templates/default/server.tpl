<p>More zombies have been killed on this server than the entire population of <a href="http://google.com/search?q=site:en.wikipedia.org+<?php echo $totalpop[0];?>&btnI=1"><?php echo $totalpop[0];?></a>, population <b><?php echo number_format($totalpop[1]);?></b>.<br />
That is almost more than the entire population of <a href="http://google.com/search?q=site:en.wikipedia.org+<?php echo $totalpop[2];?>&btnI=1"><?php echo $totalpop[2];?></a>, population <b><?php echo number_format($totalpop[3]);?></b>!</p>

<table cellspacing="0" cellpaddin="0" border="0">
    <tr valign="top"><td align="center" width="50%">

<table class="stats">
    <tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Server Summary</th></tr>
<tr onmouseover="showtip('Total players served');" onmouseout="hidetip();"><td>Total players:</td><td><?php echo $players;?></td></tr>
<tr onmouseover="showtip('Total points earned on the server by all players');" onmouseout="hidetip();"><td>Total points:</td><td><?php echo $points;?></td></tr>
<tr onmouseover="showtip('Normal and special infected killed by survivors<br>&nbsp;&nbsp;melee: <?php echo $melee_kills;?>');" onmouseout="hidetip();"><td>Infected Killed:</td><td><?php echo $infected_killed;?></td></tr>
<tr onmouseover="showtip('Survivors killed by infected<br><b>Versus: <?php echo $survivors_killed_versus;?><?php echo $survivors_killed_scavenge;?></b>');" onmouseout="hidetip();"><td>Survivors Killed:</td><td><?php echo $survivors_killed;?></td></tr>
<tr onmouseover="showtip('Infected killed with a headshot');" onmouseout="hidetip();"><td>Headshots:</td><td><?php echo $headshots;?></td></tr>
<tr onmouseover="showtip('Headshots per total fired shots on infected');" onmouseout="hidetip();"><td>Headshot Ratio:</td><td><?php echo $ratio;?> %</td></tr>
<tr onmouseover="showtip('Points earned per playtime<br><b>Coop: <?php echo $player_ppm_coop;?><br><?php echo $player_ppm_realism;?>Survival: <?php echo $player_ppm_survival;?><br>Versus: <?php echo $player_ppm_versus;?><?php echo $player_ppm_scavenge;?></b>');" onmouseout="hidetip();"><td>Points per Minute:</td><td><?php echo $player_ppm;?></td></tr>
<tr onmouseover="showtip('Survivors blinded on average per vomit<br>&nbsp;&nbsp;blinded : <?php echo $boomer_blinded;?><br>&nbsp;&nbsp;vomits : <?php echo $boomer_vomits;?><br>&nbsp;&nbsp;spawns: <?php echo $spawn_boomer;?>');" onmouseout="hidetip();"><td>Boomer Average:</td><td><?php echo $avg_boomer;?></td></tr>
<tr onmouseover="showtip('Hunter pounce damage average per pounce<br>&nbsp;&nbsp;damage: <?php echo $hunter_damage;?><br>&nbsp;&nbsp;pounces: <?php echo $hunter_pounces;?><br>&nbsp;&nbsp;spawns: <?php echo $spawn_hunter;?>');" onmouseout="hidetip();"><td>Hunter Average:</td><td><?php echo $avg_hunter;?></td></tr>
<tr onmouseover="showtip('Smoker damage average per spawn<br>&nbsp;&nbsp;damage: <?php echo $smoker_damage;?><br>&nbsp;&nbsp;spawns: <?php echo $spawn_smoker;?>');" onmouseout="hidetip();"><td>Smoker Average:</td><td><?php echo $avg_smoker;?></td></tr>
<?php echo $l4d2_special_infected;?>
<tr onmouseover="showtip('Tank damage average per spawn<br>&nbsp;&nbsp;damage: <?php echo $tank_damage;?><br>&nbsp;&nbsp;spawns: <?php echo $spawn_tank;?>');" onmouseout="hidetip();"><td>Tank Average:</td><td><?php echo $avg_tank;?></td></tr>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Infected Kills Summary</th></tr>
<tr><th>Infected Type</th><th>Kills</th></tr>
<?php foreach ($arr_kills as $type => $kills): ?>
<tr><td><?php echo $type;?></td><td><?php echo number_format($kills);?></td></tr>
<?php endforeach;?>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Infected Awards Summary</th></tr>
<?php foreach ($arr_infected_awards as $award => $count): ?>
<tr><td align="right"><?php echo $award;?></td><td><?php echo number_format($count);?></td></tr>
<?php endforeach;?>
</table>

	</td></tr>
</table>

</td><td align="center" width="50%">

<table class="stats">
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Survivor Awards Summary</th></tr>
<?php foreach ($arr_survivor_awards as $award => $count): ?>
<tr><td align="right"><?php echo $award;?></td><td><?php echo number_format($count);?></td></tr>
<?php endforeach;?>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Demerits Summary</th></tr>
<?php foreach ($arr_demerits as $demerit => $count): ?>
<tr><td align="right"><?php echo $demerit;?></td><td><?php echo number_format($count);?></td></tr>
<?php endforeach;?>
</table>


	</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2">Gamemodes Summary</th></tr>
<tr onmouseover="showtip('<b>All Gamemodes Summary:</b><br>&nbsp;&nbsp;maps: <?php echo $totalmaps;?><br>&nbsp;&nbsp;total points: <?php echo $totalpoints;?> (PPM: <?php echo $totalppm;?>)<br>&nbsp;&nbsp;&nbsp;&nbsp;normal: <?php echo $totalpoints_nor;?> (PPM: <?php echo $totalppm_nor;?>)<br>&nbsp;&nbsp;&nbsp;&nbsp;advanced: <?php echo $totalpoints_adv;?> (PPM: <?php echo $totalppm_adv;?>)<br>&nbsp;&nbsp;&nbsp;&nbsp;expert: <?php echo $totalpoints_exp;?> (PPM: <?php echo $totalppm_exp;?>)<br>&nbsp;&nbsp;total playtime: <?php echo $totalplaytime;?><br>&nbsp;&nbsp;&nbsp;&nbsp;normal: <?php echo $totalplaytime_nor;?><br>&nbsp;&nbsp;&nbsp;&nbsp;advanced: <?php echo $totalplaytime_adv;?><br>&nbsp;&nbsp;&nbsp;&nbsp;expert: <?php echo $totalplaytime_exp;?>');" onmouseout="hidetip();"><td align="right"><b>All</b></td><td><b><?php echo $totalplaytime;?></b></td></tr>
<?php foreach ($arr_maps as $map): ?>
<tr onmouseover="showtip('<b><?php echo $map['gamemodename'];?> Summary:</b><br>&nbsp;&nbsp;maps: <?php echo $map['totalmaps'];?><br>&nbsp;&nbsp;total points: <?php echo $map['totalpoints'];?> (PPM: <?php echo $map['totalppm'];?>)<br>&nbsp;&nbsp;&nbsp;&nbsp;normal: <?php echo $map['totalpoints_nor'];?> (PPM: <?php echo $map['totalppm_nor'];?>)<br>&nbsp;&nbsp;&nbsp;&nbsp;advanced: <?php echo $map['totalpoints_adv'];?> (PPM: <?php echo $map['totalppm_adv'];?>)<br>&nbsp;&nbsp;&nbsp;&nbsp;expert: <?php echo $map['totalpoints_exp'];?> (PPM: <?php echo $map['totalppm_exp'];?>)<br>&nbsp;&nbsp;total playtime: <?php echo $map['totalplaytime'];?><br>&nbsp;&nbsp;&nbsp;&nbsp;normal: <?php echo $map['totalplaytime_nor'];?><br>&nbsp;&nbsp;&nbsp;&nbsp;advanced: <?php echo $map['totalplaytime_adv'];?><br>&nbsp;&nbsp;&nbsp;&nbsp;expert: <?php echo $map['totalplaytime_exp'];?>');" onmouseout="hidetip();"><td align="right"><?php echo $map['gamemodename'];?></td><td><?php echo $map['totalplaytime'];?></td></tr>
<?php endforeach;?>
</table>


	</td></tr>
</table>

</td></tr>
<tr><td colspan="2" align="center" width="100%">


</td></tr>
</table>

