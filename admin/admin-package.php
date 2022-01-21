<?php require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';
$count = new Admin();

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
						<li class="breadcrumb-item active">Events</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="mb-5">
			<hr>
		</div>
		<div class="row mx-5 mb-3">
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-info">
					<a title="Create a Package" data-toggle="modal" data-target="#ModalCreateForm" class="btn text-info shadow-sm  packageCreateIcon ">
						<i class="fad fa-5x fa-plus m-4 p-2"></i><br><span>Create</span>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-primary">
					<div class="card-header lead text-center text-primary">Total Packages</div>
					<div class="card-body">
						<h1 class="display-4 text-center text-primary"><?= $count->totalCount('packages'); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-success">
					<div class="card-header lead text-center text-success">Published Packages</div>
					<div class="card-body">
						<h1 class="display-4 text-center text-success"><?= $count->count_packages(0); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-danger">
					<div class="card-header lead text-center text-danger">Unpublished Packages</div>
					<div class="card-body">
						<h1 class="display-4 text-center text-danger"><?= $count->count_packages(1); ?></h1>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-5">
			<hr>
		</div>

		<!-- Packages Table -->
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Packages</h4>
					</div>
					<div class="card-body">

						<div class="table-responsive" id="showAllPackages">
							<h4 class="text-center text-lead mt-2">Please Wait...</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-5">
			<hr>
		</div>
		<!-- Not Published Packages -->
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Packages - Not Published</h4>
					</div>
					<div class="card-body">

						<div class="table-responsive" id="showAllPackagesUnpublished">
							<h4 class="text-center text-lead mt-2">Please Wait...</h4>
						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
</div>
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<div class="modal fade" id="showPackageDetailsModal">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="getName"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="card-deck">
					<div class="card border-primary">
						<div class="card-body">
							<p id="getEvent"></p>
							<p id="getPrice"></p>
							<p id="getDescription"></p>
						</div>
					</div>
					<div class="card align-self-center" id="getImage"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>



<!-- Create Modal HTML Markup -->
<div id="ModalCreateForm" class="modal fade">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form role="form" method="POST" action="" id="package-create-form" enctype='multipart/form-data'>
				<div class="modal-header">
					<h4 class="modal-title">Create a Package</h4>
				</div>

				<div class="modal-body">

					<div class="container row">
						<div class="col-md-6">
							<input type="hidden" name="_token" value="">

							<div class="form-group">
								<label class="control-label">Select a Event</label>
								<select class="custom-select" id="" name="event" required>
									<?php foreach ($count->fetchAllTypes() as $row) {
										$id = $row['id'];
										$name = $row['name'];
										echo "<option value=$id>$name</option>";
									} ?>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">Name</label>
								<div>
									<input type="text" class="form-control input-lg" name="pname" value="" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Price</label>
								<div>
									<input type="text" class="form-control input-lg" name="price" value="" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Description</label>
								<div>
									<small>Make sure to end line by (&nbsp;;&nbsp;)</small>
									<textarea type="textarea" class="form-control input-lg" name="description" rows="10" style="height:100%;" value="" required></textarea>

								</div>
							</div>
						</div>
						<div class="col-md-6 ">
							<h5>Upload Featured Image!</h5><br>
							<div class="my-3 border w-100 h-75 d-flex align-items-center">
								<div id="image-holder" class="form-group">
									<img src="assets/img/placeholder.jpg" alt="" class="w-100" id="uploadImage">
								</div>
							</div>
							<div class="form-group">
								<div class="custom-file">
									<label for="fileUpload" class="custom-file-label">Upload Image</label>
									<input accept="image/*" type="file" class="form-control custom-file-input" name="image" id="fileUpload" required>
								</div>
							</div>

						</div>

					</div>
				</div>

				<div class="modal-footer form-group">
					<button type="reset" class="btn btn-secondary" data-dismiss="modal" name="resetBtn" id="resetBtn">Cancel</button>
					<button type="submit" name="createBtn" id="createBtn" class="col-2 btn btn-block btn-primary">Create<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="register-user-spinner"></span></button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Modal HTML Markup -->
<div id="showPackageEditModal" class="modal fade">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form role="form" method="POST" action="" id="package-update-form" enctype='multipart/form-data'>
				<div class="modal-header">
					<h4 class="modal-title" id="editTitle">Edit Package</h4>
				</div>

				<div class="modal-body">

					<div class="container row">
						<div class="col-md-6">
							<input type="hidden" name="_token" value="">

							<div class="form-group">
								<label class="control-label">Select a Event</label>
								<select class="custom-select" id="editEvent" name="edit_event" required>
									<?php foreach ($count->fetchAllTypes() as $row) {
										$id = $row['id'];
										$event = $row['name'];
										echo "<option value=$id>$event</option>";
									} ?>
								</select>
							</div>



							<div class="form-group">
								<input type="hidden" name="edit_id" id="edit_id">
								<input type="hidden" name="oldImage" id="oldImage">

								<label class="control-label">Name</label>
								<div>
									<input type="text" class="form-control input-lg" name="edit_pname" id="editName" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Price</label>
								<div>
									<input type="text" class="form-control input-lg" name="edit_price" id="editPrice" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Description</label>
								<div>
									<small>Make sure to end line by (&nbsp;;&nbsp;)</small>
									<textarea type="textarea" class="form-control input-lg" name="edit_description" rows="10" style="height:100%;" id="editDescription" required></textarea>

								</div>
							</div>
						</div>
						<div class="col-md-6 ">
							<h5>Upload Featured Image!</h5><br>
							<div class="my-3 border w-100 h-75 d-flex align-items-center">
								<div id="image-holder-edit" class="form-group">
									<img src="" alt="" class="w-100" id="editImagePre">
								</div>
							</div>
							<div class="form-group">
								<div class="custom-file">


									<label for="fileUploadEdit" class="custom-file-label">Upload Image</label>
									<input accept="image/*" type="file" class="form-control custom-file-input" name="edit_image" id="fileUploadEdit">

								</div>
							</div>

						</div>

					</div>
				</div>

				<div class="modal-footer form-group">
					<button type="reset" class="btn btn-secondary" data-dismiss="modal" name="resetBtn" id="resetBtn">Cancel</button>
					<button type="submit" name="updateBtn" id="updateBtn" class="col-2 btn btn-block btn-primary">Update<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="update-package-spinner"></span></button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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

<script src="assets/php/js/packages.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script>
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});
</script>
</body>

</html>