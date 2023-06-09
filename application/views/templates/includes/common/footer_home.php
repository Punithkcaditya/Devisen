<section id="contact" class="contact">
    <div class="subscribe" data-aos="fade-left" data-aos-duration="500">
        <div class="grid-row clear">
            <div class="subscribe-header">subscribe <br><small>For Exclusive support on your FX Exposures</small></div>
            <form action="#" class="clear">
                <input type="tel" placeholder="Your Email Mobile Number">
                <input type="email" placeholder="Your Email Address">
                <button type="submit"  class="frame-btn">
                    <span class="frame-btn__outline frame-btn__outline--tall">
                        <span class="frame-btn__line frame-btn__line--tall"></span>
                        <span class="frame-btn__line frame-btn__line--flat"></span>
                    </span>
                    <span class="frame-btn__outline frame-btn__outline--flat">
                        <span class="frame-btn__line frame-btn__line--tall"></span>
                        <span class="frame-btn__line frame-btn__line--flat"></span>
                    </span>
                    <span class="frame-btn__solid"></span>
                    <span class="frame-btn__text"> Send</span>
                </button>
            </form>
        </div>
    </div>	
     <div >

        </div>
    <div class="footer-top">
        <div class="contact-head">
            <div class="grid-row">
                <div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
                    Get in touch with us
                    <span></span>
                </div><br /><br /><br />
                <a href="index.html" class="footer-logo"><img src="uploads/settings/<?php echo $settings->LOGO_IMAGE; ?>" alt=""></a><br /><br />
            </div>
        </div>
        <div class="grid-row clear">
       
            <?php  foreach($address as $key=>$addr){ ?>
                <div class="grid-contact" data-aos="fade-left" data-aos-duration="500">
                    <?php echo $addr->address; ?>
                </div>
            <?php } ?>
            <div class="grid-contact" style="float: right;">
              
            </div>
        </div>
    </div>
</section>
<!--/ page content -->
<!-- page footer -->
<footer id="footer">
    <div class="grid-row clear">
        <div class="footer">
            <div id="copyright">Copyright<span> Brought to you by DEVISEN RISK MANAGEMENT SERVICES</span> 2023-All Rights Reserved 
                <div>
                    <a href="terms-condition">Terms &amp; Conditions</a> |<a href="privacy-policy"> Privacy Policy</a>
                </div> 
            </div>
            <div class="designedBy">
                <span>Developer & Developed By</span>
                <a href="https://superiorcodelabs.com/" target="_blank" class=""><img src="https://superiorcodelabs.com/assets/images/superior_codelabs_logo.png" alt=""></a>
            </div>
        </div>
    </div>
</footer>
    <!--/ page footer -->
    <a href="#" id="scroll-top" class="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="assets/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="assets/rs-plugin/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="assets/rs-plugin/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="assets/rs-plugin/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="assets/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="assets/rs-plugin/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="assets/rs-plugin/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="assets/rs-plugin/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="assets/rs-plugin/js/extensions/revolution.extension.parallax.min.js"></script>	
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="https://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery.easing.1.3.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/jquery.isotope.min.js"></script>
<script src="assets/js/jquery.owl.carousel.js"></script>
<script src="assets/js/jquery.fancybox.pack.js"></script>
<script src="assets/js/jquery.fancybox-media.js"></script>
<script src="assets/js/aos.js"></script>
<script>
    AOS.init({
        easing: 'ease-in-out-back'
    });
</script>