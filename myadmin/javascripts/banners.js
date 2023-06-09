$(document).ready(function() {
	$(".cboxElement").colorbox({rel:'colorbox',width:"75%",height:"90%"});
	
    $("#example1").DataTable({
      "pagingType": "full",
        "columns": [
			{"orderable": false},
            null,null,null,null,null,
            {"orderable": false},
            {"orderable": false}
        ],
        "order": []
    });
    
    $.validate();
})
function delete_action() {
	return confirm('Are you sure to delete?');
}
