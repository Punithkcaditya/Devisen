$(document).ready(function() {
    $("#example1").DataTable({
        //"pagingType": "full",
        "columns": [
            null, null, null, null, null,
            {"orderable": false},
            {"orderable": false}
        ],
        "order": []
    });

    /*$("#user_form").validate({
        rules: {
            role_id: "required",
            username: "required",
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 5,
            },
            first_name: "required",
            last_name: "required",
            education: "required",
            joined_date: "required",
            mobile: "required",
            city: "required",
            state_id: "required",
            country_id: "required",
            address: "required",
        },
        submitHandler: function(form) {
            $("#loading_overlay").css("display", "block");
            form.submit();
        }
    });*/

    $('li :checkbox').on('click', function() {
        var $chk = $(this),
                $li = $chk.closest('li'),
                $ul, $parent;
        if ($li.has('ul')) {
            $li.find(':checkbox').not(this).prop('checked', this.checked)
        }
        do {
            $ul = $li.parent();
            $parent = $ul.siblings(':checkbox');
            if ($chk.is('.childs')) {
                $parent.prop('checked', true)
            } else {
                $parent.prop('checked', false)
            }
            $chk = $parent;
            $li = $chk.closest('.parents');
        } while ($ul.is(':not(.someclass)'));
    });

    $(".selectall").click(function() {
        //$(this.form.elements).filter(':checkbox').prop('checked', this.checked);
        var option = $("input[name=multiple]:checked").val();
        //alert(option);
        if (option == 'add') {
            if (this.checked) {
                $('.add_permission').each(function() {
                    this.checked = true;
                });
                 $('.edit_permission,.delete_permission').each(function() {
                    this.checked = false;
                });
            }
            else {
                $('.add_permission').each(function() {
                    this.checked = false;
                });
            }
        } else if (option == 'edit') {
            if (this.checked) {
                $('.edit_permission').each(function() {
                    this.checked = true;
                });
                $('.add_permission,.delete_permission').each(function() {
                    this.checked = false;
                });
            }
            else {
                $('.edit_permission').each(function() {
                    this.checked = false;
                });
            }
        } else if (option == 'delete') {
            if (this.checked) {
                $('.delete_permission').each(function() {
                    this.checked = true;
                });
                 $('.add_permission,.edit_permission').each(function() {
                    this.checked = false;
                });
            }
            else {
                $('.delete_permission').each(function() {
                    this.checked = false;
                });
            }
        } else if (option == 'all') {
            if (this.checked) {
                $('.allcheckbox').each(function() {
                    this.checked = true;
                });
            }
            else {
                $('.allcheckbox').each(function() {
                    this.checked = false;
                });
            }
        } else if (option == 'noall') {
            $('.allcheckbox').each(function() {
                    this.checked = false;
                });
        }
       /* if (this.checked) {
            $('.add_permission').each(function() {
                this.checked = true;
            });
        }
        else {
            $('.add_permission').each(function() {
                this.checked = false;
            });
        }*/
    });

})