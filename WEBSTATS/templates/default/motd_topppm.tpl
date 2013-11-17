<table width="300" align="center" cellpaddin="0" cellspacing="0">
<tr>
	<td colspan="3"><h1 class="header_normal"><?php echo $language_pack['topefficientplayers']; ?></h1></td>
</tr>
<?php foreach ($motd_topppm as $row): ?>
<tr>
	<td align="left" width="1"><b><?php echo $row['rank'];?>.&nbsp;</b></td>
	<td align="left" class="player"><?php echo $row['flag'] . $row['name'];?></td>
	<td align="right"><?php echo number_format($row['score'], 2) . '&nbsp;PPM';?></td>
</tr>
<?php endforeach; ?>
</table>

