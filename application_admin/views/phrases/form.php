<section class="content">
	<div class="row">
		<div class="box box-info">
			<div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
			<div class="container">
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
				<form class="form-horizontal" action="phrases/update" method="post" enctype="multipart/form-data" name="changeController" id="changeController">
					<div class="container">
						<div class="row centered-form">
							<div class="col-xs-11 col-sm-11 col-md-11 col-sm-offset-2 col-md-offset-0">
                                <div class="panel panel-default">
									<div class="panel-heading">
										 <h1 class="panel-title"><?php echo $page_heading; ?></h1>
									</div>
									<div class="panel-body">
									
										<div class="row">
											<div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
													<label class="control-label" for="form-field-1">Choose Section</label>
												</div>
                                            </div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
												   <select class="form-control" id="controller_name" name="controller_name">
														<?php foreach ($controllers as $controller): ?>
															<option value="phrases/<?php echo $controller->controller_name; ?>" <?php echo (!empty($controller_name) && $controller->controller_name == $controller_name) ? 'selected' : ''; ?>><?php echo $controller->controller_name; ?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
										</div>
										<?php foreach ($query as $row): ?>
										<div class="row">
											<div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
													<label class="control-label" for="form-field-1"><?php echo $row->phrase_name; ?></label>
												</div>
                                            </div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
												   <input type="hidden" class="form-control" name="phrase_id[<?php echo $row->phrase_id; ?>]" value="<?php echo $row->phrase_id; ?>"/>
												   <?php if ($row->type == 'textarea'): ?>
														<textarea class="span11" name="phrase_value[<?php echo $row->phrase_id; ?>]" class="form-control" placeholder="<?php echo $row->phrase_name; ?>"><?php echo $row->phrase_name; ?></textarea>
													<?php else: ?>
														<input name="phrase_value[<?php echo $row->phrase_id; ?>]" type="text" class="form-control" placeholder="<?php echo $row->phrase_name; ?>" value="<?php echo $row->phrase_value; ?>" />
													<?php endif ?>
												</div>
											</div>
										</div>
										<?php endforeach ?>
										 <div class="box-footer">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i>
												Save Changes
											</button>
											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn btn-info pull-right"><i class="icon-remove bigger-110"></i> Reset </button>
										</div>
									</div><!-- /.panel-body -->
								</div><!-- /.panel -->
							</div><!-- /.col -->
						</div><!-- /.row centered-form -->
					</div><!-- /.container -->
				</form>
			</div><!-- /.container -->
		</div><!-- /.box box-info -->
	</div><!-- /.row -->
</section>