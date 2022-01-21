$(document).ready(function() {

    fetchAllPosts();
    fetchAllPostsUn();



    //fetch all Posts
    function fetchAllPosts() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllPosts' },
            success: function(response) {
                $("#showAllPosts").html(response);
                if ($('.datatable').length > 0) {
                    $('.datatable').DataTable({
                        "bFilter": true,
                        "stateSave": true,
                        "order": [
                            [5, "asc"],
                            [3, 'desc']
                        ]
                    });
                }
            }
        });
    }

    //fetch all Posts
    function fetchAllPostsUn() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllPostsUnpublished' },
            success: function(response) {
                $("#showAllPostsUnpublished").html(response);
                if ($('.datatable-2').length > 0) {
                    $('.datatable-2').DataTable({
                        "emptyTable": "No data available in table",
                        "bFilter": true,
                        "stateSave": true,
                        "order": [
                            [5, "asc"],
                            [3, 'desc']
                        ]
                    });
                }
            }
        });
    }


    //Publish post ajax reqest
    $("body").on("click", ".postPublishIcon", function(e) {
        e.preventDefault();
        post_publish_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Selected Post will be published!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Publish it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { post_publish_id: post_publish_id },
                    success: function(response) {
                        Swal.fire(
                            'Published!',
                            'Post Published Successfully.',
                            'success'
                        )

                        fetchAllPosts();
                        fetchAllPostsUn();
                        setTimeout(function() {
                            //location.reload()
                            window.location = 'admin-posts.php';
                        }, 2000);
                    }
                });
            }
        });
    });


    //Unpublish Unpublish ajax reqest
    $("body").on("click", ".postUnpublishIcon", function(e) {
        e.preventDefault();
        post_unpublish_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Selected post will be Unpublished!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Unpublish it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { post_unpublish_id: post_unpublish_id },
                    success: function(response) {
                        Swal.fire(
                            'Unpublished!',
                            'post Unpublished Successfully.',
                            'success'
                        )

                        fetchAllPosts();
                        fetchAllPostsUn();
                        setTimeout(function() {
                            //location.reload()
                            window.location = 'admin-posts.php';
                        }, 2000);
                    }
                });
            }
        });
    });

    //Delete post ajax reqest
    $("body").on("click", ".postDeleteIcon", function(e) {
        e.preventDefault();
        post_delete_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { post_delete_id: post_delete_id },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'post Deleted Successfully.',
                            'success'
                        )

                        fetchAllPosts();
                        fetchAllPostsUn();
                        setTimeout(function() {
                            location.reload()
                                //  window.location = 'admin-posts.php';
                        }, 2000);
                    }
                });
            }
        });
    });






    //Create post Ajax Request
    $("#post-create-form").submit(function(e) {
        e.preventDefault();
        $("#add-post-spinner").show();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response) {
                $("#add-post-spinner").hide();
                Swal.fire({
                    title: 'Post Created Successfully.',
                    icon: 'success'
                });
                setTimeout(function() {
                    location.reload()
                        // window.location = 'admin-posts.php';
                }, 2000);
            }
        });
    });




    // //Edit post details
    // $("body").on("click", ".postEditIcon", function(e) {
    //     e.preventDefault();
    //     post_edit_id = $(this).attr('id');
    //     $.ajax({
    //         url: 'assets/php/admin-action.php',
    //         method: 'post',
    //         data: { post_edit_id: post_edit_id },
    //         success: function(response) {
    //             data = JSON.parse(response);
    //             $("#editTitle").text('Edit - ' + data.name + ' ');

    //             $("#edit_id").val(data.id);
    //             $("#editName").val(data.name);
    //             $("#editPrice").val(data.price);
    //             $("#editEvent").val(data.type_id);
    //             $("#editDescription").val(data.description);
    //             $("#oldImage").val(data.photo);
    //             $("#editImagePre").attr('src', '../admin/assets/php/' + data.photo);

    //         }
    //     });
    // });

    //Update post Ajax Request
    $("#post-update-form").submit(function(e) {
        e.preventDefault();
        $("#update-post-spinner").show();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response) {
                $("#update-post-spinner").hide();
                Swal.fire({
                    title: 'Post Updated Successfully.',
                    icon: 'success'
                });
                setTimeout(function() {
                    location.reload()
                        //   window.location = 'admin-posts.php';
                }, 2000);
            }
        });
    });






});