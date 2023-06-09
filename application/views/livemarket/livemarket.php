<style>
.table tbody {
  background-color: #eceff3;
  text-align: center;
}
.table thead {
  text-align: center;
  font-size:8px;
  font-weight:bold;
}
<?php

$hong_kong_json = file_get_contents('http://worldtimeapi.org/api/timezone/Asia/Hong_Kong');
$result = json_decode($hong_kong_json);
$hong_kong = date("H:i:s",strtotime($result->datetime));

$Kolkata_json = file_get_contents('http://worldtimeapi.org/api/timezone/Asia/Kolkata');
$result = json_decode($Kolkata_json);
$Kolkata = date("H:i:s",strtotime('+60 minutes',$result->datetime));

$Dubai_json = file_get_contents('http://worldtimeapi.org/api/timezone/Asia/Dubai');
$result = json_decode($Dubai_json);
$Dubai = date("H:i:s",strtotime($result->datetime));

$London_json = file_get_contents('http://worldtimeapi.org/api/timezone/Europe/London');
$result1 = json_decode($London_json);
$London = date("H:i:s",strtotime($result1->unixtime));


$New_York_json = file_get_contents('http://worldtimeapi.org/api/timezone/America/New_York');
$result = json_decode($New_York_json);

$New_York = date("H:i:s",strtotime($result->unixtime));

?>
</style>
<section class="gird-section">
    <h3>Live Market</h3>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-1" >
            </div>
            <div class="col-lg-2" style="border: 1px solid;text-align:center;" id="HongKong">
                
            </div>
            <div class="col-lg-2" style="border: 1px solid;text-align:center;" id="Mumbai">
                
            </div>
            <div class="col-lg-2" style="border: 1px solid;text-align:center;" id="Dubai">
                
            </div>
            <div class="col-lg-2" style="border: 1px solid;text-align:center;" id="London">
                
            </div>
            <div class="col-lg-2" style="border: 1px solid;text-align:center;" id="NewYork">
                
            </div>
            <div class="col-lg-1" >
                
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <section id="tabs" class="market-data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-text-title">
                        LIVE Rates
                        <span></span>
                    </div><br />
                    <div class="m-data-wrap">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-USDINR" role="tab" aria-controls="nav-home" aria-selected="true">USDINR</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-EURINR" role="tab" aria-controls="nav-profile" aria-selected="false">EURINR</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-GBPINR" role="tab" aria-controls="nav-contact" aria-selected="false">GBPINR</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-JPYINR" role="tab" aria-controls="nav-contact" aria-selected="false">JPYINR</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active table-responsive" id="nav-USDINR" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Spot</th>
                                            <th>Cash</th>
                                            <th>Cash Rate</th>
                                            <th>Tom</th>
                                            <th>Tom Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody id="USDINR_content">
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="nav-EURINR" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Spot</th>
                                            <th>Cash</th>
                                            <th>Cash Rate</th>
                                            <th>Tom</th>
                                            <th>Tom Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody id="EURINR_content">
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="nav-GBPINR" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Spot</th>
                                            <th>Cash</th>
                                            <th>Cash Rate</th>
                                            <th>Tom</th>
                                            <th>Tom Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody id="GBPINR_content">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="nav-JPYINR" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Spot</th>
                                            <th>Cash</th>
                                            <th>Cash Rate</th>
                                            <th>Tom</th>
                                            <th>Tom Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody id="JPYINR_content">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-text-title">
                        LIBOR Rates
                        <span></span>
                    </div><br />
                    <div class="m-data-wrap">
                        <div class="table-responsive">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>1M</th>
                                        <th>2M</th>
                                        <th>3M</th>
                                        <th>4M</th>
                                        <th>5M</th>
                                        <th>6M</th>
                                        <th>9M</th>
                                        <th>12M</th>
                                    </tr>
                                </thead>
                                <tbody id="LIBOR_content">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-text-title">
                        OHLC
                        <span></span>
                    </div><br />
                    <div class="m-data-wrap">
                        <div class="table-responsive">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><label>Currency Pair</label></th>
                                        <th>BID(Export)</th>
                                        <th>ASK(Import)</th>
                                        <th>% Change</th>
                                        <th>Open</th>
                                        <th>High</th>
                                        <th>Low</th>
                                        <th>Prv. Close</th>
                                        <th>52 Week High</th>
                                        <th>52 Week Low</th>
                                    </tr>
                                </thead>
                                <tbody id="OHLC_content">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="section-text-title">
                        Currency Futures	
                        <span></span>
                    </div><br />
                    <div class="m-data-wrap">
                        <nav class="currency-table">
                            <div class="nav nav-tabs nav-fill">
                                <a class="nav-item nav-link active" id="nav-1Month-tab" data-toggle="tab" href="#nav-1Month" role="tab" aria-controls="nav-1Month" aria-selected="true">1Month</a>
                                <a class="nav-item nav-link" id="nav-2Month-tab" data-toggle="tab" href="#nav-2Month" role="tab" aria-controls="nav-2Month" aria-selected="false">2Month</a>
                                <a class="nav-item nav-link" id="nav-3Month-tab" data-toggle="tab" href="#nav-3Month" role="tab" aria-controls="nav-3Month" aria-selected="false">3Month</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active table-responsive" id="nav-1Month" role="tabpanel" aria-labelledby="nav-1Month-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Currency</th>
                                            <th>BID</th>
                                            <th>ASK</th>
                                        </tr>
                                    </thead>
                                    <tbody id="CF1M_content">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade show table-responsive" id="nav-2Month" role="tabpanel" aria-labelledby="nav-2Month-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Currency</th>
                                            <th>BID</th>
                                            <th>ASK</th>
                                        </tr>
                                    </thead>
                                    <tbody id="CF2M_content">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade show table-responsive" id="nav-3Month" role="tabpanel" aria-labelledby="nav-3Month-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Currency</th>
                                            <th>BID</th>
                                            <th>ASK</th>
                                        </tr>
                                    </thead>
                                    <tbody id="CF3M_content">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-text-title">
                        Forward Rates
                        <span></span>
                    </div><br />
                    <div class="m-data-wrap">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-FTAB1" data-toggle="tab" href="#FR-FTAB1" role="tab" aria-controls="nav-home" aria-selected="true">USDINR Month End</a>
                                <a class="nav-item nav-link" id="nav-FTAB2" data-toggle="tab" href="#FR-FTAB2" role="tab" aria-controls="nav-profile" aria-selected="false">USDINR Monthwise</a>
                                <a class="nav-item nav-link" id="nav-FTAB3" data-toggle="tab" href="#FR-FTAB3" role="tab" aria-controls="nav-contact" aria-selected="false">EURINR</a>
                                <a class="nav-item nav-link" id="nav-FTAB4" data-toggle="tab" href="#FR-FTAB4" role="tab" aria-controls="nav-contact" aria-selected="false">GBPINR</a>
                                <a class="nav-item nav-link" id="nav-FTAB5" data-toggle="tab" href="#FR-FTAB5" role="tab" aria-controls="nav-contact" aria-selected="false">JPYINR</a>
                                <a class="nav-item nav-link" id="nav-FTAB6" data-toggle="tab" href="#FR-FTAB6" role="tab" aria-controls="nav-contact" aria-selected="false">EURUSD</a>
                                <a class="nav-item nav-link" id="nav-FTAB7" data-toggle="tab" href="#FR-FTAB7" role="tab" aria-controls="nav-contact" aria-selected="false">GBPUSD</a>
                                <a class="nav-item nav-link" id="nav-FTAB8" data-toggle="tab" href="#FR-FTAB8" role="tab" aria-controls="nav-contact" aria-selected="false">USDJPY</a>
                            </div>
                        </nav>
                        <div class="tab-content">
                            <div class="tab-pane fade show active table-responsive" id="FR-FTAB1" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table" cellspacing="0" id="FTAB1_content">
                                    
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="FR-FTAB2" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table" cellspacing="0" id="FTAB2_content">
                                    
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="FR-FTAB3" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0" id="FTAB3_content">
                                   
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="FR-FTAB4" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0" id="FTAB4_content">
                                    
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="FR-FTAB5" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0" id="FTAB5_content">
                                    
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="FR-FTAB6" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0" id="FTAB6_content">
                                    
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="FR-FTAB7" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0" id="FTAB7_content">
                                    
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="FR-FTAB8" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0" id="FTAB8_content">
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>	

<style type="text/css">
.hrow {
font-weight:bold;
color: #C1E97C;
}
.hrow td{
padding-top: 20px;
width: 140px;
}
</style>