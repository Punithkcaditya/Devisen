<!-- About  Start -->
<section class="donation-section">
    <div class="container">
        <div class="row"  style="padding-top: 10px;margin-right:0px;">
			<div class="col col-lg-5 col-sm-12 single-content">
                <div class="post">
                    <?php if ($page_items->display_image == '1'): ?>
                        <div class="media">
                            <img  alt="<?php echo $page_items->alt_title; ?>" title="<?php echo $page_items->alt_title; ?>" src="myadmin/uploads/pages/<?php echo $page_items->page_path; ?>" class="img img-responsive">
                        </div>
                    <?php endif ?>
                    <div class="post-body">
                        <div class="content-area"><?php echo $page_items->page_content; ?></div>
                    </div>
                </div>
            </div>
			<div class="col-lg-7 col-sm-12 col-xs-12">
				<div class="donation-form-outers" style="background-color:#c2e9d4;">
					<div class="box box-info">
						<div class="container">
							<?php
							$msg = $this->session->flashdata('msg');
							if (!empty($msg['txt'])):
								?>
								<div class="col-lg-6 alert-rk box box-success" id="contact-success">
									<div class="alert alert-block alert-<?php echo $msg['type']; ?>" style="padding:5px;">
										<span class="pull-left"><i class="<?php echo $msg['icon']; ?>"></i></span>
										<?php echo $msg['txt']; ?>
										<!--<span class="pull-right" style="margin-top:-4px;"><button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button></span>-->
									</div>
								</div>
							<?php endif; ?>
							<!-- Horizontal Form -->
							<form class="user-options" method="post" id="contact_form" name="contact_form" action="contact-us" enctype="multipart/form-data">
								<div class="container">
									<div class="row centered-form">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<div class="panel-body">
												<div class="row">
													<div class="form-group">
														<label class="col-md-2 control-label" for="full_name">Full Name</label>  
														<div class="col-md-4">
															<input id="name" name="name" type="text" placeholder="Full Name*" class="form-control input-md" style="padding: 20px 12px;margin-top: 6px !important;">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<label class="col-md-2 control-label" for="full_name">Email</label>  
														<div class="col-md-4">
															<input id="email" name="email" type="text" placeholder="Email Address*" class="form-control input-md" style="padding: 20px 12px;margin-top: 6px !important;">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<label class="col-md-2 control-label" for="full_name">Mobile No.</label>  
														<div class="col-md-4">
															<input id="phone" name="phone" type="text" placeholder="Mobile no.*" class="form-control input-md" style="padding: 20px 12px;margin-top: 6px !important;">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<label class="col-md-2 control-label" for="full_name">Subject</label>  
														<div class="col-md-4">
															<input id="description" name="description" type="text" placeholder="Subject*" class="form-control input-md" style="padding: 20px 12px;margin-top: 6px !important;">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<label class="col-md-2 control-label" for="full_name">Message</label>  
														<div class="col-md-4">
															<textarea rows="4" id="message" name="message" class="form-control" placeholder="Message*" style="padding: 20px 12px;height: 80px !important;margin-top: 6px !important;"></textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-7 box-footer" style="text-align:center;margin-top: 25px;">
														<button type="submit" class="btn btn-info"> Submit </button>
													</div>
												</div>
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
    </div>
</section>
<!-- About End -->
<?php /*
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
*/ ?>
<!-- About End -->