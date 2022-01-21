<?php

require_once 'config.php';

class Auth extends Database
{

	//Register New User
	public function register($name, $email, $password)
	{
		$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name' => $name, 'email' => $email, 'pass' => $password]);
		return true;
	}

	//Check if user already registred
	public function user_exist($email)
	{
		$sql = "SELECT email FROM users WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Login Existing User
	public function login($email)
	{
		$sql = "SELECT email, password,role FROM users WHERE email = :email AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	//Check if user already registred
	public function currentUser($email)
	{
		$sql = "SELECT * FROM users WHERE email = :email AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	//Forgot Password
	public function forgot_password($token, $email)
	{
		$sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['token' => $token, 'email' => $email]);
		return true;
	}

	//Reset Password User Auth
	public function reset_pass_auth($email, $token)
	{
		$sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW() AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email, 'token' => $token]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	//Update New Password
	public function update_new_pass($pass, $email)
	{
		$sql = "UPDATE users SET token = '', password = :pass WHERE email = :email AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['pass' => $pass, 'email' => $email]);
		return true;
	}

	//Add New Note
	public function add_new_note($uid, $title, $note)
	{
		$sql = "INSERT INTO notes (uid, title, note) VALUES (:uid, :title, :note)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid' => $uid, 'title' => $title, 'note' => $note]);
		return true;
	}

	// Fetch all notes of user
	public function get_notes($uid)
	{
		$sql = "SELECT * FROM notes WHERE uid = :uid";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid' => $uid]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	// Edit note of an user
	public function edit_note($id)
	{
		$sql = "SELECT * FROM notes WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Update note of an user
	public function update_note($id, $title, $note)
	{
		$sql = "UPDATE notes SET title = :title, note = :note, updated_at = NOW() WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['title' => $title, 'note' => $note, 'id' => $id]);
		return true;
	}

	//Delete note of an user
	public function delete_note($id)
	{
		$sql = "DELETE FROM notes WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}

	//Update User Profile
	public function update_profile($name, $gender, $dob, $phone, $photo, $address, $city, $state, $zipcode, $country, $id)
	{
		$sql = "UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo, address = :address, city = :city, state = :state, zip_code = :zipcode, country = :country WHERE id = :id AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name' => $name, 'gender' => $gender, 'dob' => $dob, 'phone' => $phone, 'photo' => $photo, 'address' => $address, 'city' => $city, 'state' => $state, 'zipcode' => $zipcode, 'country' => $country, 'id' => $id]);
		return true;
	}
	public function update_profile_image($photo, $id)
	{
		$sql = "UPDATE users SET  photo = :photo WHERE id = :id AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['photo' => $photo, 'id' => $id]);
		return true;
	}

	//Change password of an user
	public function change_password($pass, $id)
	{
		$sql = "UPDATE users SET password = :pass WHERE id = :id AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['pass' => $pass, 'id' => $id]);
		return true;
	}
	//Delete Account of an user
	public function delete_account($id)
	{
		$sql = "UPDATE users SET deleted = 1 WHERE id = $id ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return true;
	}
	//Verify email of an user
	public function verify_email($email)
	{
		$sql = "UPDATE users SET token = '', verified = 1 WHERE email = :email AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		return true;
	}

	//Send feedback of user to admin	
	public function send_feedback($sub, $feed, $uid)
	{
		$sql = "INSERT INTO feedback (uid, subject, feedback) VALUES (:uid, :sub, :feed)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid' => $uid, 'sub' => $sub, 'feed' => $feed]);
		return true;
	}

	//Notification Insert
	public function notification($uid, $type, $message)
	{
		$sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, :type, :message)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid' => $uid, 'type' => $type, 'message' => $message]);
		return true;
	}

	//Fetch Notification
	public function fetchNotification($uid)
	{
		$sql = "SELECT * FROM notification WHERE uid = :uid AND type = 'user'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid' => $uid]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//count notification
	public function countNotification($uid)
	{
		$sql = "SELECT count(*) FROM notification WHERE uid = :uid AND type = 'user'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid' => $uid]);
		$result = $stmt->fetchColumn();
		return $result;
	}

	//Remove Notification
	public function removeNotification($id)
	{
		$sql = "DELETE FROM notification WHERE id = :id AND type = 'user'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}


	/*


	######################## Events ########################


	*/



	//fetch event details
	public function fetchEventDetailsByUser($id)
	{
		$sql = "SELECT events.id, events.type_id, events.package_id, events.title, events.location, events.start_date, events.time, events.people, events.cameramen,events.progress, events.user_id, events.user_name, events.user_phone , events.user_address, events.user_email, 
	event_types.name as type, packages.name as package 
	FROM (((events INNER JOIN packages ON events.package_id = packages.id ) 
	INNER JOIN event_types ON events.type_id = event_types.id ) 
	INNER JOIN users ON events.user_id = users.id ) 
	WHERE events.user_id = $id
	AND events.unavailable != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}






	/*


	######################## Main Site ########################


	*/

	//Fetch all team members
	public function fetchAllStaff()
	{
		$sql = "SELECT * FROM users WHERE designation != null AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	// Fecth Album by Event
	public function fetchAlbumByEvent($id)
	{
		$data = ['id' => $id];
		$sql = "SELECT * FROM album WHERE event_id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//insert note
	public function send_note($title,$note)
	{
		$sql = "INSERT INTO notes (title, note) VALUES (:title, :note)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['title' => $title, 'note' => $note]);
		return true;
	}





	//fetch album image details
	public function getAllImages($album)
	{
		//echo "SELECT  $tableName.$fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." ".$limit;
		//print "<br>SELECT $fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." ".$limit;
		$stmt = $this->pdo->prepare("SELECT * FROM images WHERE album_id = " . $album . " order by img_order ASC ");
		//print "SELECT $fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." " ;
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}


}
