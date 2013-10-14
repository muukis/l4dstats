<div class="map_post">
		<?php if ($page_link) : ?>
			<?php echo $page_link;?>
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
			<?php echo $page_link2;?>
		<?php else : ?>
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
		<?php endif; ?>
	<h2>
		<?php if ($page_link) : ?>
			<?php echo $page_link;?><?php echo $page_subject;?><?php echo $page_link2;?>
		<?php else : ?>
			<?php echo $page_subject;?>
		<?php endif; ?>
	</h2>
	<div class="entry">
		<?php echo $page_body;?>
	</div>
</div>