<p><?php echo $servermsg; ?></p>

<table cellspacing="0" cellpaddin="0" border="0">
    <tr valign="top"><td align="center" width="50%">

<table class="stats">
    <tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2"><?php echo $language_pack['serversummary']; ?></th></tr>
<tr><td><?php echo $language_pack['totalplayers']; ?>:</td><td><?php echo $players;?></td></tr>
<tr><td><?php echo $language_pack['totalpoints']; ?>:</td><td><?php echo $points;?></td></tr>
<tr><td><?php echo $language_pack['infectedkilled']; ?>:</td><td><?php echo $infected_killed;?></td></tr>
<tr><td><?php echo $language_pack['survivorskilled']; ?>:</td><td><?php echo $survivors_killed;?></td></tr>
<tr><td><?php echo $language_pack['headshots']; ?>:</td><td><?php echo $headshots;?></td></tr>
<tr><td><?php echo $language_pack['headshotratio']; ?>:</td><td><?php echo $ratio;?> %</td></tr>
<tr><td><?php echo $language_pack['pointsperminute']; ?>:</td><td><?php echo $player_ppm;?></td></tr>
<tr><td><?php echo $language_pack['boomeraverage']; ?>:</td><td><?php echo $avg_boomer;?></td></tr>
<tr><td><?php echo $language_pack['hunteraverage']; ?>:</td><td><?php echo $avg_hunter;?></td></tr>
<tr><td><?php echo $language_pack['smokeraverage']; ?>:</td><td><?php echo $avg_smoker;?></td></tr>
<?php
	foreach ($l4d2_special_infected as $header => $value)
	{
		$output = "<tr><td>" . $header . ":</td><td>" . $value . "</td></tr>\n";
		$output .= "<tr><td>" . $header . ":</td><td>" . $value . "</td></tr>\n";
		$output .= "<tr><td>" . $header . ":</td><td>" . $value . "</td></tr>";
	}
?>
<tr><td><?php echo $language_pack['tankaverage']; ?>:</td><td><?php echo $avg_tank;?></td></tr>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2"><?php echo $language_pack['infectedkillssummary']; ?></th></tr>
<tr><th><?php echo $language_pack['infectedtype']; ?></th><th><?php echo $language_pack['kills']; ?></th></tr>
<?php foreach ($arr_kills as $type => $kills): ?>
<tr><td><?php echo $type;?></td><td><?php echo number_format($kills);?></td></tr>
<?php endforeach;?>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2"><?php echo $language_pack['infectedawardssummary']; ?></th></tr>
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
<tr><th colspan="2"><?php echo $language_pack['survivorawardssummary']; ?></th></tr>
<?php foreach ($arr_survivor_awards as $award => $count): ?>
<tr><td align="right"><?php echo $award;?></td><td><?php echo number_format($count);?></td></tr>
<?php endforeach;?>
</table>

</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2"><?php echo $language_pack['demeritssummary']; ?></th></tr>
<?php foreach ($arr_demerits as $demerit => $count): ?>
<tr><td align="right"><?php echo $demerit;?></td><td><?php echo number_format($count);?></td></tr>
<?php endforeach;?>
</table>


	</td></tr>
<tr valign="top"><td align="center">

<table class="statsbox">
<tr><th colspan="2"><?php echo $language_pack['gamemodessummary']; ?></th></tr>
<tr><td align="right"><b><?php echo $language_pack['all']; ?></b></td><td><b><?php echo $totalplaytime;?></b></td></tr>
<?php foreach ($arr_maps as $map): ?>
<tr><td align="right"><?php echo $map['gamemodename'];?></td><td><?php echo $map['totalplaytime'];?></td></tr>
<?php endforeach;?>
</table>


	</td></tr>
</table>

</td></tr>
<tr><td colspan="2" align="center" width="100%">


</td></tr>
</table>

