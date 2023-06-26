<section>
	<?php if ($page_items->display_image == '1'): ?>
		<img alt="<?php echo $page_items->alt_title; ?>" title="<?php echo $page_items->alt_title; ?>" src="uploads/pages/<?php echo $page_items->photo_path; ?>" class="img-responsive">
	<?php endif ?>

	<?php if (!empty($page_items->page_content)): ?>
		<?php echo $page_items->page_content; ?>
	<?php endif; ?>
</section>