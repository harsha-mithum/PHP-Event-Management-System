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
                        <li class="breadcrumb-item active">Event</li>
                        <li class="breadcrumb-item "><a href="admin-event-add.php">Event-Add</a></li>
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
					<a title="Create a Event" href="admin-event-add.php" class="btn text-info shadow-sm  eventCreateIcon ">
						<i class="fad fa-5x fa-plus m-4 p-2"></i><br><span>Create</span>
					</a>
				</div>
			</div>
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-primary">
					<div class="card-header lead text-center text-primary">Total Events</div>
					<div class="card-body">
						<h1 class="display-4 text-center text-primary"><?= $count->totalCount('events'); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-success">
					<div class="card-header lead text-center text-success">Published Events</div>
					<div class="card-body">
						<h1 class="display-4 text-center text-success"><?= $count->count_events(0); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-4 col-12">
				<div class="card border border-danger">
					<div class="card-header lead text-center text-danger">Unpublished Events</div>
					<div class="card-body">
						<h1 class="display-4 text-center text-danger"><?= $count->count_events(1); ?></h1>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-5">
			<hr>
		</div>


        <!-- Events Table -->
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Events</h4>
						<a href="admin-event-add.php" class="btn btn-primary float-right" ><i class="fa fa-plus-circle fa-lg"></i>&nbsp;Add New</a>
					</div>
					<div class="card-body">

						<div class="table-responsive" id="showAllEvents">
							<h4 class="text-center text-lead mt-2">Please Wait...</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-5">
			<hr>
		</div>
		<!-- Not Published Events -->
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Events - Not Published</h4>
					</div>
					<div class="card-body">

						<div class="table-responsive" id="showAllEventsUnpublished">
							<h4 class="text-center text-lead mt-2">Please Wait...</h4>
						</div>
					</div>
				</div>
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
<script src="assets/php/js/event.js"></script>

<script>

</script>

</body>

</html>