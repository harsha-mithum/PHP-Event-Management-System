<?php require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';
$count = new Admin(); ?>

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Event Types</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Event Types -->

        <!-- Event Type -->

        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Event Types</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive" id="showAllTypes">
                            <h4 class="text-center text-lead mt-2">Please Wait...</h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-5 col-md-4 col-lg-3">
                <div class="card" id="createEventType">
                    <div class="card-header">
                        <h4 class="card-title text-center">Add Event Type</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="type-create-form">
                            <div class="form-group">
                                <label class="control-label">Select a Event Category</label>
                                <select class="custom-select" id="" name="event_cat" required>
                                    <?php foreach ($count->fetchAllCat() as $row) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        echo "<option value=$id>$name</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="typeName">Event Type</label>
                                <input type="text" class="form-control" id="typeName" name="typeName" required>
                            </div>
                            <div class="modal-footer form-group">
                                <button type="submit" name="createBtn" id="createBtn" class="btn btn-block btn-primary">Add<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="create-type-spinner"></span></button>
                                <button type="reset" class="btn btn-secondary" name="resetBtn" id="resetBtn">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card" id="editEventType">
                    <div class="card-header">
                        <h4 class="card-title text-center">Edit Event Type</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="type-update-form">
                            <input type="hidden" name="editTypeID" id="editTypeID">
                            <div class="form-group">
                                <label class="control-label">Select a Event Category</label>
                                <select class="custom-select" id="editEventTypeCat" name="edit_event_cat" required>
                                    <?php foreach ($count->fetchAllCat() as $row) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        echo "<option value=$id>$name</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="typeName">Event Type</label>
                                <input type="text" class="form-control" id="editTypeName" name="editTypeName" required>
                            </div>
                            <div class="modal-footer form-group">
                                <button type="submit" name="updateBtn" id="updateBtn" class="btn btn-block btn-primary">Update<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="update-type-spinner"></span></button>
                                <button type="reset" class="btn btn-secondary" name="resetBtn" id="resetBtn" onclick="$('#editEventType').hide();$('#createEventType').show();">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Event Category -->

        <div class="mb-5">
            <hr>
        </div>

        <div class="row justify-content-center">


            <div class="col-sm-5 col-md-4 col-lg-3">
                <div class="card" id="createEventCat">
                    <div class="card-header">
                        <h4 class="card-title text-center">Add Event Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="cat-create-form">
                            <div class="form-group">
                                <label for="catName">Event Category</label>
                                <input type="text" class="form-control" id="catName" name="catName" required>
                            </div>
                            <div class="modal-footer form-group">
                                <button type="submit" name="createBtn" id="createBtn" class="btn btn-block btn-primary">Add<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="create-cat-spinner"></span></button>
                                <button type="reset" class="btn btn-secondary" name="resetBtn" id="resetBtn">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card" id="editEventCat">
                    <div class="card-header">
                        <h4 class="card-title text-center">Edit Event Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="cat-update-form">
                            <input type="hidden" name="editCatID" id="editCatID">
                            <div class="form-group">
                                <label for="catName">Event Category</label>
                                <input type="text" class="form-control" id="editCatName" name="editCatName" required>
                            </div>
                            <div class="modal-footer form-group">
                                <button type="submit" name="updateBtn" id="updateBtn" class="btn btn-block btn-primary">Update<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="update-cat-spinner"></span></button>
                                <button type="reset" class="btn btn-secondary" name="resetBtn" id="resetBtn" onclick="$('#editEventCat').hide();$('#createEventCat').show();">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Event Category</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive" id="showAllCat">
                            <h4 class="text-center text-lead mt-2">Please Wait...</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Event Types -->
    </div>
</div>
<!-- /Page Wrapper -->


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

<!-- Custom JS -->
<script src="assets/js/script.js"></script>

<script src="assets/php/js/event_cat_type.js"></script>

</body>

</html>