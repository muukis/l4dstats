<table class="stats">
<tr><th><?php echo $language_pack['difficulty']; ?></th><th><?php echo $language_pack['playtime']; ?></th><th><?php echo $language_pack['pointsppm']; ?></th><th><?php echo $language_pack['kills']; ?></th><th><?php echo $language_pack['plays']; ?></th></tr>
<tr><td><?php echo $language_pack['normal']; ?></td><td><?php echo $playtime[0];?></td><td><?php echo $points[0];?> (<?php echo $ppm[0];?>)</td><td><?php echo $kills[0];?></td><td><?php echo $restarts[0];?></td></tr>
<tr class="alt"><td><?php echo $language_pack['advanced']; ?></td><td><?php echo $playtime[1];?></td><td><?php echo $points[1];?> (<?php echo $ppm[1];?>)</td><td><?php echo $kills[1];?></td><td><?php echo $restarts[1];?></td></tr>
<tr><td><?php echo $language_pack['expert']; ?></td><td><?php echo $playtime[2];?></td><td><?php echo $points[2];?> (<?php echo $ppm[2];?>)</td><td><?php echo $kills[2];?></td><td><?php echo $restarts[2];?></td></tr>
<tr class="alt"><td><b><?php echo $language_pack['total']; ?></b></td><td><b><?php echo $playtime[3];?></b></td><td><b><?php echo $points[3];?> (<?php echo $ppm[3];?>)</b></td><td><b><?php echo $kills[3];?></b></td><td><b><?php echo $restarts[3];?></b></td></tr>
</table>

