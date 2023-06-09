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
                        <div class="content-area"><?php echo $page_items->page_content; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <?php //echo "<pre>";print_r($photos_gallery);exit;/* photo gallery list page code begins here */  ?>
<?php if (!empty($photos_gallery)): ?>
    <div class="container">
        <div class="row">            
            <h2>Photo Galleries</h2>
           <?php /* <div class="col-md-8 col-sm-12"> */ ?>
            <div id="gallery-box" class="row text-center">
                <?php $i = 0; ?>
                <?php foreach ($photos_gallery as $gallery_item): ?>
                    <?php
                    if ($i % 3 == 0) {
                        echo '<div class="col-lg-12 col-md-12 col-sm-12" style="display: inline-block;">';
                        echo "</div>";
                    }
                    ?>
                    <div class="col-xs-12 col-sm-4 col-md-3 photo">
                        <div class="box"> 
                            <div class="hover-bg">
                                <div class="hover-text off">
                                    <a href="<?php echo 'photo-gallery/' . $gallery_item->gallery_slug; ?>"><i class="fa fa-chain"></i></a>
                                </div> 
                                <img src="<?php echo PHOTOS_THUMB_PATH . $gallery_item->photo_path; ?>" class="img-responsive"  alt="<?php echo $gallery_item->alt_title; ?>" title="<?php echo $gallery_item->alt_title; ?>">
                            </div>
                            <h5><?php echo substr(strip_tags($gallery_item->gallery_name), 0, 250); ?></h5>
                        </div>
                    </div>
                    <?php $i++ ?>
                <?php endforeach ?>
            </div>
            <?php /* </div> */ ?>
        </div>
    </div>
<?php endif ?>
<?php /* photo gallery list page code end here */ ?>

<?php if (!empty($videos_gallery)): ?>
    <div class="container">
        <div class="row">            
            <h2>Video Galleries</h2>
           <?php /* <div class="col-md-8 col-sm-12"> */ ?>
            <div id="gallery-box" class="row text-center">
                <?php $i = 0; ?>
                <?php foreach ($videos_gallery as $gallery_item): ?>
                    <?php
                    if ($i % 3 == 0) {
                        echo '<div class="col-lg-12 col-md-12 col-sm-12" style="display: inline-block;">';
                        echo "</div>";
                    }
                    ?>
                    <div class="col-xs-12 col-sm-4 col-md-3 photo">
                        <div class="box"> 
                            <div class="hover-bg">
                                <div class="hover-text off">
                                    <a href="<?php echo 'video-gallery/' . $gallery_item->gallery_slug; ?>"><i class="fa fa-chain"></i></a>
                                </div> 
                                <img src="<?php echo "https://img.youtube.com/vi/".$gallery_item->video_url."/0.jpg"; ?>" class="img-responsive"  alt="<?php echo $gallery_item->alt_title; ?>" title="<?php echo $gallery_item->alt_title; ?>">
                            </div>
                            <h5><?php echo substr(strip_tags($gallery_item->gallery_name), 0, 250); ?></h5>
                        </div>
                    </div>
                    <?php $i++ ?>
                <?php endforeach ?>
            </div>
            <?php /* </div> */ ?>
        </div>
    </div>
<?php endif ?>
<?php /* Video gallery list page code end here */ ?>
<?php echo $links; ?>