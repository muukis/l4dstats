<table class="stats">
<tr><th rowspan=2>Difficulty</th><th rowspan=2>Playtime</th><th rowspan=2>All&nbsp;4&nbsp;Dead</th><th colspan=2>Points</th><th colspan=2>Kills</th></tr>
<tr><th><img src="./templates/<?php echo $icon_infected;?>" alt="Infected Points"></th><th><img src="./templates/<?php echo $icon_survivors;?>" alt="Survivor Points"></th><th><img src="./templates/<?php echo $icon_infected;?>" alt="Infected Kills"></th><th><img src="./templates/<?php echo $icon_survivors;?>" alt="Survivor Kills"></th></tr>
<tr><td>Normal</td><td><?php echo $playtime[0];?></td><td><?php echo $infected_win[0];?></td><td><?php echo $points_infected[0];?></td><td><?php echo $points[0];?></td><td><?php echo $kills[0];?></td><td><?php echo $survivor_kills[0];?></td></tr>
<tr class="alt"><td>Advanced</td><td><?php echo $playtime[1];?></td><td><?php echo $infected_win[1];?></td><td><?php echo $points_infected[1];?></td><td><?php echo $points[1];?></td><td><?php echo $kills[1];?></td><td><?php echo $survivor_kills[1];?></td></tr>
<tr><td>Expert</td><td><?php echo $playtime[2];?></td><td><?php echo $infected_win[2];?></td><td><?php echo $points_infected[2];?><td><?php echo $points[2];?></td><td><?php echo $kills[2];?></td><td><?php echo $survivor_kills[2];?></td></tr>
<tr class="alt"><td><b>Total</b></td><td><b><?php echo $playtime[3];?></b></td><td><b><?php echo $infected_win[3];?></b></td><td><b><?php echo $points_infected[3];?></b></td><td><b><?php echo $points[3];?></b></td><td><b><?php echo $kills[3];?></b></td><td><b><?php echo $survivor_kills[3];?></b></td></tr>
</table>

