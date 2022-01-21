<?php
$connect = new PDO('mysql:host=localhost;dbname=studio', 'root', '');


//Fetch Event List
$data = array();
$query = "SELECT * FROM events ORDER BY id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_date"],
  'end'   => $row["end_event"]
 );
}
echo json_encode($data);


//Insert Event
if(isset($_POST["event_title"]))
{
 $query = "
 INSERT INTO events 
 (title, start_date, end_event) 
 VALUES (:title, :start_date, :end_event)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['event_title'],
   ':start_date' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}



//Update Event
if(isset($_POST["update_id"]))
{
 $query = "
 UPDATE events 
 SET title=:title, start_date=:start_date, end_event=:end_event 
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_date' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['update_id']
  )
 );
}

//Delete  Event
if(isset($_POST["delete_id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=studio', 'root', '');
 $query = "DELETE from events WHERE id=:id ";
 $statement = $connect->prepare($query);
 $statement->execute(array(':id' => $_POST['delete_id']));
}
