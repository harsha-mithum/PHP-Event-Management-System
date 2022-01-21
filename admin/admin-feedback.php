<?php require_once 'assets/php/admin-header.php'; ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Feedback</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Total Feedback From Users</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive" id="showAllFeedback">
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

		<!-- Reply Feedback Modal Start -->

		<div class="modal fade" id="showReplyModal">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title">Reply This Feedback</div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="#" method="post" class="px-3" id="feedback-reply-form">
							<div class="form-group">
								<textarea name="message" id="message" class="form-control" rows="6" placeholder="Write Your Reply Here..." required></textarea>
							</div>
							<div class="form-group">
								<button type="submit" name="submit" class="btn btn-block btn-primary" id="feedbackReplyBtn">Reply Feedback&nbsp;
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="feedback-reply-spinner"></span></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Reply Feedback Modal End -->
		
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
		<script  src="assets/js/script.js"></script>

		<script  src="assets/php/js/feedback.js"></script>
		
    </body>
</html>