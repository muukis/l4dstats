<div class="post">
	<div class="entry">
<p><?php
  $link1 = sprintf($language_pack['campaignstatsdesclink'], $totalpop[0], $totalpop[0]);
  $link2 = sprintf($language_pack['campaignstatsdesclink'], $totalpop[2], $totalpop[2]);
  echo sprintf($language_pack['campaignstatsdesc'], $link1, number_format($totalpop[1]), $link2, number_format($totalpop[3]))
?></p>

		<table class="stats">
		<tr><th><?php echo $language_pack['campaignname'];?></th><th><?php echo $language_pack['totalplaytime'];?></th><th>Total Points (PPM)</th><th>Total Kills</th><th>Total Restarts</th></tr>
		<?php foreach ($maps as $map): ?><?php echo $map;?><?php endforeach; ?>
		</table>
	</div>
</div>
