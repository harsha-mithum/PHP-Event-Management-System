<?php require_once 'assets/php/user-header.php'; ?>

<style type='text/css'>

</style>

<!-- Page Wrapper -->
<div class="content container-fluid mt-4 p-5">

	<!-- Page Header -->
	<div class="page-header ">

		<div class="row">
			<div class="col">
				<h3 class="page-title">Profile</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Profile</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->


	<div class="row">
		<div class="col-md-12">
			<div class="profile-header">
				<div class="row ">

					<div class="col-lg-8 col-md-12 ml-lg-n2 profile-user-info">
						<div class="container row  d-flex justify-content-between">
							<div class="col-auto">

								<h1 class="user-name mb-auto"><?= ucwords($cname); ?></h1>

								<?php if ($city) : ?>
									<div class="user-Location">
										<h4><small><i class="fa fa-map-marker"></i></small>&nbsp;&nbsp;<?= $city;  ?></h4>
									</div>
								<?php endif; ?>

							</div>
							<div class="col-auto">
								<a href="profile-edit.php" class="btn btn-info">Edit Details</a>
							</div>

						</div>

						<br>

						<!-- Personal Details -->
						<div class="container row mx-auto">
							<div class="col-md-6">
								<h5 class=" d-flex justify-content-between">
									<span class="my-4">Personal Details:</span>

								</h5>
								<div class="row">
									<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
									<p class="col-sm-9"><?= ucwords($cname); ?></p>
								</div>
								<div class="row">
									<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
									<p class="col-sm-9"><?= $cemail; ?></p>
								</div>
								<div class="row">
									<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
									<p class="col-sm-9"><?= $cphone; ?></p>
								</div>
								<div class="row mb-4">
									<p class="col-sm-3 text-muted text-sm-right mb-0">Address</p>
									<?php if ($address) : ?>
										<address class="col-sm-9 mb-0"><?= $address; ?>,<br>
											<?= $city; ?>.</address>
									<?php endif; ?>
								</div>
							</div>

							<!-- More Info -->
							<div class="col-md-6">
								<h5 class="d-flex justify-content-between">
									<span class="my-4">More Info:</span>
								</h5>
								<div class="row">
									<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
									<p class="col-sm-6"><?= $cdob; ?></p>
								</div>
								<div class="row">
									<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Gender </p>
									<p class="col-sm-6"><?= $cgender; ?></p>
								</div>
								<div class="row" style="margin-bottom: -0.65rem;">
									<p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Registred on</p>
									<p class="col-sm-6"><?= $reg_on; ?></p>
								</div>
							</div>
						</div>


					</div>
					<!-- Usr Image -->
					<div class="col-lg-4 text-center bg-dark m-auto">
						<div class="row justify-content-center m-4">
							<div class="border border-muted shadow rounded-circle p-1 bg-dark" id="userImage">

								<form method="post">

									<?php if (!$cphoto) : ?>
										<div class="image_area ">
											<label for="upload_image">
												<img class="img-responsive w-100 rounded-circle" alt="User Image" src="assets/img/profiles/avatar.png" id="uploaded_image">
												<div class="overlay">
													<div class="text">Change Profile Picture</div>
													<input type="file" name="image" class="image" id="upload_image" style="display:none" />
												</div>
											</label>
										</div>
									<?php else : ?>
										<div class="image_area">
											<label for="upload_image">
												<img class="img-responsive w-100 rounded-circle" alt="User Image" src="<?= 'assets/php/' . $cphoto; ?>" id="uploaded_image">
												<div class="overlay">
													<div class="text">Change Profile Picture</div>
													<input type="file" name="image" class="image" id="upload_image" style="display:none" />
												</div>
											</label>
										</div>
									<?php endif; ?>
								</form>
							</div>

							<!-- Crop Image -->
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
										
											<div class="">
												<div class="row">
													<div class="col-sm-7 ">
														<img src="" id="sample_image" class="" />
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
						</div>
						<div class="row justify-content-center m-4">

							<!-- Account Status -->
							<div class="card col-12 ">
								<div class="card-body ">
									<div class="justify-content-center">
										<h5 class=""><span>E-Mail Verified: </span> </h5>
										<button class="btn btn-success text-center" type="button"><i class="fe fe-check-verified"></i> <?= $verified; ?></button>
										<?php if ($verified == 'Not Verified') : ?>
											<a href="#" id="verify-email" class="float-right pt-2">Verify Now!</a>
										<?php endif; ?>
									</div>

								</div>
							</div>
							<!-- /Account Status -->
						</div>
					</div>


				</div>
			</div>
			<!-- <div class="profile-menu ">
				<ul class="nav nav-tabs nav-tabs-solid">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
					</li>
					<li>

					</li>
				</ul>
			</div> -->
			<div class="tab-content profile-tab-cont">

				<!-- Personal Details Tab -->
				<div class="tab-pane fade show active" id="per_details_tab">


				</div>
				<!-- /Personal Details Tab -->

				<!-- Change Password Tab -->
				<div id="password_tab" class="tab-pane fade">


				</div>
				<!-- /Change Password Tab -->

			</div>
		</div>
	</div>
</div>
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

		$('#upload_image').change(function(event) {
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
				viewMode: 2,
				minContainerHeight:450,
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
						url: 'assets/php/process.php',
						method: 'POST',
						data: {
							image: base64data
						},
						success: function(data) {
							$modal.modal('hide');
							//$('#uploaded_image').attr('src', data);
							//  Swal.fire({
							//  	title: 'Package Updated Successfully.',
							//  	icon: 'success'
							//   });
							setTimeout(function() {
								location.reload()
								//	window.location = 'admin-package.php';
							}, 0);
						}
					});
				};
			});
		});

	});
</script>

</body>

</html>