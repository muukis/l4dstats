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
