<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="container">
                <!-- Horizontal Form -->
                <form class="form-horizontals" method="post" id="user_form" name="user_form" action="<?php echo $this->class_name; ?>/update" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row centered-form">
                            <div class="col-xs-11 col-sm-11 col-md-11 col-sm-offset-2 col-md-offset-0">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $page_heading; ?> <?php if (!empty($sub_heading)) { ?><small><?php echo $sub_heading; ?></small><?php } ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        $msg = $this->session->flashdata('msg');
                                        if (!empty($msg['txt'])):
                                            ?>
                                            <div class="alert alert-block alert-<?php echo $msg['type']; ?>">
                                                <button type="button" class="close" data-dismiss="alert">
                                                    <i class="icon-remove"></i>
                                                </button>
                                                <i class="<?php echo $msg['icon']; ?>"></i>
                                                <?php echo $msg['txt']; ?>
                                            </div>
                                        <?php endif ?>
                                        <?php foreach ($query as $row): ?>
                                            <input type="hidden" name="setting_id[<?php echo $row->setting_id; ?>]" value="<?php echo $row->setting_id; ?>"/>
                                            <div class="row">
                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                    <div class="form-group">
                                                        <label for="<?php echo $row->setting_name; ?>"><?php echo $row->setting_name; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <?php if ($row->type == 'image'): ?>
                                                            <input type="file" name="setting_value_<?php echo $row->setting_id; ?>" id="setting_value_<?php echo $row->setting_id; ?>" class="form-control" placeholder="<?php echo $row->setting_name; ?>">
                                                            <?php if (!empty($row->setting_value) && file_exists('./' . SETTINGS_UPLOAD_PATH . $row->setting_value)): ?>
                                                                <a class="cboxElement" data-rel="colorbox" href="<?php echo SETTINGS_UPLOAD_PATH . $row->setting_value; ?>">
                                                                    <img src="<?php echo SETTINGS_UPLOAD_PATH . $row->setting_value; ?>" width="80"/>
                                                                </a>
                                                                <input name="setting_value[<?php echo $row->setting_id; ?>]" type="hidden" value="<?php echo $row->setting_value; ?>" />
															<?php endif; ?>
														 <?php elseif ($row->type == 'videoimage'): ?>
                                                            <input type="file" name="setting_value_<?php echo $row->setting_id; ?>" id="setting_value_<?php echo $row->setting_id; ?>" class="form-control" placeholder="<?php echo $row->setting_name; ?>">
                                                            <?php if (!empty($row->setting_value) && file_exists('./' . SETTINGS_UPLOAD_PATH_VIDEO_IMAGE . $row->setting_value)): ?>
                                                                <a class="cboxElement" data-rel="colorbox" href="<?php echo SETTINGS_UPLOAD_PATH_VIDEO_IMAGE . $row->setting_value; ?>">
                                                                    <img src="<?php echo SETTINGS_UPLOAD_PATH_VIDEO_IMAGE . $row->setting_value; ?>" width="80"/>
                                                                </a>
                                                                <input name="setting_value[<?php echo $row->setting_id; ?>]" type="hidden" value="<?php echo $row->setting_value; ?>" />
															<?php endif; ?>
                                                        <?php elseif ($row->type == 'textarea'): ?>
                                                            <textarea  name="setting_value[<?php echo $row->setting_id; ?>]" placeholder="<?php echo $row->setting_name; ?>" class="form-control"><?php echo $row->setting_value; ?></textarea>
                                                        <?php elseif ($row->type == 'radiobutton'): ?>
                                                            <input name="setting_value[<?php echo $row->setting_id; ?>]" value="1" type="radio" <?php echo (!empty($row->setting_value) && $row->setting_value == 1) ? 'checked' : ''; ?> />
                                                            <span class="lbl">Yes</span>
                                                            &nbsp; &nbsp; &nbsp;&nbsp;
                                                            <input name="setting_value[<?php echo $row->setting_id; ?>]" value="2" type="radio" <?php echo (!empty($row->setting_value) && $row->setting_value == 2) ? 'checked' : ''; ?> />
                                                            <span class="lbl">No</span>
                                                         <?php else: ?>
                                                        <input class="form-control" name="setting_value[<?php echo $row->setting_id; ?>]" type="text" placeholder="<?php echo $row->setting_name; ?>" value="<?php echo $row->setting_value; ?>" />
                                                    <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="box-footer">
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
