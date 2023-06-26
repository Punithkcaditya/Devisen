<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <?php if (!empty($gallery_info->description)): ?>
            <p><?php echo $gallery_info->description; ?></p><hr>
        <?php endif ?>
    </div>
</div>
<?php /* Video gallery details page code begins here */ ?>
<?php if (!empty($video_items) && !empty($video)): ?>
    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-12">
        <p><iframe width="100%" height="465" src="https://www.youtube.com/embed/<?php echo $video->video_url; ?>" frameborder="0" allowfullscreen></iframe></p>
        <p><b><?php echo $video->video_title; ?></b></p>
        <p><?php echo $video->short_description; ?></p>
    </div>
<?php endif; ?>
<?php //echo "<pre/>"; print_r($video_items); ?>
<?php if (!empty($video_items) && empty($videos_gallery)): ?>
    <div class="row">
        <div class="col-md-12">
            <div id="Carousel" class="carousel slide">
                <ol class="carousel-indicators" style="display: none;">
                    <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#Carousel" data-slide-to="1"></li>
                    <li data-target="#Carousel" data-slide-to="2"></li>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < count($video_items); $i+=4): ?>
                        <div class="item <?php echo ($i == 0) ? 'active' : ''; ?>">
                            <div class="row">
                                <?php for ($j = 0; $j < 4; $j++): ?>
                                    <?php if (!empty($video_items[$i + $j]->video_url)): ?>
                                        <div class="col-md-3">
                                            <a href="<?php echo "video-gallery/".$gallery_info->gallery_slug.'/' . $video_items[$i + $j]->video_slug; ?>" class="thumbnail"><img src="https://img.youtube.com/vi/<?php echo $video_items[$i + $j]->video_url ?>/0.jpg" alt="Image" style="max-width:100%;"></a>
                                        </div>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div><!--.row-->
                        </div><!--.item-->
                    <?php endfor; ?>

                </div><!--.carousel-inner-->
                <a data-slide="prev" href="#Carousel" class="left carousel-control">&#8249;</a>
                <a data-slide="next" href="#Carousel" class="right carousel-control">&#8250;</a>
            </div><!--.Carousel-->

        </div>
    </div>
<?php endif ?>
<style>
    .carousel-control:hover, .carousel-control:focus{
        color: #fff !important;
    }
    .carousel {
        margin-bottom: 0;
        padding: 0 40px 30px 40px;
    }
    /* The controlsy */
    .carousel-control {
        color: #fff !important;
        left: 0px;
        height: 36px;
        width: 36px;
        background: none repeat scroll 0 0 #222222;
        border: 4px solid #FFFFFF;
        border-radius: 23px 23px 23px 23px;
        margin-top: 30px !important;
    }
    .carousel-control.right {
        right: 2px;
    }
    /* The indicators */
    .carousel-indicators {
        left: 18% !important;
        right: 50%;
        top: auto;
        bottom: -10px;
        margin-right: -19px;
    }
    /* The colour of the indicators */
    .carousel-indicators li {
        background: #cecece;
    }
    .carousel-indicators .active {
        background: #428bca;
    }
</style>
<?php /* Video gallery details page code begins here */ ?>