<!--/ pade header -->

<section class="page-banner">
	<?php if(!empty($page_items->photo_path)){ ?>
	<img alt="<?php echo $page_items->alt_title; ?>" title="<?php echo $page_items->alt_title; ?>" src="uploads/pages/<?php echo $page_items->photo_path; ?>" class="img-responsive">
	
	<?php } ?>
</section>