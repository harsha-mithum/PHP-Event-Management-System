<?php
session_start();
define('HOST', 'offline');
error_reporting(0);
$url	=	(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(HOST == 'online'){
    define('DB_NAME', '');
    define('DB_USER', '');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    define('HOME_URL','https://ideagraphy.lk/');
    define("HOME_PATH",'https://ideagraphy.lk/');
    define("HOME_AJAX",HOME_URL.'admin/assets/ajax/');
}else{
    define('DB_NAME', 'studio');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    define('HOME_URL',$url);
    define("HOME_PATH",$url);
    define("HOME_AJAX",HOME_URL.'admin/assets/ajax/');
}
 
/*** TB DEFINE ***/
define('TB_IMG','images');
 
/*** DB INCLUDES ***/
include_once 'Database.php';
 
/*** DB CONNECTION ***/
$dsn        =   "mysql:dbname=".DB_NAME.";host=".DB_HOST."";
$pdo        =   '';
try {$pdo   =   new PDO($dsn, DB_USER, DB_PASSWORD);} catch (PDOException $e) {echo "Connection failed: " . $e->getMessage();}
 
/*Classes*/
$db         =   new Database($pdo);
?>