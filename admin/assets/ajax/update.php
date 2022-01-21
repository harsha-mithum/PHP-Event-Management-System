<?php include_once '../php/config2.php';
$album = $_POST['album_id'];
//get images id and generate ids array
$idArray = explode(",",$_POST['ids']);
//update images order
$count = 1;
$date = date("Y-m-d H:i:s");
foreach ($idArray as $id){
    $data   =   array('img_order'=>$count,'modified'=>$date, 'album_id'=>$album);
    $update = $db->update(TB_IMG,$data,array('id'=>$id));
    $count ++;
}
echo '1';
?>