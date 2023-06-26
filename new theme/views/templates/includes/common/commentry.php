
<section id="market-updates" class="padding-section">
    <div class="grid-row">	
        <div class="grid-col-row clear">
            <div class="grid-col col-sd-12">
                <div class="section-text-title" data-aos="fade-down" data-aos-duration="1000">
                    Market Updates & Commentaries
                    <span></span>
                </div><br /><br /><br /><br />
            </div>
        </div>
        <div class="grid-col-row clear">
            <div class="grid-col grid-col-4 col-sd-12">
                <img src="assets/images/market-updates.jpg" class="img-responsive">
            </div>
            <div class="grid-col grid-col-8 col-sd-12">
                <div class="carousel-nav">
                    <div class="carousel-button">
                        <div class="prev"><i class="fa fa-chevron-left"></i></div>
                        <div class="next"><i class="fa fa-chevron-right"></i></div>
                    </div>
                    <div class="carousel-line"></div>
                </div>
                <div id="recent-comments" class="owl-carousel owl-widget">
                    <ul>
                        <?php 
                        $cnt = 0;
                        foreach($commentry as $key=>$com){ ?>
                            <li data-aos="fade-right" data-aos-duration="500">
                                <p>
                                    <?php echo $com->commentry_text ?>    
                                </p>
                            </li>
                        <?php 
                            $cnt++;
                            if($cnt == 5){
                                $cnt = 0;
                                echo "</ul><ul>";
                            }
                        } ?>
                    </ul>					
                </div>
            </div>
        </div>
    </div>
</section>