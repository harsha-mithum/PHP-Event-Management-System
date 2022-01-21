<?php require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';
$admin = new Admin();


$id = $admin->test_input($_GET['id']);

$data = $admin->fetchPostDetailsById($id);

if ($data) {

	$id = $data['post_id'];
	$title = $data['post_title'];

	$event = $data['event'];
	$event_id = $data['post_type_id'];
	$event_date = $data['event_date'];
	$image = $data['post_image'];
	$youtube = $data['yt_link'];
	$tags = $data['post_tags'];
	$content = $data['post_content'];

	if ($youtube == null) {
		$youtube_src = '<h4 class="">Video Not Available</h4>';
	} else {
		$youtube_src = '<iframe width="auto" height="315" src="' . $youtube . '" title="YouTube video player" frameborder="0" allowfullscreen></iframe> ';
	}
} else {
	echo '<h1 class="test-center">No Information Available</h1>';
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
						<li class="breadcrumb-item active">Edit Post</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<form action="" method="post" enctype="multipart/form-data" id="post-update-form">
			<div class="container">
				<div class="row">
					<div class="col-md-6">

						<input type="hidden" name="post_edit_id" id="post_edit_id" value="<?= $id ?>">
						<input type="hidden" name="oldImage" id="oldImage" value="<?= $image ?>">

						<div class="form-group">
							<label for="title" class="control-label">Post Title</label>
							<input type="text" name="post_title" class="form-control" value="<?= $title ?>">
						</div>
						<div class="form-group">
							<label class="control-label">Select a Event</label>
							<select class="custom-select" id="" name="post_event" required value="<?= $event ?>">
								<option value="<?= $event_id ?>"><?= $event ?></option>
								<?php foreach ($admin->fetchAllTypes() as $row) {
									$id = $row['id'];
									$name = $row['name'];
									echo "<option value=$id>$name</option>";
								} ?>
							</select>
						</div>
						<div class="form-group form-row mt-5">
							<div class="col-4"><Label class="col-form-label">Event Date</Label></div>
							<div class="col-8"><input class="form-control text-center" type="date" name="event_date" value="<?= $event_date ?>"></div>
						</div>
					</div>
					<div class="col-md-6">
						<h6 class="mb-3">Post Banner</h6>
						<div class="input-group mb-3">

							<div class="input-group-prepend">
								<span class="input-group-text">Upload</span>
							</div>

							<div class="custom-file">
								<input type="file" class="custom-file-input" id="bannerImage" name="bannerImage">
								<label class="custom-file-label" for="bannerImage">Choose file</label>
							</div>
						</div>
						<div class="form-group">
							<label for="video">Video Link</label>
							<input type="text" name="post_video" class="form-control" placeholder="https://www.youtube.com/embed/wd7dfOdXLtk" value="<?= $youtube ?>">
						</div>
						<div class="form-group">
							<label for="post_tags">Post Tags</label>
							<input type="text" name="post_tags" class="form-control" value="<?= $tags ?>">
						</div>
					</div>
				</div>
				<div class="container row justify-content-center my-5">
					
					<div class="col-sm-6">
					<h5>Video Preview</h5>
						<?= $youtube_src ?>
					</div>
					<div class="col-md-6 ">
						<h5>Banner Preview</h5>
						<div class="my-3 border w-100 h-auto d-flex align-items-center">
							<div id="image-holder-edit" class="form-group">

								<img src="assets/php/<?= $image ?>" alt="" class="w-50 h-auto" id="editImagePre">
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12">
						<label for="post_content">Post Content</label>
						<textarea name="post_content" class="form-control" cols="30" rows="15"><?= $content ?></textarea>
					</div>
				</div>

				<div class="form-group text-right">
					<input class="btn btn-outline-secondary" type="reset" value="Reset" id="resetForm">
					<button class="btn btn-success" name="update_post" type="submit" value="Publish Post" id="submitForm">
						Update<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="update-post-spinner"></span></button>
				</div>
			</div>


		</form>





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
<script>
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});
</script>

<script src="https://cdn.tiny.cloud/1/cjgmanert4wmnjqo9s4fk14rbhr860mka34mjv2x1qmu6hi6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="assets/plugins/tinymce/tinymce.min.js"></script>
<script>
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});


	//File Upload Preview
	$("#bannerImage").on('change', function() {

		if (typeof(FileReader) != "undefined") {

			var image_holder = $("#image-holder-edit");
			image_holder.empty();

			var reader = new FileReader();
			reader.onload = function(e) {
				$("<img />", {
					"src": e.target.result,
					"class": "w-100 h-auto"
				}).appendTo(image_holder);

			}
			image_holder.show();
			reader.readAsDataURL($(this)[0].files[0]);
		} else {
			alert("This browser does not support FileReader.");
		}
	});



	// File Upload Name Preview
	$(document).ready(function() {
		bsCustomFileInput.init()
	})
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
<script>
	tinymce.init({
		selector: 'textarea'
	});
	tinymce.init({
		selector: 'textarea',
		plugins: "code",
		toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code image_upload",
		menubar: false,
		statusbar: false,
		content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
		height: 400,
		setup: function(ed) {

			var fileInput = $('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
			$(ed.getElement()).parent().append(fileInput);

			fileInput.on("change", function() {
				var file = this.files[0];
				var reader = new FileReader();
				var formData = new FormData();
				var files = file;
				formData.append("file", files);
				formData.append('filetype', 'image');
				jQuery.ajax({
					url: "tinymce_upload.php",
					type: "post",
					data: formData,
					contentType: false,
					processData: false,
					async: false,
					success: function(response) {
						var fileName = response;
						if (fileName) {
							ed.insertContent('<img src="upload/' + fileName + '"/>');
						}
					}
				});
				reader.readAsDataURL(file);
			});

			ed.addButton('image_upload', {
				tooltip: 'Upload Image',
				icon: 'image',
				onclick: function() {
					fileInput.trigger('click');
				}
			});
		}
	});
</script>
</body>

</html>