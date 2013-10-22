<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>DEMO TEMPLATE</title>
<link href="css.php?file=style" rel="stylesheet" type="text/css" />
<link href="css.php?file=player" rel="stylesheet" type="text/css" />
<link href="css.php?file=stats" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./savi/jquery.js"></script>
<script type="text/javascript" src="./savi/steamprofile.js"></script>

<style type="text/css">
	body {
		margin: 0;
		padding: 0;
		background: url(<?php $filepath = '/css/img/stats_bg.jpg'; echo file_exists($current_template_path . $filepath) ? $current_template_path . $filepath : './templates/default' . $filepath;?>)  no-repeat fixed center top transparent;
		background-color: rgb(21,21,21);
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		font-size: 13px;
		color: #D4D4D4;
	}
</style>
</head>
<body>

<!-- start tooltip control -->
<script type="text/javascript" src="./templates/default/js/statstooltip.js"></script>
<!-- end tooltip control -->

<!-- start combobox control -->
<script type="text/javascript" src="./templates/default/js/statscombobox.js"></script>
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
					<span class="menu_stats">
					<li><a href="#stats">Gamemode Stats &raquo;</a></li>
						<ol class="ddown_stats">
							<li><a href="maps.php?type=coop">Coop Stats</a></li>
							<li><?php echo $realismcmblink;?></li>
							<li><a href="maps.php?type=versus">Versus Stats</a></li>
							<li><?php echo $scavengecmblink;?></li>
							<li><a href="maps.php?type=survival">Survival Stats</a></li>
							<li><?php echo $realismversuscmblink;?></li>
							<li><?php echo $mutationscmblink;?></li>
						</ol>
					</span>
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