<!-- Testimonial Area Start -->
<section class="edulab-people-say-area section_100">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="client-say">
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="item_4">
                        <div class="single_item">
                            <div class="people-text">
                                <h4><?php echo $testimonial->testimonial_title; ?></h4>
                                <p><?php echo $testimonial->testimonial_short_desc; ?></p>
                                <h5><span><?php echo $testimonial->employee_name; ?></span></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Area End -->
