<section class="news-area section_25">
    <div class="container">
        <div class="row">
            <div class="col col-md-12 col-sm-12 single-content">
                <div class="post">
                    <?php if ($page_items->display_image == '1'): ?>
                        <div class="media">
                            <img  alt="<?php echo $page_items->alt_title; ?>" title="<?php echo $page_items->alt_title; ?>" src="myadmin/uploads/pages/<?php echo $page_items->page_path; ?>" class="img img-responsive">
                        </div>
                    <?php endif ?>
                    <div class="post-body">
                        <div class="content-area"><?php echo $page_items->page_content; ?></div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class='list-group gallerys'>
            <?php if (!empty($photo_items)): ?>
                <?php foreach ($photo_items as $photo): ?>
                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                        <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo PHOTOS_PATH . $photo->photo_path; ?>" title="<?php echo $photo->photo_title ?>">
                            <img class="img-responsive" alt="<?php echo $photo->photo_title ?>" src="<?php echo PHOTOS_THUMB_PATH . $photo->photo_path ?>" />
                        </a>
                    </div> 
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>