<div class="post">
	<h2 class="title"><?php echo $page_subject;?></h2>
	<div class="entry">
		<p><?php echo $page_body;?></p>
	</div>
<?php if ($page_link) : ?>
        <div class="meta">
                <p class="link"><?php echo $page_link;?></p>
        </div>
<?php endif; ?>
</div>
