<?php require_once 'assets/php/user-header.php';
$user = new Auth();


if (isset($_SESSION['role']) == 'staff') {
	header("Location:member-home.php");
} else {
	header("Location:home.php");
}

?>

<!-- Page Wrapper -->
<div class="content container" style="padding-top: 5em;">

	<div class="row">
		<div class="col-lg-12">
			<?php if ($verified == 'Not Verified') : ?>
				<div class="alert alert-danger text-center m-2 m-0">
					<strong>Your E-mail is not verified! We have sent you verification link on your email, check and verify now.</strong>
				</div>
			<?php endif; ?>




			<!-- Event section -->
			<div class="row">
				<?php
				$event = $user->fetchEventDetailsByUser($cid);
				if ($event) {

					foreach ($event as $data) {

						$id = $data['id'];
						$title = $data['title'];
						$location = $data['location'];
						$date = $data['start_date'];
						$time = $data['time'];
						$guest = $data['people'];
						$type = $data['type'];
						$package = $data['package'];
						$cameramen = $data['cameramen'];
						$progress = $data['progress'];
						$user_id = $data['user_id'];
						$user_name = $data['user_name'];
						$user_address = $data['user_address'];
						$user_phone = $data['user_phone'];
						$user_email = $data['user_email'];





						if ($progress == 100) {
							$class = 'text-success';
							$info = '
							<div class="row alert alert-success">
							<div class="col-10">The Event is almost completed.</div>
							<div class="col-2 p-1"><i class="fad fa-3x fa-hand-holding-heart"></i></div>
							</div>
							<div class="row alert alert-success text-justify">Grab your stuff by visiting us. We are happy to work with you.</div>';
						} else if ($progress >= 60 && $progress < 100) {
							$class = 'text-info';
							$info = '<div class="row alert alert-info">
							<div class="col-10">The Event is still processing.</div>
							<div class="col-2 p-1"><i class="fad fa-3x fa-smile-beam"></i></div>
							</div>
							<div class="row alert alert-info">
							<div class="text-justify">Every master piece of work needs finishing touches. Thank you for your patient.</div>
							</div>';
						} else if ($progress >= 20 && $progress < 60) {
							$class = 'text-warning';
							$info = '<div class="row alert alert-warning">
							<div class="col-10 text-justify">The Event processing is almost began.</div>
							<div class="col-2 p-1"><i class="fad fa-3x fa-users-cog"></i></i></div>
							</div>
							<div class="row alert alert-warning">
							<div class="text-justify">While our members are work around with your event , Please be kind enough to be patient. Thank you.</div>
							</div>';
						} else {
							$class = 'text-danger';
							$info = '<div class="row alert alert-danger">
							<div class="col-10">Oops..looks like the Event not started yet.</div>
							<div class="col-2 p-1"><i class="fad fa-3x fa-hourglass-start"></i></div>
							</div>';
						}

						switch ($progress) {
							case '100':
								$c1 = '<i class="fas fa-check text-success"></i>';
								$c2 = '<i class="fas fa-check text-success"></i>';
								$c3 = '<i class="fas fa-check text-success"></i>';
								$c4 = '<i class="fas fa-check text-success"></i>';
								$c5 = '<i class="fas fa-check text-success"></i>';
								break;
							case '80':
								$c1 = '<i class="fas fa-check text-success"></i>';
								$c2 = '<i class="fas fa-check text-success"></i>';
								$c3 = '<i class="fas fa-check text-success"></i>';
								$c4 = '<i class="fas fa-check text-success"></i>';
								$c5 = '<i class="fal fa-minus"></i>';
								break;
							case '60':
								$c1 = '<i class="fas fa-check text-success"></i>';
								$c2 = '<i class="fas fa-check text-success"></i>';
								$c3 = '<i class="fas fa-check text-success"></i>';
								$c4 = '<i class="fal fa-minus"></i>';
								$c5 = '<i class="fal fa-minus"></i>';
								break;
							case '40':
								$c1 = '<i class="fas fa-check text-success"></i>';
								$c2 = '<i class="fas fa-check text-success"></i>';
								$c3 = '<i class="fal fa-minus"></i>';
								$c4 = '<i class="fal fa-minus"></i>';
								$c5 = '<i class="fal fa-minus"></i>';
								break;
							case '20':
								$c1 = '<i class="fas fa-check text-success"></i>';
								$c2 = '<i class="fal fa-minus"></i>';
								$c3 = '<i class="fal fa-minus"></i>';
								$c4 = '<i class="fal fa-minus"></i>';
								$c5 = '<i class="fal fa-minus"></i>';
								break;

							default:
								$c1 = '<i class="fal fa-minus"></i>';
								$c2 = '<i class="fal fa-minus"></i>';
								$c3 = '<i class="fal fa-minus"></i>';
								$c4 = '<i class="fal fa-minus"></i>';
								$c5 = '<i class="fal fa-minus"></i>';
								break;
						}
				?>
						<div class="page-wrapper">
							<div class="col-sm-12 border p-3  bg-light shadow-sm" id="eventDetails">
								<div class="row justify-content-around ">
									<!-- Event Details -->
									<div class="col-sm-5 border rounded-lg bg-white p-5 m-2">
										<h4 class="mb-5">Event Details</h4>
										<div class="row">
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
									<!-- Event Progress -->
									<div class="col-sm-5 border rounded-lg bg-white p-5 m-2">
										<h4 class="mb-5">Event Progress:&nbsp;&nbsp;&nbsp;<span style="font-size:2rem;font-weight: bold;" class="<?= $class ?>"><?= $progress ?>%</span> </h4>
										<div class="hidden" id="progress"><? $progress ?></div>

										<table class="table p-3 text-justify">
											<tbody class="align-middle">
												<tr>
													<th scope="row">
														<h5>Shooting</h5>
													</th>
													<td>
														<div id="c1"><?= $c1 ?></div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<h5>Pre-Processing</h5>
													</th>
													<td>
														<div id="c2"><?= $c2 ?></div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<h5>Re-Touching</h5>
													</th>
													<td>
														<div id="c3"><?= $c3 ?></div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<h5>Post-Processing</h5>
													</th>
													<td>
														<div id="c4"><?= $c4 ?></div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<h5>Album</h5>
													</th>
													<td>
														<div id="c5"><?= $c5 ?></div>
													</td>
												</tr>
											</tbody>
										</table>
										<div class="m-3"><?= $info ?></div>
									</div>
								</div>
								<div class="row m-2 justify-content-around">
									<?php if ($progress == 0) {
										echo '<div><a href="" class="btn rounded-pill btn-danger">Request Cancel</a></div>';
									}

									?>
									<div>
										<a href="album.php?id=<?= $id ?>" class="btn rounded-pill  btn-info">View Album&nbsp;<i class="fas fa-images"></i>&nbsp;</a>

									</div>
									<div>
										<a href="notes.php?id=<?= $id ?>" class="btn rounded-pill btn-info ">Message&nbsp;<i class="fas fa-envelope"></i>&nbsp;</a>

									</div>
									<div>
										<a href="feedback.php?id=<?= $id ?>&subject=<?= $title ?>" class="btn rounded-pill btn-info">Give Feedback&nbsp;<i class="fas fa-comment-smile"></i>&nbsp;</a>

									</div>


								</div>
							</div>
							<hr class="mt-5" width="100%">
						</div>

				<?php
					}
				} else {
					echo '<div class="page-wrapper"><div class="p-5"><h1 class="mt-5 text-center">No Event Details Available!</h1> </div></div>';
				}
				?>
				<!-- Event section -->
			</div>
		</div>
	</div>


</div>
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->




<!-- Start Add New Note Modal -->
<div class="modal fade" id="addNoteModal">
	<div class="modal-dialog modal-dialog-center">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h4 class="modal-title text-light">Add New Note</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" id="add-note-form" class="px-3">
					<div class="form-group">
						<input type="text" name="title" class="form-control" placeholder="Enter Title" required>
					</div>
					<div class="form-group">
						<textarea name="note" class="form-control" placeholder="Write Your Note Here..." rows="6" required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" name="addNote" id="addNoteBtn" class="btn btn-block btn-success">Add Note&nbsp;
							<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="add-note-spinner"></span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Add New Note Modal -->

<!-- Start Edit Note Modal -->
<div class="modal fade" id="editNoteModal">
	<div class="modal-dialog modal-dialog-center">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title text-light">Edit Note</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" id="edit-note-form" class="px-3">
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" required>
					</div>
					<div class="form-group">
						<textarea name="note" id="note" class="form-control" placeholder="Write Your Note Here..." rows="6" required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" name="editNote" id="editNoteBtn" class="btn btn-block btn-info">Edit Note&nbsp;
							<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="edit-note-spinner"></span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Edit Note Modal -->

<!-- jQuery -->
<script src="assets/js/bootstrap-4/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="assets/js/bootstrap-4/popper.min.js"></script>
<script src="assets/js/bootstrap-4/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Datatables JS -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/datatables.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/bootstrap-4/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="assets/php/js/home.js"></script>


<script src="https://pro.fontawesome.com/releases/v5.15.4/js/all.js"></script>
<script type="text/javascript" src="https://use.fontawesome.com/releases/v5.15.4/js/conflict-detection.js"></script>


<script>

</script>
</body>

</html>