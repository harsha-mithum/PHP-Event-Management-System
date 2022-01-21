<?php require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';
$admin = new Admin(); ?>



<!-- Page Wrapper -->
<div class="page-wrapper bg-dark">
    <div class="content container-fluid">



        <div class="container ">
            <div class="row justify-content-center">

                <div class="card col-md-10">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Private info</h4>
                    </div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-5 mx-auto px-3 border rounded shadow">

                                <!-- username -->
                                <form action="#" method="post" id="change-name-form">
                                    <div class=" text-muted m-4">
                                        <h5>Change Username</h5>
                                    </div>
                                    <div id="changeUserError"></div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-4 col-form-label">Username</label>
                                        <div class="col-sm-8">
                                            <input name="username" type="text" class="form-control" id="username" placeholder="Username" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="curPass" class="col-sm-4 col-form-label">Current Password</label>
                                        <div class="col-sm-8">
                                            <input name="curPass" type="password" class="form-control" id="curPass" placeholder="Current Password" aria-describedby="curPass" required>
                                            <small id="curPass" class="text-muted text-right">*required for verification</small>
                                        </div>
                                    </div>
                                    <button type="submit" name="change_username" class="btn btn-primary btn-block" id="changeUserBtn">Save Changes&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="change-name-spinner"></span></button>
                                </form>
                            </div>
                            <div class="col-5 mx-auto px-3 border rounded shadow">
                                <!-- password -->
                                <form action="#" method="post" id="change-pass-form">
                                    <div class=" text-muted m-4">
                                        <h5>Change Password</h5>
                                    </div>
<div id="changePassError"></div>
                                    <div class="form-group row mb-5">
                                        <label for="curPass" class="col-sm-4 col-form-label">Current Password</label>
                                        <div class="col-sm-8">
                                            <input name="curPass" type="password" class="form-control" id="curPass" placeholder="Current Password" aria-describedby="curPass" required>
                                            <small id="curPass" class="text-muted text-right">*required for verification</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="newPass" class="col-sm-4 col-form-label">New Password</label>
                                        <div class="col-sm-8">
                                            <input name="newPass" type="password" class="form-control pr-password" id="newPass" placeholder="New Password" minlength="8" maxlength="20" required>
                                            <small id="newPass" class="text-muted text-right">Must be 8-20 characters long.</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confPass" class="col-sm-4 col-form-label">Confirm Password</label>
                                        <div class="col-sm-8">
                                            <input name="confPass" type="password" class="form-control " id="confPass" placeholder="Confirm Password" minlength="8" maxlength="20" required>
                                        </div>
                                    </div>
                                    <button type="submit" name="change_pass_admin" class="btn btn-primary mb-3 btn-block" id="changePassBtn">Save Changes&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="change-pass-spinner"></span></button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








    </div>
</div>










<!-- jQuery -->
<script src="assets/js/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Datatables JS -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/datatables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<!-- Custom JS -->
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>


<script src="assets/js/script.js"></script>
<script src="assets/js/validation.js"></script>
<script src="assets/js/jquery.passwordRequirements.min.js"></script>

<script src="assets/php/js/profile.js"></script>


<script>
    $(document).ready(function() {
        $(".pr-password").passwordRequirements();
    });
</script>

</body>

</html>