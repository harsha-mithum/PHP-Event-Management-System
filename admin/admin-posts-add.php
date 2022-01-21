<?php require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';
$count = new Admin();

?>
<section>
	<div class="page-wrapper">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item active">Add Post</li>
					</ul>
				</div>
			</div>
		</div>
		<form action="" method="post" enctype="multipart/form-data" id="post-create-form">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="title" class="control-label">Post Title</label>
							<input type="text" name="post_title" class="form-control">
						</div>
						<div class="form-group">
							<label class="control-label">Select a Event</label>
							<select class="custom-select" id="" name="post_event" required>
								<?php foreach ($count->fetchAllTypes() as $row) {
									$id = $row['id'];
									$name = $row['name'];
									echo "<option value=$id>$name</option>";
								} ?>
							</select>
						</div>
						<div class="form-group form-row mt-5">
							<div class="col-4"><Label class="col-form-label">Event Date</Label></div>
							<div class="col-8"><input class="form-control text-center" type="date" name="event_date" id=""></div>
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
							<input type="text" name="post_video" class="form-control" placeholder="https://www.youtube.com/embed/wd7dfOdXLtk">
						</div>
						<div class="form-group">
							<label for="post_tags">Post Tags</label>
							<input type="text" name="post_tags" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12">
						<label for="post_content">Post Content</label>
						<textarea name="post_content" class="form-control" cols="30" rows="15"></textarea>
					</div>
				</div>

				<div class="form-group text-right">
					<input class="btn btn-outline-secondary" type="reset" value="Reset" id="resetForm">
					<button class="btn btn-success" name="create_post" type="submit" value="Publish Post" id="submitForm">
						Post<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="add-post-spinner"></span></button>
				</div>
			</div>


		</form>

	</div>
	<!-- /Page Header -->



	</div>
</section>



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
<script src="assets/plugins/tinymce/tinymce.min.js"></script>
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