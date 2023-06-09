$(document).ready(function() {
    $("#example1").DataTable({
        "pagingType": "full",
        "columns": [
            {"orderable": false},
            null, null, null, null,
            {"orderable": false},
            {"orderable": false},
            {"orderable": false}
        ],
        "order": []
    });

    function get_menuitems() {
        var menu_id = $('#menu_id').val();
        var choosen = $('#parent_menuitem_id').attr('choosen'); //alert(choosen);
        if (typeof(menu_id) === 'undefined') {
            return;
        } else {
            $('#parent_menuitem_id').html('<option value="">Loading...</value>');
            $.getJSON('ajax/menuitems/' + menu_id, function(data) {
                var selected = "";
                var parent_menuitem_options = '<option value="">Select Menuitem</option>';
                $.each(data, function(key, item) {
                    selected = (item.menuitem_id == choosen) ? "selected" : "";
                    parent_menuitem_options += '<option value="' + item.menuitem_id + '" ' + selected + '>' + item.menuitem_text + '</option>';
                    for (var i = 0; i < item.submenu.length; i++) {
                        selected = (item.submenu[i].menuitem_id == choosen) ? "selected" : "";
                        parent_menuitem_options += '<option value="' + item.submenu[i].menuitem_id + '" ' + selected + '>&nbsp;&nbsp; &raquo; ' + item.submenu[i].menuitem_text + '</option>';
                    }
                });
                $('#parent_menuitem_id').html(parent_menuitem_options);
            });
        }
    }

    $(document).on('change', '#menu_id', function() {
        get_menuitems();
        if ($("#menu_id").val() == 1) {
            $(".main_menuitem").show();
        } else {
            $(".main_menuitem").hide();
        }
    });

    get_menuitems();
    if ($("#menu_id").val() == 1) {
        $(".main_menuitem").show();
    } else {
        $(".main_menuitem").hide();
    }

})
function delete_action() {
    return confirm('Are you sure to delete?');
}
