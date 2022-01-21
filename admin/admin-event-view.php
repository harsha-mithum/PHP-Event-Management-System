<?php require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';
$admin = new Admin(); ?>

<?php
//Handle view event ajax request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $admin->fetchEventDetailsById($id);

    if ($data) {

        $id = $data['id'];
        $title = $data['title'];
        $location = $data['location'];
        $date = $data['start_date'];
        $time = $data['time'];
        $guest = $data['people'];
        $type = $data['type'];
        $package = $data['package'];
        $cameramen = $data['cameramen'];
        $user_id = $data['user_id'];
        $user_name = $data['user_name'];
        $user_address = $data['user_address'];
        $user_phone = $data['user_phone'];
        $user_email = $data['user_email'];
    } else {
        echo '<div class="page-wrapper"><div class="p-5"><h1 class="mt-5 text-center">No Event Details Available!</h1> </div></div>';
    }
}

?>
<style>
    .image_area {
        position: relative;
    }

    .overlay {
        position: absolute;
        bottom: 0px;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        overflow: hidden;
        height: 0;
        transition: .3s ease;
        width: 100%;
        z-index: 99;
    }

    .image_area:hover .overlay {
        padding-top: 10%;
        height: 40%;
        cursor: pointer;
        
    }

    a {
        cursor: pointer;
    }

    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 20rem;
    }

    .toggle.ios .toggle-handle {
        border-radius: 20rem;
    }
</style>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/plugins/bootstrap4-toggle-3.6.1/bootstrap4-toggle.min.js"></script>
<input type="hidden" id="event_id" name="event_id" value="<?= $id ?>">

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
        <div class="row">
            <div class="col-9">
                <div class="tab-content" id="nav-tabContent">
                    <!-- Event Details -->
                    <div class="tab-pane fade" id="list-details" role="tabpanel" aria-labelledby="list-details-list">
                        <div class="col-sm-12 border rounded m-3 p-5 bg-white shadow" id="eventDetails">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="mb-5">Event Details</h4>
                                    <dl class="row">
                                        <dt class="col-sm-4">Title</dt>
                                        <dd class="col-sm-8">
                                            <p id="etitle"><?= $title; ?></p>
                                        </dd>

                                        <dt class="col-sm-4">Location</dt>
                                        <dd class="col-sm-8">
                                            <p id="elocation"><?= $location; ?></p>
                                        </dd>

                                        <dt class="col-sm-4">Event Date</dt>
                                        <dd class="col-sm-8">
                                            <p id="edate"><?= $date; ?></p>
                                        </dd>

                                        <dt class="col-sm-4">Event Time</dt>
                                        <dd class="col-sm-8">
                                            <p id="etime"><?= $time; ?></p>
                                        </dd>

                                        <dt class="col-sm-4">Guest Count</dt>
                                        <dd class="col-sm-8">
                                            <p id="eguest"><?= $guest; ?></p>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-6">
                                    <h4 class="mb-5">Event Details</h4>
                                    <dl class="row">
                                        <dt class="col-sm-4">Event Type</dt>
                                        <dd class="col-sm-8">
                                            <p id="etype"><?= $type; ?></p>
                                        </dd>

                                        <dt class="col-sm-4">Package</dt>
                                        <dd class="col-sm-8">
                                            <p id="epackage"><?= $package; ?></p>
                                        </dd>

                                        <dt class="col-sm-4">Cameramen</dt>
                                        <dd class="col-sm-8">
                                            <p id="edate"><?= $cameramen; ?></p>
                                        </dd>

                                    </dl>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Event Progress -->
                    <div class="tab-pane fade show active" id="list-progress" role="tabpanel" aria-labelledby="list-progress-list">


                        <div id="progressAlert"></div>

                        <div class="progressbar" id="progressbar">
                            <div class="progress" id="progressbar" style="height:2rem">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning text-dark" style="width:0%;height:2rem;background-color:chartreuse !important" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">TOTAL PROGRESS: 0%</div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row col-sm-8 mx-auto">
                            <table class="table p-3 text-justify">
                                <tbody class="align-middle">
                                    <tr>
                                        <th scope="row">
                                            <h4>Shooting</h4>
                                        </th>
                                        <td class="text-right"><input name="c1" id="c1" class="progress" type="checkbox" value="20" data-toggle="toggle" data-on="COMPLETED!" data-off="PROCESSING" data-onstyle="success" data-offstyle="outline-danger" data-size="sm"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h4>Pre-Processing</h4>
                                        </th>
                                        <td class="text-right"><input name="c2" id="c2" class="progress" type="checkbox" value="20" data-toggle="toggle" data-on="COMPLETED!" data-off="PROCESSING" data-onstyle="success" data-offstyle="outline-danger" data-size="sm"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h4>Re-Touching</h4>
                                        </th>
                                        <td class="text-right"><input name="c3" id="c3" class="progress" type="checkbox" value="20" data-toggle="toggle" data-on="COMPLETED!" data-off="PROCESSING" data-onstyle="success" data-offstyle="outline-danger" data-size="sm"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h4>Post-Processing</h4>
                                        </th>
                                        <td class="text-right"><input name="c4" id="c4" class="progress" type="checkbox" value="20" data-toggle="toggle" data-on="COMPLETED!" data-off="PROCESSING" data-onstyle="success" data-offstyle="outline-danger" data-size="sm"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h4>Album</h4>
                                        </th>
                                        <td class="text-right"><input name="c5" id="c5" class="progress" type="checkbox" value="20" data-toggle="toggle" data-on="COMPLETED!" data-off="PROCESSING" data-onstyle="success" data-offstyle="outline-danger" data-size="sm"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="input-group m-3 mx-auto col-6">
                                <input class="btn btn-primary btn-block" type="submit" value="Save" id="progressSubmit">
                            </div>
                        </div>


                    </div>

                    
                    <div class="tab-pane fade " id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>


                    <!-- Event Album -->
                    <div class="tab-pane fade " id="list-album" role="tabpanel" aria-labelledby="list-album-list">

                        <div class="container row">

                            <div class="col-xl-3 col-sm-4 col-12">
                                <div class="card border border-info">
                                    <a title="Create a Album" data-toggle="modal" data-target="#ModalCreateForm" class="btn text-info shadow-sm  albumCreateIcon ">
                                        <i class="fad fa-5x fa-plus m-4 p-2"></i><br><span>Create</span>
                                    </a>
                                </div>
                            </div>
                            <div class=" col-sm-8 ">
                                <div class="card border border-info p-3">
                                    <p>Create an album to upload pictures of this event.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="container row " id="showAllAlbums">
                    </div>

                    <!-- Contact Details -->
                    <div class="tab-pane fade" id="list-contact" role="tabpanel" aria-labelledby="list-contact-list">
                        <div class="col-sm-12 border rounded m-3 p-5 bg-white shadow" id="contactDetails">
                            <h4 class="mb-5">Contact Information</h4>
                            <dl class="row">
                                <dt class="col-sm-3">Full Name</dt>
                                <dd class="col-sm-8">
                                    <p id="euser_name"><?= $user_name; ?></p>
                                </dd>

                                <dt class="col-sm-3">Email</dt>
                                <dd class="col-sm-8">
                                    <p id="euser_email"><?= $user_email; ?></p>
                                </dd>

                                <dt class="col-sm-3">Mobile Number</dt>
                                <dd class="col-sm-8">
                                    <p id="euser_phone"><?= $user_phone; ?></p>
                                </dd>

                                <dt class="col-sm-3">Address</dt>
                                <dd class="col-sm-8">
                                    <address id="euser_address"><?= $user_address; ?></address>
                                </dd>

                            </dl>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-3 mt-5">
                <div class="list-group border bg-secondary rounded p-3 bg" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-progress-list" data-toggle="list" href="#list-progress" role="tab" aria-controls="progress" onclick="hideAlbum()">Progress</a>
                    <a class="list-group-item list-group-item-action" id="list-album-list" data-toggle="list" href="#list-album" role="tab" aria-controls="album" onclick="showAlbum()">Album</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages" onclick="hideAlbum()">Messages</a>
                    <a class="list-group-item list-group-item-action" id="list-details-list" data-toggle="list" href="#list-details" role="tab" aria-controls="details" onclick="hideAlbum()">Details</a>
                    <a class="list-group-item list-group-item-action" id="list-contact-list" data-toggle="list" href="#list-contact" role="tab" aria-controls="contact" onclick="hideAlbum()">Contact Info</a>
                </div>
            </div>
        </div>


        <div class="mb-5">
            <hr>
        </div>

    </div>
</div>

</div>
</div>
<!-- /.Page Wrapper -->



<!-- Edit Modal HTML Markup -->
<div id="albumEditModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" method="POST" action="" id="album-update-form" enctype='multipart/form-data'>
                <div class="modal-header">
                    <h4 class="modal-title" id="editTitle">Edit Album</h4>
                </div>

                <div class="modal-body">

                    <div class="container row">
                        <div class="col-md-6">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" id="album_up_id" name="album_up_id">
                            <input type="hidden" name="edit_id" id="edit_id" value="<?= $id ?>">
                            <input type="hidden" name="oldImage" id="oldImage">
                            <input type="hidden" name="oldName" id="oldName" value="">


                            <div id="editAlert"></div>

                            <div class="form-group">
                                <label class="control-label">Album Name or Title </label>
                                <div>
                                    <input type="text" class="form-control input-lg" id="alb_up_name" name="alb_up_name" value="" required>
                                </div>
                            </div>

                            <h6>Upload Cover Image!</h6>
                            <div class="form-group">
                                <div class="custom-file">


                                    <label for="fileUploadEdit" class="custom-file-label">Upload Image</label>
                                    <input accept="image/*" type="file" class="form-control custom-file-input" name="edit_image" id="fileUploadEdit">

                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <h5>Preview Cover Image!</h5>

                            <br><br><br>
                            <div class="m-3 border w-50  d-flex align-items-center">
                                <div id="image-holder-edit" class="form-group">
                                    <img src="" alt="" class="w-100" id="editImagePre">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer form-group">
                    <button onclick="$('#album-update-form')[0].reset();" type="reset" class="btn btn-secondary" data-dismiss="modal" id="resetBtn">Cancel</button>
                    <button type="submit" name="updateBtn" id="updateBtn" class="col-2 btn btn-block btn-primary">Create<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="update-album-spinner"></span></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Create Modal HTML Markup -->
<div id="ModalCreateForm" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" method="POST" action="" id="album-create-form" enctype='multipart/form-data'>
                <div class="modal-header">
                    <h4 class="modal-title">Create a Album</h4>
                </div>

                <div class="modal-body">
                    <div class="container row">
                        <div class="col-6">

                            <div id="submitAlert"></div>
                            <input type="hidden" id="event_id" name="event_id" value="<?= $id ?>">

                            <div class="form-group">
                                <label class="control-label">Album Name or Title </label>
                                <div>
                                    <input type="text" class="form-control input-lg" name="alb_name" value="" required>
                                </div>
                            </div>
                            <br><br><br>
                            <h6>Upload Album Cover!</h6><br>

                            <div class="form-group">
                                <div class="custom-file">
                                    <label for="fileUpload" class="custom-file-label">Upload Image</label>
                                    <input accept="image/*" type="file" class="form-control custom-file-input" name="alb_cover" id="fileUpload" required>
                                </div>
                            </div>

                        </div>
                        <div class="col-6 ">
                            <div class="my-3 border w-100 h-75 d-flex align-items-center">
                                <div id="image-holder" class="form-group">
                                    <img src="assets/img/placeholder.jpg" alt="" class="w-100" id="uploadImage">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer form-group">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal" name="resetBtn" id="resetBtn">Cancel</button>
                        <button type="submit" name="createBtn" id="createBtn" class="col-2 btn btn-block btn-primary">Create<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="create-album-spinner"></span></button>
                    </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<!-- jQuery -->
<!-- <script src="assets/js/jquery-3.2.1.min.js"></script> -->

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
<!-- <script src="assets/plugins/bootstrap4-toggle-3.6.1/bootstrap4-toggle.min.js"></script> -->
<script>
    $("body").on("click", ".albumViewIcon", function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        window.open("admin-album.php?id=" + id + " ", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=960,height=600");
    });


    function hideAlbum() {
        $('#showAllAlbums').hide();
    }

    function showAlbum() {
        setTimeout(function() {
            $("#showAllAlbums").show();
        }, 0);
    }
</script>

</body>

</html>