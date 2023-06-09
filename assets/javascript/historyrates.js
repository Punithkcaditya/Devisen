function gettodate(fromdate){
    var fromdate = new Date(fromdate);
    var to_date = addMonths(fromdate,3).toString();
    $("#to_date").remove();
    var html_date = '<input type="date" class="form-control" id="to_date" max="'+to_date+'" required name="to_date">';
    $("#spot_todate").after(html_date);
}

function addMonths (isoDate, numberMonths) {
    var dateObject = new Date(isoDate),
        day = dateObject.getDate(); // returns day of the month number

    // avoid date calculation errors
    dateObject.setHours(20);

    // add months and set date to last day of the correct month
    dateObject.setMonth(dateObject.getMonth() + numberMonths + 1, 0);

    // set day number to min of either the original one or last day of month
    dateObject.setDate(Math.min(day, dateObject.getDate()));

    return dateObject.toISOString().split('T')[0];
};

$('#spotform').on('submit', function (e) {

    e.preventDefault();

    $.ajax({
        type: 'post',
        url: 'historyrates/ajaxspotrate',
        data: $('#spotform').serialize(),
        success: function (data) {
            $('#spot_rates').html(data);
            $('#export_button').show();
        }
    });

});

function spot_export(){
    var currency = $('#currency').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();

    var url = '';

    url += '?currency=' + encodeURIComponent(currency);
    url += '&from_date=' + encodeURIComponent(from_date);
    url += '&to_date=' + encodeURIComponent(to_date);


    location = 'historyrates/sportratexport' + url;
}



$('#forwardrates').on('submit', function (e) {

    e.preventDefault();

    $.ajax({
        type: 'post',
        url: 'historyrates/ajaxforwardrates',
        data: $('#forwardrates').serialize(),
        success: function (data) {
            $('#forwardrates_rates').html(data);
            $('#export_button').show();
        }
    });

});

function forwardrate_export(){
    var currency = $('#currency').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();

    var url = '';

    url += '?currency=' + encodeURIComponent(currency);
    url += '&from_date=' + encodeURIComponent(from_date);
    url += '&to_date=' + encodeURIComponent(to_date);


    location = 'historyrates/forwardratexport' + url;
}


$('#liborform').on('submit', function (e) {

    e.preventDefault();

    $.ajax({
        type: 'post',
        url: 'historyrates/ajaxliborrate',
        data: $('#liborform').serialize(),
        success: function (data) {
            $('#libor_rates').html(data);
            $('#export_button').show();
        }
    });

});

function liborrate_export(){
    var currency = $('#currency').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();

    var url = '';

    url += '?currency=' + encodeURIComponent(currency);
    url += '&from_date=' + encodeURIComponent(from_date);
    url += '&to_date=' + encodeURIComponent(to_date);


    location = 'historyrates/liborrateexport' + url;
}