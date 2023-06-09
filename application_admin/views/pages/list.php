<section class="content">
    <form method="post" action="">
        <?php
        $msg = $this->session->flashdata('msg');
        if (!empty($msg['txt'])):
            ?>
            <div class="alert-rk box box-success">
                <div class="alert alert-block alert-<?php echo $msg['type']; ?>" style="padding:5px;">
                    <span class="pull-left"><i class="<?php echo $msg['icon']; ?>"></i></span>
                    <?php echo $msg['txt']; ?>
					<span class="pull-right" style="margin-top:-4px;"><button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" style="color: #fff !important;"></i></button></span>
                </div>
            </div>
        <?php endif ?> 
        <button type="submit" class="btn-medium btn-info" title="Delete" >Delete</button>
        <p class="pull-right"><a href='<?php echo $this->class_name; ?>/add'>Add New Page</a></p>   
        <div class="row">
            <div class="box box-info">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Page Title</th>
                                            <th>Page Type</th>
                                            <th>Page Slug</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno = 1; ?>
                                        <?php if (!empty($query)): ?>
                                            <?php foreach ($query as $row): ?>
                                                <tr>
                                                    <td><?php echo $sno; ?></td>
                                                    <td><?php echo $row->page_title; ?></td>
                                                    <td><?php echo $row->type_name; ?></td>
                                                    <td><?php echo $row->page_slug; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row->last_modified_by == 0) {
                                                            echo $row->created_user;
                                                        } else {
                                                            echo $row->last_modified_user;
                                                        }
                                                        ?>
                                                    <td align="center">
                                                        <?php
                                                        if ($row->last_modified_date == "" || $row->last_modified_date == '0000-00-00 00:00:00') {
                                                            echo $row->created_date;
                                                        } else {
                                                            echo $row->last_modified_date;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td align="center"><?php echo (!empty($row->status_ind)) ? '<i class="fa fa-check-circle text-green" title="Active"></i>' : '<i class="fa  fa-times-circle text-red" title="Deactive"></i>'; ?></td>
                                                    <td align="center">
                                                        <a href='<?php echo $this->class_name; ?>/edit/<?php echo $row->page_id; ?>'><i class="fa fa-pencil" title="Edit" aria-describedby="ui-id-4"></i></a>
                                                        <?php //if ($row->type_id == 20) { ?>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo $this->class_name; ?>/delete/<?php echo $row->page_id; ?>' onclick="return delete_action();" title="Delete"><i class="fa fa-trash" title="Delete" aria-describedby="ui-id-4"></i></a>
                                                        <?php //} ?>
                                                    </td>
                                                </tr>
                                                <?php $sno++; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.box box-info -->
        </div><!-- /.row -->
    </form><!-- /.form -->
</section>
