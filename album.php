<?php require_once 'assets/php/user-header.php';
$user = new Auth();


if (isset($_SESSION['role']) == 'staff') {
    header("Location:member-home.php");
} else {
    header("Location:home.php");
}
$event = ($_GET['id']);

?>

<style>
    .image_area {
        position: relative;
    }

    .overlay {
        position: absolute;
        bottom: 0px;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        overflow: hidden;
        height: 0;
        transition: .2s ease;
        width: 100%;
        z-index: 99;
    }

    .image_area:hover .overlay {
        padding-top: 10%;
        height: 100%;
        cursor: pointer;

    }

    a {
        cursor: pointer;
    }

    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 20rem;
    }

    .toggle.ios .toggle-handle {
        border-radius: 20rem;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" type="text/css">


<input type="hidden" id="event_id" name="event_id" value="<?= $event ?>">
<div class="page-wrapper">
    
    <div class="container-fluid row justify-content-center" id="showAllAlbums"></div>
    <hr class="m-5">
    <div class="container row " id="showAllImages"></div>



    <div class="row">



    </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="assets/php/js/album.js"></script>


<script src="https://pro.fontawesome.com/releases/v5.15.4/js/all.js"></script>
<script type="text/javascript" src="https://use.fontawesome.com/releases/v5.15.4/js/conflict-detection.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://unpkg.com/freewall@1.0.8/freewall.js"></script>

<script>
    $(document).ready(function() {

        fetchAlbum();

        //fetch all albums
        function fetchAlbum() {

            id = $('#event_id').val();
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: {
                    album_event_id: id
                },
                success: function(response) {

                    $("#showAllAlbums").html(response);
                }
            });

        };



    });
</script>
<script>
    $("body").on("click", ".albumViewIcon", function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        
      //  window.open("admin/user-album.php?id=" + id + " ", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=960,height=600");
        location.href = './user-album.php?id=' + id;
    });


    function hideAlbum() {
        $('#showAllAlbums').hide();
    }

    function showAlbum() {
        setTimeout(function() {
            $("#showAllAlbums").show();
        }, 0);
    }
</script>
</body>

</html>