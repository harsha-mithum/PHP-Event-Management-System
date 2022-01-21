$(document).ready(function() {


    fetchAllEvents();
    fetchAllEventsUn();



    //fetch all events
    function fetchAllEvents() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllEvents' },
            success: function(response) {
                $("#showAllEvents").html(response);
                if ($('.datatable').length > 0) {
                    $('.datatable').DataTable({
                        "bFilter": true,
                        "stateSave": true,
                        "order": [
                            [0, "asc"],
                            [3, 'desc']
                        ],
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ]
                    });
                }
            }
        });
    }

    //fetch all events
    function fetchAllEventsUn() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllEventsUnpublished' },
            success: function(response) {
                $("#showAllEventsUnpublished").html(response);
                if ($('.datatable-2').length > 0) {
                    $('.datatable-2').DataTable({
                        "emptyTable": "No data available in table",
                        "bFilter": true,
                        "stateSave": true,
                        "order": [
                            [0, "asc"],
                            [3, 'desc']
                        ]
                    });
                }
            }
        });
    }





    // //fetch all users list
    // $('body').on('click', '#refreshBtn', function () {
    //     $.ajax({
    //         url: 'assets/php/admin-action.php',
    //         method: 'post',
    //         data: { action: 'fetchUserList' },
    //         success: function (response) {
    //             $("#userSelect").html(response);
    //         }
    //     });
    // });

    // select option user
    $('body').on('click', '#select_user', function() {
        var id = $('#search_id').val();

        if (id != '0') {
            $.ajax({
                type: 'POST',
                url: 'assets/php/admin-action.php',
                data: { details_id: id },
                success: function(response) {
                    data = JSON.parse(response);
                    $("#uid").val(data.id);
                    $("#uname").val(data.name);
                    $("#uadd").val(data.city);
                    $("#uphone").val(data.phone);
                    $("#uemail").val(data.email);
                }
            });
        } else {
            $("#uid").val('');
            $("#uname").val('');
            $("#uadd").val('');
            $("#uphone").val('');
            $("#uemail").val('');
        }
    });

    //select option package
    $('body').on('change', '#eventType', function() {

        var id = $(this).val();

        if (id != '0') {
            $.ajax({
                type: 'POST',
                url: 'assets/php/admin-action.php',
                data: { package_type_id: id },
                success: function(data) {
                    $("#package").html(data);
                }
            });
        } else {
            $("#package").html('<option value="0" selected>Select Event Type First</option>');
        }
    });



    //Register User Ajax Request
    $("#register-btn-user").click(function(e) {
        if ($("#register-form-user")[0].checkValidity()) {
            e.preventDefault();
            $("#register-user-spinner").show();

            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: $("#register-form-user").serialize() + '&action=register-user',
                success: function(response) {
                    $("#register-user-spinner").hide();
                    if (response === 'register-user') {

                        $("#regAlert-user").html(response);

                        $("#register-form-user")[0].reset();
                        $('#ModalCreateForm').modal('hide');
                        Swal.fire(
                            'Added!',
                            'User Added Successfully.',
                            'success'
                        ), setTimeout(function() {
                            //location.reload()
                            // window.location = 'admin-event.php';

                        }, 1500);

                    } else {
                        $("#regAlert-user").html(response);
                        Swal.fire(
                            'Failed!',
                            response,
                            'error'
                        )
                    }


                }
            });

        }
    });


    // Send Search Text to the server
    $("#search").keyup(function() {
        let searchText = $(this).val();
        if (searchText != "") {
            $.ajax({
                url: "assets/php/admin-action.php",
                method: "post",
                data: {
                    search_user: searchText,
                },
                success: function(response) {
                    $("#show-list").html(response);
                },
            });
        } else {
            $("#show-list").html("");
        }
    });
    // Set searched text in input field on click of search button
    $(document).on("click", ".list-user", function() {
        $("#search").val($(this).text());
        $('#search_id').val($(this).attr('id'));
        $("#show-list").html("");
    });


    //Create Event Ajax Request
    // $("#event-create-form").submit(function (e) {
    //     if ($("#event-create-form")[0].checkValidity()) {
    //         e.preventDefault();
    //         $("#add-event-spinner").show();

    //         $.ajax({
    //             url: 'assets/php/admin-action.php',
    //             method: 'post',
    //             data: $("#event-create-form").serialize() + '&action=create-event',
    //             success: function (response) {
    //                 $("#add-event-spinner").hide();
    //                 if (response === 'success') {

    //                     $("#regAlert-event").html(response);

    //                     $("#event-create-form")[0].reset();
    //                     Swal.fire(
    //                         'Added!',
    //                         'Event Added Successfully.',
    //                         'success'
    //                     ), setTimeout(function () {
    //                         //location.reload()
    //                         // window.location = 'admin-event.php';
    //                     }, 1500);
    //                 } else {
    //                     $("#regAlert-event").html(response);
    //                     Swal.fire(
    //                         'Failed!',
    //                         response,
    //                         'error'
    //                     )
    //                 }
    //             }
    //         });
    //     }
    // });

    //Create Package Ajax Request
    $("#event-create-form").submit(function(e) {
        // if ($("#event-create-form")[0].checkValidity()) {
        e.preventDefault();
        $("#add-event-spinner").show();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            // data: $("#event-create-form").serialize() + '&action=create-event',
            success: function(response) {
                $("#add-event-spinner").hide();
                Swal.fire({
                    title: 'Event Created Successfully.',
                    icon: 'success'
                });
                setTimeout(function() {
                    //location.reload()
                    //	window.location = 'admin-package.php';
                }, 2000);
            }
        });
        //    }
    });

    //check notification ajax request
    checkNotification();

    function checkNotification() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'checkNotification' },
            success: function(response) {
                $("#checkNotification").html(response);
            }
        });
    }



});