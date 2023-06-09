<!-- About  Start -->
<section class="donation-section">
    <div class="container">
        <div class="row"  style="padding-top: 10px;margin-right:0px;">
            <div class="col col-md-12 col-sm-12 single-content">
                <div class="post">
                    <?php if ($page_items->display_image == '1'): ?>
                        <div class="media">
                            <img  alt="<?php echo $page_items->alt_title; ?>" title="<?php echo $page_items->alt_title; ?>" src="myadmin/uploads/pages/<?php echo $page_items->page_path; ?>" class="img img-responsive">
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="donation-form-outers"  style="background-color:#ccc;">
                <div class="box box-info">
                    <!--<div class="overlay" id="loading_overlay" style="display:none;">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>-->
                    <div class="container">
                        <?php
                        $msg = $this->session->flashdata('msg');
                        if (!empty($msg['txt'])):
                            ?>
                            <div class="alert-rk box box-success">
                                <div class="alert alert-block alert-<?php echo $msg['type']; ?>" style="padding:5px;">
                                    <span class="pull-left"><i class="<?php echo $msg['icon']; ?>"></i></span>
                                    <?php echo $msg['txt']; ?>
                                    <span class="pull-right" style="margin-top:-4px;"><button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Horizontal Form -->
                        <form class="user-options cf" method="post" id="contact_form" name="contact_form" action="contact-us" enctype="multipart/form-data">
                            <div class="container">
                                <div class="row centered-form">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-sm-offset-2 col-md-offset-0">
                                        <div class="col-sm-6">
                                            <h2 class="newsletter" style="margin-top:10px;">Get In Touch</h2>
                                            <div class="half left cf">
                                                <input type="text" id="name" name="name" placeholder="Name">
                                                <input type="text" id="email" name="email" placeholder="Email address">
                                                <input type="text" id="description" name="description" placeholder="Subject">
                                            </div>
                                            <div class="half right cf">
                                                <textarea style="height:105px !important" name="message" type="text" id="message" name="message" placeholder="Message"></textarea>
                                            </div>  
                                            <input type="submit" value="Submit" id="input-submit">
                                        </div>
                                        <div class="col-sm-6">
                                            <p><?php echo $page_items->page_content; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About End -->