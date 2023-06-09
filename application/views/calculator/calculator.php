<section id="calculator" class="page-main-content">
	<h3 style="text-align: center;padding-bottom: 30px;">Calculators</h3>
        <div class="container">
            <div class="row justify-content-lg-center">
				<div class="col-2">
					
				  </div>
				  <div class="col-12" style="padding: 0px;">
					<select name="calcu" class="form-control" onchange="return show_tabs(this.value);">
						<option>Select Calculator</option>
						<option value="pcfc_rpc_calculator_tab">PCFC vs RPC Calculator - USD</option>
						<option value="bill_discounting_tab">Bill Discounting and Interest Calculations (in INR)</option>

						<option value="fdbp_fubp_tab">Bill Discounting and Interest Calculations (in USD)</option>
						<option value="bc_cc_facility_tab">Buyers Credit  v/s Cash Credit Facility Calculator</option>
						<option value="bc_sc_tab">Buyers Credit v/s Suppliers Credit Calculator</option>
						<option value="cc_fcnr_tab">CC v/s FCNR B Loan Calculator</option>
						<option value="bc_int_tab">Buyers Credit Interest Calculator</option>
						<option value="fsce_tab">Forward Sale Contract Cancellation - Export</option>
						<option value="fsc_tab">Forward Sale Contract Cancellation - Import</option>
						<!--
						<option value="ed_fpc_tab_export">Early delivery of FPC ( Export Contract)</option>
						<option value="ed_fsc_tab">Early Delivery of FSC ( Import Contract)</option>
-->
					</select>
					<br/><br/>
					<div class="tab-content" id="nav-tabContent">
					
						<div class="tab-pane fade" id="pcfc_rpc_calculator_tab" role="tabpanel" aria-labelledby="pcfc_rpc_calculator">
                            <div class="col-lg-12" style="padding: 0px;">
                                <div class="text-center">
                                    <div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
                                        PCFC vs RPC Calculator -USD
                                        <span></span>
                                    </div><br /><br />
                                </div>
                                <div class="m-data-wrap table-responsive">
                                    <table class="table" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th colspan=2>Foreign Currenc vs Rupee Finance</th>
                                                
                                                <th>
                                                
                                                    <select class="form-control" name="pcfc_rpc_month" id="pcfc_rpc_month" required >
                                                        <option value="" >--Select Months--</option>
                                                        <option value="1" >1 Month</option>
                                                        <option value="2" >2 Month</option>
                                                        <option value="3" >3 Month</option>
                                                        <option value="4" >4 Month</option>
                                                        <option value="5" >5 Month</option>
                                                        <option value="6" >6 Month</option>
                                                        <option value="7" >7 Month</option>
                                                        <option value="8" >8 Month</option>
                                                        <option value="9" >9 Month</option>
                                                        <option value="10" >10 Month</option>
                                                        <option value="11" >11 Month</option>
                                                        <option value="12" >12 Month</option>
                                                        
                                                    </select>
                                                
                                                
                                            </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan=3 class="mt-label"><b>PCFC Interest Rate </b></td>
                                                <td>Libor</td>
                                            
                                                <td class="inp-label"><input type="text" placeholder="enter value" id="libor_value"></td>
                                                                                                                                
                                            </tr>
                                            <tr>
                                                <td>Spread</td>
                                            
                                                <td class="inp-label"><input type="text" placeholder="enter value" id="spread_value"></td>
                                                                                                                                    
                                            </tr>
                                            <tr>
                                                <td>PCFC Costing</td>
                                                
                                                <td><input type="text" placeholder="enter value" value="" id="pcfc_intrest_value" disabled></td>
                                                                                                                            
                                            </tr>
                                            <tr>
                                                <td rowspan=3 class="mt-label"><b>RPC Interest Rate </b></td>
                                                <td>Post Subvention</td>
                                            
                                                <td class="inp-label"><input type="text" placeholder="enter value" id="post_subvention_value"></td>
                                                                                                                                    
                                            </tr>
                                            <tr>
                                                <td>Forwrading premium Annualized</td>
                                                
                                                <td class="inp-label"><input type="text" placeholder="enter value" id="f_p_annual_value"></td>
                                                                                                                                
                                            </tr>
                                            <tr>
                                                <td class="st-label">PCFC Costing</td>
                                                
                                                <td><input type="text" placeholder="enter value" value="" id="rpc_intrest_value" disabled></td>
                                                                                                                                
                                            </tr>
                                            <tr>
                                                <td class="mt-label"><b>Remark </b></td>
                                                <td colspan="6" id="pcfc_rpc_calculator_tab_remark">
                                                </td>                                                                                      
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-group text-center">
                                        <button class="frame-btn btn-3" type="reset" onclick="pcfc_rpc_calculator_tab();">
                                            <span class="frame-btn__outline frame-btn__outline--tall">
                                                <span class="frame-btn__line frame-btn__line--tall"></span>
                                                <span class="frame-btn__line frame-btn__line--flat"></span>
                                            </span>
                                            <span class="frame-btn__outline frame-btn__outline--flat">
                                                <span class="frame-btn__line frame-btn__line--tall"></span>
                                                <span class="frame-btn__line frame-btn__line--flat"></span>
                                            </span>
                                            <span class="frame-btn__solid"></span>
                                            <span class="frame-btn__text" id="pcfc_rpc_calculate">Calculate</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
					  </div>
					 
					  <div class="tab-pane fade" id="bill_discounting_tab" role="tabpanel" aria-labelledby="bill_discounting_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
									Bill Discounting and Interest Calculations (in INR)
									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=2>Bill Discounting and interest Calculations</th>
											
											<th>
											
										</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan='3' class="mt-label" style="text-align:center"><b>Bill Discount</b></td>
                                        </tr>
                                        <tr>
											<td>Bill Amount</td>
											<td>Rs.</td>
							
											<td class="inp-label"><input type="text" placeholder="enter value" id="bill_amount_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Margin Kept</td>
											<td>%</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="margin_kept_value"></td>
											                                                                                    
										</tr>
										<tr>
											<td>Discounted Amount</td>
											<td>Rs</td>
											
											<td ><input type="text" placeholder="enter value" value="" id="discount_amount_value" disabled></td>
										                                                                                   
										</tr>
										<tr>
											<td>Tenor</td>
											<td>Days</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" value="" id="tenor_value" ></td>
										                                                                                   
										</tr>
										<tr>
											<td>Invoice Date</td>
											<td>dd-mm-yyyy</td>
											
											<td class="inp-label"><input type="date" value="" id="invoice_date_value" ></td>
										                                                                                   
										</tr>
										<tr>
											<td>Bill Date</td>
											<td>dd-mm-yyyy</td>
											
											<td class="inp-label"><input type="date" value="" id="bill_date_value"></td>
										                                                                                   
										</tr>
										<tr>
											<td>Due Date</td>
											<td>dd-mm-yyyy</td>
											
											<td><input type="text" value="" id="due_date_value" disabled></td>
										                                                                                   
										</tr>
										<tr>
											<td colspan='3' class="mt-label" style="text-align:center"><b>Interest Amount </b></td>
                                        </tr>
                                        <tr>
											<td>Discounted Amount</td>
											<td>Rs.</td>
											
											<td ><input type="text" placeholder="enter value" id="intrest_discount_value" disabled></td>
											                                                                                     
										</tr>
										<tr>
											<td>Conversion Rate</td>
											<td>Rs.</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="conversion_rate_value"></td>
										                                                                                      
										</tr>
										<tr>
											<td class="st-label">Intrest Rate</td>
											<td >%</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" value="" id="intrest_rate_value" ></td>
											                                                                                  
										</tr>
										<tr>
											<td>Bill Presentation Date</td>
											<td>dd-mm-yyyy</td>
											
											<td class="inp-label"><input type="date" value="" id="bill_present_date_value" ></td>
										                                                                                   
										</tr>
										<tr>
											<td>Credit Period</td>
											<td>Days</td>
											
											<td><input type="text" value="" id="credit_period_value" disabled></td>
										                                                                                   
										</tr>
										<tr>
											<td>Intrest Amount</td>
											<td>Rs.</td>
											
											<td ><input type="text" placeholder="enter value" id="intrest_amount_value" disabled></td>
										                                                                                   
										</tr>

										<tr>
											<td colspan='3' class="mt-label" style="text-align:center""><b>Overdue Intrest </b></td>
                                        </tr>
                                        <tr>
											<td>Remittance Received</td>
											<td>dd-mm-yyyy</td>
											
											<td class="inp-label"><input type="date" placeholder="enter value" id="remittance_received_value"></td>
											                                                                                     
										</tr>
										<tr>
											<td>overdue Days</td>
											<td>Days</td>
											
											<td ><input type="text" placeholder="enter value" id="overdue_days_value" disabled></td>
										                                                                                      
										</tr>
										<tr>
											<td class="st-label">Overdue Intrest Rate</td>
											<td >%</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" value="" id="overdue_intrest_rate_value" ></td>
											                                                                                  
										</tr>
										<tr>
											<td class="st-label">Overdue Intrest Amount</td>
											<td >Rs.</td>
											
											<td><input type="text" placeholder="enter value" value="" id="overdue_intrest_amount_value" disabled></td>
											                                                                                  
										</tr>
									
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset" onclick="bill_discounting_tab()">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="bill_discounting_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>
					  
					  <div class="tab-pane fade" id="fdbp_fubp_tab" role="tabpanel" aria-labelledby="fdbp_fubp_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
									Bill Discounting and Interest Calculations (in USD)
									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=3>Bill Discounting and Interest Calculations</th>
											
											<th>
											
												
											
											
										</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan='3' class="mt-label" style="text-align:center"><b>Bill Discount</b></td>
                                        </tr>
                                        <tr>
											<td>Bill Amount</td>
											<td>USD.</td>
							
											<td class="inp-label"><input type="text" placeholder="enter value" id="bill_amount_value_1"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Margin Kept</td>
											<td>%</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="margin_kept_value_1"></td>
											                                                                                    
										</tr>
										<tr>
											<td>Discounting Amount</td>
											<td>USD.</td>
											
											<td><input type="text" placeholder="enter value" value="" id="discount_amount_value_1" disabled></td>
										                                                                                   
										</tr>
										<tr>
											<td>Tenor</td>
											<td>Days</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" value="" id="tenor_value_1" ></td>
										                                                                                   
										</tr>
										<tr>
											<td>Invoice Date</td>
											<td>dd-mm-yyyy</td>
											
											<td  class="inp-label"><input type="date" value="" id="invoice_date_value_1" ></td>
										                                                                                   
										</tr>
										<tr>
											<td>Bill Date</td>
											<td>dd-mm-yyyy</td>
											
											<td class="inp-label"><input type="date" value="" id="bill_date_value_1"></td>
										                                                                                   
										</tr>
										<tr>
											<td>Due Date</td>
											<td>dd-mm-yyyy</td>
											
											<td><input type="date" value="" id="due_date_value_1" disabled></td>
										                                                                                   
										</tr>
										<tr>
                                            <td colspan='3' class="mt-label" style="text-align:center"><b>Interest Amount</b></td>
                                        </tr>
                                        <tr>
											<td>Discounted Amount</td>
											<td>USD.</td>
											
											<td ><input type="text" placeholder="enter value" id="intrest_discount_value_1" disabled></td>
											                                                                                     
										</tr>
										<tr>
											<td>Conversion Rate</td>
											<td>Rs.</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="conversion_rate_value_1"></td>
										                                                                                      
										</tr>
										<tr>
											<td class="st-label">Intrest Rate</td>
											<td >%</td>
											
											<td  class="inp-label"><input type="text" placeholder="enter value" value="" id="intrest_rate_value_1"></td>
											                                                                                  
										</tr>
										<tr>
											<td>Bill Presentation Date</td>
											<td>dd-mm-yyyy</td>
											
											<td class="inp-label"><input type="date" value="" id="bill_present_date_value_1" ></td>
										                                                                                   
										</tr>
										<tr>
											<td>Credit Period</td>
											<td>Days</td>
											
											<td><input type="value" value="" id="credit_period_value_1" disabled></td>
										                                                                                   
										</tr>
										<tr>
											<td>Intrest Amount</td>
											<td>Rs.</td>
											
											<td ><input type="text" placeholder="enter value" id="intrest_amount_value_1" disabled></td>
										                                                                                   
										</tr>

										<tr>
                                            <td colspan='3' class="mt-label" style="text-align:center"><b>Overdue Intrest</b></td>
                                        </tr>
                                        <tr>
											<td>Remittance Received</td>
											<td>dd-mm-yyyy</td>
											
											<td class="inp-label"><input type="date" placeholder="enter value" id="remittance_received_value_1"></td>
											                                                                                     
										</tr>
										<tr>
											<td>overdue Days</td>
											<td>Days</td>
											
											<td ><input type="text" placeholder="enter value" id="overdue_days_value_1" disabled></td>
										                                                                                      
										</tr>
										<tr>
											<td class="st-label">Overdue Intrest Rate</td>
											<td >%</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" value="" id="overdue_intrest_rate_value_1" ></td>
											                                                                                  
										</tr>
										<tr>
											<td class="st-label">Overdue Intrest Amount</td>
											<td >Rs.</td>
											
											<td><input type="text" placeholder="enter value" value="" id="overdue_intrest_amount_value_1" disabled></td>
											                                                                                  
										</tr>
									
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset" onclick="fdbp_fubp_tab()">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="fdbp_fubp_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>
					
					 
					  <div class="tab-pane fade show" id="bc_cc_facility_tab" role="tabpanel" aria-labelledby="bc_cc_facility_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
									Buyers Credit  v/s Cash Credit Facility Calculator						

									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=2>Buyers Credit  v/s Cash Credit Facility Calculator</th>
											
											<th>
											
												<select class="form-control" name="bc_cc_month" id="bc_cc_month" required >
													<option value="" >--Select Months--</option>
													<option value="1" >1 Month</option>
													<option value="2" >2 Month</option>
													<option value="3" >3 Month</option>
													<option value="4" >4 Month</option>
													<option value="5" >5 Month</option>
													<option value="6" >6 Month</option>
													<option value="7" >7 Month</option>
													<option value="8" >8 Month</option>
													<option value="9" >9 Month</option>
													<option value="10" >10 Month</option>
													<option value="11" >11 Month</option>
													<option value="12" >12 Month</option>
													
												 </select>
											
											
										</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td rowspan=5 class="mt-label"><b>Buyers Credit Interest Rate </b></td>
											<td>Libor</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="b_c_libor_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Spread</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="b_c_spread_value"></td>
											                                                                                    
										</tr>
										<tr>
											<td>LOU cost</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" value="" id="lou_cost_value" ></td>
										                                                                                   
										</tr>
										<tr>
											<td>Other cost</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" value="" id="other_cost_value" ></td>
										                                                                                   
										</tr>
										<tr>
											<td>Total cost</td>
											
											<td ><input type="text" placeholder="enter value" value="" id="total_cost_value" ></td>
										                                                                                   
										</tr>
										<tr>
											<td rowspan=2 class="mt-label"><b>Hedging Cost </b></td>
											<td>Forward Premium Annualised</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="forward_premium_annualised_value"></td>
											                                                                                     
										</tr>
										
										<tr>
											<td class="st-label">Gross Cost</td>
											
											<td><input type="text" placeholder="enter value" value="" id="gross_cost_value" disabled></td>
											                                                                                  
										</tr>

										<tr>
											<td rowspan=1 class="mt-label"><b>CC Interest Rate</b></td>
											<td>CC Intrest rate</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="cc_intrest_rate_value"></td>
											                                                                                     
										</tr>
										
										
										<tr>
											<td class="mt-label"><b>Remark </b></td>
											<td colspan="6" id="bc_cc_remark">Post Subvention</td>                                                                                      
										</tr>
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset" onclick="bc_cc_facility_tab();">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="bc_cc_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>
					 
					  <div class="tab-pane fade show " id="bc_sc_tab" role="tabpanel" aria-labelledby="bc_sc_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
									Buyers Credit  v/s Suppliers Credit Facility Calculator						

									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=1>Cost</th>
											
											<th>Buyers Credit</th>
											<th>Suppliers Credit</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<!-- <td rowspan=5 class="mt-label"><b>Buyers Credit Interest Rate </b></td> -->
											<td>L.C Isuued
											</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_lc_issued_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_lc_issued_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>L.C Confirmation</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_lc_confirmation_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_lc_confirmation_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>L.C Advising</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_lc_advising_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_lc_advising_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>L.C Negotiation Cost</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_lc_negotiation_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_lc_negotiation_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Interest Cost</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_interest_cost_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_interest_cost_value"></td>
										                                                                                    
										</tr>
										
										<tr>
											<td>LOU Interest Cost</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_lou_interest_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_lou_interest_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Hedging Cost</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_hedging_cost_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_hedging_cost_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Arrangment Fees</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_arrangment_fees_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_arrangment_fees_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Other Charges</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_other_charges_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_other_charges_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>With Holding Cost</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="bc_w_h_cost_value"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="sc_w_h_cost_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Total Cost</td>
										
											<td ><input type="text" placeholder="enter value" id="bc_total_cost_value" disabled></td>
											<td ><input type="text" placeholder="enter value" id="sc_total_cost_value" disabled></td>
										                                                                                    
										</tr>
										
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset" onclick="bc_sc_tab();">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="bc_sc_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>
					 
					  <div class="tab-pane fade show" id="cc_fcnr_tab" role="tabpanel" aria-labelledby="cc_fcnr_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
									CC v/s FCNR B Loan Calculator						
						

									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=2>CC v/s FCNR B Loan Calculator	</th>
											
											<th>
											
												<select class="form-control" name="cc_fcnr_month" id="cc_fcnr_month" required >
													<option value="" >--Select Months--</option>
													<option value="1" >1 Month</option>
													<option value="2" >2 Month</option>
													<option value="3" >3 Month</option>
													<option value="4" >4 Month</option>
													<option value="5" >5 Month</option>
													<option value="6" >6 Month</option>
													<option value="7" >7 Month</option>
													<option value="8" >8 Month</option>
													<option value="9" >9 Month</option>
													<option value="10" >10 Month</option>
													<option value="11" >11 Month</option>
													<option value="12" >12 Month</option>
													
												 </select>
											
											
										</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td rowspan=5 class="mt-label"><b>FCNR B Interest Rate		
		
		
											</b></td>
											<td>Libor</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="cc_fcnr_libor_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Spread</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="cc_fcnr_spread_value"></td>
											                                                                                    
										</tr>
										<tr>
											<td>Total cost</td>
											
											<td ><input type="text" placeholder="enter value" value="" id="cc_fcnr_total_cost_value" disabled></td>
										                                                                                   
										</tr>
										<tr>
											<td>Forward Premium Annualised </td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" value="" id="cc_fcnr_fpa_value" ></td>
										                                                                                   
										</tr>
										<tr>
											<td>Total FCNR B cost</td>
											
											<td ><input type="text" placeholder="enter value" value="" id="total_fcnr_cost_value" disabled ></td>
										                                                                                   
										</tr>
										<tr>
											<td rowspan=1 class="mt-label"><b>CC Interest rate </b></td>
											<td>Interest Rate</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fcnr_interest_rate_value"></td>
											                                                                                     
										</tr>
									
										<tr>
											<td class="mt-label"><b>Remark </b></td>
											<td colspan="6" id="cc_fcnr_remark">Post Subvention</td>                                                                                      
										</tr>
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset" onclick="cc_fcnr_tab()">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="cc_fcnr_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>
					 
					  <div class="tab-pane fade show " id="bc_int_tab" role="tabpanel" aria-labelledby="bc_int_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
									Buyers Credit Interest Calculator
									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=2></th>
											
											<th>F.C</th>
											<th>INR</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<!-- <td rowspan=5 class="mt-label"><b>Buyers Credit Interest Rate </b></td> -->
											<td>Transaction Amount</td>
											<td>USD</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fc_transction_amount_value"></td>
											<td ><input type="text" placeholder="enter value" disabled id="inr_transaction_amount_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Conversion Rate</td>
											<td>USD/INR</td>
										
											<td class="inp-label"></td>
											<td class="inp-label"><input type="text" placeholder="enter value" id="inr_conversion_rate_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Libor</td>
											<td>%</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fc_libor_value"></td>
											<td class="inp-label"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Spread</td>
											<td>%</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fc_spread_value"></td>
											<td class="inp-label"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Total interest cost</td>
											<td>%</td>
										
											<td ><input type="text" placeholder="enter value" id="fc_spread_value_1" disabled></td>
											<td class="inp-label"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Tenor Days</td>
											<td></td>
										
											<td class="inp-label" ><input type="text" placeholder="enter value" id="fc_tenor_value" ></td>
											<td class="inp-label"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Interest Amount</td>
											<td></td>
										
											<td ><input type="text" placeholder="enter value" id="fc_interest_amount_value" disabled></td>
											<td ><input type="text" placeholder="enter value" id="inr_interest_amount_value" disabled></td>
										                                                                                    
										</tr>
										<tr>
											<td>Swift/Handling Charges</td>
											<td>USD</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fc_swift_value"></td>
											<td ><input type="text" placeholder="enter value" id="inr_swift_value" disabled></td>
										                                                                                    
										</tr>
										<tr>
											<td>LOU/LOC Issued %</td>
											<td> %</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fc_lou_loc_value"></td>
											<td ><input type="text" placeholder="enter value" id="inr_lou_loc_value" disabled></td>
										                                                                                    
										</tr>
										<tr>
											<td>LOU/LOC Issued Amount</td>
											<td> </td>
										
											<td ><input type="text" placeholder="enter value" id="fc_lou_loc_amount_value" disabled></td>
											<td ><input type="text" placeholder="enter value" id="inr_lou_loc_amount_value" disabled></td>
										                                                                                    
										</tr>
										<tr>
											<td>Arrangment fees</td>
											<td> %</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fc_arrangment_fees_value"></td>
											<td ><input type="text" placeholder="enter value" id="inr_arrangment_fees_value" disabled></td>
										                                                                                    
										</tr>
										<tr>
											<td>Other Cost</td>
											<td> %</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fc_other_cost_value"></td>
											<td ><input type="text" placeholder="enter value" id="inr_other_cost_value" disabled></td>
										                                                                                    
										</tr>
										<tr>
											<td>Total Cost %</td>
											<td> %</td>
										
											<td ><input type="text" placeholder="enter value" id="fc_total_cost_value" disabled></td>
											<td ><input type="text" placeholder="enter value" id="inr_total_cost_value" disabled></td>
										                                                                                    
										</tr>
										
										<tr>
											<td>Hedging Cost %</td>
											<td>%</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fc_hedging_value"></td>
											<td ><input type="text" placeholder="enter value" id="inr_hedging_value" disabled></td>
										                                                                                    
										</tr>
										<tr>
											<td> Total Cost with Hedging</td>
											<td>%</td>
										
											<td ><input type="text" placeholder="enter value" id="fc_total_hedging_value" disabled></td>
											<td ><input type="text" placeholder="enter value" id="inr_total_hedging_value" disabled></td>
										                                                                                    
										</tr>
										<tr>
											<td>CC Interest Cost</td>
											<td>%</td>
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fc_cc_interest_cost_value"></td>
											<td ><input type="text" placeholder="enter value" id="inr_cc_interest_cost_value" disabled></td>
										                                                                                    
										</tr>
										<tr>
											<td class="mt-label"><b>Benifit </b></td>
											<td colspan="6" id="fc_inr_remark">Post Subvention</td>                                                                                      
										</tr>
										
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset" onclick="bc_int_tab()">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="bc_int_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>
					 
					  <div class="tab-pane fade show " id="fsce_tab" role="tabpanel" aria-labelledby="fsc_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
								Forward Purchase Contract Cancellation - Export
					

									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=4>Forward Purchase Contract cancellation - Export</th>
										
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<!-- <td rowspan=5 class="mt-label"><b>Buyers Credit Interest Rate </b></td> -->
											<td>Contracted Rate/ Forward rate</td>
											
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="contracted_forward_value_1"></td>
										                                                                               
										</tr>
										<tr>
											<td>Delivery Period</td>
										
										
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="delivery_period_value_1"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Select Currency</td>
											<td>	
												<select class="form-control" name="select_currency" id="select_currency_1" >
												<option value="" >--Select Currency--</option>
												<option value="inr" >INR</option>
												<option value="usd" >USD</option>
																			
												</select>
											</td>
										
											
										                                                                                    
										</tr>
										<tr>
											<td>Amount</td>
										
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fsc_amount_value_1"></td>
										
										                                                                                    
										</tr>
										<tr>
											<td>Bank Margin On rate In paise</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="fsc_bank_margin_value_1"></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Spot Rate</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="fsc_spot_rate_value_1" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Forward Premium</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="fsc_forward_premium_value_1" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Forward Cancellation Rate</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_forward_rate_value_1" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Exchange Gain/Loss</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_exchange_value_1" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Net Profit/Loss</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_net_value_1" disabled ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Net Amount Payable/Receivable</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_net_amount_value_1" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Cash Outlay</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="fsc_cash_outlay_1" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Interest rate</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="fsc_interest_rate_1" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Spot date</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="fsc_spot_date_1" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Number Of Days</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="fsc_no_days_1" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Interet</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="fsc_interest_1" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td class="mt-label"><b>Note</b></td>
											<td colspan="6" id="">Cash Spot is applicable only Early utilisation and cancellation on Expiry date</td>                                                                                      
										</tr>
										
										
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset" onclick="fsce_tab()">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="fsc_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>

					  <div class="tab-pane fade show " id="fsc_tab" role="tabpanel" aria-labelledby="fsc_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
									Forward Sale Contract Cancellation - Import
					

									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=4>Forward Sale Contract Cancellation - Import</th>
										
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<!-- <td rowspan=5 class="mt-label"><b>Buyers Credit Interest Rate </b></td> -->
											<td>Contracted Rate/Forward Rate</td>
											
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="contracted_forward_value"></td>
										                                                                               
										</tr>
										<tr>
											<td>Delivery Period</td>
										
										
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="delivery_period_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Select Currency</td>
											<td>	
												<select class="form-control" name="select_currency" id="select_currency" >
												<option value="" >--Select Currency--</option>
												<option value="inr" >INR</option>
												<option value="usd" >USD</option>
																			
												</select>
											</td>
										
											
										                                                                                    
										</tr>
										<tr>
											<td>Amount</td>
										
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="fsc_amount_value"></td>
										
										                                                                                    
										</tr>
										<tr>
											<td>Bank Margin On rate In paise</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="fsc_bank_margin_value"></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Spot Rate</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="fsc_spot_rate_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Forward Premium</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="fsc_forward_premium_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Forward Rate</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_forward_rate_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Exchange Gain/Loss</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_exchange_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Net Profit/Loss</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_net_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Net Amount Payable/Receivable</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_net_amount_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Cash Outlay</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_cash_outlay" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Interest rate</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_interest_rate" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Spot date</td>
											
											<td ><input type="text" placeholder="enter value" id="fsc_spot_date" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Number Of Days</td>
											
											<td ><input type="text" placeholder="enter value" id="" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Interet</td>
											
											<td ><input type="text" placeholder="enter value" id="" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td class="mt-label"><b>Note</b></td>
											<td colspan="6" id="">Cash Spot is applicable only Early utilisation and cancellation on Expiry date</td>                                                                                      
										</tr>
										
										
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset" onclick="fsc_tab();">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="fsc_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>
					 <!--
					  <div class="tab-pane fade show " id="ed_fpc_tab_export" role="tabpanel" aria-labelledby="ed_fpc_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
									Early delivery of FPC ( Export Contract)
					

									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=4>Early delivery of FPC ( Export Contract)</th>
										
											
										</tr>
									</thead>
									<tbody>
										<tr>
											
											<td>Contracted Rate/Forward Rate</td>
											
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_contracted_forward_value"></td>
										                                                                               
										</tr>
										<tr>
											<td>Delivery Period</td>
										
										
											
											<td class="inp-label"><input type="date" placeholder="enter value" id="ed_delivery_period_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Select Currency</td>
											<td>	
												<select class="form-control" name="ed_select_currency" id="ed_select_currency" >
												<option value="" >--Select Currency--</option>
												<option value="inr" >INR</option>
												<option value="usd" >USD</option>
																			
												</select>
											</td>
										
											
										                                                                                    
										</tr>
										<tr>
											<td>Amount</td>
										
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_amount_value"></td>
										
										                                                                                    
										</tr>
										<tr>
											<td>Bank Margin On rate In paise</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_bank_margin_value"></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Early Delivery date</td>
											
											<td class="inp-label"><input type="date" placeholder="enter value" id="ed_delivery_date_value"></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Spot Rate</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="ed_spot_rate_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Forward Premium Upto</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_forward_premium_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Cash/Spot as on</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_forward_premium_value_1" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Early  Utilisation Rate ( Cash) on </td>
											
											<td ><input type="text" placeholder="enter value" id="ed_utilisation_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Applicable trn rate</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_trn_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Net Swap Gain/Loss</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_net_gain_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Total Profit/Loss</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_total_loss_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Cash Outlay</td>
											
											<td ><select class="form-control" name="ed_select_currency" id="ed_select_currency" >
												<option value="" >--Select Yes/No--</option>
												<option value="yes" >Yes</option>
												<option value="no" >NO</option>
																			
												</select></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Base Rate/MCLR</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="ed_base_rate_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Overdue Interest</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="ed_overdue_interest_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Total Interest rate</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_total_intrest_value" disabled></td>
											
										                                                                                    
										</tr>
										
										<tr>
											<td>Number Of Days</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_no_days_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Interest on Outlay Funds</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_interest_outlay_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Net Amount Payable to Client</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_payable_client_value" disabled></td>
											
										                                                                                    
										</tr>
										
										
										
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset" onlcick="ed_fpc_tab_export();">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="ed_fpc_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>
					
					  <div class="tab-pane fade show " id="ed_fsc_tab" role="tabpanel" aria-labelledby="ed_fsc_calculator">

						<div class="col-lg-12" style="padding: 0px;">
							<div class="text-center">
								<div class="section-text-title" data-aos="fade-right" data-aos-duration="500">
									Early delivery of FSC ( Import Contract)
					

									<span></span>
								</div><br /><br />
							</div>
							<div class="m-data-wrap table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th colspan=4>Early delivery of FSC ( Import Contract)</th>
										
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Contracted Rate/Forward Rate</td>
											
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_fsc_contracted_forward_value"></td>
										                                                                               
										</tr>
										<tr>
											<td>Delivery Period</td>
										
										
											
											<td class="inp-label"><input type="date" placeholder="enter value" id="ed_fsc_delivery_period_value"></td>
										                                                                                    
										</tr>
										<tr>
											<td>Select Currency</td>
											<td>	
												<select class="form-control" name="ed_fsc_select_currency" id="ed_fsc_select_currency" >
												<option value="" >--Select Currency--</option>
												<option value="inr" >INR</option>
												<option value="usd" >USD</option>
																			
												</select>
											</td>
										
											
										                                                                                    
										</tr>
										<tr>
											<td>Amount</td>
										
										
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_fsc_amount_value"></td>
										
										                                                                                    
										</tr>
										<tr>
											<td>Bank Margin On rate In paise</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_fsc_bank_margin_value"></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Early Delivery date</td>
											
											<td class="inp-label"><input type="date" placeholder="enter value" id="ed_fsc_delivery_date_value"></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Spot Rate</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="ed_fsc_spot_rate_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Forward Premium Upto</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_fsc_forward_premium_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Cash/Spot as on</td>
											
											<td class="inp-label"><input type="text" placeholder="enter value" id="ed_fsc_cash_spot_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Early  Utilisation Rate ( Cash) on </td>
											
											<td ><input type="text" placeholder="enter value" id="ed_fsc_utilisation_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Applicable trn rate</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_fsc_trn_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Net Swap Gain/Loss</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_fsc_net_gain_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Total Profit/Loss</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_fsc_total_loss_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Cash Outlay/Cash Inlay</td>
											
											<td ><select class="form-control" name="ed_select_s_n" id="ed_fsc_select_s_n" >
												<option value="" >--Select Yes/No--</option>
												<option value="yes" >Yes</option>
												<option value="no" >NO</option>
																			
												</select></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Base Rate/MCLR</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="ed_fsc_base_rate_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Overdue Interest</td>
											
											<td class="inp-label" ><input type="text" placeholder="enter value" id="ed_fsc_overdue_interest_value" ></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Total Interest rate</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_fsc_total_intrest_value" disabled></td>
											
										                                                                                    
										</tr>
										
										<tr>
											<td>Number Of Days</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_fsc_no_days_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Interest on Outlay Funds</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_fsc_interest_outlay_value" disabled></td>
											
										                                                                                    
										</tr>
										<tr>
											<td>Net Amount Payable to Client</td>
											
											<td ><input type="text" placeholder="enter value" id="ed_fsc_payable_client_value" disabled></td>
											
										                                                                                    
										</tr>
										
										
										
									</tbody>
								</table>
								<div class="form-group text-center">
									<button class="frame-btn btn-3" type="reset">
										<span class="frame-btn__outline frame-btn__outline--tall">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__outline frame-btn__outline--flat">
											<span class="frame-btn__line frame-btn__line--tall"></span>
											<span class="frame-btn__line frame-btn__line--flat"></span>
										</span>
										<span class="frame-btn__solid"></span>
										<span class="frame-btn__text" id="ed_fsc_calculate">Calculate</span>
									</button>
								</div>
							</div>
						</div>


					  </div>
					  -->

					</div>
				  </div>
				
            </div>
        </div>
    </section>