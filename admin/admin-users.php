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
						<li class="breadcrumb-item active">Users</li>
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
				<div class="card border border-success">
					<a title="Create a Package" class="btn border text-success shadow-sm  packageCreateIcon " data-toggle="collapse" href="#collapseForm" role="button" aria-expanded="false" aria-controls="collapseForm">
						<i class="fad fa-5x fa-plus m-4 p-2"></i><br><span>Add User / Team</span>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-primary">
					<div class="card-header lead text-center text-primary">Total Users</div>
					<div class="card-body">
						<h1 class="display-4 text-center text-primary"><?= $count->totalCount('users'); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-warning">
					<div class="card-header lead text-center text-warning">Verified Users</div>
					<div class="card-body">
						<h1 class="display-4 text-center text-warning"><?= $count->verified_users(1); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-danger">
					<div class="card-header lead text-center text-danger">Unverified Users</div>
					<div class="card-body">
						<h1 class="display-4 text-center text-danger"><?= $count->verified_users(0); ?></h1>
					</div>
				</div>
			</div>
		</div>

		<!-- Register Form -->
		<div class="row justify-content-center collapse" id="collapseForm">
			<div class="col-6 p-5">
				<nav class="">
					<div class="nav nav-tabs text-center" id="nav-tab" role="tablist">
						<a class="nav-item col-6 nav-link active" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="nav-user" aria-selected="true">Add User</a>
						<a class="nav-item col-6 nav-link" id="nav-staff-tab" data-toggle="tab" href="#nav-staff" role="tab" aria-controls="nav-staff" aria-selected="false">Add Team Member</a>
					</div>
				</nav>
				<div class="tab-content " id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
						<form action="#" method="post" id="register-form-user">
							<div id="regAlert-user"></div>
							<h5>User Details</h5>
							<div class="form-group">
								<input class="form-control" type="text" name="name" id="name" placeholder="Full Name" required>
							</div>
							<div class="form-group">
								<input class="form-control" name="email" id="remail" type="email" placeholder="Email" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="phone" id="rphone" placeholder="Phone Number" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="city" id="rcity" placeholder="City" required>
							</div>


							<div class="form-group mt-3">
								<button class="btn btn-primary btn-block" type="submit" id="register-btn-user">Register&nbsp;
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="register-user-spinner"></span></button>
								<br>
								<p id="regHelp" class="form-text text-muted">Password will be sent to registered email address.</p>
							</div>
						</form>
					</div>
					<div class="tab-pane fade" id="nav-staff" role="tabpanel" aria-labelledby="nav-staff-tab">
						<form action="#" method="post" id="register-form-staff">
							<div id="regAlert-staff"></div>
							<h5>Member Details</h5>
							<div class="form-group">
								<input class="form-control" type="text" name="sname" id="sname" placeholder="Full Name" required>
							</div>
							<div class="form-group">
								<input class="form-control" name="semail" id="semail" type="email" placeholder="Email" required>
							</div>
							<div class="form-group">
								<input class="form-control" name="sphone" id="sphone" type="text" placeholder="Phone Number" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="scity" id="scity" placeholder="City" required>
							</div>
							<hr>
							<h5>Designation</h5>
							<div class="form-group">
								<select class="custom-select" name="designation" id="designation">
									<option value="Senior Photographer">Senior Photographer</option>
									<option value="Senior Videographer">Senior Videographer</option>
									<option value="Senior Editor">Senior Editor</option>
									<option value="Assistant Photographer">Assistant Photographer</option>
									<option value="Assistant Videographer">Assistant Videographer</option>
									<option value="Assistant Editor">Assistant Editor</option>
								</select>
							</div>


							<div class="form-group mt-5">
								<button class="btn btn-primary btn-block" type="submit" id="register-btn-staff">Register&nbsp;
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="register-staff-spinner" aria-describedby="regHelp"></span></button>
								<br>
								<p id="regHelp" class="form-text text-muted">Password will be sent to registered email address.</p>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>

		<!-- /Form -->

		<div class="mb-5">
			<hr>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Total Registered Members</h4>
					</div>
					<div class="card-body">

						<div class="table-responsive" id="showAllStaff">
							<h4 class="text-center text-lead mt-2">Please Wait...</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-5">
			<hr>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Total Registered Users</h4>
					</div>
					<div class="card-body">

						<div class="table-responsive" id="showAllUsers">
							<h4 class="text-center text-lead mt-2">Please Wait...</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-5">
			<hr>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Total Deleted Users</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive" id="showAllDeletedUsers">
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

<div class="modal fade" id="showUserDetailsModal">
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
							<p id="getEmail"></p>
							<p id="getPhone"></p>
							<p id="getDob"></p>
							<p id="getGender"></p>
							<p id="getCreated"></p>
							<p id="getVerified"></p>
							<p id="getAddress"></p>
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

<div class="modal fade" id="showStaffUpModal">
	<div class="modal-dialog modal-dialog-centered mw-100 w-25">
		<div class="modal-content">
			<form action="" id="staff-designation-form">
				<div class="modal-header">
					<h4 class="modal-title">Update Designation</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="card-deck">
						<div class="card border-primary">
							<div class="card-body">
								<input type="hidden" name="edit_id" id="edit_id">
								<div class="form-group">
									<select class="custom-select custom-select-lg" name="edit_designation" id="edit_designation">
										<option value="Senior Photographer">Senior Photographer</option>
										<option value="Senior Videographer">Senior Videographer</option>
										<option value="Senior Editor">Senior Editor</option>
										<option value="Assistant Photographer">Assistant Photographer</option>
										<option value="Assistant Videographer">Assistant Videographer</option>
										<option value="Assistant Editor">Assistant Editor</option>
									</select>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="updateBtn" id="updateBtn" class=" btn btn-block btn-primary">Update<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="update-package-spinner"></span></button>

					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
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

<!-- Custom JS -->
<script src="assets/js/script.js"></script>

<script src="assets/php/js/users.js"></script>
<script>
	$('#reg-form').hide();
</script>

</body>

</html>