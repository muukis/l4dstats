<div class="map_post2">
			<div class="map_img">
				<?php
				$map_campaign = 'img/maps/' . $page_subject . '.jpg';
					if (file_exists($map_campaign)) {
					    echo "<img src='img/maps/" . $page_subject . ".jpg'>";
					} else {
					    echo "<img src='img/maps/default.jpg'>";
					}
				?>
			</div>
	<h2>
			<?php echo $page_subject;?>
	</h2>
	<div class="entry">
		<?php echo $page_body;?>
	</div>
</div>