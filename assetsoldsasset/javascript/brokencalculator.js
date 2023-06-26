$('#ajaxbrokenform').on('submit', function (e) {

    e.preventDefault();
    $.ajax({
        type: 'post',
        url: 'ajax/ajaxbroken',
        data: $('#ajaxbrokenform').serialize(),
        success: function (data) {
            if(data.status == 1){
                $('#spot_rate').html(data.result.spot_rate);
                $('#forward_rate').html(data.result.forward_rate);
                $('#annulized_rate').html(data.result.annul_rate);
            }
        }
    });

});
