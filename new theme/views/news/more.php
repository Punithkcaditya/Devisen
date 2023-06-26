<section class="news-area section_25">
    <div class="container">
        <div class="row">
            <div class="col col-md-8 col-sm-12 single-content">
                <div class="post">
                    <?php if ($query->display_image == '1'): ?>
                        <div class="media">
                            <img src="<?php echo base_url() . NEWS_PHOTO_UPLOAD_PATH . $query->news_path; ?>" alt class="img img-responsive">
                        </div><br/>
                    <?php endif ?>
                    <div class="post-title-meta">
                        <h2><?php echo $query->news_title; ?></h2>
                    </div>
                    <div class="post-body">
                        <p><?php echo $query->news_long_desc; ?></p>
                    </div>
                </div>
            </div>
            <div class="col col-md-4 col-sm-5">
                <div class="sidebar">
                    <div class="widget recent-post-widget">
                        <h3>Recent News</h3>

                        <ul class="thumbnails">
                            <?php foreach ($news as $news_item): ?>
                                <div class="thumbnail">
                                    <img src="<?php echo base_url() . NEWS_PHOTO_UPLOAD_PATH_THUMB . $news_item->news_path; ?>" alt="<?php echo $news_item->alt_title; ?>" title="<?php echo $news_item->alt_title; ?>" class="img-responsive"  width="100%" height="80"/>
                                    <div class="date-caption" style="padding: 10px;">
                                        <span class="item-date">News Date : <?php echo date('d F Y', strtotime($news_item->news_date)); ?></span>
                                    </div>	
                                    <div class="caption">
                                        <h3><?php echo substr($news_item->news_title, 0, 20); ?></h3>
                                        <p><?php echo substr($news_item->news_short_desc, 0, 80); ?></p>
                                        <p align="center"><a href="<?php echo "news/" . $news_item->news_slug; ?>" class="btn btn-primary btn-block">Read More About News</a>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>