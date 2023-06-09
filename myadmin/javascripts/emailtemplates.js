$(document).ready(function() {
    $("#example1").DataTable({
      //"pagingType": "full",
        "columns": [
			{"orderable": false},
            null,null, null,
            {"orderable": false},
            {"orderable": false}
        ],
        "order": []
    });
})