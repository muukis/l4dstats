		<!-- player.pl -->
			<div class="profile_header_content">
				<?php echo"<div class='steamprofile' title=" . $player_steamid . "></div>";	?>
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
						<img src='sig.php?steamid=" . $player_steamid . "' />";
						 echo '
						<input class="box_pre" type="text" id="sig_select" readonly value="[URL=player.php?steamid=' . $player_steamid . '][IMG]sig.php?steamid=' . $player_steamid . '[/IMG][/URL]">
						<button type="button" id="sig_button" onclick="Signature_l4dstats()">Select</button>';
					?>
					</div>
					<div class="information">
						<div class="box">
							<h2><?php echo $language_pack['playerinformation'];?></h2>
							<div class="dt">
								<dt>
									<tr><?php echo $language_pack['steamid'];?>:</tr>
									<tr><?php echo $player_steamid;?></tr>
								</dt>
								<dt  onmouseover="showtip('<b><?php echo $language_pack['playtime'];?></b><br>&nbsp;&nbsp;Coop: <?php echo $player_playtime_coop;?><br><?php echo $player_playtime_realism;?>&nbsp;&nbsp;Survival: <?php echo $player_playtime_survival;?><br>&nbsp;&nbsp;Versus: <?php echo $player_playtime_versus;?><?php echo $player_playtime_scavenge;?>');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['totalplaytime'];?>:</tr>
									<tr><?php echo $player_playtime;?></tr>
								</dt>
								<dt>
									<tr><?php echo $language_pack['timedmaps'];?>:</tr>
									<tr><a href="timedmaps.php?steamid=<?php echo $player_steamid;?>"><?php echo $player_timedmaps;?></a></tr>
								</dt>
							</div>
							<div class="bottom"></div>
						</div>
						
						<div class="box">
							<h2><a href="player_stats.php?steamid=<?php echo $player_steamid;?>"><?php echo $language_pack['playerstats'];?></a></h2>
							<div class="dt">
								<dt onmouseover="showtip('<?php echo $language_pack['tiptotalpointsearned'];?><br><b>Coop: <?php echo $player_points_coop;?><br><?php echo $player_points_realism;?>Survival: <?php echo $player_points_survival;?><br>Versus: <?php echo $player_points_versus;?></b><br>&nbsp;&nbsp;Survivors: <?php echo $player_points_versus_sur;?><br>&nbsp;&nbsp;Infected: <?php echo $player_points_versus_inf;?><?php echo $player_points_scavenge;?>');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['points'];?>:</tr>
									<tr><?php echo $player_points;?></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $language_pack['tipinfectedkilled'];?><br>&nbsp;&nbsp;melee: <?php echo $melee_kills;?>');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['infectedkilled'];?>:</tr>
									<tr><?php echo $infected_killed;?></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $language_pack['tipsurvivorskilled'];?><br><b>Versus: <?php echo $survivors_killed_versus;?><?php echo $survivors_killed_scavenge;?></b>');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['survivorskilled'];?>:</tr>
									<tr><?php echo $survivors_killed;?></tr>
								</dt>
								<dt>
									<tr><?php echo $language_pack['achievementsearned'];?>:</tr>
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
							<h2><?php echo $language_pack['survivorawards'];?></h2>
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
							<h3><?php echo $language_pack['infectedawards'];?></h3>
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