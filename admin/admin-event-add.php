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
						<li class="breadcrumb-item"><a href="admin-event.php">Event</a></li>
						<li class="breadcrumb-item active">Event-Add</li>
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
				<div class="row justify-content-center">
				<div id="regAlert-event"></div>

					<!-- Event Details -->
					<div class="col-lg-4 border rounded m-3 p-3 bg-white shadow">
						<h4>Event Details</h4>
						<div class="form-group"><input type="text" name="title" id="title" class="form-control" placeholder="Event Title" title="Title"></div>
						<div class="form-group"><input type="text" name="location" id="location" class="form-control" placeholder="Event Location" title="Location"></div>

						<div class="form-group form-row">
							<div class="col-4"><Label class="col-form-label">Event Date</Label></div>
							<div class="col-8"><input class="form-control text-center" type="date" name="date" id=""></div>
						</div>

						<div class="form-group form-row">
							<div class="col-4"><Label class="col-form-label">Event Starts</Label></div>
							<div class="col-8 "><input class="form-control text-center timepicker" type="time" name="time" id="" placeholder="00:00"></div>
						</div>

						<div class="form-group"><input class="form-control" type="number" name="guest" id="" min="0" placeholder="No.of Guests" title="Guests"></div>
					</div>


					<!-- Event Scope -->
					<div class="col-lg-3 border rounded m-3 p-3 bg-white shadow">
						<h4>Event Scope</h4>

						<div class=" form-group">
							<label for="eventType" class="form-label">Event Type</label>
							<select class="custom-select text-center" name="eventType" id="eventType">
								<option value="0" selected>Select Event Type</option>
								<?php foreach ($count->fetchAllTypes() as $row) {
									$id = $row['id'];
									$event = $row['name'];
									echo "<option value=$id>$event</option>";
								} ?>
							</select>
						</div>

						<div class="form-group">
							<label for="package" class="form-label">Event Package</label>
							<select class="custom-select text-center" name="package" id="package">
								<option value="0" selected>Select Event Type First</option>
							</select>
						</div>

						<div class="form-group">
							<label for="cameramen" class="custom-form-label">Event Cameramen Count</label>
							<input class="form-control" type="number" name="cameramen" id="cameramen" min="0" placeholder="Cameramen" aria-describedby="camHelp">
							<small id="camHelp" class="form-text text-muted text-right">*both Photographer/ Videographer</small>
						</div>
					</div>


					<!-- Contact Details -->
					<div class="col-lg-3 border rounded m-3 p-3 bg-white shadow" id="contactDetails">
						<h4>Contact Details</h4>

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
				<div class="form-group text-center">
					<input type="hidden" name="create-event">
					<button type="reset" name="reset" class="col-sm-3 btn-lg btn-outline-secondary m-3">Reset</button>
					<button  type="submit" name="submit" class=" col-sm-3 btn-lg btn-primary m-3"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="add-event-spinner"></span>Add Event</button>

				</div>
			</form>

		</div>
	</div>

	<div class="mb-5">
		<hr>
	</div>

</div>
<!-- /Page Wrapper -->


<!-- Create User Modal HTML Markup -->
<div id="ModalCreateForm" class="modal fade ">
	<div class="modal-dialog " role="document">
		<div class="modal-content ">
			<form role="form" method="POST" action="" id="register-form-user" enctype='multipart/form-data'>
				<div class="modal-header">
					<h4 class="modal-title">Add a User</h4>
				</div>

				<div class="modal-body">

					<div class="container">

						<!-- <form action="#" method="post" id="register-form-user"> -->
						<div id="regAlert-user"></div>
						<h5>User Details</h5>
						<div class="form-group">
							<input class="form-control" type="text" name="name" id="name" placeholder="Full Name" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="email" name="email" id="remail" placeholder="Email" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="phone" id="rphone" placeholder="Phone Number" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="city" id="rcity" placeholder="City" required>
						</div>


						<div class="form-group mt-3">
							<p id="regHelp" class="form-text text-muted">Password will be sent to registered email address.</p>
						</div>


					</div>
				</div>
				<div class="modal-footer form-group">
					<button type="reset" class="btn btn-secondary" data-dismiss="modal" name="resetBtn" id="resetBtn">Cancel</button>
					<button class="btn btn-primary btn-block" type="submit" id="register-btn-user">Register&nbsp;
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="register-user-spinner"></span></button>
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
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<!-- Custom JS -->


<script src="assets/js/script.js"></script>
<script src="assets/php/js/event.js"></script>

<script>

</script>

</body>

</html>