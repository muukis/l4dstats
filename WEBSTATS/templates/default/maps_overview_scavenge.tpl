<div class="post">
	<div class="entry">
		<p>More zombies have been killed on this server than the entire population of <a href="http://google.com/search?q=site:en.wikipedia.org+<?php echo $totalpop[0];?>&btnI=1"><?php echo $totalpop[0];?></a>, population <b><?php echo number_format($totalpop[1]);?></b>.<br />
		That is almost more than the entire population of <a href="http://google.com/search?q=site:en.wikipedia.org+<?php echo $totalpop[2];?>&btnI=1"><?php echo $totalpop[2];?></a>, population <b><?php echo number_format($totalpop[3]);?></b>!</p>

		<table class="stats">
		<tr><th rowspan=2>Campaign Name</th><th rowspan=2>Total Playtime</th><th rowspan=2>Total<br />All&nbsp;4&nbsp;Dead</th><th colspan=2>Total Points</th><th colspan=2>Total Kills</th></tr>
		<tr><th><img src="./templates/<?php echo $icon_infected;?>" alt="Infected Total Points"></th><th><img src="./templates/<?php echo $icon_survivors;?>" alt="Survivor Total Points"></th><th><img src="./templates/<?php echo $icon_infected;?>" alt="Infected Total Kills"></th><th><img src="./templates/<?php echo $icon_survivors;?>" alt="Survivor Total Kills"></th></tr>
		<?php foreach ($maps as $map): ?><?php echo $map;?><?php endforeach; ?>
		</table>
	</div>
</div>
