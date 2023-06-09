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
        <p class="pull-right"><a href='<?php echo $this->class_name; ?>/add'>Add New Menu</a></p>   
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
                                            <th>Menu</th>
                                            <th>MenuItem Text</th>
                                            <th>Menu Link</th>
                                            <th>Display Order</th>
                                            <th width="120">Modified Date</th>
                                            <th class="center">Status</th>
                                            <th class="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno = 1; ?>
                                        <?php if (!empty($query)): ?>
                                            <?php foreach ($query as $row): ?>
                                                <tr>
                                                    <td><?php echo $sno; ?></td>
                                                    <td><?php echo $row->menu_name; ?></td>
                                                    <td><?php echo substr(strip_tags($row->menuitem_text), 0, 40); ?></td>
                                                    <td><?php echo substr(strip_tags($row->menuitem_link), 0, 40); ?></td>
                                                    <td><?php echo $row->display_order; ?></td>
                                                    <td><?php
                                                        if ($row->last_modified_date == "") {
                                                            echo $row->created_date;
                                                        } else {
                                                            echo $row->last_modified_date;
                                                        }
                                                        ?></td>
                                                    
                                                    <td align="center"><?php echo (!empty($row->status_ind)) ? '<i class="fa fa-check-circle text-green" title="Active"></i>' : '<i class="fa  fa-times-circle text-red" title="Deactive"></i>'; ?></td>
                                                    <td align="center">
                                                        <a href='<?php echo $this->class_name; ?>/edit/<?php echo $row->menuitem_id; ?>'><i class="fa fa-pencil" title="Edit" aria-describedby="ui-id-4"></i></a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo $this->class_name; ?>/delete/<?php echo $row->menuitem_id; ?>' onclick="return delete_action();" title="Delete"><i class="fa fa-trash" title="Delete" aria-describedby="ui-id-4"></i></a>
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
                </div>
            </div>
        </div>
    </form><!-- /.row -->
</section>
