<div class="slider-container"  data-aos="zoom-in" data-aos-duration="500">
    <div class="slider-control left inactive"></div>
    <div class="slider-control right"></div>
    <ul class="slider-pagi"></ul>
    <div class="slider">
        <?php if (!empty($banners)): ?>
            <?php foreach ($banners as $key=>$row):   ?>
                <div class="slide slide-<?php echo $key; ?> <?php if($key == 0){ echo "active"; }?>" >
                    <div class="slide__bg"></div>
                    <div class="slide__content">
                        <div class="slide__text">
                            <h2 class="slide__text-heading" style="display:none"><?php echo $row->banner_title; ?></h2>
                            <p class="slide__text-desc">
                                <?php echo $row->banner_desc; ?>    
                            </p>
                            <a class="frame-btn slide__text-link" href="<?php echo $row->button_url; ?>">
                                <span class="frame-btn__outline frame-btn__outline--tall">
                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                </span>
                                <span class="frame-btn__outline frame-btn__outline--flat">
                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                </span>
                                <span class="frame-btn__solid"></span>
                                <span class="frame-btn__text">Explore Now</span>
                            </a>
                        </div>
                        <div class="slider_img">
                            <img src="<?php echo BANNERS_PHOTO_UPLOAD_PATH . $row->banner_path ?>" alt="" class="img-responsive">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
