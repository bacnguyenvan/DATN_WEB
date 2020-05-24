<?php 
	session_start();
	require_once __DIR__. DIRECTORY_SEPARATOR."../libraries/database.php";
    require_once __DIR__. DIRECTORY_SEPARATOR."../libraries/function.php";
    $db = new database;

    define("IMAGE",$_SERVER['DOCUMENT_ROOT']."/do_an_tot_nghiep/admin/public/uploads/");

?>

   