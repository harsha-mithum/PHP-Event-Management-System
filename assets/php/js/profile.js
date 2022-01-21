$(document).ready(function() {

    //Profile Update Ajax Request
    $("#profile-update-form").submit(function(e) {
        e.preventDefault();
        $("#edit-profile-spinner").show();
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response) {
                $("#updateAlert").html(response);
                $("#edit-profile-spinner").hide();
                Swal.fire(
                        'Updated!',
                        response,
                        'success'
                    ),
                    setTimeout(function() {
                        location.reload();
                        // window.location = 'admin-package.php';
                    }, 2000);

            }
        });
    });


    //Forgot Password Ajax Request
    $("#forgot-btn").click(function(e) {
        if ($("#forgot-form")[0].checkValidity()) {
            e.preventDefault();
            $("#forgot-spinner").show();
            $.ajax({
                url: 'assets/php/action.php',
                method: 'post',
                data: $("#forgot-form").serialize() + '&action=forgot',
                success: function(response) {
                    $("#forgot-spinner").hide();
                    $("#forgot-form")[0].reset();
                    $("#forgotAlert").html(response);

                }
            });
        }
    });

    //Delete Account Ajax Request
    $("#delete-btn").click(function(e) {
        if ($("#delete-form")[0].checkValidity()) {
            e.preventDefault();
            $("#delete-spinner").show();
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: $("#delete-form").serialize() + '&action=delete_account',
                success: function(response) {
                    $("#delete-spinner").hide();
                    $("#delete-form")[0].reset();
                    $("#deleteAlert").html(response);
                    Swal.fire(
                            'Deleting!',
                            response,
                            'success'
                        ),
                        setTimeout(function() {
                            //location.reload();
                            window.location = 'assets/php/logout.php';
                        }, 2000);
                }
            });
        }
    });


    //Change password Ajax Request
    $("#changePassBtn").click(function(e) {
        if ($("#change-pass-form")[0].checkValidity()) {
            e.preventDefault();
            $("#change-pass-spinner").show();
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: $("#change-pass-form").serialize() + '&action=change_pass',
                success: function(response) {
                    $("#changePassError").html(response);
                    $("#change-pass-spinner").hide();
                    $("#change-pass-form")[0].reset();
                    Swal.fire(
                            'Updated!',
                            response,
                            'success'
                        ),
                        setTimeout(function() {
                            //location.reload();
                            // window.location = 'admin-package.php';
                        }, 2000);
                }
            });
        }
    });
    //Verify email ajax request
    $("#verify-email").click(function(e) {
        e.preventDefault();
        $(this).text('Please Wait');
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data: { action: 'verify_email' },
            success: function(response) {
                $("#verifyEmailAlert").html(response);
                $("#verify-email").text('Verify Now!');
            }
        });
    });

    checkNotification();

    function checkNotification() {
        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            data: { action: 'checkNotification' },
            success: function(response) {
                $("#checkNotification").html(response);
            }
        });
    }
});