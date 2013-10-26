<?php

// Template display name
$template_name = "Left 4 Dead";

// Append HTML headers
$extra_headers = <<<EOD
	<style type="text/css">
		#sidebar .flicker {
			color: transparent;
			text-shadow: white 0 0 1px;

			-webkit-transition: text-shadow 0.2s ease-in-out;
			-moz-transition: text-shadow 0.2s ease-in-out;
			transition: text-shadow 0.2s ease-in-out;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function() {
				var val = 1;
				if (Math.random() > 0.5) {
					val = Math.floor((Math.random()*5)+1);
				}
				$(".flicker").css("text-shadow", "white 0 0 " + val + "px");
			}, 200);
		});
	</script>
EOD;

//$template_properties['demo'] = 'This demonstrates how you can add your own properties on your default template.';

?>