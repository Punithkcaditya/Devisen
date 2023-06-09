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
        <p class="pull-right"><a href='<?php echo $this->class_name; ?>/package_add'>Add package Master</a></p>   
		</br>
		<br/>
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
                                            <th>S No</th>
                                            <th>Package Name</th>
											<th>Cost</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($query)):
                                            $sno=1;
                                            ?>
                                            <?php foreach ($query as $row): ?>
                                                <tr>
                                                    <td><?php echo $sno; ?></td>
													<td><?php echo $row->package_name; ?></td>
                                                    <td><?php echo $row->package_cost; ?></td>
                                                    <td><?php echo $row->status_in; ?> </td>
													<td align="center">
														<a href='<?php echo $this->class_name; ?>/package_edit/<?php echo $row->package_id; ?>'><i class="fa fa-pencil" title="Edit" aria-describedby="ui-id-4"></i></a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo $this->class_name; ?>/package_delete/<?php echo $row->package_id; ?>' title="Delete"><i class="fa fa-trash" title="Delete" aria-describedby="ui-id-4"></i></a>
														
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
