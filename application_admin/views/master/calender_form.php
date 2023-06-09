<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="overlay" id="loading_overlay" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="container">
                <!-- Horizontal Form -->
                <form class="form-horizontals" method="post" id="user_form" name="user_form" action="<?php echo $this->class_name; ?>/calender_import" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row centered-form">
                            <div class="col-xs-11 col-sm-11 col-md-11 col-sm-offset-2 col-md-offset-0">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Upload Calender</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Upload Excel File :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <input type="file" name="calender_file" id="calender_file"  placeholder="Calender Excel File" value="">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        

                                        </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right"> Submit </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </form>
				<form class="form-horizontals" method="post" id="user_form" name="user_form" action="<?php echo $this->class_name; ?>/calender_save" enctype="multipart/form-data">
                    <input type="hidden" name="calender_id" value="<?php echo (!empty($query->calender_id)) ? $query->calender_id : "" ?>"/>
                    <div class="container">
                        <div class="row centered-form">
                            <div class="col-xs-11 col-sm-11 col-md-11 col-sm-offset-2 col-md-offset-0">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $page_heading; ?> <?php if (!empty($sub_heading)) { ?><small><?php echo $sub_heading; ?></small><?php } ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Section Type :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <select  name="section_id" id="section_id" class="form-control" data-validation="required">
                                                        <option value="">-- Section Type --</option>
                                                        <option value="1" <?php echo (!empty($query->section_id) && $query->section_id == 1) ? 'selected' : '' ?>>Today</option>
                                                        <option value="2" <?php echo (!empty($query->section_id) && $query->section_id == 2) ? 'selected' : '' ?>>Tomorrow</option>
                                                        <option value="3" <?php echo (!empty($query->section_id) && $query->section_id == 3) ? 'selected' : '' ?>>This Week</option>
                                                        <option value="4" <?php echo (!empty($query->section_id) && $query->section_id == 4) ? 'selected' : '' ?>>Next Week</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Calender Title :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <input type="text" name="calender_title" id="calender_title" class="form-control" placeholder="calender_title" value="<?php echo (!empty($query->calender_title)) ? $query->calender_title : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Is Allday :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <div class="form-group">
                                                    <label class="radiobuttons"><input required name="is_allday" onclick="$('#datesection').hide();" value="1" type="radio" <?php echo (!empty($query->is_allday)) ? 'checked' : ''; ?> />
                                                        <span class="lbl">Yes</span></label>
                                                    &nbsp; &nbsp; &nbsp;&nbsp;
                                                    <label class="radiobuttons"><input required name="is_allday" value="0" onclick="$('#datesection').show();" type="radio" <?php echo (empty($query->is_allday)) ? 'checked' : ''; ?> />
                                                        <span class="lbl">No</span></label>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="datesection">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Calender Date :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <input type="date" name="calender_date" id="calender_date" class="form-control" placeholder="calender_date" value="<?php echo (!empty($query->calender_date)) ? $query->calender_date : '' ?>"   data-validation="required">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Calender Title :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <input type="time" name="calender_time" id="calender_time" class="form-control" placeholder="calender_time" value="<?php echo (!empty($query->calender_time)) ? $query->calender_time : '' ?>"   data-validation="required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Section Type :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <select  name="currency_type" id="currency_type" class="form-control" data-validation="required" required>
                                                        <option value="">-- Section Type --</option>
                                                        <option value="EURINR" <?php echo (!empty($query->currency_type) && $query->currency_type == 'USDINR') ? 'selected' : '' ?>>USDINR</option>
                                                        <option value="EURINR" <?php echo (!empty($query->currency_type) && $query->currency_type == 'EURINR') ? 'selected' : '' ?>>EURINR</option>
                                                        <option value="GBPINR" <?php echo (!empty($query->currency_type) && $query->currency_type == 'GBPINR') ? 'selected' : '' ?>>GBPINR</option>
                                                        <option value="JPYINR" <?php echo (!empty($query->currency_type) && $query->currency_type == 'JPYINR') ? 'selected' : '' ?>>JPYINR</option>
                                                        <option value="EURUSD" <?php echo (!empty($query->currency_type) && $query->currency_type == 'EURUSD') ? 'selected' : '' ?>>EURUSD</option>
                                                        <option value="GBPUSD" <?php echo (!empty($query->currency_type) && $query->currency_type == 'GBPUSD') ? 'selected' : '' ?>>GBPUSD</option>
                                                        <option value="USDJPY" <?php echo (!empty($query->currency_type) && $query->currency_type == 'USDJPY') ? 'selected' : '' ?>>USDJPY</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Actual :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <input type="text" name="actual" id="actual" class="form-control" placeholder="Actual" value="<?php echo (!empty($query->actual)) ? $query->actual : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Forecast :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <input type="text" name="forecast" id="forecast" class="form-control" placeholder="forecast" value="<?php echo (!empty($query->forecast)) ? $query->forecast : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_title">Previous :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <input type="text" name="previous" id="previous" class="form-control" placeholder="Previous" value="<?php echo (!empty($query->previous)) ? $query->previous : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <div class="form-group">
                                                    <label for="page_content">Sort Order :</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                <input type="text" name="sort_order" id="sort_order" class="form-control" placeholder="Sort Order" value="<?php echo (!empty($query->sort_order)) ? $query->sort_order : '' ?>"   data-validation="required" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <a href="<?php echo $this->class_name; ?>/calender_list" class="btn btn-warning">Cancel / Back</a>
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
