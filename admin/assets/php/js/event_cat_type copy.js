$(document).ready(function () {


    fetchAllCat();
    fetchAllCat();

/*

################ Event Cat ################

*/

    //fetch all event Cat
    function fetchAllCat() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { action: 'fetchAllCat' },
            success: function (response) {
                $("#showAllCat").html(response);
                if ($('.datatable').length > 0) {
                    $('.datatable').DataTable({
                        "bFilter": true,
                        "order": [[0, "asc"]],
                        paging: false,
                        searching: false,
                        select: true,
                        info: false
                    });
                }
                $("#editEventCat").hide();
            }
        });
    }

    //Fetch Cat details
    $("body").on("click", ".catEditIcon", function (e) {
        e.preventDefault();
        cat_details_id = $(this).attr('id');
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: { cat_details_id: cat_details_id },
            success: function (response) {
                data = JSON.parse(response);
                $("#createEventCat").hide();
                $("#editEventCat").show();
                $("#editCatID").val(data.id);
                $("#editCatName").val(data.name);
                $("#editEventCatCat").val(data.cat_id);
            }
            
        });
    });


    //Delete cat ajax reqest
    $("body").on("click", ".catDeleteIcon", function (e) {
        e.preventDefault();
        cat_delete_id = $(this).attr('id');
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
                    data: { cat_delete_id: cat_delete_id },
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'Event Cat Deleted Successfully.',
                            'success'
                        )
                        fetchAllCat();
                        setTimeout(function () {
                            //location.reload()
                            window.location = 'admin-event.php';
                        }, 2000);
                    }
                });
            }
        });
    });



	//Create Cat Ajax Request
	$("#cat-create-form").submit(function (e) {
		e.preventDefault();
		$("#create-cat-spinner").show();
		$.ajax({
			url: 'assets/php/admin-action.php',
			method: 'post',
			processData: false,
			contentType: false,
			cache: false,
			data: new FormData(this),
			success: function (response) {
				$("#create-cat-spinner").hide();
				Swal.fire({
					title: 'Event Category Created Successfully.',
					icon: 'success'
				});
				setTimeout(function () {
					//location.reload()
					window.location = 'admin-event.php';
				}, 2000);
			}
		});
	});


    	//Update Cat Ajax Request
	$("#cat-update-form").submit(function (e) {
		e.preventDefault();
		$("#update-cat-spinner").show();
		$.ajax({
			url: 'assets/php/admin-action.php',
			method: 'post',
			processData: false,
			contentType: false,
			cache: false,
			data: new FormData(this),
			success: function (response) {
				$("#update-cat-spinner").hide();
				Swal.fire({
					title: 'Event Category Updated Successfully.',
					icon: 'success'
				});
				setTimeout(function () {
					//location.reload()
					window.location = 'admin-event.php';
				}, 2000);
			}
		});
	});



});
