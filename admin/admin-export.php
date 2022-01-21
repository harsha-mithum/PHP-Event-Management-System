<?php require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';
include_once 'assets/php/config.php';
$admin = new Admin();

?>

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Export</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="mb-5">
            <hr>
        </div>
        <div class="my-5">
            <h4>Export Details to spreadsheet.</h4>
        </div>
        <div class="row mx-5 mb-3">
            <div class="col-xl-3 col-sm-4 col-12">
                <div class="card border border-dark p-2">
                    <a href="assets/php/admin-action.php?export-users=excel" title="Export Users" class="btn border text-primary shadow-sm  ">
                        <i class="fad fa-file-export"></i><br><span>Export All Users</span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-4 col-12">
                <div class="card border border-dark p-2">
                    <a href="assets/php/admin-action.php?export-staff=excel" title="Export Members" class="btn border text-primary shadow-sm  ">
                        <i class="fad fa-file-export"></i><br><span>Export All Team Members</span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-4 col-12">
                <div class="card border border-dark p-2">
                    <a href="assets/php/admin-action.php?export-packages=excel" title="Export Packages" class="btn border text-primary shadow-sm  ">
                        <i class="fad fa-file-export"></i><br><span>Export All Packages</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="my-5">
            <h4>Export whole Database.</h4>
        </div>
        <div class="row mx-5 mb-3">
            <div class="col-xl-3 col-sm-4 col-12">
                <div class="card border border-dark p-2">

                    <a id="id" href="assets/php/admin-action.php?export-db=sql" title="Export Database" class="btn border text-danger shadow-sm  " id="db">
                        <i class="fad fa-file-export"></i><br><span>Export Database</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

 <!-- <script>
    
    $(document).ready(function() {

        $('body').on('click', '#id', function(e) {
            e.preventDefault();
            var pass = $('#pass').val();


            Swal.fire({
                title: 'Please Enter Password To Continue',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Export',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return fetch(`assets/php/admin-action.php?export-db=sql`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: `${result.value.login}'s avatar`,
                        imageUrl: result.value.avatar_url
                    })
                }
            })

        });
    });
</script> -->





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
<script src="assets/php/js/event-view.js"></script>
<script src="assets/plugins/bootstrap4-toggle-3.6.1/bootstrap4-toggle.min.js"></script>
<script>

</script>

</body>

</html>