$(document).ready(function() {

    fetchAlbum();
    hideAlbum();
    fetchProgress();
    disableButton();



    $('body').on('click', '#resetBtn', function() {
        this.form.reset();
    });



    //fetch all albums
    function fetchAlbum() {

        id = $('#event_id').val();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { album_event_id: id },
            success: function(response) {

                $("#showAllAlbums").html(response);
            }
        });

    };



    //Create Album Ajax Request
    $("#album-create-form").submit(function(e) {
        e.preventDefault();
        $("#create-album-spinner").show();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response) {
                if (response === 'Done') {
                    $("#create-album-spinner").hide();
                    $("#album-create-form")[0].reset();
                    $("#image-holder").empty();
                    $('#ModalCreateForm').modal('hide');
                    Swal.fire({
                            title: 'Album Created Successfully.',
                            icon: 'success'
                        }),
                        setTimeout(function() {
                            //location.reload()
                            //window.location = 'admin-package.php';
                            fetchAlbum();
                        }, 1000);
                } else {
                    $("#submitAlert").html(response);
                    Swal.fire({
                        title: response,
                        icon: 'error'
                    })
                }



            }
        });
    });


    //File Upload Preview
    $("#fileUpload").on('change', function() {

        if (typeof(FileReader) != "undefined") {

            var image_holder = $("#image-holder");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function(e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "w-100 h-auto"
                }).appendTo(image_holder);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });



    //Delete album ajax reqest
    $("body").on("click", ".albumDeleteIcon", function(e) {
        e.preventDefault();
        delete_id = $(this).attr('id');
        alb_name = $('#alb_title').val();
        event_id = $('#event_id').val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { album_delete: delete_id, alb_dlt_name: alb_name, alb_dlt_id: event_id },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Album Deleted Successfully.',
                            'success'
                        )

                        fetchAlbum();
                        // fetchAllPackagesUn();
                        // setTimeout(function () {
                        // 	//location.reload()
                        // 	window.location = 'admin-package.php';
                        // }, 2000);
                    }
                });
            }
        });
    });




    //Edit Album details
    $("body").on("click", ".albumEditIcon", function(e) {
        e.preventDefault();
        album_edit_id = $(this).attr('id');
        $("#image-holder").empty();
        $("#editAlert").empty();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { album_edit_id: album_edit_id },
            success: function(response) {
                data = JSON.parse(response);
                if (data) {
                    $("#editTitle").text('Edit - ' + data.title + ' ');
                    $("#album_up_id").val(data.id);
                    $("#alb_up_name").val(data.title);
                    $("#oldName").val(data.title);
                    $("#oldImage").val(data.cover_image);
                    $("#editImagePre").attr('src', '../admin/assets/php/' + data.cover_image);
                } else {
                    $("#editAlert").html(response);
                }


            }
        });
    });

    //Update Album Ajax Request
    $("#album-update-form").submit(function(e) {
        e.preventDefault();
        $("#update-album-spinner").show();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response) {
                if (response === 'Done') {
                    $("#update-album-spinner").hide();
                    $("#album-update-form")[0].reset();
                    $('#albumEditModal').modal('hide');
                    fetchAlbum();
                    Swal.fire({
                        title: 'Album Updated Successfully.',
                        icon: 'success'
                    })
                    setTimeout(function() {
                        location.reload()
                            //window.location = 'admin-package.php';
                        fetchAlbum();
                    }, 1000);
                } else {
                    $("#editAlert").html(response);
                    Swal.fire({
                        title: response,
                        icon: 'error'
                    })
                }
                fetchAlbum();
            }
        });
    });

    //File Upload Preview - Edit
    $("#fileUploadEdit").on('change', function() {

        if (typeof(FileReader) != "undefined") {

            var image_holder = $("#image-holder-edit");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function(e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "w-100 h-auto"
                }).appendTo(image_holder);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });

    // File Upload Name Preview
    $(document).ready(function() {
        bsCustomFileInput.init()
    });







    //////////////////////////

    // progress
    function fetchProgress() {
        id = $('#event_id').val();
        var value = 0;
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { progress: id },
            success: function(response) {
                data = JSON.parse(response)
                value = parseInt(data.progress);
                checkValue(value);
            }
        });
    }

    $("#progressSubmit").on('click', function() {
        id = $('#event_id').val();
        var value = $('.progress-bar').attr('aria-valuenow');
        $.ajax({
            type: "POST",
            url: "assets/php/admin-action.php",
            data: {
                progress_submit: value,
                event_id: id
            },
            success: function(response) {
                $("#progressAlert").html(response);
                // fetchProgress();
                location.reload();
            }
        });
    });

    function checkValue(value) {
        //     var current = $('.progress-bar').attr('aria-valuenow');
        valeur = parseInt(value, 10);
        switch (valeur) {
            case 20:

                $('#c1').bootstrapToggle('on');
                break;
            case 40:
                $('#c1').bootstrapToggle('on');
                $('#c2').bootstrapToggle('on');
                break;
            case 60:
                $('#c1').bootstrapToggle('on');
                $('#c2').bootstrapToggle('on');
                $('#c3').bootstrapToggle('on');
                break;
            case 80:
                $('#c1').bootstrapToggle('on');
                $('#c2').bootstrapToggle('on');
                $('#c3').bootstrapToggle('on');
                $('#c4').bootstrapToggle('on');
                break;
            case 100:
                $('#c1').bootstrapToggle('on');
                $('#c2').bootstrapToggle('on');
                $('#c3').bootstrapToggle('on');
                $('#c4').bootstrapToggle('on');
                $('#c5').bootstrapToggle('on');
                break;
            default:
                $('#c1').bootstrapToggle('off');
                $('#c2').bootstrapToggle('off');
                $('#c3').bootstrapToggle('off');
                $('#c4').bootstrapToggle('off');
                $('#c5').bootstrapToggle('off');
                break;
        }

    }

    function disableButton() {
        var current = $('.progress-bar').attr('aria-valuenow');
        val = parseInt(current, 10);
        switch (val) {
            case 20:
                $('#c1').bootstrapToggle('enable');
                $('#c2').bootstrapToggle('enable');
                $('#c3').bootstrapToggle('disable');
                $('#c4').bootstrapToggle('disable');
                $('#c5').bootstrapToggle('disable');
                break;
            case 40:
                $('#c1').bootstrapToggle('disable');
                $('#c2').bootstrapToggle('enable');
                $('#c3').bootstrapToggle('enable');
                $('#c4').bootstrapToggle('disable');
                $('#c5').bootstrapToggle('disable');
                break;
            case 60:
                $('#c1').bootstrapToggle('disable');
                $('#c2').bootstrapToggle('disable');
                $('#c3').bootstrapToggle('enable');
                $('#c4').bootstrapToggle('enable');
                $('#c5').bootstrapToggle('disable');
                break;
            case 80:
                $('#c1').bootstrapToggle('disable');
                $('#c2').bootstrapToggle('disable');
                $('#c3').bootstrapToggle('disable');
                $('#c4').bootstrapToggle('enable');
                $('#c5').bootstrapToggle('enable');
                break;
            case 100:
                $('#c1').bootstrapToggle('disable');
                $('#c2').bootstrapToggle('disable');
                $('#c3').bootstrapToggle('disable');
                $('#c4').bootstrapToggle('disable');
                $('#c5').bootstrapToggle('enable');
                break;
            default:
                $('#c1').bootstrapToggle('enable');
                $('#c2').bootstrapToggle('disable');
                $('#c3').bootstrapToggle('disable');
                $('#c4').bootstrapToggle('disable');
                $('#c5').bootstrapToggle('disable');
                break;
        }
    }




    $('#c1').on('change', function() {
        var current = $('.progress-bar').attr('aria-valuenow');
        var newVal = $(this).attr('value')

        if (document.getElementById('c1').checked) {

            valeur = parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        } else {

            valeur = parseInt(current, 10) - parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        }
        disableButton();
    });
    $('#c2').on('change', function() {
        var current = $('.progress-bar').attr('aria-valuenow');
        var newVal = $(this).attr('value')

        if (document.getElementById('c2').checked) {

            valeur = parseInt(current, 10) + parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        } else {

            valeur = parseInt(current, 10) - parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        }
        disableButton();
    });
    $('#c3').on('change', function() {
        var current = $('.progress-bar').attr('aria-valuenow');
        var newVal = $(this).attr('value')

        if (document.getElementById('c3').checked) {

            valeur = parseInt(current, 10) + parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        } else {

            valeur = parseInt(current, 10) - parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        }
        disableButton();
    });
    $('#c4').on('change', function() {
        var current = $('.progress-bar').attr('aria-valuenow');
        var newVal = $(this).attr('value')

        if (document.getElementById('c4').checked) {

            valeur = parseInt(current, 10) + parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        } else {

            valeur = parseInt(current, 10) - parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        }
        disableButton();
    });
    $('#c5').on('change', function() {
        var current = $('.progress-bar').attr('aria-valuenow');
        var newVal = $(this).attr('value')

        if (document.getElementById('c5').checked) {

            valeur = parseInt(current, 10) + parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        } else {

            valeur = parseInt(current, 10) - parseInt(newVal, 10);
            $('.progress-bar').css('width', valeur + '%').attr('aria-valuenow', valeur).text('TOTAL PROGRESS : ' + valeur + ' %');
        }
        disableButton();
    });
});