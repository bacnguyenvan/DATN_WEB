<?php 
	session_start();
	require_once __DIR__. DIRECTORY_SEPARATOR."../libraries/database.php";
    require_once __DIR__. DIRECTORY_SEPARATOR."../libraries/function.php";
    $db = new database;

    define("IMAGE",$_SERVER['DOCUMENT_ROOT']."/do_an_tot_nghiep/admin/public/uploads/");

    // SP Moi
    // $sqlNew = "SELECT * FROM products WHERE 1 ORDER BY id DESC LIMIT 4";
    // $productNew = $db->fetchSql($sqlNew);


    //sp ban chay
    // $sqlPay = "SELECT * FROM products WHERE 1 ORDER BY pay DESC LIMIT 4";
    // $productPay = $db->fetchSql($sqlPay);

?>

   