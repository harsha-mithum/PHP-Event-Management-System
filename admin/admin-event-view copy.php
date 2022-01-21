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
                        <li class="breadcrumb-item "><a href="admin-event.php">Event</a></li>
                        <li class="breadcrumb-item active">Event-View</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="mb-3">
            <hr>
        </div>

        <div class="container">
            <form action="" method="post" id="event-create-form">
                
                <div class="form-group text-right">
                    <input type="hidden" name="create-event">
                    <button type="reset" name="reset" class="col-sm-3 btn-lg btn-outline-secondary mx-3">Reset</button>
                    <button type="submit" name="submit" class=" col-sm-3 btn-lg btn-primary mx-3"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="add-event-spinner"></span>Add Event</button>
                </div>

                <div class="row justify-content-center">
                    <div id="regAlert-event"></div>

                    <!-- Event Details -->
                    <div class="col-lg-6 border rounded m-3 p-4 bg-white shadow">
                        <h4 class="mb-5">Event Details</h4>
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Event Title" title="Title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-2 col-form-label">Location</label>
                            <div class="col-sm-10">
                                <input type="text" name="location" id="location" class="form-control" placeholder="Event Location" title="Location">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-3"><Label for="date" class="col-form-label">Event Date</Label></div>
                            <div class="col-7"><input class="form-control text-center" type="date" name="date" id="date"></div>
                        </div>

                        <div class="form-group form-row">
                            <div class="col-3"><Label for="time" class="col-form-label">Event Starts</Label></div>
                            <div class="col-7 "><input class="form-control text-center timepicker" type="time" name="time" id="time" placeholder="00:00"></div>
                        </div>

                        <div class="form-group row">
                            <label for="guest" class="col-3 col-form-label">Guest Count</label>
                            <div class="col-7"><input class="form-control" type="number" name="guest" id="guest" min="0" placeholder="No.of Guests" title="Guests"></div>
                        </div>
                    </div>


                    <!-- Event Scope -->
                    <div class="col-lg-5 border rounded m-3 p-3 bg-white shadow">
                        <h4 class="mb-5">Event Scope</h4>

                        <div class="form-group row">
                            <label for="eventType" class="col-sm-4 col-form-label">Event Type</label>
                            <div class="col-sm-8">
                                <select class="custom-select text-center" name="eventType" id="eventType">
                                    <option value="0" selected>Select Event Type</option>
                                    <?php foreach ($count->fetchAllTypes() as $row) {
                                        $id = $row['id'];
                                        $event = $row['name'];
                                        echo "<option value=$id>$event</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="package" class="col-sm-4 col-form-label">Event Package</label>
                            <div class="col-sm-8">
                                <select class="custom-select text-center" name="package" id="package">
                                    <option value="0" selected>Select Event Type First</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cameramen" class="col-sm-4 col-form-label">Event Cameramen Count</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="number" name="cameramen" id="cameramen" min="0" placeholder="Cameramen" aria-describedby="camHelp">
                                <small id="camHelp" class="form-text text-muted text-right">*both Photographer/ Videographer</small>
                            </div>
                        </div>
                    </div>


                    <!-- Contact Details -->
                    <div class="col-lg-6 border rounded m-3 p-3 bg-white shadow" id="contactDetails">
                        <h4 class="mb-5">Contact Information</h4>

                        <div class="input-group">
                            <input type="hidden" id="search_id">
                            <input type="text" name="" id="search" class="form-control form-control-lg rounded-0 border-info" placeholder="Search..." autocomplete="off">
                            <div class="input-group-append">
                                <input type="button" id="select_user" name="" value="Select" class="btn btn-info rounded-0">
                            </div>
                        </div>
                        <div class="shadow mx-auto" style=" position: absolute ;z-index: 99; overflow:auto; width:88%;">
                            <div class="list-group" id="show-list">
                                <!-- Here autocomplete list will be display -->
                            </div>
                        </div>

                        <div class="form-group mt-1 text-right"><a type="button" class="text-info" data-toggle="modal" data-target="#ModalCreateForm">Click here to add a user </a></div>
                        <div class="form-group"><input class="form-control" type="hidden" name="user_id" id="uid" value="" required></div>
                        <div class="form-group"><input class="form-control" type="text" name="user_name" id="uname" placeholder="Full Name" value="" required></div>
                        <div class="form-group"><input class="form-control" type="text" name="user_address" id="uadd" placeholder="Address" value="" required></div>
                        <div class="form-group"><input class="form-control" type="tel" name="user_phone" id="uphone" placeholder="Mobile" value="" required></div>
                        <div class="form-group"><input class="form-control" type="text" name="user_email" id="uemail" placeholder="Email" value="" required></div>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>
</div>
<!-- /.Page Wrapper -->


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


<script src="assets/js/script.js"></script>
<script src="assets/php/js/event-view.js"></script>

<script>

</script>

</body>

</html>