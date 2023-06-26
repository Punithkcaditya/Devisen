<!--Featured Section-->
    <section class="bg-color-black pt-90 pb-60">
        <div class="auto-container">  
            <div class="row clearfix home-content">              
                <h3 class="bold question"><i class="fa fa-comments-o" aria-hidden="true"> </i> <?php echo $faq_category->category_name;?></h3>
                <!--Accordion Column-->
                <article class="col-md-12 column">

                    <div class="question-list">
                        <!--Accordion Box-->
                        <ul class="accordion-box style-two">
                            
                            <?php foreach($faqs as $key=>$faq):?>
                            <!--Block-->
                            <li class="block question-item">
                                <div class="acc-btn">
                                    <div class="icon-outer">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    </div> 
                                    <?php echo $faq->faq_question;?>
                                </div>
                                <div class="acc-content answer">
                                    <div class="content answer-item">
                                        <?php echo $faq->faq_answer;?>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach;?> 
                            
                        </ul>
                    </div>
                    
                </article>
            
            </div>
            
        </div>
    </section>
