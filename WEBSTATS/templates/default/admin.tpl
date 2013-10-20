		<!-- player.pl -->
			<div class="profile_header_content">
				<?php /* A very simple converter for a few selected SteamIDs. */
	if ($player_steamid == "STEAM_1:1:24323838") {
		echo"<div class='steamprofile' title='jonnyboy0719'></div>";
	} elseif ($player_steamid == "STEAM_1:1:43775360") {
		echo"<div class='steamprofile' title='addeoftime55'></div>";
	} elseif ($player_steamid == "STEAM_1:1:28344274") {
		echo"<div class='steamprofile' title='rowdeyreiko'></div>";
	} elseif ($player_steamid == "STEAM_1:0:28144880") {
		echo"<div class='steamprofile' title='ticklemejimmies'></div>";
	} elseif ($player_steamid == "STEAM_1:0:29426414") {
		echo"<div class='steamprofile' title='likai'></div>";
	} elseif ($player_steamid == "STEAM_1:0:43688072") {
		echo"<div class='steamprofile' title='folfsky101'></div>";
	} else {
		echo"<div class='steamprofile' title=" . $player_steamid . "></div>";
	}
				?>
				<div class="profile_header_base">
					<div class="persona_name" style="font-size: 24px;">
						<a href="http://steamcommunity.com/profiles/<?php echo $player_url;?>" target="_blank"><?php echo $player_name;?></a>
					</div>
						<?php foreach ($arr_rank as $ranks): ?>
						<?php echo $ranks;?>
						<?php endforeach; ?>
					<div class="activity">
						<?php echo $player_lastonline;?>
					</div>
					<div class="information">
						<div class="box">
							<h2>Player Information</h2>
							<div class="dt">
								<dt>
									<tr>Steam ID:</tr>
									<tr><?php echo $player_steamid;?></tr>
								</dt>
								<dt  onmouseover="showtip('<b>Playtime:</b><br>&nbsp;&nbsp;Coop: <?php echo $player_playtime_coop;?><br><?php echo $player_playtime_realism;?>&nbsp;&nbsp;Survival: <?php echo $player_playtime_survival;?><br>&nbsp;&nbsp;Versus: <?php echo $player_playtime_versus;?><?php echo $player_playtime_scavenge;?>');" onmouseout="hidetip();">
									<tr>Total Playtime:</tr>
									<tr><?php echo $player_playtime;?></tr>
								</dt>
								<dt>
									<tr>Timed Maps:</tr>
									<tr><a href="timedmaps.php?steamid=<?php echo $player_steamid;?>"><?php echo $player_timedmaps;?></a></tr>
								</dt>
							</div>
							<div class="bottom"></div>
						</div>
						
						<div class="box">
							<h2>Administrate Player</h2>
							<div class="dt">
								<dt>
									<tr>Rank:</tr>
									<tr><?php echo $player_points;?></tr>
								</dt>
								<dt onmouseover="showtip('Normal and special infected killed<br>&nbsp;&nbsp;melee: <?php echo $melee_kills;?>');" onmouseout="hidetip();">
									<tr>Infected Killed:</tr>
									<tr><?php echo $infected_killed;?></tr>
								</dt>
								<dt onmouseover="showtip('Survivors killed playing infected<br><b>Versus: <?php echo $survivors_killed_versus;?><?php echo $survivors_killed_scavenge;?></b>');" onmouseout="hidetip();">
									<tr>Survivors Killed:</tr>
									<tr><?php echo $survivors_killed;?></tr>
								</dt>
								<dt>
									<tr>Achivements Earned:</tr>
									<tr>
										<?php foreach ($arr_achievements as $achievement): ?>
										<?php echo $achievement;?>
										<?php endforeach;?>
									</tr>
								</dt>
							</div>
							<div class="bottom"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="profile_content">
					<div class="awards-base">
						<div class="box">
							<h2>Survivor Awards</h2>
							<div class="dt">
								<?php foreach ($arr_survivor_awards as $award => $arr): ?>
								<dt onmouseover="showtip('<?php echo $arr[1];?>');" onmouseout="hidetip();">
									<tr><?php echo $award;?></tr>
									<tr><b><?php echo number_format($arr[0]);?></b></tr>
								</dt>
								<?php endforeach;?>
							</div>
							<div class="bottom"></div>
						</div>
					</div>
					<div class="awards-base2">
						<div class="box">
							<h3>Infected Awards</h3>
							<div class="dt">
								<?php foreach ($arr_infected_awards as $award => $arr): ?>
								<dt onmouseover="showtip('<?php echo $arr[1];?>');" onmouseout="hidetip();">
									<tr><?php echo $award;?></tr>
									<tr><b><?php echo number_format($arr[0]);?></b></tr>
								</dt>
								<?php endforeach;?>
							</div>
							<div class="bottom"></div>
						</div>
					</div>
			</div>
		<!-- end player.tpl -->