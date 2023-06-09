<!--login/register page-->
<section class="lr-section">
        <div class="container">
            <div class="row justify-content-lg-center">
                
                <div class="col-lg-8">
                    <?php
                    $msg = $this->session->flashdata('msg');
                    if (!empty($msg['txt'])):
                    ?>
                    <div class="alert alert-<?php echo $msg['type']; ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="<?php echo $msg['icon']; ?>"></i>
                        <strong><?php echo $msg['txt']; ?> </strong>
                    </div>
                    <?php endif ?>
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-alert1-tab" data-toggle="tab" href="#alert1" role="tab" aria-controls="nav-home" aria-selected="true">Alert 1</a>
                            <a class="nav-item nav-link" id="nav-alert2-tab" data-toggle="tab" href="#alert2" role="tab" aria-controls="nav-profile" aria-selected="false">Alert 2</a>
                            <a class="nav-item nav-link" id="nav-alert3-tab" data-toggle="tab" href="#alert3" role="tab" aria-controls="nav-profile" aria-selected="false">Alert 3</a>
                            <a class="nav-item nav-link" id="nav-alert4-tab" data-toggle="tab" href="#alert4" role="tab" aria-controls="nav-profile" aria-selected="false">Alert 4</a>
                        </div>
                    </nav>
                    <div class="lr-wrap tab-content"  data-aos="zoom-in" data-aos-duration="500">
                        <div class="tab-pane fade show active" id="alert1" role="tabpanel" aria-labelledby="nav-alert1-tab">
                            <form class="register-form" method="post" id="alert1" action="alert/1" name="from_url"  enctype="multipart/form-data">
                                <div class="row">
                                <?php if(isset($useralerts[0]) && !empty($useralerts[0])){ ?>
                                    <input type="hidden" class="form-control" value="<?php echo $useralerts[0]->user_alerts_id;?>" name="user_alerts_id" placeholder="Enter Base value" required>
                                <?php } ?>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Currency Name</lable>
                                            <select name="currency_name_1" id="" class="form-control" required>
                                                <option value=''>Currency Name</option>
                                                <option value='USDINR' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->currency_name == 'USDINR'){ echo "selected='selected'";}?>>USDINR</option>
                                                <option value='EURINR' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->currency_name == 'EURINR'){ echo "selected='selected'";}?>>EURINR</option>
                                                <option value='GBPINR' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->currency_name == 'GBPINR'){ echo "selected='selected'";}?>>GBPINR</option>
                                                <option value='JPYINR' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->currency_name == 'JPYINR'){ echo "selected='selected'";}?>>JPYINR</option>

                                                <option value='EURUSD' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->currency_name == 'EURUSD'){ echo "selected='selected'";}?>>EURUSD</option>
                                                <option value='GBPUSD' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->currency_name == 'GBPUSD'){ echo "selected='selected'";}?>>GBPUSD</option>
                                                <option value='USDJPY' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->currency_name == 'USDJPY'){ echo "selected='selected'";}?>>USDJPY</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Nature Of Exposure</lable>
                                            <select name="nature_exposer_1" id="" class="form-control" required>
                                                <option value=''>Nature Of Exposure</option>
                                                <option value='export' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->nature_exposer == 'export'){ echo "selected='selected'";}?>>Export</option>
                                                <option value='import' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->nature_exposer == 'import'){ echo "selected='selected'";}?>>Import</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Base Value</lable> 
                                            <input type="text" class="form-control" value="<?php if(isset($useralerts[0]) && !empty($useralerts[0])){ echo $useralerts[0]->base_value;}?>" name="base_value_1" placeholder="Enter Base value" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Moves Above/Below</lable>
                                            <select name="up_down_1" id="" class="form-control" required>
                                                <option value=''>-- Please Choose --</option>
                                                <option value='1' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->up_down == '1'){ echo "selected='selected'";}?>>Moves Above</option>
                                                <option value='0' <?php if(isset($useralerts[0]) && !empty($useralerts[0]) && $useralerts[0]->up_down == '0'){ echo "selected='selected'";}?>>Moves Below</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            &nbsp;&nbsp;
                                            <button class="frame-btn btn-2" type="submit">
                                                <span class="frame-btn__outline frame-btn__outline--tall">
                                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                                </span>
                                                <span class="frame-btn__outline frame-btn__outline--flat">
                                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                                </span>
                                                <span class="frame-btn__solid"></span>
                                                <span class="frame-btn__text">Create Alert 1</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade " id="alert2" role="tabpanel" aria-labelledby="nav-alert2-tab">
                            <form class="register-form" method="post" id="alert/2" action="alert/2" name="from_url"  enctype="multipart/form-data">
                                <div class="row">
                                <?php if(isset($useralerts[1]) && !empty($useralerts[1])){ ?>
                                    <input type="hidden" class="form-control" value="<?php echo $useralerts[1]->user_alerts_id;?>" name="user_alerts_id" placeholder="Enter Base value" required>
                                <?php } ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <lable>Currency Name</lable> 
                                        <select name="currency_name_2" id="" class="form-control" required>
                                            <option value=''>Currency Name</option>
                                            <option value='USDINR' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->currency_name == 'USDINR'){ echo "selected='selected'";}?>>USDINR</option>
                                            <option value='EURINR' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->currency_name == 'EURINR'){ echo "selected='selected'";}?>>EURINR</option>
                                            <option value='GBPINR' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->currency_name == 'GBPINR'){ echo "selected='selected'";}?>>GBPINR</option>
                                            <option value='JPYINR' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->currency_name == 'JPYINR'){ echo "selected='selected'";}?>>JPYINR</option>
                                            <option value='EURUSD' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->currency_name == 'EURUSD'){ echo "selected='selected'";}?>>EURUSD</option>
                                            <option value='GBPUSD' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->currency_name == 'GBPUSD'){ echo "selected='selected'";}?>>GBPUSD</option>
                                            <option value='USDJPY' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->currency_name == 'USDJPY'){ echo "selected='selected'";}?>>USDJPY</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <lable>Nature Of Exposure</lable> 
                                        <select name="nature_exposer_2" id="" class="form-control" required>
                                            <option value=''>Nature Of Exposure</option>
                                            <option value='export' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->nature_exposer == 'export'){ echo "selected='selected'";}?>>Export</option>
                                            <option value='import' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->nature_exposer == 'import'){ echo "selected='selected'";}?>>Import</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <lable>Base Value</lable> 
                                        <input type="text" class="form-control" value="<?php if(isset($useralerts[1]) && !empty($useralerts[1])){ echo $useralerts[1]->base_value;}?>" name="base_value_2" placeholder="Enter Base value" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <lable>Moves Above/Below</lable> 
                                        <select name="up_down_2" id="" class="form-control" required>
                                            <option value=''>-- Please Choose --</option>
                                            <option value='1' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->up_down == '1'){ echo "selected='selected'";}?>>Moves Above</option>
                                            <option value='0' <?php if(isset($useralerts[1]) && !empty($useralerts[1]) && $useralerts[1]->up_down == '0'){ echo "selected='selected'";}?>>Moves Below</option>
                                        </select>
                                    </div>
                                </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            &nbsp;&nbsp;
                                            <button class="frame-btn btn-2" type="submit">
                                                <span class="frame-btn__outline frame-btn__outline--tall">
                                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                                </span>
                                                <span class="frame-btn__outline frame-btn__outline--flat">
                                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                                </span>
                                                <span class="frame-btn__solid"></span>
                                                <span class="frame-btn__text">Create Alert 2</span>
                                            </button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade " id="alert3" role="tabpanel" aria-labelledby="nav-alert3-tab">
                            <form class="register-form" method="post" id="alert3" action="alert/3" name="from_url"  enctype="multipart/form-data">
                                <div class="row">
                                <?php if(isset($useralerts[2]) && !empty($useralerts[2])){ ?>
                                    <input type="hidden" class="form-control" value="<?php echo $useralerts[2]->user_alerts_id;?>" name="user_alerts_id" placeholder="Enter Base value" required>
                                <?php } ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <lable>Currency Name</lable>
                                        <select name="currency_name_3" id="" class="form-control" required>
                                            <option value=''>Currency Name</option>
                                            <option value='USDINR' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->currency_name == 'USDINR'){ echo "selected='selected'";}?>>USDINR</option>
                                            <option value='EURINR' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->currency_name == 'EURINR'){ echo "selected='selected'";}?>>EURINR</option>
                                            <option value='GBPINR' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->currency_name == 'GBPINR'){ echo "selected='selected'";}?>>GBPINR</option>
                                            <option value='JPYINR' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->currency_name == 'JPYINR'){ echo "selected='selected'";}?>>JPYINR</option>
                                            <option value='EURUSD' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->currency_name == 'EURUSD'){ echo "selected='selected'";}?>>EURUSD</option>
                                            <option value='GBPUSD' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->currency_name == 'GBPUSD'){ echo "selected='selected'";}?>>GBPUSD</option>
                                            <option value='USDJPY' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->currency_name == 'USDJPY'){ echo "selected='selected'";}?>>USDJPY</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <lable>Nature Of Exposure</lable>
                                        <select name="nature_exposer_3" id="" class="form-control" required>
                                            <option value=''>Nature Of Exposure</option>
                                            <option value='export' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->nature_exposer == 'export'){ echo "selected='selected'";}?>>Export</option>
                                            <option value='import' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->nature_exposer == 'import'){ echo "selected='selected'";}?>>Import</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <lable>Base value</lable>
                                        <input type="text" class="form-control" value="<?php if(isset($useralerts[2]) && !empty($useralerts[2])){ echo $useralerts[2]->base_value;}?>" name="base_value_3" placeholder="Enter Base value" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <lable>Moves Above/Below</lable>
                                        <select name="up_down_3" id="" class="form-control" required>
                                            <option value=''>-- Please Choose --</option>
                                            <option value='1' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->up_down == '1'){ echo "selected='selected'";}?>>Moves Above</option>
                                            <option value='0' <?php if(isset($useralerts[2]) && !empty($useralerts[2]) && $useralerts[2]->up_down == '0'){ echo "selected='selected'";}?>>Moves Below</option>
                                        </select>
                                    </div>
                                </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            &nbsp;&nbsp;
                                            <button class="frame-btn btn-2" type="submit">
                                                <span class="frame-btn__outline frame-btn__outline--tall">
                                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                                </span>
                                                <span class="frame-btn__outline frame-btn__outline--flat">
                                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                                </span>
                                                <span class="frame-btn__solid"></span>
                                                <span class="frame-btn__text">Create Alert 3</span>
                                            </button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade " id="alert4" role="tabpanel" aria-labelledby="nav-alert4-tab">
                            <form class="register-form" method="post" id="alert4" action="alert/4" name="from_url"  enctype="multipart/form-data">
                                <div class="row">
                                <?php if(isset($useralerts[3]) && !empty($useralerts[3])){ ?>
                                    <input type="hidden" class="form-control" value="<?php echo $useralerts[3]->user_alerts_id;?>" name="user_alerts_id" placeholder="Enter Base value" required>
                                <?php } ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <lable>Currency Name</lable>
                                        <select name="currency_name_4" id="" class="form-control" required>
                                            <option value=''>Currency Name</option>
                                            <option value='USDINR' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->currency_name == 'USDINR'){ echo "selected='selected'";}?>>USDINR</option>
                                            <option value='EURINR' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->currency_name == 'EURINR'){ echo "selected='selected'";}?>>EURINR</option>
                                            <option value='GBPINR' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->currency_name == 'GBPINR'){ echo "selected='selected'";}?>>GBPINR</option>
                                            <option value='JPYINR' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->currency_name == 'JPYINR'){ echo "selected='selected'";}?>>JPYINR</option>
                                            <option value='EURUSD' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->currency_name == 'EURUSD'){ echo "selected='selected'";}?>>EURUSD</option>
                                            <option value='GBPUSD' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->currency_name == 'GBPUSD'){ echo "selected='selected'";}?>>GBPUSD</option>
                                            <option value='USDJPY' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->currency_name == 'USDJPY'){ echo "selected='selected'";}?>>USDJPY</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <lable>Nature Of Exposure</lable>
                                        <select name="nature_exposer_4" id="" class="form-control" required>
                                            <option value=''>Nature Of Exposure</option>
                                            <option value='export' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->nature_exposer == 'export'){ echo "selected='selected'";}?>>Export</option>
                                            <option value='import' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->nature_exposer == 'Import'){ echo "selected='selected'";}?>>Import</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                     <lable>Base Value</lable>
                                        <input type="text" class="form-control" value="<?php if(isset($useralerts[3]) && !empty($useralerts[3])){ echo $useralerts[3]->base_value;}?>" name="base_value_4" placeholder="Enter Base value" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <lable>Moves Above/Below</lable>
                                        <select name="up_down_4" id="" class="form-control" required>
                                            <option value=''>-- Please Choose --</option>
                                            <option value='1' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->up_down == '1'){ echo "selected='selected'";}?>>Moves Above</option>
                                            <option value='0' <?php if(isset($useralerts[3]) && !empty($useralerts[3]) && $useralerts[3]->up_down == '0'){ echo "selected='selected'";}?>>Moves Below</option>
                                        </select>
                                    </div>
                                </div>


                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            &nbsp;&nbsp;
                                            <button class="frame-btn btn-2" type="submit">
                                                <span class="frame-btn__outline frame-btn__outline--tall">
                                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                                </span>
                                                <span class="frame-btn__outline frame-btn__outline--flat">
                                                    <span class="frame-btn__line frame-btn__line--tall"></span>
                                                    <span class="frame-btn__line frame-btn__line--flat"></span>
                                                </span>
                                                <span class="frame-btn__solid"></span>
                                                <span class="frame-btn__text">Create Alert 4</span>
                                            </button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
	<!--login/register page-->