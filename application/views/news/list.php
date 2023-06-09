<section class="news-area section_25">
    <div class="container">
        <div class="row">
            <div class="col col-md-12 col-sm-12 single-content">
                <div class="post">
                    <?php if ($page_items->display_image == '1'): ?>
                        <div class="media">
                            <img  alt="<?php echo $page_items->alt_title; ?>" title="<?php echo $page_items->alt_title; ?>" src="/uploads/pages/<?php echo $page_items->page_path; ?>" class="img img-responsive">
                        </div>
                    <?php endif ?>
                    <div class="post-body">
                        <div class="content-area"><?php echo $page_items->page_content; ?></div>
                    </div>
                </div>
            </div>
            <ul class="thumbnails">
                <?php foreach ($news as $news_item): ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo base_url() . NEWS_PHOTO_UPLOAD_PATH_THUMB . $news_item->news_path; ?>" alt="<?php echo $news_item->alt_title; ?>" title="<?php echo $news_item->alt_title; ?>" class="img-responsive"  width="100%" height="80"/>
                         <div class="date-caption" style="padding: 10px;">
                                <span class="item-date">News Date : <?php echo date('d F Y', strtotime($news_item->news_date)); ?></span>
                            </div>	
                        <div class="caption">
                            <h3><?php echo substr($news_item->news_title,0,20); ?></h3>
                            <p><?php echo substr($news_item->news_short_desc,0,80); ?></p>
                            <p align="center"><a href="<?php echo "news/" . $news_item->news_slug; ?>" class="btn btn-primary btn-block">Read More About News</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php echo $links; ?>
    </div>
</section>