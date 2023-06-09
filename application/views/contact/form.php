<!-- About start -->
<section class="donation-section">
    <div class="container">
        <div class="row"  style="padding-top: 10px;margin-right:0px;">
			<div class="col col-lg-6 col-sm-12 single-content">
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
			<div class="col-lg-6 col-sm-12 col-xs-12" style="background-color:#c2e9d4;">
				<form class="form-horizontal donation-border" method="post" action="contact-us" id="contact_form" name="contact_form" enctype="multipart/form-data" style="float: initial;">
					<br/>
					<?php
					$msg = $this->session->flashdata('msg');
						if (!empty($msg['txt'])):
						?>
						<div class="col-lg-12 alert-rk box-success" id="contact-success">
							<div class="alert alert-block alert-<?php echo $msg['type']; ?>" style="padding:5px;">
								<span class="pull-left"><i class="<?php echo $msg['icon']; ?>"></i></span>
								<?php echo $msg['txt']; ?>
							</div>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-2 control-label" for="full_name"></label>
						<div class="col-md-8">
							<input id="name" name="name" type="text" placeholder="Full Name *"  class="form-control input-md" style="padding: 0px 12px;margin-top: 6px !important;">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" for="email"></label>
						<div class="col-md-8">
							<input id="email" name="email" type="text" placeholder="Email Address *"  class="form-control input-md" style="padding: 0px 12px;margin-top: 6px !important;">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" for="Mobile No"></label> 
						<div class="col-md-8">
							<input id="phone" name="phone" type="text" placeholder="Mobile no. *" class="form-control input-md" style="padding: 0px 12px;margin-top: 6px !important;">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" for="Subject"></label> 
						<div class="col-md-8">
							<input id="description" name="description" type="text" placeholder="Subject *" class="form-control input-md" style="padding: 0px 12px;margin-top: 6px !important;">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" for="Message"></label>  
						<div class="col-md-8">
							<textarea rows="3" id="message"  class="form-control" name="message" placeholder="Message *" style="padding: 5px 12px;height: 80px !important;margin-top: 6px !important;"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-5 control-label" for="full_name"></label>  
						<div class="col-md-3" style="margin-top: 10px;">
							<button type="submit" class="btn btn-info"> Send message </button>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</section>
<!-- About End -->