
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
				<h2><?php echo $language_pack['tpl_layout_menutitle']; ?></h2>
				<ul>
					<li><a href="index.php"><?php echo $language_pack['playersonline']; ?></a></li>
					<li><a href="playerlist.php"><?php echo $language_pack['tpl_layout_plyrank']; ?></a></li>
					<li><a href="search.php"><?php echo $language_pack['tpl_layout_plysearch']; ?></a></li>
					<li><a href="awards.php"><?php echo $language_pack['tpl_layout_plyaward']; ?></a></li>
					<span class="menu_stats">
					<li><a href="#stats"><?php echo $language_pack['tpl_layout_modestats']; ?> &raquo;</a></li>
						<ol class="ddown_stats">
							<li><a href="maps.php?type=coop"><?php echo $language_pack['tpl_layout_coopstats']; ?></a></li>
							<?php echo $realismlink;?>
							<li><a href="maps.php?type=versus"><?php echo $language_pack['tpl_layout_versusstats']; ?></a></li>
							<?php echo $scavengelink;?>
							<li><a href="maps.php?type=survival"><?php echo $language_pack['tpl_layout_survivalstats']; ?></a></li>
							<?php echo $realismversuslink;?>
							<?php echo $mutationslink;?>
						</ol>
					</span>
					<?php echo $timedmapslink;?>
					<li><a href="server.php" class="special"><?php echo $language_pack['tpl_layout_servstats']; ?></a></li>
				</ul>
			</li>
<?php echo $template_properties['top10']; ?>
		</ul>
	</div>
	<!-- end sidebar -->
