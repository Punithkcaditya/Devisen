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

    //get_widgetareas();
    $(document).on('change', '#template_id', function() {
        get_widgetareas();
    });

    function get_widgetareas() {
        var template_id = $('#template_id').val();
        if (typeof(template_id) === 'undefined') {
            return;
        } else {
            if (template_id > 0) {
                $('#area_id').html('<option value="">Loading...</option>');
                $.getJSON('ajax/widgetareas/' + template_id, function(data) {
                    var area_options = '<option value="">Select Widget Area</option>';
                    $.each(data, function(key, item) {
                        area_options += '<option value="' + item.area_id + '">' + item.area_name + '</option>';
                    });
                    $('#area_id').html(area_options);
                });
            } else {
                $('#area_id').html('<option value="">Loading...</option>');
                var area_options = '<option value="">Select Widget Area</option>';
                $('#area_id').html(area_options);
            }
        }
    }

    //get_widgetcontent();
    $(document).on('change', '#widget_type', function() {
        get_widgetcontent();
    });

    function get_widgetcontent() {

        var widget_type = $('#widget_type').val();
        if (typeof(widget_type) === 'undefined') {
            return;
        } else if (widget_type == 0) {
            $('#widget_content').replaceWith('<textarea placeholder="widget content" name="widget_content" id="widget_content" rows="5" class="form-control"></textarea>');
            $(".widget_image_content").show();
        } else {
            $(".widget_image_content").hide();
            $('#widget_content').replaceWith('<select id="widget_content" name="widget_content" class="form-control"><option value="">Select Widget Content</option></select>');
            $('#widget_content').html('<option value="">Loading...</option>');
            $.getJSON('ajax/widgetcontent/' + widget_type, function(data) {
                var area_options = '<option value="">Select Widget Content</option>';
                $.each(data, function(key, item) {
                    area_options += '<option value="' + item.value + '">' + item.text + '</option>';
                });
                $('#widget_content').html(area_options);
            });

        }
    }
    
    var widget_type_id = $("#widget_type").val();
    if (widget_type_id == 0) {
        $(".widget_image_content").show();
    } else {
        $(".widget_image_content").hide();
    }

})
