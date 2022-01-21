<?php require_once 'assets/php/user-header.php'; 

$subject = $_GET['subject'];

?>


	<div class="content container" style="padding-top: 5em;">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<?php if($verified == 'Verified'): ?>
				<div class="card mt-2">
					<div class="card-header">
						<h4 class="card-title float-left mt-2">Feedback</h4>
					</div>
					<form action="#" method="post" id="feedback-form">
						<div class="card-body">
							<div class="form-group">
								<input type="text" name="subject" class="form-control" placeholder="Write Your Subject Here..." value="<?= $subject ?>" required>
							</div>
							<div class="form-group">
								<textarea name="feedback" class="form-control" placeholder="Write Your Feedback Here..." rows="8" required></textarea>
							</div>
							<div class="form-group">
								<button type="submit" name="feedbackBtn" id="feedbackBtn" class="btn btn-block btn-primary">Send Feedback&nbsp;<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="send-feedback-spinner"></span></button>
							</div>
						</div>
					</form>
				</div>
				<?php else: ?>
					<h2 class="text-center text-secondary mt-5">:( Verify your email first to send feedback.</h2>
				<?php endif; ?>	
			</div>
			<div class="col-sm-2"></div>			
		</div>
	</div>

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
		<script src="assets/php/js/feedback.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		
    </body>

</html>