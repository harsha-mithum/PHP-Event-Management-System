$(document).ready(function(){
	
	fetchAllDeletedUsers();

	//fetch all deleted users
	function fetchAllDeletedUsers(){
		$.ajax({
			url: 'assets/php/admin-action.php',
			method: 'post',
			data: { action: 'fetchAllDeletedUsers' },
			success: function(response){
				$("#showAllDeletedUsers").html(response);
				if ($('.datatable').length > 0) {
			        $('.datatable').DataTable({
			            "bFilter": true,
			            "order": [[ 0, "desc" ]]
			        });
			    }	
			}
		});
	}

	//Restore Deleted user ajax reqest
	$("body").on("click", ".restoreUserIcon", function(e){
		e.preventDefault();
		restore_id = $(this).attr('id');
		Swal.fire({
		title: 'Are you sure want to restore this user?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Restore it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: { restore_id: restore_id },
					success: function(response){
				    	Swal.fire(
				    		'Restored!',
				    		'User Restored Successfully.',
				    		'success'
				    	)

				    	fetchAllDeletedUsers();
					}
				});
			}
		});
	});

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