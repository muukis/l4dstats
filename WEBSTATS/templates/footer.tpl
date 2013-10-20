<head>
	<link href="./templates/css/dropdown.css" rel="stylesheet" type="text/css" />
	<link href="./templates/css/footer.css" rel="stylesheet" type="text/css" />
</head>
<!-- start footer -->
<div id="footer">
		<div class="lang-dropdown">
		<span><img src="img/icons/cog.png" /></span>
			<ul class="dropdown">
				<span class="ddown">
					<li><a href="#lang">Languages</a></li>
						<ol class="ddown_lang">
							<?php foreach ($language_selector as $language_info): ?>
							<?php echo '<li><a href="' . $language_info['getprm'] . '" target="_self"><i class="icon-large"><img src="' . $language_info['path'] . '"></i>'. $language_info['name'] . '</a></li>' ?>
							<?php endforeach; ?>
						</ol>
				</span>
				<span class="ddown2">
					<li><a href="#tpl">Templates</a></li>
						<ol class="ddown_tpl">
							<?php foreach ($template_selector as $template_info): ?>
							<?php echo '<li><a href="' . $template_info['getprm'] . '" target="_self">' . $template_info['name'] . '</a></li>'; ?>
							<?php endforeach; ?>
						</ol>
				</span>
			</ul>
		</div>
</div>
<!-- end footer <?php echo $current_language;?> <?php echo 'Current template: ' . $current_template; ?> -->
