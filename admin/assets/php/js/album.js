$(document).ready(function () {

    $('.close').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var img = $('#img').attr('src');
        $.ajax({
            type: 'POST',
            url: 'assets/ajax/action-z.ajax.php',
            data: { delete_id: id, path: img },
            success: function (response) {

                $("#msg").html(response);
                alert(response);
                location.reload();
            }
        });
    });








    $('.reorder').on('click', function () {
        $("ul.nav").sortable({
            tolerance: 'pointer'
        });
        $('.reorder').html('Save Reordering');
        $('.reorder').attr("id", "updateReorder");
        $('#reorder-msg').slideDown('');
        $('.img-link').attr("href", "javascript:;");
        $('.img-link').css("cursor", "move");
        $("#updateReorder").click(function (e) {
            if (!$("#updateReorder i").length) {
                $(this).html('').prepend('<i class="fa fa-spin fa-spinner"></i>');
                $("ul.nav").sortable('destroy');
                $("#reorder-msg").html("Reordering Photos - This could take a moment. Please don't navigate away from this page.").removeClass('light_box').addClass('notice notice_error');

                var h = [];
                $("ul.nav li").each(function () {
                    h.push($(this).attr('id').substr(9));
                });
                var album = $('#album_id').val();
                $.ajax({
                    type: "POST",
                    url: "assets/ajax/update.php",
                    data: {
                        ids: " " + h + "", album_id: album
                    },
                    success: function (data) {
                        if (data == 1 || parseInt(data) == 1) {
                            window.location.reload();
                        }
                    }
                });
                return false;
            }
            e.preventDefault();
        });
    });

    $(function () {
        $("#myDrop").sortable({
            items: '.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: '#myDrop',
            distance: 20,
            tolerance: 'pointer',
        });

        $("#myDrop").disableSelection();
    });

    //Dropzone script
    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone("div#myDrop", {
        paramName: "files", // The name that will be used to transfer the file
        addRemoveLinks: true,
        uploadMultiple: true,
        autoProcessQueue: false,
        parallelUploads: 50,
        maxFilesize: 5, // MB
        acceptedFiles: ".png, .jpeg, .jpg, .gif",
        url: "assets/ajax/action-z.ajax.php",
    });

    myDropzone.on("sending", function (file, xhr, formData) {
        var filenames = [];
        var album = $('#album_id').val();
        $('.dz-preview .dz-filename').each(function () {
            filenames.push($(this).find('span').text());
        });

        formData.append('filenames', filenames);
        formData.append('album_id', album);
    });

    /* Add Files Script*/
    myDropzone.on("success", function (file, message) {
        $("#msg").html(message);
        //setTimeout(function(){window.location.href="index.php"},200);
        setTimeout(function () {
            location.reload()
            // window.location = 'admin-event.php';

        }, 200);
    });

    myDropzone.on("error", function (data) {
        $("#msg").html('<div class="alert alert-danger">There is some thing wrong, Please try again!</div>');
    });

    myDropzone.on("complete", function (file) {
        myDropzone.removeFile(file);
    });

    $("#add_file").on("click", function () {
        myDropzone.processQueue();

    });

});