		<!-- player.pl -->
			<div class="profile_header_content">
				<?php /* A very simple converter for a few selected SteamIDs. */
		//An automated converter will be made in the future
	if ($player_steamid == "STEAM_1:1:24323838") { // Example STEAMID
		echo"<div class='steamprofile' title='jonnyboy0719'></div>"; // Example Output.
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
					<script>
					function Signature_l4dstats()
					{
					document.getElementById("sig_select").select();
					}
					</script>
					<div class="signature-box">
					<?php echo "
						<img src='http://servers.gamefurs.net/l4d2stats/sig.php?steamid=" . $player_steamid . "' />";
						 echo '
						<input class="box_pre" type="text" id="sig_select" readonly value="[URL=http://servers.gamefurs.net/l4d2stats/player.php?steamid=' . $player_steamid . '][IMG]http://servers.gamefurs.net/l4d2stats/sig.php?steamid=' . $player_steamid . '[/IMG][/URL]">
						<button type="button" id="sig_button" onclick="Signature_l4dstats()">Select</button>';
					?>
					</div>
					<div class="information">
						<div class="box">
							<h2><?php echo $lang_tpl_player_id_title2;?></h2>
							<div class="dt">
								<dt>
									<tr><?php echo $lang_tpl_player_id2;?></tr>
									<tr><?php echo $player_steamid;?></tr>
								</dt>
								<dt  onmouseover="showtip('<b><?php echo $lang_tpl_player_id3_tip;?></b><br>&nbsp;&nbsp;Coop: <?php echo $player_playtime_coop;?><br><?php echo $player_playtime_realism;?>&nbsp;&nbsp;Survival: <?php echo $player_playtime_survival;?><br>&nbsp;&nbsp;Versus: <?php echo $player_playtime_versus;?><?php echo $player_playtime_scavenge;?>');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_player_id3;?></tr>
									<tr><?php echo $player_playtime;?></tr>
								</dt>
								<dt>
									<tr><?php echo $lang_tpl_player_id4;?></tr>
									<tr><a href="timedmaps.php?steamid=<?php echo $player_steamid;?>"><?php echo $player_timedmaps;?></a></tr>
								</dt>
							</div>
							<div class="bottom"></div>
						</div>
						
						<div class="box">
							<h2><a href="player_stats.php?steamid=<?php echo $player_steamid;?>"><?php echo $lang_tpl_player_id_title1;?></a></h2>
							<div class="dt">
								<dt onmouseover="showtip('<?php echo $lang_tpl_tip_points;?><br><b>Coop: <?php echo $player_points_coop;?><br><?php echo $player_points_realism;?>Survival: <?php echo $player_points_survival;?><br>Versus: <?php echo $player_points_versus;?></b><br>&nbsp;&nbsp;Survivors: <?php echo $player_points_versus_sur;?><br>&nbsp;&nbsp;Infected: <?php echo $player_points_versus_inf;?><?php echo $player_points_scavenge;?>');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_points;?></tr>
									<tr><?php echo $player_points;?></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $lang_tpl_tip_ikill;?><br>&nbsp;&nbsp;melee: <?php echo $melee_kills;?>');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_ikill;?></tr>
									<tr><?php echo $infected_killed;?></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $lang_tpl_tip_skill;?><br><b>Versus: <?php echo $survivors_killed_versus;?><?php echo $survivors_killed_scavenge;?></b>');" onmouseout="hidetip();">
									<tr><?php echo $lang_tpl_skill;?></tr>
									<tr><?php echo $survivors_killed;?></tr>
								</dt>
								<dt>
									<tr><?php echo $lang_tpl_player_id1;?></tr>
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
							<h2><?php echo $lang_tpl_player_surv;?></h2>
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
							<h3><?php echo $lang_tpl_player_infe;?></h3>
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