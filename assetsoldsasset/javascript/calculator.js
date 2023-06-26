function show_tabs(selected_val){
    $('.tab-pane').hide();
    
    $('#'+selected_val).css("display","inline");
    //$('[id*="'+selected_val+'"]').removeAttr("style");

}

function pcfc_rpc_calculator_tab(){
    var A = $('#libor_value').val();
    var B = $('#spread_value').val();
  
    var C = parseFloat(A) + parseFloat(B);
  
    $('#pcfc_intrest_value').val(C);

    var D = $('#post_subvention_value').val();
    var E = $('#f_p_annual_value').val();
    var F = parseFloat(D) + parseFloat(E);
    
    $('#rpc_intrest_value').val(F);
    
    if( C > F){
        $('#pcfc_rpc_calculator_tab_remark').html('Recommendation is RPC');
    } else {
        $('#pcfc_rpc_calculator_tab_remark').html('Recommendation is PCFC');
    }
    return;
}

function bill_discounting_tab(){
    var A = $('#bill_amount_value').val();
    var B = $('#margin_kept_value').val();
  
    var C = parseFloat(A) * (100-parseFloat(B))/100;
  
    $('#discount_amount_value').val(C);

    var tenor_value = $('#tenor_value').val();
   
    var tt = document.getElementById('bill_date_value').value;

    var date = new Date(tt);
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + parseFloat(tenor_value));
    
    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    var E9_display = dd + '/' + mm + '/' + y;
    var E9 = y+'/'+mm+'/'+dd;

    document.getElementById('due_date_value').value = E9_display;


    $('#intrest_discount_value').val(C);

    
    var E14 = document.getElementById('bill_present_date_value').value;
    var date1 = new Date(E9); 
    var date2 = new Date(E14); 
    
    // To calculate the time difference of two dates 
    var Difference_In_Time = date1.getTime() - date2.getTime(); 
    
    // To calculate the no. of days between two dates 
    var Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24)); 
    
    $('#credit_period_value').val(Difference_In_Days);

    var intrest_rate_value = $('#intrest_rate_value').val();
    E16 = (parseFloat(C)*(parseFloat(intrest_rate_value)/100)*parseFloat(Difference_In_Days))/365;

    $('#intrest_amount_value').val(Math.round(E16));

    var E18 = document.getElementById('remittance_received_value').value;

    var date1 = new Date(E18); 
    var date2 = new Date(E9); 
    
    // To calculate the time difference of two dates 
    var Difference_In_Time1 = date1.getTime() - date2.getTime(); 
    
    // To calculate the no. of days between two dates 
    var E19 = Math.round(Difference_In_Time1 / (1000 * 3600 * 24)); 
    
    $('#overdue_days_value').val(E19);

    var E20 = document.getElementById('overdue_intrest_rate_value').value;

    E21 = (parseFloat(C)*parseFloat(E20/100)*parseFloat(E19))/365
    $('#overdue_intrest_amount_value').val(Math.round(E21));

    return;
}


function fdbp_fubp_tab(){
    var A = $('#bill_amount_value_1').val();
    var B = $('#margin_kept_value_1').val();
  
    var C = parseFloat(A) * (100-parseFloat(B))/100;
  
    $('#discount_amount_value_1').val(C);

    var tenor_value = $('#tenor_value_1').val();
   
    var tt = document.getElementById('bill_date_value_1').value;

    var date = new Date(tt);
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + parseFloat(tenor_value));
    
    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    var E9_display = dd + '/' + mm + '/' + y;
    var E9 = y+'/'+mm+'/'+dd;

    document.getElementById('due_date_value_1').value = E9_display;


    $('#intrest_discount_value').val(C);

    
    var E14 = document.getElementById('bill_present_date_value_1').value;
    var date1 = new Date(E9); 
    var date2 = new Date(E14); 
    
    // To calculate the time difference of two dates 
    var Difference_In_Time = date1.getTime() - date2.getTime(); 
    
    // To calculate the no. of days between two dates 
    var Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24)); 
    
    $('#credit_period_value_1').val(Difference_In_Days);

    var intrest_rate_value = $('#intrest_rate_value_1').val();
    var E12 = $('#conversion_rate_value_1').val();
    E16 = (parseFloat(C)*(parseFloat(intrest_rate_value)/100)*parseFloat(E12)*parseFloat(Difference_In_Days))/365;

    $('#intrest_amount_value_1').val(Math.round(E16));

    var E18 = document.getElementById('remittance_received_value_1').value;

    var date1 = new Date(E18); 
    var date2 = new Date(E9); 
    
    // To calculate the time difference of two dates 
    var Difference_In_Time1 = date1.getTime() - date2.getTime(); 
    
    // To calculate the no. of days between two dates 
    var E19 = Math.round(Difference_In_Time1 / (1000 * 3600 * 24)); 
    
    $('#overdue_days_value_1').val(E19);

    var E20 = document.getElementById('overdue_intrest_rate_value_1').value;

    E21 = (parseFloat(C)*parseFloat(E20/100)*parseFloat(E12)*parseFloat(E19))/365
    $('#overdue_intrest_amount_value_1').val(Math.round(E21));

    return;
}


function bc_cc_facility_tab(){
    var A = $('#b_c_libor_value').val();
    var B = $('#b_c_spread_value').val();
    var C = $('#lou_cost_value').val();
    var D = $('#other_cost_value').val();
  
    var E = parseFloat(A) + parseFloat(B)+ parseFloat(C)+ parseFloat(D);
    
    $('#total_cost_value').val(E);

    var F = $('#forward_premium_annualised_value').val();

    var G = parseFloat(E) + parseFloat(F);

    $('#gross_cost_value').val(G);
    var H = $('#cc_intrest_rate_value').val();

    if( G > H){
        $('#bc_cc_remark').html('recommendation is CC');
    } else {
        $('#bc_cc_remark').html('recommendation is BC');
    }
    return;
}


function bc_sc_tab(){
    var A = $('#bc_lc_issued_value').val();
    var B = $('#bc_lc_confirmation_value').val();
    var C = $('#bc_lc_advising_value').val();
    var D = $('#bc_lc_negotiation_value').val();
    var E = $('#bc_interest_cost_value').val();
    var F = $('#bc_lou_interest_value').val();
    var G = $('#bc_hedging_cost_value').val();
    var H = $('#bc_arrangment_fees_value').val();
    var I = $('#bc_other_charges_value').val();
    var J = $('#bc_w_h_cost_value').val();

  
    var H = parseFloat(A) + parseFloat(B)+ parseFloat(C)+ parseFloat(D)+ parseFloat(E)+ parseFloat(F)+ parseFloat(G)+ parseFloat(H)+ parseFloat(I)+ parseFloat(J);
    
    $('#bc_total_cost_value').val(H);


    var A = $('#sc_lc_issued_value').val();
    var B = $('#sc_lc_confirmation_value').val();
    var C = $('#sc_lc_advising_value').val();
    var D = $('#sc_lc_negotiation_value').val();
    var E = $('#sc_interest_cost_value').val();
    var F = $('#sc_lou_interest_value').val();
    var G = $('#sc_hedging_cost_value').val();
    var H = $('#sc_arrangment_fees_value').val();
    var I = $('#sc_other_charges_value').val();
    var J = $('#sc_w_h_cost_value').val();

  
    var H = parseFloat(A) + parseFloat(B)+ parseFloat(C)+ parseFloat(D)+ parseFloat(E)+ parseFloat(F)+ parseFloat(G)+ parseFloat(H)+ parseFloat(I)+ parseFloat(J);
    
    $('#sc_total_cost_value').val(H);

    return;
}


function cc_fcnr_tab(){
    var A = $('#cc_fcnr_libor_value').val();
    var B = $('#cc_fcnr_spread_value').val();
    
    var C = parseFloat(A) + parseFloat(B);
    
    $('#cc_fcnr_total_cost_value').val(C);

    var D = $('#cc_fcnr_fpa_value').val();

    var E = parseFloat(C) + parseFloat(D);

    $('#total_fcnr_cost_value').val(E);

    var F = $('#fcnr_interest_rate_value').val();

    if( E > F){
        $('#cc_fcnr_remark').html('recommendation is CC');
    } else {
        $('#cc_fcnr_remark').html('recommendation is FCNRB');
    }
    return;
}

function bc_int_tab(){
    var D5 = $('#fc_libor_value').val();
    var D3 = $('#fc_transction_amount_value').val();
    var F4 = $('#inr_conversion_rate_value').val();
    
    F3 = Math.round(parseFloat(D3) * parseFloat(F4));
    $('#inr_transaction_amount_value').val(F3);

    var D6 = $('#fc_spread_value').val();
    
    var D7 = parseFloat(D5) + parseFloat(D6);
    
    $('#fc_spread_value_1').val(D7);

    var D8 = $('#fc_tenor_value').val();

    D9 = Math.round((parseFloat(D3)*parseFloat(D7/100)*parseFloat(D8))/360);

    $('#fc_interest_amount_value').val(D9);
    
    F9 = parseFloat(D9) * parseFloat(F4);
    $('#inr_interest_amount_value').val(F9);

    var D10 = $('#fc_swift_value').val();

    F10 = parseFloat(D10) * parseFloat(F4);
    $('#inr_swift_value').val(F10);

    var D11 = $('#fc_lou_loc_value').val();
    
    F11 = Math.round((parseFloat(D3)*parseFloat(D11/100)*parseFloat(F4)));
    $('#inr_lou_loc_value').val(F11);

    $('#fc_lou_loc_amount_value').val(D3);

    F12 = parseFloat(D3) * parseFloat(F4);
    $('#inr_lou_loc_amount_value').val(F12);

    var E13 = $('#fc_arrangment_fees_value').val();
    F13 = Math.round((parseFloat(D3)*parseFloat(E13/100)*parseFloat(F4)));
    $('#inr_arrangment_fees_value').val(F13);

    var E14 = $('#fc_other_cost_value').val();
    F14 = Math.round((parseFloat(D3)*parseFloat(E14/100)*parseFloat(F4)));
    $('#inr_other_cost_value').val(F14);

    F15 = Math.round((parseFloat(F9)+parseFloat(F10)+parseFloat(F11)+parseFloat(F13)+parseFloat(F14)));
    $('#inr_total_cost_value').val(F15);
    
    E15 = Math.round((parseFloat(F15)/parseFloat(F12))*100);
    $('#fc_total_cost_value').val(E15);

    var E16 = $('#fc_hedging_value').val();
    F16 = Math.round((parseFloat(F12)*parseFloat(E16/100)));
    $('#inr_hedging_value').val(F16);

    F17 = Math.round((parseFloat(F15)+parseFloat(F16)));
    $('#inr_total_hedging_value').val(F17);

    E17 = Math.round((parseFloat(E15)+parseFloat(E16)));
    $('#fc_total_hedging_value').val(E17);

    var E18 = $('#fc_cc_interest_cost_value').val();
    F18 = Math.round((parseFloat(F12)*parseFloat(E18/100)*parseFloat(D8))/365);
    $('#inr_cc_interest_cost_value').val(F18);

    return;
}

function fsce_tab(){

    var E2 = $('#contracted_forward_value_1').val();
    var E7 = $('#fsc_spot_rate_value_1').val();
    var E6 = $('#fsc_bank_margin_value_1').val();
    var E5 = $('#fsc_amount_value_1').val();
    
    E9 = (parseFloat(E7) + parseFloat(E6)).toFixed(2);
    $('#fsc_forward_rate_value_1').val(E9);

    E10 = (parseFloat(E2) - parseFloat(E9)).toFixed(2);
    $('#fsc_exchange_value_1').val(E10);

    E11 = (parseFloat(E10) * parseFloat(E5)).toFixed(2);
    $('#fsc_net_value_1').val(E11);

}

function fsc_tab(){

    var E2 = $('#contracted_forward_value').val();
    var E7 = $('#fsc_spot_rate_value').val();
    var E6 = $('#fsc_bank_margin_value').val();
    var E5 = $('#fsc_amount_value').val();
    
    E9 = (parseFloat(E7) - parseFloat(E6)).toFixed(2);
    $('#fsc_forward_rate_value').val(E9);

    E10 = (parseFloat(E9) - parseFloat(E2)).toFixed(2);
    $('#fsc_exchange_value').val(E10);

    E11 = (parseFloat(E10) * parseFloat(E5)).toFixed(2);
    $('#fsc_net_value').val(E11);

}

function ed_fpc_tab_export(){
    
}