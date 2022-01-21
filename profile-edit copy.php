<?php require_once 'assets/php/user-header.php'; ?>

<?php

//upload.php

if(isset($_POST['image']))
{
	$data = $_POST['image'];

	////data:image/png;base64,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

	$image_array_1 = explode(";", $data);

	//base64,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

	$image_array_2 = explode(",", $image_array_1[1]);

	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

	$data = base64_decode($image_array_2[1]);

	$image_name = 'upload/' . time() . '.png';

	file_put_contents($image_name, $data);

	echo $image_name;
}

?>


<!-- Page Wrapper -->
<div class="content container">

    


    <div class="row mt-5 pt-5">
        <div class="col-md-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image border border-muted shadow rounded-circle p-2">
                        <div id="image_area">
                            <a href="#">
                                <?php if (!$cphoto) : ?>
                                    <img class="rounded-circle" alt="User Image" src="assets/img/profiles/avatar.png" id="userImage">
                                <?php else : ?>
                                    <img class="img-responsive rounded-circle" alt="User Image" src="<?= 'assets/php/' . $cphoto; ?>" id="userImage">
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <div class="col ml-md-n2 profile-user-info">
                        <h1 class="user-name mb-0"><?= $cname; ?></h1>

                        <?php if ($cemail) : ?>
                            <div class="user-Location">
                                <?= $role; ?> : <?= $cid; ?><br>
                                <?= $cemail; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Image Before Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-sm-7">
                                <img src="" id="sample_image" />
                            </div>
                            <div class="col-sm-4 ml-5">
                                <div class="preview mx-auto"></div>
                                <div>
                                    <p>Your profile picture will be shown like this</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop" class="btn btn-primary">Crop</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="page-header m-3">
        <div class="row">
            <div class="col">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
                    <li class="breadcrumb-item active">Profile Edit</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="container p-0">
        <div class="row">
            <div class="col-md-5 col-xl-4 mt-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    <div class="list-group list-group-flush " role="tablist">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
                            Password
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#delete" role="tab">
                            Delete account
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-xl-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">



                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Private info</h5>
                            </div>
                            <div class="card-body">
                                <form action="#" method="post" enctype="multipart/form-data" id="profile-update-form">
                                    <input type="hidden" name="oldimage" value="<?= $cphoto; ?>">
                                    <div class="row form-row">
                                    <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="profilePhoto">Upload Profile Image</label>
                                                <input type="file" class="form-control" name="image" id="profilePhoto">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Full Name</label>
                                                <input type="text" class="form-control" name="name" id="name" value="<?= $cname; ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" name="gender" id="gender">
                                                    <option value="" disabled <?php if ($cgender == null) {
                                                                                    echo 'selected';
                                                                                } ?>>Select Gender</option>
                                                    <option value="Male" <?php if ($cgender == 'Male') {
                                                                                echo 'selected';
                                                                            } ?>>Male</option>
                                                    <option value="Female" <?php if ($cgender == 'Female') {
                                                                                echo 'selected';
                                                                            } ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="dob">Date of Birth</label>
                                                <input type="date" name="dob" id="dob" value="<?= $cdob; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="phone">Mobile</label>
                                                <input type="number" name="phone" id="phone" value="<?= $cphone; ?>" class="form-control" placeholder="Mobile">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Address</span></h5>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control" value="<?= $address; ?>" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" name="city" id="city" class="form-control" value="<?= $city; ?>" placeholder="City">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <button type="submit" name="profile_update" class="btn btn-primary btn-block" id="profileUpdateBtn">Save Changes&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="edit-profile-spinner"></span></button>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>

                                <div class="col-md-10 col-lg-6">
                                    <form action="#" method="post" id="change-pass-form">
                                        <div class="form-group">
                                            <label for="curpass">Current Password</label>
                                            <input type="password" class="form-control" name="curpass" id="curpass" required minlength="6">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpass">New Password</label>
                                            <input type="password" class="form-control" name="newpass" id="newpass" required minlength="6">
                                        </div>
                                        <div class="form-group">
                                            <label for="cneewpass">Confirm Password</label>
                                            <input type="password" class="form-control" name="cnewpass" id="cnewpass" required minlength="6">
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="changepass" id="changePassBtn">Save Changes&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="change-pass-spinner"></span></button>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6" style="margin-top: 125px;">
                                    <div id="changePassError"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="delete" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Delete Account</h5>

                                <form>
                                    <div class="form-group">
                                        <label for="inputPasswordCurrent">Current password</label>
                                        <input type="password" class="form-control" id="inputPasswordCurrent">
                                        <small><a href="#">Forgot your password?</a></small>
                                    </div>
                                    <p>This will permanently delete your account and not be able to log in again.</p>
                                    <button type="submit" class="btn btn-danger">Delete Account</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Edit Details Modal -->
    <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Personal Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" enctype="multipart/form-data" id="profile-update-form">
                        <input type="hidden" name="oldimage" value="<?= $cphoto; ?>">
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="profilePhoto">Upload Profile Image</label>
                                    <input type="file" class="form-control" name="image" id="profilePhoto">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $cname; ?>">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="" disabled <?php if ($cgender == null) {
                                                                        echo 'selected';
                                                                    } ?>>Select Gender</option>
                                        <option value="Male" <?php if ($cgender == 'Male') {
                                                                    echo 'selected';
                                                                } ?>>Male</option>
                                        <option value="Female" <?php if ($cgender == 'Female') {
                                                                    echo 'selected';
                                                                } ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" name="dob" id="dob" value="<?= $cdob; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Mobile</label>
                                    <input type="number" name="phone" id="phone" value="<?= $cphone; ?>" class="form-control" placeholder="Mobile">
                                </div>
                            </div>
                            <div class="col-12">
                                <h5 class="form-title"><span>Address</span></h5>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="<?= $address; ?>" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" class="form-control" value="<?= $city; ?>" placeholder="City">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state" class="form-control" value="<?= $state; ?>" placeholder="State">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="zipcode">Zip Code</label>
                                    <input type="number" name="zipcode" id="zipcode" class="form-control" value="<?= $zipcode; ?>" placeholder="Zip Code">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" id="country" class="form-control" value="<?= $country; ?>" placeholder="Country">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="profile_update" class="btn btn-primary btn-block" id="profileUpdateBtn">Save Changes&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="edit-profile-spinner"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Details Modal -->
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->



<!-- jQuery -->
<script src="assets/js/bootstrap-4/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="assets/js/bootstrap-4/popper.min.js"></script>
<script src="assets/js/bootstrap-4/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/bootstrap-4/script.js"></script>
<script src="assets/php/js/profile.js"></script>

<script>
    $(document).ready(function() {

        var $modal = $('#modal');

        var image = document.getElementById('sample_image');

        var cropper;

        $('#profilePhoto').change(function(event) {
            var files = event.target.files;

            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });

        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function() {
			canvas = cropper.getCroppedCanvas({
				width: 400,
				height: 400
			});

			canvas.toBlob(function(blob) {
				url = URL.createObjectURL(blob);
				var reader = new FileReader();
				reader.readAsDataURL(blob);
				reader.onloadend = function() {
					var base64data = reader.result;
					$.ajax({
						url: 'profile-edit.php',
						method: 'POST',
						data: {
							image: base64data
						},
						success: function(data) {
							$modal.modal('hide');
							$('#userImage').attr('src', data);
						}
					});
				};
			});
		});

    });
</script>
</body>

<!-- Mirrored from dreamguys.co.in/demo/ventura/profile.html by HTTrack Website Copier/3.x [XR&CO'2017], Sat, 18 Apr 2020 05:51:42 GMT -->

</html>