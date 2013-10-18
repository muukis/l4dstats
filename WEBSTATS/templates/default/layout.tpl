<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<?php echo $statspagemeta;?>
	
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>  
	
	<title>Left 4 Dead 2 Player Stats :: <?php echo $title;?></title>
	<link href="./templates/default/css/style.css" rel="stylesheet" type="text/css" />
	<link href="./templates/default/css/player.css" rel="stylesheet" type="text/css" />
	<link href="./templates/default/css/dropdown.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="./savi/jquery.js"></script>
	<script type="text/javascript" src="./savi/steamprofile.js"></script>
</head>
<body>

		<!-- jQuery if needed -->
		<script type="text/javascript">
			function DropDown(el) {
				this.dd = el;
				this.placeholder = this.dd.children('span');
				this.opts = this.dd.find('ul.dropdown > li');
				this.val = '';
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						return false;
					});
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-3').removeClass('active');
				});

			});
			
			function show_slct_show() {
				document.getElementById('lang_slct_show').style.display = "block";
				document.getElementById('lang_slct_show').style.opacity = "1";
				document.getElementById('lang_slct_show').style.pointer-events = "yes";
			} else {
				document.getElementById('lang_slct_show').style.display = "none";
				document.getElementById('lang_slct_show').style.opacity = "0";
				document.getElementById('lang_slct_show').style.pointer-events = "none";
			}
		
		</script>

<!-- start tooltip control -->
<script type="text/javascript" src="./templates/default/js/statstooltip.js"></script>
<!-- end tooltip control -->

<!-- start combobox control -->
<script type="text/javascript" src="./templates/default/js/statscombobox.js"></script>
<!-- end combobox control -->

<!-- start header -->
<div id="header">
<a href="https://github.com/muukis/l4dstats"><img style="position: fixed; top: 0; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork me on GitHub"></a>
	<!-- Serach Bar -->
	<div id="search">
		<?php echo $lang_tpl_layout_search; ?>
		<form method="post" action="search.php">
			<input type="text" id="s" name="search" value="" />
			<input type="submit" id="x" name="submit" value="<?php echo $lang_tpl_layout_search_btn; ?>" />
		</form>
	</div>
	<div id="logo">
		<h2><?php echo $site_name;?></h2>
		<?php foreach ($template_selector as $template_info): ?>
		<?php echo ' <a href="' . $template_info['getprm'] . '" target="self">' . $template_info['name'] . '</a>'; ?>
		<?php endforeach; ?>
		<?php echo 'Current template: ' . $current_template; ?>
	</div>
	<!-- Zombies killed, Players Served -->
	<div id="players_served" align="right">
		<?php foreach ($header_extra as $title => $value): ?>
		<h2><?php echo $title;?>: <?php echo number_format($value);?></h2>
		<?php endforeach; ?>
	</div>
</div>
<!--
<div id="motd">
	<?php echo $motd_message;?>
	<h2>Message Of The Day</h2>
	<ul>
		<li style="font-size: 10px; line-height: 12px; color: rgb(255, 102, 51);" >This server is the home of Custom Player Stats. Tip of the day: You can mute Custom Player Stats from Rank Menu. Type RANKMENU to open Rank Menu! </li>
	</ul>
</div>-->
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
				<h2><?php echo $lang_tpl_layout_menutitle; ?></h2>
				<ul>
					<li><a href="index.php"><?php echo $lang_tpl_layout_plyonline; ?></a></li>
					<li><a href="playerlist.php"><?php echo $lang_tpl_layout_plyrank; ?></a></li>
					<li><a href="search.php"><?php echo $lang_tpl_layout_plysearch; ?></a></li>
					<li><a href="awards.php"><?php echo $lang_tpl_layout_plyaward; ?></a></li>
					<li><a href="javascript:void();" class="special" onmouseover="showcmb(this, '<a href=&quot;maps.php?type=coop&quot;>Coop Stats</a><br><?php echo $realismcmblink;?><a href=&quot;maps.php?type=versus&quot;>Versus Stats</a><br><?php echo $scavengecmblink;?><a href=&quot;maps.php?type=survival&quot;>Survival Stats</a><br><?php echo $realismversuscmblink;?><?php echo $mutationscmblink;?>');" onmouseout="hidecmb();"><?php echo $lang_tpl_layout_modestats; ?> &raquo;</a></li>
					<?php echo $timedmapslink;?>
					<li><a href="server.php" class="special"><?php echo $lang_tpl_layout_servstats; ?></a></li>
				</ul>
			</li>

			<li>
				<h2><b><?php echo $lang_tpl_layout_top10; ?></b></h2>
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
		<span id="legal1">Copyright &copy; 2013 <a href="http://forums.alliedmods.net/member.php?u=52082" target="_blank" >muukis</a> | Left 4 Dead Stats written for <a href="http://forums.alliedmods.net/showthread.php?t=115965" target="_blank" >SourceMod</a> | Designed by <a href="http://forums.alliedmods.net/member.php?u=178524" target="_blank" >JonnyBoy0719</a></span><br>
	</p>
		<div class="lang-dropdown">
		<span><?php echo $current_language;?></span>
			<ul class="dropdown">
				<?php foreach ($language_selector as $language_info): ?>
				<?php echo '<li><a href="' . $language_info['getprm'] . '" target="_self"><i class="icon-large"><img src="' . $language_info['path'] . '"></i>'. $language_info['name'] . '</a></li>' ?>
				<?php endforeach; ?>
			</ul>
		</div>
</div>
<!-- end footer -->
</body>
</html>