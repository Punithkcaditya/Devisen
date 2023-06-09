<section class="content">
    <form method="post" action="">
        <?php  $msg = $this->session->flashdata('msg');
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
        <p class="pull-right"><a href='<?php echo $this->class_name; ?>/add'>Add New Widget</a></p>   
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
                                            <th>Templates</th>
                                            <th>Widget Area</th>
                                            <th>Widget Type</th>
                                            <th>Widget Tittle</th>
                                            <th>Modified Date</th>
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
                                                    <td><?php echo $row->template_name; ?></td>
                                                    <td><?php echo $row->area_name; ?></td>
                                                    <td><?php echo (!empty($row->type_name)) ? $row->type_name : 'Static Content'; ?></td>
                                                    <td><?php echo $row->widget_title ?></td>
                                                    <td><?php echo $row->created_date ?></td>
                                                    <td align="center"><?php echo (!empty($row->status_ind)) ? '<i class="fa fa-check-circle text-green" title="Active"></i>' : '<i class="fa  fa-times-circle text-red" title="Deactive"></i>'; ?></td>
                                                    <td align="center">
                                                        <a href='<?php echo $this->class_name; ?>/edit/<?php echo $row->widget_id; ?>'><i class="fa fa-pencil" title="Edit" aria-describedby="ui-id-4"></i></a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo $this->class_name; ?>/delete/<?php echo $row->widget_id; ?>' title="Delete"><i class="fa fa-trash" title="Delete" aria-describedby="ui-id-4"></i></a>
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
