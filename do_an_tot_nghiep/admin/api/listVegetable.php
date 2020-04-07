<?php
    require_once  "../autoload/autoload.php";
    
    
    $sql = "SELECT * FROM rau WHERE rau.deleted_at='0' ";
   
   
    $lists = $db->fetchSql($sql);
    echo json_encode($lists);

?>