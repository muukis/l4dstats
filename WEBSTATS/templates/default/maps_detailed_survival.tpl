<table class="stats">
<tr><th>Difficulty</th><th>Playtime</th><th>Points (PPM)</th><th>Kills</th><th>Plays</th></tr>
<tr><td>Normal</td><td><?php echo $playtime[0];?></td><td><?php echo $points[0];?> (<?php echo $ppm[0];?>)</td><td><?php echo $kills[0];?></td><td><?php echo $restarts[0];?></td></tr>
<tr class="alt"><td>Advanced</td><td><?php echo $playtime[1];?></td><td><?php echo $points[1];?> (<?php echo $ppm[1];?>)</td><td><?php echo $kills[1];?></td><td><?php echo $restarts[1];?></td></tr>
<tr><td>Expert</td><td><?php echo $playtime[2];?></td><td><?php echo $points[2];?> (<?php echo $ppm[2];?>)</td><td><?php echo $kills[2];?></td><td><?php echo $restarts[2];?></td></tr>
<tr class="alt"><td><b>Total</b></td><td><b><?php echo $playtime[3];?></b></td><td><b><?php echo $points[3];?> (<?php echo $ppm[3];?>)</b></td><td><b><?php echo $kills[3];?></b></td><td><b><?php echo $restarts[3];?></b></td></tr>
</table>

