<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="container">
                <!-- Horizontal Form -->
                <form class="form-horizontals"  method="post" id="user_form" name="user_form" action="<?php echo $this->class_name; ?>/reportsave" enctype="multipart/form-data">
                    <input type="hidden" name="report_id" value="<?php echo (!empty($query->report_id)) ? $query->report_id : "" ?>"/>
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
                                                    <label for="page_title">Report Title :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="report_name" id="report_name" class="form-control" placeholder="Report Name" value="<?php echo $query->report_name; ?>"   data-validation="required" >
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Select Category:</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <select  name="report_category_id" id="report_category_id" class="form-control" data-validation="required">
                                                        <option value="">-- Select Category --</option>
                                                        <?php foreach ($category as $row): ?>
                                                            <option value="<?php echo $row->report_category_id ?>" <?php echo (!empty($query->report_category_id) && $query->report_category_id == $row->report_category_id) ? 'selected' : '' ?>><?php echo $row->category_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Report Description :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <textarea  name="report_desc" id="report_desc" rows="5" class="form-control " placeholder="Report Description" data-validation="required"><?php echo (!empty($query->report_desc)) ? $query->report_desc : '' ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Upload PDF :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                    <input type="file" name="report_pdf" id="report_pdf"  placeholder="Report PDF" value="<?php echo (!empty($query->report_pdf)) ? $query->report_pdf : '' ?>">
													<?php if (!empty($query->report_pdf) && file_exists(REPORT_UPLOAD_PATH . $query->report_pdf)) { ?>
                                                        <a href="<?php echo REPORT_UPLOAD_PATH . $query->report_pdf; ?>" class="cboxElement" data-rel="colorbox">
                                                            <img src="<?php echo REPORT_UPLOAD_PATH_THUMB . $query->report_pdf; ?>" width="50"></a>
                                                        <input type="hidden" name="report_pdf" value="<?php echo (!empty($query->report_pdf)) ? $query->report_pdf : ''; ?>"/>
                                                    <?php } ?>
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
                                        <a href="<?php echo $this->class_name; ?>/customer_list" class="btn btn-warning">Cancel / Back</a>
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
