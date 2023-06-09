<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="container">
                <!-- Horizontal Form -->
                <form class="form-horizontals" method="post" id="user_form" name="user_form" action="<?php echo $this->class_name; ?>/save" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo (!empty($query->user_id)) ? $query->user_id : "" ?>"/>
                    <div class="container">
                        <div class="row centered-form">
                            <div class="col-xs-11 col-sm-11 col-md-11 col-sm-offset-2 col-md-offset-0">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $page_heading; ?> <?php if (!empty($sub_heading)) { ?><small><?php echo $sub_heading; ?></small><?php } ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="role_id">User Role</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <select  name="role_id" id="role_id" class="form-control" data-validation="required">
                                                        <option value="">-- User Type --</option>
                                                        <?php foreach ($roles as $row): ?>
                                                            <option value="<?php echo $row->role_id ?>" <?php echo (!empty($query->role_id) && $query->role_id == $row->role_id) ? 'selected' : '' ?>><?php echo $row->role_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="email">Email Id</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email Id" value="<?php echo (!empty($query->email)) ? $query->email : '' ?>"  data-validation="email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="username" id="username" class="form-control" placeholder="User Name" value="<?php echo (!empty($query->username)) ? $query->username : '' ?>"
                                                           data-validation="length alphanumeric" data-validation-length="3-12" 
                                                           data-validation-error-msg="value should alphanumeric and without space (3-12 chars)" onblur="return CheckBublicateUsers()">
                                                </div>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" data-validation-length="3-12"  data-validation-error-msg="Password has to be (3-12 chars)"  data-validation="length">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo (!empty($query->first_name)) ? $query->first_name : '' ?>" data-validation="required">
                                                </div>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo (!empty($query->last_name)) ? $query->last_name : '' ?>" data-validation="required">
                                                </div>
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
                                                        <span class="lbl">Publish</span></label>
                                                    &nbsp; &nbsp; &nbsp;&nbsp;
                                                    <label class="radiobuttons"><input name="status_ind" value="0" type="radio" <?php echo (empty($query->status_ind)) ? 'checked' : ''; ?> />
                                                        <span class="lbl">Unpublish</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <a href="<?php echo $this->class_name; ?>" class="btn btn-warning">Cancel / Back</a>
                                        <button type="submit" class="btn btn-info pull-right">Save</button>
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
