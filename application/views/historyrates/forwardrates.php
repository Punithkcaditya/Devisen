<!--page content-->
<section id="historic-page" class="page-main-content">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-md-9">
                <div class="text-center">
                    <div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
                    Historical Forward Rates
                        <span></span>
                    </div><br /><br />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="" id="forwardrates">
                    <div class="form-wrap">
                        <div class="form-group">
                            <label for="">Curreny</label>
                            <select name="currency" id="currency" required class="form-control drop-down">
                                <option selected disabled>Choose</option>
                                <option value="USDINRCOMP">USDINR</option>
                                <option value="EURINRCOMP">EURINR</option>
                                <option value="GBPINRCOMP">GBPINR</option>
                                <option value="JPYINRCOMP">JPYINR</option>
                                <option value="CHFINRCOMP">CHFINR</option>
                                <option value="CADINRCOMP">CADINR</option>
                                <option value="AUDINRCOMP">AUDINR</option>
                                <option value="SGDINRCOMP">SGDINR</option>
                                <option value="EURUSD">EURUSD</option>
                                <option value="GBPUSD">GBPUSD</option>
                                <option value="USDJPY">USDJPY</option>
                                <option value="USDCHF">USDCHF</option>
                                <option value="USDCAD">USDCAD</option>
                                <option value="AUDUSD">AUDUSD</option>
                                <option value="USDSGD">USDSGD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">From</label>
                            <input type="date" class="form-control" required onchange="gettodate(this.value);" max="<?php echo date("Y-m-d"); ?>" name="from_date" ID="from_date">
                        </div>
                        <div class="form-group">
                            <label for="" id="spot_todate">To</label>
                            <input type="date" class="form-control" id="to_date" name="to_date">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="frame-btn btn-2">
                                    <span class="frame-btn__outline frame-btn__outline--tall">
                                        <span class="frame-btn__line frame-btn__line--tall"></span>
                                        <span class="frame-btn__line frame-btn__line--flat"></span>
                                    </span>
                                <span class="frame-btn__outline frame-btn__outline--flat">
                                        <span class="frame-btn__line frame-btn__line--tall"></span>
                                        <span class="frame-btn__line frame-btn__line--flat"></span>
                                    </span>
                                <span class="frame-btn__solid"></span>
                                <span class="frame-btn__text"> Submit <i class="fa fa-caret-right"></i></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="m-data-wrap">
                    <div class="table-content">
                        <table class="table" cellspacing="0">
                            <thead >
                            <tr>
                                <th>Currency</th>
                                <th>Date</th>
                                <th>Spot Rate</th>
                                <th>1M</th>
                                <th>2M</th>
                                <th>3M</th>
                                <th>4M</th>
                                <th>5M</th>
                                <th>6M</th>
                                <th>7M</th>
                                <th>8M</th>
                                <th>9M</th>
                                <th>10M</th>
                                <th>11M</th>
                                <th>12M</th>
                            </tr>
                            </thead>
                            <tbody id="forwardrates_rates">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="text-center mt-2">
                    <button type="button" onclick="forwardrate_export()" class="frame-btn btn-3">
                            <span class="frame-btn__outline frame-btn__outline--tall">
                                <span class="frame-btn__line frame-btn__line--tall"></span>
                                <span class="frame-btn__line frame-btn__line--flat"></span>
                            </span>
                        <span class="frame-btn__outline frame-btn__outline--flat">
                                <span class="frame-btn__line frame-btn__line--tall"></span>
                                <span class="frame-btn__line frame-btn__line--flat"></span>
                            </span>
                        <span class="frame-btn__solid"></span>
                        <span class="frame-btn__text"> Export Data <i class="fa fa-share"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ page content -->