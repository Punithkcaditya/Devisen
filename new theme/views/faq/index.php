<!--Featured Section-->
    <section class="bg-color-black pt-110 pb-60">
        <div class="auto-container">            
            <div class="row clearfix home-content">              
                <div class="col-md-12">
                    <div class="catageory-list">
                        <ul class="accordion-box style-two">
                        
                        <?php foreach($faqs as $key=>$faq):?>
                        <!--Block-->
                        <li class="block catageory-item">
                           <a href="faq/<?php echo $faq->faq_category_id;?>">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa icon-minus flaticon-minus-sign2"></span> <span class="icon icon-plus flaticon-plussign22"></span></div><i class="fa fa-folder-open-o" aria-hidden="true"></i> <?php echo $faq->category_name;?></div>
                           </a>
                        </li>
                        <?php endforeach;?> 
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>