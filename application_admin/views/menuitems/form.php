<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="container">
                <!-- Horizontal Form -->
                <form class="form-horizontals" method="post" id="menu_form" name="menu_form" action="<?php echo $this->class_name; ?>/save" enctype="multipart/form-data">
                    <input type="hidden" name="menuitem_id" value="<?php echo (!empty($query->menuitem_id)) ? $query->menuitem_id : "" ?>"/>
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
                                                    <label for="event_title">Menu</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" name="menu_id" id="menu_id" >
                                                        <option value="">Select Menu</option>
                                                        <?php foreach ($menu as $row): ?>
                                                            <option value="<?php echo $row->menu_id; ?>" <?php echo (!empty($query->menu_id) && $row->menu_id == $query->menu_id) ? 'selected' : ''; ?>><?php echo $row->menu_name; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row main_menuitem">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="photo_path">Menuitem Text</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <?php echo form_error('menuitem_id'); ?>
                                                    <select class="form-control" name="parent_menuitem_id" id="parent_menuitem_id" choosen="<?php echo (!empty($query->parent_menuitem_id)) ? $query->parent_menuitem_id : ''; ?>" >
                                                        <option value="">Select Menuitem</option>
                                                        <?php foreach ($main_menu as $row): ?>
                                                            <option value="<?php echo $row->menuitem_id; ?>" <?php echo (!empty($query->parent_menuitem_id) && $row->menuitem_id == $query->parent_menuitem_id) ? 'selected' : ''; ?>> <?php echo strtoupper($row->menuitem_text); ?> </option>
                                                            <?php foreach ($row->submenu as $row2): ?>
                                                                <option value="<?php echo $row2->menuitem_id; ?>" <?php echo (!empty($query->parent_menuitem_id) && $row->menuitem_id == $query->parent_menuitem_id) ? 'selected' : ''; ?>>&nbsp;&nbsp; &raquo; <?php echo strtolower($row2->menuitem_text); ?></option>
                                                            <?php endforeach ?>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="photo_path">Menuitem Text</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="menuitem_text" id="menuitem_text" type="text" placeholder="Menuitem Text" value="<?php echo (!empty($query->menuitem_text)) ? $query->menuitem_text : ''; ?>"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="display_images">Menuitem Link</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="menuitem_link" id="menuitem_link" type="text" placeholder="Menuitem Link" value="<?php echo (!empty($query->menuitem_link)) ? $query->menuitem_link : ''; ?>"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="alt_title">Link Target</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input name="menuitem_target"  value="_blank" type="radio"  <?php
                                                    if (!empty($query->menuitem_target) && $query->menuitem_target == '_blank') {
                                                        echo 'checked';
                                                    }
                                                    ?>/>
                                                    <span class="lbl">New Window</span>
                                                    <input name="menuitem_target" value="_self" type="radio" <?php
                                                    if (empty($query->menuitem_target) || (!empty($query->menuitem_target) && $query->menuitem_target == '_self')) {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    <span class="lbl">Same Window</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="alt_title">Display Order</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="display_order"  id="display_order" type="text" placeholder="Display Order" value="<?php echo (!empty($query->display_order)) ? $query->display_order : ''; ?>"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="event_short_desc">Status</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input name="status_ind"  value="1" type="radio"  <?php echo (!empty($query->status_ind)) ? 'checked' : ''; ?>/>
                                                    <span class="lbl">Publish</span>
                                                    &nbsp; &nbsp; &nbsp;&nbsp;
                                                    <input name="status_ind" value="0" type="radio" <?php echo (empty($query->status_ind)) ? 'checked' : ''; ?> />
                                                    <span class="lbl">Unpublish</span>
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
