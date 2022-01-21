<?php

require_once 'admin-db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$admin = new Admin();
$user = new User();
session_start();


/* 

################ Login ################
 
*/


//Handle Admin Login Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'adminLogin') {
	$username = $admin->test_input($_POST['username']);
	$password = $admin->test_input($_POST['password']);
	

	$loggedInAdmin = $admin->admin_login($username);

	$hash = $loggedInAdmin['password'];

	if(password_verify($password,$hash)){
		echo 'admin_login';
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $hash;
	} else {
		echo $admin->showMessage('danger', 'Username or Password is incorrect.');
	}
}


//Handle change password ajax request
if (isset($_POST['action']) && $_POST['action'] == 'change_pass_admin') {
	$currentPass = $_POST['curPass'];
	$newPass = $_POST['newPass'];
	$confPass = $_POST['confPass'];
	$hnewPass = password_hash($currentPass, PASSWORD_DEFAULT);


	$hash = $_SESSION['password'];


	$number = preg_match('@[0-9]@', $confPass);
	$uppercase = preg_match('@[A-Z]@', $confPass);
	$lowercase = preg_match('@[a-z]@', $confPass);
	$specialChars = preg_match('@[^\w]@', $confPass);
	
	if ($newPass != $confPass) {
		echo $admin->showMessage('danger', 'Both password did not matched!');
	} else if (strlen($newPass) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
		echo $admin->showMessage('danger', "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.");
	} else {
		if (password_verify($currentPass, $hash)) {
			$admin->change_pass_admin($hnewPass);
				$admin->notification(1, 'admin', 'Admin Password Changed.');
			echo $admin->showMessage('success', 'Password changed successfully!');
		} else {
			echo $admin->showMessage('danger', 'Current password is incorrect!');
		}
	}
}

if (isset($_POST['action']) && $_POST['action'] == 'change_username') {
	$currentPass = $_POST['curPass'];
	$username = $_POST['username'];

	$hash = $_SESSION['password'];
	if (password_verify($currentPass, $hash)) {
		$data = $admin->change_username($username);
		echo $admin->showMessage('success', 'Username Changed');
	} else {
		echo $admin->showMessage('danger', 'Something went wrong.'.$hash);
	}
}


/* 

	################ Users ################

*/

//Handle Fetch all user list ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchUserList') {
	$output = '';
	$data = $admin->fetchAllUsers(1);
	$path = '../assets/php/';

	if ($data) {
		foreach ($data as $row) {
			$uid = $row['id'];
			$uname = $row['name'];
			echo "<option value='" . $uid . "'>" . $uname . "</option>";
		}
	}
}

//Handle Fetch all users ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers') {
	$output = '';
	$data = $admin->fetchAllUsers(1);
	$path = '';

	if ($data) {
		$output .= '<table class="datatable table table-stripped text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Name</th>
									<th>E-Mail</th>
									<th>Phone</th>
									<th>Gender</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {

			if ($row['photo'] != '') {
				$uphoto = $path . $row['photo'];
			} else {
				$uphoto = '../assets/img/profiles/avatar.png';
			}

			if ($row['verified'] == 1) {
				$verify = "<span class='badge badge-muted'>Verified</span>";
			} else {
				$verify = "<span class='badge badge-warning'>Not Verified</span>";
			}

			if ($row['deleted'] == 1) {
				$status = "<span class='badge badge-danger'>Deleted</span>";
			} else {
				$status = "<span class='text-success'>Active</span>";
			}

			$output .= '
								<tr>
									<td>' . $row['id'] . '</td>
									<td><img class="avatar-img rounded-circle" src="' . $uphoto . '" width="30"></td>
									<td>' . $row['name'] . '</td>
									<td>' . $row['email'] . '</td>
									<td>' . $row['phone'] . '</td>
									<td>' . $row['gender'] . '</td>
									<td>' . $status . " - " . $verify . '</td>
									
									<td>
										<a href="#" id="' . $row['id'] . '" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fa fa-info-circle"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Lock User" class="text-danger userDeleteIcon"><i class="far fa-trash"></i></a>
									</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any User Registred Yet!</h3>";
	}
}

//Handle Fetch all staff ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllStaff') {
	$output = '';
	$data = $admin->fetchAllStaff(1);
	$path = '../assets/php/';

	if ($data) {
		$output .= '<table class="datatable-3 table table-stripped text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Name</th>
									<th>E-Mail</th>
									<th>Phone</th>
									<th>Gender</th>
									<th>Designation</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {

			if ($row['photo'] != '') {
				$uphoto = $path . $row['photo'];
			} else {
				$uphoto = '../assets/img/profiles/avatar.png';
			}

			if ($row['verified'] == 1) {
				$verify = "<span class='badge badge-muted'>Verified</span>";
			} else {
				$verify = "<span class='badge badge-warning'>Not Verified</span>";
			}

			if ($row['deleted'] == 1) {
				$status = "<span class='badge badge-danger'>Deleted</span>";
			} else {
				$status = "<span class='text-success'>Active</span>";
			}

			$des = $row['designation'];

			$output .= '
								<tr>
									<td>' . $row['id'] . '</td>
									<td><img class="avatar-img rounded-circle" src="' . $uphoto . '" width="30"></td>
									<td>' . $row['name'] . '</td>
									<td>' . $row['email'] . '</td>
									<td>' . $row['phone'] . '</td>
									<td>' . $row['gender'] . '</td>
									<td>' . $des . "&nbsp;" . '<a href="#" id="' . $row['id'] . '" title="Edit Designation" class="text-success staffEditIcon" data-toggle="modal" data-target="#showStaffUpModal"><i class="far fa-edit"></i></a></td>
									<td>' . $status . " - " . $verify . '</td>
									
									<td>
										<a href="#" id="' . $row['id'] . '" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fa fa-info-circle"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Delete User" class="text-danger userDeleteIcon"><i class="far fa-trash"></i></a>
									</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Member Registered Yet!</h3>";
	}
}

//Handle show all deleted user ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllDeletedUsers') {
	$output = '';
	$data = $admin->fetchAllUsers(0);
	$path = '../assets/php/';

	if ($data) {
		$output .= '<table class="datatable-2 table table-stripped text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Name</th>
									<th>E-Mail</th>
									<th>Phone</th>
									<th>Gender</th>
									<th>Verified</th>
									<th>role</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {

			if ($row['photo'] != '') {
				$uphoto = $path . $row['photo'];
			} else {
				$uphoto = '../assets/img/profiles/avatar.png';
			}

			if ($row['verified'] == 1) {
				$verify = "<span class='badge badge-muted'>Verified</span>";
			} else {
				$verify = "<span class='badge badge-warning'>Not Verified</span>";
			}
			$output .= '
								<tr>
									<td>' . $row['id'] . '</td>
									<td><img class="avatar-img rounded-circle" src="' . $uphoto . '" width="30"></td>
									<td>' . $row['name'] . '</td>
									<td>' . $row['email'] . '</td>
									<td>' . $row['phone'] . '</td>
									<td>' . $row['gender'] . '</td>
									<td>' . $verify . '</td>
									<td>' . $row['role'] . '</td>
									<td>
										<a href="#" id="' . $row['id'] . '" title="Restore User" class=" btn btn-outline-success p-1 mx-1 restoreUserIcon"><i class="fal fa-trash-undo"></i>&nbsp;Restore</a>
										<a href="#" id="' . $row['id'] . '" title="Permanently Delete User" class="btn btn-outline-danger p-1 mx-1 userDeleteIcon2"><i class="fa fa-trash"></i></a>
									</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any User Deleted Yet!</h3>";
	}
}
//Handle view user ajax request
if (isset($_POST['details_id'])) {
	$id = $_POST['details_id'];
	$data = $admin->fetchUserDetailsById($id);
	echo json_encode($data);
}

//Handle delete user ajax request
if (isset($_POST['delete_id'])) {
	$id = $_POST['delete_id'];
	$admin->userAction($id, 1);
}

//Handle Deleted User Restore rwquest
if (isset($_POST['restore_id'])) {
	$id = $_POST['restore_id'];
	$admin->userAction($id, 0);
}

//Handle Deleted User Restore rwquest
if (isset($_POST['del_id'])) {
	$id = $_POST['del_id'];
	$admin->userActionDel($id);
}

//Handle edit staff designation ajax request
if (isset($_POST['staff_des_edit_id'])) {
	$id = $_POST['staff_des_edit_id'];
	$data = $admin->fetchUserDetailsById($id);
	echo json_encode($data);
}
//Handle edit staff designation ajax request
if (isset($_POST['admin-details'])) {
	$id = $_POST['admin-details'];
	$data = $admin->fetchAdminDetails();
	echo json_encode($data);
}

//Handle Update Designation request
if (isset($_POST['edit_designation'])) {
	$id = $_POST['edit_id'];
	$val = $_POST['edit_designation'];
	$admin->staffDesignation($id, $val);
}

//Handle Register User Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'register-user') {
	$name = $user->test_input($_POST['name']);
	$email = $user->test_input($_POST['email']);
	$phone = $user->test_input($_POST['phone']);
	$city = $user->test_input($_POST['city']);

	$role = "user";
	$pass = $user->random_string();
	$password = password_hash($pass, PASSWORD_DEFAULT);

	if ($user->user_exist($email)) {
		echo $user->showMessage('warning', 'This E-Mail is already registred.');
	} else {
		if ($user->register($name, $email, $phone, $city, $password, $role)) {

			//	$_SESSION['user'] = $email;
			$name = $user->test_input($_POST['name']);

			$token = uniqid();
			$token = str_shuffle($token);
			$user->forgot_password($token, $email);

			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = Database::USERNAME;
			$mail->Password = Database::PASSWORD;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;

			$mail->setFrom(Database::USERNAME, 'Ideagraphy Studio');
			$mail->addAddress($email);

			$mail->isHTML(true);
			$mail->Subject = 'E-Mail Verification';
			$mail->Body = '<h3>Welcome ' . $name . ',</h3><br>
			<p>Password for your acccount is:<b> ' . $pass . '<b></p>
			<p>Click the below link to verify your email address.</p>
			<a href="http://ideagraphy.lk/verify-email.php?email=' . $email . '&token=' . $token . '">http://ideagraphy.lk/verify-email.php?email=' . $email . '&token=' . $token . '</a>
			<br><br><br>Regards,<br>Ideagraphy Studio';

			$mail->send();

			echo 'register-user';
		} else {
			echo $user->showMessage('danger', 'Something went wrong. Try again later.');
		}
	}
}


//Handle Register Staff Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'register-staff') {
	$name = $user->test_input($_POST['sname']);
	$email = $user->test_input($_POST['semail']);
	$phone = $user->test_input($_POST['sphone']);
	$city = $user->test_input($_POST['scity']);
	$designation = $user->test_input($_POST['designation']);

	$role = "staff";
	$pass = $user->random_string();
	$password = password_hash($pass, PASSWORD_DEFAULT);

	if ($user->user_exist($email)) {
		echo $user->showMessage('warning', 'This E-Mail is already registred.');
	} else {
		if ($user->register_staff($name, $email, $phone, $city, $designation, $password, $role)) {

			//	$_SESSION['user'] = $email;
			$name = $user->test_input($_POST['sname']);

			$token = uniqid();
			$token = str_shuffle($token);
			$user->forgot_password($token, $email);

			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = Database::USERNAME;
			$mail->Password = Database::PASSWORD;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;

			$mail->setFrom(Database::USERNAME, 'Ideagraphy Studio');
			$mail->addAddress($email);

			$mail->isHTML(true);
			$mail->Subject = 'E-Mail Verification';
			$mail->Body = '<h3>Welcome ' . $name . ',</h3><br>
			<p>Password for your acccount is:<b> ' . $pass . '<b></p>
			<p>Click the below link to verify your email address.</p>
			<a href="http://ideagraphy.lk/verify-email.php?email=' . $email . '&token=' . $token . '">http://ideagraphy.lk/verify-email.php?email=' . $email . '&token=' . $token . '</a>
			<br><br><br>Regards,<br>Ideagraphy Studio';

			$mail->send();
			echo 'register-staff';
		} else {
			echo $user->showMessage('danger', 'Something went wrong. Try again later.');
		}
	}
}


/* 

	################ Notes ################

*/

//Handle show all notes user ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllNotes') {
	$output = '';
	$note = $admin->fetchAllNotes();

	if ($note) {
		$output .= '<table class="datatable table table-stripped text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>Username</th>
									<th>User Email</th>
									<th>Note Title</th>
									<th>Note</th>
									<th>Written On</th>
									<th>Updated On</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($note as $row) {

			$output .= '
								<tr>
									<td>' . $row['id'] . '</td>
									<td>' . $row['name'] . '</td>
									<td>' . $row['email'] . '</td>
									<td>' . $row['title'] . '</td>
									<td>' . $row['note'] . '</td>
									<td>' . $row['created_at'] . '</td>
									<td>' . $row['updated_at'] . '</td>
									<td>
										<a href="#" id="' . $row['id'] . '" title="Delete Note" class="text-danger deleteNoteIcon"><i class="fa fa-trash"></i></a>
									</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Note Written Yet!</h3>";
	}
}

//Handle Delete note of an user Ajax Reqest

if (isset($_POST['note_id'])) {
	$id = $_POST['note_id'];
	$admin->deleteNoteOfUser($id);
}


/* 

	################ Feedback ################

*/

//Handle show all feedback user ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllFeedback') {
	$output = '';
	$feedback = $admin->fetchFeedback();

	if ($feedback) {
		$output .= '<table class="datatable table table-stripped text-center">
							<thead>
								<tr>
									<th>FID</th>
									<th>UID</th>
									<th>Username</th>
									<th>User Email</th>
									<th>Subject</th>
									<th>Feedback</th>
									<th>Sent On</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($feedback as $row) {

			$output .= '
								<tr>
									<td>' . $row['id'] . '</td>
									<td>' . $row['uid'] . '</td>
									<td>' . $row['name'] . '</td>
									<td>' . $row['email'] . '</td>
									<td>' . $row['subject'] . '</td>
									<td>' . $row['feedback'] . '</td>
									<td>' . $row['created_at'] . '</td>
									<td>
										<a href="#" fid="' . $row['id'] . '" id="' . $row['uid'] . '" title="Reply" class="text-primary replyFeedbackIcon" data-toggle="modal" data-target="#showReplyModal"><i class="fa fa-reply"></i></a>
									</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Feedback Written Yet!</h3>";
	}
}

//Handle reply Feedback of user Ajax Reqest
if (isset($_POST['message'])) {
	$uid = $_POST['uid'];
	$message = $admin->test_input($_POST['message']);
	$fid = $_POST['fid'];

	$admin->replyFeedback($uid, $message);
	$admin->feedbackReplied($fid);
}


/* 

	################ Notification ################

*/

//Handle Fetch Notification Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'fetchNotification') {
	$notification = $admin->fetchNotification();
	$output = '';
	if ($notification) {
		foreach ($notification as $row) {
			$output .= '<div class="alert alert-dark" role="alert">
								<button type="button" id="' . $row['id'] . '" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="alert-heading">New Notification</h4>
								<p class="mb-0 lead">' . $row['message'] . ' by ' . $row['name'] . '</p>
								<hr class="my-2">
								<p class="mb-0 float-left"><b>User E-Mail: </b>' . $row['email'] . '</p>
								<p class="mb-0 float-right">' . $admin->timeInAgo($row['created_at']) . '</p>
								<div class="clearfix"></div>
							</div>';
		}
		echo $output;
	} else {
		echo '<h3 class="text-center">No any new notifications.</h3>';
	}
}

//check notification
if (isset($_POST['action']) && $_POST['action'] == 'checkNotification') {
	if ($admin->fetchNotification()) {
		echo '<span class="badge badge-danger badge-pill">' . $admin->countNotification() . '</span>';
	} else {
		echo '';
	}
}

//Remove admin Notification
if (isset($_POST['notification_id'])) {
	$id = $_POST['notification_id'];
	$admin->removeNotification($id);
}


//Remove admin Notification
if (isset($_POST['action']) && $_POST['action'] == 'notification_clear') {
	$admin->clearNotification();
}


/* 

	################ Packages ################

*/

//Handle Fetch all packages ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllPackages') {
	$output = '';
	$data = $admin->fetchAllPackages(1);
	$path = '../admin/assets/php/';

	if ($data) {
		$output .= '<table class="datatable table table-stripped text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>Photo</th>
									<th>Name</th>
									<th>Price</th>
									<th>Description</th>
									<th>Event</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {

			if ($row['photo'] != '') {
				$uphoto = $path . $row['photo'];
			} else {
				$uphoto = '../assets/img/placeholder.jpg';
			}

			$output .= '
								<tr>
									<td>' . $row['id'] . '</td>
									<td><a href="' . $uphoto . '" data-toggle="lightbox"><img class="avatar-img img-fluid" src="' . $uphoto . '" width="100" ></a></td>
									<td>' . $row['name'] . '</td>
									<td>' . number_format($row['price'], 2) . '</td>
									<td class="text-left">' . $row['description'] . '</td>
									<td>' . $row['event'] . '</td>
									<td>
										<a href="#" id="' . $row['id'] . '" title="View Details" class="text-info packageDetailsIcon" data-toggle="modal" data-target="#showPackageDetailsModal"><i class="fa fa-fw fa-info-circle"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Update Details" class="text-dark packageEditIcon" data-toggle="modal" data-target="#showPackageEditModal"><i class="fal fa-fw fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Unpublish Package" class="text-dark packageUnpublishIcon"><i class="fad fa-eye-slash"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Delete Package" class="text-danger packageDeleteIcon"><i class="fa fa-fw fa-trash"></i></a>&nbsp;&nbsp;&nbsp;
										</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Packages Created Yet!</h3>";
	}
}


//Handle Fetch all packages ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllPackagesUnpublished') {
	$output = '';
	$data = $admin->fetchAllPackages(0);
	$path = '../admin/assets/php/';

	if ($data) {
		$output .= '<table class="datatable-2 table table-stripped text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>Photo</th>
									<th>Name</th>
									<th>Price</th>
									<th>Description</th>
									<th>Event</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {

			if ($row['photo'] != '') {
				$uphoto = $path . $row['photo'];
			} else {
				$uphoto = '../assets/img/placeholder.jpg';
			}

			$output .= '
								<tr>
									<td>' . $row['id'] . '</td>
									<td><a href="' . $uphoto . '" data-toggle="lightbox"><img class="avatar-img img-fluid" src="' . $uphoto . '" width="100" ></a></td>
									<td>' . $row['name'] . '</td>
									<td>' . number_format($row['price'], 2) . '</td>
									<td>' . $row['description'] . '</td>
									<td>' . $row['event'] . '</td>
									<td>
										<a href="#" id="' . $row['id'] . '" title="View Details" class="text-info packageDetailsIcon" data-toggle="modal" data-target="#showPackageDetailsModal"><i class="fa fa-fw fa-info-circle"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Update Details" class="text-dark packageEditIcon" data-toggle="modal" data-target="#showPackageEditModal"><i class="fal fa-fw fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Re-Publish Package" class="text-success packagePublishIcon"><i class="fas fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Delete Package" class="text-danger packageDeleteIcon"><i class="fa fa-fw fa-trash"></i></a>&nbsp;&nbsp;&nbsp;
										</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Packages Un-Published!</h3>";
	}
}


//Create Package Upload Image
if (isset($_POST['pname'])) {
	$name = $admin->test_input($_POST['pname']);
	$price = $admin->test_input($_POST['price']);
	$description = $admin->test_input($_POST['description']);
	$event_id = $admin->test_input($_POST['event']);



	$folder = 'uploads/packages/';

	if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {

		$temp = explode(".", $_FILES["image"]["name"]);
		$newfilename = $event_id . "_" . $name . '.' . end($temp);

		$newImage = $folder . $newfilename;
		move_uploaded_file($_FILES["image"]["tmp_name"], $newImage);

		$admin->create_package($name, $newImage, $price, $description, $event_id);
	}
}



//Handle update package ajax request
if (isset($_POST['edit_pname'])) {
	$id = $admin->test_input($_POST['edit_id']);
	$name = $admin->test_input($_POST['edit_pname']);
	$price = $admin->test_input($_POST['edit_price']);
	$description = $admin->test_input($_POST['edit_description']);
	$event_id = $admin->test_input($_POST['edit_event']);

	$newFile = $admin->test_input($_FILES['edit_image']['name']);
	$oldImage = $admin->test_input($_POST['oldImage']);
	$folder = 'uploads/packages/';

	if ($newFile != null) {
		$temp = explode(".", $_FILES["edit_image"]["name"]);
		$newfilename = $event_id . "_" . $name . '.' . end($temp);

		$newImage = $folder . $newfilename;
		move_uploaded_file($_FILES["edit_image"]["tmp_name"], $newImage);
	} else {
		$newImage = $oldImage;
	}
	$admin->update_package($name, $newImage, $price, $description, $event_id, $id);
}

//Handle view package ajax request
if (isset($_POST['package_details_id'])) {
	$id = $_POST['package_details_id'];
	$data = $admin->fetchPackageDetailsById($id);
	echo json_encode($data);
}
//Handle edit package ajax request
if (isset($_POST['package_edit_id'])) {
	$id = $_POST['package_edit_id'];
	$data = $admin->fetchPackageDetailsById($id);
	echo json_encode($data);
}
//Handle publish package ajax request
if (isset($_POST['package_publish_id'])) {
	$id = $_POST['package_publish_id'];
	$admin->packageAction($id, 0);
}
//Handle unpublish package ajax request
if (isset($_POST['package_unpublish_id'])) {
	$id = $_POST['package_unpublish_id'];
	$admin->packageAction($id, 1);
}
//Handle delete package ajax request
if (isset($_POST['package_delete_id'])) {
	$id = $_POST['package_delete_id'];
	$admin->packageDeleteAction($id);
}


/* 

	################ Event Types ################

*/

//Handle Fetch all event types ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllTypes') {
	$output = '';
	$data = $admin->fetchAllTypes();
	$path = '../admin/assets/php/';

	if ($data) {
		$output .= '<table class="datatable table table-stripped text-center hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Category</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {
			$output .= '
								<tr>
									<td>' . $row['id'] . '</td>
									<td>' . $row['name'] . '</td>
									<td>' . $row['cat_id'] . '</td>
									<td>
										<a href="#" id="' . $row['id'] . '" title="Update Details" class="text-info typeEditIcon"  data-target="#showTypeEdit"><i class="fal fa-fw fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Delete Type" class="text-danger typeDeleteIcon"><i class="far fa-fw fa-trash"></i></a>
										</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Event Types Created Yet!</h3>";
	}
}
//Handle view type ajax request
if (isset($_POST['type_details_id'])) {
	$id = $_POST['type_details_id'];
	$data = $admin->fetchTypeDetailsById($id);
	echo json_encode($data);
}
//Handle delete type ajax request
if (isset($_POST['type_delete_id'])) {
	$id = $_POST['type_delete_id'];
	$admin->typeDeleteAction($id);
}
//Update Type
if (isset($_POST['editTypeID'])) {
	$id = $admin->test_input($_POST['editTypeID']);
	$name = $admin->test_input($_POST['editTypeName']);
	$cat_id = $admin->test_input($_POST['edit_event_cat']);
	$admin->update_type($name, $cat_id, $id);
}
//Create Type
if (isset($_POST['typeName'])) {
	$name = $admin->test_input($_POST['typeName']);
	$cat = $admin->test_input($_POST['event_cat']);
	$admin->create_type($name, $cat);
}



/* 

	################ Event Category ################

*/

//Handle Fetch all event Category ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllCat') {
	$output = '';
	$data = $admin->fetchAllCat();
	$path = '../admin/assets/php/';

	if ($data) {
		$output .= '<table class="datatable-2 table table-stripped text-center hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {
			$output .= '
								<tr>
									<td>' . $row['id'] . '</td>
									<td>' . $row['name'] . '</td>
									<td>
										<a href="#" id="' . $row['id'] . '" title="Update Details" class="text-info catEditIcon"  data-target="#showCatEdit"><i class="fal fa-fw fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['id'] . '" title="Delete Category" class="text-danger catDeleteIcon"><i class="far fa-fw fa-trash"></i></a>
										</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Event Category Created Yet!</h3>";
	}
}
//Handle view cat ajax request
if (isset($_POST['cat_details_id'])) {
	$id = $_POST['cat_details_id'];
	$data = $admin->fetchCatDetailsById($id);
	echo json_encode($data);
}
//Handle delete cat ajax request
if (isset($_POST['cat_delete_id'])) {
	$id = $_POST['cat_delete_id'];
	$admin->catDeleteAction($id);
}
//Update cat
if (isset($_POST['editCatID'])) {
	$id = $admin->test_input($_POST['editCatID']);
	$name = $admin->test_input($_POST['editCatName']);
	$admin->update_cat($name, $id);
}
//Create Type
if (isset($_POST['catName'])) {
	$name = $admin->test_input($_POST['catName']);
	$admin->create_cat($name);
}



/* 

	################ Event  ################

*/




//Handle Fetch all events ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllEvents') {
	$output = '';
	$data = $admin->fetchAllEvents(1);
	$path = '../admin/assets/php/';

	if ($data) {
		$output .= '<table class="datatable table hover table-stripped text-center">
							<thead>
								<tr>
									
									<th>Event</th>
									<th>Title</th>
									<th>Location</th>
									<th>Event Date</th>
									<th>Time</th>
									<th>Guests</th>
									<th>User</th>
									<th>Contact</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {
			$output .= '
								<tr>
									
									<td>' . $row['type'] . '</td>
									<td>' . $row['title'] . '</td>
									<td>' . $row['location'] . '</td>
									<td>' . $row['start_date'] . '</td>
									<td>' . $row['time'] . '</td>
									<td>' . $row['people'] . '</td>
									<td>' . $row['user_name'] . '</td>
									<td>' . $row['user_phone'] . '</td>

								
									
									<td >
										<a href="admin-event-view.php?id=' . $row['id'] . '" id="' . $row['id'] . '" title="View Details" class=" btn btn-outline-info mx-1 p-1 px-2 eventDetailsIcon" >View</a>
										<a href="#" id="' . $row['id'] . '" title="Update Details" class=" btn btn-outline-success mx-1 p-1 eventEditIcon" data-toggle="modal" data-target="#showPackageEditModal"><i class="fal fa-fw fa-edit"></i></a>
										<a href="#" id="' . $row['id'] . '" title="Cancel Event" class=" btn btn-outline-secondary mx-1 p-1 eventCancelIcon"><i class="fal fa-fw fa-times"></i></a>
										<a href="#" id="' . $row['id'] . '" title="Delete Event" class="btn btn-outline-danger mx-1 p-1 eventDeleteIcon"><i class="fas fa-fw fa-trash"></i></a>
										</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Events Created Yet!</h3>";
	}
}





//Create Event
if (isset($_POST['create-event'])) {

	$title = $admin->test_input($_POST['title']);
	$location = $admin->test_input($_POST['location']);
	$date = $admin->test_input($_POST['date']);
	$time = $admin->test_input($_POST['time']);
	$people = $admin->test_input($_POST['guest']);

	$type = $admin->test_input($_POST['eventType']);
	$package = $admin->test_input($_POST['package']);
	$cameramen = $admin->test_input($_POST['cameramen']);

	$uid = $admin->test_input($_POST['user_id']);
	$name = $admin->test_input($_POST['user_name']);
	$address = $admin->test_input($_POST['user_address']);
	$email = $people = $admin->test_input($_POST['user_email']);
	$phone = $admin->test_input($_POST['user_phone']);

	$admin->create_event($title, $location, $date, $time, $people, $type, $package, $cameramen, $uid, $name, $address, $email, $phone);
	//	 $admin->create_event($uid, $name, $address, $email, $phone);

}

//Progress Event Details

//fetch progress
if (isset($_POST['progress'])) {
	$id = $_POST['progress'];
	$data = $admin->fetchProgressById($id);
	echo json_encode($data);
}

//insert progress
if (isset($_POST['progress_submit'])) {
	$id = $_POST['event_id'];
	$val = $_POST['progress_submit'];
	$admin->save_progress($id, $val);
}


//Insert Event
if (isset($_POST["event_title"])) {
	$query = "
 INSERT INTO event 
 (title, start_event, end_event) 
 VALUES (:title, :start_event, :end_event)
 ";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':title'  => $_POST['event_title'],
			':start_event' => $_POST['start'],
			':end_event' => $_POST['end']
		)
	);
}


//Handle view type ajax request
if (isset($_POST['type_details_id'])) {
	$id = $_POST['type_details_id'];
	$data = $admin->fetchTypeDetailsById($id);
	echo json_encode($data);
}
//Handle view package ajax request
if (isset($_POST['package_type_id'])) {
	$id = $_POST['package_type_id'];
	$output = '';
	$data[] = $admin->fetchPackageDetailsByType($id);


	if ($data) {
		foreach ($data as $row) {
			//echo '<option value = "' . $row['id'] . '" >' . $row['name'] . '</option>';
			$row['id'] ??= '0';
			$row['name'] ??= 'Not Available';
			$row['name'] ??= '';
			echo '<option value = "' . $row['id'] . '" >' . $row['name'] . " - " . number_format($row['price'], 2) . '</option>';
		}
	}
}

















/* 

	################ Album  ################

*/




//Handle Fetch all albums ajax request
if (isset($_POST['album_event_id'])) {
	$id = $admin->test_input($_POST['album_event_id']);
	$output = '';
	$path = '../admin/assets/php/';
	$data = $admin->fetchAlbumByEvent($id);
	if (!$data) {
		echo '<h1 class="m-5 text-center">No Album information available.</h1>';
	} else {
		foreach ($data as $row) {

			if ($row['cover_image'] != '') {
				$uphoto = $path . $row['cover_image'];
			} else {
				$uphoto = '../assets/img/placeholder.jpg';
			}

			$output = '<div class="col-xl-3 col-sm-4 col-12  ">
							
                                
								<a title="' . $row['title'] . '" id="' . $row['id'] . '" class="btn text-info  albumViewIcon " >
									<div class="card  shadow-lg border-secondary border">
										<div class=" image_area">
											<img class="avatar-img rounded border border-secondary img-fluid" src="' . $uphoto . '"  >

											<div class="overlay">
													<a class="btn btn-primary text-white albumEditIcon" data-toggle="modal" data-target="#albumEditModal"  id=' . $row['id'] . '">Edit</a>
													<a class="btn btn-danger text-white albumDeleteIcon" id=' . $row['id'] . '">Delete</a>
											</div>
										</div>
										<div class="m-2 text-center">
										<p >' . $row['title'] . '</p>
										<input type="hidden" id="alb_title" value="' . $row['title'] . '">
										</div>
										
									
									</div>
								</a>
                        </div>';

			echo $output;
		}
	}
}

//Handle delete album ajax request
if (isset($_POST['album_delete'])) {
	$id = $_POST['album_delete'];
	$title = $_POST['alb_dlt_name'];
	$event_id = $_POST['alb_dlt_id'];
	$data = $admin->albumDeleteAction($id);

	$folder = $event_id . '-' . $title;
	$src = 'uploads/albums/' . $folder;

	if ($data) {
		if (file_exists($src)) {
			$dir = opendir($src);
			while (false !== ($file = readdir($dir))) {
				if (($file != '.') && ($file != '..')) {
					$full = $src . '/' . $file;
					if (is_dir($full)) {
						rmdir($full);
					} else {
						unlink($full);
					}
				}
			}
			closedir($dir);
			rmdir($src);
		}
	}
}


//Create Album Upload Image
if (isset($_POST['alb_name'])) {
	$title = $admin->test_input($_POST['alb_name']);
	$id = $admin->test_input($_POST['event_id']);

	$folder = $id . "-" . $title;
	$path = 'uploads/albums/' . $folder . '/';

	$data = $admin->album_exist($title, $id);

	if (!$data) {

		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}

		if (isset($_FILES['alb_cover']['name']) && ($_FILES['alb_cover']['name'] != "")) {

			$temp = explode(".", $_FILES["alb_cover"]["name"]);
			$newfilename = "album_cover" . '.' . end($temp);

			$newImage = $path . $newfilename;
			move_uploaded_file($_FILES["alb_cover"]["tmp_name"], $newImage);

			$admin->create_album($title, $newImage, $id);
		}

		echo 'Done';
	} else {
		echo '<div class=" text-warning p-2 m-3">Album Title already used, please check and try again.</div>';
	}
}

//Handle update package ajax request
if (isset($_POST['alb_up_name'])) {
	$id = $admin->test_input($_POST['album_up_id']);
	$name = $admin->test_input($_POST['alb_up_name']);
	$event_id = $admin->test_input($_POST['edit_id']);
	$oldName = $admin->test_input($_POST['oldName']);

	$newFile = $admin->test_input($_FILES['edit_image']['name']);
	$oldImage = $admin->test_input($_POST['oldImage']);

	$newfolder = $event_id . "-" . $name;
	$oldFolder = $event_id . "-" . $oldName;

	$data = $admin->album_exist($name, $event_id);

	if (($data != $name) && $name === $oldName) {

		if ($name !== $oldName) {
			$newpath = 'uploads/albums/' . $newfolder . '/';
			$oldpath = 'uploads/albums/' . $oldFolder . '/';
			rename($oldpath, $newpath);
			$path = 'uploads/albums/' . $newfolder . '/';
		} else {
			$path = 'uploads/albums/' . $oldFolder . '/';
		}

		if ($newFile != null) {
			$temp = explode(".", $_FILES["edit_image"]["name"]);
			$newfilename = "album_cover" . '.' . end($temp);
			$newImage = $path . $newfilename;
			move_uploaded_file($_FILES["edit_image"]["tmp_name"], $newImage);
		} else {
			$temp = explode(".", $_POST['oldImage']);
			$newfilename = "album_cover" . '.' . end($temp);
			$newImage =  $path . $newfilename;
		}

		$admin->update_album($name, $newImage, $id);

		echo 'Done';
	} else {

		echo '<div class="border bg-warning p-2 m-3">Album Title already used, please check and try again.</div>';
	}
}



//Handle edit album ajax request
if (isset($_POST['album_edit_id'])) {
	$id = $_POST['album_edit_id'];
	$data = $admin->fetchAlbumDetailsById($id);
	echo json_encode($data);
}











//////////////////////////////////////////////////////////////
////////////////////////// Search ////////////////////////////
//////////////////////////////////////////////////////////////

if (isset($_POST['search_user'])) {
	$inpText = $_POST['search_user'];
	$data = $admin->search_user($inpText);

	if ($data) {
		foreach ($data as $row) {
			echo '<a  href="#" class="list-group-item list-group-item-action border-1 list-user" id="' . $row['id'] . '" >' . $row['name'] . '</a>';
		}
	} else {
		echo '<p class="list-group-item border-1">No Record</p>';
	}
}




/* 

	################ Export ################

*/


//Handle Export All Users in Excel
if (isset($_GET['export-users']) && $_GET['export-users'] == 'excel') {
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=users.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	$data = $admin->exportAllUsers();

	echo '<table border="1" align="center">';
	echo '<tr>
				<th>#</th>
				<th>Name</th>
				<th>E-Mail</th>
				<th>Phone</th>
				<th>Gender</th>
				<th>DOB</th>
				<th>Address</th>
				<th>Joined On</th>
				<th>Verified</th>
				<th>Deleted</th>
    		  </tr>';
	foreach ($data as $row) {
		echo '<tr>
					<td>' . $row['id'] . '</td>
					<td>' . $row['name'] . '</td>
					<td>' . $row['email'] . '</td>
					<td>' . $row['phone'] . '</td>
					<td>' . $row['gender'] . '</td>
					<td>' . $row['dob'] . '</td>
					<td>' . $row['address'] . '</td>
					<td>' . $row['created_at'] . '</td>
					<td>' . $row['verified'] . '</td>
					<td>' . $row['deleted'] . '</td>
				  </tr>';
	}

	echo '</table>';
}



//Handle Export All Staff in Excel
if (isset($_GET['export-staff']) && $_GET['export-staff'] == 'excel') {
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=team.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	$data = $admin->exportAllStaff();

	echo '<table border="1" align="center">';
	echo '<tr>
				<th>#</th>
				<th>Name</th>
				<th>E-Mail</th>
				<th>Phone</th>
				<th>Gender</th>
				<th>DOB</th>
				<th>Address</th>
				<th>Joined On</th>
				<th>Verified</th>
				<th>Deleted</th>
    		  </tr>';
	foreach ($data as $row) {
		echo '<tr>
					<td>' . $row['id'] . '</td>
					<td>' . $row['name'] . '</td>
					<td>' . $row['email'] . '</td>
					<td>' . $row['phone'] . '</td>
					<td>' . $row['gender'] . '</td>
					<td>' . $row['dob'] . '</td>
					<td>' . $row['address'] . '</td>
					<td>' . $row['created_at'] . '</td>
					<td>' . $row['verified'] . '</td>
					<td>' . $row['deleted'] . '</td>
				  </tr>';
	}

	echo '</table>';
}


//Handle Export All Packages in Excel
if (isset($_GET['export-packages']) && $_GET['export-packages'] == 'excel') {
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=packsges.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	$data = $admin->exportAllPackages();

	echo '<table border="1" align="center">';
	echo '<tr>
				<th>#</th>
				<th>Name</th>
				<th>Price</th>
				<th>Description</th>
				<th>Event</th>
				<th>Deleted</th>
    		  </tr>';
	foreach ($data as $row) {
		echo '<tr>
					<td>' . $row['id'] . '</td>
					<td>' . $row['name'] . '</td>
					<td>' . $row['price'] . '</td>
					<td>' . $row['description'] . '</td>
					<td>' . $row['event'] . '</td>
					<td>' . $row['unavailable'] . '</td>
				  </tr>';
	}

	echo '</table>';
}



//// EXport DATABASE ///////////

if (isset($_GET['export-db']) && $_GET['export-db'] == 'sql') {


	// Database configuration
	$host = "localhost";
	$username = "root";
	$password = "";
	$database_name = "studio";
	// Get connection object and set the charset
	$conn = mysqli_connect($host, $username, $password, $database_name);
	$conn->set_charset("utf8");
	// Get All Table Names From the Database
	$tables = array();
	$sql = "SHOW TABLES";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_row($result)) {
		$tables[] = $row[0];
	}
	$sqlScript = "";
	foreach ($tables as $table) {
		// Prepare SQLscript for creating table structure
		$query = "SHOW CREATE TABLE $table";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_row($result);
		$sqlScript .= "\n\n" . $row[1] . ";\n\n";
		$query = "SELECT * FROM $table";
		$result = mysqli_query($conn, $query);
		$columnCount = mysqli_num_fields($result);
		// Prepare SQLscript for dumping data for each table
		for ($i = 0; $i < $columnCount; $i++) {
			while ($row = mysqli_fetch_row($result)) {
				$sqlScript .= "INSERT INTO $table VALUES(";
				for ($j = 0; $j < $columnCount; $j++) {
					$row[$j] = $row[$j];
					if (isset($row[$j])) {
						$sqlScript .= '"' . $row[$j] . '"';
					} else {
						$sqlScript .= '""';
					}
					if ($j < ($columnCount - 1)) {
						$sqlScript .= ',';
					}
				}
				$sqlScript .= ");\n";
			}
		}

		$sqlScript .= "\n";
	}

	if (!empty($sqlScript)) {
		// Save the SQL script to a backup file
		$backup_file_name = $database_name . '_backup_' . time() . '.sql';
		$fileHandler = fopen($backup_file_name, 'w+');
		$number_of_lines = fwrite($fileHandler, $sqlScript);
		fclose($fileHandler);
		// Download the SQL backup file to the browser
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($backup_file_name));
		ob_clean();
		flush();
		readfile($backup_file_name);
		exec('rm ' . $backup_file_name);
	}
}






/* 

	################ Posts ################

*/

//Handle Fetch all posts ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllPosts') {
	$output = '';
	$data = $admin->fetchAllPosts(1);
	$path = '../admin/assets/php/';

	if ($data) {
		$output .= '<table class="datatable table table-stripped text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>Photo</th>
									<th>Title</th>
									<th>Event</th>
									<th>Event Date</th>
									<th>Created</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {

			if ($row['post_image'] != '') {
				$uphoto = $path . $row['post_image'];
			} else {
				$uphoto = '../assets/img/placeholder.jpg';
			}

			$output .= '
								<tr>
									<td>' . $row['post_id'] . '</td>
									<td><a href="' . $uphoto . '" data-toggle="lightbox"><img class="avatar-img img-fluid" src="' . $uphoto . '" width="100" ></a></td>
									<td>' . $row['post_title'] . '</td>
									<td>' . $row['event'] . '</td>
									<td>' . $row['event_date'] . '</td>
									<td>' . $row['post_date'] . '</td>
									<td>
										<a href="admin-posts-view.php?id='.$row['post_id'].'" id="' . $row['post_id'] . '" title="View Details" class="text-info postDetailsIcon" ><i class="fa fa-fw fa-info-circle"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="admin-posts-edit.php?id='.$row['post_id'].'" id="' . $row['post_id'] . '" title="Update Details" class="text-dark postEditIcon" ><i class="fal fa-fw fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['post_id'] . '" title="Unpublish Post" class="text-dark postUnpublishIcon"><i class="fad fa-eye-slash"></i></a>
										<a href="#" id="' . $row['post_id'] . '" title="Delete Post" class="text-danger postDeleteIcon"><i class="fa fa-fw fa-trash"></i></a>
										</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Posts Created Yet!</h3>";
	}
}


//Handle Fetch all posts ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllPostsUnpublished') {
	$output = '';
	$data = $admin->fetchAllPosts(0);
	$path = '../admin/assets/php/';

	if ($data) {
		$output .= '<table class="datatable-2 table table-stripped text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>Photo</th>
									<th>Title</th>
									<th>Event</th>
									<th>Event Date</th>
									<th>Created</th>
									<th>Action</th>
								</tr>
							</thead>
						<tbody>
						';
		foreach ($data as $row) {

			if ($row['post_image'] != '') {
				$uphoto = $path . $row['post_image'];
			} else {
				$uphoto = '../assets/img/placeholder.jpg';
			}

			$output .= '
								<tr>
									<td>' . $row['post_id'] . '</td>
									<td><a href="' . $uphoto . '" data-toggle="lightbox"><img class="avatar-img img-fluid" src="' . $uphoto . '" width="100" ></a></td>
									<td>' . $row['post_title'] . '</td>
									<td>' . $row['event'] . '</td>
									<td>' . $row['event_date'] . '</td>
									<td>' . $row['post_date'] . '</td>
									<td>
										<a href="admin-posts-view.php?id='.$row['post_id'].'" id="' . $row['post_id'] . '" title="View Details" class="text-info postDetailsIcon" ><i class="fa fa-fw fa-info-circle"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="admin-posts-edit.php?id='.$row['post_id'].'" id="' . $row['post_id'] . '" title="Update Details" class="text-dark postEditIcon" ><i class="fal fa-fw fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="#" id="' . $row['post_id'] . '" title="Unpublish Post" class="text-success postPublishIcon"><i class="fas fa-eye"></i></a>
										<a href="#" id="' . $row['post_id'] . '" title="Delete Post" class="text-danger postDeleteIcon"><i class="fa fa-fw fa-trash"></i></a>
										</td>
								</tr>';
		}
		$output .= '
							</tbody>
						</table>';
		echo $output;
	} else {
		echo "<h3 class='text-center text-secondary'>:( No Any Posts Un-Published!</h3>";
	}
}


//Create Post Upload Image
if (isset($_POST['post_title'])) {
	$title = $admin->test_input($_POST['post_title']);
	$event = $admin->test_input($_POST['post_event']);
	$event_date = $admin->test_input($_POST['event_date']);
	$video = $admin->test_input($_POST['post_video']);
	$tags = $admin->test_input($_POST['post_tags']);
	$content = $admin->test_input($_POST['post_content']);


	$folder = 'uploads/posts/';

	if (isset($_FILES['bannerImage']['name']) && ($_FILES['bannerImage']['name'] != "")) {

		$temp = explode(".", $_FILES["bannerImage"]["name"]);
		$newfilename = time() .'.' . end($temp);

		$newImage = $folder . $newfilename;
		move_uploaded_file($_FILES["bannerImage"]["tmp_name"], $newImage);

		$admin->create_post($title, $event, $event_date, $video, $tags, $content,$newImage);
	}
}



//Handle update post ajax request
if (isset($_POST['post_edit_id'])) {
	$id = $admin->test_input($_POST['post_edit_id']);
	$title = $admin->test_input($_POST['post_title']);
	$event = $admin->test_input($_POST['post_event']);
	$event_date = $admin->test_input($_POST['event_date']);
	$video = $admin->test_input($_POST['post_video']);
	$tags = $admin->test_input($_POST['post_tags']);
	$content = $admin->test_input($_POST['post_content']);

	$newFile = $admin->test_input($_FILES['bannerImage']['name']);
	$oldImage = $admin->test_input($_POST['oldImage']);
	$folder = 'uploads/posts/';

	if ($newFile != null) {
		$temp = explode(".", $_FILES["bannerImage"]["name"]);
		$newfilename = $event_id . "_" . $name . '.' . end($temp);

		$newImage = $folder . $newfilename;
		move_uploaded_file($_FILES["edit_image"]["tmp_name"], $newImage);
	} else {
		$newImage = $oldImage;
	}
	$admin->update_post($id,$title, $event, $event_date, $video, $tags, $content,$newImage);
}

//Handle view post ajax request
if (isset($_POST['post_details_id'])) {
	$id = $_POST['post_details_id'];
	$data = $admin->fetchPostDetailsById($id);
	echo json_encode($data);
}
//Handle edit post ajax request
if (isset($_POST['post_edit_id'])) {
	$id = $_POST['post_edit_id'];
	$data = $admin->fetchPostDetailsById($id);
	echo json_encode($data);
}
//Handle publish post ajax request
if (isset($_POST['post_publish_id'])) {
	$id = $_POST['post_publish_id'];
	$admin->postAction($id, 0);
}
//Handle unpublish post ajax request
if (isset($_POST['post_unpublish_id'])) {
	$id = $_POST['post_unpublish_id'];
	$admin->postAction($id, 1);
}
//Handle delete post ajax request
if (isset($_POST['post_delete_id'])) {
	$id = $_POST['post_delete_id'];
	$admin->postDeleteAction($id);
}

