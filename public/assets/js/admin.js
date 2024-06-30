$(document).ready(function() {

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }

    $('#title').keyup(function () {
        var value = $(this).val();
        $('#slug').val(slugify(value));

    });

    CKEDITOR.replace('summary', {
        filebrowserUploadUrl: "http://localhost/phpnews/ckeditor-upload.php",
        filebrowserUploadMethod: "form"
    });


    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "http://localhost/phpnews/ckeditor-upload.php",
        filebrowserUploadMethod: "form"

    });




});