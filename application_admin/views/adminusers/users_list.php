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
            </div>
        </div>
    <?php endif ?> 
    <button type="submit" class="btn-medium btn-info" title="Delete" >Delete</button>
    <p class="pull-right"><a href='<?php echo $this->class_name; ?>/add'>Add New User</a></p>   
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
											<th>User Type</th>
											<th>User Name</th>
											<th>Full Name</th>
											<th>Email id</th>
											<th>Created Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($query)): ?>
											<?php foreach ($query as $row): ?>
												<tr>
													<td><?php echo $row->role_name ?></td>
													<td><?php echo $row->username ?></td>
													<td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
													<td><?php echo $row->email ?></td>
													<td><?php echo $row->created_date ?></td>
													<td align="center"><?php echo (!empty($row->status_ind)) ? '<i class="fa fa-check-circle text-green" title="Active"></i>' : '<i class="fa  fa-times-circle text-red" title="Deactive"></i>'; ?></td>
													<td align="center">
														<a href='<?php echo $this->class_name; ?>/edit/<?php echo $row->user_id; ?>'><i class="fa fa-pencil" title="Edit" aria-describedby="ui-id-4"></i></a>
														<?php /* ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo $this->class_name; ?>/delete/<?php echo $row->user_id; ?>' title="Delete"><i class="fa fa-trash" title="Delete" aria-describedby="ui-id-4"></i></a><?php */ ?>
														&nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo $this->class_name; ?>/access/<?php echo $row->user_id; ?>'><i class="fa fa-eye" title="Menu Access" aria-describedby="ui-id-4"></i></a>
														&nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo $this->class_name; ?>/permission/<?php echo $row->user_id; ?>'><i class="fa fa-cog" title="Permission Access" aria-describedby="ui-id-4"></i></a>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
									</tbody>
								</table>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!-- /.col -->
				</div>
			</div>
        </div><!-- /.row -->
    </form>
</section>
