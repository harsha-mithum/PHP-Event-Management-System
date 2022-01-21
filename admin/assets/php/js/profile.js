$(document).ready(function() {

    fetchDetails();


    //Fetch Details
    function fetchDetails() {

        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAdminDetails' },
            success: function(response) {
                data = JSON.parse(response);


            }
        });
    }


    //Change password Ajax Request
    $("#changePassBtn").click(function(e) {
        if ($("#change-pass-form")[0].checkValidity()) {
            e.preventDefault();
            $("#change-pass-spinner").show();
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: $("#change-pass-form").serialize() + '&action=change_pass_admin',
                success: function(response) {
                    $("#changePassError").html(response);
                    $("#change-pass-spinner").hide();
                    $("#change-pass-form")[0].reset();
                    let timerInterval;
                    Swal.fire({
                        title: 'Auto close alert!',
                        html: 'Logout in <b></b> milliseconds.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                }
            });
        }
    });

    //Change username Ajax Request
    $("#changeUserBtn").click(function(e) {
        if ($("#change-name-form")[0].checkValidity()) {
            e.preventDefault();
            $("#change-name-spinner").show();
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: $("#change-name-form").serialize() + '&action=change_username',
                success: function(response) {
                    $("#changeUserError").html(response);
                    $("#change-name-spinner").hide();
                    $("#change-name-form")[0].reset();

                }

            });
        }
    });

});