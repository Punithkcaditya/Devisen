$(document).ready(function() {
    $(".cboxElement").colorbox({rel:'colorbox',width:"75%",height:"90%"});

    $("#newstable").DataTable({
        "pagingType": "full",
        "columns": [
			{"orderable": false},
            null, null, null, null, null,
            {"orderable": false},
            {"orderable": false}
        ],
        "order": []
    });
    var d = new Date();
    var n = d.getFullYear();
    var fmyr = n - 1;
    var toyr = n + 1;
    $("#news_date").datepicker({
        dateFormat: "dd.mm.yy",
        showOn: "both",
        buttonImage: "./images/calendar.gif",
        buttonImageOnly: false,
        yearRange: fmyr + ":" + toyr,
        //minDate: "-2d",
        changeMonth: true,
        changeYear: true
    });

    $.validate();
    $("#news_title").change(function() {

        $.getJSON('ajax/getslug/news_model/news_slug/' + fixedEncodeURIComponent($(this).val()), function(data) {
            $("#" + data.field_id).val(data.field_val);
        });
        function fixedEncodeURIComponent(str) {
            return str.replace(/[^\w\s]/gi, '').replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
        }
    });
})
function delete_action() {
                return confirm('Are you sure to delete?');
            }
