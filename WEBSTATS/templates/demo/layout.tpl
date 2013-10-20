<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>DEMO TEMPLATE</title>
<link href="<?php $cssfile = 'style'; echo file_exists($current_template_path . '/css/' . $cssfile . '.css') ? $current_template_path . '/css/' . $cssfile . '.css' : './templates/default/css/' . $cssfile . '.css';?>" rel="stylesheet" type="text/css" />
<link href="<?php $cssfile = 'body'; echo file_exists($current_template_path . '/css/' . $cssfile . '.css') ? $current_template_path . '/css/' . $cssfile . '.css' : './templates/default/css/' . $cssfile . '.css';?>" rel="stylesheet" type="text/css" />
<link href="<?php $cssfile = 'player'; echo file_exists($current_template_path . '/css/' . $cssfile . '.css') ? $current_template_path . '/css/' . $cssfile . '.css' : './templates/default/css/' . $cssfile . '.css';?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./savi/jquery.js"></script>
<script type="text/javascript" src="./savi/steamprofile.js"></script>
</head>
<body>

<!-- start tooltip control -->
<script type="text/javascript" src="./templates/<?php echo $statstooltip;?>"></script>
<!-- end tooltip control -->

<!-- start combobox control -->
<script type="text/javascript" src="./templates/<?php echo $statscombobox;?>"></script>
<!-- end combobox control -->

<!-- start header -->
<div id="header">
	<div id="logo">
		<h1>DEMO TEMPLATE</h1>
		<h2><?php echo $site_name;?></h2>
	</div>
	<div id="players_served" align="right">
		<?php foreach ($header_extra as $title => $value): ?>
		<h2><?php echo $title;?>: <?php echo number_format($value);?></h2>
		<?php endforeach; ?>
	</div>
</div>
<!-- end header -->

<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
                <div class="post">
			<h1 class="title" style="background: none; padding: 0; margin-top: -10px;"><?php echo $page_heading;?></h1>
		</div>

		<?php echo $body;?>

	</div>
	<!-- end content -->

	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
				<h2>Left 4 Dead Stats</h2>
				<ul>
					<li><a href="index.php">Players Online</a></li>
					<li><a href="playerlist.php">Player Rankings</a></li>
					<li><a href="search.php">Player Search</a></li>
					<li><a href="awards.php">Rank Awards</a></li>
					<li><a href="javascript:void();" class="special" onmouseover="showcmb(this, '<a href=&quot;maps.php?type=coop&quot;>Coop Stats</a><br><?php echo $realismcmblink;?><a href=&quot;maps.php?type=versus&quot;>Versus Stats</a><br><?php echo $scavengecmblink;?><a href=&quot;maps.php?type=survival&quot;>Survival Stats</a><br><?php echo $realismversuscmblink;?><?php echo $mutationscmblink;?>');" onmouseout="hidecmb();">Gamemode Stats &raquo;</a></li>
					<li><a href="timedmaps.php">Timed Maps</a></li>
					<li><a href="server.php" class="special">Server Stats</a></li>
				</ul>
			</li>

			<li>
				<h2><b>Top 10 Players</b></h2>
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<?php foreach ($top10 as $text): ?>
					<?php echo $text;?>
					<?php endforeach; ?>
				</table>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->

<!-- start footer -->
<div id="footer">
	<p id="legal">
		<span id="legal1">DEMO TEMPLATE</span><br>
	</p>
</div>
<!-- end footer -->
</body>
</html>