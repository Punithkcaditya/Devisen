<!--login/register page-->
<section class="lr-section gird-section" style="padding-top: 25px;">
    <h3>Profile</h3>
        <div class="container">
            <div class="row justify-content-lg-center">

                <div class="col-lg-9">
                    <div class="lr-wrap tab-content"  data-aos="zoom-in" data-aos-duration="500">
                        <div class="tab-pane fade show active" id="ajaxbroken" role="tabpanel" aria-labelledby="nav-alert1-tab">
                            <form class="register-form" method="post" id="ajaxbrokenform" action="calculator/ajaxbroken" name="from_url"  enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Trade Date</lable>
                                            <input type="date" class="form-control " disabled  value="<?php echo date("Y-m-d"); ?>" name="trade_date" placeholder="Enter Trade Date" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <lable>Spot Date</lable>
                                            <input type="date" class="form-control " disabled value="<?php echo $spot_date; ?>" name="spot_date" placeholder="Enter Spot Date" >
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
                                            <select name="currency" id="" class="form-control" required>
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
                                        <div class="form-group">
                                            &nbsp;&nbsp;
                                            <button class="frame-btn btn-2" type="submit" >
                                                    <span class="frame-btn__outline frame-btn__outline--tall">
                                                        <span class="frame-btn__line frame-btn__line--tall"></span>
                                                        <span class="frame-btn__line frame-btn__line--flat"></span>
                                                    </span>
                                                <span class="frame-btn__outline frame-btn__outline--flat">
                                                        <span class="frame-btn__line frame-btn__line--tall"></span>
                                                        <span class="frame-btn__line frame-btn__line--flat"></span>
                                                    </span>
                                                <span class="frame-btn__solid"></span>
                                                <span class="frame-btn__text">Calculate</span>
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