<?php //echo "<pre/>"; print_r($query); die;     ?>
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
                <form class="form-horizontals" method="post" id="user_form" name="user_form" action="<?php echo $this->class_name; ?>/saveaccess" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo (!empty($user_id)) ? $user_id : "" ?>"/>
                    <div class="container">
                        <div class="row centered-form">
                            <div class="col-xs-11 col-sm-11 col-md-11 col-sm-offset-2 col-md-offset-0">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $page_heading; ?> <?php if (!empty($sub_heading)) { ?><small><?php echo $sub_heading; ?></small><?php } ?></h3>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                                        <label> <span class="spandiv">Select all</span><input type="radio" name="multiple" id="multiple" value="all" class="selectall"/></label>
                                        <label> <span class="spandiv">De Select all</span><input type="radio" name="multiple" id="multiple" value="noall" class="selectall"/></label>
                                    </div>
                                    <div class="panel-body">
                                        <div class="control-group languagepanel">
                                            <div class="controls">
                                                <?php $i = 1; ?>
                                                <?php foreach ($query as $row): ?>
                                                    <div class="col-xs-4 col-sm-4 col-md-4 mainmenus-2">
                                                        <ul>
                                                            <li><?php echo $i . ')'; ?> &nbsp;&nbsp;<input class="parents allcheckbox" type="checkbox" name="menuitem_id[]" value="<?php echo $row->menuitem_id; ?>" <?php echo (in_array($row->menuitem_id, $admin_users_accesses)) ? 'checked' : ''; ?> />
                                                                <span class="lbl"></span> <?php echo $row->menuitem_text; ?>
                                                                <ul>
                                                                    <?php if (!empty($row->submenus)): ?>
                                                                        <?php foreach ($row->submenus as $row): ?>
                                                                            <li>
                                                                                <input class="childs allcheckbox" type="checkbox" name="menuitem_id[]" value="<?php echo $row->menuitem_id; ?>" <?php echo (in_array($row->menuitem_id, $admin_users_accesses)) ? 'checked' : ''; ?> />
                                                                                <span class="lbl"></span> <?php echo $row->menuitem_text; ?>
                                                                            </li>
                                                                        <?php endforeach ?>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
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
