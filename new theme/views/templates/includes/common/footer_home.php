<footer class="bg-light blue">
        <!-- Start Footer Top -->
        <div class="footer-top bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-3 logo">
                        <a href="#"><img src="uploads/settings/<?php echo $settings->LOGO_IMAGE; ?>" alt="Logo"></a>
                    </div>
                    <div class="col-md-8 col-sm-9 form text-right">
                        <div class="form-content">
                            <h4>Join with us</h4>
                            <form action="#">
                                <div class="input-group stylish-input-group">
                                    <input type="email" placeholder="Enter your e-mail here" class="form-control" name="email">
                                    <span class="input-group-addon">
                                        <button type="submit">
                                            Subscribe <i class="fa fa-paper-plane"></i>
                                        </button>  
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <div class="container">
            <div class="row">
                <div class="f-items default-padding">
                    <!-- Single Item -->
                    <div class="col-md-4 col-sm-6 equal-height item">
                    <?php  foreach($address as $key=>$addr){ ?>
                <div class="grid-contact" data-aos="fade-left" data-aos-duration="500">
                    <?php echo $addr->address; ?>
                </div>
            <?php } ?>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="col-md-2 col-sm-6 equal-height item">
                       
                    </div>
                    <!-- Single Item -->
                    <!-- End Single Item -->
                    <div class="col-md-2 col-sm-6 equal-height item">
                        
                    </div>
                    <!-- Single Item -->
                    <!-- Single Item -->
                    <div class="col-md-4 col-sm-6 equal-height item">
                        
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
        <!-- Start Footer Bottom -->
        <div class="footer-bottom bg-dark text-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                        
                            <p>&copy; Copyright<span> Brought to you by DEVISEN RISK MANAGEMENT SERVICES</p>
                        </div>
                        <div class="col-md-6 text-right link">
                            <ul>
                                <li>
                                <a href="terms-condition">Terms &amp; Conditions</a> 
                                    <a href="#">Terms of user</a>
                                </li>
                                <li>
                                <a href="privacy-policy"> Privacy Policy</a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>










<script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/equal-height.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.appear.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/modernizr.custom.13711.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/count-to.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/YTPlayer.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.backgroundMove.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootsnav.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
