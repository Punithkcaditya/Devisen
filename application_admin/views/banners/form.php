<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="container">
                <!-- Horizontal Form -->
                <form class="form-horizontals" method="post" id="banners_form" name="banners_form" action="<?php echo $this->class_name; ?>/save" enctype="multipart/form-data">
                    <input type="hidden" name="banner_id" value="<?php echo (!empty($query->banner_id)) ? $query->banner_id : "" ?>"/>
                    <div class="container">
                        <div class="row centered-form">
                            <div class="col-xs-11 col-sm-11 col-md-11 col-sm-offset-2 col-md-offset-0">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $page_heading; ?> <?php if (!empty($sub_heading)) { ?><small><?php echo $sub_heading; ?></small><?php } ?></h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="banner_title">Banner Title</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="banner_title" id="banner_title" class="form-control" placeholder="Banner Title" value="<?php echo (!empty($query->banner_title)) ? $query->banner_title : '' ?>"   data-validation="required">
                                                </div>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="banner_desc">Banner Description</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <textarea name="banner_desc" rows="4" id="banner_desc" class="form-control" placeholder="Banner description"  data-validation="required"><?php echo (!empty($query->banner_desc)) ? $query->banner_desc : '' ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="button_text">Button Text</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="button_text" id="button_text" class="form-control" placeholder="Button Text" value="<?php echo (!empty($query->button_text)) ? $query->button_text : '' ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="button_url">Button URL</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="button_url" id="button_url" class="form-control" placeholder="Button URL" value="<?php echo (!empty($query->button_url)) ? $query->button_url : '' ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="button_txt_ind">Display Button URL</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="radiobuttons"><input name="button_txt_ind" value="1" type="radio" <?php echo (!empty($query->button_txt_ind)) ? 'checked' : ''; ?> />
                                                        <span class="lbl">Yes</span></label>
                                                    &nbsp; &nbsp; &nbsp;&nbsp;
                                                    <label class="radiobuttons"><input name="button_txt_ind" value="0" type="radio" <?php echo (empty($query->button_txt_ind)) ? 'checked' : ''; ?> />
                                                        <span class="lbl">No</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="link_target">Link Target</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="radiobuttons"><input name="link_target" value="1" type="radio" <?php echo (!empty($query->link_target)) ? 'checked' : ''; ?> />
                                                        <span class="lbl">New Window</span></label>
                                                    &nbsp; &nbsp; &nbsp;&nbsp;
                                                    <label class="radiobuttons"><input name="link_target" value="0" type="radio" <?php echo (empty($query->link_target)) ? 'checked' : ''; ?> />
                                                        <span class="lbl">Same Window</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="banner_path">Banner Image</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <?php echo form_error('banner_path'); ?>
                                                    <input type="file" name="banner_path" id="banner_path"  placeholder="Banner Image" value="<?php echo (!empty($query->banner_path)) ? $query->banner_path : '' ?>" <?php echo (!empty($query->banner_id))? '' : 'data-validation="required"'; ?> >
                                                    <?php if (!empty($query->banner_path) && file_exists('./' . BANNERS_PHOTO_UPLOAD_PATH . $query->banner_path)) { ?><br/>
                                                        <a href="<?php echo BANNERS_PHOTO_UPLOAD_PATH . $query->banner_path; ?>" class="cboxElement" data-rel="colorbox">
                                                            <img src="<?php echo BANNERS_PHOTO_UPLOAD_PATH_THUMB . $query->banner_path; ?>" width="50"></a>
                                                        <input type="hidden" name="banner_path" value="<?php echo (!empty($query->banner_path)) ? $query->banner_path : ''; ?>"/>
                                                    <?php } ?>
                                                    <?php if (!empty($query->banner_path)) { ?>
                                                        <br/>
                                                        <a href="banners/removeimg/<?php echo $query->banner_id; ?>" onclick="return delete_action()">Remove Image</a>
                                                    <?php } ?>
                                                        <p class="image-dimention">Banner Image Size Should be 1350px width and 560px height.</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="alt_title">Alt Title</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="alt_title" id="alt_title" class="form-control" placeholder="Alt Title" value="<?php echo (!empty($query->alt_title)) ? $query->alt_title : '' ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="title_txt_ind">Display Alt Link</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="radiobuttons"><input name="title_txt_ind" value="1" type="radio" <?php echo (!empty($query->title_txt_ind)) ? 'checked' : ''; ?> />
                                                        <span class="lbl">Yes</span></label>
                                                    &nbsp; &nbsp; &nbsp;&nbsp;
                                                    <label class="radiobuttons"><input name="title_txt_ind" value="0" type="radio" <?php echo (empty($query->title_txt_ind)) ? 'checked' : ''; ?> />
                                                        <span class="lbl">No</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
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
