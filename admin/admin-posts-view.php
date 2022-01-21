<?php require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';
$admin = new Admin();

$id = $_GET['id'];
$data = $admin->fetchPostDetailsById($id);

if ($data) {

	$title = $data['post_title'];
	$event = $data['event'];
	$event_date = $data['event_date'];
	$post_date = $data['post_date'];
	$post_image = $data['post_image'];
	$content = $data['post_content'];
	$youtube = $data['yt_link'];

	if ($youtube == null) {
		$youtube = '<h4 class="m-5 p-5 border shadow-sm">Video Not Available</h4>';
	} else {
		$youtube = '<iframe width="560" height="315" src="' . $youtube . '" title="YouTube video player" frameborder="0" allowfullscreen></iframe> ';
	}
}
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
						<li class="breadcrumb-item active">Post Details</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="container row justify-content-center">
			<div class="container-fluid">
				<div class="row text-center">
					<h1 class="text-center 	"><?= $title ?></h1>
				</div>
				<br>
				<div class="row">
					<h2><?= $event ?>&nbsp;&nbsp;&nbsp;&nbsp;<small><?= $event_date ?></small></h2>
				</div>
			</div>
			<div class="col-sm-6 justify-content-center">
				<div class="">
					<img src="assets/php/<?= $post_image ?>" alt="" class="img-responsive border shadow-sm" width="50%" height="auto">
				</div>
				<div>
					<p>Created On: <?= $post_date ?></p>
				</div>
			</div>
			<div class="ccol-sm-6 justify-content-center">
				<?= $youtube ?>
			</div>
		</div>
		<div class="container row justify-content-center">
			<h4 class="my-5">Post Content</h4>
			<?php
			$id = $_GET['id'];
			$data = $admin->fetchPostDetailsById($id);

			if ($data) {
				$content = $data['post_content'];
				echo '<div> bdbdf&lt;</div>';
			} ?>
			<div class=" row col-sm-12">

				<textarea name="post_content" class="form-control" cols="15" rows="15"><?= '<div>' . $content . '</div>' ?></textarea>

			</div>
		</div>


	</div>
</div>
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->








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

<script src="assets/php/js/posts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

<script src="https://cdn.tiny.cloud/1/cjgmanert4wmnjqo9s4fk14rbhr860mka34mjv2x1qmu6hi6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});
</script>
<script>
	tinymce.init({
		selector: 'textarea',
		plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
		toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
		toolbar_mode: 'floating',
		tinycomments_mode: 'embedded',
		tinycomments_author: 'Author name',
	});
</script>

</body>

</html>