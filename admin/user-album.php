<?php
include_once('assets/php/config2.php');
$album = ($_GET['id']);



?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Upload Images</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

	<style>
		.img-wrap {
			position: relative;
		}

		.img-wrap .close {
			color: red;
			background-color: white;
			border-radius: 15%;
			font-size: 1.5rem;
			position: absolute;
			top: 1px;
			right: 5px;
			z-index: 100;
		}

		#img {
			position: relative;
			width: auto;
			height: 170px;
		}
	</style>

</head>

<body class="bg-dark">

	<div class="container-fluid ">
		<div class="gallery row" id="">
			<ul class="nav nav-pills m-5 justify-content-lg-start justify-content-sm-center">
				<?php
				//Fetch all images from database
				$images = $db->getAllImages($album);
				if (!empty($images)) {
					foreach ($images as $row) {
				?>
						<li id="image_li_<?php echo $row['id']; ?>" class="ui-sortable-handle ">
							<div class="img-wrap">
								<span class="close" id="<?php echo $row['id']; ?>">&times;</span>
								<a href="../uploads/albums/<?php echo $row['img_name']; ?>" class="img-link" data-fancybox="true">
									<img src="../uploads/albums/<?php echo $row['img_name']; ?>" alt="" class="img-thumbnail " id="img">
								</a>
							</div>
						</li>


				<?php
					}
				} else {
					echo '<h1 class="m-5 text-center">No Image information available.</h1>';
				}
				?>
			</ul>
		</div>
	</div>



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
	<script src="https://unpkg.com/freewall@1.0.8/freewall.js"></script>

</body>

</html>