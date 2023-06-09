<?php //echo "<pre/>"; print_r($query); die;                    ?>
<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
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
            <div class="container">
                <!-- Horizontal Form -->
                <form class="form-horizontals" method="post" id="user_form" name="user_form" action="<?php echo $this->class_name; ?>/savepermission" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo (!empty($user_id)) ? $user_id : "" ?>"/>
                    <div class="container">
                        <div class="row centered-form">
                            <div class="col-xs-11 col-sm-11 col-md-11 col-sm-offset-2 col-md-offset-0">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $page_heading; ?> <?php if (!empty($sub_heading)) { ?><small><?php echo $sub_heading; ?></small><?php } ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-xs-12 col-sm-12 col-md-12 to-content">
                                            <div class="col-xs-6 col-sm-6 col-md-6" style="padding-left: 0px;">
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    Permission Access
                                                </div>
                                                <div class="col-xs-2 col-sm-2 col-md-2">Add</div>
                                                <div class="col-xs-2 col-sm-2 col-md-2">Edit</div>
                                                <div class="col-xs-2 col-sm-2 col-md-2">Delete</div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6" style="padding-left: 0px;">
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    Permission Access
                                                </div>
                                                <div class="col-xs-2 col-sm-2 col-md-2">Add</div>
                                                <div class="col-xs-2 col-sm-2 col-md-2">Edit</div>
                                                <div class="col-xs-2 col-sm-2 col-md-2">Delete</div>
                                            </div>
                                        </div>
                                        <hr class="hr-content">
                                        <div class="control-group languagepanel">
                                            <div class="controls">
                                                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                                                    <label> <span class="spandiv">Only Add</span><input type="radio" name="multiple" value="add" class="selectall"/></label>
                                                    <label> <span class="spandiv">Only Edit</span><input type="radio" name="multiple"  value="edit" class="selectall"/></label>
                                                    <label> <span class="spandiv">Only Delete</span><input type="radio" name="multiple"  value="delete" class="selectall"/></label>
                                                    <label> <span class="spandiv">Select all</span><input type="radio" name="multiple"  value="all" class="selectall"/></label>
                                                    <label> <span class="spandiv">No Select all</span><input type="radio" name="multiple"  value="noall" class="selectall"/></label>
                                                </div>
                                                <?php $i = 0; ?>
                                                <?php foreach ($query as $row): ?>
                                                    <?php if (empty($row->parent_menuitem_id)): ?>
                                                        <div class="col-xs-12 col-sm-12 col-md-12 mainmenus">
                                                        <?php endif; ?>
                                                        <div class="col-xs-6 col-sm-6 col-md-6 submenus">

                                                            <div class="col-xs-6 col-sm-6 col-md-6 <?php echo (!empty($row->parent_menuitem_id) ? 'padding-left' : 'main-heading') ?>">
                                                                <p style="margin: 0 0 2px;"><span class="lbl"></span> <?php echo $row->menuitem_text; ?></p>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                                <input class="childs" type="hidden" name="menuitem_id[]" value="<?php echo $row->menuitem_id; ?>"/>
                                                                <input class="childs allcheckbox add_permission" type="checkbox" name="add_permission[<?php echo $i; ?>]" value="1" <?php echo (!empty($row->add_permission)) ? 'checked' : ''; ?>/>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                                <input class="childs allcheckbox edit_permission" type="checkbox" name="edit_permission[<?php echo $i; ?>]" value="1" <?php echo (!empty($row->edit_permission)) ? 'checked' : ''; ?>/>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                                <input class="childs  allcheckbox delete_permission" type="checkbox" name="delete_permission[<?php echo $i; ?>]" value="1" <?php echo (!empty($row->delete_permission)) ? 'checked' : ''; ?>/>
                                                            </div>
                                                        </div>
                                                        <?php if (empty($row->parent_menuitem_id)): ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php $i++; ?>
                                                <?php endforeach ?>
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
