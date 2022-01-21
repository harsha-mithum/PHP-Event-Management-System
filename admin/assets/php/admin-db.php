<?php

require_once 'config.php';



class Admin extends Database
{

	/* 

	################ Login ################

	*/


	//Admin Login
	public function admin_login($username)
	{
		$sql = "SELECT username, password FROM users WHERE username = :username AND role = 'admin'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['username' => $username]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	//Change password of an user
	public function change_password($pass, $id)
	{
		$sql = "UPDATE users SET password = :pass WHERE id = :id AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['pass' => $pass, 'id' => $id]);
		return true;
	}

	//Change password of an admin
	public function change_pass_admin($pass)
	{
		$sql = "UPDATE users SET password = :pass WHERE role = 'admin' ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['pass' => $pass]);
		return true;
	}


	//Change username of an admin
	public function change_username($name)
	{
		$sql = "UPDATE users SET username = '$name' WHERE role = 'admin' ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return true;
	}


	/* 

	################ Dashboard ################

	*/

	//count Total No. of Rows
	public function totalCount($tablename)
	{
		$sql = "SELECT * FROM $tablename ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->rowCount();
		return $count;
	}

	//count verified/unverified user of row
	public function verified_users($status)
	{
		$sql = "SELECT * FROM users WHERE verified = :status EXCEPT SELECT  * FROM users WHERE role = 'admin'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['status' => $status]);
		$count = $stmt->rowCount();
		return $count;
	}

	//Gender Percentage
	public function genderPer()
	{
		$sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender != '' GROUP BY gender";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//verified/unverified Percentage
	public function verifiedPer()
	{
		$sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//count web hits
	public function site_hits()
	{
		$sql = "SELECT hits FROM visitors";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);
		return $count;
	}

	//count published / unpublished packages
	public function count_packages($val)
	{
		$sql = "SELECT * FROM packages WHERE unavailable = $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();
		return $count;
	}

	//count published / unpublished events
	public function count_events($val)
	{
		$sql = "SELECT * FROM events WHERE unavailable = $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();
		return $count;
	}

	//count published / unpublished packages
	public function count_posts($val)
	{
		$sql = "SELECT * FROM posts WHERE unavailable = $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();
		return $count;
	}
	/* 

	################ Users ################

	*/


	//Fetch All Registred Users
	public function fetchAllUsers($val)
	{
		$sql = "SELECT * FROM users WHERE deleted != $val EXCEPT SELECT * FROM users WHERE role = 'admin'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	//Fetch All Registred Users
	public function fetchAllStaff($val)
	{
		$sql = "SELECT * FROM users WHERE role = 'staff' AND deleted != $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}


	//Fetch user details by ID
	public function fetchUserDetailsById($id)
	{
		$sql = "SELECT * FROM users WHERE id = :id AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Update Designation
	public function staffDesignation($id, $designation)
	{
		$sql = "UPDATE users SET designation = :designation WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id, 'designation' => $designation]);
		return true;
	}

	//Delete User
	public function userAction($id, $val)
	{
		$sql = "UPDATE users SET deleted = $val WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}

	//Delete User
	public function userActionDel($id)
	{
		$sql = "DELETE FROM users WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}
	//Fetch All Users Notes
	public function fetchAllNotes()
	{
		$sql = "SELECT notes.id, notes.title, notes.note, notes.created_at, notes.updated_at, users.name, users.email FROM notes INNER JOIN users ON notes.uid = users.id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Fetch All Users Notes
	public function fetchAllGuestNotes()
	{
		$sql = "SELECT notes.id, notes.title, notes.note, notes.created_at, notes.updated_at, users.name, users.email FROM notes INNER JOIN users ON notes.uid = users.id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	}
	//Delete note of an User
	public function deleteNoteOfUser($id)
	{
		$sql = "DELETE FROM notes WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}


	/* 

	################ Feedback ################

	*/

	//Fetch all feedback of users
	public function fetchFeedback()
	{
		$sql = "SELECT feedback.id, feedback.subject, feedback.feedback, feedback.created_at, feedback.uid, users.name, users.email FROM feedback INNER JOIN users ON feedback.uid = users.id WHERE replied != 1 ORDER BY feedback.id DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Reply to user
	public function replyFeedback($uid, $message)
	{
		$sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, 'user', :message)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid' => $uid, 'message' => $message]);
		return true;
	}

	//Set Feedback as Replied
	public function feedbackReplied($fid)
	{
		$sql = "UPDATE feedback SET replied = 1 WHERE id = :fid";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['fid' => $fid]);
		return true;
	}

	/* 

	################ Notifications ################

	*/

	public function fetchNotification()
	{
		$sql = "SELECT notification.id, notification.message, notification.created_at, users.name, users.email FROM notification INNER JOIN users ON notification.uid = users.id WHERE type = 'admin' ORDER BY notification.id DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//count notification
	public function countNotification()
	{
		$sql = "SELECT count(*) FROM notification WHERE type = 'admin'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}

	//Remove Notification
	public function removeNotification($id)
	{
		$sql = "DELETE FROM notification WHERE id = :id AND type = 'admin'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}

		//Remove Notification
		public function clearNotification()
		{
			$sql = "DELETE FROM notification";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
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

	/* 

	################ Packages ################

	*/

	//Fetch All Packages
	public function fetchAllPackages($val)
	{
		$sql = "SELECT packages.id, packages.name, packages.photo, packages.price, packages.description, event_types.name AS event FROM packages INNER JOIN event_types ON packages.type_id = event_types.id WHERE packages.unavailable != $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Fetch package details by ID
	public function fetchPackageDetailsById($id)
	{
		$sql = "SELECT packages.id, packages.name, packages.photo, packages.price, packages.description, event_types.name AS type_name, event_types.id AS type_id FROM packages INNER JOIN event_types ON packages.type_id = event_types.id WHERE packages.id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Fetch package details by Event Type
	public function fetchPackageDetailsByType($id)
	{
		$sql = "SELECT packages.id, packages.name, packages.price,packages.photo, event_types.id AS type_id FROM packages INNER JOIN event_types ON packages.type_id = event_types.id WHERE event_types.id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

		//Fetch package details by Event Type
		public function fetchPackagesByType($id)
		{
			$sql = " SELECT * FROM packages WHERE type_id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id' => $id]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

	//Publish Package
	public function packageAction($id, $val)
	{
		$sql = "UPDATE packages SET unavailable = $val WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}

	//Update Package
	public function update_package($name, $photo, $price, $description, $type_id, $id)
	{
		$data = ['name' => $name, 'photo' => $photo, 'price' => $price, 'description' => $description, 'type_id' => $type_id, 'id' => $id];
		$sql = "UPDATE packages SET name = :name , photo = :photo, price = :price, description = :description , type_id = :type_id WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}

	//Create Package
	public function create_package($name, $photo, $price, $description, $type_id)
	{
		$data = ['name' => $name, 'photo' => $photo, 'price' => $price, 'description' => $description, 'type_id' => $type_id];
		$sql = "INSERT INTO packages (name,photo,price,description,type_id) VALUES( :name, :photo, :price, :description, :type_id)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}

	//Delete Package
	public function packageDeleteAction($id)
	{
		$sql = "DELETE FROM packages WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}


	/* 

	################ Event Cat / Types ################

	*/

	//Fetch All Event Types
	public function fetchAllTypes()
	{
		$sql = "SELECT event_types.id, event_types.name, event_cat.name AS cat_id  FROM event_types INNER JOIN event_cat ON event_types.cat_id = event_cat.id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}


	//Fetch All Event Types
	public function fetchAllTypesByCat($cat)
	{
		$sql = "SELECT event_types.id, event_types.name, event_cat.name AS cat FROM event_types INNER JOIN event_cat ON event_types.cat_id = event_cat.id WHERE event_cat.name = :cat";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['cat' => $cat]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}



	//Delete type
	public function typeDeleteAction($id)
	{
		$sql = "DELETE FROM event_types WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}

	//Fetch type details by ID
	public function fetchTypeDetailsById($id)
	{
		$sql = "SELECT * FROM event_types WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Update Type
	public function update_type($name, $cat_id, $id)
	{
		$data = ['name' => $name, 'cat_id' => $cat_id, 'id' => $id];
		$sql = "UPDATE event_types SET name = :name, cat_id = :cat_id WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}

	//Create Type
	public function create_type($name, $cat_id)
	{
		$data = ['name' => $name, 'cat_id' => $cat_id];
		$sql = "INSERT INTO event_types (name,cat_id) VALUES( :name, :cat_id)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}

	//#########################################################//

	//Fetch All Event Cat
	public function fetchAllCat()
	{
		$sql = "SELECT * FROM event_cat";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Delete Cat
	public function catDeleteAction($id)
	{
		$sql = "DELETE FROM event_cat WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}

	//Fetch Cat details by ID
	public function fetchCatDetailsById($id)
	{
		$sql = "SELECT * FROM event_cat WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Update Cat
	public function update_cat($name, $id)
	{
		$data = ['name' => $name, 'id' => $id];
		$sql = "UPDATE event_cat SET name = :name WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}

	//Create Cat
	public function create_cat($name)
	{
		$data = ['name' => $name];
		$sql = "INSERT INTO event_cat (name) VALUES( :name)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}

	/* 

	################ Events ################

	*/

	//Fetch All Events
	public function fetchAllEvents()
	{
		$sql = "SELECT 
		events.id, events.type_id, events.package_id, events.title, events.location, events.start_date, events.time, events.people, events.cameramen, events.user_id, events.user_name, events.user_phone ,
		event_types.name as type,
		packages.name as package
		FROM (((events
		INNER JOIN packages ON events.package_id = packages.id ) 
		INNER JOIN event_types ON events.type_id = event_types.id )
		INNER JOIN users ON events.user_id = users.id )";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Fetch Events details by ID
	public function fetchEventDetailsById($id)
	{
		$sql = "SELECT events.id, events.type_id, events.package_id, events.title, events.location, events.start_date, events.time, events.people, events.cameramen, events.user_id, events.user_name, events.user_phone , events.user_address, events.user_email, 
		event_types.name as type, packages.name as package 
		FROM (((events INNER JOIN packages ON events.package_id = packages.id ) 
		INNER JOIN event_types ON events.type_id = event_types.id ) 
		INNER JOIN users ON events.user_id = users.id ) 
		WHERE events.id = :id AND events.unavailable != 1 ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Fetch progress by 
	public function fetchProgressById($id)
	{
		$sql = "SELECT progress FROM events WHERE id = :id ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	//Save Progress
	public function save_progress($id, $val)
	{
		$data = ['id' => $id, 'val' => $val];
		$sql = "UPDATE events SET progress = :val WHERE id = :id ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}


	//Delete Events
	public function eventAction($id, $val)
	{
		$sql = "UPDATE events SET unavailable = $val WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}

	//Update Events
	public function update_event($name, $type, $id)
	{
		$sql = "UPDATE events SET name = :name, type_id = :type WHERE id = :id AND deleted != 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name' => $name,  'type_id' => $type, 'id' => $id]);
		return true;
	}

	//Create Event
	public function create_event($title, $location, $date, $time, $people, $type, $package, $cameramen, $uid, $name, $address, $email, $phone)
	{
		$data = ['title' => $title, 'location' =>  $location, 'date' =>  $date, 'time' => $time, 'people' => $people, 'type' =>  $type, 'package' =>  $package, 'cameramen' =>  $cameramen, 'uid' =>  $uid, 'uname' =>  $name, 'uadd' =>  $address, 'uemail' =>  $email, 'uphone' =>  $phone];

		$sql = "INSERT INTO events (type_id, package_id, title, location, start_date, time, people,cameramen, user_id, user_name, user_address, user_email, user_phone) VALUES (:type,:package, :title, :location, :date, :time, :people,:cameramen, :uid, :uname, :uadd, :uemail, :uphone)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}







	//  public function create_event($uid, $name, $address, $email, $phone)
	//  {
	//  	$data = ['uid' =>  $uid, 'uname' =>  $name, 'uadd' =>  $address, 'uemail' =>  $email, 'uphone' =>  $phone];
	//  	$sql = "INSERT INTO events ( user_id, user_name, user_address, user_email, user_phone) VALUES ( :uid, :uname, :uadd, :uemail, :uphone)";
	//  	$stmt = $this->conn->prepare($sql);
	//  	$stmt->execute($data);
	//  	return true;
	//  }

	/* 


	################ Album ################

	*/


	//Create Album
	public function create_album($title, $photo, $id)
	{
		$data = ['title' => $title, 'photo' => $photo, 'id' => $id];
		$sql = "INSERT INTO album (title, cover_image, event_id, created_on) VALUES( :title, :photo, :id, NOW())";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}

	//Update Album Request
	public function update_album($title, $photo, $id)
	{
		$data = ['title' => $title, 'photo' => $photo, 'id' => $id];
		$sql = "UPDATE album SET title = :title, cover_image = :photo WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
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

	// Fecth Album by Event
	public function fetchAlbumDetailsById($id)
	{
		$sql = "SELECT * FROM album WHERE id= :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	// Fecth Album by Event
	public function fetchAlbum($id)
	{
		$sql = "
SELECT
    album.id,
    album.title,
    album.cover_image,
    event_id,
    album.created_on,
    EVENTS.title AS EVENT
FROM
    album
INNER JOIN EVENTS ON album.event_id = EVENTS.id
WHERE EVENTS.id = :id ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}



	//  Album Delete Action
	public function albumDeleteAction($id)
	{
		$data = ['id' => $id];
		$sql = "DELETE FROM album WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}


	//Check if album already registred
	public function album_exist($title, $event)
	{
		$sql = "SELECT title FROM album WHERE title = :title AND event_id = :event";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['title' => $title, 'event' => $event]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	/* 


	################ Export ################

	*/


	//Fetch All Users From DB (Export Excel)
	public function exportAllUsers()
	{
		$sql = "SELECT * FROM users WHERE role = 'user' ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Fetch All Users From DB (Export Excel)
	public function exportAllStaff()
	{
		$sql = "SELECT * FROM users WHERE role = 'staff' ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Fetch All packages From DB (Export Excel)
	public function exportAllPackages()
	{
		$sql = " SELECT packages.id,packages.name,packages.price,packages.description,packages.unavailable, event_types.name as event FROM `packages` INNER JOIN event_types ON event_types.id = packages.type_id ORDER BY event";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}


	///////////////////////////////////////////////////////////////////////////////
	////////////////////////// search //////////////////////////////////////////


	// user search
	function search_user($inpText)
	{
		$sql = 'SELECT * FROM users WHERE name LIKE :name';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name' => '%' . $inpText . '%']);
		$result = $stmt->fetchAll();
		return $result;
	}











	/* 

	################ Posts ################

	*/

	//Fetch All Posts
	public function fetchAllPosts($val)
	{
		$sql = "SELECT posts.post_id, posts.post_title, posts.post_image, posts.post_date,posts.event_date,posts.yt_link, posts.post_content,post_type_id,post_tags, event_types.name AS event FROM posts INNER JOIN event_types ON posts.post_type_id = event_types.id WHERE posts.unavailable != $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Fetch post details by ID
	public function fetchPostDetailsById($id)
	{
		$sql = "SELECT posts.post_id, posts.post_title, posts.post_image, posts.post_date,posts.event_date,posts.yt_link, posts.post_content,post_type_id,post_tags, event_types.name AS event FROM posts INNER JOIN event_types ON posts.post_type_id = event_types.id WHERE posts.post_id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Fetch post details by Event Type
	public function fetchPostDetailsByType($id)
	{
		$sql = "SELECT posts.post_id, posts.post_title, posts.post_image, posts.post_date,posts.event_date,posts.yt_link, event_types.id AS type_id FROM posts INNER JOIN event_types ON posts.post_type_id = event_types.id WHERE event_types.id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Publish Post
	public function postAction($id, $val)
	{
		$sql = "UPDATE posts SET unavailable = $val WHERE post_id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}

	//Update Post
	public function update_post($id, $title, $event, $event_date, $video, $tags, $content, $newImage)
	{
		$data =  ['id' => $id, 'title' => $title, 'event' => $event, 'event_date' => $event_date, 'video' => $video, 'tags' => $tags, 'content' => $content, 'image' => $newImage];
		$sql = "UPDATE posts SET post_title = :title , post_type_id = :event, event_date = :event_date, post_date = NOW(), yt_link = :video, post_tags = :tags, post_content = :content , post_image = :image WHERE post_id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}

	//Create Post
	public function create_post($title, $event, $event_date, $video, $tags, $content, $newImage)
	{
		$data = ['title' => $title, 'event' => $event, 'event_date' => $event_date, 'video' => $video, 'tags' => $tags, 'content' => $content, 'image' => $newImage];
		$sql = "INSERT INTO posts (post_title, post_type_id ,event_date,post_date, yt_link,  post_tags, post_content, post_image) VALUES( :title, :event, :event_date, NOW(), :video, :tags, :content, :image)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return true;
	}

	//Delete Post
	public function postDeleteAction($id)
	{
		$sql = "DELETE FROM posts WHERE post_id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);
		return true;
	}
}

class User extends Database
{
	//Register New User
	public function register($name, $email, $phone, $city, $password, $role)
	{
		$sql = "INSERT INTO users (name, email, phone, city, password, role) VALUES (:name, :email, :phone, :city, :pass, :role)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'city' => $city, 'pass' => $password, 'role' => $role]);
		return true;
	}

	//Register New User
	public function register_staff($name, $email, $phone, $city, $designation, $password, $role)
	{
		$sql = "INSERT INTO users (name, email, phone, city, designation, password, role) VALUES (:name, :email, :phone, :city, :designation, :pass, :role)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'city' => $city, 'designation' => $designation, 'pass' => $password, 'role' => $role]);
		return true;
	}

	//Check if user already registred
	public function user_exist($email)
	{
		$sql = "SELECT * FROM users WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email' => $email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Forgot Password
	public function forgot_password($token, $email)
	{
		$sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['token' => $token, 'email' => $email]);
		return true;
	}

	//Random Password
	function random_string($length = 8)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return strtoupper($randomString);
	}
}
