
			<li>
				<h2><span class="flicker"><?php echo $language_pack['left4deadstats']; ?></span></h2>
				<ul>
					<li><a href="index.php"><?php echo $language_pack['playersonline']; ?></a></li>
					<li><a href="playerlist.php"><?php echo $language_pack['playerrankings']; ?></a></li>
					<li><a href="search.php"><?php echo $language_pack['playersearch']; ?></a></li>
					<li><a href="awards.php"><?php echo $language_pack['rankawards']; ?></a></li>
					<span class="menu_stats">
					<li><a href="#stats"><?php echo $language_pack['gamemodestats']; ?> &raquo;</a></li>
						<ol class="ddown_stats">
							<li><a href="maps.php?type=coop"><?php echo $language_pack['coopstats']; ?></a></li>
							<?php echo $realismlink;?>
							<li><a href="maps.php?type=versus"><?php echo $language_pack['versusstats']; ?></a></li>
							<?php echo $scavengelink;?>
							<li><a href="maps.php?type=survival"><?php echo $language_pack['survivalstats']; ?></a></li>
							<?php echo $realismversuslink;?>
							<?php echo $mutationslink;?>
						</ol>
					</span>
					<?php echo $timedmapslink;?>
					<li><a href="server.php" class="special"><?php echo $language_pack['serverstats']; ?></a></li>
				</ul>
			</li>
