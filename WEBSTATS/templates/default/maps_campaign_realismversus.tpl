<table class="stats">
<tr><th rowspan=2>Map Name</th><th rowspan=2>Playtime</th><th rowspan=2>All&nbsp;4&nbsp;Dead</th><th colspan=2>Points</th><th colspan=2>Kills</th></tr>
<tr><th><img src="./templates/<?php echo $icon_infected;?>" alt="Infected Points"></th><th><img src="./templates/<?php echo $icon_survivors;?>" alt="Survivor Points"></th><th><img src="./templates/<?php echo $icon_infected;?>" alt="Infected Kills"></th><th><img src="./templates/<?php echo $icon_survivors;?>" alt="Survivor Kills"></th></tr>
<?php foreach ($maps as $map): ?><?php echo $map;?><?php endforeach; ?>
</table>
