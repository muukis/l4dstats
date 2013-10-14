<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php echo $statspagemeta;?>
<title><?php echo $motd_header;?> :: <?php echo $title;?></title>
<link href="./templates/default/css/achivement.css" rel="stylesheet" type="text/css" />
<link href="./templates/<?php echo $stylesheet;?>" rel="stylesheet" type="text/css" />
<style type="text/css">
h1.header {
	margin-left: -2px;
	margin-top: -5px;
	letter-spacing: -1px;
	font-size: 36px;
	font-weight: bold;
	color: #FFFFFF;
}

h2.header_secondary {
	margin-top: -10px;
	font-size: 14px;
	font-weight: bold;
	color: #FFCC33;
}

h2.header_extra {
	margin-top: -3px;
	font-size: 12px;
	font-weight: bold;
	color: #888;
}

.player {
	font-size: 12px;
	font-weight: bold;
	color: #FFCC33;
}

h1.header_normal {
	margin-top: 15px;
	font-size: 24px;
	font-weight: bold;
	color: #FFFFFF;
	margin-bottom: 10px;
	border-bottom: 1px solid #FFCC33;
}

.motd_message {
	font-size: 14px;
	font-weight: normal;
	color: #888;
}
</style>
</head>
<body>

<div id="page">
<div class="awards-base">
						<div class="box" style="margin-left: 25px;width:250px;float:left;">
							<div class="dt" style="width:250px;">
								<dt onmouseover="showtip('<?php echo $lang_tpl_tip_rank; ?>');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_rank;?></tr>
									<tr><b><?php echo $player_rank;?></b></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $lang_tpl_tip_points; ?><br><b>Coop: <?php echo $player_points_coop;?><br><?php echo $player_points_realism;?>Survival: <?php echo $player_points_survival;?><br>Versus: <?php echo $player_points_versus;?></b><br>&nbsp;&nbsp;Survivors: <?php echo $player_points_versus_sur;?><br>&nbsp;&nbsp;Infected: <?php echo $player_points_versus_inf;?><?php echo $player_points_scavenge;?>');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_points;?></tr>
									<tr><b><?php echo $player_points;?></b></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $lang_tpl_tip_ikill; ?><br>&nbsp;&nbsp;melee: <?php echo $melee_kills;?>');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_ikill;?></tr>
									<tr><b><?php echo $infected_killed;?></b></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $lang_tpl_tip_skill; ?><br><b>Versus: <?php echo $survivors_killed_versus;?><?php echo $survivors_killed_scavenge;?></b>');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_skill;?></tr>
									<tr><b><?php echo $survivors_killed;?></b></tr>
								</dt>
								<dt onmouseover="showtip('Infected killed with a headshot');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_headshot;?></tr>
									<tr><b><?php echo $player_headshots;?></b></tr>
								</dt>
								<dt onmouseover="showtip('Headshots per total fired shots on infected');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_headratio;?></tr>
									<tr><b><?php echo $player_ratio;?> %</b></tr>
								</dt>
								<dt onmouseover="showtip('Points earned per playtime<br><b>Coop: <?php echo $player_ppm_coop;?><br><?php echo $player_ppm_realism;?>Survival: <?php echo $player_ppm_survival;?><br>Versus: <?php echo $player_ppm_versus;?><?php echo $player_ppm_scavenge;?></b>');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_ppm;?></tr>
									<tr><b><?php echo $player_ppm;?></b></tr>
								</dt>
							</div>
							<div class="bottom" style="width:250px;"></div>
						</div>

						<div class="box" style="margin-left: 25px;width:250px;float:left;" >
							<div class="dt" style="width:250px;">
								<?php foreach ($arr_kills as $title => $arr): ?>
								<dt onmouseover="showtip('<?php echo $arr[1];?>');" onmouseout="hidetip();">
									<tr><?php echo $title;?></tr>
									<tr><b><?php echo number_format($arr[0]);?></b></tr>
								</dt>
								<?php endforeach;?>
							</div>
							<div class="bottom" style="width:250px;"></div>
						</div>
						
						<div class="box" style="margin-left: 25px;width:250px;float:left;" >
							<div class="dt" style="width:250px;">
								<?php foreach ($arr_demerits as $title => $arr): ?>
								<dt onmouseover="showtip('<?php echo $arr[1];?>');" onmouseout="hidetip();">
									<tr><?php echo $title;?></tr>
									<tr><b><?php echo number_format($arr[0]);?></b></tr>
								</dt>
								<?php endforeach;?>
							</div>
							<div class="bottom" style="width:250px;"></div>
						</div>
						<div style="width:100%;height:150px;" clear="left"></div>
</div>
<br>
<h1><?php echo $lang_tpl_title_sub;?></h1>
<table cellspacing="0" cellpaddin="0" border="0" style="margin-left:auto;margin-right:auto;">
<tr>
<td valign="top" id="center_ach">
	<?php foreach ($arr_achievements as $achievement): ?>
	<tr><?php echo $achievement;?></tr>
	<?php endforeach;?>
<br></br>
	<?php foreach ($arr_achievements2 as $achievement2): ?>
	<tr><?php echo $achievement2;?></tr>
	<?php endforeach;?>
<br></br>
</td>
</tr>
</table>
</div>

<br />
<br />

</body>
</html>