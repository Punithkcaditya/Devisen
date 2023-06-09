$(document).ready(function() {
	
    $("#example1").DataTable({
        "pagingType": "full",
        "columns": [
			{"orderable": false},
			null, null,
			{"orderable": false},
            {"orderable": false},
            {"orderable": false}
        ],
        "order": []
    });
	
	$.validate();
});
function delete_action() {
	return confirm('Are you sure to delete?');
}
