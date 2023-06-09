$(document).ready(function() {

    $(document).on('click', 'button[title="Delete"]', function() {
        return confirm('Are you sure to delete?');
    })

    $(document).on('click', 'a[title="Delete"]', function() {
        return confirm('Are you sure to delete?');
    });

    var url = window.location.href;
    var url_parts = url.split('/');
    index = 4;
    $('#sidebarmenu ul.sidebar-menu a').filter(function() {
        var current_link = (typeof $(this).attr('href') != 'undefined') ? $(this).attr('href') : '';
        if (current_link == url_parts[index])
            $(this).parents().addClass('active');
    });

    //CKEDITOR START
    var ckConfig = {
        filebrowserBrowseUrl: '../ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '../ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '../ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    }

    $('.ckeditor').each(function() {
        var currentInatance = $(this).attr('id');
        var editor = CKEDITOR.replace(currentInatance, ckConfig);
        CKFinder.setupCKEditor(editor, '../');
    });
    //CKEDITOR END

});
