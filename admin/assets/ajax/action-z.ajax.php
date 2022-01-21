<?php
include_once('../php/config2.php');
 
if(!empty($_FILES['files'])){
    $album = $_POST['album_id'];
    $date = date("Y-m-d H:i:s");
        $n=0;
    $s=0;
    $prepareNames   =   array();
    foreach($_FILES['files']['name'] as $val)
    {
        $infoExt        =   getimagesize($_FILES['files']['tmp_name'][$n]);
        $s++;
        $filesName      =   str_replace(" ","",trim($_FILES['files']['name'][$n]));
        $files          =   explode(".",$filesName);
        $File_Ext       =   substr($_FILES['files']['name'][$n], strrpos($_FILES['files']['name'][$n],'.'));
         
        if($infoExt['mime'] == 'image/gif' || $infoExt['mime'] == 'image/jpeg' || $infoExt['mime'] == 'image/png')
        {
            $srcPath    =   '../../../uploads/albums/';
            $fileName   =   $s.rand(0,999).time().$File_Ext;
            $path   =   trim($srcPath.$fileName);
            if(move_uploaded_file($_FILES['files']['tmp_name'][$n], $path))
            {
                $prepareNames[] .=  $fileName; //need to be fixed.
                $Sflag      =   1; // success
            }else{
                $Sflag  = 2; // file not move to the destination
            }
        }
        else
        {
            $Sflag  = 3; //extention not valid
        }
        $n++;
    }
    if($Sflag==1){
        echo '{Images uploaded successfully!}';
    }else if($Sflag==2){
        echo '{File not move to the destination.}';
    }else if($Sflag==3){
        echo '{File extention not good. Try with .PNG, .JPEG, .GIF, .JPG}';
    }
 
    if(!empty($prepareNames)){
        $count  =   1;
        foreach($prepareNames as $name){
            $data   =   array(
                            'img_name'=>$name,
                            'img_order'=>$count++,
                            'album_id'=>$album,
                            'created'=>$date,
                        );
            $db->insert(TB_IMG,$data);
        }
    }
}


if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
    $path = $_POST['psth'];

    $db->delete('images',['id' => $id]);
    unlink('../../'.$path);

    echo 'Delete Success.';
}
?>