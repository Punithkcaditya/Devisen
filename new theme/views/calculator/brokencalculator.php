<!--login/register page-->
<section class="management-area2 default-padding2 border-top forward-cal spacedyno">
    <h3 class="text-center">Profile</h3>
    <div id="about" class="sign-up-area  clients-content  pricing-area">
        <div class="container">
            <div class="row justify-content-lg-center d-flex pricing-item">

                <div class="col-lg-9">
                    <div class="lr-wrap tab-content"  data-aos="zoom-in" data-aos-duration="500">
                            <form class="register-form" method="post" id="ajaxbrokenform" action="calculator/ajaxbroken" name="from_url"  enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Trade Date</lable>
                                            <input type="date" class="form-control" disabled  value="<?php echo date("Y-m-d"); ?>" name="trade_date" placeholder="Enter Trade Date" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Spot Date</lable>
                                            <input type="date" class="form-control" disabled value="<?php echo $spot_date; ?>" name="spot_date" placeholder="Enter Spot Date" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="radio" style="-webkit-appearance: radio;display: inline-block;" value="1"  name="cover_type" placeholder="Enter Spot Date" required>&nbsp;&nbsp;&nbsp;Export
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="radio" style="-webkit-appearance: radio;display: inline-block;" value="2" name="cover_type" placeholder="Enter Spot Date" required>&nbsp;&nbsp;&nbsp;Import
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Currency</lable>
                                            <select name="currency" id="" class="form-control h-3" required>
                                                <option value=''>Currency Name</option>
                                                <option value='USDINR' >USDINR</option>
                                                <option value='EURINR' >EURINR</option>
                                                <option value='GBPINR' >GBPINR</option>
                                                <option value='JPYINR' >JPYINR</option>

                                                <option value='EURUSD' >EURUSD</option>
                                                <option value='GBPUSD' >GBPUSD</option>
                                                <option value='USDJPY' >USDJPY</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Forward Date</lable>
                                            <input type="date" class="form-control" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " + 365 day"));
                                            ?>" value="" name="forward_date" placeholder="Enter Spot Date" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group blue">
                                            &nbsp;&nbsp;
                                            <button class="btn btn-theme effect btn-sm" type="submit" >
                                                    Calculate
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <b><lable>Spot Rate : </lable><lable id="spot_rate">--</lable></b>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <b><lable>Forward rate : </lable><lable id="forward_rate">--</lable></b>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <b><lable>Annulized rate %: </lable><lable id="annulized_rate">--</lable></b>
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