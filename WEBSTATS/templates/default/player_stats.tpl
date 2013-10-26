<link href="./templates/default/css/achivement.css" rel="stylesheet" type="text/css" />
					<div class="awards-base">
						<div class="box" style="margin-left: 25px;width:250px;float:left;">
							<div class="dt" style="width:250px;">
								<dt onmouseover="showtip('<?php echo $language_pack['tpl_tip_rank']; ?>');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['tpl_rank'];?></tr>
									<tr><b><?php echo $player_rank;?></b></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $language_pack['tpl_tip_points']; ?><br><b>Coop: <?php echo $player_points_coop;?><br><?php echo $player_points_realism;?>Survival: <?php echo $player_points_survival;?><br>Versus: <?php echo $player_points_versus;?></b><br>&nbsp;&nbsp;Survivors: <?php echo $player_points_versus_sur;?><br>&nbsp;&nbsp;Infected: <?php echo $player_points_versus_inf;?><?php echo $player_points_scavenge;?>');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['tpl_points'];?></tr>
									<tr><b><?php echo $player_points;?></b></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $language_pack['tpl_tip_ikill']; ?><br>&nbsp;&nbsp;melee: <?php echo $melee_kills;?>');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['tpl_ikill'];?></tr>
									<tr><b><?php echo $infected_killed;?></b></tr>
								</dt>
								<dt onmouseover="showtip('<?php echo $language_pack['tpl_tip_skill']; ?><br><b>Versus: <?php echo $survivors_killed_versus;?><?php echo $survivors_killed_scavenge;?></b>');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['tpl_skill'];?></tr>
									<tr><b><?php echo $survivors_killed;?></b></tr>
								</dt>
								<dt onmouseover="showtip('Infected killed with a headshot');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['tpl_headshot'];?></tr>
									<tr><b><?php echo $player_headshots;?></b></tr>
								</dt>
								<dt onmouseover="showtip('Headshots per total fired shots on infected');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['tpl_headratio'];?></tr>
									<tr><b><?php echo $player_ratio;?> %</b></tr>
								</dt>
								<dt onmouseover="showtip('Points earned per playtime<br><b>Coop: <?php echo $player_ppm_coop;?><br><?php echo $player_ppm_realism;?>Survival: <?php echo $player_ppm_survival;?><br>Versus: <?php echo $player_ppm_versus;?><?php echo $player_ppm_scavenge;?></b>');" onmouseout="hidetip();">
									<tr><?php echo $language_pack['tpl_ppm'];?></tr>
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
					
					<h1><?php echo $language_pack['tpl_title_sub'];?></h1>
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