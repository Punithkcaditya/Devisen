<section id="quote-section">
		<div class="grid-row">
			<div class="grid-col-row clear testimonials" data-aos="fade-in" data-aos-duration="1000">
				<img src="assets/images/quote-icon.png" class="quote-icon" data-aos="zoom-in" data-aos-duration="500">
				<div class="grid-col grid-col-6 col-sd-12">
					<div id="client-carousel" class="owl-carousel" >
					<?php 
                        $cnt = 0;
                        foreach($quotes as $key=>$com){ ?>
						<div>
							<div class="testimonial-separator"></div>
							<p class="testimonial-text">
							<?php echo $com->quotes_text; ?>
							</p>
							<p class="testimonial-author"><?php echo $com->author; ?></p>
						</div>
						<?php  }  ?>
					</div>
				</div>
			</div>
		</div>
	</section>