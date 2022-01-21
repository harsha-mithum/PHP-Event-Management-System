$(document).ready(function() {


    fetchAllPackages();
    fetchAllPackagesUn();



    //fetch all packages
    function fetchAllPackages() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllPackages' },
            success: function(response) {
                $("#showAllPackages").html(response);
                if ($('.datatable').length > 0) {
                    $('.datatable').DataTable({
                        "bFilter": true,
                        "stateSave": true,
                        "order": [
                            [5, "desc"],
                            [3, 'asc']
                        ]
                    });
                }
            }
        });
    }

    //fetch all packages
    function fetchAllPackagesUn() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllPackagesUnpublished' },
            success: function(response) {
                $("#showAllPackagesUnpublished").html(response);
                if ($('.datatable-2').length > 0) {
                    $('.datatable-2').DataTable({
                        "emptyTable": "No data available in table",
                        "bFilter": true,
                        "stateSave": true,
                        "order": [
                            [5, "desc"],
                            [3, 'asc']
                        ]
                    });
                }
            }
        });
    }


    //Fetch Package details
    $("body").on("click", ".packageDetailsIcon", function(e) {
        e.preventDefault();
        package_details_id = $(this).attr('id');
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { package_details_id: package_details_id },
            success: function(response) {
                data = JSON.parse(response);
                $("#getName").text(data.name + ' ' + '(ID: ' + data.id + ')');
                $("#getEvent").text('Event : ' + data.type_name);
                $("#getPrice").text('Price : ' + data.price);
                $("#getDescription").text('Description : ' + data.description);

                if (data.photo != '') {
                    $("#getImage").html('<img src="../admin/assets/php/' + data.photo + '" class="img-fluid align-self-center" width="280px" data-toggle="lightbox">');
                } else {
                    $("#getImage").html('<img src="../assets/img/placeholder.jpg" class="img-fluid align-self-center" width="280px">');
                }
            }
        });
    });


    //Publish package ajax reqest
    $("body").on("click", ".packagePublishIcon", function(e) {
        e.preventDefault();
        package_publish_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Selected package will be published!",
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
                    data: { package_publish_id: package_publish_id },
                    success: function(response) {
                        Swal.fire(
                            'Published!',
                            'Package Published Successfully.',
                            'success'
                        )

                        fetchAllPackages();
                        fetchAllPackagesUn();
                        setTimeout(function() {
                            //location.reload()
                            window.location = 'admin-package.php';
                        }, 2000);
                    }
                });
            }
        });
    });


    //Unpublish Unpublish ajax reqest
    $("body").on("click", ".packageUnpublishIcon", function(e) {
        e.preventDefault();
        package_unpublish_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Selected package will be Unpublished!",
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
                    data: { package_unpublish_id: package_unpublish_id },
                    success: function(response) {
                        Swal.fire(
                            'Unpublished!',
                            'Package Unpublished Successfully.',
                            'success'
                        )

                        fetchAllPackages();
                        fetchAllPackagesUn();
                        setTimeout(function() {
                            //location.reload()
                            window.location = 'admin-package.php';
                        }, 2000);
                    }
                });
            }
        });
    });

    //Delete package ajax reqest
    $("body").on("click", ".packageDeleteIcon", function(e) {
        e.preventDefault();
        package_delete_id = $(this).attr('id');
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
                    data: { package_delete_id: package_delete_id },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Package Deleted Successfully.',
                            'success'
                        )

                        fetchAllPackages();
                        fetchAllPackagesUn();
                        setTimeout(function() {
                            //location.reload()
                            window.location = 'admin-package.php';
                        }, 2000);
                    }
                });
            }
        });
    });






    //Create Package Ajax Request
    $("#package-create-form").submit(function(e) {
        e.preventDefault();
        $("#create-package-spinner").show();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response) {
                $("#create-package-spinner").hide();
                Swal.fire({
                    title: 'Package Created Successfully.',
                    icon: 'success'
                });
                setTimeout(function() {
                    //location.reload()
                    window.location = 'admin-package.php';
                }, 2000);
            }
        });
    });




    //Edit Package details
    $("body").on("click", ".packageEditIcon", function(e) {
        e.preventDefault();
        package_edit_id = $(this).attr('id');
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { package_edit_id: package_edit_id },
            success: function(response) {
                data = JSON.parse(response);
                $("#editTitle").text('Edit - ' + data.name + ' ');

                $("#edit_id").val(data.id);
                $("#editName").val(data.name);
                $("#editPrice").val(data.price);
                $("#editEvent").val(data.type_id);
                $("#editDescription").val(data.description);
                $("#oldImage").val(data.photo);
                $("#editImagePre").attr('src', '../admin/assets/php/' + data.photo);

            }
        });
    });

    //Update Package Ajax Request
    $("#package-update-form").submit(function(e) {
        e.preventDefault();
        $("#update-package-spinner").show();
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success: function(response) {
                $("#update-package-spinner").hide();
                Swal.fire({
                    title: 'Package Updated Successfully.',
                    icon: 'success'
                });
                setTimeout(function() {
                    //location.reload()
                    window.location = 'admin-package.php';
                }, 2000);
            }
        });
    });




    //File Upload Preview
    $("#fileUpload").on('change', function() {

        if (typeof(FileReader) != "undefined") {

            var image_holder = $("#image-holder");
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

    //File Upload Preview - Edit
    $("#fileUploadEdit").on('change', function() {

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


    //check notification ajax request
    checkNotification();

    function checkNotification() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'checkNotification' },
            success: function(response) {
                $("#checkNotification").html(response);
            }
        });
    }


});