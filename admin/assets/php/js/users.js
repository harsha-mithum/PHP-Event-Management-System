$(document).ready(function() {

    fetchAllUsers();
    fetchAllStaff();
    fetchAllDeletedUsers();

    //fetch all users
    function fetchAllUsers() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllUsers' },
            success: function(response) {
                $("#showAllUsers").html(response);
                if ($('.datatable').length > 0) {
                    $('.datatable').DataTable({
                        "bFilter": true,
                        "order": [
                            [0, "asc"]
                        ]
                    });
                }
            }
        });
    }

    //fetch all Staff users
    function fetchAllStaff() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllStaff' },
            success: function(response) {
                $("#showAllStaff").html(response);
                if ($('.datatable-3').length > 0) {
                    $('.datatable-3').DataTable({
                        "bFilter": true,
                        "order": [
                            [6, "asc"]
                        ]
                    });
                }
            }
        });
    }

    //fetch all deleted users
    function fetchAllDeletedUsers() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllDeletedUsers' },
            success: function(response) {
                $("#showAllDeletedUsers").html(response);
                if ($('.datatable-2').length > 0) {
                    $('.datatable-2').DataTable({
                        "bFilter": true,
                        "order": [
                            [0, "asc"]
                        ]
                    });
                }
            }
        });
    }

    //Fetch user details
    $("body").on("click", ".userDetailsIcon", function(e) {
        e.preventDefault();
        details_id = $(this).attr('id');
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { details_id: details_id },
            success: function(response) {
                data = JSON.parse(response);
                $("#getName").text(data.name + ' ' + '(ID: ' + data.id + ')');
                $("#getEmail").text('Email : ' + data.email);
                $("#getPhone").text('Phone : ' + data.phone);
                $("#getDob").text('DOB : ' + data.dob);
                $("#getGender").text('Gender : ' + data.gender);
                $("#getCreated").text('Joined On : ' + data.created_at);
                $("#getVerified").text('Verified : ' + data.verified);
                $("#getAddress").text('Address : ' + data.address + ', ' + data.city + ', ' + data.state + ' - ' + data.zip_code + ', ' + data.country + '.');

                if (data.photo != '') {
                    $("#getImage").html('<img src="../assets/php/' + data.photo + '" class="img-fluid align-self-center" width="280px">');
                } else {
                    $("#getImage").html('<img src="../assets/img/profiles/avatar.png" class="img-fluid align-self-center" width="280px">');
                }
                if (data.verified == 1) {
                    $("#getVerified").text('Verified : ' + 'Verified');
                } else {
                    $("#getVerified").text('Verified : ' + 'Not Verified');;
                }
            }
        });
    });
    //Edit Package details
    $("body").on("click", ".staffEditIcon", function(e) {
        e.preventDefault();
        staff_des_edit_id = $(this).attr('id');
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { staff_des_edit_id: staff_des_edit_id },
            success: function(response) {
                data = JSON.parse(response);
                $("#edit_id").val(data.id);
                $("#edit_designation").val(data.designation);

            }
        });
    });
    //Update Designation
    $("#staff-designation-form").submit(function(e) {
        e.preventDefault();
        $("#update-package-spinner").show();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response) {
                $("#update-package-spinner").hide();
                Swal.fire({
                    title: 'Designation Updated Successfully.',
                    icon: 'success'
                });
                setTimeout(function() {
                    location.reload()
                        //	window.location = 'admin-package.php';
                }, 2000);
            }
        });
    });



    //Delete user ajax reqest
    $("body").on("click", ".userDeleteIcon", function(e) {
        e.preventDefault();
        delete_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "User will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { delete_id: delete_id },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'User Deleted Successfully.',
                            'success'
                        )

                        fetchAllUsers();
                        fetchAllStaff();
                        fetchAllDeletedUsers();
                    }
                });
                setTimeout(function() {
                    location.reload()
                        //	window.location = 'admin-package.php';
                }, 1500);
            }
        });
    });
    //Permanent Delete user ajax reqest
    $("body").on("click", ".userDeleteIcon2", function(e) {
        e.preventDefault();
        del_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { del_id: del_id },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'User Permanently Deleted.',
                            'success'
                        )

                        fetchAllUsers();
                        fetchAllStaff();
                        fetchAllDeletedUsers();
                    }
                });
                setTimeout(function() {
                    location.reload()
                        //	window.location = 'admin-package.php';
                }, 1500);

            }
        });
    });



    //Restore Deleted user ajax reqest
    $("body").on("click", ".restoreUserIcon", function(e) {
        e.preventDefault();
        restore_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure want to restore this user?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Restore it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { restore_id: restore_id },
                    success: function(response) {
                        Swal.fire(
                            'Restored!',
                            'User Restored Successfully.',
                            'success'
                        )

                        fetchAllUsers();
                        fetchAllStaff();
                        fetchAllDeletedUsers();
                    }
                });
            }
        });

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
                        Swal.fire(
                            'Added!',
                            'User Added Successfully.',
                            'success'
                        ), setTimeout(function() {
                            //location.reload()
                            window.location = 'admin-users.php';
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

    //Register Team Ajax Request
    $("#register-btn-staff").click(function(e) {
        if ($("#register-form-staff")[0].checkValidity()) {
            e.preventDefault();
            $("#register-staff-spinner").show();

            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: $("#register-form-staff").serialize() + '&action=register-staff',
                success: function(response) {
                    $("#register-user-spinner").hide();
                    if (response === 'register-staff') {

                        $("#regAlert-user").html(response);
                        Swal.fire(
                            'Added!',
                            'User Added Successfully.',
                            'success'
                        ), setTimeout(function() {
                            //location.reload()
                            window.location = 'admin-users.php';
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