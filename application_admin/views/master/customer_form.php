<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="container">
                <!-- Horizontal Form -->
                <form class="form-horizontals"  method="post" id="user_form" name="user_form" action="<?php echo $this->class_name; ?>/customer_save" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo (!empty($query->users_id)) ? $query->users_id : "" ?>"/>
                    <div class="container">
                        <div class="row centered-form">
                            <div class="col-xs-11 col-sm-11 col-md-11 col-sm-offset-2 col-md-offset-0">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $page_heading; ?> <?php if (!empty($sub_heading)) { ?><small><?php echo $sub_heading; ?></small><?php } ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">First Name :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full Name" value="<?php echo (!empty($query->full_name)) ? $query->full_name : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Company Name :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" value="<?php echo (!empty($query->company_name)) ? $query->company_name : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Email :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="email" id="email" class="form-control" placeholder="email" value="<?php echo (!empty($query->email)) ? $query->email : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Industry Name :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="industry_name" id="industry_name" class="form-control" placeholder="Email" value="<?php echo (!empty($query->industry_name)) ? $query->industry_name : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Mobile :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="phone_number" value="<?php echo (!empty($query->phone_number)) ? $query->phone_number : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Name Of Exposure :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="name_of_exposure" id="name_of_exposure" class="form-control" placeholder="name_of_exposure" value="<?php echo (!empty($query->name_of_exposure)) ? $query->name_of_exposure : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Turnover :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="turnover" id="turnover" class="form-control" placeholder="turnover" value="<?php echo (!empty($query->turnover)) ? $query->turnover : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-2 col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label for="status_ind">Status</label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <div class="form-group">
                                                        <label class="radiobuttons"><input name="status_ind" value="1" type="radio" <?php echo (!empty($query->status_ind)) ? 'checked' : ''; ?> />
                                                            <span class="lbl">Activate</span></label>
                                                        &nbsp; &nbsp; &nbsp;&nbsp;
                                                        <label class="radiobuttons"><input name="status_ind" value="0" type="radio" <?php echo (empty($query->status_ind)) ? 'checked' : ''; ?> />
                                                            <span class="lbl">Deactivate</span></label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        
                                    </div>
                                    <div class="box-footer">
                                        <a href="<?php echo $this->class_name; ?>/customer" class="btn btn-warning">Cancel / Back</a>
                                        <button type="submit" class="btn btn-info pull-right"> Submit </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
