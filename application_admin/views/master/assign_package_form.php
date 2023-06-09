<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="container">
                <!-- Horizontal Form -->
                <form class="form-horizontals"  method="post" id="user_form" name="user_form" action="<?php echo $this->class_name; ?>/assign_package_save" enctype="multipart/form-data">
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
                                                    <label for="page_title">Customer Name :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="First Name" value="<?php echo  $query->full_name; ?>"   data-validation="required" disabled>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Select Package:</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <select  name="package_id" id="package_id" class="form-control" data-validation="required">
                                                        <option value="">-- Package --</option>
                                                        <?php foreach ($package as $row): ?>
                                                            <option value="<?php echo $row->package_id ?>" <?php echo (!empty($query->package_id) && $query->package_id == $row->package_id) ? 'selected' : '' ?>><?php echo $row->package_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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
