
    <!-- Start Banner 
    ============================================= -->
    <div class="banner-area blue pt-120 content-double box-nav background-move bg-gray" style="background-image: url(assets/img/bg-2.png);">
        <div class="container">
            <div class="row">
                <div class="double-items">
                    <div class="col-md-6 col-sm-7 left-info simple-video">
                        <div class="content">
                            <div class="banner-carousel owl-carousel owl-theme">
                            <?php if (!empty($banners)):?>
                                <?php foreach ($banners as $key=>$row):   ?>
                                            <!-- Single Item -->
                                            <div class="item">
                                            <h3><?php echo $row->banner_title; ?></h3>
                                            <h1>
                                            <?php echo $row->banner_desc; ?>  
                                            </h1>
                                            <a class="btn-animation popup-youtube" href="<?php echo $row->button_url; ?>
                                            ">
                                            Explore Now
                                            </a>
                                            </div>
                                            <!-- End Single Item -->
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-5 right-info">
                        <div class="content">
                            <div class="thumb animated">
                                <img src="assets/img/illustrations/1.png" alt="Thumb">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner -->




























