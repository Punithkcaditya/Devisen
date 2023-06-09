$(document).ready(function() {
	$(".cboxElement").colorbox({rel:'colorbox',width:"75%",height:"90%"});
    $("#example1").DataTable({
        "pagingType": "full",
        "columns": [
			{"orderable": false},
            null, null, null, null, null,
            {"orderable": false},
            {"orderable": false}
        ],
        "order": []
    });
	
	$.validate();

    $("#page_title").change(function() {
        $.getJSON('ajax/getslug/pages_model/page_slug/' + fixedEncodeURIComponent($(this).val()), function(data) {
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

$("#type_id").change(function(){
	var page_type_id = $("#type_id").val();
	if(page_type_id == 5){
		$("#donation_type_id").show();
	} else {
		$("#donation_type_id").hide();
	}
});

	var type_id = $("#type_id").val();
	if(type_id == 5){
		$("#donation_type_id").show();
	} else {
		$("#donation_type_id").hide();
	}