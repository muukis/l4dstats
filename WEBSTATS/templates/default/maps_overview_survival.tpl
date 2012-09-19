<div class="post">
	<div class="entry">
		<p>More zombies have been killed on this server than the entire population of <a href="http://google.com/search?q=site:en.wikipedia.org+<?php echo $totalpop[0];?>&btnI=1"><?php echo $totalpop[0];?></a>, population <b><?php echo number_format($totalpop[1]);?></b>.<br />
		That is almost more than the entire population of <a href="http://google.com/search?q=site:en.wikipedia.org+<?php echo $totalpop[2];?>&btnI=1"><?php echo $totalpop[2];?></a>, population <b><?php echo number_format($totalpop[3]);?></b>!</p>

		<table class="stats">
		<tr><th>Campaign Name</th><th>Total Playtime</th><th>Total Points (PPM)</th><th>Total Kills</th><th>Total Plays</th></tr>
		<?php foreach ($maps as $map): ?><?php echo $map;?><?php endforeach; ?>
		</table>
	</div>
</div>
