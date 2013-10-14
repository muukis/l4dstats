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

					obj.opts.on('click',function(){
						var opt = $(this);
						obj.val = opt.text();
						obj.index = opt.index();
						obj.placeholder.text(obj.val);
						window.location = "?lang=" + obj.val;
					});
				},
				getValue : function() {
					return this.val;
				},
				getIndex : function() {
					return this.index;
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-3').removeClass('active');
				});

			});

		</script>

<!-- start tooltip control -->
<script type="text/javascript" src="./templates/default/js/statstooltip.js"></script>
<!-- end tooltip control -->

<!-- start combobox control -->
<script type="text/javascript" src="./templates/default/js/statscombobox.js"></script>
<!-- end combobox control -->

<!-- start header -->
<div id="header">
	<!-- Serach Bar -->
	<div id="search">
		<?php echo $lang_tpl_layout_search; ?>
		<form method="post" action="search.php">
			<input type="text" id="s" name="search" value="" />
			<input type="submit" id="x" name="submit" value="<?php echo $lang_tpl_layout_search_btn; ?>" />
		</form>
		<br>
		<div id="dd" class="lang-dropdown" tabindex="1">
		<span class="icon-en" ><?php echo $current_language;?></span>
			<ul class="dropdown">
				<?php foreach ($language_selector as $language_id => $language_flag_path): ?>
				<?php echo '<li><a href="?lang=' . $language_id . '" target="_self"><i class="icon-large"><img src="' . $language_flag_path . '"></i>'. $language_id . '</a></li>' ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<br>
	</div>
	<div id="logo">
		<h2><?php echo $site_name;?></h2>
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
		<span id="legal1">Copyright &copy; 2013 <a href="http://forums.alliedmods.net/member.php?u=52082">muukis</a> | Left 4 Dead Stats written for <a href="http://forums.alliedmods.net/showthread.php?t=115965">SourceMod</a> | Designed by <a href="http://forums.alliedmods.net/member.php?u=178524">JonnyBoy0719</a></span><br>
	</p>
</div>
<!-- end footer -->
</body>
</html>